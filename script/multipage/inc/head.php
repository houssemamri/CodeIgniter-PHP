<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    

    <title>Facebook Business and Emails Scraper</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!--CSS-->
    <link href="theme/css.css" rel="stylesheet" id="bootstrap-css">
   
	 <!--Fonts-->
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-81337745-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>
<?php include("config.php");
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 
include_once("includes/functions.php");
$useremail = new Users(); ?>
<nav class="navbar navbar-default">

<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="index.php"><i class="fa fa-rocket"></i> Facebook Businesses and Emails Scraper</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">


  
    <ul class="nav navbar-nav">
              <li ><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
              <li><a href="list.php"><i class="fa fa-envelope"></i> Facebook Business Pages (<?php $useremail->total();?>)</a></li>
              
              <li><a href="clear.php"><i class="fa fa-external-link"></i> Clear cache</a></li>
              <li> <a href="export.php" ><i class="fa fa-download"></i> Export data To CSV</a></li>
              <li><a href="#"><i class="fa fa-external-link"></i> Bulky Email Sender</a></li>
			  <?php if($user->is_logged_in()){ 
			   echo '<li><a href="logout.php"><i class="fa fa-lock"></i> '.$_SESSION['username'].' Logout</a></li>';
			   
			  }
			   
			   ?>
			  

  
              
            </ul>
  </div>
</nav>
	<div class="container back" >
	<div class="row">

<div id="custom-search-input" style="padding: 10px;" >
                            <div class="input-group col-md-12">
							
				
			
							<form method="post" action="">
							<div class="col-sm-3">
							<select class="form-control input-lg" name="limit1">
							<option value="">Select Number of results</option>
							<option value="20">20</option>
                                                         <option value="25">You can only scrape 20 pages in demo mode</option>
							
							</select>
							</div>
							<div class="col-sm-6">
							<input type="text" name="search_term" class="form-control input-lg" placeholder="Enter search Keyword e.g New York" />
                                </div>
								<div class="col-sm-3">
								<span class="input-group-btn">
                                   
								   <button name="go" class="btn btn-primary btn-lg" type="submit">
                                       <i class="fa fa-search"></i> Scrape  Now
                                    </button>
                                </span>
								</form>
                            </div>
							</div>
							</div>


<?php

$useremail->Search();

?>
<hr>