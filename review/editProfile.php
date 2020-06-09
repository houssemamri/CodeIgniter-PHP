<?php
include('connection.php');
$sql="SELECT * FROM usertable WHERE UID=" . $_GET['id'];
$result=$conn->query($sql);
$row=$result->fetch_assoc();?>
<div class="row">
    <h6 style="font-weight:bold;font-size:32px;"><?php echo $editProfile;?></h6>
    <div class="col-lg-12 text-right">
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
    </div>
</div>
<br /><br />
<button type="button" class="btn btn-lg btn-primary" onClick="updateUser();" style="display:table;margin:0 auto;">Update Details</button>
<br /><br />
  <h6 style="font-weight:bold;"><?php echo $uploadPic;?></h6><br />
  <form class="form" enctype="multipart/form-data" method="POST" action="addPicture.php">
    <input type="text" id="UID" name="UID" value="<?php echo $_SESSION['user_id'];?>" hidden />
    <div class="form-group" id="upload">
      <label class="custom-file">
        <input type="file" name="uploadedimage" id="uploadedimage" class="custom-file-input" required>
        <span class="custom-file-control"></span>
      </label>
      <label id="test1"></label>
    </div><br/><br /><br>
    <button type="submit" class="btn btn-primary"><?php echo $uploadBtn;?></button>
  </form>
  <br /><br /><br /><br>
  <input type="text" id="UID" value="<?php echo $_SESSION['user_id'];?>" hidden />
  <div class="urlSites">
    <span class="urlNames"><?php echo $newPwd;?></span>
    <input type="password" class="passwordBox" id="pwd" />
 </div>
  <br /><br /><br>
  <button type="button" class="btn btn-primary" onClick="changePassword();" style="display:table;margin:0 auto;"><?php echo $changePwd;?></button>
  <br /><br /><br />
