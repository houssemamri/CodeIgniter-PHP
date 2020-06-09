<?php
  include('connection.php');
  $sql="SELECT * FROM userprefer WHERE UID=" . $_GET['id'];
  $result=$conn->query($sql);
  if($result->num_rows>0)
    $row=$result->fetch_assoc();?>
  <div class="row">
      <h6 style="font-weight:bold;font-size:32px;"><?php echo $editLinks;?>:</h6>
      <div class="col-lg-12 text-right">
            <input type="text" id="UID" value="<?php echo $_GET['id'];?>" hidden />
            <h6 class="text-left"><?php echo $ans1;?></h6>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 1</span>
                <input type="text" id="s1" class="urlBox" value="<?php echo $row['S1'];?>" />
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 2</span>
                <input type="text" id="s2" class="urlBox" value="<?php echo $row['S2'];?>" />
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 3</span>
                <input type="text" id="s3" class="urlBox" value="<?php echo $row['S3'];?>" />
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 4</span>
                <input type="text" id="s4" class="urlBox" value="<?php echo $row['S4'];?>" />
            </div><br />
            <button type="button" class="btn btn-lg btn-primary" onClick="updatePreference(1);" style="display:table;margin:0 auto;"><?php echo $savePrefer;?></button><br />
            <h6 class="text-left"><?php echo $ans2;?></h6>
             <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 1</span>
                <input type="text" id="s5" class="urlBox" value="<?php echo $row['S5'];?>"/>
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 2</span>
                <input type="text" id="s6" class="urlBox" value="<?php echo $row['S6'];?>"/>
           </div>
           <div class="urlSites">
                 <span class="urlNames"><?php echo $Situation;?> 3</span>
                 <input type="text" id="s7" class="urlBox" value="<?php echo $row['S7'];?>"/>
            </div>
            <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 4</span>
                <input type="text" id="s8" class="urlBox" value="<?php echo $row['S8'];?>"/>
           </div><br />
           <button type="button" class="btn btn-lg btn-primary" onClick="updatePreference(2);" style="display:table;margin:0 auto;"><?php echo $savePrefer;?></button><br />
           <h6 class="text-left"><?php echo $ans3;?></h6>
           <div class="urlSites">
               <span class="urlNames"><?php echo $Situation;?> 1</span>
               <input type="text" id="s9" class="urlBox" value="<?php echo $row['S9'];?>"/>
          </div>
          <div class="urlSites">
              <span class="urlNames"><?php echo $Situation;?> 2</span>
              <input type="text" id="s10" class="urlBox" value="<?php echo $row['S10'];?>"/>
         </div>
          <div class="urlSites">
               <span class="urlNames"><?php echo $Situation;?> 3</span>
               <input type="text" id="s11" class="urlBox" value="<?php echo $row['S11'];?>"/>
          </div>
          <div class="urlSites">
                <span class="urlNames"><?php echo $Situation;?> 4</span>
                <input type="text" id="s12" class="urlBox" value="<?php echo $row['S12'];?>"/>
           </div><br />
           <button type="button" class="btn btn-lg btn-primary" onClick="updatePreference(3);" style="display:table;margin:0 auto;"><?php echo $savePrefer;?></button><br />
      </div>
  </div>
  <br /><br /><br />
  <?php
  $sql="SELECT * FROM usertable WHERE UID=" . $_GET['id'];
  $result=$conn->query($sql);
  $row=$result->fetch_assoc(); ?>
  <div class="row">
      <h6 style="font-weight:bold;"><?php echo $editSMTP;?>:</h6>
      <div class="col-lg-12 text-right">
        <div class="urlSites">
            <span class="urlNames"><?php echo $smtpHost;?></span>
            <input type="text" id="SMTP" class="urlBox" value="<?php echo $row['SMTP'];?>" />
        </div>
        <div class="urlSites">
            <span class="urlNames"><?php echo $userName;?></span>
            <input type="text" id="SMTPuser" class="urlBox" value="<?php echo $row['SMTPuser'];?>" />
        </div>
        <div class="urlSites">
            <span class="urlNames"><?php echo $pwd;?></span>
            <input type="text" id="SMTPpwd" class="urlBox" value="<?php echo $row['SMTPpwd'];?>" />
        </div>
      </div>
  </div>
  <br /><br />
  <button type="button" class="btn btn-lg btn-primary" onClick="updateTable(2);" style="display:table;margin:0 auto;"><?php echo $saveSMTP;?></button>
