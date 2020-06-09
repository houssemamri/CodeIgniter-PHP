

           
<!-- Main container -->
<main class="main-content">


  <section class="section bg-gray" style="padding-bottom:0;">
    <div class="container">
        <div class="row">
          <div class="col-md-2 text-center">
            <ul class="list-unstyled">
                <?php
                if (strcmp($_GET['type'], "Hotel") == 0) {
                    ?>
                    <li id="btn1" onclick="showHotel(1);"><img src="img/side/tlogo.png" /></li><br />
                    <li id="btn2" onclick="showHotel(2);"><img src="img/side/blogo.png" /></li><br />
                    <li id="btn3" onclick="showHotel(3);"><img src="img/side/glogo.png" /></li><br />
					<li id="btn3" onclick="showHotel(10);"><img height="70px" width="70px"  src="/review/img/fb_page.png" /></li><br />
                    <li id="btn4" onclick="showHotel(4);"><img src="img/side/browser.png" /></li><br />
                    <li id="btn5" onclick="showHotel(5);"><img src="img/side/expedia.png" /></li><br />
                    <li id="btn7" onclick="showHotel(6);"><img src="img/side/jaune.png" /></li><br />
                    <li id="btn9" onclick="showHotel(7);"><img src="img/side/petit.png" /></li><br />
                    <?php
                } else if (strcmp($_GET['type'], "Restaurant") == 0) {
                    ?>
                    <li id="btn1" onclick="showRestaurant(1);"><img src="img/side/tlogo.png" /></li><br />
                    <li id="btn2" onclick="showRestaurant(2);"><img src="img/side/llogo.png" /></li><br />
                    <li id="btn3" onclick="showRestaurant(3);"><img src="img/side/glogo.png" /></li><br />
					<li id="btn3" onclick="showRestaurant(10);"><img height="70px" width="70px"  src="/review/img/fb_page.png" /></li><br />
                    <li id="btn4" onclick="showRestaurant(4);"><img src="img/side/browser.png" /></li><br />
                    <li id="btn5" onclick="showRestaurant(5);"><img src="img/side/jaune.png" /></li><br />
                    <li id="btn7" onclick="showRestaurant(6);"><img src="img/side/petit.png" /></li><br />
                    <?php
                } else if (strcmp($_GET['type'], "Loisirs") == 0) {
                    ?>
                    <li id="btn1" onclick="showLeisure(1);"><img src="img/side/tlogo.png" /></li><br />
                    <li id="btn2" onclick="showLeisure(2);"><img src="img/side/glogo.png" /></li><br />
					<li id="btn3" onclick="showLeisure(10);"><img height="70px" width="70px"  src="/review/img/fb_page.png" /></li><br />
                    <li id="btn3" onclick="showLeisure(3);"><img src="img/side/browser.png" /></li><br />
                    <li id="btn4" onclick="showLeisure(4);"><img src="img/side/jaune.png" /></li><br />
                    <li id="btn6" onclick="showLeisure(5);"><img src="img/side/petit.png" /></li><br />
                    <?php
                } else if (strcmp($_GET['type'], "Culture") == 0) {
                    ?>
                    <li id="btn1" onclick="showCulture(1);"><img src="img/side/tlogo.png" /></li><br />
                    <li id="btn2" onclick="showCulture(2);"><img src="img/side/glogo.png" /></li><br />
					<li id="btn3" onclick="showCulture(10);"><img height="70px" width="70px"  src="/review/img/fb_page.png" /></li><br />
                    <li id="btn3" onclick="showCulture(3);"><img src="img/side/browser.png" /></li><br />
                    <li id="btn4" onclick="showCulture(4);"><img src="img/side/jaune.png" /></li><br />
                    <li id="btn6" onclick="showCulture(5);"><img src="img/side/petit.png" /></li><br />
                    <?php
                } else {
                    ?>
                    <li id="btn2" onclick="showOther(1);"><img src="img/side/glogo.png" /></li><br />
					<li id="btn3" onclick="showOther(10);"><img height="70px" width="70px"  src="/review/img/fb_page.png" /></li><br />
                    <li id="btn4" onclick="showOther(2);"><img src="img/side/browser.png" /></li><br />

                    <?php
                }
                ?>
            </ul>
          </div>
          <div class="col-md-10">
            <?php
            $sql = "SELECT * FROM usertable WHERE UID=" . $_SESSION['user_id'];
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            if (strcmp($_GET['type'], "Hotel") == 0) {
                ?>
                <div id="tripAdvisor1">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide1']; ?>"></iframe>
                    </div>
                </div>
                <div id="book1" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['BookingSide']; ?>"></iframe>
                    </div>
                </div>
                <div id="google1"  style="display:none;">
                    <div class="wrap1" id="google_div">
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				 <div id="facebookPage1"  style="display:none;">
                    <div class="wrap1" >
       <?php include('fb_/fb_page_review.php'); ?>
                    </div>
                </div>
                <div id="browser1"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <div id="expedia" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['ExpediaSide']; ?>"></iframe>
                    </div>
                </div>
                <div id="jaune1" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['JauneSide1']; ?>"></iframe>
                    </div>
                </div>
                <div id="petit1"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide1']; ?>"></iframe>
                    </div>
                </div>
                <?php
            } else if (strcmp($_GET['type'], "Restaurant") == 0) {
                ?>
                <div id="google2"  style="display:none;">
                   <div class="wrap1" id="google_div">
                   <!--iframe class="frame1" src=""></iframe-->
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				 <div id="facebookPage2"  style="display:none;">
                    <div class="wrap1" >
                  <iframe src="https://www.facebook.com/plugins/page.php?href=<?php  echo $url; ?>&tabs=timeline&width=1200&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=<?php  echo $app_id; ?>" width="1200" height="800" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                    </div>
                </div>
                <div id="tripAdvisor2" >
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide2']; ?>"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <div id="laFour"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['LaFour']; ?>"></iframe>
                    </div><br /><br />
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.myfourchette.com/service"></iframe>
                    </div>
                </div>
                <div id="browser2"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <div id="jaune2"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['JauneSide2']; ?>"></iframe>
                    </div>
                </div>
                <div id="petit2"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide2']; ?>"></iframe>
                    </div>
                </div>
                <?php
            } else if (strcmp($_GET['type'], "Loisirs") == 0) {
                ?>
                <div id="tripAdvisor3">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide3']; ?>"></iframe>
                    </div>
                </div>
                <div id="google3"  style="display:none;">
                     <div class="wrap1" id="google_div">
   <!--iframe class="frame1" src=""></iframe-->
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				 <div id="facebookPage3"  style="display:none;">
                    <div class="wrap1" >
                  <iframe src="https://www.facebook.com/plugins/page.php?href=<?php  echo $url; ?>&tabs=timeline&width=1200&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=<?php  echo $app_id; ?>" width="1200" height="800" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                    </div>
                </div>
                <div id="browser3"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <div id="jaune3"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['JauneSide3']; ?>"></iframe>
                    </div>
                </div>
                <div id="petit3"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide3']; ?>"></iframe>
                    </div>
                </div>
                <?php
            } else if (strcmp($_GET['type'], "Culture") == 0) {
                ?>
                <div id="tripAdvisor4">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['TripAdvisorSide4']; ?>"></iframe>
                    </div>
                </div>
                <div id="google4"  style="display:none;">
                     <div class="wrap1" id="google_div">
   <!--iframe class="frame1" src=""></iframe-->
                   <?php   include('main_google.php');  ?>

                    </div>
                </div>
				 <div id="facebookPage4"  style="display:none;">
                    <div class="wrap1" >
                  <iframe src="https://www.facebook.com/plugins/page.php?href=<?php  echo $url; ?>&tabs=timeline&width=1200&height=800&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=<?php  echo $app_id; ?>" width="1200" height="800" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                    </div>
                </div>
                <div id="browser4"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="https://www.bing.com"></iframe>
                    </div>
                    <small>Note: iFrames don't support all website.</small>
                </div>
                <div id="jaune4"  style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['JauneSide4']; ?>"></iframe>
                    </div>
                </div>
                <div id="petit4" style="display:none;">
                    <div class="wrap1">
                        <iframe class="frame1" src="<?php echo $row['PetitSide4']; ?>"></iframe>
                    </div>
                </div>

            <?php }
            ?>
          </div>
        </div>
    </div>
  </section>





</main>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script>
$( document ).ready(function() {
			var lookupText="hello hello am using a site translater "
			$.ajax({
          type: "GET",
          url: "https://www.googleapis.com/language/translate/v2",
          data: { key: "AIzaSyCxQdqd7CfyS5H6RYaIJhASeuT4pJvWsGE", source: "en", target: "fr", q: lookupText },
          dataType: 'jsonp',
          success: function (data) {
			  console.log(data);
                     alert(data.data.translations[0].translatedText);
                    },
          error: function (data) {
                   alert('fail');
                 }
          });
          });
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
.inner-tabview .right-bar {
    float: right;
    padding: 20px 70px;
    width: 75%;
    height: 400px;
    overflow-y: scroll;
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
