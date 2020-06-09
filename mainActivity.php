<!-- Main container -->
<style>
    .avatar-article{
        position: relative;
    }
    .bubble-article > span{
        position: absolute;
        top: -180px;
        left: 157px;
        width: 90px;
        font-size: 0.8rem;
        max-height: 160px;
        font-weight: 600;
        line-height: 1.5;
        /* color: firebrick; */
    }
    .bubble-article > img{
        position: absolute;
        top: -240px;
        left: 85px;
        max-width: 210px;
        max-height: 200px;
        width: 210px;
        height: 200px;
    }

    .avatar-article-img{
        position: absolute;
        top: -80px;
    }
    @media screen and (max-width: 768px){
        div.avatar-article {
            display: none;
        }
    }
    @media screen and (max-width: 1440px) {
        .bubble-article > span{
            top: -185px;
            left: 115px;
            width: 85px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        .bubble-article > img{
            top: -240px;
            left: 60px;
            width: 180px;
            height: 180px;
        }
    }
    @media screen and (max-width: 1310px) {
        .bubble-article > span{
            top: -185px;
            left: 110px;
            width: 80px;
            font-size: 0.7rem;
            font-weight: 500;
        }
        .bubble-article > img{
            top: -240px;
            left: 58px;
            width: 175px;
            height: 175px;
        }
    }
    @media screen and (max-width: 1280px) {
        .bubble-article > span{
            top: -40px;
            left: 155px;
        }
        .bubble-article > img{
            top: -95px;
            left: 100px;
        }
        .avatar-article-img{
            top: 0px;
        }

    }
    @media screen and (max-width: 1180px) {
        .bubble-article > span{
            top: -43px;
            left: 138px;
            width: 67px;
            font-size: 0.6rem;
            font-weight: 500;
        }
        .bubble-article > img{
            top: -95px;
            left: 92px;
            width: 155px;
            height: 155px;
        }

    }
    @media screen and (max-width: 1080px) {
        .bubble-article > span{
            top: -68px;
            left: 95px;
            width: 65px;
            font-size: 0.55rem;
            font-weight: 500;
        }
        .bubble-article > img{
            top: -118px;
            left: 48px;
            width: 150px;
            height: 145px;
        }

    }

    @media screen and (max-width: 991px) {
        .bubble-article > span{
            top: 0px;
            left: 86px;
        }
        .bubble-article > img{
            top: -44px;
            left: 42px;
            width: 145px;
            height: 140px;
        }
        .avatar-article-img{
            top: 89px;
        }

    }
    @media screen and (max-width: 920px) {
        .bubble-article > span{
            left: 75px;
        }
        .bubble-article > img{
            top: -36px;
            left: 35px;
            width: 135px;
            height: 128px;
        }
        .avatar-article-img{
            top: 80px;
        }

    }
    @media screen and (max-width: 830px) {
        .bubble-article > span,
        .bubble-article > img,
        .avatar-article-img{
            display: none;
        }
    }


</style>
<?php
$sql = 'select avatar,bubble from UserTable where UID = "'.$_SESSION['user_id'].'"';
$result = $conn->query($sql);
$row = $result->fetch_array();
if(is_null($row['avatar'])){
    $row['avatar'] = 1;
}
// if(is_null($row['bubble'])){
    $row['bubble'] = 1;
// }
?>
<div class="avatar-article col-md-1">
    <div class="bubble-article">
        <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
        <span><?=$avatarText?></span>
    </div>
    <img class="avatar-article-img" src="avatar/img/avatar/<?=$row['avatar']?>.png">
</div>


<main class="main-content">
  <section class="section bg-gray" style="padding-top:1%;padding-bottom:0">
    <div class="container-fluid">
        <div class="row">
        <div class="col-md-12 text-center">
            <ul class="nav nav-round" style="display: inline-flex;justify-content: center;margin-bottom: 3%;">
                <?php
                if (strcmp($_GET['type'], "Hotel") == 0) {
                    ?>
                    <li id="btn1" onclick="showHotel(1);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/tripiframe.png" /></a>
                    </li>
                    <li id="btn2" onclick="showHotel(2);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe booking.png" /></a>
                    </li>
                    <li id="btn3" onclick="showHotel(3);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe google.png" /></a>
                    </li>
                    <li id="btn3" onclick="showHotel(10);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe facebook.png" /></a>
                    </li>
                    <li id="btn4" onclick="showHotel(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe internet.png" /></a>
                    </li>
                    <!-- <li id="btn5" onclick="showHotel(5);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/expedia.png" /></a>
                    </li> -->
                    <!-- <li id="btn7" onclick="showHotel(6);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/jaune.png" /></a>
                    </li> -->
                   <!--PRETIT FUTE <li id="btn9" onclick="showHotel(7);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/petit.png" /></a>
                    </li>-->
                    <?php
                } else if (strcmp($_GET['type'], "Restaurant") == 0) {
                    ?>                    
                    <li id="btn1" onclick="showRestaurant(1);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/tripiframe.png" /></a>
                    </li>
                    <li id="btn2" onclick="showRestaurant(2);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe lafourchette.png" /></a>
                    </li>
                    <li id="btn3" onclick="showRestaurant(3);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe google.png" /></a>
                    </li>
                    <li id="btn3" onclick="showRestaurant(10);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe facebook.png" /></a>
                    </li>
                    <li id="btn4" onclick="showRestaurant(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe internet.png" /></a>
                    </li>
                    <!-- <li id="btn5" onclick="showRestaurant(5);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/jaune.png" /></a>
                    </li> -->
                    <!-- <li id="btn7" onclick="showRestaurant(6);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage" src="img/side/petit.png" /></a>
                    </li> -->
                    <?php
                } else if (strcmp($_GET['type'], "Loisirs") == 0) {
                    ?>
                    <li id="btn1" onclick="showLeisure(1);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/tripiframe.png" /></a>
                    </li>
                    
                    <li id="btn3" onclick="showLeisure(2);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe google.png" /></a>
                    </li>
                    <li id="btn3" onclick="showLeisure(10);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe facebook.png" /></a>
                    </li>
                    <!-- <li id="btn4" onclick="showLeisure(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/jaune.png" /></a>
                    </li> -->
                    <li id="btn6" onclick="showLeisure(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe internet.png" /></a>
                    </li>
                    <!-- <li id="btn7" onclick="showLeisure(6);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage" src="img/side/petit.png" /></a>
                    </li> -->
                    <?php
                } else if (strcmp($_GET['type'], "Culture") == 0) {
                    ?>
                    <li id="btn1" onclick="showCulture(1);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/tripiframe.png" /></a>
                    </li>
                    <li id="btn3" onclick="showCulture(2);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe google.png" /></a>
                    </li>
                    <li id="btn3" onclick="showCulture(10);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe facebook.png" /></a>
                    </li>
                    <!-- <li id="btn4" onclick="showCulture(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/jaune.png" /></a>
                    </li> -->
                    <li id="btn6" onclick="showCulture(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe internet.png" /></a>
                    </li>
                    <!-- <li id="btn2" onclick="showCulture(6);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/petit.png" /></a>
                    </li> -->
                    <?php
                } else {
                    ?>
                    <li id="btn3" onclick="showOther(1);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe google.png" /></a>
                    </li>
                    <li id="btn3" onclick="showOther(10);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe facebook.png" /></a>
                    </li>
                    <!-- <li id="btn4" onclick="showCulture(4);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img height="30px" width="40px" src="img/side/jaune.png" /></a>
                    </li> -->
                    <li id="btn6" onclick="showOther(2);" class="nav-item w-140">
                        <a class="nav-link nav-user" href="javascript:;"><img class="activityImage"  src="img/side/iframe internet.png" /></a>
                    </li>

                    <?php
                }
                ?>
            </ul>
          </div>

          <div class="col-md-12 mt-30 first-iframe-section">
		  <div class="reduce-iframe">
            <?php
            $sql = "SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if (strcmp($_GET['type'], "Hotel") == 0) {
                ?>
                <div id="tripAdvisor11">
                    <div class="">
                        <iframe  class="frame1"   src="<?php echo $row['TripAdvisorSide1']; ?>"></iframe>
                    </div>
                </div>
                <div id="book11" style="display:none;">
                   <!-- <div class="wrap1">
                        <iframe class="frame1" src="https://supply-xml.booking.com/review-api/properties/1234567890/reviews_iframe"></iframe>
                    </div>-->
                </div>
                <div id="google11"  style="display:none;">
                    <div class="" id="google_div">
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				 <div id="facebookPage11"  style="display:none;">
                    <div class="wrap1 " >
                    <?php //include('fb_/fb_page_review.php'); ?>
                    </div>
                </div>
                <div id="browser11"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <!-- <div id="expedia1" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php //echo $row['ExpediaSide']; ?>"></iframe>
                    </div>
                </div> -->
                <!-- <div id="jaune11" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php //echo $row['JauneSide1']; ?>"></iframe>
                    </div>
                </div> -->
                <div id="petit11"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide1']; ?>"></iframe>
                    </div>
                </div>
                <?php
            } else if (strcmp($_GET['type'], "Restaurant") == 0) {
                ?>
                <div id="google21"  style="display:none;">
                   <div class="" id="google_div">
                   <!--iframe class="frame1" src=""></iframe-->
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				 <div id="facebookPage21"  style="display:none;">
                    <div class="wrap1" >
                    <?php include('fb_/fb_page_review.php'); ?>
                    </div>
                </div>
                <div id="tripAdvisor21">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide2']; ?>"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <div id="laFour1"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['LaFourSide']; ?>"></iframe>
                    </div><br /><br />
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.myfourchette.com/service"></iframe>
                    </div>
                </div>
                <div id="browser21"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <!-- <div id="jaune21"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php //echo $row['JauneSide2']; ?>"></iframe>
                    </div>
                </div> -->
                <div id="petit21"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide2']; ?>"></iframe>
                    </div>
                </div>
                <?php
            } else if (strcmp($_GET['type'], "Loisirs") == 0) {
                ?>
                <div id="tripAdvisor31">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide3']; ?>"></iframe>
                    </div>
                </div>
                <div id="google31"  style="display:none;">
                     <div class="wrap1" id="google_div">
   <!--iframe class="frame1" src=""></iframe-->
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				<div id="facebookPage31"  style="display:none;">
                    <div class="wrap1" >
                    <?php include('fb_/fb_page_review.php'); ?>
                    </div>
                </div>
                <div id="browser31"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <!-- <div id="jaune31"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php //echo $row['JauneSide3']; ?>"></iframe>
                    </div>
                </div> -->
                <div id="petit31"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide3']; ?>"></iframe>
                    </div>
                </div>
                <?php
            } else if (strcmp($_GET['type'], "Culture") == 0) {
                ?>
                <div id="tripAdvisor41">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide4']; ?>"></iframe>
                    </div>
                </div>
                <div id="google41"  style="display:none;">
                     <div class="wrap1" id="google_div">
   <!--iframe class="frame1" src=""></iframe-->
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				<div id="facebookPage41"  style="display:none;">
                    <div class="wrap1" >
                    <!-- <?php include('fb_/fb_page_review.php'); ?> -->
                    </div>
                </div>
                <div id="browser41"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <!-- <div id="jaune41"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php //echo $row['JauneSide4']; ?>"></iframe>
                    </div>
                </div> -->
                <div id="petit41" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide4']; ?>"></iframe>
                    </div>
                </div>

            <?php }
            else
            {?>
              <div id="google51" class="mainFrame" >
                   <div class="wrap" id="google_div">
 <!--iframe class="frame" src=""></iframe-->
                 <?php   include('main_google.php');  ?>

                  </div>
              </div>
              <div id="browser51" class="mainFrame"  style="display:none;">
                  <div class="wrap">
                      <iframe class="frame" src="https://www.bing.com"></iframe>
                  </div>
                  <small>Note: iFrames don't support all website.</small>
              </div>
			  <div id="facebookPage51"  style="display:none;">
                    <div class="wrap1" >
                    <?php include('fb_/fb_page_review.php'); ?>
                    </div>
                </div>

            <?php
            }
            ?>
          </div>
		  </div>
        </div>
    </div>
  </section>




