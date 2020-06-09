<?php
include('connection.php');
$sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
$result=$conn->query($sql);
$row=$result->fetch_assoc();?>
<style>
    .avatar-article3{
        position: relative;
        left: -230px;
        top: 137px;
    }
    .bubble-article3 > span{
        position: absolute;
        top: -180px;
        left: 150px;
        width: 100px;
        font-size: 0.75rem;
        max-height: 160px;
        font-weight: 900;
        line-height: 1.5;
    }
    .bubble-article3 > img{
        position: absolute;
        top: -240px;
        left: 85px;
        max-width: 210px;
        max-height: 200px;
        width: 210px;
        height: 200px;
    }

    .avatar-article-img3{
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
<div class="avatar-article avatar-article3 col-md-1">
    <div class="bubble-article3">
        <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
        <span><?=$avatarTextProfile?></span>
    </div>
    <img class="avatar-article-img3" src="avatar/img/avatar/<?=$row['avatar']?>.png">
</div>
<div class="row">
    <h6  class="center-text" style="font-weight:bold;font-size:32px;"><?php echo $editProfile;?></h6>
    <div class="col-lg-8 " style="text-align: left">
      <input type="text" id="UID" value="<?php echo $_GET['id'];?>" hidden />
      <div class="urlSites">
          <span class="urlNames"><?php echo $registerName;?></span>
          <input type="text" id="Name" class="urlBox" value="<?php echo $row['Name'];?>" />
      </div>
      <div class="urlSites">
          <span class="urlNames"><?php echo $registerCompany;?></span>
          <input type="text" id="Company" class="urlBox" value="<?php echo $row['Company'];?>" />
      </div>
      <div class="urlSites">
          <span class="urlNames"><?php echo $registerPosition;?></span>
          <input type="text" id="Position" class="urlBox" value="<?php echo $row['Position'];?>" />
      </div>
      <div class="urlSites">
          <span class="urlNames"><?php echo $registerEmail;?></span>
          <input type="text" id="Email" class="urlBox" value="<?php echo $row['Email'];?>" />
      </div>
      <div class="urlSites">
          <span class="urlNames"><?php echo $registerContact;?></span>
          <input type="text" id="Contact" class="urlBox" value="<?php echo $row['Contact'];?>" />
      </div>
      <br /><br />
<button type="button" class="btn btn-lg btn-primary" onClick="updateUser();" style="display:table;margin:0 auto;"><?php echo $updateDetail;?></button>
<br /><br />
    </div>
	<div class="col-lg-3"></div>
</div>

<div class="row">
<div class="col-lg-8">
  <h6 style="font-weight:bold;"><?php echo $uploadPic;?></h6><br />
  <form class="form" enctype="multipart/form-data" method="POST" action="addPicture.php">
    <input type="text" id="UID" name="UID" value="<?php echo $_SESSION['user_id'];?>" hidden />
    <div class="form-group" id="upload">
      <label class="custom-file">
        <input type="file" name="uploadedimage" id="uploadedimage" class="" required>
        <span class=""></span>
      </label>
      <label id="test1"></label>
    </div><br/><br />
    <button type="submit" class="btn btn-primary"><?php echo $uploadBtn;?></button>
  </form>
  </div>
  <div class="col-lg-4"></div>
  </div>
  <br /><br /><br />
  <div class="row">
  <div class="col-lg-8">
  <input type="text" id="UID" value="<?php echo $_SESSION['user_id'];?>" hidden />
  <div class="urlSites">
    <span class="urlNames" style="padding-right: 18px "><?php echo $newPwd;?></span>
    <input type="password"  class="passwordBox" id="pwd" />
 </div>
 <div class="urlSites">
    <span class="urlNames">Confirm Password</span>
    <input type="password" onkeyup="comparePassword()" class="passwordBox" id="conpwd" />
 </div>
  <br /><br />
  <button type="button" class="btn btn-primary" onClick="changePassword();" style="display:table;margin:0 auto;"><?php echo $changePwd;?></button>
  </div>
  </div>
  <div class="col-lg-4"></div>
  <br /><br /><br />
