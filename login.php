<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";

    if(!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn']==1){
        echo "<meta http-equiv='refresh' content='0;/".$_GET['redir']."'>";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Abcademy - Premium directory and listings template by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>Abcademy | Iniciar sesión.</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/logo_sticky.png" type="image/x-icon">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body id="login_bg">

	<nav id="menu" class="fake_menu"></nav>

	<div id="login">
		<aside>
			<figure>
				<a href="/index"><img src="img/logo_sticky.png" width="165" height="35" alt="" class="logo_sticky"></a>
			</figure>
			  <form action="/login" method="post">
			  <div class="">
          <?php
          if(isset($_GET['redir'])) {
            echo '<div class="callout callout-info">
            <h4><i class="icon fa fa-ban"></i> Permiso requerido</h4>
            Debes iniciar sesión antes de acceder a esta página.
            </div>
            <input type="text" hidden name="redir" value="' . $_GET['redir'] . '">';
          } else if (isset($_POST['redir'])) {
            echo '<input type="text" hidden name="redir" value="' . $_POST['redir'] . '">';
          } else if(isset($_GET['logout'])) {
            echo '<div class="callout callout-info">
            <h4><i class="icon fa fa-check"></i> Log out</h4>
            Se ha cerrado tu sesión
            </div>';
          }

          if(!empty($_POST['username']) && !empty($_POST['password'])):
            include_once $_SERVER["DOCUMENT_ROOT"] .'/classes/class.admin.admins.php';
            $admin = new Admin($db);
            if($admin->accountLoginStudent()===TRUE):
              if(empty($_POST['redir'])) {
                echo "<meta http-equiv='refresh' content='0;/index'>";
                exit;
              } else {
                echo "<meta http-equiv='refresh' content='0;" . urldecode($_POST['redir']) . "'>";
                exit;
              }
            else:
              ?>
              <div class="callout callout-danger">
                <h4><i class="icon fa fa-ban"></i> Error</h4>
                No pudimos iniciar sesión con esos datos.
              </div>
              <?php
            endif;
          endif;
          ?>
        </div>
				<div class="access_social">
					<a href="#" class="social_bt facebook">Iniciar sesión con Facebook</a>
					<a href="#" class="social_bt google">Iniciar sesión con Google</a>
				</div>
				<div class="divider"><span>Or</span></div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="username" id="email">
					<i class="icon_mail_alt"></i>
				</div>
				<div class="form-group">
					<label>Contraseña</label>
					<input type="password" class="form-control" name="password" id="password" value="">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="clearfix add_bottom_30">
					<div class="checkboxes float-left">
						<label class="container_check">Recordar contraseña
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">¿Olvidó su contraseña?</a></div>
				</div>
				<input type="submit" id="signup" class="form-control" name="signup" value="Iniciar sesión" style="background-color:#34b3a0;color:#ffffff;">
				<div class="text-center add_top_10">¿Nuevo en Abcademy? <strong><a href="/register">Registrarse!</a></strong></div>
			</form>
			<div class="copy">© 2019 Abcademy</div>
		</aside>
	</div>
	<!-- /login -->

	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.js"></script>
	<script src="js/functions.js"></script>
	<script src="assets/validate.js"></script>

</body>
</html>
