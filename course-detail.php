<?php
$pageTitle = "Inicio";
include_once "managment/base.php";
if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager-main.php";
}
if(!isset($_GET['id'])){
	echo "<meta http-equiv='refresh' content='0;/index'>";

}


include_once "classes/general.courses.php";
$course = new Course($db);
$courses_filters['course-id'] = $_GET['id'];
$getCoursesByStudent = $course->getCourses($courses_filters);


include_once "classes/class.teachers.php";
$teacher = new Teacher($db);
$teacher_filters['course-id'] = $_GET['id'];
$teacherData = $teacher->getTeacherByCourse($teacher_filters);

include_once "includes/header.php";
?>	
   <main>
		<nav class="secondary_nav sticky_horizontal_2">
			<div class="container">
				<ul class="clearfix">
					<li><a href="#description" class="active">Descripción</a></li>
					<li><a href="#reviews">Reseñas</a></li>
					<li><a href="#sidebar">Contactar</a></li>
				</ul>
			</div>
		</nav>

		<div class="container margin_60_35">
			<div class="row">
				
			<aside class="col-lg-4" id="sidebar">
						<div class="box_detail booking">
							<div class="">
								<h5>Información del curso</h5>
							</div>
							<div class="price">
								<h5 class="d-inline">Tutor</h5>
								<div class="score"><span> <?php echo $teacherData[0]->firstName;?> <?php echo $teacherData[0]->lastName;?><em>3 reseñas</em></span><strong>4.0★</strong></div>
							</div>
							<div id="message-contact-detail"></div>
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
						</div>
						<ul class="share-buttons">
							<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Compartir</a></li>
							<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Compartir</a></li>
							<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Compartir</a></li>
						</ul>
					</aside>


					<div class="col-lg-6 col-md-12">
							<ul class="menu_list">
									<li>
										fff<p>ffff</p>
									</li>
									
									<li>
										<a href="#" class="btn_1 small-width"><i class="icon_heart"></i> Me gusta</a>
										<a href="#" class="btn_1 small-width"><i class="icon_star"></i> Añadir a favoritos</a>
									</li>
							</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<section id="description">
							<div class="detail_title_1">
								<h5 class="add_bottom_15">Detalles</h5>
							</div>
							<!-- /row -->
	
						<!--	<h3>Location</h3>
							<div id="map" class="map map_single add_bottom_45"></div>-->
							<!-- End Map -->
						</section>
						<!-- /section -->

						<section id="reviews">
							<h2>Reseña/comentarios</h2>
							<div class="reviews-container add_bottom_30">
								<div class="row">
									<div class="col-lg-3">
										<div id="review_summary">
											<strong>4.5</strong>
											<em>estrellas</em>
											<small>Basado en 3 opiniones</small>
										</div>
									</div>
									<div class="col-lg-9">
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 90%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>5 estrellas</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>4 estrellas</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>3 estrellas</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>2 estrellas</strong></small></div>
										</div>
										<!-- /row -->
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: 0" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong>1 estrellas</strong></small></div>
										</div>
										<!-- /row -->
									</div>
								</div>
								<!-- /row -->
							</div>

							<div class="reviews-container">

								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Jose – April 03, 2016:
										</div>
										<div class="rev-text">
											<p>
												Excelente camiseta, muy buena atencion por parte del  vendedor.
											</p>
										</div>
									</div>
								</div>
								<!-- /review-box -->
								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar2.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Ahsan – April 01, 2018:
										</div>
										<div class="rev-text">
											<p>
												Excelente camiseta, muy buena atencion por parte del  vendedor.
											</p>
										</div>
									</div>
								</div>
								<!-- /review-box -->
								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="img/avatar3.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rating">
											<i class="icon-star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star voted"></i><i class="icon_star"></i>
										</div>
										<div class="rev-info">
											Sara – March 31, 2019:
										</div>
										<div class="rev-text">
											<p>
												Excelente camiseta, muy buena atencion por parte del  vendedor.
											</p>
										</div>
									</div>
								</div>
								<!-- /review-box -->
							</div>
							<!-- /review-container -->
						</section>
						<!-- /section -->
						<hr>

							<div class="add-review">
								<h5>Déjanos tus comentarios</h5>
								<form action="/course-detail?id=<?php echo $_GET['id'];?>" metod="GET">
									<div class="row">
										<div class="form-group col-md-6">
											<label>Valorar producto*</label>
											<div class="custom-select-form">
												<p class="clasificacion">
												    <input id="radio1" type="radio" name="estrellas" value="1"><!--
												    --><label for="radio1">★</label><!--
												    --><input id="radio2" type="radio" name="estrellas" value="2"><!--
												    --><label for="radio2">★</label><!--
												    --><input id="radio3" type="radio" name="estrellas" value="3"><!--
												    --><label for="radio3">★</label><!--
												    --><input id="radio4" type="radio" name="estrellas" value="4"><!--
												    --><label for="radio4">★</label><!--
												    --><input id="radio5" type="radio" name="estrellas" value="5"><!--
												    --><label for="radio5">★</label>
												  </p>
											</div>
										</div>
										<div class="form-group col-md-12">
											<label>Reseña /comentario*</label>
											<textarea name="review_text" id="review_text" class="form-control" style="height:130px;"></textarea>
										</div>
										<div class="form-group col-md-12 add_top_20 add_bottom_30">
											<input type="submit" value="Publicar comentario" class="btn_1" id="submit-review">
										</div>
									</div>
								</form>
							</div>
					</div>
					<!-- /col -->


				</div>
				<!-- /row -->
		</div>
		<!-- /container -->

	</main>
	<!--/main-->
<?php include_once "includes/footer.php" ?>
