<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
    <title>Advanced Facebook Business pages and Advertising Tool 1.0</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!--CSS-->
    <link href="theme/css.css" rel="stylesheet" id="bootstrap-css">
	<link href="theme/style.css" rel="stylesheet" id="bootstrap-css">
	<link href="theme/css/min.css" rel="stylesheet">
   
<!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
</head>

<?php include("config.php");
//if not logged in redirect to login page
if(!$user->is_logged_in()){ header('Location: login.php'); } 
include_once("includes/functions.php");
$useremail = new Users(); ?>

    <body  >
        
        <div class="wrapper">
    <div class="box">
        <div class="row row-offcanvas row-offcanvas-left">
                      
          
            <!-- sidebar -->
            <div class="column col-sm-2 col-xs-1 sidebar-offcanvas" id="sidebar">
              
              	<ul class="nav">
          			<li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
            	</ul>
               
                <ul class="nav hidden-xs" id="lg-menu">
				<h3>FBS TOOL</h3>
                    
			  <li><a href="clear.php"><i class="zmdi zmdi-hc-fw"></i> Clear data</a></li>
              <li> <a href="export.php" ><i class="zmdi zmdi-hc-fw"></i> Export data To CSV</a></li>
              <li><a href="#"><i class="zmdi zmdi-hc-fw"></i> Bulky Email Sender</a></li>
               
                    
                </ul>
                <ul class="list-unstyled hidden-xs" id="sidebar-footer">
                    <li>
                      <a href="#"><h3>Facebook Business </h3> Email Tool</a>
                    </li>
					<li>
					<br>
					©Copyright 2016
					<h6>Gamba Net Developers </h6>
					</li>
                </ul>
              
              	<!-- tiny only nav-->
              <ul class="nav visible-xs" id="xs-menu">
                  	<li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
                    <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
                  	<li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
                </ul>
              
            </div>
            <!-- /sidebar -->
          
            <!-- main right col -->
            <div class="column col-sm-10 col-xs-11" id="main">
                
                <!-- top nav -->
              	<div class="navbar navbar-blue navbar-static-top">  
                    <div class="navbar-header">
                      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle</span>
                        <span class="icon-bar"></span>
          				<span class="icon-bar"></span>
          				<span class="icon-bar"></span>
                      </button>
                      
                  	</div>
                  	<nav class="collapse navbar-collapse" role="navigation">
                   
                    <ul class="nav navbar-nav">
                      <li>
                        <a href="index.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i> Home</a>
                      </li>
                      
                      <li>
                        <a href="list.php"><i class="zmdi zmdi-hc-fw"></i>  Facebook Business Pages <span class="badge"> <?php $useremail->total();?> </span></a>
                      </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
					<?php if($user->is_logged_in()){ ?>
					
					  <li><a href="logout.php"><i class="zmdi zmdi-hc-fw"></i>  <?php echo $_SESSION['username'] ;?>  <i class="zmdi zmdi-hc-fw"></i> Logout </a></li>
                        
			  <?php
			   
			  }
			   
			   ?>
                      
                    </ul>
                  	</nav>
                </div>
                <!-- /top nav -->
				
				<div class="padding">
                    <div class="full col-sm-9">
				<?php

$useremail->Search();

?>