</main>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script>
$("#toggle_menu").click(function(){
			$("#Left_menu_div").toggleClass("slide-left-bar");
			$("#right_menu_div").toggleClass("slide-right-bar");
			});
$("#toggle_menu1").click(function(){
   
      $("#Left_menu_div1").toggleClass("slide-left-bar");
      $("#right_menu_div1").toggleClass("slide-right-bar");
      });
</script>

<script>
function get_detail(name){


	/* $.ajax({url: "detail_google.php" data:{'name':name }, success: function(result){
		alert(result);
        //$("#div1").html(result);
    }}); */
	if(name=="manage"){
	$.ajax({
  method: "POST",
  url: "main_google.php",
  data: { name: name }
})
  .done(function( result ) {

	$('#google_div').html(result);
  });
	}else{

$.ajax({
  method: "POST",
  url: "detail_google.php",
  data: { name: name }
})
  .done(function( result ) {

	$('#google_div').html(result);
  });

	}

}


function get_detail2(name){


	/* $.ajax({url: "detail_google.php" data:{'name':name }, success: function(result){
		alert(result);
        //$("#div1").html(result);
    }}); */
	if(name=="manage"){
	$.ajax({
  method: "POST",
  url: "main_google2.php",
  data: { name: name }
})
  .done(function( result ) {

	$('#google_div_model').html(result);
  });
	}else{

$.ajax({
  method: "POST",
  url: "detail_google2.php",
  data: { name: name }
})
  .done(function( result ) {

	$('#google_div_model').html(result);
  });

	}

}



