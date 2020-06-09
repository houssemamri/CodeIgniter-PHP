<!-- Topbar -->
<?php
include('connection.php');
include('setLanguage.php');
?>
<nav class="topbar topbar-inverse topbar-expand-md topbar-sticky">
  <div class="container-fluid">

    <div class="topbar-left">
      <button class="topbar-toggler">&#9776;</button>
      <a class="topbar-brand" href="./">
        <img class="logo-default" src="https://review-thunder.com/img/logo.png" alt="logo">
        <img class="logo-inverse" src="https://review-thunder.com/img/logo-light.png" alt="logo">
      </a>
    </div>


    <div class="topbar-right">
      <ul class="topbar-nav nav">
        <li class="nav-item"><a class="nav-link" href="<?php base_url2(); ?>"><?php echo $home;?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php base_url2(); ?>article.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $article;?></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><?php echo $database;?><i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
            <a class="nav-link" href="<?php base_url2(); ?>upload.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $add;?></a>
            <a class="nav-link" href="<?php base_url2(); ?>update.php?status=true&type=Hotel&lang=fr&article=1"><?php echo $update;?></a>
          </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="<?php base_url2(); ?>blog?id=<?php echo $_SESSION['user_id'];?>&lang=<?php echo $_SESSION['language'];?>">Blog</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php base_url2(); ?>support.php"><?php echo $support;?></a></li>
        <li class="nav-item"><a class="nav-link" href="<?php base_url2(); ?>priceing/index">Pricing</a></li>
        <?php
            if(isset($_SESSION['admin_status'])){?>
             <li class="nav-item"><a class="nav-link" href="<?php base_url2(); ?>adminProfile.php">Admin Panel</a></li>
          <?php
            }
         ?>


        <li class="nav-item">
          <a class="nav-link" href="#">
            <?php
            $sql="SELECT * FROM imageUser WHERE UID=" . $_SESSION['user_id'];
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();?>
              <img src="<?php base_url2(); ?><?php echo $row['imagePath'];?>" alt="" height="30" width="30" />
            <?php
            echo $_SESSION['user_name'];?> <i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
            <a class="nav-link" href="<?php base_url2(); ?>profile.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $account;?></a>
            <a class="nav-link" href="<?php base_url2(); ?>profile.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $manageAcc;?></a>
           <!-- <a class="nav-link" href="masterAcc.php?id=<?php echo $_SESSION['user_id'];?>"><?php echo $manageAcc;?></a>-->
            <a class="nav-link" href="<?php base_url2(); ?>manageVideos.php?id=<?php echo $_SESSION['user_id'];?>">Manage Videos</a>
            <a class="nav-link" href="<?php base_url2(); ?>profile.php?id=<?php echo $_SESSION['user_id'];?>&type=1"><?php echo $manageEmailList;?></a>
            <!--<a class="nav-link" href="profile.php?id=<?php echo $_SESSION['user_id'];?>&type=2"><?php echo $sendEmails;?></a>-->
            <a class="nav-link" href="<?php base_url2(); ?>newsletter/admin/pg.login_external.php?logout=1"><?php echo $logout;?></a>
          </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="#"><?php echo $changelang;?> <i class="fa fa-caret-down"></i></a>
          <div class="nav-submenu align-right">
              <a class="nav-link" href="<?php base_url2(); ?>language.php?lang=fr"><img class="language" src="<?php base_url2(); ?>img/french.png" /><?php echo $lang1;?></a>
              <a class="nav-link" href="<?php base_url2(); ?>language.php?lang=en"><img class="language" src="https://review-thunder.com/img/english.png" /> <?php echo $lang2;?></a>
              <a class="nav-link" href="<?php base_url2(); ?>language.php?lang=spa"><img class="language" src="https://review-thunder.com/img/spanish.png" /> <?php echo $lang3;?></a>
          </div>
        </li>
      </ul>
    </div>

  </div>
</nav>
<!-- END Topbar -->
