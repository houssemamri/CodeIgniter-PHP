<?php
session_start();
if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . 'login.php');
}
else if($_GET['id']!=$_SESSION['user_id'])
{
  header('Location: ' . 'masterAcc.php?id=' . $_SESSION['user_id']);
}
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Thunder Review - User Home</title>

    <!-- Styles -->
    <link href="css/core.min.css" rel="stylesheet">
    <link href="css/thesaas.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">
    <link href="css/select2-bootstrap.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <link rel="icon" href="img/favicon.png">
    <style>
      .card
      {
        height:200px !important;
        background-color: transparent !important

      }
      .active
      {
        height:200px !important;
        background-color: transparent !important
      }
      .fa
      {
        cursor: pointer;
      }
    </style>
  </head>

  <body>

    <?php include('navbar.php');?>
    <!-- Header -->
    <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)">
      <div class="container text-center">

        <div class="row">
          <div class="col-12 col-lg-8 offset-lg-2">

            <h1><?php echo $_SESSION['user_name'];?> - <?php echo $profile;?></h1>
            <p class="fs-18 opacity-100" id="subHeader"><?php echo $profileWelcome;?>.</p>

          </div>
        </div>

      </div>
    </header>
    <!-- END Header -->




    <!-- Main container -->
    <main class="main-content">
      <?php
      $sql="SELECT * FROM Master WHERE MasterID=" . $_SESSION['master_id'];
      $result=$conn->query($sql);
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
                $row1=$result1->fetch_assoc();?>
                 <div class="col-12 col-md-3 col-lg-3">
                   <div class="card card-hover-shadow">
                     <div class="card-block text-center <?php if($row['SubID']==$_GET['id']){?> active <?php }?>">
                        <a href="changeUser.php?id=<?php echo $row['SubID'];?>"><img src="<?php echo $row1['imagePath'];?>" height="150" width="125"/></a>
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
            if($result->num_rows!=50)
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
              } ?>

        </div>



      </div>
    </section>

    </main>
    <!-- END Main container -->


    <?php include('footer.php');?>



    <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


    <!-- Scripts -->
    <script src="js/core.min.js"></script>
    <script src="js/thesaas.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/select2.min.js"></script>
    <script>
        function addCompany()
        {
          var c=$('#company').val();
          jQuery.ajax({
            type: "POST",
            url: "addMaster.php",
            data: {company:c},
            success: function(response){
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
