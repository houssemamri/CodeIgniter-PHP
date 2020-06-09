<?php
  if(strcmp($lang,'en')==0){
    $contactFooter = "Contact";
    $legal = "Legal";
  }
  else if(strcmp($lang,'spa')==0){
    $contactFooter = "Contacto";
    $legal = "MENCIONES LEGALES";
  }
  else{
    $contactFooter = "Contact";
    $legal = "MENTIONS LEGALES";

  }
?>
<!-- Footer -->
  <footer class="footer py-7">
    <div class="container text-center">

      <div class="social social-bg-pale-brand">
        <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
        <a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
        <a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
      </div>

      <br>

      <div class="nav nav-bolder nav-uppercase nav-center">
        <a class="nav-link1" href="#">Services</a>
        <a class="nav-link1" href="#"><?php echo $legal;?></a>
        <a class="nav-link1" href="#">Blog</a>
        <a class="nav-link1" href="#"><?php echo $contactFooter;?></a>
      </div>

      <br>

      <small>&copy; Review Thunder <?php echo date('Y');?>. All rights reserved.</small>

    </div>
  </footer><!-- /.footer -->


	<script>

	function google_token(){
$.ajax({
   url: 'http://review-thunder.com/gbm/examples/refreshtoken.php',
  success: function(data) {

   },
   type: 'GET'
});
}

//every 3 seconds (3000 milliseconds):
	setInterval(function(){ google_token(); },30*60*1000);
	</script>
    <!-- END Footer -->
