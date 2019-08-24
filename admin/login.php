<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";

    if(!empty($_SESSION['AdminLoggedIn']) && !empty($_SESSION['AdminUsername']) && $_SESSION['AdminLoggedIn']==1){
        echo "<meta http-equiv='refresh' content='0;/admin'>";
        exit;
    }

    $pageTitle = 'Login';
    include_once "includes/header-login.php";
?>

<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/admin"><b>ABC</b>ADEMY</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <form action="login.php" method="post">
      <?php
            if(isset($_GET['redir'])) {
                echo '<div class="callout callout-info">
                        <h4><i class="icon fa fa-ban"></i> Permiso requerido</h4>
                        Debes hacer log in antes de acceder a esta página.
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
              if($admin->accountLogin()===TRUE):
                    if(empty($_POST['redir'])) {
                      echo "<meta http-equiv='refresh' content='0;/admin'>";
                      exit;
                    } else {
                      echo "<meta http-equiv='refresh' content='0;" . urldecode($_POST['redir']) . "'>";
                      exit;
                    }
              else:
        ?>
                <div class="callout callout-danger">
                      <h4><i class="icon fa fa-ban"></i> Error</h4>
                      No pudimos hacer log in con esos datos.
                </div>
        <?php
              endif;
            endif;
        ?>

      <div class="form-group has-feedback">
        <label>Email</label>
        <input type="email" name="username" class="form-control">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <label>Contraseña</label>
        <input type="password" name="password" class="form-control">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <a href="password.php">¿Olvidaste tu contraseña?</a><br>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Acceder</button>
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
