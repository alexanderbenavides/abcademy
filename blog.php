	<?php 
	$pageTitle = "Inicio";
	include_once "managment/base.php";
	if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1) {
	  include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager-main.php";
	}
	include_once "includes/header.php"; 
	?>
	<main class="pattern">
    <div class="bg_color_1">
			<div class="container margin_60_35">
				<div class="main_title_2">
					<span><em></em></span>
					<h2>Revisa algunos videos que subio el vendedor</h2>
					<p> Los vendedores suben videos con la finalidad de explicar su productos.</p>
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
    <?php include_once "includes/footer.php"; ?>
