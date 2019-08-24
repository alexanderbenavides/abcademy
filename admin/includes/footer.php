
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b>1
    </div>
    <strong>Copyright &copy; 2019 <a href="index">Alexander</a>.</strong> All rights
    reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="/admin/js/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="/admin/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/admin/js/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/js/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/js/adminlte.min.js"></script>
<!--Init ckeditor-->
<script src="/admin/ckeditor/ckeditor.js"></script>
<!--ajax request-->
<script src="/admin/js/ajax-request.js"></script>
<!--main js admin-->
<script src="/admin/js/main.js"></script>

<!-- page script -->
   <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        CKEDITOR.replace('editor1', {
    			extraPlugins: 'embed,autoembed,mathjax,uploadimage,image',
    			embed_provider: '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
    		});
</script>

</body>
</html>
