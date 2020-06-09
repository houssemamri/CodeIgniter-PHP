

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
              <?php
                if(isset($success))
                {?>
                  <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span> You successfully deleted post from the database.
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
              ?>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Manage Post</strong>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive">
                                  <thead>
                                    <tr>
                                      <th scope="col">#</th>
                                      <th scope="col">Title</th>
                                      <th scope="col">Manage French</th>
                                      <th scope="col">Manage Spanish</th>
                                      <th scope="col">Manage English</th>
                                      <th scope="col">Delete</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                  if($result == null)
                                  {?>
                                    <tr>
                                      <td colspan="5" class="text-center">No Post(s).</td>
                                    </tr>
                                  <?php
                                  }
                                  else
                                  {
                                    foreach($result as $key=>$row)
                                    {
                                    ?>
                                    <tr>
                                      <td><?php echo $key+1;?></td>
                                      <td><?php echo $row->Title;?></td>
                                      <td>
                                        <a href="<?php echo base_url();?>admin/mini/French/?id=<?php echo $row->PID;?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                      </td>
                                      <td>
                                        <a href="<?php echo base_url();?>admin/mini/Spanish/?id=<?php echo $row->PID;?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>
                                      </td>
                                      <td><a href="<?php echo base_url();?>admin/mini/ManagePost/editPost?id=<?php echo $row->PID;?>" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a></td>
                                      <td><a href="<?php echo base_url();?>admin/mini/ManagePost/deletePost?id=<?php echo $row->PID;?>" onclick="return confirm('Are you sure you want to delete it?');" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a></td>
                                    </tr>
                                  <?php
                                    }
                                  }
                                ?>
                          </tbody>
                      </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


    </div><!-- /#right-panel -->
