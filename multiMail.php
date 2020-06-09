
<?php
include('connection.php');
$sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$sql="SELECT SMTP,SMTPuser,SMTPpwd FROM UserTable WHERE UID=" . $_GET['id'];
$result1=$conn->query($sql);
$row1=$result1->fetch_assoc();
if($row1['SMTP']=="" && $row1['SMTPuser']=="" && $row1['SMTPpwd']=="")
{
  $status="disabled";
}
else
{
  $status="";
}?>
<h6 class="text-center" style="font-weight:bold;">Send Mail:</h6>
<small style="font-weight:bold;display:table;margin:0 auto"><?php echo $SMTPmsg;?></small><br /><br />
<form method="POST" enctype="multipart/form-data" action="sendMultiMail.php">
<?php
  $sql="SELECT * FROM EmailListMain WHERE UID=" . $_GET['id'];
  $result=$conn->query($sql);
  if($result->num_rows==0)
  {
 ?>
    <div class="urlSites text-right">
      <span class="urlNames"><?php echo $emailList;?>:</span>
      <select disabled>
        <option>No List Present</option>
      </select>
    </div>
  <?php
  }
  else
  {
    ?>
     <div class="urlSites text-right">
       <span class="urlNames"><?php echo $emailList;?>:</span>
       <select class="urlBox" name="listEmail">
      <?php
      while($row=$result->fetch_assoc())
      {
      ?>
        <option value="<?php echo $row['LID'];?>"><?php echo $row['ListName'];?></option>
    <?php
      }
      ?>
        </select>
      </div>
    <?php
  }?>
  <div class="urlSites text-right">
      <span class="urlNames">Email</span>
      <input type="text" name="Email" id="Email" class="urlBox" value="<?php echo $row['Email'];?>" required <?php echo $status;?>/>
  </div>
  <div class="urlSites text-right">
      <span class="urlNames"><?php echo $subject;?></span>
      <input type="text" name="subject" id="subject" class="urlBox" value="" required <?php echo $status;?>/>
  </div>
  <div class="urlSites text-right">
      <span class="urlNames"><?php echo $yourMessage;?></span>
      <textarea id="message" name="message" class="textBox" value="" required <?php echo $status;?>></textarea>
  </div>
  <br /><br /><br /><br /><br /><br /><br />
  <div class="urlSites text-center" id="upload">
    <label class="custom-file">
      <input type="file" name="uploadedimage" id="uploadedimage" class="custom-file-input">
      <span class="custom-file-control"></span>
    </label>
    <label id="test1"></label>
  </div>
  <br /><br />
  <button type="submit" class="btn btn-primary" style="display:table;margin:0 auto;"><?php echo $sendEmail;?></button>
</form>
