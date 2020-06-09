
<?php
$sql = "SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
$result = $conn->query($sql);
$row = $result->fetch_assoc();
if (strcmp($_GET['type'], "Hotel") == 0) {
    ?>
    <div id="sideButton1">
        <a data-toggle="modal" data-target="#Modal1"><img src="img/side/tlogo.png" /></a>
    </div>
    <div id="sideButton2">
        <a data-toggle="modal" data-target="#Modal2"><img src="img/side/blogo.png" /></a>
    </div>
    <div id="sideButton3">
        <a data-toggle="modal" data-target="#Modal3"><img src="img/side/glogo.png" /></a>
    </div>
    <div id="sideButton4">
        <a data-toggle="modal" data-target="#Modal5"><img src="img/side/browser.png" /></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="tripAdvisors1" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="<?php echo $row['TripAdvisor1']; ?>"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="Modal2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="books1" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="<?php echo $row['Booking']; ?>"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    <div class="modal fade modal-popup-view" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="Modal4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="yelps1" class="mainFrame">
               <div class="wrap" id="google_div_model">
                                       <?php   include('main_google2.php');  ?>

                                        </div>
                                        <div class="bottom-pop-btn">
				<button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
            </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="Modal5" tabindex="-1" role="dialog" aria-labelledby="Modal5" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="browsers1" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="https://www.bing.com"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <?php
} else if (strcmp($_GET['type'], "Restaurant") == 0) {
    ?>
    <div id="sideButton1">
        <a data-toggle="modal" data-target="#Modal1"><img src="img/side/glogo.png" /></a>
    </div>
    <div id="sideButton2">
        <a data-toggle="modal" data-target="#Modal3"><img src="img/side/tlogo.png" /></a>
    </div>
    <div id="sideButton3">
        <a data-toggle="modal" data-target="#Modal4"><img src="img/side/llogo.png" /></a>
    </div>
    <div id="sideButton4">
        <a data-toggle="modal" data-target="#Modal5"><img src="img/side/browser.png" /></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="googles2" class="mainFrame">
                <div class="wrap" id="google_div_model">
                                       <?php   include('main_google2.php');  ?>

                                        </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="Modal2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="yelps2" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src=""></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="Modal3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="tripAdvisors2" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="<?php echo $row['TripAdvisor2']; ?>"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>


    <div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="Modal4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="laFours" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="<?php echo $row['LaFour']; ?>"></iframe>
                </div><br /><br />
                <div class="wrap">
                    <iframe class="frame" src="https://www.myfourchette.com/service"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal5" tabindex="-1" role="dialog" aria-labelledby="Modal5" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="browsers2" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="https://www.bing.com"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    <?php
} else if (strcmp($_GET['type'], "Loisirs") == 0) {
    ?>
    <div id="sideButton1">
        <a data-toggle="modal" data-target="#Modal1"><img src="img/side/tlogo.png" /></a>
    </div>
    <div id="sideButton2">
        <a data-toggle="modal" data-target="#Modal2"><img src="img/side/glogo.png" /></a>
    </div>
    <div id="sideButton3">
        <a data-toggle="modal" data-target="#Modal4"><img src="img/side/browser.png" /></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="tripAdvisors3" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="<?php echo $row['TripAdvisor3']; ?>"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="Modal2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="googles3" class="mainFrame">
                <div class="wrap" id="google_div_model">
                                       <?php   include('main_google2.php');  ?>

                                        </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="Modal3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="yelps3" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src=""></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="Modal4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="browsers3" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="https://www.bing.com"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    <?php
} else if (strcmp($_GET['type'], "Culture") == 0) {
    ?>
    <div id="sideButton1">
        <a data-toggle="modal" data-target="#Modal1"><img src="img/side/tlogo.png" /></a>
    </div>
    <div id="sideButton2">
        <a data-toggle="modal" data-target="#Modal2"><img src="img/side/glogo.png" /></a>
    </div>
    <div id="sideButton3">
        <a data-toggle="modal" data-target="#Modal4"><img src="img/side/browser.png" /></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="tripAdvisors4" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="<?php echo $row['TripAdvisor4']; ?>"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="Modal2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="googles4" class="mainFrame">
                <div class="wrap" id="google_div_model">
                                       <?php   include('main_google2.php');  ?>

                                        </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal3" tabindex="-1" role="dialog" aria-labelledby="Modal3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="yelps4" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src=""></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal4" tabindex="-1" role="dialog" aria-labelledby="Modal4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="browsers4" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="https://www.bing.com"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    <?php
} else {
    ?>
    <div id="sideButton1">
        <a data-toggle="modal" data-target="#Modal1"><img src="img/side/glogo.png" /></a>
    </div>
    <div id="sideButton2">
        <a data-toggle="modal" data-target="#Modal2"><img src="img/side/browser.png" /></a>
    </div>


    <div class="modal fade" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="googles5" class="mainFrame">
                <div class="wrap" id="google_div_model">
                                       <?php   include('main_google2.php');  ?>

                                        </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>

    <div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="Modal2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div id="browsers5" class="mainFrame">
                <div class="wrap">
                    <iframe class="frame" src="https://www.bing.com"></iframe>
                </div>
            </div>
            <div class="bottom-pop-btn">
            <button type="button" class="btn btn-secondary btnclose" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
<?php }
?>
<!-- Header -->
<header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)">
    <div class="container text-center">

        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">

                <h1>
                    <?php
                    $type = $_GET['type'];
                    if (strcmp($type, "Hotel") == 0)
                        echo $sec1;
                    else if (strcmp($type, "Restaurant") == 0)
                        echo $sec2;
                    else if (strcmp($type, "Loisirs") == 0)
                        echo $sec3;
                    else if (strcmp($type, "Culture") == 0)
                        echo $sec4;
                    else if (strcmp($type, "Product") == 0)
                        echo $sec5;
                    else if (strcmp($type, "Services") == 0)
                        echo $sec6;
                    ?>
                </h1>

            </div>
        </div>

    </div>
