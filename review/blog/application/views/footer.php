<?php
  if(strcmp($_SESSION['language1'],'en')==0){
    $contactFooter = "Contact";
    $legal = "Legal";
  }
  else if(strcmp($_SESSION['language1'],'spa')==0){
    $contactFooter = "Contacto";
    $legal = "MENCIONES LEGALES";
  }
  else{
    $contactFooter = "Contact";
    $legal = "MENTIONS LEGALES";

  }
?>


<footer class="footer py-7">
  <div class="container text-center">

    <div class="social social-bg-pale-brand">
      <a class="social-facebook" href="#"><i class="fa fa-facebook"></i></a>
      <a class="social-twitter" href="#"><i class="fa fa-twitter"></i></a>
      <a class="social-instagram" href="#"><i class="fa fa-instagram"></i></a>
    </div>

    <br>

    <div class="nav nav-bolder nav-uppercase nav-center">
      <a class="nav-link" href="#">Services</a>
      <a class="nav-link" href="#"><?php echo $legal;?></a>
      <a class="nav-link" href="#">Blog</a>
      <a class="nav-link" href="#"><?php echo $contactFooter;?></a>
    </div>

    <br>

    <small>&copy; Review Thunder <?php echo date('Y');?>. All rights reserved.</small>

  </div>
</footer><!-- /.footer -->


<!-- Scripts -->
<script src="<?php echo base_url();?>assets/js/page.min.js"></script>
<script src="<?php echo base_url();?>assets/js/script.js"></script>

</body>
</html>
