<?php
    include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
    $pageTitle = 'Verifica Tu Cuenta';
    include_once "includes/header-login.php";

    if(isset($_GET['v']) && isset($_GET['e']))
    {
      include_once $_SERVER["DOCUMENT_ROOT"] .'/classes/class.admin.admins.php';
        $admin = new Admin($db);
        $ret = $admin->verifyAccount();
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0;/admin/signup.php">';
        exit;
    }
?>

<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="/admin"><b>ABC</b>Admin</a>
  </div>

  <?php
    if(isset($ret)) {
      echo $ret;
    }
  ?>

</div>
<!-- /.center -->

<!-- jQuery 3 -->
<script src="/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/js/bootstrap.min.js"></script>
</body>
</html>
