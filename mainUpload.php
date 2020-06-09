<style>
    .avatar-article{
        position: relative;
    }
    .bubble-article > span{
        position: absolute;
        top: -180px;
        left: 150px;
        width: 100px;
        font-size: 0.75rem;
        max-height: 160px;
        font-weight: 900;
        line-height: 1.5;
    }
    .bubble-article > img{
        position: absolute;
        top: -240px;
        left: 85px;
        max-width: 210px;
        max-height: 200px;
        width: 210px;
        height: 200px;
    }

    .avatar-article-img{
        position: absolute;
        top: -80px;
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
<div class="avatar-article col-md-1">
    <div class="bubble-article">
        <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
        <span><?=$avatarText?></span>
    </div>
    <img class="avatar-article-img" src="avatar/img/avatar/<?=$row['avatar']?>.png">
</div>



<style>
	.nav-outline .nav-link {
		border-left: 0 !important;
	}
</style>

<!-- Main container -->
<main class="main-content">

  <section class="section" id="section-vtab">
        <div class="container">
            <?php
              $lang=$_GET['lang'];
              if(strcmp($lang,"fr")==0)
              {
                $fr="active";
                $en="";
                $spa="";
              }
              else if(strcmp($lang,"en")==0)
              {
                $fr="";
                $en="active";
                $spa="";
              }
              else if(strcmp($lang,"spa")==0)
              {
                $fr="";
                $en="";
                $spa="active";
              }
              else
              {
                $fr="";
                $en="";
                $spa="";
              }
             ?>
<!-- CLASS TO HIDE ON SMALL SCREEN IS  hidden-sm-down-->
              <div class="text-center">
                <ul class="nav nav-outline nav-round">
                  <li class="nav-item w-140 ">
                    <a class="nav-link nav-user <?php echo $fr;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=fr&article=1">
                      <?php echo $lang1;?>
                    </a>
                  </li>
                  <li class="nav-item w-140">
                    <a class="nav-link nav-user <?php echo $en;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=en&article=1">
                      <?php echo $lang2;?>
                    </a>
                  </li>
                  <li class="nav-item w-140">
                    <a class="nav-link nav-user <?php echo $spa;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=spa&article=1">
                      <?php echo $lang3;?>
                    </a>
                  </li>
                </ul>
              </div>
              <br /><br /><br />
          <div class="row">
            <div class="col-12 col-md-12 align-self-center text-center">
                    <div class="row">
                       
                        <div class="col-12 col-lg-12">
                            <ul class="list-unstyled">
                                <?php
                                  $art=$_GET['article'];
                                  if($art==1)
                                  {
                                    $art1="btn-danger";
                                    $art2="btn-primary";
                                    $art3="btn-primary";
                                  }
                                  else if($art==2)
                                  {
                                    $art1="btn-primary";
                                    $art2="btn-danger";
                                    $art3="btn-primary";
                                  }
                                  else if($art==3)
                                  {
                                    $art1="btn-primary";
                                    $art2="btn-primary";
                                    $art3="btn-danger";
                                  }
                                  else
                                  {
                                    $art1="btn-primary";
                                    $art2="btn-primary";
                                    $art3="btn-primary";
                                  }
                                  if(isset($_GET['lang']))
                                  {
                                  ?>
                                <a class="btn btn-round <?php echo $art1;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=<?php echo $_GET['lang'];?>&article=1"><?php echo $ans1;?></a>
                                <a class="btn btn-round <?php echo $art2;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=<?php echo $_GET['lang'];?>&article=2"><?php echo $ans2;?></a>
                                <a class="btn btn-round <?php echo $art3;?>" href="?status=true&type=<?php echo $_GET['type'];?>&lang=<?php echo $_GET['lang'];?>&article=3"><?php echo $ans3;?></a>
                                <?php } ?>
                            </ul>
                         </div>
                    </div>
                    <br /><br />
                    <?php if(isset($_GET['article']))
                    {?>
                    <div class="row">
                          <div class="col-12 col-lg-12">
                              <ul class="list-unstyled">
                                  <a class="btn btn-round btn-info" id="Man" onclick="registerSex(1);"><?php echo $sex1;?></a>
                                  <a class="btn btn-round btn-outline btn-info" id="Woman" onclick="registerSex(2);"><?php echo $sex2;?></a>
                                  <a class="btn btn-round btn-outline btn-info" id="Unisex" onclick="registerSex(3);"><?php echo $sex3;?></a>
                              </ul>
                          </div>
                      </div>
                      <br /><br />
                      <div class="row">
                           <div class="col-12 col-lg-12">
                          <?php
                           if($_GET['article']==1)
                           {?>
                            <h2><?php echo $ans1;?></h2><br />
                            <ul class="list-unstyled">
                                <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $positive[0];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $positive[1];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part3"  onclick="activePartButton(3);"><?php echo $positive[2];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(4);"><?php echo $positive[3];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(5);"><?php echo $neg1;?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(6);"><?php echo $neg2;?></li>
                                <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $positive[4];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(7);"><?php echo $neg3;?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $neg4;?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $positive[5];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part10" onclick="activePartButton(10);"><?php echo $positive[6];?></li>
                                <li class="btn btn-xs btn-round btn-primary" id="part11" onclick="activePartButton(11);"><?php echo $positive[7];?></li>
                            </ul>
                            <?php
                            }
                            else if($_GET['article']==2)
                            {?>
                             <h2><?php echo $ans2;?></h2><br />
                             <ul class="list-unstyled">
                                   <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $negative[0];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $negative[1];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part3" onclick="activePartButton(3);"><?php echo $negative[2];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(5);"><?php echo $neg5;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(6);"><?php echo $neg6;?></li>
                                   <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $negative[5];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(7);"><?php echo $neg7;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(8);"><?php echo $neg8;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $negative[8];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $negative[9];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part10" onclick="activePartButton(10);"><?php echo $negative[10];?></li>
                             </ul>
                            <?php
                            }
                            else
                            {?>
                             <h2><?php echo $ans3;?></h2><br />
                             <ul class="list-unstyled">
                                   <li class="btn btn-xs btn-round btn-primary" id="part1" onclick="activePartButton(1);"><?php echo $simple[0];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part2" onclick="activePartButton(2);"><?php echo $simple[1];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part3" onclick="activePartButton(3);"><?php echo $simple[2];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part4" onclick="activePartButton(5);"><?php echo $neg9;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part5" onclick="activePartButton(6);"><?php echo $neg10;?></li>
                                   <li class="btn btn-xs btn-round btn-warning" id="user" onclick="activePartButton(15);"><?php echo $simple[3];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part6" onclick="activePartButton(7);"><?php echo $neg11;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part7" onclick="activePartButton(8);"><?php echo $neg12;?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part8" onclick="activePartButton(8);"><?php echo $simple[4];?></li>
                                   <li class="btn btn-xs btn-round btn-primary" id="part9" onclick="activePartButton(9);"><?php echo $simple[5];?></li>
                             </ul>

                            <?php
                            } ?>
                    </div>
                         <?php
                         }
                         ?>
                  </div>
                  <?php
                  if(isset($_GET['article']))
                  {?>
                    <br /><br />
                    <div class="row">
                    
<?php // FEEDBACK MASSAGE AGAINST FILE UPLOAD 
if(isset($_REQUEST[stat])){
	if($_REQUEST['stat'] == '1'){
	echo  "<div style='width:100%;text-align:center;' class='alert alert-success' id='contact-success'>Successfully saved<a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}else{
	echo "<div style='width:100%;text-align:center;' class='alert alert-danger' id='contact-success'>Something went wrong!<a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>";
}	
} 


//input field span class class="custom-file-control"
?>
                        <div class="col-12 col-lg-12">
                                 <form class="form" enctype="multipart/form-data" method="POST" action="addExcel.php">
                                   <input type="text" name="Language" value="<?php echo $_GET['lang'];?>" id="language" required hidden/>
                                   <input type="text" name="Article" value="<?php echo $_GET['article'];?>" id="Article" required hidden/>
                                   <input type="text" name="Type" value="<?php echo $_GET['type'];?>" id="type" required hidden/>
                                   <input type="text" name="gender" value="1" id="sex" hidden required />
                                   <input type="text" name="Part" value="" id="Part" required hidden/>
                                   <div class="form-group" id="upload">
                                     <label class="custom-file">
                                       <input type="file" name="filename" id="filename" class="" required>
                                 
                                     </label>
                                     <label id="test1"></label>
                                   </div><br/>
                                   <button type="submit" class="btn btn-primary"><?php echo $uploadBtn;?></button>
                                 </form>
                        </div>
                    </div>

                <?php  }
                   ?>
                </div>
            </div>
      </section>

   <input type="text" value="0" id="special" hidden/>




</main>
<!-- END Main container -->
