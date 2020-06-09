<?php
/**
 * QRcdr - php QR Code generator
 * index.php
 *
 * PHP version 5.3+
 *
 * @category  PHP
 * @package   QRcdr
 * @author    Nicola Franchini <info@veno.it>
 * @copyright 2015 Nicola Franchini
 * @license   item sold on codecanyon https://codecanyon.net/item/qrcdr-responsive-qr-code-generator/9226839
 * @version   Release: 1.9
 * @link      http://veno.es/qrcdr/
 */
error_reporting(E_ALL ^ E_NOTICE);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "qrcode/config.php";

session_name($_CONFIG['session_name']);


if (isset($_GET['reset'])) {
    unset($_SESSION['logo']);
}

global $_ERROR;

if (isset($_SESSION['error'])) {
    $_ERROR = $_SESSION['error'];
    unset($_SESSION['error']);
}

require "qrcode/lib/functions.php";

$browserDetect = array_key_exists('detect_browser_lang', $_CONFIG) ? $_CONFIG['detect_browser_lang'] : false;
$defaultlang = array_key_exists('lang', $_CONFIG) ? $_CONFIG['lang'] : 'en';

$lang = getLang($defaultlang, $browserDetect);

if (file_exists("qrcode/lang/" . $lang . ".php")) {
    include "qrcode/lang/" . $lang . ".php";
}

require "qrcode/head.php";
require "qrcode/lib/countrycodes.php";
?>

<link href="qrcode/css/bootstrap-colorpicker.css" rel="stylesheet"/>
<link href="qrcode/css/bootstrap-social.css" rel="stylesheet"/>

<link href="qrcode/css/qrcdr.css" rel="stylesheet"/>
<link href="qrcode/style.css" rel="stylesheet"/>

<div class="tab-pane1 fade show <?php echo $main; ?>" id="home">
    <div class="col-lg-12 text-center">

        <?php
        include('connection.php');
        $sql = "SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        ?>

        <div style="text-align: left;">
				      <span id="profileName">   
				      	<?php echo $qrcode_welcome; ?> <span>
				      <?php echo $row['Name']; ?> </span>!<br/>
				   <span style="font-size: 18px"><?php echo $qrcode_welcome_msg; ?></span>
				      </span>
        </div>
    </div>
</div>

