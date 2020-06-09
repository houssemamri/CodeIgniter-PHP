

<?php
        //include('navbar.php');
        if(strcmp($_SESSION['language'],'en')==0)
        {
          
			$mu_business="My Business";
			$Manage_locations="Manage locations";  
			$Location="Location";
			$All_locations="All locations";		  
			$loc_name="Name";		  
			$loc_Status="Status";		  
			$Published="Published";		  
			$home_loc="Home";		  
			$loc_Review="Review";		  
			$loc_info="Info";		  
			$loc_photo="Foto"; 
			$loc_all="All"; 
			$loc_REPLIED="REPLIED";		  
			$hav_replied="HAVEN'T REPLIED";		  
			$Owner="Owner";		  
			$v_edit="View and Edit";		  
			$loc_REPLY="REPLY";
			$info_title="HELLO ! ";
			$info_details="Review Thunder enables you to answer to your different customer’s reviews and so much more !
Numerous Advices are present withing our Blog in order to help you answer to your reviews and to help you understand the global 
management of Reviews. 
In the case you have any idea about articles or any questions, please feel free to contact us. It will always be a lpeasure to answer ! 
With our warmest regards !"; 
			$google_map_info="Your business is live on Google";
			$view_map="View on Maps";		  
		  

        }
        else if(strcmp($_SESSION['language'],'spa')==0)
        {
         
			$mu_business="MyBusiness";
			$Manage_locations="Gestionar los Establecimientos";
			$Location="Établicimientos"; 
			$All_locations="Todos los lugares"; 
			$loc_name="Nombre"; 
			$loc_Status="Estatuto"; 
			$Published="Publicado";
			$home_loc="Acogida";	    
			$loc_Review="Calificaciones";	    
			$loc_info="Información";	    
			$loc_photo="Foto"; 
			$loc_all="Todo"; 
			$loc_REPLIED="RESPONDIDO";
			$hav_replied="Sin Respuestas";	
			$Owner="Propietario";
			$v_edit="Ver y editar";
			$loc_REPLY="Responder o Modificar";	
			$info_title="Holà !";
			$info_details="Review Thunder te ofrece la posibilidad de responder a tus Calificaciones.Puedes encontrar muchos consejos dentro de nuestro Blog para ayudar te a Responder a tus Calificacionces i entender todo el Managment de ellas. En el caso que tienes ideas para Articulos o si necesitas informaciones para utilisar este software, puedes llamar nos i sera un placer de ayudar te. 
			Hasta Pronto !";	
			$google_map_info="Tu Empresa Esta online";	
			$view_map="Ver sobre la Mapa";  
        }
        else
        {
          
			  $mu_business="MyBusiness";
			  $Manage_locations="Gérer les Établissements"; 
			$Location="Établissements";
			$All_locations="Tous les lieux"; 		   
			$loc_name="Nom"; 		   
			$loc_Status="Statut"; 		   
			$Published="Publié";
			$home_loc="Accueil"; 
			$loc_Review="Commentaires"; 
			$loc_info="Info"; 
			$loc_photo="Photo"; 
			$loc_all="TOUT"; 
			$hav_replied="Aucune Réponse";
			$Owner="Propriétaire";
			$v_edit="Voir et éditer";
			$loc_REPLY="RÉPONDRE";	
			$info_title="BONJOUR !";
			$info_details="Review Thunder vous offre la possibilité de répondre à vos différents avis clients.
			De nombreux conseils sont présents au sein du Blog pour vous aider dans la préparation de vos réponses ainsi que dans la compréhension du processus Global de la Gestion de vos Avis Clients. Dans le cas vous auriez des questions ou des idées de Thèmes d’Articles pour le Blog surtout n’hésitez pas à nous contacter ! 
			A bientôt !";
			$google_map_info="Votre Entreprise est en ligne sur";	
			$view_map="Voir sur la Carte";

        } ?>
<?php
include_once "connection.php";


