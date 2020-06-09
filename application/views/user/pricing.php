
<!DOCTYPE html>
<html lang="en" xmlns="w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" xmlns:og="http://ogp.me/ns#">
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-16">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="author" content="Review Thunder" />
    <meta name="description" content="Review Thunder" />
  <meta name="keywords" content="" />
 
  <title>Thunder Review </title>
 

  <!-- Styles -->
  <link href="https://review-thunder.com/css/core.min.css" rel="stylesheet" />
  <link href="https://review-thunder.com/css/thesaas.css" rel="stylesheet" />
  <link href="https://review-thunder.com/css/style.css" rel="stylesheet" />
  <style>
    .nav-outline .nav-main:hover, .nav-outline .nav-main.active {
      color: #fff;
      background-color: #cd0a62;
    }
    .nav-outline .nav-link {
      border: 1px solid #cdcd !important;
    }
    .nav-outline .nav-category:hover, .nav-outline .nav-category.active {
      color: #fff;
      background-color: #3a97f9;
    }
    .tooltip {
    padding: 10px 19px !important;
}



hr.hr-line {
    height: 1px;
    border: 0;
    width: 7%;
    background: #333;
    margin-top: 0;
    margin-bottom: 15px;
}
.row.mt-50.text-center.fea-img img {
    width: 90px;
    height: 89px;
    margin-top: 30px;
}
.row.mt-50.text-center.fea-img p {
    margin-bottom: 3px;
}	
h1.text-center.mt-50.fontstyle{
	font-family: raleway;
}
.fw-600 {
    font-weight: 600!important;
}
</style>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="https://review-thunder.com/img/apple-touch-icon.png" />
  <link rel="icon" href="https://review-thunder.com/img/favicon.png" />
	<!--Alertify JS link-->
	<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<!--<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/bootstrap.min.css"/>-->

	
</head>

<body>

  
  
  <?php 
  
  if(isset($_SESSION['user_status']) && isset($_SESSION['user_id']) && $_SESSION['user_status'] != '' && $_SESSION['user_id'] != ''){
  include('navbar.php');
}else{
	include('navbar_guest.php');
}
  
  ?>
  <!-- Header -->
  <header class="header header-inverse bg-fixed" style="background-image: url(https://review-thunder.com/img/bg-laptop.jpg)">
    <div class="container text-center">

      <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">

          <h1>
             Pricing </h1>
          <p class="fs-18 opacity-100" id="subHeader"></p>
        </div>
      </div>

    </div>
  </header>
  <!-- END Header -->




  <!-- Main container -->
  <main class="main-content">
    <section class="bg-white">
          <div class="container">
                      <div class="row">                    
                        <div class="col-md-12 text-center">
							<h1 class="text-center mt-50 fontstyle">"<?php echo $features;?>"</h1>
				              <hr class="hr-line">
				             	<p><?php echo $features_below_text;?></p>
				             	
				             	<div class="row mt-50 text-center fea-img">
				             		<div class="col-md-3">
						              <img src="../upload_media/1.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $billions_of_possibilities;?></p>
						              <p><?php echo $billions_of_possibilities_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/2.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $main_review_sites_sector;?></p>
						              <p><?php echo $main_review_sites_sector_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/3.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $customize_our_texts;?></p>
						              <p><?php echo $customize_our_texts_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/4.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $add_your_texts;?></p>
						              <p><?php echo $add_your_texts_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/5.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $customize_everything;?></p>
						              <p><?php echo $customize_everything_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/6.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $contact_management;?></p>
						              <p><?php echo $contact_management_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/7.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $answer_directly;?></p>
						              <p><?php echo $answer_directly_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/8.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $email_templates;?></p>
						              <p><?php echo $email_templates_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/9.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $send_emails;?></p>
						              <p><?php echo $send_emails_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/10.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $send_text_messages;?></p>
						              <p><?php echo $send_text_messages_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/11.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $advices;?></p>
						              <p><?php echo $advices_text;?></p>
						            </div>
						            <div class="col-md-3">
						              <img src="../upload_media/12.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $video_reviews;?></p>
						              <p><?php echo $video_reviews_text;?></p>
						            </div>
				             	</div>
				             	<div class="row mt-50 text-center mb-30">
				             	<div class="col-md-3">
				             	<a onclick="oneMonth()" href="javascript:void(0)">
				             	<form id="form1" action="https://www.sandbox.paypal.com/cgi-bin/webscr"
method="post" target="_top">
<input type='hidden' name='business'
value='sanjib@desuntechnology.in'>
<input type='hidden' name='item_name' value='Regular'>
<input type='hidden' name='item_number' value='REG#N1'>
<input type='hidden' name='amount' value='59'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='INR'>
<input type='hidden' name='custom' value='custom_name=<?php echo $_SESSION['username']; ?>&custom_email=<?php echo $_SESSION['user_email']; ?>'>
<input type='hidden' name='notify_url'
value='https://review-thunder.com/Paypal/notify.php'>
<input type='hidden' name='cancel_return'
value='https://review-thunder.com/Paypal/cancel.php'>
<input type='hidden' name='return'
value='https://review-thunder.com/Paypal/return.php'>
<input type="hidden" name="cmd" value="_xclick">
</form>
				             	
				             	<img src="../upload_media/t1.png" alt=""></a></div>
				             	<div class="col-md-3">
				             	<a onclick="threeMonth()" href="javascript:void(0)">
