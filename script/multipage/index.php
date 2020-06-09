<?php


include("inc/head1.php");
?>

              
                
                      
                        <!-- content -->                      
                      	<div class="row">
                          <div class="col-sm-12">
						   <form method="post" action="">
							<div class="col-sm-3">
							<select class="form-control" name="limit1">
							<option value="">Select Number of results</option>
							<option value="20">20</option>
							<option value="200">200</option>
							<option value="400">400</option>
							<option value="1000">1000</option>
							
							
							</select>
							</div>
							<div class="col-sm-6">
							<input type="text" name="search_term" class="form-control" placeholder="Enter search Keyword e.g New York" />
                                </div>
								<div class="col-sm-3">
								<span class="input-group-btn">
                                   
								   <button name="go" class="btn btn-primary" type="submit">
                                       <i class="fa fa-search"></i> Scrape  Now
                                    </button>
                                </span>
								</form>
						  
						  </div>
						  </div>
						  
                      
                       
                      
                        
                      
                      
                        
                      
                    </div><!-- /col-9 -->
                </div><!-- /padding -->
            </div>
            <!-- /main -->
          
        </div>
    </div>
</div>



        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


        <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>






        
       
        
        <script type='text/javascript'>
        
        $(document).ready(function() {
        
            /* off-canvas sidebar toggle */

$('[data-toggle=offcanvas]').click(function() {
  	$(this).toggleClass('visible-xs text-center');
    $(this).find('i').toggleClass('glyphicon-chevron-right glyphicon-chevron-left');
    $('.row-offcanvas').toggleClass('active');
    $('#lg-menu').toggleClass('hidden-xs').toggleClass('visible-xs');
    $('#xs-menu').toggleClass('visible-xs').toggleClass('hidden-xs');
    $('#btnShow').toggle();
});
        
        });
        
        </script>
        
        
        
        
    </body>
</html>