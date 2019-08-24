<?php
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/base.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/admin/includes/header.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/classes/general.courses.php";
$course=new Course($db);
$courseData=$course->getCourseContentAdmin($_GET['id']);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nuevo curso
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="/admin/index"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Nuevo curso</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <!--row-->
             <div class="row">
            <div class="col-md-12">
              <?php if (!empty($_POST['course_ID'])) {
                  echo $course->saveCourseAdmin();
                  $courseData=$course->getCourseContentAdmin($_GET['id']);
                  }
              ?>
                <!-- general form elements disabled -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos del curso</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form" action="course.php?id=<?php echo $_GET['id'];?>" method="post" name="" id="">
                          <input type="hidden" name="course_ID" value="<?php echo $courseData['courseID'];?>">
                            <div class="form-group">
                                <label>Título</label>
                                <input type="text" name="course_title" class="form-control" required
                                       placeholder="ej. React js, Css3" value="<?php echo $courseData['courseTitle'];?>">
                            </div>
                               <div class="form-group">
                                <label>Descripción</label>
                                <textarea id="editor1" name="course_description"><?php echo $courseData['courseDescription'];?></textarea>
                               </div>
                            <div class="form-group">
                                <label>Imágen</label>
                                <select class="form-control" name="icon" required>
                                  <option value="<?php echo $courseData['icon'];?>" selected><?php echo $courseData['icon'];?></option>
                                    <option value="" disabled >Seleciona</option>
                                    <option value="react">react</option>
                                    <option value="php">PHP</option>
                                    <option value="css3">php</option>
                                    <option value="html5">html5</option>
                                    <option value="javascript">javascript</option>
                                    <option value="jquery">jquery</option>
                                    <option value="other">other</option>
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
