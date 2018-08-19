</div>
<footer class="footer sticky-bottom">
  <div class="footer-copyright py-3">© 2018 Copyright:</div>
</footer>
<script type="text/javascript" src="<?php echo base_url("assets/vendor/bootstrap/js/jquery-3.3.1.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/vendor/bootstrap/js/bootstrap.min.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/main.js"); ?>"></script>
<script type="text/javascript">
  var texteditor = document.getElementsByName('text');
  if(texteditor.length){
    CKEDITOR.replace( texteditor[0] );
  }
</script>