$user_id=$_SESSION['user_id'];
$sql="SELECT * FROM `oauth_user` where user_id=".$_SESSION['user_id'];
	$result=$conn->query($sql);
   $data=$result->fetch_array();
//$access=	json_decode($_SESSION['access_token']);
  $access_token= $data['access_token'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://mybusiness.googleapis.com/v3/accounts/100928649975105038548/locations",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Bearer ".$access_token,
    "Cache-Control: no-cache",

  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {

   $res=json_decode($response);
  }
//echo "<pre>";
  //print_r($res);
?>

<section class="google-demo">
    <div class="container">
      <div class="inner-review">
        <div class="full-row">
          <ul>
          <li><img src="/img/icon.png"></li>
          <li><img src="/img/logo_google.png"></li>
          <li><?php echo @$mu_business;  ?></li>
        </div>
        <div class="inner-tabview">
          <div class="left-bar">

            <ul class="nav nav-tabs" id="myTab" role="tablist">


            <li class="nav-item">
              <a class="nav-link" active id="manage-tab" data-toggle="tab" href="#manage" role="tab" aria-controls="manage-tab" aria-selected="false"><i class="fa fa-user" aria-hidden="true"></i><?php echo @$Manage_locations;  ?></a>
            </li>

          </ul>
        </div>
        <div class="right-bar">
          <div class="tab-content" id="myTabContent">
           
            

            <div class="tab-pane fade show active" id="manage" role="tabpanel" aria-labelledby="manage-tab">
              <div class="location-content">
                <div class="full-location">
                  <ul class="location-title">
                    <li><?php echo @$Location;   ?></li>
                  </ul>
                  <ul class="location-right">
                    <li><div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php echo @$All_locations;  ?> (<?php echo count($res->locations);  ?>)
                          </button>
                          <!--div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Published (6)</a>
                            <a class="dropdown-item" href="#">Demo</a>
                            <a class="dropdown-item" href="#">Demo</a>
                          </div-->
                        </div>
                     </li>

                  </ul>
                </div>
                <div class="location-loop">
                  <ul>
                    <li class="text-center">
                      <div class="form-check">
                        <label>
                          <input type="checkbox" name="check"> <span class="label-text"></span>
                        </label>
                      </div>
                    </li>
                    <li class="name-list">
                      <a href="#"><?php echo @$loc_name;   ?><i class="fa fa-long-arrow-up" data-unicode="f176"></i></a>
                    </li>
                    <li><?php echo @$loc_Status;   ?></li>
                     <li></li>
                  </ul>
                </div>
				 <?php
foreach($res->locations as $res1){ ?>

                 <div class="location-loop">
                  <ul>
                    <li class="text-center">
                      <div class="form-check">
                        <label>
                          <input type="checkbox" name="check"> <span class="label-text"></span>
                        </label>
                      </div>
                    </li>
                    <li class="name-list">
                      <a  onclick="get_detail('<?php echo $res1->name;   ?>')" href="javascript:void(0)"><h6><?php echo $res1->locationName;   ?></h6>
                        <p><?php echo $res1->address->addressLines['0'];   ?></br>
						<?php echo $res1->address->postalCode;   ?>,<?php echo $res1->address->locality;   ?> <?php echo $res1->address->country;   ?> </p>
                      </a>
                    </li>
                     <li><?php if($res1->locationState->isPublished=="1"){  echo @$Published ;   }?></li>
                  </ul>
                </div>
<?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </div>
  </section>




  <style>
a:hover{
  text-decoration: none;
}
  .inner-review {
  border: 1px solid #454545;
  padding: 50px 0 20px 0;
  border-radius:20px !important;
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
.slide-left-bar {
  display: none;
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
  padding: 0 55px 0 75px;
}
.review-user li h5 {
  font-size: 18px;
  margin-bottom: 0;
  margin-top: 6px;
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
  padding-top: 7px;
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
</style>
