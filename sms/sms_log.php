<?php
session_start();

define('DEBUG', false);

error_reporting(E_ALL);
ini_set('display_errors', DEBUG ? 'On' : 'Off');


include_once "connection.php";
include_once "common_function.php";


?>




 
     <div class="container">
    <div class="row">
    
  

     <table class="table table-striped table-bordered" style="width: 100%"  id="smsLogTable">
			    <thead>
			      <tr>				
			      	<th>Mobile No</th>
			        <th>Message</th>
			        <th>Send Date</th>			        
			        <th>Send Time</th>
			      </tr>
			    </thead>
			    <tbody>
			
			<?php
		$sql = "SELECT * FROM sms_log WHERE admin_id='".$_SESSION['user_id']."'";
		$query = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($query))	 {
		
		?>	
		<tr>
		<td><?php echo $row['receive_number'];?></td>
		<td><?php echo $row['msg'];?></td>
		<td><?php echo $row['send_date'];?></td>
		<td><?php echo $row['send_time'];?></td>
		</tr>
		
		<?php 
}
		?>
			
			    </tbody>
			  </table>
			  
 </div>
 </div>   			  







