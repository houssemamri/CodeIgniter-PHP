<?php
session_start();
include('connection.php');
$sql="SELECT * FROM posts_meta";
          $result=$conn->query($sql);
		 echo  $i=1;
		 echo "<br>";
		  // while($row=$result->fetch_assoc())
            // {
				// $meta_name = $row['sent_time'];
				// $user_id = $row['user_id'];
			echo $sql2 = "Update posts_meta set meta_id='34' where sent_time='1539709445' and network_id='7'";	
			 echo "<br>";
			$result2=$conn->query($sql2);
			// $i++;
			// }