<div class="row">
  <h6 style="font-weight:bold;font-size:32px;"><?php echo $todoName;?></h6>
  <div class="col-lg-12">

    <div class="col-12 col-lg-4 pull-right">
              <div class="btn-group">
                <span class="dropdown-toggle btn btn-primary" data-toggle="dropdown"><?php echo $manage;?></span>
                <div class="dropdown-menu Manage">
                  <a class="dropdown-item" data-toggle="modal" data-target="#AddItem">Add Item</a>
                </div>
              </div>
      </div>
      <br /><br /><br>

      <!-- Modal -->
      <div class="modal fade" id="AddItem" tabindex="-1" role="dialog" aria-labelledby="AddEmail" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><?php echo $addItem;?></h5>
              <button type="button" class="close"  data-dismiss="modal" onClick="location.reload();" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <label for="item"><?php echo $item;?>: </label> <input type="text" name="item" id="todoitem" value=""/>
              <br /><br />
              <button type="button" class="btn btn-primary" onclick="addToDo();"><?php echo $addbtn;?></button>
              <br /><br />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="location.reload();"><?php echo $clsbtn;?></button>
            </div>
          </div>
        </div>
      </div>
    <div class="table-responsive">

            <table id="mytable1" class="table table-bordred table-striped">
                 <thead>
                   <th></th>
                   <th><?php echo $item;?></th>
                   <th><?php echo $edit;?></th>
                   <th><?php echo $deleteOpt;?></th>
                 </thead>
                  <tbody>
                    <?php
                      $sql="SELECT * FROM todolist WHERE UID=" . $_SESSION['user_id'] . " AND Done=0";
                      $result=$conn->query($sql);
                      if($result->num_rows==0)
                      {
                    ?>
                        <tr id="default">
                          <td><?php echo $noItemPresent;?></td>
                        </tr>
                    <?php
                      }
                      else
                      {
                        while($row=$result->fetch_assoc())
                        {
                        ?>
                          <tr id="Item<?php echo $row['TID'];?>">
                            <td><input type="checkbox" class="emaillist" value="<?php echo $row['TID'];?>" onchange="checkTodo('<?php echo $row['TID'];?>');"/></td>
                            <td class="text-left"><?php echo $row['Item'];?></td>
                            <td><p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changeItem<?php echo $row['TID'];?>"><span class="fa fa-pencil"></span></button></p></td>
                            <td><p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" onclick="deleteTodo('<?php echo $row['TID'];?>');"><span class="fa fa-trash-o"></span></button></p></td>
                          </tr>

                      <?php
                        }
                      }
                      ?>
                  </tbody>

              </table>
              <br /><br /><br />
              <h6 style="text-align:left;font-weight:bold;font-size:32px;"><?php echo $completedList;?></h6>
              <table id="mytable2" class="table table-bordred table-striped">

                   <thead>
                     <th></th>
                     <th><?php echo $item;?></th>
                     <th><?php echo $edit;?></th>
                     <th><?php echo $deleteOpt;?></th>
                   </thead>
                    <tbody>
                      <?php
                        $sql1="SELECT * FROM todolist WHERE UID=" . $_SESSION['user_id'] . " AND Done=1";
                        $result=$conn->query($sql1);
                        if($result->num_rows>0)
                        {
                          while($row=$result->fetch_assoc())
                          {
                          ?>
                            <tr id="addItem<?php echo $row['TID'];?>">
                              <td><input type="checkbox" class="emaillist" value="<?php echo $row['TID'];?>" onchange="uncheckTodo('<?php echo $row['TID'];?>');"/></td>
                              <td class="text-left"><?php echo $row['Item'];?></td>
                              <td><p data-placement="top" title="Edit"><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#changeItem<?php echo $row['TID'];?>"><span class="fa fa-pencil"></span></button></p></td>
                              <td><p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" onclick="deleteTodo('<?php echo $row['TID'];?>');"><span class="fa fa-trash-o"></span></button></p></td>
                            </tr>
                            </tr>

                        <?php
                          }
                        }
                        ?>
                    </tbody>

                </table>
              <?php
                $sql="SELECT * FROM todolist WHERE UID=" . $_SESSION['user_id'];
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc())
                {
               ?>
               <div class="modal fade" id="changeItem<?php echo $row['TID'];?>" tabindex="-1" role="dialog" aria-labelledby="changeItem<?php echo $row['TID'];?>" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $updateItem;?></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <input type="text" hidden id="hiddenTid<?php echo $row['TID'];?>" value="<?php echo $row['TID'];?>" />
                       <label for="item"><?php echo $item;?>: </label> <input type="text" name="item" id="updateItem<?php echo $row['TID'];?>" value="<?php echo $row['Item'];?>"/>
                       <br /><br />
                       <button type="button" class="btn btn-primary" onclick="updateTodo('<?php echo $row['TID'];?>');"><?php echo $updateBtn;?></button>
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
  </div>
</div>
