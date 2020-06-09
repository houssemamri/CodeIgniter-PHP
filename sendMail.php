<?php
session_start();
include_once "connection.php";
include_once "common_function.php";
include_once 'email/includes/db.class.php';

//echo $_SESSION['user_id'];


session_start();
/*if (!isset($_SESSION["user_id"]) || is_null($_SESSION["user_id"])) {
	header("Location: https://review-thunder.com/auth/index");
}*/

$db = new Db();
/*$userName=$db->getUserName($_SESSION["UserId"]);*/

$blocks_category=$db->get_blocks_category();

$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link=str_replace("index.php","",$actual_link);
$actual_link=explode('?',$actual_link)[0];
$_outputHtml='';
 for ($i = 0; $i < sizeof($blocks_category); $i++) {

 $_outputHtml .= '<li class="elements-accordion-item" data-type="'.strtolower( $blocks_category[$i]['name']) .'"><a class="elements-accordion-item-title">'. $blocks_category[$i]['name'] .'</a>';

            $_outputHtml .= '<div class="elements-accordion-item-content"><ul class="elements-list">';

            $_items = $blocks=$db->get_blocksByCat($blocks_category[$i]['id']);

             for ($j = 0; $j< sizeof($_items); $j++) {
                $_outputHtml .= '<li>'.
                    '<div class="elements-list-item" name="body">'.
                    '<div class="preview">'.
                    '<div class="elements-item-icon">'.
                    ' <i class="'.$_items[$j]['icon'].'"></i>'.
                    '</div>'.
                    '<div class="elements-item-name">'.
                    $_items[$j]['name'].
                    '</div>'.
                    '</div>' .
                    '<div class="view">' .
                    '<div class="sortable-row">'.
                    '<div class="sortable-row-container">' .
                    ' <div class="sortable-row-actions">';

                    $_outputHtml .= '<div class="row-move row-action">'.
                        '<i class="fa fa-arrows-alt"></i>' .
                        '</div>';


                    $_outputHtml .= '<div class="row-remove row-action">'.
                        '<i class="fa fa-remove"></i>' .
                        '</div>';


                    $_outputHtml .= '<div class="row-duplicate row-action">'.
                        '<i class="fa fa-files-o"></i>' .
                        '</div>';


                    $_outputHtml .= '<div class="row-code row-action">'.
                        '<i class="fa fa-code"></i>'.
                        '</div>';

                $_outputHtml .= '</div>' .
                    '<div class="sortable-row-content"  data-id="'.$_items[$j]['id'].'" data-types="'.$_items[$j]['property'].'"  data-last-type="'.explode(',',$_items[$j]['property'])[0].'">'
										.str_replace('[site-url]',$actual_link,$_items[$j]['html']).
                    '</div>' .
                    '</div>'.
                    '</div>'.
                    ' </div>'.
                    '</div>'.
                    '</li>';
            }


            $_outputHtml .= '</ul></div>';
            $_outputHtml .= '</li>';
     }
//Schedule Email
if(isset($_POST['schedule_email'])){
//print_r($_POST);
	extract($_POST);
//Getting List ID
	for($l=0;$l<count($lists_id);$l++){
//	
//echo $lists_id[$l]; 
	$db = new Db();
			$sql_schedule_email = $db->schedule_email($lists_id[$l],$choose_temp,$subject,$schedule_date,$schdeule_time,date('Y-m-d'),date('H:i:s'));

	if(!$sql_schedule_email){
		echo '<div style="color:#fff;background:red;width:100%">Error</div>';
	}
		}
}



//TEST EMAIL SEND
if(isset($_POST['sendEmail'])){
	extract($_POST);
//print_r($_POST);die("here");
	$temp_id = $choose_temp;
    $sql = "SELECT html FROM templates WHERE id= '$temp_id'";
    $query = mysqli_query($conn,$sql);
    $html = mysqli_fetch_assoc($query);
    $messagead = $html["html"];
	$to1 = $testEmailId;
	$subjectad = $subject;
	$headersad = "From: ".'Review Thunder'." <noreply@review-thunder.com>" . "\r\n";
	$headersad .= "MIME-Version: 1.0" . "\r\n";
	$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headersad .= "X-Mailer: PHP/".phpversion();	
  	
    $mail_success = mail($to1,$subjectad,$messagead,$headersad);

	if(!$mail_success){
		echo '<div style="color:#fff;background:red;width:100%">Error</div>';
	}
}


