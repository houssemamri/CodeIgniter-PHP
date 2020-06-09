<?php
  include('connection.php');
  $sql="SELECT * FROM usertable WHERE UID=" . $_GET['id'];
  $result=$conn->query($sql);
  $row=$result->fetch_assoc();
  $path="NewDesign";
  $sql1="SELECT * FROM imageuser WHERE UID=" . $_GET['id'];
  $result1=$conn->query($sql1);
  $row1=$result1->fetch_assoc();?>
  <div class="row">
      <h6 style="font-weight:bold;font-size:32px;"><?php echo $editLinks;?>:</h6>
      <form action="updateLinks.php" method="POST">
        <div class="col-lg-12 text-center">
              <input type="text" id="UID" name="UID" value="<?php echo $_GET['id'];?>" hidden />
              <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Hotel (<?php echo $answerProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="trip1" name="trip1" class="urlBox1" value="<?php echo $row['TripAdvisor1'];?>" />
                    </div>
                  </div>
              </div>
              <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Hotel (<?php echo $readProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="tripside1" name="tripside1" class="urlBox1" value="<?php echo $row['TripAdvisorSide1'];?>" />
                    </div>
                  </div>
              </div>
              <div class="urlSites">
                <div class="row">
                  <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Restaurant (<?php echo $answerProfile; ?>)</span>
                  </div>
                  <div class="col-md-12">
                      <input type="text" id="trip2" name="trip2" class="urlBox1" value="<?php echo $row['TripAdvisor2'];?>" />
                  </div>
                </div>
              </div>
              <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Restaurant (<?php echo $readProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="tripside2" name="tripside2" class="urlBox1" value="<?php echo $row['TripAdvisorSide2'];?>" />
                    </div>
                  </div>
              </div>
              <div class="urlSites">
                <div class="row">
                  <div class="col-md-12 text-center">
                    <span class="urlNames">URL Tripadvisor Loisirs (<?php echo $answerProfile; ?>)</span>
                  </div>
                  <div class="col-md-12">
                    <input type="text" id="trip3" name="trip3" class="urlBox1" value="<?php echo $row['TripAdvisor3'];?>" />
                  </div>
                </div>
              </div>
              <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Loisirs (<?php echo $readProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="tripside3" name="tripside3" class="urlBox1" value="<?php echo $row['TripAdvisorSide3'];?>" />
                    </div>
                  </div>
              </div>
              <div class="urlSites">
                <div class="row">
                  <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Culture (<?php echo $answerProfile; ?>)</span>
                  </div>
                  <div class="col-md-12">
                    <input type="text" id="trip4" name="trip4" class="urlBox1" value="<?php echo $row['TripAdvisor4'];?>" />
                  </div>
                </div>
              </div>
              <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Tripadvisor Culture (<?php echo $readProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="tripside4" name="tripside4" class="urlBox1" value="<?php echo $row['TripAdvisorSide4'];?>" />
                    </div>
                  </div>
              </div>
               <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Booking (<?php echo $answerProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="book" name="book" class="urlBox1" value="<?php echo $row['Booking'];?>"/>
                    </div>
                  </div>
              </div>
               <div class="urlSites">
                  <div class="row">
                    <div class="col-md-12 text-center">
                      <span class="urlNames">URL Booking (<?php echo $readProfile; ?>)</span>
                    </div>
                    <div class="col-md-12">
                      <input type="text" id="book1" name="book1" class="urlBox1" value="<?php echo $row['BookingSide'];?>"/>
                    </div>
                  </div>
              </div>
              <div class="urlSites">
                <div class="row">
                  <div class="col-md-12 text-center">
                      <span class="urlNames">URL LaFourchette (<?php echo $answerProfile; ?>)</span>
                  </div>
                  <div class="col-md-12">
                    <input type="text" id="laFour" name="laFour" class="urlBox1" value="<?php echo $row['LaFour'];?>"/>
                  </div>
                </div>
             </div>
             <div class="urlSites">
               <div class="row">
                 <div class="col-md-12 text-center">
                     <span class="urlNames">URL LaFourchette (<?php echo $readProfile; ?>)</span>
                 </div>
                 <div class="col-md-12">
                   <input type="text" id="laFour1" name="laFour1" class="urlBox1" value="<?php echo $row['LaFourSide'];?>"/>
                 </div>
               </div>
            </div>
            <div class="urlSites">
              <div class="row">
                <div class="col-md-12 text-center">
                    <span class="urlNames">URL Expedia (<?php echo $answerProfile; ?>)</span>
                </div>
                <div class="col-md-12">
                  <input type="text" id="expedia1" name="expedia1" class="urlBox1" value="<?php echo $row['Expedia'];?>"/>
                </div>
              </div>
           </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Expedia (<?php echo $readProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="expedia2" name="expedia2" class="urlBox1" value="<?php echo $row['ExpediaSide'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Hotel (<?php echo $answerProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jaune1" name="jaune1" class="urlBox1" value="<?php echo $row['Jaune1'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Hotel (<?php echo $readProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jauneSide1" name="jauneside1" class="urlBox1" value="<?php echo $row['JauneSide1'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Restaurant (<?php echo $answerProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jaune2" name="jaune2" class="urlBox1" value="<?php echo $row['Jaune2'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Restaurant (<?php echo $readProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jauneSide2" name="jauneside2" class="urlBox1" value="<?php echo $row['JauneSide2'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Loisirs (<?php echo $answerProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jaune3" name="jaune3" class="urlBox1" value="<?php echo $row['Jaune3'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Loisirs (<?php echo $readProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jauneSide3" name="jauneside3" class="urlBox1" value="<?php echo $row['JauneSide3'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Culture (<?php echo $answerProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jaune4" name="jaune4" class="urlBox1" value="<?php echo $row['Jaune4'];?>"/>
               </div>
             </div>
          </div>
           <div class="urlSites">
             <div class="row">
               <div class="col-md-12 text-center">
                   <span class="urlNames">URL Page Jaune Culture (<?php echo $readProfile; ?>)</span>
               </div>
               <div class="col-md-12">
                 <input type="text" id="jauneSide4" name="jauneside4" class="urlBox1" value="<?php echo $row['JauneSide4'];?>"/>
               </div>
             </div>
          </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Hotel (<?php echo $answerProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petit1" name="petit1" class="urlBox1" value="<?php echo $row['Petit1'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Hotel (<?php echo $readProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide1" name="petitside1" class="urlBox1" value="<?php echo $row['PetitSide1'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Restaurant (<?php echo $answerProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petit2" name="petit2" class="urlBox1" value="<?php echo $row['Petit2'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Restaurant (<?php echo $readProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide2" name="petitside2" class="urlBox1" value="<?php echo $row['PetitSide2'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Loisirs (<?php echo $answerProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petit3" name="petit3" class="urlBox1" value="<?php echo $row['Petit3'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Loisirs (<?php echo $readProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide3" name="petitside3" class="urlBox1" value="<?php echo $row['PetitSide3'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Culture (<?php echo $answerProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petit4" name="petit4" class="urlBox1" value="<?php echo $row['Petit4'];?>"/>
             </div>
           </div>
        </div>
         <div class="urlSites">
           <div class="row">
             <div class="col-md-12 text-center">
                 <span class="urlNames">URL Petit Futé Culture (<?php echo $readProfile; ?>)</span>
             </div>
             <div class="col-md-12">
               <input type="text" id="petitSide4" name="petitside4" class="urlBox1" value="<?php echo $row['PetitSide4'];?>"/>
             </div>
           </div>
        </div>
        </div>
    </div>
    <br /><br />
    <button type="submit" class="btn btn-lg btn-primary"  style="display:table;margin:0 auto;"><?php echo $saveBtn;?></button>
</form>
