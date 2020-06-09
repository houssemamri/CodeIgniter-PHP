
    <?php
    $sql="SELECT * FROM UserTable WHERE UID<>1";
    $result=$conn->query($sql);
    if($result->num_rows==0){
    ?>
      <div id="none" style="color:#fff; font-size:40px;">
        No Users found.
      </div>
    <?php }
    else{?>
      <div class="supportPost">
        <hr />
      <?php while($row=$result->fetch_assoc())
      {
          if($row['DeleteStatus']==0)
           {
          ?>
            <div class="supportDetails">
                <?php echo $row['Name'];?>
            </div>
            <div class="supportPost">
                  <?php echo $row['Company'] . "<br />" . $row['Position'] . "<br />" . $row['Company'] . "<br />" . $row['Email']; ?>
                  <button type="button" onclick="userDelete('<?php echo $row['UID'];?>');" class="btn btn-primary pull-right"><?php echo $deleteUser;?></button>
            </div>
          <hr />
    <?php
          }
      }
    ?>
    </div>
    <?php } ?>
