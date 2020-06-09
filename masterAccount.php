<div class="container">
    			<div class="row">

                  <div class="col-lg-12" style="text-align: initial">
                      <span id="profileName" >
                      <?php
                      include('connection.php');
                      $sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
                      $result=$conn->query($sql);
                      $rowname=$result->fetch_assoc();?>
                      <?php echo $welcomemanageacc;?> <span>
                     <span> <?php
                      echo $rowname['Name'];?> </span>!</span>
                      <br />
                      <span style="font-size: 20px;"><?php echo $welcomemanageaccmsg;?></span> 
                      </span>
                  </div>
                  </div>
                  </div>
             
                  <br /><br />
            
      <?php
      $sql="SELECT * FROM Master WHERE MasterID=" . $_SESSION['master_id'];
      
      $result=$conn->query($sql);
      //print_r($result);die("result");
     
      $count=0;
       ?>
      <section class="section bg-gray">
      <div class="container">
        <div class="row gap-y">
          <?php
            if($result->num_rows>0)
            {
              while($row=$result->fetch_assoc())
              {
               
               
                $sql="SELECT * FROM userImage WHERE UID=" . $row['SubID'];
                $result1=$conn->query($sql);
                $row1=$result1->fetch_assoc();
               	$total_account = $row['total_ac'];
               	// print_r($row1);
                ?>
                
                 <div class="col-12 col-md-3 col-lg-3">
                   <div class="card card-hover-shadow">
                     <div class="card-block text-center <?php if($row['SubID']==$_GET['id']){?> active <?php }?>">
                        <a href="changeUser.php?id=<?php echo $row['SubID'];?>"><img src="<?php echo $row1['imagePath'];?>" height="200" width="175"/></a>
                          <?php
                             if($count>0 && $row['SubID']!=$_GET['id'])
                             {?>
                               <span class="pull-right" onclick="deleteCompany('<?php echo $row['SubID'];?>');"><i class="fa fa-times"></i></span>
                             <?php
                             }
                          ?>
                     </div>
                   </div>
                 </div>
              <?php
                $count++;
              }
            } 
           

    	            if($result->num_rows < $total_account)
            {
           ?>
                <div class="col-12 col-md-3 col-lg-3">
                  <div class="card card-hover-shadow">
                    <div class="card-block text-center">
                        <a data-toggle="modal" data-target="#exampleModal"><i class="fa fa-4x fa-plus"></i></a>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $addNewCompany;?></h5>
                        <button type="button" class="close" onClick="location.reload();" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body text-center" style="color:#000 !important;">
                          <label for="company"><?php echo $company;?>: </label> <input type="text" name="company" id="company" value=""/>
                          <br /><br />
                          <div id="success-add" style="font-weight:bold;display:none;"><?php echo $successAdd;?></div>
                          <br /><br />
                          <button type="button" class="btn btn-primary" onclick="addCompany();"><?php echo $addbtn;?></button>
                          <br /><br />
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onClick="location.reload();" data-dismiss="modal"><?php echo $clsbtn;?></button>
                      </div>
                    </div>
                  </div>
                </div>
            <?php
              }
             
              else{ ?>
              
              <div class="col-12 col-md-3 col-lg-3">
                  <div class="card card-hover-shadow">
                    <div class="card-block text-center">
                        <a data-toggle="modal" data-target="#contactModal"><i class="fa fa-4x fa-plus"></i></a>
                    </div>
                  </div>
                </div>
               <!-- Modal -->
                <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <!--<div class="modal-header">
                        <h5 class="modal-title" id="contactModalLabel">Maximum Amount Reached</h5>
                        <button type="button" class="close" onClick="location.reload();" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>-->
                      <button type="button" class="close"  onClick="location.reload();" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true" style="float: right">&times;</span>
                        </button>
                      <div class="modal-body text-center" style="color:#000 !important;">
                          <p>You Have Reached The Maximum Number Of User Contact Us If You Want To Add More User</p>
                          <a class="btn btn-primary" href="https://review-thunder.com/contact.php">Contact Us</a>
                      </div>
               <!--       <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onClick="location.reload();" data-dismiss="modal"><?php echo $clsbtn;?></button>-->
                      </div>
                    </div>
                  </div>
                </div>
              
<?php } 


 ?>
        </div>

</section>




    <script>
        $(document).on('show.bs.modal', '.modal', function (event) {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });
        function addCompany()
        {
          var c=$('#company').val();
            alert("hi");

            jQuery.ajax({
            type: "POST",
            url: "addMaster.php",
            data: {company:c},
            success: function(response){
                alert("hi");
              $('#company').val('');
              $('#success-add').css('display','block');
            }
          });
        }
        function deleteCompany(e)
        {
          var r=confirm("Do you really want to delete your company?");
          if(r==true)
          {
              jQuery.ajax({
                type: "POST",
                url: "deleteMaster.php",
                data: {company:e},
                success: function(response){
                  alert("Successfully deleted company!");
                  location.reload();
                }
              });
          }
        }
    </script>

  </body>
</html>
