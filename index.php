<?php
$pageTitle = "Inicio";
include_once "managment/base.php";
if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager-main.php";
}
include_once "classes/general.courses.php";
$course = new Course($db);
$courses_filters['course-id'] = "";
$getCoursesArray = $course->getCourses($courses_filters);
$getCoursesByStudent = $course->getCoursesByStudent();
include_once "includes/header.php";
?>
	<main class="pattern">
		<section class="hero_single version_2">
			<div class="wrapper">
				<div class="container">
					<h3>¡Encuentra lo que necesitas!</h3>
					<p>Busca cursos de tecnología que te interesa.</p>
          <div class="">
            <form method="post" action="">
              <div class="row no-gutters custom-search-input-2">
                <div class="col-lg-10">
                  <div class="form-group">
                    <input class="form-control" type="text" placeholder="¿Qué estás buscando?" style="text-align:center;">
                    <i class="icon_search"></i>
                  </div>
                </div>
                <div class="col-lg-2">
                  <input type="submit" value="Buscar">
                </div>
              </div>
              <!-- /row -->
            </form>
          </div>
		  <form method="post" action="">
			<div class="row no-gutters custom-search-input-2">
				<div class="col-lg-6">
					<select class="wide">
						<option>Todas las Categorías</option>
						<option>Desarrollo web</option>
						<option>Desarrollo móvil</option>
						<option>Base de datos</option>
						<option>Fundamentos</option>
					</select>
				</div>
              <div class="col-lg-6">
                <select class="wide">
                  <option>Tipo</option>
                  <option>Gratis</option>
                  <option>de paga</option>
                </select>
              </div>
		</div>
		<!-- /row -->
	  </form>
	</div>
</div>
</section>
<!-- /hero_single -->


		<div class="container margin_60_35">
			<div class="main_title_3">
				<span></span>
				<h2>Aprende a tu propio ritmo</h2>
				<p>Tenemos varios cursos donde puedes aprender mucho sobre tecnología.</p>
			</div>
			<div class="row add_bottom_30">

			<?php if (!empty($_SESSION['studentLoggedIn'])): ?>
  <section class="container-courses">
    <h3 style="text-align:center;margin:0 auto;">Mis cursos</h3>
          <div class="courses">
            <?php
            foreach ($getCoursesByStudent as $key => $getCourse) {
              $getModulesAndTopics = $course->getModulesAndTopics($getCourse->courseID);
              ?>
              <div class="card list-courses">
                <h3><?php echo $getCourse->courseTitle;?></h3>
                <img class="card-img-top" src="/img/<?php echo $getCourse->icon;?>.png" alt="Imagen curso">
                <div class="card-body">
                <small><?php echo $getCourse->courseDescription;?></small>
                </div>
                <a href="/course?id=<?php echo $getCourse->courseID;?>&moduleid=<?php echo $getModulesAndTopics[0]->moduleID;?>&topicid=<?php echo $getModulesAndTopics[0]->topicID;?>" class="btn">Ir al curso</a>
              </div>
          <?php  }
            ?>
        </div>
</section>
<?php endif; ?>
  <section class="container-courses">
  <?php if (!empty($_SESSION['studentLoggedIn'])): ?>
  <h3 style="text-align:center;margin:0 auto;">Otros cursos</h3>
  <?php else:?>
  <h3 style="text-align:center;margin:0 auto;">Revisa todos los cursos</h3>
  <?php endif; ?>
          <div class="courses">
            <?php
            foreach ($getCoursesArray as $key => $getCourse) {?>
              <div class="card list-courses">
                <h3><?php echo $getCourse->courseTitle;?></h3>
                <img class="card-img-top" src="/img/<?php echo $getCourse->icon;?>.png" alt="Imagen curso">
                <div class="card-body">
                <small><?php echo $getCourse->courseDescription;?></small>
                </div>
              <a href="/course-detail?id=<?php echo $getCourse->courseID;?>" class="btn">Ver detalle</a>
              </div>
          <?php }?>
        </div>
</section>			
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
</main>

    <?php include_once "includes/info.php"; ?>
    <?php include_once "includes/footer.php"; ?>
