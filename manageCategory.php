<?php
session_start();
if(!isset($_SESSION['global_status']) || !isset($_GET['id'])){
  header('Location: ' . './');
}
else if($_GET['id']!=$_SESSION['user_id'])
{
  header('Location: ' . 'manageVideo.php?id=' . $_SESSION['user_id']);
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

  <title>Thunder Review - Manage Category</title>

  <!-- Styles -->
  <link href="css/core.min.css" rel="stylesheet">
  <link href="css/thesaas.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style>
    #error-text {
      text-align: center;
      font-size: 11px;
      color: red;
      display: none;
    }
  </style>

  <!-- Favicons -->
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
  <link rel="icon" href="img/favicon.png">

</head>

<body>

  <?php include('navbar.php');?>
  <!-- Header -->
  <header class="header header-inverse bg-fixed" style="background-image: url(img/bg-laptop.jpg)">
    <div class="container text-center">

      <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">

          <h1>
            <?php echo $_SESSION['user_name'];?> - Manage Categories</h1>
          <p class="fs-18 opacity-100" id="subHeader">Manage Categories</p>
        </div>
      </div>

    </div>
  </header>
  <!-- END Header -->




  <!-- Main container -->
  <main class="main-content">
    <section class="section bg-gray">
      <div class="container">
        <h3 class="text-center"><?php echo $manage_video_reviews_heading;?></h3>
        


        <section class="section bg-gray mt-30" id="section-htab">
          <div class="container">          
          <button class="pull-right btn btn-success btn-sm" id="add-category"><i class="fa fa-plus"></i></button>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th><?php echo $manage_video_reviews_category;?></th>
                <th><?php echo $manage_video_reviews_Action;?></th>
                <th><?php echo $manage_video_reviews_Action2;?></th>
              </tr>
            </thead>
            <tbody>
            <?php
              $sql = "SELECT * FROM videoCategory WHERE UID =" . $_GET['id'];
              $result = $conn->query($sql);
              $k = 0;
              while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <th scope="row"><?php echo ++$k; ?></th>
                  <td><?php echo $row['Category']; ?></td>
                  <td><button class="btn btn-success update-category" data-name="<?php echo $row['Category']; ?>" data-id="<?php echo $row['CID'];?>"><i class="fa fa-pencil"></i></button></td>
                  <td><button class="btn btn-danger delete-category" data-id="<?php echo $row['CID'];?>"><i class="fa fa-trash"></i></button></td>
                </tr>
              <?php 
              } ?>         
            </tbody>
          </table>
          <!-- Modal - Add Category -->
          <div class="modal fade" id="modal-category" tabindex="-1" role="dialog" aria-labelledby="modalCategory"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $manage_video_add_category;?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="text" class="form-control" name="category" id="category" placeholder="<?php echo $manage_video_add_category_placeholder;?>" />
                    <div id="error-text">Category cannot be empty</div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $manage_video_category_close;?></button>
                    <button type="button" class="btn btn-primary" id="add-db"><?php echo $manage_video_add;?></button>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- Modal - Udpate Category -->
          <div class="modal fade" id="modal-edit-category" tabindex="-1" role="dialog" aria-labelledby="modalCategory"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo $manage_video_edit_category;?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <div class="modal-body">
                    <input type="text" hidden name="edit-CID" id="edit-CID" />
                    <input type="text" class="form-control" name="edit-category" id="edit-category" placeholder="<?php echo $manage_video_edit_category_placeholder;?>" />
                    <div id="error-text">Category cannot be empty</div>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $manage_video_edit_category_close?></button>
                    <button type="button" class="btn btn-primary" id="update-db"><?php echo $manage_video_edit;?></button>
                  </div>
                </div>
              </div>
            </div>
			</section>
          </div>
        </section>
    

  </main>
  <!-- END Main container -->


  



  <a class="scroll-top" href="#"><i class="fa fa-angle-up"></i></a>


  <!-- Scripts -->
  <script src="assets/js/page.min.js"></script>
  <script src="assets/js/script.js"></script>
  <script src="js/core.min.js"></script>
  <script src="js/thesaas.min.js"></script>
  <script src="js/script.js"></script>
  <script src="js/select2.min.js"></script>
  <script>
    $('#add-category').on('click', function() {
      $('#modal-category').modal('show');
    });
    $('#add-db').on('click', function () {
      if ($('#category').val() === '') {
        console.log('Test');
        $('#error-text').css('display', 'block');
      } else {
        $('#error-text').css('display', 'none');
        $.ajax({
          url: 'submitCategory.php',
          type: 'POST',
          data: {
            UID: '<?php echo $_GET['id']; ?>',
            category: $('#category').val()
          },
          success: function (data) {
            location.reload();
          }
        });
      }
    });
    $('.delete-category').on('click', function () {
      const r = confirm('<?php echo $manage_vdeo_delte_msg;?>');
      if (r === true) {
        $.ajax({
          url: 'deleteCategory.php',
          type: 'POST',
          data: {
            CID: $(this).data('id')
          },
          success: function(data) {
            location.reload();
          }
        });
      }
    });
    $('.update-category').on('click', function () {
      $('#modal-edit-category').modal('show');
      $('#edit-CID').val($(this).data('id'));
      $('#edit-category').val($(this).data('name'));
    });
    $('#update-db').on('click', function () {
      if ($('#edit-category').val() === '') {
        $('#error-text').css('display', 'block');
      } else {
        $('#error-text').css('display', 'none');
        $.ajax({
          url: 'editCategory.php',
          type: 'POST',
          data: {
            CID: $('#edit-CID').val(),
            category: $('#edit-category').val()
          },
          success: function (data) {
            location.reload();
          }
        });
      }
    });
  </script>
<?php include('footer.php');?>
</body>

</html>