<!-- QRcdr -->
<div class="container">

    <!-- language menu -->
    <?php //echo langMenu(); ?>
    <!-- end language menu -->
    <div class="row">
        <style>
            .avatar-article6{
                position: relative;
                left: -240px;
                top: 187px;
                width: 120px;
            }
            .bubble-article6 > span{
                position: absolute;
                top: -90px;
                left: 75px;
                width: 150px;
                font-size: 14px;
                max-height: 160px;
                font-weight: 900;
                line-height: 1.5;
            }
            .bubble-article6 > img{
                position: absolute;
                top: -180px;
                left: 35px;
                max-width: 210px;
                max-height: 200px;
                width: 210px;
                height: 200px;
            }

            .avatar-article-img6{
                position: absolute;
                top: 0px;
                width: 120px;
            }
            .nav-tabs.nav-qr > li {
                margin-bottom: 15px;

            }
            .nav-tabs.nav-qr > li > button {
                margin:0;
            }
            .nav-qr > li > button:focus, .nav-qr > li > button:hover,  .nav-qr > li > button.active {
                background-color: #0a92cf !important;
                border-color: #0a92cf !important;
                color: #fff !important;
                text-decoration: none;
            }
            .tab-pane1.show{
                display: block;
            }
            .tab-pane1.hide{
                display: none;
            }
            #create ul button {
                padding: 10px 15px;
                border: 0;
            }
        </style>
        <?php
        $sql = 'select avatar,bubble from UserTable where UID = "'.$_SESSION['user_id'].'"';
        $result = $conn->query($sql);
        $row = $result->fetch_array();
        if(is_null($row['avatar'])){
            $row['avatar'] = 1;
        }
        if(is_null($row['bubble'])){
            $row['bubble'] = 1;
        }
        ?>
        <div class="avatar-article avatar-article6">
            <div class="bubble-article6">
                <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
                <span><?=$avatarTextQr?></span>
            </div>
            <img class="avatar-article-img6" src="avatar/img/avatar/<?=$row['avatar']?>.png">
        </div>
        <div id="alert_placeholder">
            <?php
            if (strlen($_ERROR) > 0) { ?>
                <div class="alert alert-warning alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button><?php echo $_ERROR; ?>
                </div>
                <?php
            } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8 col-md-9 col-lg-8">


            <div class="row">
                <?php
                if ($_CONFIG['uploader'] == true) { ?>
                    <div class="col-sm-12">
                        <p class="small"><?php echo getString('upload_or_select_watermark'); ?></p>
                    </div>

                    <div class="col-sm-2">
                        <form method="post" action
                        "/qrcode/head.php" enctype="multipart/form-data" id="sottometti">
                        <div class="form-group">
                                    <span class="file-input btn btn-default btn-block btn-file">
                                    <i class="fa fa-upload"></i>
                                    <input type="file" name="file" id="file"/>
                                    </span>
                        </div>
                        </form>
                    </div>
                    <?php
                } ?>
                <?php
                /**
                 * Watermarks
                 */ ?>
                <form onsubmit="return false;" method="post" class="form" role="form" id="create">
                    <input type="hidden" name="section" id="getsec" value="<?php echo $getsection; ?>">

                    <?php
                    //
                    // Default watermarks
                    //
                    $waterdir = "qrcode/images/watermarks/";
                    $watermarks = glob($waterdir . '*.{gif,jpg,png}', GLOB_BRACE);
                    $count = count($watermarks);
                    if ($_CONFIG['uploader'] == true || $count > 0) { ?>
                        <div class="form-group col-sm-10">
                            <div class="logoselecta">
                                <div class="btn-group" data-toggle="buttons">

                                    <label class="btn btn-default <?php if ($optionlogo == "none" && $uploaded == false) echo "active"; ?>"
                                           data-toggle="tooltip" data-placement="bottom">
                                        <input type="radio" name="optionlogo" value="none"
                                            <?php if ($optionlogo == "none" && $uploaded == false) echo "checked"; ?>>
                                        <img src="https://review-thunder.com/qrcode/images/x.png">
                                    </label>
                                    <?php
                                    foreach ($watermarks as $key => $water) {
                                        echo '<label class="btn btn-default';
                                        if ($optionlogo == $water) echo ' active ';
                                        echo '" data-toggle="tooltip" data-placement="bottom">
        <input type="radio" name="optionlogo" value="' . $water . '"';
                                        if ($optionlogo == $water) echo ' checked';
                                        echo ' id="optionlogo' . $key . '"><img src="' . $water . '"></label>';
                                    }

                                    if ($logo && $upthumb) { ?>
                                        <label class="btn btn-default <?php if ($optionlogo == $upthumb || $uploaded == true) echo "active"; ?>">
                                            <input type="radio" name="optionlogo" id="optionsRadios6"
                                                   value="<?php echo $upthumb; ?>"
                                                <?php if ($optionlogo == $upthumb || $uploaded == true) echo "checked"; ?>>
                                            <img src="http://review-thunder.com/<?php echo $upthumb; ?>">
                                        </label>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>

                    <?php
                    /**
                     * MAIN QR CODE CONFIG
                     */ ?>
                    <div class="form-group col-sm-12">
                        <div class="row">
                            <div class="col-xs-6 col-md-3">
                                <label><?php echo getString('background'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon getcol"><i class="fa fa-qrcode"></i></span>
                                    <input type="text" class="form-control colorpickerback" data-format="hex"
                                           value="<?php echo $stringbackcolor; ?>" name="backcolor">
                                </div>
                            </div>

                            <div class="col-xs-6 col-md-3">
                                <label><?php echo getString('foreground'); ?></label>
                                <div class="input-group">
                                    <span class="input-group-addon getcol"><i class="fa fa-qrcode"></i></span>
                                    <input type="text" class="form-control colorpickerfront" data-format="hex"
                                           value="<?php echo $stringfrontcolor; ?>" name="frontcolor">
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-3">
                                <label><?php echo getString('size'); ?></label>
                                <select name="size" class="form-control">
                                    <?php
                                    for ($i = 4; $i <= 16; $i += 2) {
                                        $value = $i;
                                        echo '<option value="' . $i . '" ' . (($matrixPointSize == $i) ? ' selected' : '') . '>' . $value . '</option>';
                                    }; ?>
                                </select>
                            </div>

                            <div class="col-xs-6 col-md-3">
                                <label><?php echo getString('error_correction_level'); ?></label>
                                <select name="level" class="form-control">
                                    <option value="L" <?php if ($errorCorrectionLevel == "L") echo "selected"; ?>>
                                        <?php echo getString('precision_l'); ?>
                                    </option>
                                    <option value="M" <?php if ($errorCorrectionLevel == "M") echo "selected"; ?>>
                                        <?php echo getString('precision_m'); ?>
                                    </option>
                                    <option value="Q" <?php if ($errorCorrectionLevel == "Q") echo "selected"; ?>>
                                        <?php echo getString('precision_q'); ?>
                                    </option>
                                    <option value="H" <?php if ($errorCorrectionLevel == "H") echo "selected"; ?>>
                                        <?php echo getString('precision_h'); ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="trans-bg"
                                       name="transparent"><?php echo getString('transparent_background'); ?>
                            </label>
                        </div>
                    </div>

                    <?php
                    /**
                     * QR CODE DATA
                     */ ?>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <ul class="nav nav-tabs nav-qr">
                                <?php
                                if ($_CONFIG['link'] == true) { ?>
                                    <li class="<?php if ($getsection == "#link") echo "active"; else echo ''; ?>">
                                        <button data-href="link_qrcode" class="nav-link1" ><i
                                                    class="fa fa-link"></i> <span
                                                    class="hidden-xs hidden-sm"><?php echo getString('link'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['location'] == true) { ?>
                                    <li class="<?php if ($getsection == "#location") echo "active"; ?>">
                                        <button data-href="location" class="nav-link1 " ><i
                                                    class="fa fa-map-marker"></i> <span
                                                    class="hidden-xs hidden-sm"><?php echo getString('location'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['email'] == true) { ?>
                                    <li class="<?php if ($getsection == "#email11") echo "active"; ?>">
                                        <button data-href="email11" class="nav-link1 " ><i
                                                    class="fa fa-envelope-o"></i> <span
                                                    class="hidden-xs hidden-sm"><?php echo getString('email'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['text'] == true) { ?>
                                    <li class="<?php if ($getsection == "#text") echo "active"; ?>">
                                        <button data-href="text" class="nav-link1 " ><i
                                                    class="fa fa-align-left"></i> <span
                                                    class="hidden-xs hidden-sm"><?php echo getString('text'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['tel'] == true) { ?>
                                    <li class="<?php if ($getsection == "#tel") echo "active"; ?>">
                                        <button data-href="tel" class="nav-link1 " ><i class="fa fa-phone"></i>
                                            <span class="hidden-xs hidden-sm"><?php echo getString('phone'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['sms'] == true) { ?>
                                    <li class="<?php if ($getsection == "#sms") echo "active"; ?>">
                                        <button data-href="sms" class="nav-link1 " ><i class="fa fa-mobile"></i>
                                            <span class="hidden-xs hidden-sm"><?php echo getString('sms'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['wifi'] == true) { ?>
                                    <li class="<?php if ($getsection == "#wifi") echo "active"; ?>">
                                        <button data-href="wifi" class="nav-link1 " ><i class="fa fa-wifi"></i>
                                            <span class="hidden-xs hidden-sm"><?php echo getString('wifi'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['vcard'] == true) { ?>
                                    <li class="<?php if ($getsection == "#vcard") echo "active"; ?>">
                                        <button data-href="vcard" class="nav-link1 " ><i
                                                    class="fa fa-list-alt"></i> <span
                                                    class="hidden-xs hidden-sm"><?php echo getString('vcard'); ?></span></button>
                                    </li>
                                    <?php
                                }
                                if ($_CONFIG['paypal'] == true) { ?>
                                    <li class="<?php if ($getsection == "#paypal") echo "active"; ?>">
                                        <button data-href="paypal" class="nav-link1 " ><i
                                                    class="fa fa-paypal"></i> <span
                                                    class="hidden-xs hidden-sm"><?php echo getString('paypal'); ?></span></button>
                                    </li>
                                    <?php
                                } ?>
                            </ul>
                            <div class="tab-content">
                                <?php
                                //
                                // LINK
                                //
                                if ($_CONFIG['link'] == true) { ?>
                                    <div class="tab-pane1 show" id="link_qrcode">
                                        <div class="form-group">
                                            <label><?php echo getString('link'); ?></label>
                                            <input type="url" name="link" class="form-control"
                                                   value="<?php if ($getsection === "#link" && $output_data) echo $output_data; ?>"
                                                   placeholder="http://"/>
                                        </div>
                                    </div>
                                    <?php
                                }
                                //
                                // LOCATION
                                //
                                if ($_CONFIG['location'] == true) { ?>
                                    <div class="tab-pane1 hide " id="location">
                                        <?php
                                        if ($_CONFIG['google_api_key'] == 'YOUR-API-KEY' || strlen($_CONFIG['google_api_key']) < 10) { ?>
                                            <p class="lead">Please set a <strong>google_api_key</strong> inside <strong>config.php</strong><br>
                                                <a target="_blank"
                                                   href="https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key">
                                                    &gt; How to get an api key for Gmaps
                                                </a>
                                            </p>
                                        <?php
                                        } else { ?>
                                            <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $_CONFIG['google_api_key']; ?>&libraries=places"></script>
                                            <div style="min-height:350px">
                                                <div id="latlong">
                                                    <input id="pac-input" class="controls" type="text"
                                                           placeholder="<?php echo getString('search'); ?>">
                                                    <input type="text" id="latbox"
                                                           placeholder="<?php echo getString('latitude'); ?>"
                                                           class="controls" name="lat" readonly>
                                                    <input type="text" id="lngbox"
                                                           placeholder="<?php echo getString('longitude'); ?>"
                                                           class="controls" name="lng" readonly>
                                                </div>
                                                <div id="map-canvas"></div>
                                            </div>
                                            <?php
                                        } ?>
                                    </div>
                                    <?php
                                }
                                //
                                // E-MAIL
                                //
                                if ($_CONFIG['email'] == true) { ?>
                                    <div class="tab-pane1 hide" id="email11">
                                        <div class="row form-group">
                                            <div class="col-xs-6">
                                                <label><?php echo getString('send_to'); ?></label>
                                                <input type="email" name="mailto" placeholder="E-Mail"
                                                       class="form-control">
                                            </div>
                                            <div class="col-xs-6">
                                                <label><?php echo getString('subject'); ?></label>
                                                <input type="text" name="subject" class="form-control">
                                            </div>
                                            <div class="col-xs-12">
                                                <label><?php echo getString('text'); ?></label>
                                                <textarea name="body" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                //
                                // TEXT
                                //
                                if ($_CONFIG['text'] == true) { ?>
                                    <div class="tab-pane1 hide" id="text">
                                        <div class="form-group">
                                            <label><?php echo getString('text'); ?></label>
                                            <textarea rows="3" name="data"
                                                      class="form-control"><?php if ($getsection === "#text" && $output_data) echo $output_data; ?></textarea>
                                        </div>
                                    </div>
                                    <?php
                                }
                                //
                                // TEL
                                //
                                if ($_CONFIG['tel'] == true) { ?>
                                    <div class="tab-pane1 hide " id="tel">
                                        <div class="row">

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><?php echo getString('country_code'); ?></label>
                                                    <?php
                                                    $output = "<select class=\"form-control\" name=\"countrycodetel\">";
                                                    foreach ($countries as $i => $row) {
                                                        $output .= "<option value=\"" . $row['code'] . "\" label=\"" . $row['name'] . "\">" . $row['name'] . "</option>\n";
                                                    }
                                                    $output .= '</select>';
                                                    echo $output;
                                                    ?>
                                                </div>
                                            </div>


                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label><?php echo getString('phone_number'); ?></label>
                                                    <input type="text" type="number" name="tel" placeholder=""
                                                           class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                //
                                // SMS
                                //
                                if ($_CONFIG['sms'] == true) { ?>
                                    <div class="tab-pane1 hide " id="sms">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label><?php echo getString('country_code'); ?></label>
                                                    <?php
                                                    $output = "<select class=\"form-control\" name=\"countrycodesms\">";
                                                    foreach ($countries as $i => $row) {
                                                        $output .= "<option value=\"" . $row['code'] . "\" label=\"" . $row['name'] . "\">" . $row['name'] . "</option>\n";
                                                    }
                                                    $output .= '</select>';
                                                    echo $output;
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label><?php echo getString('phone_number'); ?></label>
                                                    <input type="text" name="sms" placeholder="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-sm-12">

                                                <div class="form-group">
                                                    <label><?php echo getString('text'); ?></label>
                                                    <textarea rows="3" name="bodysms" class="form-control"></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                //
                                // WI FI
                                //
                                if ($_CONFIG['wifi'] == true) { ?>
                                    <div class="tab-pane1 hide " id="wifi">
                                        <div class="row form-group">
                                            <div class="col-xs-4">
                                                <label><?php echo getString('network_name'); ?></label>
                                                <input type="email" name="ssid" placeholder="SSID" class="form-control">
                                            </div>
                                            <div class="col-xs-4">
                                                <label><?php echo getString('network_type'); ?></label>
                                                <select class="form-control" name="networktype">
                                                    <option value="WEP">WEP</option>
                                                    <option value="WPA">WPA/WPA2</option>
                                                    <option vlasue=""><?php echo getString('no_encryption'); ?></option>
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <label><?php echo getString('password'); ?></label>
                                                <input type="text" name="wifipass" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                //
                                // V CARD
                                //
                                if ($_CONFIG['vcard'] == true) { ?>
                                    <div class="tab-pane1 hide " id="vcard">
                                        <div class="row form-group">
                                            <div class="col-xs-6">
                                                <label><?php echo getString('first_name'); ?></label>
                                                <input type="text" name="vname" class="form-control">
                                            </div>
                                            <div class="col-xs-6">
                                                <label><?php echo getString('last_name'); ?></label>
                                                <input type="text" name="vlast" class="form-control">
                                            </div>

                                            <div class="col-xs-6">
                                                <label><?php echo getString('phone_number'); ?></label>
                                                <input type="text" name="vphone" class="form-control">
                                            </div>
                                            <div class="col-xs-6">
                                                <label><?php echo getString('mobile'); ?></label>
                                                <input type="text" name="vmobile" class="form-control">
                                            </div>

                                            <div class="col-xs-6">
                                                <label><?php echo getString('email'); ?></label>
                                                <input type="email" name="vemail" class="form-control">
                                            </div>

                                            <div class="col-xs-6">
                                                <label><?php echo getString('website'); ?></label>
                                                <input type="text" name="vurl" class="form-control"
                                                       placeholder="http://">
                                            </div>

                                            <div class="col-xs-12">
                                                <label><?php echo getString('company'); ?></label>
                                                <input type="text" name="vcompany" class="form-control">
                                            </div>

                                            <div class="col-xs-6">
                                                <label><?php echo getString('jobtitle'); ?></label>
                                                <input type="text" name="vtitle" class="form-control">
                                            </div>


                                            <div class="col-xs-6">
                                                <label><?php echo getString('fax'); ?></label>
                                                <input type="text" name="vfax" class="form-control">
                                            </div>


                                            <div class="col-xs-12">
                                                <label><?php echo getString('address'); ?></label>
                                                <textarea name="vaddress" class="form-control"></textarea>
                                            </div>
                                            <div class="col-sm-4">
                                                <label><?php echo getString('city'); ?></label>
                                                <input type="text" name="vcity" class="form-control">
                                            </div>
                                            <div class="col-sm-4 col-xs-6">
                                                <label><?php echo getString('post_code'); ?></label>
                                                <input type="text" name="vcap" class="form-control">
                                            </div>
                                            <div class="col-sm-4 col-xs-6">
                                                <label><?php echo getString('state'); ?></label>
                                                <input type="text" name="vcountry" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }

                                //
                                // PAYPAL
                                //
                                if ($_CONFIG['paypal'] == true) { ?>
                                    <div class="tab-pane1 hide" id="paypal">
                                        <div class="row form-group">

                                            <div class="col-sm-6">
                                                <label><?php echo getString('type'); ?></label>
                                                <select class="form-control" name="pp_type" id="pp_type">
                                                    <option value="_xclick"><?php echo getString('buy_now'); ?></option>
                                                    <option value="_cart"><?php echo getString('add_to_cart'); ?></option>
                                                    <option value="_donations"><?php echo getString('donations'); ?></option>
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <label><?php echo getString('email'); ?></label>
                                                <input type="email" name="pp_email" class="form-control">
                                                <small><?php echo getString('pp_email'); ?></small>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-xs-8">
                                                <label><?php echo getString('item_name'); ?></label>
                                                <input type="text" name="pp_name" class="form-control">
                                            </div>

                                            <div class="col-xs-4">
                                                <label><?php echo getString('item_id'); ?></label>
                                                <input type="text" name="pp_id" class="form-control">
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-xs-6 col-sm-3 yesdonation">
                                                <label><?php echo getString('price'); ?></label>
                                                <input type="text" name="pp_price" class="form-control">
                                            </div>

                                            <div class="col-xs-6 col-sm-3 yesdonation">

                                                <label><?php echo getString('currency'); ?></label>
                                                <select class="form-control" name="pp_currency" id="setcurrency">
                                                    <option value="USD">USD</option>
                                                    <option value="EUR">EUR</option>
                                                    <option value="AUD">AUD</option>
                                                    <option value="CAD">CAD</option>
                                                    <option value="CZK">CZK</option>
                                                    <option value="DKK">DKK</option>
                                                    <option value="HKD">HKD</option>
                                                    <option value="HUF">HUF</option>
                                                    <option value="JPY">JPY</option>
                                                    <option value="NOK">NOK</option>
                                                    <option value="NZD">NZD</option>
                                                    <option value="PLN">PLN</option>
                                                    <option value="GBP">GBP</option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="SEK">SEK</option>
                                                    <option value="CHF">CHF</option>
                                                </select>
                                            </div>

                                            <div class="col-xs-6 col-sm-3 nodonation">
                                                <label><?php echo getString('shipping'); ?></label>
                                                <div class="input-group">
                                                    <input type="text" name="pp_shipping" class="form-control"
                                                           placeholder="0.00">
                                                    <span class="input-group-addon" id="getcurrency">USD</span>
                                                </div>
                                            </div>
                                            <div class="col-xs-6 col-sm-3 nodonation">
                                                <label><?php echo getString('tax_rate'); ?></label>
                                                <div class="input-group">
                                                    <input type="text" name="pp_tax" class="form-control"
                                                           placeholder="0.00">
                                                    <span class="input-group-addon">%</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div> <!-- tab content -->
                        </div> <!-- form group -->
                    </div><!-- col sm12-->
                </form>
            </div> <!-- row -->
        </div><!-- col sm-8 -->

        <div class="col-sm-4 col-md-3 col-lg-4">
            <?php
            //
            // FINAL QR CODE placeholder
            //
            ?>
            <div class="placeresult">
                <div class="form-group text-center wrapresult">
                    <div class="resultholder">
                        <img src="qrcode/<?php echo $_CONFIG['placeholder']; ?>"/>
                    </div>
                </div>
                <div class="preloader"><i class="fa fa-cog fa-spin"></i></div>
                <div class="form-group text-center linksholder"></div>
                <button class="btn btn-lg btn-block btn-primary" id="submitcreate">
                    <i class="fa fa-magic"></i> <?php echo getString('generate_qrcode'); ?></button>
                <button class="btn btn-lg btn-block btn-primary hide_share">
                    <i class="fa fa-share-alt"></i><?= getString('share_qr'); ?></button>
                <div id="social_share"></div>


            </div>

        </div><!-- col sm4-->
    </div><!-- row -->

    <script src="qrcode/js/jquery-3.2.1.min.js"></script>
    <script src="qrcode/js/bootstrap.min.js"></script>
    <script src="qrcode/js/bootstrap-colorpicker.min.js"></script>

    <script src="qrcode/js/all.js"></script>
    <script>

    </script>

</div><!-- container -->
       

    