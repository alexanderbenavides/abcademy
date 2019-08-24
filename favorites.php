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

	<!-- SPECIFIC CSS -->
	<link href="css/tables.css" rel="stylesheet">


	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1>Favoritos</h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->

	<main>
		<div class="container margin_60_35">
			<div class="pricing-container cd-has-margins">
			<div class="pricing-switcher">
				<p class="fieldset">
					<input type="radio" name="duration-2" value="monthly" id="monthly-2" checked class="photos_section">
					<label for="monthly-2">Cursos</label>
					<input type="radio" name="duration-2" value="yearly" id="yearly-2" class="videos_section">
					<label for="yearly-2">Lecciones</label>
					<span class="switch"></span>
				</p>
			</div>
		</div>
	</div>
			<!--/pricing-switcher -->

		<div class="container margin_60_35 products_imgs">
			<div class="main_title_3">
				<span></span>
				<h2>Estos son los cursos que te interesa más.</h2>
				<p>Echa un vistazo a los cursos que elegiste como favoritos.</p>
			</div>
			<div class="row add_bottom_30">
			<?php if (!empty($_SESSION['studentLoggedIn'])): ?>
			<aside class="col-lg-4" id="sidebar">
				<div class="box_detail booking">
					<div class="">
						<h5>Información del curso</h5>
					</div>
					<div class="price">
						<h5 class="d-inline">Tutor</h5>
						<div class="score"><span> Alexander Benavides<em>3 reseñas</em></span><strong>4.0★</strong></div>
					</div>
					<div id="message-contact-detail"></div>
					<?php if (!empty($_SESSION['studentLoggedIn'])): ?>
					<section class="container-courses">
							<div class="courses" style="width:100% !important;">
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
				</div>
				<ul class="share-buttons">
					<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Compartir</a></li>
					<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Compartir</a></li>
					<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Compartir</a></li>
				</ul>
			</aside>
			<?php else:?>
			<?php endif; ?>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->

	      <div class="bg_color_1 products_videos" style="display:none;">
			<div class="container margin_60_35">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>Revisa las lecciones que te interesan.</h2>
					<p> Las lecciones que marcaste como interesante puedes revisarlo en este apartado.</p>
				</div>
				<div class="grid-gallery">
					<ul class="magnific-gallery">
						<li>
							<figure>
								<img src="img/gallery/large/pic_4.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="https://vimeo.com/45830194" class="video" title="Video Vimeo">
										<i class="pe-7s-film"></i>
										<p>Video demostrativo</p>
								</a>
								</div>
								</figcaption>
							</figure>
						</li>
				
						<li>
							<figure>
								<img src="img/gallery/large/pic_2.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									 <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video" title="Video Youtube">
										<i class="pe-7s-film"></i>
										<p>Video demostrativo</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
						<li>
							<figure>
								<img src="img/gallery/large/pic_1.jpg" alt="">
								<figcaption>
								<div class="caption-content">
									<a href="https://vimeo.com/45830194" class="video" title="Video Vimeo">
										<i class="pe-7s-film"></i>
										<p>Video demostrativo</p>
									</a>
								</div>
								</figcaption>
							</figure>
						</li>
					</ul>
				</div>
				<!-- /grid -->
			</div>
			<!-- /container -->
		</div>
	<!-- /bg_color_1 -->
	
	</main>
	<!--/main-->


<?php include_once "includes/footer.php"; ?>
