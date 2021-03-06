

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
                      <h1><a href="https://review-thunder.com/logout.php">Logout</a></h1>
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
                        Add <strong>Posts</strong>
                      </div>
                      <div class="card-body card-block">
                        <form action="<?php echo base_url();?>admin/mini/French/submitPost" method="post" class="form-horizontal">
                          <?php
                            if(isset($success))
                            {?>
                              <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                <span class="badge badge-pill badge-success">Success</span> You successfully added post to the database.
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                          <?php
                            }
                            else if(isset($fail))
                            {?>
                              <div class="alert  alert-warning alert-dismissible fade show" role="alert">
                                <span class="badge badge-pill badge-warning">Failed</span> Post was not added to the database.
                                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                            <?php
                            }
                            foreach($Post as $row){
                          ?>
                          <input type="text" name="PID" value="<?php echo $_GET['id'];?>" hidden/>
                          <div class="row form-group">
                            <div class="col col-md-3">
                              <label for="text-input" class=" form-control-label">Title *</label>
                            </div>
                            <div class="col-12 col-md-9">
                              <input type="text" id="title" name="title" placeholder="Title" class="form-control" value="<?php echo $row->Title_Fr;?>" required>
                            </div>
                          </div>
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Content English *</label></div>
                            <div class="col-12 col-md-9"><textarea name="content" id="content" rows="12" placeholder="Content English" class="form-control" required><?php echo $row->Content_Fr;?></textarea></div>
                          </div>
                          <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm">
                              <i class="fa fa-dot-circle-o"></i> Submit
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                              <i class="fa fa-ban"></i> Reset
                            </button>
                          </div>
                          <?php
                            }
                           ?>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>


            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
