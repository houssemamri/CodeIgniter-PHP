<?php
session_start();
include('connection.php');
$name=$_POST['username'];
$company=$_POST['company'];
$position=$_POST['position'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$pwd=$_POST['password'];
$noAc=$_POST['no_of_account'];
$password=password_hash($pwd, PASSWORD_DEFAULT);
$sql="INSERT INTO UserTable(Name,Company,Position,Email,Contact,Password,no_of_account) VALUES('" . $name . "','" . $company . "','" . $position . "','" . $email . "','" . $contact . "','" . $password . "','0')";
//echo $sql;
$conn->query($sql);
$_SESSION["customer_name"] = $name;
$_SESSION["customer_email"] = $email;

$sql="SELECT * FROM UserTable ORDER BY UID desc LIMIT 1";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$sql="INSERT INTO Master(MasterID,SubID,total_ac) VALUES(" . $row['UID'] . "," . $row['UID'] . ",". $row['no_of_account'] .")";
$conn->query($sql);
$sql="INSERT INTO imageUser(imageName,imagePath) VALUES('Default','img/default_profile.png')";
$conn->query($sql);
$conn->close();

include('connection2.php');
$privateKey = md5('youaremylethe'.sha1(sha1(sha1(md5(rand().uniqid('youaremylethe',true).sha1(time()))))));
$publicKey = md5('youaremylethe'.sha1(sha1(sha1(uniqid('youaremylethe',true).time().rand()))));
$usrPass = md5('youaremylethe'.sha1(sha1(sha1($password))));

$sql="INSERT INTO lethe_users(
OID, 
real_name, 
mail, 
pass, 
auth_mode, 
isActive, 
isPrimary, 
private_key, 
public_key, 
last_login, 
session_token, 
session_time) VALUES(
1, 
'" . $name . "',
'" . $email . "',
'" . $usrPass . "',
0, 
1, 
1, 
'" . $privateKey . "',
'" . $publicKey . "',
'" . date('Y-m-d H:i:s') . "',
'" . md5(date('Y-m-d H:i:s')) . "',
'" . date('Y-m-d H:i:s') . "')";
$connews->query($sql);

 $uid = $connews->insert_id;

$lethe_user_permissions = array('autoresponder', 'autoresponder/add', 'autoresponder/edit', 'autoresponder/tasks', 'newsletter', 'newsletter/add', 'newsletter/campaigns', 'newsletter/edit', 'newsletter/reports', 'organizations', 'organizations/organization/edit', 'organizations/shortcodes', 'organizations/users', 'organizations/users/add', 'organizations/users/edit', 'subscribers', 'subscribers/blacklist', 'subscribers/exp-imp', 'subscribers/forms/add', 'subscribers/forms/edit', 'subscribers/forms/list', 'subscribers/groups', 'subscribers/subscriber/add', 'subscribers/subscriber/edit', 'subscribers/subscriber/list', 'templates', 'templates/add', 'templates/edit', 'templates/list', 'templates/loader');
foreach($lethe_user_permissions as $k=>$v){
// echo $v;
	$sql="INSERT INTO lethe_user_permissions(
	OID, 
	UID, 
	perm) VALUES(
	1, 
	" . $uid . ",
	'" . $v . "')";
	print_r($connews->query($sql));


}



header('Location: ' . 'https://review-thunder.com/priceing/index');
?>
