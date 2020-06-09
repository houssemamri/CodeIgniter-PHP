<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
<!-- <link rel="stylesheet" type="text/css" href="/css/dropzone.css" />
<script type="text/javascript" src="/js/dropzone.js"></script> -->
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
    $Post = "Posts";
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
	 $Post = "Posts";
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
	 $Post = "Posts";
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

//$name = "accounts/100928649975105038548/locations/12481351387678745559";
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$name,
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


//=============images curl===============
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v4/" .$name.'/media',
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

$res_media = curl_exec($curl);
$err = curl_error($curl);
$r_media = json_decode($res_media);
//=============images curl===============
/* echo "<pre>";
print_r($r_media->mediaItems);echo "</pre>"; */
$cat=$res->primaryCategory->displayName;
curl_setopt_array($curl, array(
    CURLOPT_URL => "https://mybusiness.googleapis.com/v3/categories?regionCode=US&languageCode=fr&searchTerm=".$cat,
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
/*  echo "<pre>";
  print_r($comment);  echo "</pre>"; */
?>
<style>
    .checked {
        color: orange;
    }
</style>
<section class="google-demo">    
    <div class="">
        <div class="inner-review1">
            <div class="full-row">

                <ul>
                    <li><a href="javascript:void(0)" id="toggle_menu2"><img src="/img/icon.png"></a></li>
                    <li><img src="/img/logo_google.png"></li>
                    <li><?php echo @$mu_business; ?></li>
            </div>
            <div class="inner-tabview">
                <div id="Left_menu_div2" class="left-bar slide-left">
                    <h2 id="location_edit1"> <?php echo $res->locationName; ?></h2>
                    <p><?php echo $res->address->addressLines['0']; ?></br>
                        <?php echo $res->address->postalCode; ?>,<?php echo $res->address->locality; ?> <?php echo $res->address->country; ?> </p>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item google_link_mobile2">
                            <a class="nav-link " id="home-tab" data-toggle="tab"   href="#home2" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-home" aria-hidden="true"></i><?php echo @$home_loc; ?></a>
                        </li>
                        <li class="nav-item google_link_mobile2">
                            <a class="nav-link " id="home-tab" data-toggle="tab"   href="#google_Posts_l" role="tab" aria-controls="home" aria-selected="false"><i class="fa fa-clipboard" aria-hidden="true"></i><?php echo @$Post; ?></a>
                        </li>
                        <li class="nav-item google_link_mobile2">
                            <a class="nav-link active" id="profile-tab2" data-toggle="tab"   href="#profile1" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i><?php echo @$loc_Review; ?></a>
                        </li>
                        <li class="nav-item google_link_mobile2">
                            <a class="nav-link" id="info-tab" data-toggle="tab"  href="#info2" role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-info-circle" aria-hidden="true"></i><?php echo @$loc_info ?></a>
                        </li>
                        <li class="nav-item google_link_mobile2">
                            <a class="nav-link" id="photo-tab" data-toggle="tab"   href="#photo2" role="tab" aria-controls="photo" aria-selected="false"><i class="fa fa-picture-o" aria-hidden="true"></i><?php echo @$loc_photo; ?></a>
                        </li>
                        <!--li class="nav-item">
                           <a class="nav-link" id="profile-tab" data-toggle="tab"  href="#profile" role="tab" aria-controls="info" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i>Review</a>
                         </li>
                                     <li class="nav-item">
                           <a class="nav-link" id="photo-tab" data-toggle="tab"  onclick="show_hide('photo')" href="#photo" role="tab" aria-controls="photo" aria-selected="false"><i class="fa fa-star" aria-hidden="true"></i>Photo</a>
                         </li-->
                        <li class="nav-item google_link_mobile2">
                            <a class="nav-link" onclick="get_detail2('manage')"  id="manage-tab"  href="javascript:void(0)" ><i class="fa fa-user" aria-hidden="true"></i><?php echo @$Manage_locations; ?></a>
                        </li>

                    </ul>
                </div>
                <div  id="right_menu_div2" class="right-bar post-main-tab">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade rect" id="home2" role="tabpanel" aria-labelledby="home-tab">
                            <img class="logo-default" src="img/logo.png" alt="logo">
                            <div class="home-content-main">

                                <h2><?php echo @$info_title; ?></h2>
                                <p><?php echo @$info_details; ?></p>
                            </div>
                        </div>
          <!--google post -->              
                       <div class="tab-pane fade rect" id="google_Posts_l" role="tabpanel" aria-labelledby="google_Posts_tab">
                            <div class="post-design">
                                <div class="post-anchor">
                                    <a id="localpost"  href="javascript:void(0);">
                                        <ul>
                                            <li><img src="img/photo.jpg"></li>
                                            <li>Write your Post</li>
                                        </ul>
                                        <div class="camera-post text-right">
                                            <i class="fa fa-camera" aria-hidden="true"></i>
                                        </div>
                                    </a>
                                </div> 
                                   <div id="localpostModel" class="modal" >
                                            <div class="modal-inner-pop">
                                            	<div class="post-pop-bg-div">
                                              
											
	   <div class="post-popup-area">
				<ul class="create-post-ul">
					<li><a href="javascript:void(0)" onclick="cancel_btn();" ><i class="fa fa-times" aria-hidden="true"></i></a></li>
					<li class="create">Create post</li>
					
				
				</ul>
				<div class="post-pop-tab">
					 <ul class="nav nav-tabs" id="myTab" role="tablist">
					  <li class="nav-item" id="changes_on_whts_tab" onclick="show_localPost_Fields(1);">
						<a class="nav-link active" id="whts-new-tab" data-toggle="tab" href="#whts-new" role="tab" aria-controls="whts-new" aria-selected="true"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>Whats's New</a>
					  </li>
					  <li class="nav-item" id="changes_on_events_tab" onclick="show_localPost_Fields(2);">
						<a class="nav-link" id="events_pop-tab" data-toggle="tab" href="#events_pop" role="tab" aria-controls="events_pop" aria-selected="false"><i class="fa fa-calendar" aria-hidden="true"></i>Events</a>
					  </li>
					  <li class="nav-item" id="changes_on_offer_tab" onclick="show_localPost_Fields(3);">
						<a class="nav-link" id="Offers_pop-tab" data-toggle="tab" href="#Offers_pop" role="tab" aria-controls="Offers_pop" aria-selected="false"><i class="fa fa-tag" aria-hidden="true"></i>Offers</a>
					  </li>
					  <!--li class="nav-item">
						<a class="nav-link" id="products_pop-tab" data-toggle="tab" href="#products_pop" role="tab" aria-controls="products_pop" aria-selected="false"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Products</a>
					  </li-->
					</ul>
					<div class="tab-content" id="myTabContent">
					 <form  method="post" id="submit_post_data_1" enctype="multipart/form-data" >
					 <div class="tab-pane fade show active" id="whts-new" role="tabpanel" aria-labelledby="all-tab">
                     <input type="hidden"  name="loc_name" value="<?php echo @$_REQUEST['name'] ; ?>" />
						 <input type="hidden"  name="TopicType" id="localpost_topictype" value="STANDARD" />
		  <div class="whsts-pop-cont">
							<div class="need-idea">
							
								<a href="#"><i class="fa fa-lightbulb-o" aria-hidden="true"></i><span>Need some ideas?</span> Look at some sample posts.</a>
							</div>
							<div class="newd-idea-img-pop text-center upload-section">
							<input type="file" name="post_img" class="upload-img" accept="image/*"/>
								<a href="#">
									<span><i class="fa fa-camera" aria-hidden="true"></i></span>
									<h6>Make your post stand out with a photo or video</h6>
								</a>
							</div>
							<div class="preview-section"></div>
							<div class="write-post-popup" id="localpost_detail">
								<div class="form-group">
									<input type="text" placeholder="Write Your Post"  name="post_detail" id="post_detail_localpost" class="form-control">
									<span><i class="fa fa-info-circle" aria-hidden="true"></i></span>
								</div>
								<p>100 - 300 words</p>
							</div>
							<div class="write-post-popup sale-input" id="localpost_title" style="display:none">
								<div class="form-group">
									<input type="text" placeholder="Event Title" name="event_title" id="post_title_localpost" class="form-control">
									 </div>
								<p id="post_text_localpost">(Example: Promotions this week)</p>
							</div>
							
							<div class="date-time-post" id="post_date_time_locahost" style="display:none">
								<ul>
									<li><input type="text" name="start_date" placeholder="Start Date"  class="form-control  datepicker">
									</li>
									<li><input type="text" placeholder="Start Time"  name="start_time" class="form-control timepicker">
									</li>
									<li><input type="text" placeholder="End Date"  name="end_date" class="form-control datepicker">
									</li>
									<li><input type="text" placeholder="End Time"  name="end_time" class="form-control timepicker">
									</li>
								</ul>
							</div>
							
							<div class="whtas-select" id="localpost_calltoaction">
								<select  name="callToAction">
								<option class="addto-btn">Add a button (optional) <span class="caret"></span></option>
								<option value="BOOK">Book</option>
								<option value="ORDER">Order Online</option>
								<option value="SHOP">Buy</option>
								<option value="LEARN_MORE">Learn More</option>
								<option value="SIGN_UP">Sign Up</option>
								<option value="GET_OFFER">Get Offer</option>
								<option value="CALL">Call Now</option>
								 </select>
							</div>
							<div class="write-post-popup" id="localpost_post_url">
								<div class="form-group">
									<input type="text" placeholder="Link for your button"  name="post_url" class="form-control">
								
								</div>
								
							</div>
							<div class="write-post-popup sale-input" id="localpost_coupon_code" style="display:none">
								<div class="form-group">
								   <input type="text" placeholder="Coupon code (optional)"  name="couponCode" class="form-control">
								</div>
							</div>
								<div class="write-post-popup sale-input" id="localpost_offer_link" style="display:none">
								<div class="form-group">
								   <input type="text" placeholder="Link to redeem offer (optional)"  name="redeemOnlineUrl" class="form-control">
								</div>
							</div>
								<div class="write-post-popup sale-input" id="localpost_offer_term_condition" style="display:none">
								<div class="form-group">
								   <input type="text" placeholder="Terms and conditions (optional)" name="termsConditions" class="form-control">
								</div>
							</div>
							
							
							
						  </div>
						  <div class="form_submit_button">
                          <input type="submit" value="Publish" name="submit_form"  >
                       </div>						  
                       </div>						  
					 </form>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
									
									<div id="local_post_list">
								<?php include('gbm/edit/list_localpost_lower.php');  ?>
								</div>
                                
                            </div>
                        </div>
         <!--google post end-->   
                        <div class="tab-pane fade show active" id="profile1" role="tabpanel" aria-labelledby="profile-tab2">
                            <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab1" data-toggle="tab" href="#all_review" role="tab" aria-controls="tab1" aria-selected="true"><?php echo @$loc_all; ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#with_review" role="tab" aria-controls="profile" aria-selected="false"><?php echo @$loc_REPLIED; ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#without_review" role="tab" aria-controls="contact" aria-selected="false"><?php echo @$hav_replied; ?></a>
                                </li>
                            </ul>

                            <div class="tab-content second" id="myTabContent">
                                <div class="tab-pane fade show active" id="all_review" role="tabpanel" aria-labelledby="home-tab">

                                    <?php
                                    foreach ($comment->reviews as $key => $com) {

                                        $rating = $com->starRating;
                                        if ($rating == "ONE") {
                                            $rate = 1;
                                        }
                                        if ($rating == "TWO") {
                                            $rate = 2;
                                        }
                                        if ($rating == "THREE") {
                                            $rate = 3;
                                        }
                                        if ($rating == "FOUR") {
                                            $rate = 4;
                                        }
                                        if ($rating == "FIVE") {
                                            $rate = 5;
                                        }
                                        //print_r($com); 
                                        ?>

                                        <div class="review-list">
                                            <ul class="review-user">
                                                <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                <li><h5><?php echo $com->reviewer->displayName; ?></h5>
                                                    <p><?php echo time_elapsed_string($com->createTime); ?></p>
                                                </li>
                                                <li></li>
                                            </ul>
                                            <div class="inner-star-rating">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {

                                                    if ($i > $rate) {
                                                        ?>
                                                        <span class="fa fa-star "></span>

                                                    <?php } else { ?> <span class="fa fa-star checked"></span>  <?php
                                                    }
                                                }
                                                ?>




                                                <p ><?php echo $com->comment; ?> </p>
                                                <ul class="review-reply">


                                                    <?php if (isset($com->reviewReply)) { ?>
                                                        <div  id="tab1_div_rely_owner_<?php echo $com->reviewId; ?>" >
                                                            <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                            <li><h5>(<?php echo @$Owner; ?>)</h5>
                                                                <p id="tab1_replay_comment_<?php echo $com->reviewId; ?>"> <?php echo $com->reviewReply->comment; ?> <p>
                                                        </div>
                                                        <div class="reply-msg" style="display:none" id="tab1_div_<?php echo $com->reviewId; ?>">
                                                            <textarea rows="6" cols="70" class="form-control reply_textarea "   name="reply" id="tab1_text_<?php echo $com->reviewId; ?>" > <?php echo $com->reviewReply->comment; ?></textarea>

                                                            <input type="button" class="btn btn-primary reply_button" value="Edit"  onclick="reply_post('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab1_');" />						 
                                                            <input type="button"  class="btn btn-primary cancle_button" value="Delete" onclick="review_delete('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab1_');" />		
                                                        </div>	
                                                    <?php } else { ?>						 

                                                        <div id="tab1_div_rely_owner_<?php echo $com->reviewId; ?>" style="display:none">
                                                            <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                            <li><h5>(<?php echo @$Owner; ?>)</h5>
                                                                <p id="tab1_replay_comment_<?php echo $com->reviewId; ?>">  <p>
                                                        </div>


                                                        <div class="reply-msg" style="display:none" id="tab1_div_<?php echo $com->reviewId; ?>">
                                                            <textarea rows="6" cols="70" class="form-control reply_textarea "   name="reply" id="tab1_text_<?php echo $com->reviewId; ?>" > </textarea>

                                                            <input type="button" class="btn btn-primary reply_button" value="Post Reply"  onclick="reply_post('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab1_');" />						 
                                                            <input type="button"  class="btn btn-primary cancle_button" value="Cancel" onclick="review_reply('<?php echo $com->reviewId; ?>', 'hide', 'tab1_');" />		
                                                        </div>	

                                                    <?php } ?> 



                                                    <li><a onclick="review_reply('<?php echo $com->reviewId; ?>', 'open', 'tab1_');" href="javascript:void(0)"><img src="/img/reply.png"><?php
                                                            if (isset($com->reviewReply)) {
                                                                echo @$v_edit;
                                                                ?>  <?php
                                                            } else {
                                                                echo @$loc_REPLY;
                                                            }
                                                            ?></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
         <div class="tab-pane fade" id="with_review" role="tabpanel" aria-labelledby="profile-tab">
                                    <?php
                                    foreach ($with_reply as $key => $com) {

                                        $rating = $com->starRating;
                                        if ($rating == "ONE") {
                                            $rate = 1;
                                        }
                                        if ($rating == "TWO") {
                                            $rate = 2;
                                        }
                                        if ($rating == "THREE") {
                                            $rate = 3;
                                        }
                                        if ($rating == "FOUR") {
                                            $rate = 4;
                                        }
                                        if ($rating == "FIVE") {
                                            $rate = 5;
                                        }
                                        //print_r($com); 
                                        ?>

                                        <div class="review-list">
                                            <ul class="review-user">
                                                <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                <li><h5><?php echo $com->reviewer->displayName; ?></h5>
                                                    <p><?php echo time_elapsed_string($com->createTime); ?></p>
                                                </li>
                                                <li></li>
                                            </ul>
                                            <div class="inner-star-rating">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {

                                                    if ($i > $rate) {
                                                        ?>
                                                        <span class="fa fa-star "></span>

                                                    <?php } else { ?> <span class="fa fa-star checked"></span>  <?php
                                                    }
                                                }
                                                ?>




                                                <p ><?php echo $com->comment; ?> </p>
                                                <ul class="review-reply">


                                                    <?php if (isset($com->reviewReply)) { ?>
                                                        <div  id="tab2_div_rely_owner_<?php echo $com->reviewId; ?>" >
                                                            <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                            <li><h5>(<?php echo @$Owner; ?>)</h5>
                                                                <p id="tab2_replay_comment_<?php echo $com->reviewId; ?>"> <?php echo $com->reviewReply->comment; ?> <p>
                                                        </div>
                                                        <div class="reply-msg" style="display:none" id="tab2_div_<?php echo $com->reviewId; ?>">
                                                            <textarea rows="6" cols="70" class="form-control reply_textarea "   name="reply" id="tab2_text_<?php echo $com->reviewId; ?>" > <?php echo $com->reviewReply->comment; ?></textarea>

                                                            <input type="button" class="btn btn-primary reply_button" value="Edit"  onclick="reply_post('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab2_');" />						 
                                                            <input type="button"  class="btn btn-primary cancle_button" value="Delete" onclick="review_delete('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab2_');" />		
                                                        </div>	
                                                    <?php } else { ?>						 

                                                        <div id="tab2_div_rely_owner_<?php echo $com->reviewId; ?>" style="display:none">
                                                            <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                            <li><h5>(<?php echo @$Owner; ?>)</h5>
                                                                <p id="tab2_replay_comment_<?php echo $com->reviewId; ?>">  <p>
                                                        </div>


                                                        <div class="reply-msg" style="display:none" id="tab2_div_<?php echo $com->reviewId; ?>">
                                                            <textarea rows="6" cols="70" class="form-control reply_textarea "   name="reply" id="tab2_text_<?php echo $com->reviewId; ?>" > </textarea>

                                                            <input type="button" class="btn btn-primary reply_button" value="Post Reply"  onclick="reply_post('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab2_');" />						 
                                                            <input type="button"  class="btn btn-primary cancle_button" value="Cancel" onclick="review_reply('<?php echo $com->reviewId; ?>', 'hide', 'tab2_');" />		
                                                        </div>	

                                                    <?php } ?> 



                                                    <li><a onclick="review_reply('<?php echo $com->reviewId; ?>', 'open', 'tab2_');" href="javascript:void(0)"><img src="/img/reply.png"><?php
                                                            if (isset($com->reviewReply)) {
                                                                echo @$v_edit;
                                                                ?>  <?php
                                                            } else {
                                                                echo @$loc_REPLY;
                                                            }
                                                            ?></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="tab-pane fade" id="without_review" role="tabpanel" aria-labelledby="contact-tab">
                                    <?php
                                    foreach ($without_reply as $key => $com) {

                                        $rating = $com->starRating;
                                        if ($rating == "ONE") {
                                            $rate = 1;
                                        }
                                        if ($rating == "TWO") {
                                            $rate = 2;
                                        }
                                        if ($rating == "THREE") {
                                            $rate = 3;
                                        }
                                        if ($rating == "FOUR") {
                                            $rate = 4;
                                        }
                                        if ($rating == "FIVE") {
                                            $rate = 5;
                                        }
                                        //print_r($com); 
                                        ?>

                                        <div class="review-list">

                                            <ul class="review-user">
                                                <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                <li><h5><?php echo $com->reviewer->displayName; ?></h5>
                                                    <p><?php echo time_elapsed_string($com->createTime); ?></p>
                                                </li>
                                                <li></li>
                                            </ul>
                                            <div class="inner-star-rating">
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {

                                                    if ($i > $rate) {
                                                        ?>
                                                        <span class="fa fa-star "></span>

                                                    <?php } else { ?> <span class="fa fa-star checked"></span>  <?php
                                                    }
                                                }
                                                ?>




                                                <p ><?php echo $com->comment; ?> </p>
                                                <ul class="review-reply">


                                                    <?php if (isset($com->reviewReply)) { ?>
                                                        <div  id="tab3_div_rely_owner_<?php echo $com->reviewId; ?>" >
                                                            <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                            <li><h5>(<?php echo @$Owner; ?>)</h5>
                                                                <p id="tab3_replay_comment_<?php echo $com->reviewId; ?>"> <?php echo $com->reviewReply->comment; ?> <p>
                                                        </div>
                                                        <div class="reply-msg" style="display:none" id="tab3_div_<?php echo $com->reviewId; ?>">
                                                            <textarea rows="6" cols="70" class="form-control reply_textarea "   name="reply" id="tab3_text_<?php echo $com->reviewId; ?>" > <?php echo $com->reviewReply->comment; ?></textarea>

                                                            <input type="button" class="btn btn-primary reply_button" value="Edit"  onclick="reply_post('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab3_');" />						 
                                                            <input type="button"  class="btn btn-primary cancle_button" value="Delete" onclick="review_delete('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab3_');" />	
                                                        </div>	
                                                    <?php } else { ?>						 

                                                        <div id="tab3_div_rely_owner_<?php echo $com->reviewId; ?>" style="display:none">
                                                            <li><img class="user_img" src="https://lh3.googleusercontent.com/-8IxozF6uizs/AAAAAAAAAAI/AAAAAAAAAAA/wgzFZOwL0MY/s50-c/photo.jpg"></li>
                                                            <li><h5>(<?php echo @$Owner; ?>)</h5>
                                                                <p id="tab3_replay_comment_<?php echo $com->reviewId; ?>">  <p>
                                                        </div>

                                                        butt
                                                        <div class="reply-msg" style="display:none" id="tab3_div_<?php echo $com->reviewId; ?>">
                                                            <textarea rows="6" cols="70" class="form-control reply_textarea "   name="reply" id="tab3_text_<?php echo $com->reviewId; ?>" > </textarea>

                                                            <input type="button" class="btn btn-primary reply_button" value="Post Reply"  onclick="reply_post('<?php echo $com->reviewId; ?>', '<?php echo $name; ?>', 'tab3_');" />						 
                                                            <input type="button"  class="btn btn-primary cancle_button" value="Cancel" onclick="review_reply('<?php echo $com->reviewId; ?>', 'hide', 'tab3_');" />		
                                                        </div>	

                                                    <?php } ?> 



                                                    <li><a onclick="review_reply('<?php echo $com->reviewId; ?>', 'open', 'tab3_');" href="javascript:void(0)"><img src="/img/reply.png"><?php
                                                            if (isset($com->reviewReply)) {
                                                                echo "View and edit"
                                                                ?>  <?php
                                                            } else {
                                                                echo "REPLY";
                                                            }
                                                            ?></a></li>

                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>




                        </div>

                        <div class="tab-pane fade" id="info2" role="tabpanel" aria-labelledby="info-tab">
                            <div class="location-content">
                                <div class="full-location">
                                    <!-- <ul class="location-title">
                                      <li>Info</li>
                                                          
                                    </ul>  --> 
                                    <?php //echo "<pre>"; print_r($res);    ?>
                                    <div class="info-title">
                                        <div class="info-bg">
                                            <img src="img/map-bg.png" alt="">
                                        </div>
                                        <div id="myModal" class="modal" >
                                            <div class="modal-inner-pop">
                                            <div class="feature-box">
                                                <div class="feature-box-inner">
                                                    <h3>Business name</h3><br>
                                                    <p class="text">Enter your business title as it appears to <br>customers in the real world.</p>

                                                    <div class="form-group">
                                                        <input class="form-control" name="loc_name" id="id_loc_name" type ="text" value="<?php echo $res->locationName; ?> "/>

                                                    </div>
                                                    <div class="btn-data">
                                                        <button onclick="cancel_btn();" class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                        <button  onclick="LocationUpdate();" class="btn cust-btn " type="button">Apply</button>
                                                    </div>
                                                </div>
                                                <div class="note"><b>Please note:</b>Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>
                                            </div>
                                        </div>
                                            <!--div class="modal-content">
                                            <span class="close">&times;</span>
                                            <p><input name="loc_name" id="id_loc_name" type ="text" value="<?php echo $res->locationName; ?> "  /></p>
                                            <a id="saveLocation" onclick="LocationUpdate();" href="javascript:void(0);">Save</a>
                                            </div-->
                                        </div>
                                        <div class="location-name">
                                            <span id="location_edit2"><?php echo $res->locationName; ?></span>   <a id="name_Location"  href="javascript:void(0);"><img src="img/pencil_white.png" /></a> <br>
                                            <span id="html_category"><?php echo $res->primaryCategory->displayName; ?></span> <a id="btn_category" href="javascript:void(0);"><img src="img/pencil_white.png" /></a>
                                        </div>



                                        <div id="model_category" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <div class="feature-box-inner">
                                                        <h3>Category</h3><br>
                                                        <p class="text">Categories describe what your business is, not what it does or sells.</p>

                                                        <div class="form-group">
                                                            <p class="primary">Primary category</p>

                                                            <select name="category" id="id_category">
                                                                <option id="<?php echo $res->primaryCategory->categoryId; ?>" ><?php echo $res->primaryCategory->displayName; ?></option>
                                                                <?php foreach ($catgories->categories as $cat) { ?>
                                                                    <option id="<?php echo $cat->categoryId; ?>" ><?php echo $cat->name; ?></option>

                                                                <?php } ?>
                                                            </select>


                                                        </div>
                                                        <div class="btn-data">
                                                            <button onclick="cancel_btn();"  class="btn cust-btn " type="button">Cancel</button>
                                                            <button onclick="Location_category();"  class="btn cust-btn " type="button">Apply</button>
                                                        </div>
                                                    </div>
                                                    <div class="note"><b>Please note:</b> Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>
                                                </div>

                                            </div>


                                        </div>
                                        <div id="numberModel" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <div class="feature-box-inner">
                                                        <h3>Phone number</h3><br>



                                                        <div class="input-field"><p class="primary">Primary phone</p></div>
                                                        <div class="form-group">


                                                            <div class="input-fieled">
                                                                <input name="loc_number" id="id_loc_number" type ="text" value="<?php echo $res->primaryPhone; ?> "  />
                                                            </div>
                                                            <!--p class="primary-add">ADD PHONE NUMBER</p-->

                                                        </div>



                                                        <div class="btn-data">
                                                            <button onclick="cancel_btn();" class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                            <button onclick="LocationNumberUpdate();" class="btn cust-btn " type="button">Apply</button>
                                                        </div>
                                                    </div>
                                                    <div class="note"><b>Please note:</b> Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>

                                                </div>
                                            </div>
                                            <!--div class="modal-content">
                                            <span class="close">&times;</span>
                                            <p><input name="loc_number" id="id_loc_number" type ="text" value="<?php echo $res->primaryPhone; ?> "  /></p>
                                            <a id="saveLocation" onclick="LocationNumberUpdate();" href="javascript:void(0);">Save</a>
                                            </div-->
                                        </div>
                                        <div id="model_websiteUrl" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <div class="feature-box-inner">
                                                        <h3>Website</h3><br>
                                                        <p class="text">Enter URLs to improve business info. Only enter URLs with live websites.</p>

                                                        <div class="form-group">
                                                            <p class="primary">Website</p>
                                                            <input class="form-control" name="websiteUrl" id="id_websiteUrl" type ="text" value="<?php echo $res->websiteUrl; ?> "  />
                                                        </div>
                                                        <div class="btn-data">
                                                            <button onclick="cancel_btn();"  class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                            <button  onclick="Location_websiteUrl();"class="btn cust-btn " type="button">Apply</button>
                                                        </div>
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
                                        <div id="model_address" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <div class="feature-box-inner">
                                                        <h3>Address</h3><br>
                                                        <p class="text">Providing an accurate business address is important so your business shows up in the right place on Google.</p>

                                                        <div class="form-group">

                                                            <input name="country" id="id_country" type ="hidden" value="<?php echo $res->address->country; ?>"  />
                                                            <!--p class="primary">Country / Region</p-->


                                                            <div class="input-field">
                                                                <p class="primary">Street address</p>
                                                                <input  class="form-control" name="addressLines" id="id_addressLines" type ="text" value="<?php echo $res->address->addressLines[0]; ?>"  />
                                                            </div>

                                                            <div class="input-field"><p class="primary">Postal code</p>
                                                                <input class="form-control" name="postalCode" id="id_postalCode" type ="text" value="<?php echo $res->address->postalCode; ?>"  />
                                                            </div>

                                                            <div class="input-field"><p class="primary">City</p>
                                                                <input class="form-control" name="locality" id="id_locality" type ="text" value="<?php echo $res->address->locality; ?>"  />
                                                            </div>

                                                        </div>
                                                        <div class="map">

                                                        </div>


                                                        <div class="btn-data">
                                                            <button onclick="cancel_btn();"  class="btn cust-btn cancel_btn " type="button">Cancel</button>
                                                            <button onclick="Location_address();" class="btn cust-btn " type="button">Apply</button>
                                                        </div>
                                                    </div>
                                                    <div class="note"><b>Please note:</b> Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>

                                                </div>
                                            </div>

                                        </div>

                                        <div id="AdWordsModel" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <div class="feature-box-inner">
                                                        <h3>Phone number for AdWords location extensions</h3><br>
                                                        <div class="input-field"><p class="primary">This number is shown in sitelink ads that you serve using AdWords</p></div>
                                                        <div class="form-group">
                                                            <div class="input-fieled">
                                                                <input name="AdWords_number" id="id_adword_number" type ="text" value="<?php echo $res->adWordsLocationExtensions->adPhone ; ?>"  />
                                                            </div>
                                                        </div>
                                                        <div class="btn-data">
                                                            <button onclick="cancel_btn();" class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                            <button onclick="AdWordsNumberUpdate();" class="btn cust-btn " type="button">Apply</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>	

<?php 
$year = $res->openInfo->openingDate->year;
$month = $res->openInfo->openingDate->month;
$day = $res->openInfo->openingDate->day;
$date= $year.'-'.$month.'-'.$day;

$openings =  date("F j Y", strtotime($date)); 



?>
<div id="openingModel" class="modal" >
<div class="modal-inner-pop">
<div class="feature-box">
<div class="feature-box-inner">
<h3>Phone number for AdWords location extensions</h3><br>
<div class="input-field"><p class="primary">This number is shown in sitelink ads that you serve using AdWords</p></div>
<form id="formOpening"  method="post">

<input type="hidden" name="acc_name" value="<?php echo $res->name; ?>" />
<input type="hidden" name="open_date" value="open_date" />
<div class="form-group">
<div class="input-field">
<input type="text" name="year" value="<?php echo $year; ?>" placeholder="Year"  />
</div>
</div>
<div class="form-group">
<div class="input-field">
<select name="month" id="month" style="width: auto;" >
<option value=""  >Month</option>
<option value="1"  <?PHP if($month==1) echo "selected";?>>January</option>
<option value="2"  <?PHP if($month==2) echo "selected";?>>February</option>
<option value="3"  <?PHP if($month==3) echo "selected";?>>March</option>
<option value="4"  <?PHP if($month==4) echo "selected";?>>April</option>
<option value="5"  <?PHP if($month==5) echo "selected";?>>May</option>
<option value="6"  <?PHP if($month==6) echo "selected";?>>June</option>
<option value="7"  <?PHP if($month==7) echo "selected";?>>July</option>
<option value="8"  <?PHP if($month==8) echo "selected";?>>August</option>
<option value="9"  <?PHP if($month==9) echo "selected";?>>September</option>
<option value="10" <?PHP if($month==10) echo "selected";?>>October</option>
<option value="11" <?PHP if($month==11) echo "selected";?>>November</option>
<option value="12" <?PHP if($month==12) echo "selected";?>>December</option>
</select>
</div>
</div>
<div class="form-group">
<div class="input-field">
<select name="day" id="day" style="width: auto;" >
<option value=""  >Day</option>
<option value="1"  <?PHP if($day==1) echo "selected";?>>1</option>
<option value="2"  <?PHP if($day==2) echo "selected";?>>2</option>
<option value="3"  <?PHP if($day==3) echo "selected";?>>3</option>
<option value="4"  <?PHP if($day==4) echo "selected";?>>4</option>
<option value="5"  <?PHP if($day==5) echo "selected";?>>5</option>
<option value="6"  <?PHP if($day==6) echo "selected";?>>6</option>
<option value="7"  <?PHP if($day==7) echo "selected";?>>7</option>
<option value="8"  <?PHP if($day==8) echo "selected";?>>8</option>
<option value="9"  <?PHP if($day==9) echo "selected";?>>9</option>
<option value="10" <?PHP if($day==10) echo "selected";?>>10</option>
<option value="11" <?PHP if($day==11) echo "selected";?>>11</option>
<option value="12" <?PHP if($day==12) echo "selected";?>>12</option>
<option value="13" <?PHP if($day==13) echo "selected";?>>13</option>
<option value="14" <?PHP if($day==14) echo "selected";?>>14</option>
<option value="15" <?PHP if($day==15) echo "selected";?>>15</option>
<option value="16" <?PHP if($day==16) echo "selected";?>>16</option>
<option value="17" <?PHP if($day==17) echo "selected";?>>17</option>
<option value="18" <?PHP if($day==18) echo "selected";?>>18</option>
<option value="19" <?PHP if($day==19) echo "selected";?>>19</option>
<option value="20" <?PHP if($day==20) echo "selected";?>>20</option>
<option value="21" <?PHP if($day==21) echo "selected";?>>21</option>
<option value="22" <?PHP if($day==22) echo "selected";?>>22</option>
<option value="23" <?PHP if($day==23) echo "selected";?>>23</option>
<option value="24" <?PHP if($day==24) echo "selected";?>>24</option>
<option value="25" <?PHP if($day==25) echo "selected";?>>25</option>
<option value="26" <?PHP if($day==26) echo "selected";?>>26</option>
<option value="27" <?PHP if($day==27) echo "selected";?>>27</option>
<option value="28" <?PHP if($day==28) echo "selected";?>>28</option>
<option value="29" <?PHP if($day==29) echo "selected";?>>29</option>
<option value="30" <?PHP if($day==30) echo "selected";?>>30</option>
<option value="31" <?PHP if($day==31) echo "selected";?>>31</option>
</select>
</div>
</div>

<div class="btn-data">
<button onclick="cancel_btn();" class="btn cust-btn cancel_btn" type="button">Cancel</button>
<button  class="btn cust-btn "  type="submit" id="update" >Apply</button>
</div>
</form>
</div>
</div>
</div>
</div>
										
                                        <div id="store_label_Location" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <form id="formLabel"  method="post">
                                                        <div class="feature-box-inner">
                                                            <h3>labels</h3><br>
                                                            <div class="input-field-text"><p class="primary">To better filter and organize your forms, apply them labels (these are not visible publicly). Learn more</p></div>
                                                            <div class="form-group selected-data">
                                                                <input type="hidden" name="label" value="label"   />
                                                                <input type="hidden" name="acc_name" value="<?php echo $res->name; ?>" />
                                                                <div class="field_wrapper">
                                                                    <?php if (!isset($res->labels)) { ?>
                                                                        <input name="labels[]" id="storelabels" type ="text" value="<?php //echo $res->labels;   ?> " style="width:auto;" /> 
                                                                    <?php } else { ?>
                                                                        <?php foreach ($res->labels as $p) { ?>

                                                                            <input name="labels[]" id="storelabels" type ="text" value="<?php echo $p; ?> " style="width:auto;" /> 
                                                                        <?php }
                                                                    }
                                                                    ?>
                                                                    <a href="javascript:void(0);" class="add_label" title="Add field" >ADD LABEL</a>
                                                                </div>
                                                            </div>
                                                            <div class="btn-data">
                                                                <button onclick="cancel_btn();" class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                                <button  class="btn cust-btn "  type="submit" id="update" >Apply</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>											
                                        <div id="store_code_Location" class="modal" >
                                            <div class="modal-inner-pop">
                                                <div class="feature-box">
                                                    <div class="feature-box-inner">
                                                        <h3>Store Code</h3><br>
                                                        <div class="input-field"><p class="primary">Store_code</p></div>
                                                        <div class="form-group">
                                                            <div class="input-fieled">
                                                                <input name="storeCode" id="storeCode" type ="text" value="<?php echo $res->storeCode; ?> "  />
                                                            </div>
                                                        </div>
                                                        <div class="btn-data">
                                                            <button onclick="cancel_btn();" class="btn cust-btn cancel_btn" type="button">Cancel</button>
                                                            <button onclick="StoreCodeUpdate();" class="btn cust-btn " type="button">Apply</button>
                                                        </div>
                                                    </div>
                                                    <div class="note"><b>Please note:</b> Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>

                                                </div>
                                            </div>
                                        </div>										
                                        <div id="model_hours" class="modal" >
                                            <div class="modal-inner-pop">
                                            <form id="myForm"  method="post">
                                                <div class="add-feature-box-weak">
                                                    <div class="heading-row-fix">
                                                         <h3>Hours</h3>
                                                    </div>
                                                    <div class="add-feature-box-inner">
                                                        <input type="hidden" name="add_hours" value="add_hours" />
                                                        <input type="hidden" name="acc_name" value="<?php echo $res->name; ?>" />
                                                       
                                                        <div class="radio-button">
                                                            <div class="day-data">
                                                                <p>Sunday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="periods[sunday][check_sunday]" class="check_sun">
                                                                    <span class="slider" ></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="sun week-data">
                                                                <div class="input-inner">
                                                                <input type="hidden" name="periods[sunday][0][openDay]"  value="SUNDAY" />
                                                                <input type="hidden" name="periods[sunday][0][closeDay]" value="SUNDAY" />
                                                                <input type="text" name="periods[sunday][0][openTime]" id="start_hour" class="start_hour" value="" />
                                                               <span>__</span>
                                                                <input type="text" name="periods[sunday][0][closeTime]" id="end_hours" class="end_hours" value="" />
                                                             
                                                                <div class="input_fields_wrap">
                                                                    <button class="add_field_button add_field_button_common">Add Hours</button>
                                                                </div>
                                                            </div>
                                                                <div id="sun-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="radio-button">
                                                            <div class="day-data">
                                                                <p>Monday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="periods[monday][check_monday]" class="check_mon" >
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="mon week-data">
                                                                <div class="input-inner">
                                                                <input type="hidden" name="periods[monday][0][openDay]"  value="MONDAY" />
                                                                <input type="hidden" name="periods[monday][0][closeDay]" value="MONDAY" />
                                                                <input type="text" name="periods[monday][0][openTime]" id="start_hour1" class="start_hour" value="" />
                                                              <span>__</span>
                                                                <input type="text" name="periods[monday][0][closeTime]" id="end_hours1" class="end_hours" value=""/>

                                                                <div class="input_fields_wrap1">
                                                                    <button class="add_field_button1 add_field_button_common">Add Hours</button>
                                                                </div>
                                                            </div>
                                                                <div id="mon-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="radio-button">
                                                            <div class="day-data">
                                                                <p>Tuesday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox"  name="periods[tuesday][check_tuesday]" class="check_tue" >
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="tue week-data">
                                                                 <div class="input-inner">
                                                                <input type="hidden" name="periods[tuesday][0][openDay]"  value="TUESDAY" />
                                                                <input type="hidden" name="periods[tuesday][0][closeDay]" value="TUESDAY" />
                                                                <input type="text" name="periods[tuesday][0][openTime]" id="start_hour2" class="start_hour" value="" />
                                                               <span>__</span>
                                                                <input type="text" name="periods[tuesday][0][closeTime]" id="end_hours2" class="end_hours" value=""/>
                                                                
                                                                <div class="input_fields_wrap2">
                                                                    <button class="add_field_button2 add_field_button_common">Add Hours</button>
                                                                </div>
                                                            </div>
                                                             <div id="tue-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="radio-button">
                                                            <div class="day-data">
                                                                <p>Wednesday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="periods[wednesday][check_wednesday]" class="check_wed" >
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="wed week-data">
                                                                 <div class="input-inner">
                                                                <input type="hidden" name="periods[wednesday][0][openDay]"  value="WEDNESDAY" />
                                                                <input type="hidden" name="periods[wednesday][0][closeDay]" value="WEDNESDAY" />
                                                                <input type="text" name="periods[wednesday][0][openTime]" id="start_hour3" class="start_hour" value="" />
                                                                <span>__</span>
                                                                <input type="text" name="periods[wednesday][0][closeTime]" id="end_hours3" class="end_hours" value=""/>
                                                                
                                                                <div class="input_fields_wrap3">
                                                                    <button class="add_field_button3 add_field_button_common">Add Hours</button>
                                                                </div>
                                                            </div>
                                                            <div id="wed-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="radio-button">
                                                           <div class="day-data">
                                                                <p>Thursday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="periods[thursday][check_thursday]" class="check_thu" >
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="thu week-data">
                                                                <div class="input-inner">
                                                                <input type="hidden" name="periods[thursday][0][openDay]"  value="THURSDAY" />
                                                                <input type="hidden" name="periods[thursday][0][closeDay]" value="THURSDAY" />
                                                                <input type="text" name="periods[thursday][0][openTime]" id="start_hour4" class="start_hour" value="" />
                                                                <span>__</span>
                                                                <input type="text" name="periods[thursday][0][closeTime]" id="end_hours4" class="end_hours" value=""/>
                                                                
                                                                <div class="input_fields_wrap4">
                                                                    <br>
                                                                    <button class="add_field_button4 add_field_button_common">Add Hours</button>
                                                                </div>
                                                            </div>
                                                                 <div id="thu-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="radio-button">
                                                            <div class="day-data">
                                                                <p>Friday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="periods[friday][check_friday]" class="check_fri" >
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="fri week-data">
                                                                  <div class="input-inner">
                                                                <input type="hidden" name="periods[friday][0][openDay]"  value="FRIDAY" />
                                                                <input type="hidden" name="periods[friday][0][closeDay]" value="FRIDAY" />
                                                                <input type="text" name="periods[friday][0][openTime]" id="start_hour5" class="start_hour" value="" />
                                                                <span>__</span>
                                                                <input type="text" name="periods[friday][0][closeTime]" id="end_hours5" class="end_hours" value=""/>
                                                                
                                                                <div class="input_fields_wrap5">
                                                                    <br>
                                                                    <button class="add_field_button5 add_field_button_common">Add Hours</button>
                                                                </div>
                                                            </div>
                                                                <div id="fri-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>
                                                        <div class="radio-button">
                                                            <div class="day-data">
                                                                <p>Saturday</p>
                                                                <label class="switch">
                                                                    <input type="checkbox" name="periods[saturday][check_saturday]" class="check_sat" >
                                                                    <span class="slider"></span>
                                                                </label>
                                                                <p> Closed</p>
                                                            </div>
                                                            <fieldset class="sat week-data">
                                                                  <div class="input-inner">
                                                                <input type="hidden" name="periods[saturday][0][openDay]"  value="SATURDAY" />
                                                                <input type="hidden" name="periods[saturday][0][closeDay]" value="SATURDAY" />
                                                                <input type="text" name="periods[saturday][0][openTime]" id="start_hour6" class="start_hour" value="" />
																<span>__</span>                         
                                                                <input type="text" name="periods[saturday][0][closeTime]" id="end_hours6" class="end_hours" value=""/>
                                                                
                                                                <div class="input_fields_wrap6">

                                                                    <button class="add_field_button6 add_field_button_common">Add Hours</button>
                                                                </div>
                                                                </div>
                                                                <div id="sat-inputs" class="common-sun"></div>
                                                            </fieldset>
                                                        </div>                                                       
                                                    </div>
                                                    <div class="fixed-row">
                                                     <div class="btn-data">
                                                            <button onclick="cancel_btn();"  class="btn cust-btn cancel_btn " type="button">Cancel</button>
                                                            <button  class="btn cust-btn "  type="submit" id="update" >Apply</button>
                                                        </div>
                                                    <div class="note"><b>Please note:</b> Edits may be reviewed for quality and can take up to 3 days to be published. <a class="" target="_blank" href="//support.google.com/business?authuser=1&amp;hl=en&amp;p=appearance_time&amp;authuser=1">Learn more</a></div>
                                                </div>
                                                </div>
                                            </form>
                                        </div>
                                        </div>
                                        <div class="info-number">
                                            <ul>
                                                <li><i class="fa fa-phone" aria-hidden="true"></i><span id="loc_numberEdit"><?php echo $res->primaryPhone; ?></span>	<a id="number_Location" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a></li>
                                                <li><i class="fa fa-globe" aria-hidden="true"></i><span id="html_websiteUrl"><?php echo $res->websiteUrl; ?></span>	<a id="btn_websiteUrl" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a></li>			  
                                                <li> <i class="fa fa-location-arrow" aria-hidden="true"></i><span id="html_address"><?php echo $res->address->addressLines[0]; ?></span><a id="btn_address" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>	</li>

                                                <li id="hours_text" > <?php if (!isset($res->regularHours)) { ?><i class="fa fal fa-clock" aria-hidden="true"></i><span id="html_address">Add hours</span><a id="btn_hours" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
<?php } else { ?>
                                                        <i class="fa fal fa-clock" aria-hidden="true"></i><a id="btn_hours" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
                                                        <div  class="html_time"><?php
                                                            $days = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");

                                                            foreach ($res->regularHours->periods as $p) {

                                                                if (in_array(strtolower($p->openDay), $days)) {
                                                                    if ($p->closeTime == "24:00") {
                                                                        $resnew[strtolower($p->openDay)] = $p->openDay . " Open 24 hours";
                                                                    } else {
                                                                        $s_time = date('h:i a', strtotime($p->openTime));
                                                                        $e_time = date('h:i a', strtotime($p->closeTime));
                                                                        $resnew[strtolower($p->openDay)] = $p->openDay . "  " . $s_time . " - " . $e_time;
                                                                    }
                                                                }
                                                            }
                                                            /* echo "<pre>";
                                                              print_r($resnew); */
                                                            foreach ($days as $d) {
                                                                if (isset($resnew[$d])) {
                                                                    echo $resnew[$d] . '<br>';
                                                                } else {
                                                                    echo strtoupper($d) . ' Closed <br>';
                                                                }
                                                            }
                                                            ?></div>
<?php } ?></li>
                                                <li><?php
												
												

												
												
												
												if(isset($res->openInfo->openingDate)){
												?> <i class="fa fa-location-arrow" aria-hidden="true"></i><span id="opening_date_update"><?php echo $openings; ?></span><a id="opening_date_add" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a> <?php } else { ?>
												<i class="fa fa-location-arrow" aria-hidden="true"></i><span >Add opening date</span><a id="opening_date_add" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
												
												
												
												<?php } ?>	</li>
                                                <li> <i class="fa fa-location-arrow" aria-hidden="true"></i><span id="html_address">Add photos</span><a id="btn_media11" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>	</li>												
                                            </ul>          	   	  		 			  
                                        </div>
                                    </div>
                                    <div class="right-google-map">
                                        <div jsname="s0Gaoc" jscontroller="Y4Zpoe" data-is-closed="false"><div class="cj sE D0 " jscontroller="bFoR2d" jsshadow=""><div class="rE"><content><div class="Dq"></div><div class="y0"><div class="B0"><div class="A0">Pending review</div></div><div class="w0 ">Some edits are pending. Edits may be reviewed for quality and can take up to 3 days to be published. <a class="TaHDN" href="https://support.google.com/business?hl=en&amp;p=status_pending&amp;_ga=2.216855441.689315213.1529487825-850914938.1529061884" target="_blank">Learn more</a></div><div class="uca"></div></div></content></div></div></div>
                                        <div class="map"><?php echo @$google_map_info; ?></div><div class="map-link"><a href="<?php echo $res->metadata->mapsUrl; ?>" target="_blank"><div class="view"><img src="img/map-img.png"><?php echo @$view_map; ?></div></a></div>  
                                        <div>
                                            <p class="advance">Advanced information</p>
                                            <ul class="adv_label">
                                                <li><span class="advanced-span">Store code</span><span id="store_codeEdit"><?php echo $res->storeCode; ?></span><a id="store_code" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a></li>
                                                <li id="label_text" class="label_text"> <?php if (!isset($res->labels)) { ?><span class="advanced-span">Labels</span><a id="store_label" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
<?php } else { ?>
                                                        <span class="advanced-span">Labels</span><a id="store_label" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a>
                                                        <ul>
                                                            <?php
                                                            foreach ($res->labels as $p) {
                                                                ?>
                                                                <li>
                                                                    <?php
                                                                    echo $p;
                                                                    ?>
                                                                </li>

    <?php } ?>

                                                        </ul>
<?php } ?></li>
                                                <li><span class="advanced-span">AdWords location </br> extensions phone</span><span id="store_adPhone"><?php echo $res->adWordsLocationExtensions->adPhone ; ?></span>	<a id="adwords_number" href="javascript:void(0);"><img src="img/pencil_edit.png" /></a></li>

                                            </ul>   


                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade " id="photo2" role="tabpanel" aria-labelledby="photo-tab">
                            <div id="AdfotoModel" class="modal" >
                                <div class="modal-inner-pop">
								
                                    <div class="feature-box">
                                        <div class="feature-box-inner">
										<form class="dropzone" id="data" method="post" enctype="multipart/form-data">
                                            <div><h3 class="page-header" style="width:50%;">Publier des photos et vidéos</h3>
                                                <button type="button" onclick="cancel_btn();" class="close" data-dismiss="modal" aria-hidden="true" style="float: right;font-weight: 700;line-height: 1;color: #000;margin-top: -24px;">×</button>     
               

                                            </div>
											
											 <div id="msg_box"></div>
                                            <div style="display: flex; justify-content: center;align-items: center;width: 78%;height:250px;border-style: dashed;color: #d8d7d7; margin-top: 49px;">
                                                <div>
                                                   
                                                        <div class="form-group">
                                                            <p class="primary"> <input type="file" class="form-control-file" name="media_loc" id="id_media_loc" type ="file" value=""  /></p>
                                                            <input type="hidden" name="acc_name" value="<?php echo $res->name; ?>"  />
                                                            <input type="hidden" name="access_token" value="<?php echo $access_token; ?>"  />
                                                            <input type="hidden" name="loc_media" value="media"  />
															 <input type="hidden" id="loc_media_type_id" name="loc_media_type" value=""  />
                                                           


                                                    

                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-left" style="margin-top:18px;">
                                            <button  class="btn cust-btn-main" type="submit">Sélectionner</button>
                                            <button onclick="cancel_btn();"  class="btn cust-btn-main cancel_btn" type="button">Annueler</button>
                                        </div>
											
</form>
                                    </div>
                                    <div class="footer-dash" style="margin-top:58px;">
                                        <p><b>Remarque:</b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et </p>
                                    </div>
                                </div>
								
                            </div>
                        </div>	
                        <div class="buton-left">
                            <button type="button" onclick="media_popup_open('INTERIOR');" id="btn_media" class="btn btn-primary plus" style="border-radius: 100%; padding: 6px; margin: 0px -3px 10px 700px;-webkit-filter: drop-shadow(0px 11px 4px rgba(0,0,0,0.2));width: 48px;font-weight: bold;font-size: 18px;">+</button>
                        </div>
                        <div class="location-content">
                            <div class="full-location" id="loc_photos">
                                <!-- <ul class="location-title">
                                  <li>Photo</li>
                                                      
                                </ul>  
                                --> 
<?php 
$cover="";
$profile="";
foreach ($r_media->mediaItems as $key1 => $res1) {
$med_cat=$res1->locationAssociation->category;

if($med_cat=="COVER"){
	$cover="true";


}
if($med_cat=="PROFILE"){
$profile="true";
}
 }	?>								
                                <div class="card-deck">
								<?php if($profile==""){  ?>
                                    <div class="card">
                                        <img class="card-img-top" src="/img/profile.png" alt="Card image" style="width:100%">

                                        <div class="card-body">
                                            <h5 class="card-title">Profil</h5>
                                            <p class="card-text">Votre photo de profil permet d'indiquer votre identité lorsque vous publiez une image ou que vous répondez à un avis.</p>
                                            <a onclick="media_popup_open('PROFILE');" href="javascript:void(0)" class="btn btn-primary left" style="width:100%;margin-top:24px;">Sélectionner une photo</a>
                                        </div>
                                    </div>
								<?php } if($cover==""){  ?>
                                    <div class="card">
                                        <img class="card-img-top" src="/img/cover.svg" alt="Card image" style="width:100%">
                                        <div class="card-body">
                                            <h5 class="card-title">Couverture</h5>
                                            <p class="card-text">Votre photo de couverture doit refléter la personnalité de votre établissement. Il s'agit de l'image que vous préférez afficher sur votre fiche dans la recherche Google et dans Maps.</p>
                                            <a onclick="media_popup_open('COVER');" href="javascript:void(0)" class="btn btn-primary center" style="width:100%">Sélectionner une photo</a>
                                        </div>

                                    </div>
<?php } ?>
                                </div>
                                <br>
                                <br>

                                <div id="" class="photo-title">
<?php foreach ($r_media->mediaItems as $key1 => $res1) {
$med_cat=$res1->locationAssociation->category;
if($med_cat=="COVER"){   ?>
<div id="div_image_<?php echo $key1; ?>">
                                            <img height="200px" width="200px" src='<?php echo $res1->thumbnailUrl; ?>'>	 <a onclick="media_popup_open('COVER');" href="javascript:void(0)" class="btn btn-primary" >Cover Edit</a>
                                <!--a class="img_del" onclick="delete_media('<?php echo $key1 ?>','<?php echo $name; ?>');"; href="javascript:void(0);"><?php echo @$phpto_del; ?></a-->
                                            <div class="delete-icon"><a class="img_del remove-btn" onclick="delete_media('<?php echo $key1 ?>', '<?php echo $name; ?>','<?php echo $res1->name  ?>');"; href="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div></div>
<?php  }elseif($med_cat=="PROFILE"){  ?>
<div id="div_image_<?php echo $key1; ?>">
                                            <img height="200px" width="200px" src='<?php echo $res1->thumbnailUrl; ?>'><a onclick="media_popup_open('PROFILE');" href="javascript:void(0)" class="btn btn-primary" >PROFILE Edit</a>
                                <!--a class="img_del" onclick="delete_media('<?php echo $key1 ?>','<?php echo $name; ?>');"; href="javascript:void(0);"><?php echo @$phpto_del; ?></a-->
                                            <div class="delete-icon"><a class="img_del remove-btn" onclick="delete_media('<?php echo $key1 ?>', '<?php echo $name; ?>','<?php echo $res1->name  ?>');"; href="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div></div>


<?php }else{	?>
	
                                        <div id="div_image_<?php echo $key1; ?>">
                                            <img height="200px" width="200px" src='<?php echo $res1->thumbnailUrl; ?>'>	
                                <!--a class="img_del" onclick="delete_media('<?php echo $key1 ?>','<?php echo $name; ?>');"; href="javascript:void(0);"><?php echo @$phpto_del; ?></a-->
                                            <div class="delete-icon">  <a class="img_del remove-btn" onclick="delete_media('<?php echo $key1 ?>', '<?php echo $name; ?>','<?php echo $res1->name  ?>');"; href="javascript:void(0);"><i class="fas fa-trash-alt"></i></a></div></div>
                                        <?php
}  }
                                    ?>				  

                                </div>

                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</div>
</section>

<script>
 $("#toggle_menu2").click(function () {
        $("#Left_menu_div2").toggleClass("slide-left-bar");
        $("#right_menu_div2").toggleClass("slide-right-bar");
    });
	//alert(screen.width);
	if (screen.width < 768) {
	  $(".google_link_mobile2").click(function () {

        $("#Left_menu_div2").toggleClass("slide-left-bar");
    }); 
	}

    $("form#data").submit(function (e) {

        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: "gbm/edit/loc_e.php",
            type: 'POST',
            data: formData,
            success: function (data) {
				
				try {
   var json = jQuery.parseJSON(data);
	 $("#msg_box").html(json.message);
} catch (e) {
     $("#loc_photos").html(data);
     $("#AdfotoModel").hide();
}
				/* var response=jQuery.parseJSON(data);
				alert(response);
				if(typeof response =='object')
				{
				 $("#msg_box").html(response.message);
				}else{
                $("#loc_photos").html(data);
                $("#AdfotoModel").hide();
				} */
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

    function delete_media(key,name,media_name) {

        var url = "gbm/examples/delete_media.php";

        $.ajax({
            type: "POST",
            url: url,
            data: {'key': key, 'name': name,'media_name':media_name}, // serializes the form's elements.
            success: function (data)
            {
                $("#div_image_" + key).remove();


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

   // var modal = document.getElementsByClassName('modal');
// Get the button that opens the modal


// Get the <span> element that closes the modal
    //var span = document.getElementsByClassName("cancel_btn")[0];

// When the user clicks the button, open the modal 
// When the user clicks on <span> (x), close the modal
   /*  span.onclick = function () {
        modal.style.display = "none";
    } */

// When the user clicks anywhere outside of the modal, close it
   /*  window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    } */
    function cancel_btn() {
        $('.modal').hide();

    }
	 document.getElementById('localpost').onclick = function () {

        $("#localpostModel").show();
    }
    document.getElementById('name_Location').onclick = function () {

        $("#myModal").show();
    }
    
	function LocationUpdate() {
        var url = "gbm/edit/loc_edit.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'locationName': $("#id_loc_name").val()},
            // serializes the form's elements.
            success: function (data)
            {
                $("#location_edit1").html($("#id_loc_name").val());
                $("#location_edit2").html($("#id_loc_name").val());
                modal.style.display = "none";

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }

    document.getElementById('number_Location').onclick = function () {

        $("#numberModel").show();
    }
    function LocationNumberUpdate() {
        var url = "gbm/edit/loc_edit.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'primaryPhone': $("#id_loc_number").val()},
            // serializes the form's elements.
            success: function (data)
            {

                $("#loc_numberEdit").html($("#id_loc_number").val());
                $("#numberModel").hide();

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }

    function StoreCodeUpdate() {
        var url = "gbm/edit/loc_edit.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'storeCode': $("#storeCode").val()},
            // serializes the form's elements.
            success: function (data)
            {

                $("#store_codeEdit").html($("#storeCode").val());
                $("#store_code_Location").hide();

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    function AdWordsNumberUpdate() {
        var url = "gbm/edit/loc_edit.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'additionalPhones': $("#id_adword_number").val()},
            // serializes the form's elements.
            success: function (data)
            {

                
                $("#store_adPhone").html($("#id_adword_number").val());
                $("#AdWordsModel").hide();

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    document.getElementById('btn_websiteUrl').onclick = function () {

        $("#model_websiteUrl").show();
    }
    function Location_websiteUrl() {
        var url = "gbm/edit/loc_edit.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'websiteUrl': $("#id_websiteUrl").val()},
            // serializes the form's elements.
            success: function (data)
            {

                $("#html_websiteUrl").html($("#id_websiteUrl").val());
                $("#model_websiteUrl").hide();

            }
        });
        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    document.getElementById('btn_address').onclick = function () {

        $("#model_address").show();
    }
    document.getElementById('btn_hours').onclick = function () {

        $("#model_hours").show();
    }
    document.getElementById('store_code').onclick = function () {
        $("#store_code_Location").show();

    }
    document.getElementById('store_label').onclick = function () {
        $("#store_label_Location").show();

    }
    document.getElementById('adwords_number').onclick = function () {
        $("#AdWordsModel").show();

    }
	document.getElementById('opening_date_add').onclick = function () {
		
		$("#openingModel").show();
      
    }
    /* document.getElementById('btn_media').onclick = function () {
        $("#AdfotoModel").show();

    } */
	/*-------------------------------open div by button of add photo ----------*/
	document.getElementById('btn_media11').onclick = function () {
        $('.nav-link').removeClass('active');
        $('.nav-link').removeClass('show');
    $('#photo-tab').addClass('active');
    $('#photo-tab').addClass('show');
	  $('.tab-pane').removeClass('active');
	  $('.tab-pane').removeClass('show');
	  $('.tab-pane').removeClass('show');
   
	 $('#photo').addClass('active');
	 $('#photo').addClass('show');
	  $('#photo').show();

    }
	function media_popup_open(media_type){
		//alert(media_type);
		$("#loc_media_type_id").val(media_type);
		$("#AdfotoModel").show();
	}
    function Location_address() {
        var url = "gbm/edit/loc_edit.php";
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'address': 'address', 'addressLines': $("#id_addressLines").val(), 'postalCode': $("#id_postalCode").val(), 'locality': $("#id_locality").val(), 'country': $("#id_country").val()},
            // serializes the form's elements.
            success: function (data)
            {

                $("#html_address").html($("#id_addressLines").val());
                $("#model_address").hide();

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
    document.getElementById('btn_category').onclick = function () {

        $("#model_category").show();
    }
    function Location_category() {
        var url = "gbm/edit/loc_edit.php";
        var cat_name = $("#id_category option:selected").text();
        var categoryId = $("#id_category option:selected").val();
        $.ajax({
            type: "POST",
            url: url,
            data: {'acc_name': '<?php echo $res->name; ?>', 'cat': 'cat', 'cat_name': cat_name, 'categoryId': categoryId},
            // serializes the form's elements.
            success: function (data)
            {

                $("#html_category").html(cat_name);
                $("#model_category").hide();

            }
        });

        // e.preventDefault(); // avoid to execute the actual submit of the form.
    }
</script> 
<script type="text/javascript">

    $(".sun").hide();
    $(".mon").hide();
    $(".tue").hide();
    $(".wed").hide();
    $(".thu").hide();
    $(".fri").hide();
    $(".sat").hide();
    $(".check_sun").click(function () {
        if ($(this).is(":checked")) {
            $(".sun").show();
        } else {
            $(".sun").hide();
        }
    });
    $(".check_mon").click(function () {
        if ($(this).is(":checked")) {
            $(".mon").show();
        } else {
            $(".mon").hide();
        }
    });
    $(".check_tue").click(function () {
        if ($(this).is(":checked")) {
            $(".tue").show();
        } else {
            $(".tue").hide();
        }
    });
    $(".check_wed").click(function () {
        if ($(this).is(":checked")) {
            $(".wed").show();
        } else {
            $(".wed").hide();
        }
    });
    $(".check_thu").click(function () {
        if ($(this).is(":checked")) {
            $(".thu").show();
        } else {
            $(".thu").hide();
        }
    });
    $(".check_fri").click(function () {
        if ($(this).is(":checked")) {
            $(".fri").show();
        } else {
            $(".fri").hide();
        }
    });
    $(".check_sat").click(function () {
        if ($(this).is(":checked")) {
            $(".sat").show();
        } else {
            $(".sat").hide();
        }
    });
</script>

<script>
    $(document).ready(function () {
        var max_fields = 10;
      var wrapper = $("#sun-inputs");
        var add_button = $(".add_field_button");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="sun"><div class="input-inner"> <input type="hidden" name="periods[sunday][' + x + '][openDay]"  value="SUNDAY" /><input type="hidden" name="periods[sunday][' + x + '][closeDay]" value="SUNDAY" /> <input type="text" name="periods[sunday][' + x + '][openTime]" id="start_hour" class="start_hour" value=""/> <span>__</span><input type="text" name="periods[sunday][' + x + '][closeTime]" id="end_hours" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#mon-inputs");
        var add_button = $(".add_field_button1");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="mon"><div class="input-inner"><input type="hidden" name="periods[monday][' + x + '][openDay]"  value="MONDAY" /> <input type="hidden" name="periods[monday][' + x + '][closeDay]" value="MONDAY" /> <input type="text" name="periods[monday][' + x + '][openTime]" id="start_hour1" class="start_hour" value=""/> <span>__</span><input type="text" name="periods[monday][' + x + '][closeTime]" id="end_hours1" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#tue-inputs");
        var add_button = $(".add_field_button2");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="tue"><div class="input-inner"> <input type="hidden" name="periods[tuesday][' + x + '][openDay]"  value="TUESDAY" /> <input type="hidden" name="periods[tuesday][' + x + '][closeDay]" value="TUESDAY" /> <input type="text" name="periods[tuesday][' + x + '][openTime]" id="start_hour2" class="start_hour" value=""/><span>__</span><input type="text" name="periods[tuesday][' + x + '][closeTime]" id="end_hours2" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#wed-inputs");
        var add_button = $(".add_field_button3");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="wed"><div class="input-inner"> <input type="hidden" name="periods[wednesday][' + x + '][openDay]"  value="WEDNESDAY" />  <input type="hidden" name="periods[wednesday][' + x + '][closeDay]" value="WEDNESDAY" /> <input type="text" name="periods[wednesday][' + x + '][openTime]" id="start_hour3" class="start_hour" value=""/> <span>__</span><input type="text" name="periods[wednesday][' + x + '][closeTime]" id="end_hours3" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#thu-inputs");
        var add_button = $(".add_field_button4");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="thu"><div class="input-inner"><input type="hidden" name="periods[thursday][' + x + '][openDay]"  value="THURSDAY" /> <input type="hidden" name="periods[thursday][' + x + '][closeDay]" value="THURSDAY" /> <input type="text" name="periods[thursday][' + x + '][openTime]" id="start_hour4" class="start_hour" value=""/> <span>__</span><input type="text" name="periods[thursday][' + x + '][closeTime]" id="end_hours4" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#fri-inputs");
        var add_button = $(".add_field_button5");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="fri"> <div class="input-inner"><input type="hidden" name="periods[friday][' + x + '][openDay]"  value="FRIDAY" /><input type="hidden" name="periods[friday][' + x + '][closeDay]" value="FRIDAY" /> <input type="text" name="periods[friday][' + x + '][openTime]" id="start_hour5" class="start_hour" value=""/> <span>__</span><input type="text" name="periods[friday][' + x + '][closeTime]" id="end_hours5" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })
    });
</script>
<script>
    $(document).ready(function () {
        var max_fields = 10;
        var wrapper = $("#sat-inputs");
        var add_button = $(".add_field_button6");
        var x = 0;
        $(add_button).click(function (e) {
            e.preventDefault();
            if (x < max_fields) {
                x++;
                $(wrapper).append('<fieldset class="sat"><div class="input-inner"><input type="hidden" name="periods[saturday][' + x + '][openDay]"  value="SATURDAY" /><input type="hidden" name="periods[saturday][' + x + '][closeDay]" value="SATURDAY" /> <input type="text" name="periods[saturday][' + x + '][openTime]" id="start_hour6" class="start_hour" value=""/> <span>__</span><input type="text" name="periods[saturday][' + x + '][closeTime]" id="end_hours6" class="end_hours" value=""/><a href="#" class="remove_field"><i class="fa fa-times" aria-hidden="true"></i></a></div></fieldset>');
            }
            $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
            $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});
        });
        $(wrapper).on("click", ".remove_field", function (e) {
            e.preventDefault();
            $(this).closest('fieldset').remove();
            x--;
        })

    });
</script>
<script>
    $(function () {

        $('form#myForm').on('submit', function (e) {

            e.preventDefault();

            $.ajax({
                type: 'post',
                url: "gbm/edit/loc_edit.php",
                data: $('form#myForm').serialize(),
                success: function (data) {
                    $("#hours_text").html(data);
                    $("#model_hours").hide();
                }
            });

        });
        return false;
    });

</script>
<script>
function show_localPost_Fields(tab)
{
	if (tab == 1){
	$("#localpost_topictype").val('STANDARD');
	document.getElementById("post_detail_localpost").placeholder = "Write Your Post";
    document.getElementById('localpost_title').style.display = 'none';
    document.getElementById('post_date_time_locahost').style.display = 'none';
	document.getElementById('localpost_calltoaction').style.display = 'block';
	document.getElementById('localpost_post_url').style.display = 'block';
	document.getElementById('localpost_coupon_code').style.display = 'none';
	document.getElementById('localpost_offer_link').style.display = 'none';
	document.getElementById('localpost_offer_term_condition').style.display = 'none';
	
				}
				if (tab == 2){
					$("#localpost_topictype").val('EVENT');
	document.getElementById('post_detail_localpost').placeholder = "Event Details";
	document.getElementById('post_title_localpost').placeholder = "Title of the event";
	$('#post_text_localpost').text("(Example: Promotions this week)");
    document.getElementById('localpost_title').style.display = 'block';
    document.getElementById('post_date_time_locahost').style.display = 'block';
	document.getElementById('localpost_calltoaction').style.display = 'block';
	document.getElementById('localpost_post_url').style.display = 'block';
	document.getElementById('localpost_coupon_code').style.display = 'none';
	document.getElementById('localpost_offer_link').style.display = 'none';
	document.getElementById('localpost_offer_term_condition').style.display = 'none';
				}
				if (tab == 3){
					$("#localpost_topictype").val('OFFER');
	document.getElementById('post_detail_localpost').placeholder = "Offer Details";
	document.getElementById('post_title_localpost').placeholder = "Title of the offer";
	$('#post_text_localpost').text("(Example:20% discount in store or online)");
    document.getElementById('localpost_title').style.display = 'block';
    document.getElementById('post_date_time_locahost').style.display = 'block';
    document.getElementById('localpost_coupon_code').style.display = 'block';
    document.getElementById('localpost_offer_link').style.display = 'block';
    document.getElementById('localpost_offer_term_condition').style.display = 'block';
    document.getElementById('localpost_calltoaction').style.display = 'none';
    document.getElementById('localpost_post_url').style.display = 'none';
	
				}
}

$(function() {
  $('.upload-img').on('change', function(evt) {
    var file = evt.target.files[0];
    var _this = evt.target;
    $(this).parent('.upload-section').hide();
    var reader = new FileReader();
    reader.onload = function(e) {
      var span = '<img class="thumb mrm mts" src="' + e.target.result + '" title="' + escape(file.name) + '"/><span class="remove_img_preview"></span>';
      $(_this).parent('.upload-section').next().append($(span));
    };
    reader.readAsDataURL(file);
    //evt.target.value = "";
  });

  $('.preview-section').on('click', '.remove_img_preview', function() {
    $(this).parent('.preview-section').prev().show();
    $(this).parent('.preview-section').remove();
  });
});
$(function () {
        $("form#submit_post_data_1").submit(function (e) {
            e.preventDefault();

var formData = new FormData(this);
            $.ajax({
				url: "gbm/edit/loc_localpost.php",
                type: 'POST',
                data: formData,
				
                success: function (data) {
					//alert(data);
                     $("#local_post_list").html(data);
                    cancel_btn();
                },
				cache: false,
            contentType: false,
            processData: false
            });

        });
        return false;
    });
	
	

	
	
	
    $(function () {


        $("form#formLabel").submit(function (e) {
            e.preventDefault();


            $.ajax({
                type: 'post',
                url: "gbm/edit/loc_edit.php",
                data: $('form#formLabel').serialize(),
                success: function (data) {
                    $("#label_text").html(data);
                    $("#store_label_Location").hide();
                }
            });

        });
        return false;
    });
 $(function () {

       
		$("form#formOpening").submit(function(e) {	
          e.preventDefault();
		
			
          $.ajax({
            type: 'post',
            url: "gbm/edit/loc_edit.php",
            data: $('form#formOpening').serialize(),
            success: function (data) {
            $("#opening_date_update").html(data);
                $("#openingModel").hide();
            }
          });

        });
         return false;
      });
</script>
<script>
   
        $('.start_hour').timepicker({timeFormat: 'G:i', show2400: true});
        $('.end_hours').timepicker({timeFormat: 'G:i', show2400: true});

</script>
<script type="text/javascript">
    $(document).ready(function () {
        var maxField = 10;
        var addButton = $('.add_label');
        var wrapper = $('.field_wrapper');
        var fieldHTML = '<div class="field_wrapper"><input name="labels[]" id="storelabels" type ="text" value=" " style="width:auto;" /><a href="javascript:void(0);" class="remove_button"><i class="fa fa-times" aria-hidden="true"></i></a></div>';
        var x = 1;
        $(addButton).click(function () {
            if (x < maxField) {
                x++;
                $(wrapper).append(fieldHTML);
            }
        });
        $(wrapper).on('click', '.remove_button', function (e) {
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        });
    });
</script>
<script>
 $("#events_pop-tab").click(function() {
    $( ".datepicker" ).datepicker();
	 $('.timepicker').timepicker({timeFormat: 'G:i', show2400: true});
 });
 $("#Offers_pop-tab").click(function() {
    $( ".datepicker" ).datepicker();
	 $('.timepicker').timepicker({timeFormat: 'G:i', show2400: true});
 });
  </script>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->



