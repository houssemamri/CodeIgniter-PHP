



<?php
$sql = "SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();

//print_r($row);
?>




<!-- Main container -->
<main class="main-content">

    <section class="section" id="section-vtab">
        <div class="container">
            <?php
            $lang = $_GET['lang'];
            if (strcmp($lang, "fr") == 0) {
                $fr = "active";
                $en = "";
                $spa = "";
				
            } else if (strcmp($lang, "en") == 0) {
                $fr = "";
                $en = "active";
                $spa = "";
            } else if (strcmp($lang, "spa") == 0) {
                $fr = "";
                $en = "";
                $spa = "active";
            } else {
                $fr = "";
                $en = "";
                $spa = "";
            }
            ?>

            <div class="text-center" id="language">
                <ul class="nav nav-outline nav-round">
                    <li class="nav-item w-140 hidden-sm-down">
                        <a class="nav-link nav-user <?php echo $fr; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=fr&article=1">
                            <?php echo $lang1; ?>
                        </a>
                    </li>
                    <li class="nav-item w-140">
                        <a class="nav-link nav-user <?php echo $en; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=en&article=1">
                            <?php echo $lang2; ?>
                        </a>
                    </li>
                    <li class="nav-item w-140 hidden-sm-down">
                        <a class="nav-link nav-user <?php echo $spa; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=spa&article=1">
                            <?php echo $lang3; ?>
                        </a>
                    </li>
                </ul>
            </div>
            <br /><br /><br />
            <div class="row">
                <div class="col-12 col-md-12 align-self-center text-center">
                    <div class="row">
                        <div class="col-12 col-lg-12" id="answer">
                            <ul class="list-unstyled">
                                <?php
                                $art = $_GET['article'];
                                if ($art == 1) {
                                    $art1 = "btn-danger";
                                    $art2 = "btn-primary";
                                    $art3 = "btn-primary";
                                } else if ($art == 2) {
                                    $art1 = "btn-primary";
                                    $art2 = "btn-danger";
                                    $art3 = "btn-primary";
                                } else if ($art == 3) {
                                    $art1 = "btn-primary";
                                    $art2 = "btn-primary";
                                    $art3 = "btn-danger";
                                } else {
                                    $art1 = "btn-primary";
                                    $art2 = "btn-primary";
                                    $art3 = "btn-primary";
                                }
                                if (isset($_GET['lang'])) {
                                    ?>
                                    <a class="btn btn-round <?php echo $art1; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=<?php echo $_GET['lang']; ?>&article=1"><?php echo $ans1; ?></a>
                                    <a class="btn btn-round <?php echo $art2; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=<?php echo $_GET['lang']; ?>&article=2"><?php echo $ans2; ?></a>
                                    <a class="btn btn-round <?php echo $art3; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=<?php echo $_GET['lang']; ?>&article=3"><?php echo $ans3; ?></a>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <br /><br />
                    <?php if (isset($_GET['article'])) {
                        ?>
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <ul class="list-unstyled">
                                    <a class="btn btn-round btn-info" id="Man" onclick="registerSex(1);"><?php echo $sex1; ?></a>
                                    <a class="btn btn-round btn-outline btn-info" id="Woman" onclick="registerSex(2);"><?php echo $sex2; ?></a>
                                    <a class="btn btn-round btn-outline btn-info" id="Unisex" onclick="registerSex(3);"><?php echo $sex3; ?></a>
                                </ul>
                            </div>
                        </div>
                        <br /><br />
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <?php
                                if ($_GET['article'] == 1) {
                                    ?>
                                    <h2><?php echo $ans1; ?></h2><br />
                                    <ul class="list-unstyled">
                                        <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $positive[0]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $positive[1]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part3"  onclick="activePartButton(3);"><?php echo $positive[2]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(4);"><?php echo $positive[3]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(5);"><?php echo $neg1; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(6);"><?php echo $neg2; ?></li>
                                        <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $positive[4]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(7);"><?php echo $neg3; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $neg4; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $positive[5]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part10" onclick="activePartButton(10);"><?php echo $positive[6]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part11" onclick="activePartButton(11);"><?php echo $positive[7]; ?></li>
                                    </ul>
                                    <?php
                                } else if ($_GET['article'] == 2) {
                                    ?>
                                    <h2><?php echo $ans2; ?></h2><br />
                                    <ul class="list-unstyled">
                                        <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $negative[0]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $negative[1]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part3" onclick="activePartButton(3);"><?php echo $negative[2]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(5);"><?php echo $neg5; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(6);"><?php echo $neg6; ?></li>
                                        <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $negative[5]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(7);"><?php echo $neg7; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(8);"><?php echo $neg8; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $negative[8]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $negative[9]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part10" onclick="activePartButton(10);"><?php echo $negative[10]; ?></li>
                                    </ul>
                                    <?php
                                } else {
                                    ?>
                                    <h2><?php echo $ans3; ?></h2><br />
                                    <ul class="list-unstyled">
                                        <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $simple[0]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $simple[1]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part3" onclick="activePartButton(3);"><?php echo $simple[2]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(5);"><?php echo $neg9; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(6);"><?php echo $neg10; ?></li>
                                        <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $simple[3]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(7);"><?php echo $neg11; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(8);"><?php echo $neg12; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $simple[4]; ?></li>
                                        <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $simple[5]; ?></li>
                                    </ul>

                                <?php }
                                ?>
                                <br />
                                <input type="image"  style="display:table;margin:0 auto;" onclick="display('<?php echo $_GET['article']; ?>');" src="img/<?php echo $generate; ?>" />
                            </div>
                        </div>
                        <br /><br />
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <h2><?php echo $generateHeader; ?></h2><br />
                                <div id="article" class="text-left">
                                    <br /><br />
                                    <span id="article1"><?php echo $generateBox; ?>.</span><br /><br />
                                </div>
                                <br /><br />
                                <input type="image" id="button1" onclick="CopyToClipboard('generateBody');" src="img/<?php echo $copy; ?>" style="display:table;margin:0 auto;"/>
                            </div>
                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_GET['article'])) {
        ?>
        <section class="section bg-gray">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-12 align-self-center text-center">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <br /><br />
                                <?php
                                $lang = $_GET['lang'];
                                $num = $_GET['article'];
                                if (strcmp($lang, "fr") == 0) {
                                    $article = $num;
                                } else if (strcmp($lang, "en") == 0) {
                                    $article = $num + 3;
                                } else {
                                    $article = $num + 5;
                                }
                                $sql1 = "SELECT * FROM UserSave WHERE UID=" . $_SESSION['user_id'] . " AND category='" . $_GET['type'] . "' AND Article=" . $article;
                                $result1 = $conn->query($sql1);
                                $row1 = $result1->fetch_assoc();
                                ?>
                                <span id="success"></span>
                                <div style="display:table;margin:0 auto;">
                                    <textarea name="test2" id="test2"><?php echo $row1['Text']; ?></textarea>
                                </div>
                                <br />
                                <button type="button" class="btn btn-primary" onclick="saveArticle('<?php echo $_GET['type']; ?>', '<?php echo $_GET['lang']; ?>', '<?php echo $_GET['article']; ?>');"><?php echo $save; ?></button><br /><br />
                                <input type="image"  style="display:table;margin:0 auto;" onclick="window.location = 'mailto:example@mail.com';" src="img/<?php echo $sendMail; ?>" />
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    <?php }
    ?>


    <input type="text" value="0" id="res1" hidden/>
    <input type="text" value="0" id="res2" hidden/>
    <input type="text" value="0" id="res3" hidden/>
    <input type="text" value="0" id="res4" hidden/>
    <input type="text" value="0" id="res5" hidden/>
    <input type="text" value="0" id="res6" hidden/>
    <input type="text" value="0" id="res7" hidden/>
    <input type="text" value="0" id="res8" hidden/>
    <input type="text" value="0" id="res9" hidden/>
    <input type="text" value="0" id="res10" hidden/>
    <input type="text" value="0" id="res11" hidden/>
    <input type="text" value="0" id="special" hidden/>

    <input type="text" value="1" id="sex" hidden required />



</main>
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
.inner-tabview .right-bar {
    float: right;
    padding: 20px 70px;
    width: 75%;
    height: 400px;
    overflow-y: scroll;
}
.modal-popup-view .wrap {
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