<form id="form2" action="https://www.sandbox.paypal.com/cgi-bin/webscr"
method="post" target="_top">
<input type='hidden' name='business'
value='sanjib@desuntechnology.in'>
<input type='hidden' name='item_name' value='Regular'>
<input type='hidden' name='item_number' value='REG#N1'>
<input type='hidden' name='amount' value='55'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='INR'>
<input type='hidden' name='custom' value='custom_name=<?php echo $_SESSION['username']; ?>&custom_email=<?php echo $_SESSION['user_email']; ?>'>
<input type='hidden' name='notify_url'
value='https://review-thunder.com/Paypal/notify.php'>
<input type='hidden' name='cancel_return'
value='https://review-thunder.com/Paypal/cancel.php'>
<input type='hidden' name='return'
value='https://review-thunder.com/Paypal/return.php'>
<input type="hidden" name="cmd" value="_xclick">
</form>
				             	<img  src="../upload_media/t2.png" alt=""></a></div>
				             	<div class="col-md-3">
<a onclick="sixMonth()" href="javascript:void(0)">
<form id="form3" action="https://www.sandbox.paypal.com/cgi-bin/webscr"
method="post" target="_top">
<input type='hidden' name='business'
value='sanjib@desuntechnology.in'>
<input type='hidden' name='item_name' value='Regular'>
<input type='hidden' name='item_number' value='REG#N1'>
<input type='hidden' name='amount' value='49'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='INR'>
<input type='hidden' name='custom' value='custom_name=<?php echo $_SESSION['username']; ?>&custom_email=<?php echo $_SESSION['user_email']; ?>'>
<input type='hidden' name='notify_url'
value='https://review-thunder.com/Paypal/notify.php'>
<input type='hidden' name='cancel_return'
value='https://review-thunder.com/Paypal/cancel.php'>
<input type='hidden' name='return'
value='https://review-thunder.com/Paypal/return.php'>
<input type="hidden" name="cmd" value="_xclick">
</form>				             	
				             	<img src="../upload_media/t3.png" alt=""></a></div>
				             	<div class="col-md-3">
				             		<a onclick="twelveMonth()" href="javascript:void(0)">
<form id="form4" action="https://www.sandbox.paypal.com/cgi-bin/webscr"
method="post" target="_top">
<input type='hidden' name='business'
value='sanjib@desuntechnology.in'>
<input type='hidden' name='item_name' value='Regular'>
<input type='hidden' name='item_number' value='REG#N1'>
<input type='hidden' name='amount' value='39'>
<input type='hidden' name='no_shipping' value='1'>
<input type='hidden' name='currency_code' value='INR'>
<input type='hidden' name='custom' value='custom_name=<?php echo $_SESSION['username']; ?>&custom_email=<?php echo $_SESSION['user_email']; ?>'>
<input type='hidden' name='notify_url'
value='https://review-thunder.com/Paypal/notify.php'>
<input type='hidden' name='cancel_return'
value='https://review-thunder.com/Paypal/cancel.php'>
<input type='hidden' name='return'
value='https://review-thunder.com/Paypal/return.php'>
<input type="hidden" name="cmd" value="_xclick">
</form>
								<img src="../upload_media/t4.png" alt="">
				             	</a></div>
						        </div>
					</div>
                 </div>                      
        </div>
        
        
        <div class="container">
                      <div class="row">                    
                        <div class="col-md-12 text-center">
							<h1 class="text-center mt-50 fontstyle">"<?php echo $other_services;?>"</h1>
				              <hr class="hr-line">
				             	<p><?php echo $other_services_below_text;?></p>
				             	
				             	<div class="row mt-50 text-center fea-img">
				             		<div class="col-md-4">
						              <img src="../upload_media/a.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $webmatkering_audit;?></p>
						              <p><?php echo $webmatkering_audit_text;?></p>
						            </div>
						            <div class="col-md-4">
						              <img src="../upload_media/b.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $online_reviews;?></p>
						              <p><?php echo $online_reviews_text;?></p>
						            </div>
						            <div class="col-md-4">
						              <img src="../upload_media/c.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $social_media;?></p>
						              <p><?php echo $social_media_text;?></p>
						            </div>
						            <div class="col-md-4">
						              <img src="../upload_media/d.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $seo_optimisation;?></p>
						              <p><?php echo $seo_optimisation_text;?></p>
						            </div>
						            <div class="col-md-4">
						              <img src="../upload_media/e.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $social_advertising;?></p>
						              <p><?php echo $social_advertising_text;?></p>
						            </div>
						            <div class="col-md-4">
						              <img src="../upload_media/f.png" alt="">
						              <p class="mt-20 fw-600 fs-18"><?php echo $emailing_newsletter;?></p>
						              <p><?php echo $emailing_newsletter_text;?></p>
						            </div>
						         </div>
						            <div class="row mt-50 text-center mb-30">
							            <div class="col-md-4"></div>
							            <div class="col-md-4">
							            	<a href="javascript:void(0)"><img src="../upload_media/more.png" alt=""></a>
							            </div>
							            <div class="col-md-4"></div>
				             	</div>
				             	
					</div>
                 </div>                      
        </div>		
        
        
        
        
        
        
	</section>
</main>
		  <!-- END Main container -->









  <!-- Scripts -->
  <script src="https://review-thunder.com/assets/js/page.min.js"></script>
  <script src="https://review-thunder.com/assets/js/script.js"></script>
  <script src="https://review-thunder.com/js/core.min.js"></script>
  <script src="https://review-thunder.com/js/thesaas.min.js"></script>
  <script src="https://review-thunder.com/js/script.js"></script>
  <script src="https://review-thunder.com/js/select2.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

<script>
	function oneMonth(){
		document.getElementById("form1").submit();
	}
	function threeMonth(){
		document.getElementById("form2").submit();
	}
	function sixMonth(){
		document.getElementById("form3").submit();
	}
	function twelveMonth(){
		document.getElementById("form4").submit();
	}
</script>

 
  <?php include('footer.php');?>
 
</body>

</html>