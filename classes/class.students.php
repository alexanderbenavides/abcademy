<?php

/**
 * Handles student interactions within the app
 *
 * PHP version 7
 *
 * @author Alexander Benavides
 *
 */
class Student
{
    /**
     * The database object
     *
     * @var object
     */
    private $_db;

    /**
     * Checks for a database object and creates one if none is found
     *
     * @param object $db
     * @return void
     */
    public function __construct($db = NULL)
    {
        if (is_object($db)) {
            $this->_db = $db;
        } else {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
            $this->_db = new PDO($dsn, DB_USER, DB_PASS);
        }
    }

    public function getStudentData($filters)
    {

      try {
      $sql="SELECT * FROM students";
      
          $conditions = [] ;
          if (isset($filters['email-user']) && !empty($filters['email-user'])) {
            $conditions[] = " email = '" . $filters['email-user']."'";
        }          
        if (count($conditions) > 0) {
          $i = 0;

          foreach ($conditions as $condition) {
              if ($i == 0) {
                  $sql .= " WHERE" . $condition;
              } else {
                  $sql .= " AND" . $condition;
              }

              $i++;
          }
      }          
          $stmt = $this->_db->prepare($sql);
          $stmt->execute();
          $courses = $stmt->fetchAll(PDO::FETCH_CLASS);
          return $courses;
          $stmt->closeCursor();
      } catch (PDOException $e) {
          return FALSE;
      }

    }

    public function createAccount()
    {
        if (isset($_POST['password1']) && isset($_POST['password2']) && $_POST['password1'] != $_POST['password2']) {
            return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Las contraseñas ingresadas no son iguales.
                </div>';
        } else if (strlen($_POST['password1']) < 7) {
            return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  La contraseña debe tener al menos 7 dígitos.
                </div>';
        } else if (!(preg_match('/[A-Za-z]/', $_POST['password1']) && preg_match('/[0-9]/', $_POST['password1']))) {
            return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  La contraseña debe tener al menos un número y una letra.
                </div>';
        }

        $email = trim($_POST['email']);
        $pwd = password_hash($_POST['password1'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $v = sha1(time());

        $sql = "SELECT COUNT(email) AS theCount
                FROM students
                WHERE email=:email";

        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['theCount'] != 0) {
                return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Otra persona est&aacute; registrado con este email.
                </div>';
            }
            if (!$this->sendVerificationEmail($name,$email, $v)) {
                return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Hubo un error enviando el email de verificaci&oacute;n.
                </div>';
            }

            $stmt->closeCursor();
        }

        $sql = "INSERT INTO students(
                firstName,
                lastName,
                email,
                password,
                verCode
                )
                VALUES(:firstName,:lastName, :email, :pass, :ver)";

        if ($stmt = $this->_db->prepare($sql)) {
          $stmt->bindParam(":firstName", $name, PDO::PARAM_STR);
          $stmt->bindParam(":lastName", $_POST['last_name'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":pass", $pwd, PDO::PARAM_STR);
            $stmt->bindParam(":ver", $v, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            return '<div class="callout callout-success">
              <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
              Le hemos enviado un email al usuario para que verifique su cuenta.
            </div>';

        } else {
            return "<h2> Error </h2><p> No se pudo introducir "
                . " la informaci&oacute;n de usuario a la base de datos. </p>";
        }
    }

    private function sendVerificationEmail($fname, $email, $ver)
    {
        require_once $_SERVER["DOCUMENT_ROOT"] . '/PHPMailer-master/PHPMailerAutoload.php';

        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $verification_link = "http://" . $_SERVER['HTTP_HOST'] . "/accountverify.php?v=" . $ver . "&e=" . $e;

        $msg = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/PHPMailer-master/email_templates/sendVerificationEmail.html');
        $msg = str_replace('%email_subject%', 'Verifica tu cuenta de ABCademy!', $msg);
        $msg = str_replace('%preview_text%', '&iexcl;Ya tienes una cuenta con nosotros!', $msg);
        $msg = str_replace('%user_firstname%', $fname, $msg);
        $msg = str_replace('%user_email%', $email, $msg);
        $msg = str_replace('%verification_link%', $verification_link, $msg);

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = "smtp.mailtrap.io";
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "63916459662b0f";

        //Password to use for SMTP authentication
        $mail->Password = "4eed0d3b6f4f71";

        //Set who the message is to be sent from
        $mail->setFrom("63916459662b0f", 'ABCademy');

        //Set an alternative reply-to address
        $mail->addReplyTo("63916459662b0f", 'ABCademy');

        //Set who the message is to be sent to
        $mail->addAddress($to, '');

        $mail->Subject = 'Verifica tu cuenta de ABCademy!';

        $mail->msgHTML($msg);

        $mail->AltBody = 'Ya tienes una cuenta con nosotros!';

        return $mail->send();
    }

}


?>
