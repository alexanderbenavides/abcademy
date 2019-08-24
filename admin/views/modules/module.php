<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/header.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.modules.php";
$module=new Module($db);
$moduleData=$module->getModuleContentAdmin($_GET['id']);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nueva unidad
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Curso</a></li>
        <li class="active">Nueva unidad</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
         <!--row-->
             <div class="row">

            <div class="col-md-12">
              <?php if (!empty($_POST['module_ID'])) {
                  echo $module->saveModuleAdmin();
                  $moduleData=$module->getModuleContentAdmin($_GET['id']);
                  }
              ?>
                <!-- general form elements disabled -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos de la unidad</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="module.php?id=<?php echo $_GET['id']; ?>" method="post" name="" id="">
                          <input type="hidden" name="module_ID" value="<?php echo $moduleData['moduleID']; ?>">
                            <div class="form-group">
                                <label>Nombre de la unidad</label>
                                <input type="text" name="module_title" class="form-control" required
                                       placeholder="ej. Introducción a PHP" value="<?php echo $moduleData['moduleTitle']; ?>">
                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                                <select class="form-control" name="course_ID" required>
                                  <option value="<?php echo $moduleData['courseID']; ?>"  selected><?php echo $moduleData['courseTitle']; ?></option>
                                  <option value="" disabled>Seleciona</option>
                                    <?php $module->getCoursesAdmin(); ?>
                                </select>
                            </div>
                            <div class="box-footer">
                                <button type="submit" name="save_button" class="btn btn-primary pull-right">Guardar</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/footer.php";?>
