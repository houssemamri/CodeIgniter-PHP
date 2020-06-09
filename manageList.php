<style type="text/css">
	.modal-conten {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 100%;
    text-align: left;
}
	.modal-footer{
	border-top: none !important;
}
</style>

<div class="row">
  <h6 class="center-text" style="font-weight:bold;font-size:32px;"><?php echo $manageEmailList;?></h6>
  <div class="col-lg-12">

    <div class="table-responsive">

            <table id="mytable" class="table table-bordred table-striped">

                 <thead>
                   <th><?php echo $listname;?></th>
                   <th>Emails</th>
                   <th><?php echo $deleteOpt;?></th>
                 </thead>
                  <tbody>
                    <?php
                      $sql="SELECT * FROM EmailListMain WHERE UID=" . $_SESSION['user_id'];
                      $result=$conn->query($sql);
                      if($result->num_rows==0)
                      {
                    ?>
                        <tr>
                          <td>No List Present</td>
                        </tr>
                    <?php
                      }
                      else
                      {
                        while($row=$result->fetch_assoc())
                        {
                        ?>
                          <tr>
                            <td class="text-left"><?php echo $row['ListName'];?></td>
                            <?php
                              $sql1="SELECT * FROM EmailListing WHERE UID=" . $_SESSION['user_id'] . " AND LID=" . $row['LID'];
                              $result1=$conn->query($sql1);
                            ?>
                            <td class="text-left"><a style="cursor:pointer;color:#2663bd;" data-toggle="modal" data-target="#showList<?php echo $row['LID'];?>"><?php echo $result1->num_rows;?></a></td>
                            <td><p data-placement="top" title="Delete"><button class="btn btn-danger btn-xs" onClick="deleteLists('<?php echo $row['LID'];?>');"><span class="fa fa-trash-o"></span></button></p></td>
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
                <div class="modal fade" id="showList<?php echo $row['LID'];?>" tabindex="-1" role="dialog" aria-labelledby="showList<?php echo $row['LID'];?>" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-conten">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['ListName'];?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <!--<ul style="list-style: none;">-->
                        <select name="" id="emailLists" onchange="changeEmails(this.value)" class="form-control">                     
	                        <?php
                            $sql1="SELECT * FROM EmailListing WHERE UID=" . $_SESSION['user_id'] . " AND LID=" . $row['LID'];
                            $result1=$conn->query($sql1);
                            while($row1=$result1->fetch_assoc())
                            {?>
                            	<option value="<?php echo $row1['Email'];?>"><?php echo $row1['Email'];?></option>
                                <!--<li><?php echo $row1['Email'];?></li>-->
                            <?php
                            }
                        ?>
                        </select>
                        <!--</ul>-->
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $clsbtn;?></button>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              } ?>

          </div>
  </div>
</div>
<script>
	function changeEmails(x){
		/*alert(x);*/
	}
</script>