//MUTIPLE EMAIL SEND
if(isset($_POST['send'])){
	extract($_POST);

//echo count($lists_id);die();
//print_r($_POST);die("here");
	for($l=0;$l<count($lists_id);$l++){
		$sqlGroupId = "select * from EmailListSub where LID='".$lists_id[$l]."'";
		//echo $sqlGroupId;
		$queryGroupId = mysqli_query($conn,$sqlGroupId);
		
   while($result = mysqli_fetch_assoc($queryGroupId)){
	//print_r($result);
	$sqlEmail="select email from EmailList where EID='".$result['EID']."'";
	$query2 = mysqli_query($conn,$sqlEmail);
	$emailName=mysqli_fetch_assoc($query2);
	//print_r($emailName);die("here");
	$messagead = $body;
	$to1 = $emailName['email'];
	//echo $to1;
	$subjectad = $subject;
	$headersad = "From: ".'Review Thunder'." <noreply@review-thunder.com>" . "\r\n";
	$headersad .= "MIME-Version: 1.0" . "\r\n";
	$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headersad .= "X-Mailer: PHP/".phpversion();
  	$mail_success = mail($to1,$subjectad,$messagead,$headersad);

	if(!$mail_success){
		echo "error".mysqli_error($conn);
	}


	if($mail_success){
		//function is in db.class.php
			$db = new Db();
			$sqlEmailLog = $db->insertEmailLog($_SESSION['user_id'],$lists_id[$l],$choose_temp,$to1,$subject,$body,date('Y-m-d'),date('H:i:s'));
		
		/*$content = trim(mysqli_real_escape_string($conn,$body));
		$sqlEmailLog = "INSERT INTO emaillog (userid,gid,template_id,email_id,subject,email_body,send_date,send_time) VALUES('".$_SESSION['user_id']."','".$lists_id[$l]."','".$choose_temp."','".$to1."','".$subject."','".$body."','".date('Y-m-d')."','".date('H:i:s')."')";		
echo $sqlEmailLog;die();*/
		/*$queryEmailLog = mysqli_query($conn,$sqlEmailLog); */
		if(!$sqlEmailLog){
			//echo 'error'.mysqli_error($conn);
			echo '<div style="color:#fff;background:red;width:100%">Error</div>';
		}
	}	
		
}
	}
}

?>



<!--Choose Group Name and Send Email-->
<div class="container">
		<div class="row">
			
			<div class="col-md-6">
			<div class="container"><br>

			<form method="post">
			
			<div class="row">
                <style>
                    .avatar-article4{
                        position: relative;
                        left: -220px;
                        top: 137px;
                        width: 120px;
                    }
                    .bubble-article4 > span{
                        position: absolute;
                        top: -170px;
                        left: 75px;
                        width: 130px;
                        font-size: 11px;
                        max-height: 160px;
                        font-weight: 900;
                        line-height: 1.5;
                    }
                    .bubble-article4 > img{
                        position: absolute;
                        top: -240px;
                        left: 30px;
                        max-width: 210px;
                        max-height: 200px;
                        width: 210px;
                        height: 200px;
                    }

                    .avatar-article-img4{
                        position: absolute;
                        top: -80px;
                        width: 120px;
                    }
                </style>
                <?php
                $sql = 'select avatar,bubble from UserTable where UID = "'.$_SESSION['user_id'].'"';
                $result = $conn->query($sql);
                $row = $result->fetch_array();
                if(is_null($row['avatar'])){
                    $row['avatar'] = 1;
                }
                if(is_null($row['bubble'])){
                    $row['bubble'] = 1;
                }
                ?>
                <div class=" avatar-article avatar-article4">
                    <div class="bubble-article4">
                        <img src="avatar/img/bubble/<?=$row['bubble']?>.png">
                        <span><?=$avatarTextEmail?></span>
                    </div>
                    <img class="avatar-article-img4" src="avatar/img/avatar/<?=$row['avatar']?>.png">
                </div>
				<div class="col-md-12" id="emailGroup">
					<label for="emails"><?php echo $chooseGroupName;?></label>
					<select class="js-example-basic-multiple" id="listId" name="lists_id[]" multiple="multiple">

