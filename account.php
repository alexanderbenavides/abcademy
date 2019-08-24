<?php 
$pageTitle = "Inicio";
include_once "managment/base.php";
if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager-main.php";

}
include_once "classes/class.students.php";
$student = new Student($db);
$student_filters['email-user'] = $_SESSION['studentUsername'];
$studentData = $student -> getStudentData($student_filters);

include_once "includes/header.php"; 
?>
	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1>Mi cuenta</h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->

	<main>
		<div class="container margin_60">
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Mi información</h3>
					<div class="form_container">
						<div class="row no-gutters">
							<div class="col-lg-6 pr-lg-1">
								<img src="img/avatar3.jpg" alt="">
							</div>
						</div>
						<br>
							<p>Nombre: <?php echo $studentData[0]->firstName.' '.$studentData[0]->lastName;?></p>
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>

		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
<?php include_once "includes/footer.php"; ?>
