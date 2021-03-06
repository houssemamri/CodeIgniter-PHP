<!-- Topbar -->
<?php
include('connection.php');
include('setLanguage.php');
?>
<nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
  <div class="container">
    <div class="topbar-left">
      <button class="topbar-toggler">&#9776;</button>
      <a class="topbar-brand" href="./">
        <img class="logo-default" src="img/logo.png" alt="logo">
        <img class="logo-inverse" src="img/logo-light.png" alt="logo">
      </a>
    </div>
    <div class="topbar-right">
      <ul class="topbar-nav nav">
        <li class="nav-item"><a class="nav-link" href="./"><?php echo $home;?></a></li>
          <li class="nav-item"><a class="nav-link" href="blog">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="article.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $article;?></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><?php echo $database;?><i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
            <a class="nav-link" href="upload.php"><?php echo $add;?></a>
            <a class="nav-link" href="update.php"><?php echo $update;?></a>
          </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="support.php"><?php echo $support;?></a></li>
        <?php
            if(isset($_SESSION['admin_status'])){?>
             <li class="nav-item"><a class="nav-link" href="adminProfile.php">Admin Panel</a></li>
          <?php
            }
         ?>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <?php
            $sql="SELECT * FROM imageuser WHERE UID=" . $_SESSION['user_id'];
            $result=$conn->query($sql);
			//print_r($conn);
            $row=$result->fetch_assoc();?>
              <img src="<?php echo $row['imagePath'];?>" alt="" height="30" width="30" />
            <?php
            echo $_SESSION['user_name'];?> <i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
            <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $account;?></a>
            <a class="nav-link" href="masterAcc.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $manageAcc;?></a>
            <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user_id'];?>&type=1"><?php echo $manageEmailList;?></a>
            <a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user_id'];?>&type=2"><?php echo $sendEmails;?></a>
            <a class="nav-link" href="/review/logout"><?php echo $logout;?></a>
          </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Languages <i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
              <a class="nav-link" href="language.php?lang=fr"><img class="language" src="img/french.png" /> Français</a>
              <a class="nav-link" href="language.php?lang=en"><img class="language" src="img/english.png" /> English</a>
              <a class="nav-link" href="language.php?lang=spa"><img class="language" src="img/spanish.png" /> Espanol</a>
          </div>
        </li>
      </ul>
    </div>

  </div>
</nav>
<!-- END Topbar -->