<?php 

//$sql = "SELECT * FROM emaillistmain where UID=".'1';
$sql = "SELECT * FROM EmailListMain WHERE UID='".$_SESSION['user_id']."'";
//echo $sql;die("here");
$query = mysqli_query($conn,$sql);
//$result = mysqli_fetch_object($query);
//print_r($result);die("here");
while($result = mysqli_fetch_object($query)){

?>
						  <option  value="<?php echo $result->LID;?>"><?php echo $result->ListName;?></option>
<?php } ;?>						  
					</select>
				</div>
				<div class="col-md-12" id="testInputEmail" style="display:none">
						 <div class="form-group">
							<label>Test Email:</label>
							<input type="email" name="testEmailId" class="form-control subject"/>
						</div>
					</div>
			</div> 
				<div class="row">
					<div class="col-md-6">
						 <div class="form-group">
							<label><?php echo $chooseTemplate;?></label>
							<select name="choose_temp" id="choose_temp" class="form-control">
							<option value=""><?php echo $selectoption;?></option>
							<?php
							$sql = "SELECT * FROM templates WHERE user_id=".$_SESSION['user_id'];
							$query = mysqli_query($conn,$sql);
							while($result = mysqli_fetch_object($query)){ ?>	
							<?php //print_r($result);?>							
								<option value="<?php echo $result->id;?>"><?php echo $result->name;?></option>
							<?php };?>
							</select>
						</div>
					</div>
					<div class="col-md-6">
					<br>
					 <div class="form-group">
						<button type="button"  class="btn btn-primary" onclick="newTemplateAdd()"   id="newTemplate"><?php echo $newtemplate;?></button>
						<button type="button"  class="btn btn-danger" style="display: none;"  id="closeTemplate"><?php echo $canceltemplate;?></button>

					</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-12" id="subject">
						<label for="subject"><?php echo $subjectemail;?></label>
						<input class="form-control subject" style="border-color: #616771 !important; " required=""  name="subject" value="" type="text" />
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12" id="schedule_date" style="display: none;">
						<label for="schedule_date">Schedule Date</label>
						<input class="form-control subject" style="border-color: #616771 !important; "   name="schedule_date" value="" type="date" />
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12" id="schdeule_time" style="display: none;">
						<label for="schdeule_time">Schedule Time</label>
						<input class="form-control subject" style="border-color: #616771 !important; "   name="schdeule_time" value="" type="time" />
					</div>
				</div> <br>
				<textarea name="body" id="contentBody" value="" style="display: none;"></textarea>
				<style>
                    @media (max-width: 576px) {
                        .btn{
                            margin-top:20px;
                        }
                    }

                </style>
				<button class="btn btn-primary" id="send" name="send" onclick="myFunction()"><?php echo $sendemail;?></button>
				<button class="btn btn-primary" id="sendEmail" style="display: none" onclick="myFunction()" name="sendEmail">Send Test Email</button>
				<button type="button" class="btn btn-info" id="testEmailSend"><?php echo $testemail;?></button>
				<button type="button" class="btn btn-info" id="scheduleEmail"><?php echo $scheduleemail;?></button>
				<button  class="btn btn-primary" name="schedule_email" style="display: none" id="scheduleEmailSend"><?php echo $scheduleemail;?></button><br><br><br><br><br><br><br><br><br>
				<div name="mainContent" class="content-main"  value="" ></div>
				</form>	
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	</div>
<iframe style="display:none; width:100%;  overflow: hidden;  min-height: 689px;" id="email-iframe" src="https://review-thunder.com/emailDragDrop/index.php"></iframe>

<div class="elements-db" style="display:none">
			<div class="tab-elements element-tab active">
				<ul class="elements-accordion">
					<?php echo $_outputHtml ?>
				</ul>
			</div>
		</div>
