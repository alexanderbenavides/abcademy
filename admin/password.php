<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
  $pageTitle = 'Restablece Tu Clave';
  include_once "includes/header-login.php";
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/admin"><b>ABC</b>ADEMY</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Ingresa tu correo electrónico y te enviaremos un link para restablecer tu contraseña.</p>

    <?php if(!empty($_POST['username'])) {
      include_once $_SERVER["DOCUMENT_ROOT"] .'/classes/class.admin.admins.php';
        $admins = new Admin($db);
        echo $admins->resetPassword();
    }
    ?>

    <form action="password.php" method="post">
      <div class="form-group has-feedback">
        <input type="email" name="username" class="form-control" placeholder="Email" value="<?php if(!empty($_POST['username'])) echo $_POST['username']; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Restablecer</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/js/bootstrap.min.js"></script>
</body>
</html>
