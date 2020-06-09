<?php
$save_folder = dirname(__FILE__)."/assets/upload";


/*
print_r($_POST['formData']);*/

$formdata = $_POST['formData'];
var_dump($formdata);
foreach($formdata as $data){
	var_dump($data);
}



/*
 $tmp_name = $_FILES["videofile"]["tmp_name"];
 $upload_name = $_FILES["videofile"]["name"];
 $type = $_FILES["videofile"]["type"];
 $filename = $save_folder."/".$upload_name;*/

?>