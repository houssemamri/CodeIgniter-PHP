


<?php

  $sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  $path="NewDesign";
  $sql1="SELECT * FROM imageUser WHERE UID=" . $_GET['id'];
  $result1=$conn->query($sql1);
  $row1=$result1->fetch_assoc();?>
  <div class="row">
  <div class="col-lg-12 text-center">
                    
                      <?php
                      $sql="SELECT * FROM UserTable WHERE UID=" . $_GET['id'];
                      $result=$conn->query($sql);
                      $rownaem=$result->fetch_assoc();?>
                
				      <div style="text-align: left;     margin: 20px auto;" >
				      <span id="profileName" >   
				      <?php echo $welcome; ?>
				     <span > <?php echo $rownaem['Name'];?>  </span>!</span><br />
				     <span style="font-size: 20px;"> <?php echo $profieHomeText;?>!
                     </span> 
				      </div>                  
                  </div>
      <h6 class="center-text" style="font-weight:bold;font-size:32px;"><?php echo $editLinks;?>:</h6>
      <form action="updateLinks.php" method="POST">
        <div class="col-lg-12 text-center">
              <input type="text" id="UID" name="UID" value="<?php echo $_GET['id'];?>" hidden />
              <div class="urlSites">
                  <div class="row">
                  <div class="col-md-2">
                  	<img class="img-responsive todo" src="img/TripAdvisor_logo.svg.png" alt="" />
                  </div>
                      <div class="col-md-10">
                          <div class="row">

                          <div class="col-md-2 text-center">
                              <br><span class="urlNames"><?php echo $hotel;?>  </span>
                            </div>

                          <div class="col-md-10">
                            <br><input type="text" id="tripside1" name="tripside1" class="urlBox1" style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide1'];?>" />
                            </div>
                        </div>
                          <div class="row">

                          <div class="col-md-2 text-center">
                          <br><span class="urlNames"><?php echo $resturant;?> </span>
                      </div>
                          <div class="col-md-10">
                          <br><input type="text" id="tripside2" name="tripside2" class="urlBox1" style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide2'];?>" />
                      </div>
                          </div>

                          <div class="row">

                          <div class="col-md-2 text-center">
                          <br><span class="urlNames"><?php echo $tourism;?> </span>
                    </div>

                    <div class="col-md-10">
                        <br><input type="text" id="tripside3" name="tripside3" class="urlBox1" style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />
                    </div>
                  </div>
                  </div>

                  </div>
                  <div class="clearfix-links"></div>

              </div>
              <div class="urlSites">
                  <div class="row">
                  <div class="col-md-2">
                  	<img class="img-responsive todo" src="img/gmb.png" alt="" />
                  </div>
                      <div class="col-md-10">
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $hotel ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" style="margin-bottom: 1%; width: 100%  !important;"  class="urlBox1" value="<?php echo $row['TripAdvisorSide2'];?>" />
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $resturant  ;?></span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" style="margin-bottom: 1%; width: 100%  !important;" class="urlBox1" value="<?php echo $row['TripAdvisorSide2'];?>" />
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $tourism ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" style="margin-bottom: 1%; width: 100%  !important;" class="urlBox1" value="<?php echo $row['TripAdvisorSide2'];?>" />
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $product ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" style="margin-bottom: 1%; width: 100%  !important;" class="urlBox1" value="<?php echo $row['TripAdvisorSide2'];?>" />
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $service ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" style="margin-bottom: 1%; width: 100%  !important;" class="urlBox1" value="<?php echo $row['TripAdvisorSide2'];?>" />
                              </div>
                          </div>
                    </div>

                  </div>
                  <div class="clearfix-links"></div>

              </div>
              <div class="urlSites">
                  <div class="row">
                  <div class="col-md-2">
                  	<img class="img-responsive todo" src="img/facebook_logo_thumb.jpg" alt="" />
                  </div>
                      <div class="col-md-10">
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $hotel ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100% !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $resturant  ;?>  </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $tourism ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $product ;?>  </span>

                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $service ;?>  </span>

                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>

                      </div>
                  </div>
                  <div class="clearfix-links"></div>
              </div>
 			<div class="urlSites">
                  <div class="row">
                  <div class="col-md-2">
                  	<img class="img-responsive todo" src="img/website.jpg" alt="" />
                  </div>
                      <div class="col-md-10">
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $hotel ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100% !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $resturant  ;?>  </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $tourism ;?> </span>
                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $product ;?>  </span>

                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>
                          <div class="row">
                              <div class="col-md-2 text-center">
                                  <br><span class="urlNames"><?php echo $service ;?>  </span>

                              </div>
                              <div class="col-md-10">
                                  <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                              </div>
                          </div>

                      </div>
                  </div>
                <div class="clearfix-links"></div>

            </div>
              <div class="urlSites">
                  <div class="row">
                  <div class="col-md-2">
                  	<img class="img-responsive todo" src="img/resturant.jpg" alt="" />
                  </div>
                      <div class="col-md-10">

                      <div class="row">
                          <div class="col-md-2 text-center">
                              <br><span class="urlNames"><?php echo $resturant ;?>  </span>

                          </div>
                          <div class="col-md-10">
                              <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['TripAdvisorSide3'];?>" />

                          </div>
                          </div>
                      </div>
                  </div>
                  <div class="clearfix-links"></div>

              </div>
               <div class="urlSites">
                  <div class="row">
                  <div class="col-md-2">
                  	<img class="img-responsive todo" src="img/booking.jpg" alt="" />
                  </div>
                      <div class="col-md-10">

                      <div class="row">
                          <div class="col-md-2 text-center">
                              <br><span class="urlNames"><?php echo $hotel ;?> </span>
                          </div>
                          <div class="col-md-10">
                              <br><input type="text" style="margin-bottom: 1%; width: 100%  !important;"  class="urlBox1" value="<?php echo $row['BookingSide'];?>"/>
                          </div>
                          </div>
                      </div>
                  </div>
                   <div class="clearfix-links"></div>

               </div>
             <div class="urlSites">
               <div class="row">
               <div class="col-md-2">
               	<img class="img-responsive todo" src="img/trustpilot-vector-logo.png" alt="" />
               </div>
                   <div class="col-md-10">

                   <div class="row">
                       <div class="col-md-2 text-center">
                           <br><span class="urlNames"><?php echo $tourism ;?> </span>
                       </div>
                       <div class="col-md-10">
                           <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['LaFourSide'];?>" />

                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-2 text-center">
                           <br><span class="urlNames"><?php echo $product ;?>  </span>

                       </div>
                       <div class="col-md-10">
                           <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['LaFourSide'];?>" />

                       </div>
                   </div>
                   <div class="row">
                       <div class="col-md-2 text-center">
                           <br><span class="urlNames"><?php echo $service ;?>  </span>

                       </div>
                       <div class="col-md-10">
                           <br><input type="text" class="urlBox1"  style="margin-bottom: 1%; width: 100%  !important;" value="<?php echo $row['LaFourSide'];?>" />

                       </div>
                   </div>
                   </div>

               </div>
            </div>
          <style>
              .clearfix-links {
                  margin-top: 10px;
                  height: 1px;
                  background-color: transparent;
                  width: 100%;
                  box-shadow: 0 0 4px black;
                  opacity: 0.4;
              }
          </style>
        <!-- <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Hotel  </span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide1" name="petitside1" class="urlBox1" value="<?php echo $row['PetitSide1'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Restaurant  </span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide2" name="petitside2" class="urlBox1" value="<?php echo $row['PetitSide2'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Loisirs  </span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide3" name="petitside3" class="urlBox1" value="<?php echo $row['PetitSide3'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Culture  </span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide4" name="petitside4" class="urlBox1" value="<?php echo $row['PetitSide4'];?>"/>
             </div>
           </div>
        </div>-->
        </div>    
    <br /><br />
    <button type="submit" class="btn btn-lg btn-primary"  style="display:table;margin:0 auto;"><?php echo $saveBtn;?></button>
</form>
</div>
