<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

<?php
session_start();
//include('navbar.php');
if (strcmp($_SESSION['language'], 'en') == 0) {

    $mu_business = "My Business";
    $Manage_locations = "Manage locations";
    $Location = "Location";
    $All_locations = "All locations";
    $loc_name = "Name";
    $loc_Status = "Status";
    $Published = "Published";
    $home_loc = "Home";
    $loc_Review = "Review";
    $loc_info = "Info";
    $loc_photo = "Foto";
    $loc_all = "All";
    $loc_REPLIED = "REPLIED";
    $hav_replied = "HAVEN'T REPLIED";
    $Owner = "Owner";
    $v_edit = "View and Edit";
    $loc_REPLY = "REPLY";
    $info_title = "HELLO!";
    $info_details = "Review Thunder enables you to answer to your different customer’s reviews and so much more !
Numerous Advices are present withing our Blog in order to help you answer to your reviews and to help you understand the global 
management of Reviews. 
In the case you have any idea about articles or any questions, please feel free to contact us. It will always be a lpeasure to answer ! 
With our warmest regards !";
    $google_map_info = "Your business is live on Google";
    $view_map = "View on Maps";
    $phpto_del = "Remove";
} else if (strcmp($_SESSION['language'], 'spa') == 0) {

    $mu_business = "MyBusiness";
    $Manage_locations = "Gestionar los Establecimientos";
    $Location = "Établicimientos";
    $All_locations = "Todos los lugares";
    $loc_name = "Nombre";
    $loc_Status = "Estatuto";
    $Published = "Publicado";
    $home_loc = "Acogida";
    $loc_Review = "Calificaciones";
    $loc_info = "Información";
    $loc_photo = "Foto";
    $loc_all = "Todo";
    $loc_REPLIED = "Réponse reçue";
    $hav_replied = "Sin Respuestas";
    $Owner = "Propietario";
    $v_edit = "Afficher et modifier";
    $loc_REPLY = "Responder o Modificar";
    $info_title = "Holà !";
    $info_details = "Review Thunder te ofrece la posibilidad de responder a tus Calificaciones.Puedes encontrar muchos consejos dentro de nuestro Blog para ayudar te a Responder a tus Calificacionces i entender todo el Managment de ellas. En el caso que tienes ideas para Articulos o si necesitas informaciones para utilisar este software, puedes llamar nos i sera un placer de ayudar te. 
			Hasta Pronto !";
    $google_map_info = "Tu Empresa Esta online";
    $view_map = "Ver sobre la Mapa";
    $phpto_del = "Suprimir";
} else {

    $mu_business = "MyBusiness";
    $Manage_locations = "Gérer les Établissements";
    $Location = "Établissements";
    $All_locations = "Tous les lieux";
    $loc_name = "Nom";
    $loc_Status = "Statut";
    $Published = "Publié";
    $home_loc = "Accueil";
    $loc_REPLIED = "Réponse reçue";
    $loc_Review = "Commentaires";
    $loc_info = "Info";
    $loc_photo = "Photo";
    $loc_all = "TOUT";
    $hav_replied = "Aucune Réponse";
    $Owner = "Propriétaire";
    $v_edit = "Afficher et modifier";
    $loc_REPLY = "RÉPONDRE";
    $info_title = "BONJOUR !";
    $info_details = "Review Thunder vous offre la possibilité de répondre à vos différents avis clients.
			De nombreux conseils sont présents au sein du Blog pour vous aider dans la préparation de vos réponses ainsi que dans la compréhension du processus Global de la Gestion de vos Avis Clients. Dans le cas vous auriez des questions ou des idées de Thèmes d’Articles pour le Blog surtout n’hésitez pas à nous contacter ! 
			A bientôt !";
    $google_map_info = "Votre Entreprise est en ligne sur";
    $view_map = "Voir sur la Carte";
    $phpto_del = "Supprimer";
}
?>

<?php

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>


<?php
include_once "connection.php";
session_start();
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `oauth_user` where user_id=" . $_SESSION['user_id'];
$result = $conn->query($sql);
$data = $result->fetch_array();
//$access=	json_decode($_SESSION['access_token']);
$access_token = $data['access_token'];
$curl = curl_init();
$name = $_REQUEST['name'];
$name = "accounts/100928649975105038548/locations/12481351387678745559";
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v3/" . $name,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $access_token,
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);
$res = json_decode($response);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v3/categories?regionCode=US&languageCode=fr&searchTerm=Hôtel",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $access_token,
    ),
));

