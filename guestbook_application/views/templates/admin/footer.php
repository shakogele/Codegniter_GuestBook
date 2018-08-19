</div>
<footer class="footer sticky-bottom">
  <div class="footer-copyright py-3">© 2018 Copyright:</div>
</footer>
<script src="<?php echo base_url("assets/vendor/bootstrap/js/jquery-3.3.1.min.js"); ?>"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url("assets/vendor/bootstrap3/js/bootstrap.min.js"); ?>"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url("assets/vendor/metisMenu/metisMenu.min.js"); ?>"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url("assets/sb-admin/js/sb-admin-2.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/main.js"); ?>"></script>
<script type="text/javascript">
  var texteditor = document.getElementsByName('text');
  if(texteditor.length){
    CKEDITOR.replace( texteditor[0] );
  }
</script>
</body>
