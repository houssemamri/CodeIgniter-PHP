
    <?php
        include('connection.php');
        $sql="SELECT * FROM Support ORDER BY Status Desc";
        $result=$conn->query($sql);
        if($result->num_rows==0){
        ?>
          <div id="none" style="color:#fff; font-size:40px;">
            No messages.
          </div>
        <?php }
        else{?>
          <div class="supportPost">
            <hr />
          <?php while($row=$result->fetch_assoc())
          {
              if($row['Status']==0)
               {
              ?>
                  <span class="unread pull-right"><?php echo $unread;?></span>
              <?php
               } ?>
                <div class="supportDetails">
                    <?php echo $row['Name'] . "<br />" . $row['Email'];?>
                </div><br /><br />
                <div class="supportMessage">
                    <?php echo $row['Message'];
                    if($row['Status']==0)
                     {
                    ?>
                      <button type="button" onclick="markRead('<?php echo $row['SID'];?>');" class="btn btn-primary pull-right"><?php echo $mark;?></button>
                    <?php
                    } ?>
                </div>
              <hr />
        <?php  }
        ?>
        </div>
        <?php } ?>