$response0 = curl_exec($curl);
$err = curl_error($curl);
$catgories = json_decode($response0);
/* echo "<pre>";
  print_r($catgories);
  die; */

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v3/" . $name . "/reviews",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer " . $access_token,
    ),
));

$response1 = curl_exec($curl);
$err = curl_error($curl);

$with_reply = array();
$without_reply = array();
$comment = json_decode($response1);
foreach ($comment->reviews as $comment_reply) {
    if (isset($comment_reply->reviewReply)) {
        $with_reply[] = $comment_reply;
    } else {
        $without_reply[] = $comment_reply;
    }
}
 echo "<pre>";
  print_r($res);  echo "</pre>"; 
?>
<style>
    .checked {
        color: orange;
    }
</style>

<section class="google-demo">    
    <div class="tab-pane fade " id="photo" role="tabpanel" aria-labelledby="photo-tab">
                            <div class="location-content">
                                <div class="full-location">
                                    <!-- <ul class="location-title">
                                      <li>Photo</li>
                                                          
                                    </ul>  
                                    --> 
<div id="model_media" class="modal" >
                                            <div class="modal-inner-pop">
                                            <div class="feature-box">
                                                <div class="feature-box-inner">
                                                    <h3>Website</h3><br>
                                                    <p class="text">Enter URLs to improve business info. Only enter URLs with live websites.</p>
<form id="data" method="post" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <p class="primary">Website</p>
														<input type="hidden" name="acc_name" value="<?php echo $res->name; ?>"  />
														<input type="hidden" name="loc_media" value="media"  />
                                                        <input class="form-control" name="media_loc" id="id_media_loc" type ="file" value="<?php echo $res->websiteUrl; ?> "  />
                                                    </div>
                                                    <div class="btn-data">
                                                        <button onclick="cancel_btn();"  class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                        <button  class="btn cust-btn " type="submit">Apply</button>
                                                    </div>
													</form>
                                                </div>
                                                <div class="note"><b>Please note:</b> Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>

                                            </div>
                                            </div>
                                            <!--div class="modal-content">
                                            <span class="close">&times;</span>
                                            <p><input name="websiteUrl" id="id_websiteUrl" type ="text" value="<?php echo $res->websiteUrl; ?> "  /></p>
                                            <a id="saveLocation" onclick="Location_websiteUrl();" href="javascript:void(0);">Save</a>
                                            </div-->
                                        </div>									
<a id="btn_media"  href="javascript:void(0);">Add Image</a>							
                                    <div class="photo-title">
                                        <?php foreach ($res->photos->interiorPhotoUrls as $key1 => $res1) { ?>
                                            <div id="div_image_<?php echo $key1; ?>">
                                                <img height="200px" width="200px" src='<?php echo $res1; ?>'>	
                                    <!--a class="img_del" onclick="delete_media('<?php echo $key1 ?>','<?php echo $name; ?>');"; href="javascript:void(0);"><?php echo @$phpto_del; ?></a-->
                                                <div class="delete-icon">  <a class="img_del remove-btn" onclick="delete_media('<?php echo $key1 ?>', '<?php echo $name; ?>');"; href="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div></div>
                                            <?php
                                        }
                                        ?>				  

                                    </div>

                                </div>
                            </div>
                        </div>
						</section>
