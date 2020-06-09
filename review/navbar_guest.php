<!-- Topbar -->
<?php

include('connection.php');
include('setLanguage.php');
if(strcmp($lang,'en')==0){
  $contactHeader = "Contact";
  $home = "Home";
  $login = "Login";
}
else if(strcmp($lang,'spa')==0){
  $contactHeader = "Contacto";
  $home = "Inicio";
  $login = "Conectarse";
}
else{
  $contactHeader = "Contact";
  $home = "Accueil";
  $login = "CONNEXION";

}
?>
<nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
  <div class="container">

    <div class="topbar-left">
      <button class="topbar-toggler">&#9776;</button>
      <a class="topbar-brand" href="./">
        <img class="logo-default" src="http://localhost/iframe_social/img/logo.png" alt="logo">
        <img class="logo-inverse" src="http://localhost/iframe_social/img/logo-light.png" alt="logo">
      </a>
    </div>


    <div class="topbar-right">
      <ul class="topbar-nav nav">
        <li class="nav-item"><a class="nav-link" href="./"><?php echo $home;?></a></li>
        <li class="nav-item"><a class="nav-link" href="scheduledemo.php">Demo</a></li>
        <li class="nav-item"><a class="nav-link" href="blog">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.php"><?php echo $contact;?></a></li>

        <li class="nav-item"><a class="nav-link" href="#">Languages <i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
              <a class="nav-link" href="language.php?lang=fr"><img class="language" src="img/french.png" /> Français</a>
              <a class="nav-link" href="language.php?lang=en"><img class="language" src="img/english.png" /> English</a>
              <a class="nav-link" href="language.php?lang=spa"><img class="language" src="img/spanish.png" /> Espanol</a>
          </div>
        </li>
		<a class="btn btn-xs btn-round btn-success" href="/review/auth/index" style="margin-left:10px;"><?php echo $login;?></a>
      </ul>
      <!--a class="btn btn-xs btn-round btn-success" href="login.php" style="margin-left:10px;"><?php echo $login;?></a-->
      

    </div>

  </div>
</nav>
<!-- END Topbar -->
