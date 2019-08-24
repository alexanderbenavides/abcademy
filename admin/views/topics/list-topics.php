<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/header.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.topics.php";
$topic=new Topic($bd);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Lista de  temas
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="box" style="min-height:100vh;">
        <div class="row">
          <div class="col-sm-12">
                <table class="table table-bordered" id="example1">
                  <thead>
                    <tr>
                      <th scope="col">C&oacute;digo</th>
                      <th scope="col">T&iacute;tulo</th>
                      <th scope="col">Curso</th>
                      <th scope="col">Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $topic->getTopicsListAdmin(); ?>
                  </tbody>
                </table>
             </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/footer.php";?>