<script>
document.getElementById('btn_media').onclick = function () {

        $("#model_media").show();
    }
	$("form#data").submit(function(e) {
		 e.preventDefault();    
    var formData = new FormData(this);

    $.ajax({
        url: "gbm/edit/loc_e.php",
        type: 'POST',
        data: formData,
        success: function (data) {
            alert(data)
        },
        cache: false,
        contentType: false,
        processData: false
    });
	});
	   
    function delete_media(key, name) {

        var url = "gbm/examples/delete_media.php";

        $.ajax({
            type: "POST",
            url: url,
            data: {'key': key, 'name': name}, // serializes the form's elements.
            success: function (data)
            {
                $("#div_image_" + id).remove();


            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function review_reply(id, hideshow, tab) {

        if (hideshow == "open") {
            $("#" + tab + "div_" + id).show();
        } else {
            $("#" + tab + "div_" + id).hide();
        }

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function reply_post(id, name, tab) {
        var url = "gbm/examples/review_post.php";
        var text = $("#" + tab + "text_" + id).val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, 'text': text, 'name': name}, // serializes the form's elements.
            success: function (data)
            {
                if (data == "done") {
                    $("#" + tab + "div_" + id).hide();
                    $('#' + tab + 'replay_comment_' + id).html(text);

                    $("#" + tab + "div_rely_owner_" + id).show();

                }

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function review_delete(id, name, tab) {
        var url = "gbm/examples/review_delete.php";
        var text = $("#" + tab + "text_" + id).val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'id': id, 'text': text, 'name': name}, // serializes the form's elements.
            success: function (data)
            {
                if (data == "done") {
                    $("#" + tab + "div_" + id).hide();
                    $('#' + tab + 'replay_comment_' + id).html('');

                    $("#" + tab + "div_rely_owner_" + id).hide();

                }

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
</script>


<script>



  
    function cancel_btn() {
        $('.modal').hide();

    }
   


   
</script>
<link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">

<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
<script>
$('.start_hour').timepicker({  timeFormat: 'G:i', show2400: true } );
$('.end_hours').timepicker({ timeFormat: 'G:i', show2400: true });
</script>
<style>
.html_time {
  float: left;
  font-size: 13px;
  font-weight: 400;
  padding-left: 10px;
  width: 80%;
}
.info-number span {
  font-size: 13px;
  font-weight: 400;
}
.info-number li i {
    font-size: 14px;
    float: left;
    width: 12px;
    margin-right: 0 !important;
}
.info-number ul li {
    width: 100%;
    display: inline-block;
}
.info-number span {
    font-size: 13px;
    font-weight: 400;
    width: 80%;
    float: left;
    padding-left: 10px;
}
    .feature-box {
        text-align: center;
        border-radius: 10px;
        margin-bottom: 20px;
        width:70%;
        margin: 0 auto;
        background: #fff;
    }
    .form-group input {
        border-top: none !important;
        border-right: none !important;
        border-left: none !important;
        border-bottom:2px solid #2196f3 !important;
        box-shadow: none !important;
        width:90%;
        font-size:18px;
    }
    .cust-btn {
        margin-bottom: 10px;
        background-color: #f8204f;
        border-width: 2px;
        border-color: #f8204f;
        color: #fff;
        font-size: 16px;
        letter-spacing: 1px;
        padding: 8px 19px;
        border: none;
        border-radius: 5px;
    }
 .model{
           align-items: center !important;
    display: flex !important;
    }
    .note{
        color: #70757a;
        -webkit-flex-shrink: 0;
        flex-shrink: 0;
        padding: 16px 24px;
        text-align: left;
    }
    .note a {
        color: #1a73e8;
        text-decoration: none;
    }
    .text {
        font-size: 18px;
        color: #8e8a8a;
        text-align: left;
    }
    .form-group {
        width: 100%;
        padding-left: 0;
    }
    .form-group input{
        width: 100%;
    }

    .feature-box h3 {
        float: left;
        width: 100%;
        text-align: left;

    }
    .btn-data button.btn.cust-btn {
        background: transparent;
        color: #000;
        padding: 5px 10px;
    }
    .btn-data {
        text-align: right;
        margin-top: 20px;
    }
    .btn-data .cust-btn:hover {
        border:0 none;
        color:#1a73e8 !important;
    }
    .feature-box-inner {
        padding: 20px;
    }
    body{

        font-family: sans-serif;
    }
    .feature-box-inner h3 {
        color: #3b3c3e;
        font-size: 18px;
    }
    p.primary {
        text-align: left;
        color: gray;
    }
    .primary-add {
        color: #1a73e8;
    }
    .radio {
        text-align: left;
    }
    .information-column {
        margin-top: 53px;
    }
    .input-field {
        width: 33%;
    }
    .adword-feature-box {
        text-align: center;
        border-radius: 10px;
        margin-bottom: 20px;
        width: 31%;
        margin: 0 auto;
        background: #fff;
    }
    .adword-form-group input {
        border-top: none !important;
        border-right: none !important;
        border-left: none !important;
        border-bottom:2px solid #2196f3 !important;
        box-shadow: none !important;
        width:90%;
    }
    .adword-cust-btn {
        margin-bottom: 10px;
        background-color: #f8204f;
        border-width: 2px;
        border-color: #f8204f;
        color: #fff;
        font-size: 16px;
        letter-spacing: 1px;
        padding: 8px 19px;
        border: none;
        border-radius: 5px;
    }
    .adword-note{
        background-color: #f8f9fa;
        color: #70757a;
        -webkit-flex-shrink: 0;
        flex-shrink: 0;
        padding: 16px 24px;
    }
    .adword-note a {
        color: #1a73e8;
        text-decoration: none;
    }
    .adword-form-group {
        width: 100%;
        line-height: 50px;
        padding-left: 0;
    }
    .adword-form-group input{
        width: 100%;
    }

    .adword-feature-box h3 {
        float: left;
        width: 100%;
        text-align: left;
    }
    .adword-feature-box-inner {
        padding: 20px;
    }
    .adword-feature-box-inner h3 {
        color: #3b3c3e;
        font-size: 18px;
        font-weight: normal;
    }
    .adword-form-group label > span {
        position: absolute;
        top: -25px;
        left: 0;
        font-size: 12px;
        color: #bdc3c7; 
        opacity: 1;
    }
    .adword-form-group label {
        position: relative;
        float: left;
    }         
    .adword-form-group input{
        max-width: 235px;
        height: 40px;
        overflow: hidden;
        line-height: 40px;
        background-color: transparent;
        border: none;
        border-bottom: 1px dotted;
        vertical-align: text-bottom;
        cursor: pointer;
    }            
    .adword-primary {
        margin-bottom: 3px;
        margin-right: 69px;
        color: #1a73e8;
    }
    .adword-primary-add {
        color: #1a73e8;
        text-align: left;
    }
    select {
        float: left;
        width: 18%;
        border: none;
        margin-top: 23px;
    }
    .adword-text {
        font-size: 18px;
        color: #8e8a8a;
        text-align: left;
    }


.advanced-span {
  display: inline-block;
  width: 40%;
}
    .add-feature-box {
        text-align: left;
        border-radius: 10px;
        margin-bottom: 20px;
        width: 70%;
        margin: 0 auto;
        background: #fff;
    }
    .switch input { 
        display:none;
    }
    .switch {
        display:inline-block;
        width:60px;
        height:30px;
        margin:8px;
        transform:translateY(50%);
        position:relative;
    }

    .slider {
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        right:0;
        border-radius:30px;
        box-shadow:0 0 0 2px #777, 0 0 4px #777;
        cursor:pointer;
        border:4px solid transparent;
        overflow:hidden;
        transition:.4s;
    }
    .slider:before {
        position:absolute;
        content:"";
        width:50%;
        height:100%;
        background:#777;
        border-radius:30px;
        transform:translateX(5px);
        transition:.4s;
    }

    input:checked + .slider:before {
        transform:translateX(22px);
        background:limeGreen;
    }
    .radio-button p {
        width: 12%;
        display: inline-block;
    }

    .radio-button p:last-child {
        width: 12%;
        display: inline-block;
        padding-left: 15px;
    }
    .add-feature-box-inner h3 {
        color: #3b3c3e;
        font-size: 18px;
    }


    .opening-feature-box {
        text-align: center;
        border-radius: 10px;
        margin-bottom: 20px;
        width: 31%;
        margin: 0 auto;
        background: #fff;
    }
    .opening-feature-box h3 {
        float: left;
        width: 100%;
        text-align: left;
    }
    fieldset.date {
        margin: 0;
        padding: 0;
        display: block;
        border: none;
        text-align: left;
    }

    fieldset.date legend { 
        margin: 0; 
        padding: 0; 
        margin-top: .25em; 
        font-size: 100%; 
    } 
    fieldset.date label { 
        position: absolute; 
        top: -20em; 
        left: -200em; 
    } 
    fieldset.date select {
        margin: 0;
        padding: 0;
        font-size: 100%;
        display: inline;
        border: none;
        border-bottom: 1px solid #555;
        width: 98px;
    }
    span.inst { 
        font-size: 75%; 
        color: blue; 
        padding-left: .25em; 
    } 
    .primary-add {
        text-align: left;
        font-weight: bold;
        color: #1a73e8;
        cursor: pointer;
    }

    .phone-primary {
        margin-bottom: 3px;
        margin-right: 69px;
        color: #1a73e8;
    }

    .store-primary {
        text-align: left;
        color:#2196f3;
    }



    .photo-title div a {
        color: #000;
        font-weight: 400;
    }
    .photo-title div {
        width: 49%;
        display: inline-block;
        margin-bottom: 25px;
        text-align: right;
    }
    .reply-msg textarea {
        border-left: 0 none;
        border-radius: 0;
        border-right: 0 none;
        border-top: 0 none;
        // height: auto;
        margin-top: 15px;
        /* max-height: 35px;*/
        padding: 0;
        border-bottom: 1px solid #ddd;
        margin-bottom: 15px;
    }
    .reply-msg .form-control:focus {
        background-color: #ffffff;
        border-color: #ddd;
        box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
        color: #495057;
        outline: 0 none;
    }
    .reply-msg input {
        background: transparent;
        border: 1px solid transparent;
        border-radius: 5px;
        line-height: 26px;
        margin-top: 0;
        padding: 0px 25px 4px 0;
        color: #616771;
        font-size: 13px;
    }
    .reply-msg input:hover{
        background: transparent;
        box-shadow: 0 0px 0px transparent;
        border: 1px solid transparent;
        color:#616771;
    }
    a:hover{
        text-decoration: none;
    }
    .inner-review {
        border: 1px solid #454545;
        padding: 50px 0 20px 0;
    }
    .full-row {
        box-shadow: 0px 4px 3px 0 #050505;
        padding: 0 15px 20px;
        width: 100%;
        z-index: 9999;
        display: inline-block;
    }
    .full-row ul{
        margin:0;
    }
    .full-row img {
        margin-right: 15px;
    }
    .full-row ul {
        list-style: outside none none;
        padding: 0;
    }
    .full-row ul li{
        display: inline-block;
    }
    .full-row ul li:nth-child(2) img{
        margin-right: 3px;
    }
    .inner-tabview {
        background: #f0f0f0;
        display: table;
        padding: 20px 0;
        width: 100%;
    }
    .inner-tabview .left-bar {
        float: left;
        width: 25%;
        padding-top: 25px;
    }
    .inner-tabview .right-bar {
        float: right;
        padding:20px 70px;
        width: 75%;
    }
    #myTab.nav {
        display: block;
        width: 100%;
    }
    .nav-tabs .nav-item {
        margin-bottom: 0;
    }
    .nav-tabs {
        border-bottom: 0px;
    }
    .nav-tabs li a{
        color: #454545;
        font-size: 16px;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        background-color: #d7d7d7;
        border: 0 none;
        color: #000;
        font-size: 16px;
    }
    .nav-tabs .nav-link {
        border: 0px;
        border-top-left-radius: 0;
        border-top-right-radius:0;
    }
    .photo-title img {
        margin-bottom: 4px;
    }
    .nav-link {
        display: block;
        padding: 13px 1rem;
    }
    .left-bar h2 {
        font-size: 18px;
        font-weight: bold;
        padding-left: 15px;
    }
    .left-bar p {
        font-size: 16px;
        padding-left: 15px;
    }
    #myTab2 li a {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    }
    #myTab2.nav-tabs .nav-item.show .nav-link, #myTab2.nav-tabs .nav-link.active {
        background-color: transparent;
        border: 0 none;
        color: #0776ff;
        border-bottom: 2px solid #0776ff; 
    }
    #myTab2.nav-tabs {
        border-bottom: 2px solid #dddddd;
    }
    .right-bar .tab-content.second {
        background: #ffffff none repeat scroll 0 0;
        margin-top: 20px;
        display: inline-block;
        width: 100%;
    }
    .review-user {
        list-style: outside none none;
        display: inline-block;
        width: 100%;
        padding: 0;
        margin-bottom: 0;
    }
    .review-list ul{
        list-style: outside none none;
        display: inline-block;
        width: 100%;
        padding: 0;
        margin-bottom: 0;
    }
    .review-user li {
        float: left;
    }
    .review-user li:first-child {
        margin-right: 15px;
    }
    .review-user li:last-child {
        float: right;
    }
    .inner-star-rating {
        padding: 0 55px 0 55px;
    }
    .review-user li h5 {
        font-size: 18px;
        margin-bottom: 0;
        margin-top: 6px;
    }
    .rE::before {
  background: #1a73e8;
  border-radius: 10px 10px 0 0;
  content: "";
  height: 5px;
  left: 0;
  position: absolute;
  top: 0;
  width: 100%;
}
    .rE {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 15px;
  margin-bottom: 20px;
  position: relative;
}
    .review-user li p {
        font-size: 14px;
        margin-bottom: 0;
        margin-top: 0px;
        color: #969696;
    }
    .star-rating li {
        float: left !important;
        margin-right: 5px !important;
    }
    .star-rating li a{
        color: #d3d3d3;
    }
    .star-rating li.orange a{
        color: #ed6c20;
    }
    .star-rating li a:hover, .star-rating li a:active, .star-rating li a:focus{
        color: #ed6c20;
    }
    .review-reply img {
        margin-right: 12px;
    }
    .review-reply a {
        color: #757575;
    }
    .review-list {
        border-bottom: 1px solid #dddddd;
        padding: 25px;
    }
    .left-bar li.nav-item i {
        font-size: 25px;
        margin-right: 12px;
        color: #717171;
        width: 25px;
    }
    .left-bar li.nav-item a.nav-link.active i {
        font-size: 25px;
        margin-right: 12px;
        color: #000;
    }
    .inner-data-content {
        line-height: 30px;
        padding: 25px;
    }
    .location-content {
        background: #ffffff none repeat scroll 0 0;
    }
    .full-location {
        padding: 25px;
        display: inline-block;
        width: 100%;
    }
    .full-location ul{
        padding:0;
        list-style: none;
        margin-bottom: 0;
    }
    .full-location .location-title{
        float: left;
    }
    .full-location .location-title li{
        font-size: 20px;
    }
    .full-location .location-right{
        float: right;
    }
    .location-right .dropdown button {
        background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
        border: 0 none;
        color: #000000;
    }
    .location-right .btn-secondary.active:not(:disabled):not(.disabled), .location-right .btn-secondary:active:not(:disabled):not(.disabled), .location-right .show > .btn-secondary.dropdown-toggle {
        background-color: transparent;
        border-color: transparent;
        color: #000;
    }
    .location-right .btn-secondary.focus, .btn-secondary:focus {
        box-shadow: 0 0 0 0 rgba(108, 117, 125, 0.5);
    }
    .location-right li {
        display: inline-block;
    }
    .location-btn {
        background: #4285F4;
        border-radius: 5px;
        color: #ffffff;
        padding: 7px 18px;
    }
    .location-btn:hover {
        background: #4285F4;
        border-radius: 5px;
        color: #ffffff;
    }



    .location-loop label {
        color: #666666;
        cursor: pointer;
        font-size: 25px;
        position: relative;
    }
    .location-loop ul{
        list-style: none;
        margin-bottom: 0;
        padding:0;
    }
    .location-loop input[type="checkbox"]{
        position: absolute;
        right: 9000px;
    }

    /*Check box*/
    .location-loop input[type="checkbox"] + .label-text:before{
        content: "\f096";
        font-family: "FontAwesome";
        speak: none;
        font-style: normal;
        font-weight: normal;
        font-variant: normal;
        text-transform: none;
        line-height: 1;
        -webkit-font-smoothing:antialiased;
        width: 1em;
        display: inline-block;
        margin-right: 5px;
    }
    .info-number li {
        color: #565656;
        font-size: 16px;
        margin-bottom: 15px;
    }
    .info-number li i {
        color: #4285f4;
        font-size: 18px;
        margin-right: 10px;
    }
    .view img {
        margin-right: 10px;
    }
    .view{
        color: #454545;
    }
    .right-google-map .map {
        color: #686868;
        font-size: 20px;
    }
    .location-loop input[type="checkbox"]:checked + .label-text:before{
        content: "\f14a";
        color: #2980b9;
        animation: effect 250ms ease-in;
    }

    .location-loop input[type="checkbox"]:disabled + .label-text{
        color: #aaa;
    }

    .location-loop input[type="checkbox"]:disabled + .label-text:before{
        content: "\f0c8";
        color: #ccc;
    }
    .name-list > a {
        color: #454545;
        font-size: 16px;
        padding-top: 0px;
        display: inline-block;
    }
    .name-list > a i{
        margin-left: 5px;
    }
    .location-loop ul li {
        float: left;
        width: 25%;
    }
    .location-loop {
        display: inline-block;
        width: 100%;
        border-bottom: 1px solid #ddd;
    }
    .location-loop li {
        font-size: 15px;
        margin-bottom: 0;
        margin-top: 8px;
        color: #7a7a7a;
    }
    .location-loop h6 {
        float: left;
        margin-bottom: 0 !important;
        width: 100%;
        font-size: 15px;
    }
    .location-loop p {
        color: #7a7a7a;
        display: table;
        font-size: 13px;
        line-height: 15px;
        margin-top: 20px;
    }
    .checked-icon i {
        color: #4caf50;
        font-size: 20px;
        margin-right: 5px;
        position: relative;
        top: 2px;
    }
    .review-deatil-anchor a {
        display: inline-block;
        padding-top: 18px;
    }
    .location-loop ul li:first-child {
        width: 10%;
    }
    .form-check {
        display: block;
        padding-left: 10px;
        position: relative;
    }
    .location-loop ul li:nth-child(2) {
        width: 40%;
    }
    .info-title {
        float: left;
        width: 50%;
        padding-right: 15px;
    }
    .right-google-map {
        float: right;
        width: 50%;
        padding-left: 15px;
    }
    .info-bg img {
        width: 100%;
    }
    #info .info-bg img {
  border-radius: 10px 10px 0 0;
  width: 100%;
}
    .location-name {
        background: #4285F4;
        padding: 15px;
        color: #fff;
        font-size: 20px;
    }
    .info-number {
        border-width: 0 1px 1px 1px;
        padding: 15px;
        border-color: #ddd;
        border-style: solid;
        border-radius: 0 0 10px 10px; 
        margin-bottom: 30px;
    }
    .inner-star-rating p {
        max-width: 540px !important;
        word-wrap: break-word;
    }
    img.user_img {
        height: 40px;
        width: 40px;
        border-radius: 50%;
    }
    .inner-tabview .right-bar {
        float: right;
        padding: 20px 70px;
        width: 75%;
        max-height: 500px;
        overflow-y: scroll;
    }
    .inner-tabview {
        background: #f0f0f0 none repeat scroll 0 0;
        display: table;
        padding: 20px 0;
        width: 100%;
        text-align: left;
    }
    .full-row {
        text-align: left;
    }
    .inner-review1 {
        background: #ffffff none repeat scroll 0 0;
    }
    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 9999; /* Sit on top */
        padding-top: 0px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    /*      22june      */
    .info-number span {
        font-size: 13px;
        font-weight: 400;
    }
    .info-number {
        border-width: 0 1px 1px 1px;
        padding: 12px 0 0px 8px;
        border-color: #ddd;
        border-style: solid;
    }
    .location-name {
        background: #4285F4;
        padding: 0 0px 8px 8px;
        color: #fff;
        font-size: 18px;
    }
    .modal-inner-pop {
  align-items: center;
  display: flex;
  height: 100% !important;
  width: 100%;
}
    .info-number img {
        float: right;
        width: 30px;
        padding-right: 13px;
        padding-top: 4px;
    }
    .location-name img {
        width: 30px;
        padding-right: 13px;
        padding-top: 4px;
        float:right;
    }
    .info-number li i {
  font-size: 14px;
  position: relative;
  top: 5px;
}
    p.advance {
    font-weight: bold;
    padding-top: 14px;
    font-size: 20px;
}
.right-google-map img {
    float: right;
    width:20px;
    padding-top: 3px;
}
.right-google-map {
    position: relative;
}
.right-google-map li {
    height: 38px;
}
  .span-center {
    height: 34px;
}
</style>
