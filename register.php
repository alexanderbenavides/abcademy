<?php
$pageTitle = "Inicio";
include_once "managment/base.php";
include_once "classes/class.students.php";
$student = new Student($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Abcademy - Premium directory and listings template by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>Abcademy | Registro.</title>

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

<body id="register_bg">

	<nav id="menu" class="fake_menu"></nav>
	   

	   <?php if (!empty($_POST['email'])) {
			echo $student->createAccount();
		}
		?>

	<div id="login">
		<aside>
			<figure>
				<a href="/index"><img src="img/logo_sticky.png" width="165" height="35" alt="" class="logo_sticky"></a>
			</figure>
			
			<form  action="/register" method="POST">
        <div class="access_social">
          <a href="#" class="social_bt facebook">  Registrarse con Facebook</a>
          <a href="#" class="social_bt google">  Registrarse con Google</a>
        </div>

        <div class="divider"><span>O</span></div>

				<div class="form-group">
					<label>Nombres</label>
					<input class="form-control" type="text" name="name">
					<i class="ti-user"></i>
				</div>
				<div class="form-group">
					<label>Apellidos</label>
					<input class="form-control" type="text" name="last_name">
					<i class="ti-user"></i>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input class="form-control" type="email" name="email">
					<i class="icon_mail_alt"></i>
				</div>
				<div class="form-group">
					<label>Contraseña</label>
					<input class="form-control" type="password" id="password1" name="password1">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="form-group">
					<label>Confirma tu contraseña</label>
					<input class="form-control" type="password" id="password2" name="password2">
					<i class="icon_lock_alt"></i>
				</div>
				<div id="pass-info" class="clearfix"></div>
				<input type="submit" class="btn_1 rounded full-width add_top_30" value="Registrar">
				<div class="text-center add_top_10">¿Ya tienes una cuenta? <strong><a href="/login">Iniciar sesión</a></strong></div>
			</form>
			<div class="copy">© 2019 Abcademy</div>
		</aside>
	</div>
	<!-- /login -->

	<!-- COMMON SCRIPTS -->
    <script src="js/common_scripts.js"></script>
	<script src="js/functions.js"></script>
	<script src="assets/validate.js"></script>

	<!-- SPECIFIC SCRIPTS -->
	<script src="js/pw_strenght.js"></script>

</body>
</html>
