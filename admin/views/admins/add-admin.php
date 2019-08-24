<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/header-login.php";

$pageTitle = 'Registro';

?>

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="/admin"><b>ABC</b>Admin</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Registra a un nuevo administrador.</p>

    <?php if(!empty($_POST['name'])) {
        include_once $_SERVER["DOCUMENT_ROOT"] .'/classes/class.admin.admins.php';
        $admin = new Admin($db);
        echo $admin->createAccount();
    }
    ?>

    <form action="add-admin.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="name" placeholder="Nombre" required value="<?php if(!empty($_POST['name'])) echo $_POST['name']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="last_name" placeholder="Apellido" required value="<?php if(!empty($_POST['last_name'])) echo $_POST['last_name']; ?>">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Email" required value="<?php if(!empty($_POST['email'])) echo $_POST['email']; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password1" placeholder="Contraseña" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password2" placeholder="Confirmar contraseña" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <select type="text" class="form-control" name="permission" placeholder="Permisos" required>
           <option disabled selected hidden value="">Permisos</option>
           <option value="2">Administrador</option>
           <option value="1">Creador de contenido</option>
        </select>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src=  "/admin/js/bootstrap.min.js"></script>
</body>
</html>
