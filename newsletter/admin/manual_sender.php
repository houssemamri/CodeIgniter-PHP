<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 31.10.2014                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lethe.php');
include_once(LETHE.DIRECTORY_SEPARATOR.'/lib/lethe.class.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/inc_module_loader.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/inc_auth.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/org_set.php');

$ID = ((!isset($_GET['ID']) || !is_numeric($_GET['ID'])) ? 0:intval($_GET['ID']));
$campErr = true;
$opCampSet = $myconn->query("SELECT 
									*
							   FROM 
										". db_table_pref ."campaigns
							  WHERE 
										ID = ". $ID ." 
								AND 
										OID=". set_org_id ."
								". ((LETHE_AUTH_VIEW_TYPE) ? ' AND UID='. LETHE_AUTH_ID .'':'') ."
										
										") or die(mysqli_error($myconn));
if(mysqli_num_rows($opCampSet)>0){
	$campErr = false;
	$opRecsRs = $opCampSet->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('inc/inc_meta.php');?>
</head>
<body>
<!-- page content -->
<?php if($campErr){echo(errMod(letheglobal_record_not_found,'danger'));}else{?>
<div class="container-fluid">
<div class="row">
<nav class="navbar navbar-default">
  <div class="container">
    <p class="navbar-text">
		<span style="max-width:300px; overflow:hidden;"><?php echo(showIn($opRecsRs['subject'],'page'));?></span>
		<span class="pull-right"><a href="javascript:;" onclick="window.location.reload();"><span class="glyphicon glyphicon-refresh"></span></a></span>
	</p>
  </div>
</nav>
</div>
</div>

<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<iframe src="<?php echo(lethe_root_url.'chronos/lethe.tasks.php?ID='.$opRecsRs['ID']);?>" style="border:0px #FFFFFF none; width:100%; height:400px" name="lethe" id="lethe" scrolling="yes" frameborder="0" marginheight="0px" marginwidth="0px" height="400" width="100%"></iframe>
</div>
</div>
</div>

<!-- page end -->
<script>
$(document).ready(function(){
	//setTimeout(function() { lethe.location.reload(true);},30000);
});
</script>
<?php }?>
<script src="Scripts/jquery-ui.min.js"></script>
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<script src="Scripts/ion.checkRadio.min.js"></script>
<script src="Scripts/jquery.switchButton.js"></script>
<script src="Scripts/jquery.fancybox.pack.js"></script>
<script src="Scripts/lethe.min.js"></script>
</body>
</html>