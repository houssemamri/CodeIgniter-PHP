<?php 
 
 $sql1="SELECT * FROM oauth_user WHERE user_id=".$_SESSION['user_id'];
				$result=$conn->query($sql1);
   $data=$result->fetch_array();
				// $row=$result->fetch_assoc();
				/* while($row=$result->fetch_assoc())
				  {
				$data=$row;	  
				  } */
				  if(!empty($data)){
				 $client_id= $data['client_id']; 
			 $client_secret=$data['client_secret'];
				  }else{
				 $client_id= ''; 
			 $client_secret='';  
				  }
				 // print_r($data);
				?>
   
   <div class="row">

   	<div id="google_div">
   <form class="form-transparent" id="submit_google" action="javascript:void(0);" method="POST">
      <h6 class="center-text" style="font-weight:bold;font-size: 32px;"><?php echo $googleacc_access;?>:</h6>
      <div class="col-lg-12 text-right">
        <div class="urlSites">
            <span class="urlNames"><?php echo $client_idd;?></span>
            <input type="text" name="client_id" class="urlBox" value="<?php echo $client_id;  ?>" />
        </div>
        <div class="urlSites">
            <span class="urlNames"><?php echo $client_secrett;?></span>
            <input type="text" name="client_secret" class="urlBox" value="<?php echo $client_secret;  ?>" />
        </div><br><br><br>
		<input type="hidden" name="ajax_post" value="save" />
       
      </div>

  <br /><br />
 
    <?php   if(empty($data)){ ?> <button class="btn btn-lg btn-primary"  style="display:table;margin:0 auto;" type="submit">Save</button><?php } ?>
    </form> </div>
	  <br /><br />
	  
	  <?php   if(!empty($data)){  include('user_google.php');  } ?>
</div>	
  
		