</script>
<style>
/********* 6-march-2018********/


.modal-popup-view .modal-dialog {
    margin-left: 0 !important;
   /* margin-top: 0 !important;*/
    max-width: 100% !important;
}
.modal-popup-view .full-row {
    text-align: center !important;
}
.modal-popup-view .inner-review {
    background: #f0f0f0 !important;
}

.modal-popup-view .container {
padding:0 !important;
}
.location-loop {
    display: inline-block;
    width: 100%;
    border-bottom: 1px solid #ddd;
    text-align: left;
}
.modal-popup-view button {
    float: left;
    margin: 0 !important;
}
.full-location {
  border-bottom: 1px solid #ddd;
}
.left-bar .nav-tabs .nav-link:focus, .left-bar .nav-tabs .nav-link:hover {
  border-color: #eceeef #eceeef #dddddd;
  background: #ddd !important;
  color: #454545 !important;
}
.left-bar .nav-tabs li a {
  color: #787878;
  font-size: 14px;
}
.left-bar .nav-tabs li a:hover {
  color: #454545;
  font-size: 14px;
}
.inner-tabview .right-bar {
    float: right;
    padding:0px !important;
    width: 75%;
    height: 570px !important;
    overflow-y: scroll;
    border-left: 1px solid #ddd;
    max-height: 570px !important
}
.right-bar .tab-pane.fade.active.show {
  padding: 25px;
}
.modal-popup-view .wrap11 {
    width: 950px;
    height: auto;
    padding: 0;
    overflow: hidden;
}
.bottom-pop-btn {
  width: 72%;
  margin: 0 auto;
}
</style>
