<?php

class Users {
	
	function __construct(){
		//database configuration
		include("configdata.php");		
		$con = mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbName);
		if(mysqli_connect_errno()){
			die("Failed to connect with MySQL: ".mysqli_connect_error());
		}else{
			$this->connect = $con;
			$this->conaccse=$access_token;
		}
	}
	function Search(){
		if(isset($_POST['go'])){

$limit = urlencode($_POST['limit1']);
$search_term = urlencode($_POST['search_term']);
$sername=$search_term;
$serno=$limit;
$serip=$_SERVER['HTTP_CLIENT_IP']?:($_SERVER['HTTP_X_FORWARDE‌​D_FOR']?:$_SERVER['REMOTE_ADDR']);
$sertime=date("Y-m-d h:i:sa");
$sql = "INSERT INTO `results`(`sername`, `serno`, `serip`, `sertime`) VALUES ('$sername','$serno','$serip','$sertime')";

if (mysqli_query($this->connect, $sql)) {
    //echo "Saved";
} else {
   "Error: " . $sql . "<br>" . mysqli_error($conn);
}

		
 $url="https://graph.facebook.com/v2.6/search?q=".$search_term."&type=page&limit=".$limit."&access_token=".$this->conaccse."&fields=cover,id,name,contact_address,phone,emails,website,fan_count,link,is_verified,about,picture,category";
$url=str_replace(" ", "%20", $url);
$fbJson = file_get_contents($url);
if($filecontent = $fbJson !== false){
		

		

	$dataArr = json_decode($fbJson,true);
echo "<p class='alert alert-success'>You searched for 20 Pages using the keyword ".$search_term."  and result have been saved to database <a href='list.php'>View result</a></p>";
		while($data = array_shift($dataArr)){

			foreach ($data as $item){

				  $id=$item['id'];
				  $name=$item['name'];
				  $contact=$item['contact_address'];
				  $phone=$item['phone'];
				  $emails=implode(" ",$item['emails']);				  
				  $website=$item['website'];
				  $fan_count=$item['fan_count'];
				  $link=$item['link'];
				  $is_verified=$item['is_verified'];
				   $about=$item['about'];
				    $picture=$item['picture'];
					$category=$item['category'];
					$category=$item['category'];
					$cover=$item['cover'];
					 $cover23=array_values($cover)[3];
					
				  
				  
					
						
						
$sql = "SELECT name FROM emails where name ='$name' ";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    "Already exists";
} else {
    $sql = "INSERT INTO `emails`( `pageid`, `name`, `contact_address`, `phone`, `emails`, `website`, `fan_count`, `link`, `is_verified`, `about`, 
	`picture`,`category`,`cover`) VALUES ('$id','$name','$contact','$phone','$emails','$website','$fan_count','$link','$is_verified','$about','$picture','$category','$cover23')";

if (mysqli_query($this->connect, $sql)) {
    $email ." Saved successfully";
} else {
   "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
					
			}
		}
		
}
else
{
	echo $fbJson;
}

	}
	
	


	
		
	}
	
	
	function emails(){
		
		
	$sql = "SELECT * FROM emails ORDER BY id DESC ";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr >
		
        <td>" . $row["name"]. "</td>
		<td>" . $row["phone"]. "</td>
		<td>" . $row["emails"]. "</td>
		<td>" . $row["fan_count"]. "</td>
		<td><a href='" . $row["link"]. "'>Go to Page</a></td>		
		
		
		
		</tr>";
    }
} else {
    echo "0 results";
}	
	}
	
	function emailszote(){
		$sql = "SELECT * FROM emails ORDER BY id DESC ";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		if ($row["emails"] !=""){
			echo  $row["emails"].", ";
		}
        
    }
} else {
    echo "0 results";
}
		
		
	}
	
	
	
function emails2018(){
		
		
	$sql = "SELECT * FROM emails ORDER BY id DESC ";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr >
		<td>page Cover Is hidden</td>
		<td ><img src='" . $row["picture"]. "'/></td>
        <td>" . $row["name"]. "</td>
		<td>" . $row["category"]. "</td><td>" . $row["phone"]. "</td>
		<td>" . $row["emails"]. "</td><td><a href='" . $row["website"]. "'>Open</a></td>
		<td>" . $row["fan_count"]. "</td><td><a href='" . $row["link"]. "'>Go to Page</a></td>
		
		<td>" . $row["about"]. "</td>
		
		
		</tr>";
    }
} else {
    echo "0 results";
}	
	}

function emails1(){
		
		
$sql = "SELECT * FROM emails ORDER BY id DESC ";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr >
		
		<td ><img src='" . $row["picture"]. "'/></td>
        <td>" . $row["name"]. "</td>
		<td>" . $row["category"]. "</td><td>" . $row["phone"]. "</td>
		<td>" . $row["emails"]. "</td><td><a href='" . $row["website"]. "'>Open</a></td>
		<td>" . $row["fan_count"]. "</td><td><a href='" . $row["link"]. "'>Go to Page</a></td>
		
		<td>" . $row["about"]. "</td>
		
		
		</tr>";
    }
} else {
    echo "0 results";
}	
	}



 function total(){
$sql = "SELECT count(id) as df FROM emails";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo $row["df"];
    }
} else {
    echo "0";
}	
	

}

function emailtemp(){
$sql = "SELECT * FROM bulky where id='1'";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<textarea cols='60' rows='10' id='postCont' aria-hidden='true' class='form-control'>".$row["template"]."</textarea>";
    }
} else {
    echo "0";
}	
	

}


function export(){
$sql = "SELECT * FROM emails ";
$result = $this->connect->query($sql);
$fp = fopen('allfacebookpages.csv', 'w');	
	while($row = $result->fetch_assoc())
{
	
	 fputcsv($fp, $row);
	
}


   

    fclose($fp);

}

function fblog(){
	$sql = "SELECT email FROM members where email ='$name' ";
$result = $this->connect->query($sql);

if ($result->num_rows > 0) {
    "Already exists";
} else {
    $sql = "";

if (mysqli_query($this->connect, $sql)) {
    $email ." Saved successfully";
} else {
   "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
	
	
	
}

function clear(){
$sql = "TRUNCATE TABLE emails;";
$result = $this->connect->query($sql);

header('Location: index.php?clear=true');
}



function export1(){
$sql = "SELECT * FROM emails where emails !='' limit 25";
$result = $this->connect->query($sql);
$fp = fopen('allfacebookpageswithemail.csv', 'w');	
	while($row = $result->fetch_assoc())
{
	
	 fputcsv($fp, $row);
	
}


   

    fclose($fp);

}
}


?>