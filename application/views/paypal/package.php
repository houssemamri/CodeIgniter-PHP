<section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3>Package
                        
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <!--<a href="javascript:;" class="fa fa-times"></a>-->
                         </span></h3>
                       
                    </header>
                    <div class="panel-body" style="display: block;">
					 <?php if($this->session->flashdata('success_msg')!="") { ?>
                                             <div class="clearfix"></div>
                    <div class="alert alert-success">
                      <strong>Success!</strong> <?php echo $this->session->flashdata('success_msg');?>
                    </div>
                      <?php } ?>
                      
                       <?php if($this->session->flashdata('err_msg')!="") { ?>
                                             <div class="clearfix"></div>
                    <div class="alert alert-danger">
                      <strong>Sorry!</strong> <?=$this->session->flashdata('err_msg');?>
                    </div>
                      <?php } ?>
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                            	
                                <div class="btn-group pull-right">
                                   <!-- <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>-->
                                </div>						
                            <div class="space15"></div>
                            <section class="content">
						      <!-- Small boxes (Stat box) -->
						      <div class="row">
						        <div class="col-lg-3 col-xs-6">
						          <!-- small box -->
						          <?php
						          //print_r($allpackage_row);exit; 
						          foreach($allpackage_row as $pck_res) {  ?>
						          <div class="small-box bg-aqua" style="height: 250px; width: 300px; background:#d7b828;color: #000000">
						            <div class="inner">
						              <h3>
						              
									   <sup style="font-size: 20px"><?php //echo $row['amount'];?></sup></h3>
									   
									   <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
									   <input type='hidden' name='business' value='sanjib@desuntechnology.in'>
									   <input type="hidden" name="package_code" value="<?php echo $pck_res->package_code; ?>"/>
									   <input type='hidden' name='currency_code' value='INR'> 
							              <div class="form-group">
			                                    <label for="inputslidercaption">Package Name</label>
			                                    <?php echo $pck_res->package_name; ?>
			                                    <input type='hidden' name='item_name' value='<?php echo $pck_res->package_name; ?>'>
	                                	  </div>
	                                	  <div class="form-group">
			                                    <label for="inputslidercaption">Package Description</label>
			                                    <?php echo $pck_res->package_desp; ?>
			                                    
	                                	  </div>
	                                	  <div class="form-group">
			                                    <label for="inputslidercaption">Package Hours</label>
			                                    <?php echo $pck_res->package_hours; ?>
	                                	  </div>
	                                	  <div class="form-group">
			                                    <label for="inputslidercaption">Package Price</label>
			                                    <?php echo $pck_res->package_price; ?>
			                                    <input type='hidden' name='amount' value='<?php echo $pck_res->package_price; ?>'> 
	                                	  </div>
										<?php foreach($paypal_payment as $res_paypal) { ?>
											<input type='hidden' name='notify_url' value='<?php echo $res_paypal->notify_url; ?>'>
								            <input type='hidden' name='cancel_return' value='<?php echo $res_paypal->cancel_url; ?>'>
								            <input type='hidden' name='return' value='<?php echo $res_paypal->return_url; ?>'>
							            <?php } ?>
							            <input type="hidden" name="cmd" value="_xclick">
							            <input type="submit" name="pay_now" id="pay_now" Value="Buy Now">

									   </form>
	                                	  
						            </div>
						            <div class="icon">
						              <i class="ion ion-bag"></i>
						            </div>
						          </div>
						          <?php } ?>
						        </div>
						       </div>
						    </section>
							<br><br>
							<header class="panel-heading">
		                        <h3>Coupon</h3>
		                       
		                    </header>
                            
                            <section class="content">
						      <!-- Small boxes (Stat box) -->
						      <div class="row">
						        <div class="col-lg-3 col-xs-6">
						          <!-- small box -->
						          <?php foreach($coupon as $res_coupon) { ?>
						          <div class="small-box bg-aqua" style="height: 250px; width: 300px; background:#d7b828;color: #000000">
						            <div class="inner">
						              <h3>
						              
									   <sup style="font-size: 20px"><?php //echo $row['amount'];?></sup></h3>
									   
									   	  <div class="form-group">
			                                    <label for="inputslidercaption">Coupon Code</label>
			                                    <?php echo $res_coupon->coupon_code; ?>
	                                	  </div>

							              <div class="form-group">
			                                    <label for="inputslidercaption">Start Date</label>
			                                    <?php echo $res_coupon->start_date; ?>
	                                	  </div>
	                                	  <div class="form-group">
			                                    <label for="inputslidercaption">End Date</label>
			                                    <?php echo $res_coupon->end_date; ?>
	                                	  </div>
	                                	  <div class="form-group">
			                                    <label for="inputslidercaption">Minimum Cart Value</label>
			                                    <?php echo $res_coupon->min_cart_value; ?>
	                                	  </div>
	                                	  <div class="form-group">
			                                    <label for="inputslidercaption">Maximum Cart Value</label>
			                                    <?php echo $res_coupon->max_cart_value; ?>
	                                	  </div>
	                                	  
	                                	  <button name="buy_purchase">Apply Now</button>
						            </div>
						            <div class="icon">
						              <i class="ion ion-bag"></i>
						            </div>
						          </div>
						          <?php } ?>
						        </div>
						       </div>
						    </section>
                            
                            <br />
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    
<script type="text/javascript">
  function myJsFunc_comdel(dataid)
  {
    if (confirm("Are you sure that you want to delete the data?"))
    {
    window.location.href = "<?php echo base_url()?>admin/package/delete_data/"+dataid;
    }
  }
</script> 
    
         