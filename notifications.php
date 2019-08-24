<?php
$pageTitle = "Inicio";
include_once "managment/base.php";
if (!empty($_SESSION['studentLoggedIn']) && !empty($_SESSION['studentUsername']) && $_SESSION['studentLoggedIn'] == 1) {
  include_once $_SERVER["DOCUMENT_ROOT"] . "/managment/sessionmanager-main.php";
}
include_once "includes/header.php";

?>
	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1>Revisa tus notificaciones</h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->

	<main>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-12" id="faq">
					<h4 class="nomargin_top">Revisa todas las notificaciones</h4>
					<div role="tablist" class="add_bottom_45 accordion_2" id="tips">
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a data-toggle="collapse" href="#collapseOne_tips" aria-expanded="true"><i class="indicator ti-plus"></i>Notificación 1</a>
								</h5>
							</div>

							<div id="collapseOne_tips" class="collapse" role="tabpanel" data-parent="#tips">
								<div class="card-body">
									<p>Para mantenerte al tanto debes de estar alerta a la sección de favoritos y notificaciones.</p>
								</div>
							</div>
						</div>
						<!-- /card -->
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseTwo_tips" aria-expanded="false">
										<i class="indicator ti-plus"></i>Notificación 2
									</a>
								</h5>
							</div>
							<div id="collapseTwo_tips" class="collapse" role="tabpanel" data-parent="#tips">
								<div class="card-body">
                  <p>La sección favoritos solo aparecerá si le das seguir al perfil de un vendedor.</p>
								</div>
							</div>
						</div>
						<!-- /card -->
						<div class="card">
							<div class="card-header" role="tab">
								<h5 class="mb-0">
									<a class="collapsed" data-toggle="collapse" href="#collapseThree_tips" aria-expanded="false">
										<i class="indicator ti-plus"></i>Notificación 3
									</a>
								</h5>
							</div>
							<div id="collapseThree_tips" class="collapse" role="tabpanel" data-parent="#tips">
								<div class="card-body">
									<p>Si has dado seguir y/o me encanta al perfil de un vendedor, cada vez que publique un producto nuevo te llegará una notificación. Si deseas silenciar las notificaciones lo puedes hacer en cualquier momento, seleccionando la opción silenciar.</p>
								</div>
							</div>
						</div>
						<!-- /card -->
					</div>
					<!-- /accordion suggestions -->
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->
		</div>
		<!--/container-->
	</main>
	<!--/main-->
<?php include_once "includes/footer.php"; ?>
