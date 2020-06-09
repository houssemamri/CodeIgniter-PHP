<div class="row">
  <h6 style="font-weight:bold;font-size:32px;"><?php echo $manageEmail;?></h6>
  <div class="col-lg-12">

    <div class="col-12 col-lg-4 pull-right">
              <div class="btn-group">
                <span class="dropdown-toggle btn btn-primary" data-toggle="dropdown"><?php echo $manage;?></span>
                <div class="dropdown-menu Manage">
                  <a class="dropdown-item" data-toggle="modal" data-target="#AddEmail"><?php echo $addEmail;?></a>
                  <a class="dropdown-item" data-toggle="modal" data-target="#AddList"><?php echo $addList;?></a>
                  <a class="dropdown-item" data-toggle="modal" data-target="#ManageList"><?php echo $addtoExist;?></a>
                </div>
              </div>
      </div>
      <br /><br /><br>

      <!-- Modal -->
      <div class="modal fade" id="AddEmail" tabindex="-1" role="dialog" aria-labelledby="AddEmail" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php echo $addEmail;?></h5>
              <button type="button" class="close"  data-dismiss="modal" onClick="location.href='http://www.review-thunder.com/profile.php?id=2&type=2';" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="email"><?php echo $registerEmail;?>: </label> <input type="text" name="newMail" id="newMail" value=""/><br /><br />
              <label for="first"><?php echo $fname;?>: </label> <input type="text" name="firstName" id="firstName" value=""/><br /><br />
              <label for="last"><?php echo $registerName;?>: </label> <input type="text" name="lastName" id="lastName" value=""/><br /><br />
              <label for="company"><?php echo $registerCompany;?>: </label> <input type="text" name="company" id="company" value=""/>
              <br /><br />
              <button type="button" class="btn btn-primary" onclick="addMail();"><?php echo $addbtn;?></button>
              <br /><br />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="location.href='http://www.review-thunder.com/profile.php?id=2&type=2';"><?php echo $clsbtn;?></button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="AddList" tabindex="-1" role="dialog" aria-labelledby="AddList" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php echo $addList;?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="listName"><?php echo $listname;?>: </label> <input type="text" name="listName" id="listName" value=""/>
              <br /><br />
              <button type="button" class="btn btn-primary" onclick="addList();"><?php echo $addList;?></button>
              <br /><br />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><?php echo $clsbtn;?></button>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="ManageList" tabindex="-1" role="dialog" aria-labelledby="ManageList" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php echo $addtoExist;?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <?php
              $sql="SELECT * FROM EmailListMain WHERE UID=" . $_SESSION['user_id'];
              $result=$conn->query($sql);
              if($result->num_rows==0)
              {
                ?>
                  <h6>No List Present</h6>
              <?php
              }
              else
              {?>
                <h5><?php echo $listPresent;?>-</h5>
                <?php
                  while($row=$result->fetch_assoc())
                {?>
                  <h6><a onclick="updateList('<?php echo $row['LID'];?>');" style="cursor:pointer;"><?php echo $row['ListName'];?></a></h6>
              <?php
                }
              } ?>
              <br /><br />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close"><?php echo $clsbtn;?></button>
            </div>
          </div>
        </div>
      </div>




    <div class="table-responsive">

            <table id="mytable" class="table table-bordred table-striped">

                 <thead>
                   <th></th>
                   <th>Email</th>
                   <th><?php echo $fname;?></th>
                   <th><?php echo $registerName;?></th>
                   <th><?php echo $registerCompany;?></th>
                   <th><?php echo $edit;?></th>
                   <th><?php echo $deleteOpt;?></th>
                 </thead>
                  <tbody>
                    <?php
                      $sql="SELECT * FROM emaillist WHERE UID=" . $_SESSION['user_id'];
                      $result=$conn->query($sql);
                      if($result->num_rows==0)
                      {
                    ?>
                        <tr>
                          <td>No Email Present</td>
                        </tr>
                    <?php
                      }
                      else
                      {
                        while($row=$result->fetch_assoc())
                        {
                        ?>
                          <tr>
                            <td><input type="checkbox" class="emaillist" value="<?php echo $row['EID'];?>" /></td>
                            <td class="text-left"><?php echo $row['Email'];?></td>
                            <td class="text-left"><?php echo $row['First'];?></td>
                            <td class="text-left"><?php echo $row['Last'];?></td>
                            <td class="text-left"><?php echo $row['Company'];?></td>
                            <td><p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changeEmail<?php echo $row['EID'];?>"><span class="fa fa-pencil"></span></button></p></td>
                            <td><p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" onclick="deleteEmail('<?php echo $row['EID'];?>');"><span class="fa fa-trash-o"></span></button></p></td>
                          </tr>

                      <?php
                        }
                      }
                      ?>
                  </tbody>

              </table>
              <?php
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc())
                {
               ?>
               <div class="modal fade" id="changeEmail<?php echo $row['EID'];?>" tabindex="-1" role="dialog" aria-labelledby="changeEmail<?php echo $row['EID'];?>" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $updateEmail;?></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <input type="text" hidden id="hiddenEid<?php echo $row['EID'];?>" value="<?php echo $row['EID'];?>" />
                       <label for="email"><?php echo $registerEmail;?>: </label> <input type="text" name="updateMail" id="updateMail<?php echo $row['EID'];?>" value="<?php echo $row['Email'];?>"/><br /><br />
                       <label for="first"><?php echo $fname;?>: </label> <input type="text" name="firstName" id="firstName<?php echo $row['EID'];?>" value="<?php echo $row['First'];?>"/><br /><br />
                       <label for="last"><?php echo $registerName;?>: </label> <input type="text" name="lastName" id="lastName<?php echo $row['EID'];?>" value="<?php echo $row['Last'];?>"/><br /><br />
                       <label for="company"><?php echo $registerCompany;?>: </label> <input type="text" name="company" id="company<?php echo $row['EID'];?>" value="<?php echo $row['Company'];?>"/>
                       <br /><br />
                       <button type="button" class="btn btn-primary" onclick="updateEmail('<?php echo $row['EID'];?>');"><?php echo $updateBtn;?></button>
                       <br /><br />
                     </div>
                     <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $clsbtn;?></button>
                     </div>
                   </div>
                 </div>
               </div>
               <?php
              }
              ?>
          </div>
          <br /><br /><br /><br />
          <h6 class="review-h6" style="font-weight:bold"><?php echo $uploadMultiEmail;?></h6>
          <form method="POST" enctype="multipart/form-data" action="excelMail.php">
            <div class="urlSites text-center" id="upload">
              <label class="custom-file">
                <input type="file" name="filename" id="filname" accept=".xls,.xlsx" class="custom-file-input" required>
                <span class="custom-file-control"></span>
              </label>
              <label id="test1"></label>
            </div>
            <br /><br /><br><br><br>
            <button type="submit" class="btn btn-primary" style="display:table;margin:0 auto;"><?php echo $uploadExcel;?></button>
          </form>
  </div>
</div>