</header>
<!-- END Header -->




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
                        <a class="nav-link nav-user <?php echo $fr; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=fr">
                            <?php echo $lang1; ?>
                        </a>
                    </li>
                    <li class="nav-item w-140">
                        <a class="nav-link nav-user <?php echo $en; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=en">
                            <?php echo $lang2; ?>
                        </a>
                    </li>
                    <li class="nav-item w-140 hidden-sm-down">
                        <a class="nav-link nav-user <?php echo $spa; ?>" href="?status=true&type=<?php echo $_GET['type']; ?>&lang=spa">
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
                                <ul class="list-inline">
                                    <?php
                                    if (strcmp($_GET['type'], "Hotel") == 0) {
                                        ?>
                                        <li class="list-inline-item" id="btn1" onclick="showHotel(1);"><img src="img/trip.png" /></li>
                                        <li class="list-inline-item" id="btn2" onclick="showHotel(2);"><img src="img/booking.png" /></li>
                                        <li class="list-inline-item" id="btn3" onclick="showHotel(3);"><img src="img/google.png" /></li>
                                        <li class="list-inline-item" id="btn4" onclick="showHotel(4);"><img src="img/internet.png" /></li>
                                        <li class="list-inline-item" id="btn5" onclick="showHotel(5);"><img src="img/expedia.png" /></li>
                                        <li class="list-inline-item" id="btn6" onclick="showHotel(6);"><img src="img/zoover.png" /></li>
                                        <li class="list-inline-item" id="btn7" onclick="showHotel(7);"><img src="img/jaunes.png" /></li>
                                        <li class="list-inline-item" id="btn8" onclick="showHotel(8);"><img src="img/pilot.png" /></li>
                                        <li class="list-inline-item" id="btn9" onclick="showHotel(9);"><img src="img/fute.png" /></li>
                                        <?php
                                    } else if (strcmp($_GET['type'], "Restaurant") == 0) {
                                        ?>
                                        <li class="list-inline-item" id="btn1" onclick="showRestaurant(1);"><img src="img/trip.png" /></li>
                                        <li class="list-inline-item" id="btn2" onclick="showRestaurant(2);"><img src="img/la.png" /></li>
                                        <li class="list-inline-item" id="btn3" onclick="showRestaurant(3);"><img src="img/google.png" /></li>
                                        <li class="list-inline-item" id="btn4" onclick="showRestaurant(4);"><img src="img/internet.png" /></li>
                                        <li class="list-inline-item" id="btn5" onclick="showRestaurant(5);"><img src="img/jaunes.png" /></li>
                                        <li class="list-inline-item" id="btn6" onclick="showRestaurant(6);"><img src="img/pilot.png" /></li>
                                        <li class="list-inline-item" id="btn7" onclick="showRestaurant(7);"><img src="img/fute.png" /></li>
                                        <?php
                                    } else if (strcmp($_GET['type'], "Loisirs") == 0) {
                                        ?>
                                        <li class="list-inline-item" id="btn1" onclick="showLeisure(1);"><img src="img/trip.png" /></li>
                                        <li class="list-inline-item" class="list-inline-item" id="btn2" onclick="showLeisure(2);"><img src="img/google.png" /></li>
                                        <li class="list-inline-item" id="btn3" onclick="showLeisure(3);"><img src="img/internet.png" /></li>
                                        <li class="list-inline-item" id="btn4" onclick="showLeisure(4);"><img src="img/jaunes.png" /></li>
                                        <li class="list-inline-item" id="btn5" onclick="showLeisure(5);"><img src="img/pilot.png" /></li>
                                        <li class="list-inline-item" id="btn6" onclick="showLeisure(6);"><img src="img/fute.png" /></li>
                                        <?php
                                    } else if (strcmp($_GET['type'], "Culture") == 0) {
                                        ?>
                                        <li class="list-inline-item" id="btn1" onclick="showCulture(1);"><img src="img/trip.png" /></li>
                                        <li class="list-inline-item" class="list-inline-item" id="btn2" onclick="showCulture(2);"><img src="img/google.png" /></li>
                                        <li class="list-inline-item" id="btn3" onclick="showCulture(3);"><img src="img/internet.png" /></li>
                                        <li class="list-inline-item" id="btn4" onclick="showCulture(4);"><img src="img/jaunes.png" /></li>
                                        <li class="list-inline-item" id="btn5" onclick="showCulture(5);"><img src="img/pilot.png" /></li>
                                        <li class="list-inline-item" id="btn6" onclick="showCulture(6);"><img src="img/fute.png" /></li>
                                        <?php
                                    } else {
                                        ?>
                                        <li class="list-inline-item" class="list-inline-item" id="btn2" onclick="showOther(1);"><img src="img/google.png" /></li>
                                        <li class="list-inline-item" id="btn4" onclick="showOther(2);"><img src="img/internet.png" /></li>

                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                                $sql = "SELECT * FROM UserTable WHERE UID=" . $_SESSION['user_id'];
                                $result = $conn->query($sql);
                                $row = $result->fetch_assoc();
                                if (strcmp($_GET['type'], "Hotel") == 0) {
                                    ?>
                                    <div id="tripAdvisor1" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['TripAdvisor1']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="book1" class="mainFrame" style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Booking']; ?>"></iframe>
                                        </div>
                                        <br /><br /><br />
                                        <div class="wrap">
                                            <iframe class="frame" src=""></iframe>
                                        </div>
                                    </div>
                                    <div id="google1" class="mainFrame"  style="display:none;">
                                        <div class="wrap" id="google_div">
                                       <?php   include('main_google.php');  ?>

                                        </div>
                                    </div>
                                    <div id="browser1" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="https://www.bing.com"></iframe>
                                        </div>
                                        <small>Note: iFrames don't support all website.</small>
                                    </div>
                                    <div id="expedia" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Expedia']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="zoover" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Zoover']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="jaune1" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Jaune1']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="pilot1" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Pilot1']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="petit1" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Petit1']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <?php
                                } else if (strcmp($_GET['type'], "Restaurant") == 0) {
                                    ?>
                                    <div id="google2" class="mainFrame"  style="display:none;">
											                 <div class="wrap" id="google_div">
											                 <!--iframe class="frame" src=""></iframe-->
                                       <?php   include('main_google.php');  ?>

                                        </div>
                                    </div>
                                    <div id="yelp2" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src=""></iframe>
                                        </div>
                                    </div>
                                    <div id="tripAdvisor2" class="mainFrame" style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['TripAdvisor2']; ?>"></iframe>
                                        </div>
                                        <small>Note: iFrames don't support all website.</small>
                                    </div>
                                    <div id="laFour" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['LaFour']; ?>"></iframe>
                                        </div><br /><br />
                                        <div class="wrap">
                                            <iframe class="frame" src="https://www.myfourchette.com/service"></iframe>
                                        </div>
                                    </div>
                                    <div id="browser2" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="https://www.bing.com"></iframe>
                                        </div>
                                        <small>Note: iFrames don't support all website.</small>
                                    </div>
                                    <div id="jaune2" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Jaune2']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="pilot2" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Pilot2']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="petit2" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Petit2']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <?php
                                } else if (strcmp($_GET['type'], "Loisirs") == 0) {
                                    ?>
                                    <div id="tripAdvisor3" class="mainFrame" style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['TripAdvisor3']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="google3" class="mainFrame"  style="display:none;">
                                         <div class="wrap" id="google_div">
											 <!--iframe class="frame" src=""></iframe-->
                                       <?php   include('main_google.php');  ?>

                                        </div>
                                    </div>
                                    <div id="browser3" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="https://www.bing.com"></iframe>
                                        </div>
                                        <small>Note: iFrames don't support all website.</small>
                                    </div>
                                    <div id="jaune3" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Jaune3']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="pilot3" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Pilot3']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="petit3" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Petit3']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <?php
                                } else if (strcmp($_GET['type'], "Culture") == 0) {
                                    ?>
                                    <div id="tripAdvisor4" class="mainFrame" style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['TripAdvisor4']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="google4" class="mainFrame"  style="display:none;">
                                         <div class="wrap" id="google_div">
											 <!--iframe class="frame" src=""></iframe-->
                                       <?php   include('main_google.php');  ?>

                                        </div>
                                    </div>
                                    <div id="browser4" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="https://www.bing.com"></iframe>
                                        </div>
                                        <small>Note: iFrames don't support all website.</small>
                                    </div>
                                    <div id="jaune4" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Jaune4']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="pilot4" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Pilot4']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <div id="petit4" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="<?php echo $row['Petit4']; ?>"></iframe>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div id="google5" class="mainFrame"  style="display:none;">
                                         <div class="wrap" id="google_div">
											 <!--iframe class="frame" src=""></iframe-->
                                       <?php   include('main_google.php');  ?>

                                        </div>
                                    </div>
                                    <div id="browser5" class="mainFrame"  style="display:none;">
                                        <div class="wrap">
                                            <iframe class="frame" src="https://www.bing.com"></iframe>
                                        </div>
                                        <small>Note: iFrames don't support all website.</small>
                                    </div>

                                <?php }
                                ?>
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
