<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Abcademy - Premium directory and listings template by Ansonika.">
    <meta name="author" content="Ansonika">
    <title><?php if(!empty($pageTitle)) echo $pageTitle . " - "; ?>ABC<?php if(empty($pageTitle)) echo " – Alexander Benavides"; ?></title>  <meta name="description" content="">
    <!-- Favicons-->
    <link rel="shortcut icon" href="img/logo_sticky.png" type="image/x-icon">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	  <link href="css/vendors.css" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

    <!-- YOUR CUSTOM CSS -->
    <link href="css/custom.css" rel="stylesheet">

</head>

<body>

	<div id="page">
    <header class="header menu_fixed">
      <div id="logo">
        <a href="/index" title="Abcademy - Directory and listings template">
          <img src="img/logo.png" width="165" height="35" alt="" class="logo_normal">
          <img src="img/logo_sticky.png" width="165" height="35" alt="" class="logo_sticky">
        </a>
      </div>
      <ul id="top_menu">
      <?php if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1): ?>
      <li><a href="/logout"  class="login" title="Cerrar sesión">Cerrar sesión</a></li>
      <?php else: ?>
      <li><a href="/register" class="btn_add">Registrarse</a></li>
      <li><a href="/login"  class="login" title="Iniciar sesión">Iniciar sesión</a></li>
      <?php endif; ?>
      </ul>
      <!-- /top_menu -->
      <a href="#menu" class="btn_mobile">
        <div class="hamburger hamburger--spin" id="hamburger">
          <div class="hamburger-box">
            <div class="hamburger-inner"></div>
          </div>
        </div>
      </a>
      <nav id="menu" class="main-menu">
        <ul>
          <li><span><a href="/index">Inicio</a></span></li>
          <?php if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1): ?>
          <li><span><a href="/account">Mi perfil</a></span></li>
          <li><span><a href="/favorites">Favoritos</a></span></li>          
          <li><span><a href="/notifications">Notificaciones</a></span></li>
          <?php endif; ?>
          <li><span><a href="/blog">Blog</a></span></li>
          <li><span><a href="/portafolio/cv" target="_blank">Portafolio</a></span></li>
        </ul>
      </nav>
    </header>
    <!-- /header -->
