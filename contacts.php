<?php include_once "includes/header.php"; ?>
	<div class="sub_header_in sticky_header">
		<div class="container">
			<h1>Contacto Abcademy</h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->

	<main>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19864.623539539858!2d-0.1407216728393208!3d51.51178603603532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604cb878e81b3%3A0x91f10fa364452046!2sCovent+Garden%2C+Londra+WC2E+8BG%2C+Regno+Unito!5e0!3m2!1sit!2ses!4v1538380105649" width="600" height="450" allowfullscreen id="map_iframe"></iframe>
		<!-- /map -->
		<div class="container margin_60_35">
			<div class="row justify-content-center">

				<div class="col-xl-5 col-lg-6 pr-xl-5">
					<div class="main_title_3">
						<span></span>
						<h2>Envíanos un mensaje</h2>
						<p>Contáctanos con nosotros si deseas más información.</p>
					</div>
					<div id="message-contact"></div>
					<form method="post" action="assets/contact.php" id="contactform" autocomplete="off">
						<div class="form-group">
							<label>Nombre</label>
							<input class="form-control" type="text" id="name_contact" name="name_contact">
						</div>
						<div class="form-group">
							<label>Apellidos</label>
							<input class="form-control" type="text" id="lastname_contact" name="lastname_contact">
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Email</label>
									<input class="form-control" type="email" id="email_contact" name="email_contact">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Teléfono</label>
									<input class="form-control" type="text" id="phone_contact" name="phone_contact">
								</div>
							</div>
						</div>
						<!-- /row -->
						<div class="form-group">
							<label>Mensaje</label>
							<textarea class="form-control" id="message_contact" name="message_contact" style="height:120px;"></textarea>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>¿ Eres huamno ? 3 + 1 =</label>
									<input class="form-control" type="text" id="verify_contact" name="verify_contact">
								</div>
							</div>
						</div>
						<p class="add_top_30"><input type="submit" value="Enviar" class="btn_1" id="submit-contact"></p>
					</form>
				</div>
				<div class="col-xl-5 col-lg-6 pl-xl-5">
					<div class="box_contacts">
						<i class="ti-support"></i>
						<h2>¿ Necesitas ayuda ?</h2>
						<a href="#0">43 4324265622</a> - <a href="#0">help@Abcademy.com</a>
					</div>
					<div class="box_contacts">
						<i class="ti-help-alt"></i>
						<h2>¿ Preguntas ?</h2>
						<a href="#0">43 324242322</a> - <a href="#0">info@Abcademy.com</a>
					</div>
					<div class="box_contacts">
						<i class="ti-home"></i>
						<h2>Dirección</h2>
						<a href="#0">San Juan de Miraflores-Lima<br>Perú.</a>
					</div>
				</div>
			</div>
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
<?php include_once "includes/footer.php"; ?>
