<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/header.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.modules.php";
$module=new Module($db);
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.topics.php";
$topic=new Topic($db);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nuevo tema
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li><a href="#">Curso</a></li>
        <li><a href="#">Unidad</a></li>
        <li class="active">Nuevo tema</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
             <!--row-->
             <div class="row">

            <div class="col-md-12">
              <?php
                if(!empty($_POST['topic_title'])){
                  echo $topic->addTopicAdmin();
                }
               ?>
                <!-- general form elements disabled -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos del tema</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="add-topic.php" method="post" name="" id="">
                            <div class="form-group">
                                <label>Nombre del tema</label>
                                <input type="text" name="topic_title" class="form-control" required
                                       placeholder="ej. Instalar xampp">
                            </div>
                            <div class="form-group">
                                <label>Curso</label>
                                <select class="form-control" name="course_ID" required onchange="selectOnChange('course_ID')">
                                    <option value="" disabled selected>Seleciona</option>
                                    <?php $module->getCoursesAdmin(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Unidad</label>
                                <select class="form-control" name="module_ID" required disabled>
                                    <option value="" disabled selected>Seleciona</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Contenido del tema</label>
                                <textarea id="editor1" name="topic_content"></textarea>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary pull-right">Crear Tema</button>
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
