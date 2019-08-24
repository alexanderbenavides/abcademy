<?php
  include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
  if(!(isset($_SESSION['AdminLoggedIn']) && isset($_SESSION['AdminUsername']) && $_SESSION['AdminLoggedIn']==1)){
    echo "<meta http-equiv='refresh' content='0;/admin/login.php'>";
    exit;
  }
 $pageTitle = 'Login';
 include_once "includes/header.php";
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box" style="min-height:100vh;">
        <div class="box-header">
          <h3 class="box-title center">Admin</h3>
          <?php echo$_SESSION['AdminUsername'];
           ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once "includes/footer.php"; ?>
