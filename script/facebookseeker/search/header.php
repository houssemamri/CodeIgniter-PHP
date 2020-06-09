<?php
include_once('../config.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Facebook Seeker - Data collector</title>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/se-1.2.0/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/jszip-2.5.0/pdfmake-0.1.18/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/b-html5-1.2.2/b-print-1.2.2/r-2.1.0/se-1.2.0/datatables.min.js"></script>

<link rel="stylesheet" href="../assets/css/style.css" />
<script src="../assets/js/jquery.session.js" ></script>
<script src="../assets/js/custom.js" ></script>

<script>
$(window).load(function () {
  window.fbAsyncInit = function() {
    FB.init({
      appId      : <?php echo $config['APP_ID']; ?>,
      xfbml      : false,
      cookie     : true,
      status     : true,
      version    : 'v2.7'
    });
    checkLoginStatus();
  };

    (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
     var uid = '';
     var accessToken = '';
});

var DEBUG = true;
    
</script>


</head>
<body>
    
<nav class="navbar navbar-default">
  <div class="container">
        <img src="../assets/images/logo_fbseeker.png" />
       
      <ul class="nav navbar-nav navbar-right">

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="glyphicon glyphicon-user"></i> account (<span id="user-setting"><?php echo $_SESSION['user']; ?></span>)<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a id="setting" href="#"><i class="glyphicon glyphicon-cog"></i> settings</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo $config['REDIRECT_URL'].'/'.$config['APP_DIRECTORY'];?>/logout/"><i class="glyphicon glyphicon-log-out"></i> logout</a></li>
          </ul>
        </li>
      </ul>
    
  </div><!-- /.container-fluid -->
</nav>
    
<div id="overlay">
    <div class="container">
        <span class=" " style="float:right;margin-top: -60px;cursor:pointer;" id="stopRequest"><img src="../assets/images/blackcross.png"/></span>
        <div clas="row">
            <div class="col-md-6 col-md-offset-3" style="text-align: center;">
                <p>
                    <img class="img " src="../assets/images/gears.gif" />
                </p>
            </div>
        </div>
        <div clas="row">
            <div class="col-md-6 col-md-offset-3" style="text-align: center;">
                <p style="font-size: 20px;">
                fetched data from
                <span style="font-weight: bold; color: #3E5E9A;" id="laodEl">0</span>
                elements on
                <span style="font-weight: bold; color: #3E5E9A;" id="totEl">0</span>
                </p>
            </div>
        </div>
    </div>

</div>
