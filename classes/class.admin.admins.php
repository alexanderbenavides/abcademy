<?php

/**
 * Handles student interactions within the app
 *
 * PHP version 7
 *
 * @author Alexander Benavides
 *
 */
class Admin
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
                FROM admins
                WHERE email=:email";

        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['theCount'] != 0) {
                return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Otro administrador est&aacute; registrado con este email.
                </div>';
            }
            /*if (!$this->sendAdminVerificationEmail($email, $v, $_POST['password1'])) {
                return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Hubo un error enviando el email de verificaci&oacute;n.
                </div>';
            }*/

            $stmt->closeCursor();
        }

        $sql = "INSERT INTO admins(
                firstName,
                lastName,
                email,
                password,
                verCode,
                permission)
                VALUES(:firstName,:lastName, :email, :pass, :ver, :perm)";

        if ($stmt = $this->_db->prepare($sql)) {
          $stmt->bindParam(":firstName", $name, PDO::PARAM_STR);
          $stmt->bindParam(":lastName", $_POST['last_name'], PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":pass", $pwd, PDO::PARAM_STR);
            $stmt->bindParam(":ver", $v, PDO::PARAM_STR);
            $stmt->bindParam(":perm", $_POST['permission'], PDO::PARAM_STR);
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
    public function createAccountTeacher()
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
                FROM teachers
                WHERE email=:email";

        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($row['theCount'] != 0) {
                return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Otro administrador est&aacute; registrado con este email.
                </div>';
            }
            /*if (!$this->sendAdminVerificationEmail($email, $v, $_POST['password1'])) {
                return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  Hubo un error enviando el email de verificaci&oacute;n.
                </div>';
            }*/

            $stmt->closeCursor();
        }

        $sql = "INSERT INTO teachers(
                firstName,
                lastName,
                email,
                password,
                verCode)
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
    /**
     * Sends an email to a user with a link to verify their new account
     *
     * @param string $email The user's email address
     * @param string $ver The random verification code for the user
     * @return boolean        TRUE on successful send and FALSE on failure
     */
    private function sendAdminVerificationEmail($email, $ver, $password)
    {
      require_once $_SERVER["DOCUMENT_ROOT"] . '/PHPMailer-master/PHPMailerAutoload.php';

        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $verification_link = "http://" . $_SERVER['HTTP_HOST'] . "/admin/accountverify.php?v=" . $ver . "&e=" . $e;

        $msg = 'Hola,<br/><br/>

Un administrador te ha creado una cuenta de Admin.<br/><br/>

Tu usuario es: <b>' . $email . '</b><br/><br/>

Tu contrase&ntilde;a es: <b>' . $password . '</b><br/><br/>

Por favor haz <a href="' . $verification_link . '">click aqu&iacute;</a> para activar tu cuenta.<br/><br/>

Si tienes preguntas, m&aacute;ndanos un email a abcti.sistemas2018@gmail.com<br/><br/>

Saludos,<br/><br/>

El equipo de ABC<br/><br/>';

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
        $mail->Host = 'smtp.gmail.com';
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
        $mail->Username = "abcti.sistemas2018@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "927760282Alex";

        //Set who the message is to be sent from
        $mail->setFrom('abcti.sistemas2018@gmail.com', 'Alex');

        //Set an alternative reply-to address
        $mail->addReplyTo('abcti.sistemas2018@gmail.com', 'Alex');

        //Set who the message is to be sent to
        $mail->addAddress($to, '');

        $mail->Subject = 'Verifica tu cuenta de Admin';

        $mail->msgHTML($msg);

        $mail->AltBody = 'Ya tienes una cuenta con nosotros!';

        return $mail->send();
    }

    public function updateAccount()
    {
        if (isset($_POST['save_button'])) {
            return $this->saveAccount();
        } else if (isset($_POST['delete_button'])) {
            return $this->deleteAccount();
        } else if (isset($_POST['suspend_button'])) {
            return $this->suspendAccount();
        } else if (isset($_POST['unsuspend_button'])) {
            return $this->unsuspendAccount();
        }
    }

    private function saveAccount()
    {
        $adminID = $_POST['admin_ID'];
        //$email = trim($_POST['email']);
        $name = $_POST['name'];

        $sql = "SELECT email
                FROM admins
                WHERE admin_ID=:aid";

        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(":aid", $adminID, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            $sql = "UPDATE admins
                    SET name = :name
                    WHERE admin_ID = :aid";

            if ($stmt = $this->_db->prepare($sql)) {
                $stmt->bindParam(":name", $name, PDO::PARAM_STR);
                $stmt->bindParam(":aid", $adminID, PDO::PARAM_STR);

                $stmt->execute();
                $stmt->closeCursor();

                return '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
                  Los nuevos datos del administrador han sido guardados en la base de datos.
                </div>';

            } else {
                return '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  No se pudo introducir la nueva informaci&oacute;n del administrador a la base de datos.
                </div>';
            }
        }
    }

    private function deleteAccount()
    {
        if (true) // might add extra security check before delete
        {
            // Delete the admin
            $sql = "DELETE FROM admins
                    WHERE admin_ID=:aid";
            try {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":aid", $_POST['admin_ID'], PDO::PARAM_INT);
                $stmt->execute();
                $stmt->closeCursor();
            } catch (PDOException $e) {
                die($e->getMessage());
            }

            // Send to confirmation page
            echo "<meta http-equiv='refresh' content='0;view-admins.php?delete=success'>";
            exit;
        } else {
            return '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Error</h4>
            No se pudo eliminar el usuario.
          </div>';
        }
    }

    private function suspendAccount()
    {
        // Set user status to suspended
        $sql = "UPDATE admins
                SET suspended=1
                WHERE admin_ID=:aid";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(":aid", $_POST['admin_ID'], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            return '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
              Esta cuenta ha sido suspendida. El administrador no podr&aacute; acceder hasta que reviertas este cambio.
            </div>';

        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    private function unsuspendAccount()
    {
        // Set user status to suspended
        $sql = "UPDATE admins
                SET suspended=0
                WHERE admin_ID=:aid";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(":aid", $_POST['admin_ID'], PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();

            return '<div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
              Esta cuenta ha dejado de estar suspendida y est&aacute; nuevamente activa.
            </div>';

        } catch (PDOException $e) {
            return $e->getMessage();
        }

    }

    /**
     * Checks credentials and verifies a user account
     *
     * @return array    an array containing a status code and status message
     */
    public function verifyAccount()
    {
        $sql = "SELECT email
                FROM admins
                WHERE verCode=:ver
                AND SHA1(email)=:user
                AND verified=0";

        if ($stmt = $this->_db->prepare($sql)) {
            $stmt->bindParam(':ver', $_GET['v'], PDO::PARAM_STR);
            $stmt->bindParam(':user', $_GET['e'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if (isset($row['email'])) {
                $sql = "UPDATE admins
                        SET verified=1
                        WHERE verCode=:ver
                        LIMIT 1";
                try {
                    $stmt = $this->_db->prepare($sql);
                    $stmt->bindParam(":ver", $_GET['v'], PDO::PARAM_STR);
                    $stmt->execute();
                    $stmt->closeCursor();
                } catch (PDOException $e) {
                    return '<div class="help-block text-center">
                      No se pudo activar tu cuenta. Por favor contacta al webmaster.
                    </div>';
                }

            } else {
                return '
                <div class="help-block text-center">
                  Esta cuenta ya ha sido activada.
                </div>
                <div class="text-center">
                  <a href="password.php">¿Olvidaste tu contraseña?</a>
                </div>';
            }
            $stmt->closeCursor();

            return '
            <div class="help-block text-center">
              Tu cuenta de administrador ha sido activada con éxito.
            </div>
            <div class="text-center">
              <a href="/admin">Acceder</a>
            </div>';
        } else {
            return "<h4>Error</h4><p>Database error.</p>";
        }
    }

    /**
     * Changes the user's password
     *
     * @return boolean    TRUE on success, FALSE on failure
     */
    public function updatePassword()
    {
        if (isset($_POST['p']) && isset($_POST['r']) && $_POST['p'] != $_POST['r'])
        {
            return '<div class="callout callout-danger">
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                Las contraseñas ingresadas no son iguales.
              </div>';
        }
        else if (strlen($_POST['p']) < 7)
        {
            return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  La contraseña debe tener al menos 7 dígitos.
                </div>';
        }
        else if (!(preg_match('/[A-Za-z]/', $_POST['p']) && preg_match('/[0-9]/', $_POST['p'])))
        {
            return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  La contraseña debe tener al menos un número y una letra.
                </div>';
        }
        else if (isset($_POST['p']) && isset($_POST['r']) && $_POST['p'] == $_POST['r'])
        {
            $pwd = password_hash($_POST['p'], PASSWORD_DEFAULT);

            $sql = "UPDATE admins
                    SET password=:pass, verified=1
                    WHERE ver_code=:ver
                    LIMIT 1";

            try {
                $stmt = $this->_db->prepare($sql);
                $stmt->bindParam(":pass", $pwd, PDO::PARAM_STR);
                $stmt->bindParam(":ver", $_POST['v'], PDO::PARAM_STR);
                $stmt->execute();
                $stmt->closeCursor();

                return '<div class="callout callout-success">
                      <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
                      Se ha cambiado tu contraseña. <a href="/admin">Acceder</a>
                    </div>';
            } catch (PDOException $e) {
                return '<div class="callout callout-danger">
                    <h4><i class="icon fa fa-ban"></i> Error</h4>
                    No se pudo cambiar tu contraseña.
                  </div>';
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Checks credentials and logs in the user
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function accountLogin()
    {
        $sql = "SELECT email, password, verified
                FROM admins
                WHERE email=:user";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if ($stmt->rowCount() == 1 && $row['verified'] == 1)
            {
                if (password_verify($_POST['password'], $row['password']))
                {
                    $_SESSION['AdminUsername'] = htmlentities($_POST['username'], ENT_QUOTES);
                    $_SESSION['AdminLoggedIn'] = 1;
                    return TRUE;
                }
                else
                {
                  return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        catch (PDOException $e)
        {
            return FALSE;
        }
    }

    /**
     * Checks credentials and logs in the user
     *
     * @return boolean    TRUE on success and FALSE on failure
     */
    public function accountLoginStudent()
    {
        $sql = "SELECT email, password, verified
                FROM students
                WHERE email=:user";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();

            if ($stmt->rowCount() == 1 && $row['verified'] == 1)
            {
                if (password_verify($_POST['password'], $row['password']))
                {
                    $_SESSION['studentUsername'] = htmlentities($_POST['username'], ENT_QUOTES);
                    $_SESSION['studentLoggedIn'] = 1;
                    return TRUE;
                }
                else
                {
                  return FALSE;
                }
            }
            else
            {
                return FALSE;
            }
        }
        catch (PDOException $e)
        {
            return FALSE;
        }
    }

    /**
     * Resets a user's status to unverified and sends them an email
     *
     * @return mixed    TRUE on success and a message on failure
     */
    public function resetPassword()
    {
        $useremail = $_POST['username'];
        $ver = '';

        // Set user status to unverified
        $sql = "UPDATE admins
                SET verified=0
                WHERE email=:user
                LIMIT 1";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(":user", $useremail, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->closeCursor();
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        // Get verification code to append to password reset link.
        $sql = "SELECT ver_code
                FROM admins
                WHERE email=:user";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $useremail, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            if ($stmt->rowCount() == 0) {
                return '<div class="callout callout-danger">
                      <h4><i class="icon fa fa-ban"></i> Error</h4>
                      No existe una cuenta registrada con este email.
                    </div>';
            }
            $stmt->closeCursor();
            $ver = $row['ver_code'];
        } catch (PDOException $e) {
            return $e->getMessage();
        }

        // Send the reset email
        if (!$this->sendAdminResetEmail($useremail, $ver)) {
            return '<div class="callout callout-danger">
                  <h4><i class="icon fa fa-ban"></i> Error</h4>
                  No se pudo mandar el email.
                </div>';
        }
        return '<div class="callout callout-success">
              <h4><i class="icon fa fa-check"></i> &iexcl;Éxito!</h4>
              Se ha enviado el email para restablecer tu contraseña.
            </div>';
    }

    /**
     * Sends a link to a user that lets them reset their password
     *
     * @param string $email the user's email address
     * @param string $ver the user's verification code
     * @return boolean        TRUE on success and FALSE on failure
     */
    private function sendAdminResetEmail($email, $ver)
    {
        require '../PHPMailer-master/PHPMailerAutoload.php';

        $e = sha1($email); // For verification purposes
        $to = trim($email);

        $reset_link = "http://" . $_SERVER['HTTP_HOST'] . "/admin/resetpassword.php?v=" . $ver . "&e=" . $e;

        $msg = 'Hola,<br/><br/>

Has solicitado un cambio de contrase&‌ntilde;a de tu cuenta en Check Admin.<br/><br/>

Tu usuario es: <b>' . $email . '</b>.<br/><br/>

Para cambiar tu clave, por favor haz <a href="' . $reset_link . '">click aqu&iacute;</a> e ingresa una nueva.<br/><br/>

Si tienes preguntas, m&aacute;ndanos un email a hola@check.pe.<br/><br/>

Saludos,<br/><br/>

El equipo de Check<br/><br/>';

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
        $mail->Host = 'smtp.gmail.com';
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
        $mail->Username = "hola@check.pe";

        //Password to use for SMTP authentication
        $mail->Password = "Markhamperu";

        //Set who the message is to be sent from
        $mail->setFrom('hola@check.pe', 'Check');

        //Set an alternative reply-to address
        $mail->addReplyTo('hola@check.pe', 'Check');

        //Set who the message is to be sent to
        $mail->addAddress($to, '');

        $mail->Subject = 'Restablece tu clave';

        $mail->msgHTML($msg);

        $mail->AltBody = 'Has solicitado un cambio de contraseña para tu cuenta de Check.';

        return $mail->send();
    }

    /**
     * Retrieves the first name of a student.
     *
     * @return mixed    an String or FALSE on failure
     */
    public function getAdminGlobalData()
    {
        $sql = "SELECT *
                FROM admins
                WHERE email=:user";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_SESSION['AdminUsername'], PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            return $row;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Retrieves all students from database
     *
     * @return mixed    an array or FALSE on failure
     */
    public function getAdminData()
    {
        $sql = "SELECT admin_ID, name, email, verified, suspended, permission
                FROM admins
                WHERE email != :user";

        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':user', $_SESSION['AdminUsername'], PDO::PARAM_STR);
            $stmt->execute();

            while ($row = $stmt->fetch()) {
                echo $this->formatAdmins($row);
            }

            $stmt->closeCursor();
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    /**
     * Generates HTML markup for each admin in admin panel
     *
     * @param array $row an array of the current student attributes
     * @return string       the formatted HTML string
     */
    private function formatAdmins($row)
    {
        $adminID = $row['admin_ID'];
        $name = $row['name'];
        $email = $row['email'];
        $verifiedStatus = '';
        $permissionStatus = '';

        if ($row['suspended'] == 1) {
            $verifiedStatus = '<span class="label label-warning">Suspendido</span>';
        } else if ($row['verified'] == 1) {
            $verifiedStatus = '<span class="label label-success">Activo</span>';
        } else if ($row['verified'] == 0) {
            $verifiedStatus = '<span class="label label-primary">Inactivo</span>';
        }

        if ($row['permission'] == 1) {
            $permissionStatus = 'Creador de contenido';
        } else if ($row['permission'] == 2) {
            $permissionStatus = 'Administrador';
        }

        $core = '
        <tr>
          <td>
            <a href="admin.php?id=' . $adminID . '">' . $adminID . '</a>
          </td>
          <td>' . $name . '</td>
          <td>' . $email . '</td>
          <td>' . $verifiedStatus . '</td>
          <td>' . $permissionStatus . '</td>
        </tr>
        ';

        return $core;
    }

    /**
     * Retrieves all admins from database
     *
     * @return mixed    an array or FALSE on failure
     */
    public function getAdminDataById($id)
    {
        $sql = "SELECT *
                FROM admins
                WHERE admin_ID = :aid";
        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':aid', $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();
            return $row;

        } catch (PDOException $e) {
            return FALSE;
        }
    }

    public function getAdminStatus($id)
    {
        $sql = "SELECT verified, suspended
              FROM admins
              WHERE admin_ID = :aid";

        try {
            $stmt = $this->_db->prepare($sql);
            $stmt->bindParam(':aid', $id, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch();
            $stmt->closeCursor();

            if ($row['suspended'] == 1) {
                return 'suspendido';
            } else if ($row['verified'] == 1) {
                return 'activo';
            } else if ($row['verified'] == 0) {
                return 'inactivo';
            }
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    private function sendAdminChangeEmail($old, $new)
    {
        require '../../../PHPMailer-master/PHPMailerAutoload.php';

        $to1 = trim($old);
        $to2 = trim($new);

        $msg = 'Hola,<br/><br/>

Un administrador de Check ha cambiado el correo electr&oacute;nico de tu cuenta.<br/><br/>

Tu antiguo usuario es: <b>' . $old . '</b>.<br/><br/>

Tu nuevo usuario es: <b>' . $new . '</b>.<br/><br/>

Si no solicitaste este cambio, o crees que fue un error, m&aacute;ndanos un email a hola@check.pe.<br/><br/>

Saludos,<br/><br/>

El equipo de Check<br/><br/>';

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        $mail->isSMTP();

        $mail->SMTPDebug = 0;

        $mail->Debugoutput = 'html';

        $mail->Host = 'smtp.gmail.com';
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        $mail->Port = 587;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = "hola@check.pe";

        $mail->Password = "Markhamperu";

        $mail->setFrom('hola@check.pe', 'Check');

        $mail->addReplyTo('hola@check.pe', 'Check');

        // First email

        $mail->addAddress($to1, '');
        $mail->addAddress($to2, '');

        $mail->Subject = 'Cambios importantes a tu cuenta de Check Admin';

        $mail->msgHTML($msg);

        $mail->AltBody = 'Un administrador de Check ha cambiado tu email.';

        return $mail->send();
    }

}


?>
