<?php
  if($result == null)
  {
    redirect('admin/ManagePost');
  }
  else
  {
    foreach($result as $row)
    {
      $output = array(
        "PID" => $row->PID,
        "Title" => $row->Title,
        "ContentEnglish" => $row->Content_English
      );
    }
  }

?>

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                  <div class="page-title">
                      <h1><a href="../logout.php">Logout</a></h1>
                  </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">



                  <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        Edit <strong>Posts</strong>
                      </div>
                      <div class="card-body card-block">
                        <form action="<?php echo base_url();?>admin/ManagePost/update" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <?php
                            if(isset($success))
                            {?>
                              <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                <span class="badge badge-pill badge-success">Success</span> You successfully updated the post.
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                          <?php
                            }
                            else if(isset($fail))
                            {?>
                              <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                                <span class="badge badge-pill badge-warning">Failed</span> Post was not updated.
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            <?php
                            }
                          ?>
                          <input type="text" name="PID" value="<?php echo $output['PID'];?>" hidden />
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Title *</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="title" name="title" placeholder="Title" value="<?php echo $output['Title'];?>" class="form-control" required>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="file-input" class=" form-control-label">Main Image *</label></div>
                            <div class="col-12 col-md-9"><input type="file" id="file-input" name="file-input" class="form-control-file" accept=".jpg,.png" required></div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Content English *</label></div>
                            <div class="col-12 col-md-9"><textarea name="content" id="content" rows="12" placeholder="Content English" class="form-control" required><?php echo $output['ContentEnglish'];?></textarea></div>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                              <i class="fa fa-dot-circle-o"></i> Update
                            </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>


            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
