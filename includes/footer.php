<?php 
include_once "managment/base.php";
include_once "classes/general.courses.php";
$course = new Course($db);
$categories = $course->getCategories();
?>
<footer class="plus_border" style="">
  <div class="container margin_60_35">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <h3 data-target="#collapse_ft_1">Enlaces rápidos</h3>
        <div class="collapse dont-collapse-sm" id="collapse_ft_1">
          <ul class="links">
            <li><a href="/about">Acerca de nostros </a></li>
            <li><a href="/faq">Preguntas frecuentes</a></li>
            <li><a href="/account">Mi cuenta</a></li>
            <li><a href="/register">Registrarse</a></li>
            <li><a href="/contacts">Contáctanos</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <h3 data-target="#collapse_ft_2">Categorías</h3>
        <div class="collapse dont-collapse-sm" id="collapse_ft_2">
          <ul class="links">
          <?php
            foreach ($categories as $key => $category) {
              ?>
            <li><a href="#"><?php echo $category->categoryName;?></a></li>
           <?php  }
            ?>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <h3 data-target="#collapse_ft_3">Contacto</h3>
        <div class="collapse dont-collapse-sm" id="collapse_ft_3">
          <ul class="contacts">
            <li><i class="ti-home"></i>Lima<br>Perú</li>
            <li><i class="ti-headphone-alt"></i>+51 9882239318</li>
            <li><i class="ti-email"></i><a href="#0">info@Abcademy.com</a></li>
          </ul>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <h3 data-target="#collapse_ft_4">Contactar con Abcademy</h3>
        <div class="collapse dont-collapse-sm" id="collapse_ft_4">
          <div id="newsletter">
            <div id="message-newsletter"></div>
            <form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
              <div class="form-group">
                <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Tu correo">
                <input type="submit" value="Enviar" id="submit-newsletter">
              </div>
            </form>
          </div>
          <div class="follow_us">
            <h5>Síguenos</h5>
            <ul>
              <li><a href="#"><i class="ti-facebook"></i></a></li>
              <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
              <li><a href="#"><i class="ti-google"></i></a></li>
              <li><a href="#"><i class="ti-pinterest"></i></a></li>
              <li><a href="#"><i class="ti-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- /row-->
    <hr>
    <div class="row">
      <div class="col-lg-6">
        <ul id="additional_links">
          <li><span>© 2019 Abcademy</span></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<!--/footer-->

</div>
<!-- page -->

<!-- COMMON SCRIPTS -->
  <script src="js/common_scripts.js"></script>
<script src="js/functions.js"></script>
<script src="assets/validate.js"></script>

</body>
</html>
