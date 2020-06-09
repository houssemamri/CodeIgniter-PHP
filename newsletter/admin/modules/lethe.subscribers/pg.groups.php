<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 13.01.2014                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
$errText = '';
if(!isset($pgnt) || !$pgnt){die();}

/* Demo Check */
if(!isDemo('editGroups,mergeGroups')){$errText = errMod(letheglobal_demo_mode_active,'danger');}
$sourceLimit = calcSource(set_org_id,'subscriber.groups');

/* Navigation */
$pg_nav_buts = '';

/* Edit Groups */
if(isset($_POST['editGroups'])){

	$succText = '';

	/* Add New */
	if(limitBlock($sourceLimit,set_org_max_subscriber_group)){
		if(isset($_POST['new_group']) && !empty($_POST['new_group'])){
			
			$db->insert('subscriber_groups',array(
													'OID'=>set_org_id,
													'UID'=>LETHE_AUTH_ID,
													'group_name'=>trim($_POST['new_group']),
													'isUnsubscribe'=>0,
													'isUngroup'=>0
													));
			$succText.='* '. subscribers_new_group_added_successfully .'<br>';
		}
	}
	
	/* Update */
	if(isset($_POST['group_datas'])){
	
		@set_time_limit(0);
	
		$callLethe = new lethe();
		$callLethe->OID = set_org_id;
		
		$unGroupID = $db->where('isUngroup=1')->getOne('subscriber_groups');
		$unGroupID = $unGroupID['ID'];
		
		$remCamp = new lethe();
	
		foreach($_POST['group_datas'] as $k=>$v){
			/* Delete */
			if(isset($_POST['del_'.$v]) && $_POST['del_'.$v]=='YES'){
				/* Check System Groups */
				$db->where('OID=? AND ID=? AND (isUnsubscribe=1 OR isUngroup=1)',array(set_org_id,$v))->getOne('subscriber_groups');
				if($db->count==0){
					
					# Remove Subscribers
					$opSubs = $db->where('GID=?',array($v))->get('subscribers');
					$callLethe->SUGID = $v;
					foreach($opSubs as $opSubsRs){
						$callLethe->removeSubscription($opSubsRs['subscriber_mail']);
					}
					
					# Campaign Group Controls
					$grpCamp = $db->where('GID=?',array($v))->get('campaign_groups');
					foreach($grpCamp as $grpCampRs){
						# Get Campaigns
						$remCamp->OID = set_org_id;
						$remCamp->isCampID = $grpCampRs['CID'];
						$remCamp->removeCamp();
					}
					
					# Remove Form Fields (Groups Only)
					$grpField = $db->where('field_type=?',array('grpchoicer'))->get('subscribe_form_fields');
					foreach($grpField as $grpFields){
						$fieldData = array();
						$fieldData = json_decode($grpFields['field_type'],true);
						$newFieldData = array();
						if(count($fieldData)>0){
							foreach($fieldData as $kf=>$vf){
								if($kf==$v){
									# Remove Key
								}else{
									$newFieldData[$kf] = $vf;
								}
							}
							$fieldData = json_encode($newFieldData);
						}
						
						# Remove Field If There No Group
						if(count($newFieldData)==0){
							$dfd = array();
							$dfd[$unGroupID] = 'Ungroup';
							$fieldData = json_encode($dfd);
						}
						
						# Update Field
						$db->where('ID=?',array($grpFields['ID']))->update('subscribe_form_fields',array('field_data'=>$fieldData));
						
					}
					
					# Remove Forms (Set by ungroup)
					$db->where('form_group=?',array($v))->update('subscribe_forms',array('form_group'=>$unGroupID));
					
					# Remove Group
					$db->where('ID=?',array($v))->delete('subscriber_groups');
					
				}else{
					$succText.='* <strong>'. letheglobal_error .':</strong> '. subscribers_system_groups_could_not_be_deleted .'<br>';
				}
				
				
			}else{
			
			/* Update */
				$updVal = $_POST['grp_val_'.$v];
				if(strlen($updVal)<2){
					$succText.='* <strong>'. letheglobal_error .':</strong> '. subscribers_group_name_must_be_greater_than_2_character .'<br>';
				}else{
					$db->where('OID=? AND ID=?',array(set_org_id,$v));
					if(LETHE_AUTH_VIEW_TYPE){
						$db->where('UID=?',array(LETHE_AUTH_ID));
					}
					$db->update('subscriber_groups',array('group_name'=>$updVal));
				}
			
			}
		}
		
		$succText.='* '. letheglobal_updated_successfully .'<br>';
		$errText = errMod($succText,'success');
		
	}
	

}

/* Merge */
if(isset($_POST['mergeGroups'])){

	if(!isset($_POST['merge_src']) || !is_array($_POST['merge_src'])){$errText = '* '. subscribers_please_choose_source_groups .'<br>';}
	if(!isset($_POST['merge_dest']) || !is_numeric($_POST['merge_dest'])){$errText = '* '. subscribers_please_choose_destination_group .'<br>';}
	

	if($errText==''){
		/* Create Query */
		$mergList = array();
		$remList = array();
		$destGrp = intval($_POST['merge_dest']);
		foreach($_POST['merge_src'] as $k=>$v){
			$mergList[] = 'GID='.$v;
			if($_POST['merge_dest']!=$v){
				$remList[] = 'ID='.$v;
			}
		}
		
		$mergList = implode(' OR ',$mergList);

		/* Merge Now */
		$myconn->query("UPDATE ". db_table_pref ."subscribers SET GID=". intval($destGrp) ." WHERE OID=". set_org_id ." AND (". $mergList .")") or die(mysqli_error($myconn));
		$succText = subscribers_groups_merged_successfully;
		
		/* Remove Older Groups */
		if(isset($_POST['remSrc']) && $_POST['remSrc']=='YES'){
			$remList = implode(' OR ',$remList);
			if($remList!=''){
				$myconn->query("DELETE FROM ". db_table_pref ."subscriber_groups WHERE OID=". set_org_id ." AND isUnsubscribe=0 AND isUngroup=0 AND (". $remList .")") or die(mysqli_error($myconn));
				$succText.='<br>'.subscribers_source_groups_removed;
			}
		}
		
		$errText = errMod($succText,'success');
	}else{
		$errText = errMod($errText,'danger');
	}

}
?>

<?php 
		echo('<h1>'. $pg_title .'<span class="help-block"><span class="text-primary">'. subscribers_groups .'</span></span></h1><hr>'.
			  $pg_nav_buts.
			  $errText
			 );
?>

	<div class="form-group">
		<?php 
		echo('<div class="row">
				<div class="col-md-3"><div class="form-group"><label>'. letheglobal_limits .'</label><span class="clearfix"></span>'. getMyLimits($sourceLimit,set_org_max_subscriber_group) .'</div></div>
			   </div>');
		?>
	</div>
	
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-info sHide">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
          <?php echo(subscribers_merge_groups);?>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
			<form method="POST" action=""> 
			<?php 
			/* Get Group Cache */
			$mrGrp = array();
			$opGrp = $myconn->query("SELECT * FROM ". db_table_pref ."subscriber_groups WHERE OID=". set_org_id ." AND isUnsubscribe=0 AND isUngroup=0 ". ((LETHE_AUTH_VIEW_TYPE) ? ' AND UID='. LETHE_AUTH_ID .'':'') ." ORDER BY group_name ASC") or die(mysqli_error($myconn));
			$grpCnt = mysqli_num_rows($opGrp);
			while($opGrpRs = $opGrp->fetch_assoc()){
				$mrGrp[$opGrpRs['ID']] = $opGrpRs['group_name'];
			} $opGrp->free();
			if($grpCnt>1){
			?>
			
				<div class="form-group">
					<label for="merge_dest"><?php echo(sh('Pw35uUlc5T').subscribers_destination);?></label>
					<select class="form-control autoWidth" name="merge_dest" id="merge_dest">
						<?php foreach($mrGrp as $k=>$v){echo('<option value="'. $k .'">'. showIn($v,'page') .' ('. cntData("SELECT ID FROM ". db_table_pref ."subscribers WHERE OID=". set_org_id ." AND GID=". intval($k) ."") .')</option>');}?>
					</select>
				</div>
				<div class="form-group">
					<label for="merge_dest"><?php echo(sh('2FltmsgExe').subscribers_sources);?></label>
					<select class="form-control autoWidth" name="merge_src[]" id="merge_src" multiple>
						<?php foreach($mrGrp as $k=>$v){echo('<option value="'. $k .'">'. showIn($v,'page') .' ('. cntData("SELECT ID FROM ". db_table_pref ."subscribers WHERE OID=". set_org_id ." AND GID=". intval($k) ."") .')</option>');}?>
					</select>
				</div>
				<div class="form-group">
					<span><?php echo(sh('eZUhfGarpp'));?></span><label for="remSrc"><?php echo(subscribers_remove_sources_after_merging);?></label>
					<input type="checkbox" class="ionc" id="remSrc" name="remSrc" value="YES">
				</div>
				<div class="form-group">
					<button type="submit" name="mergeGroups" id="mergeGroups" class="btn btn-primary"><span class="glyphicon glyphicon-link"></span> <?php echo(subscribers_merge);?></button>
				</div>
			<?php } else{echo(errMod(subscribers_two_or_more_groups_required,'danger'));}?>

			</form>
      </div>
    </div>
  </div>
  
<form method="POST" action="">
<?php if(limitBlock($sourceLimit,set_org_max_subscriber_group)){?>
  <div class="panel panel-warning">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          <?php echo(subscribers_add_new_group);?>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
			<div class="row">
				<div class="col-md-12"><div class="form-group"><input type="text" value="" class="form-control" name="new_group" id="new_group" placeholder="<?php echo(subscribers_group_name);?>"></div></div>
			</div>
			<div class="form-group">
				<hr>
				<button name="editGroups" class="btn btn-primary" type="submit"><?php echo(letheglobal_save);?></button>
			</div>
      </div>
    </div>
  </div>
<?php }?>
  <div class="panel panel-success">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <?php echo(subscribers_groups);?> (<span class="total-cntr"></span>)
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">        

			<?php 
			$grpCntr = 0;
			$opGroup = $myconn->query("SELECT * FROM ". db_table_pref ."subscriber_groups WHERE OID=". set_org_id ." ". ((LETHE_AUTH_VIEW_TYPE) ? ' AND UID='. LETHE_AUTH_ID .'':'') ." ORDER BY group_name ASC") or die(mysqli_error($myconn));
			while($opGroupRs = $opGroup->fetch_assoc()){
			$grpCount = cntData("SELECT ID FROM ". db_table_pref ."subscribers WHERE GID=". $opGroupRs['ID'] ."");
			$grpCntr = (int)($grpCntr + $grpCount);
			?>
			<div class="row">
				<div class="col-md-1"><div title="<?php echo(letheglobal_delete);?>" class="form-group tooltips"><label for="del_<?php echo($opGroupRs['ID']);?>"><span class="visible-xs"><?php echo(letheglobal_delete);?></span></label><input type="checkbox" name="del_<?php echo($opGroupRs['ID']);?>" id="del_<?php echo($opGroupRs['ID']);?>" value="YES" class="ionc"<?php echo(($opGroupRs['isUnsubscribe'] || $opGroupRs['isUngroup']) ? ' disabled':'');?>></div></div>
				<div class="col-md-1"><span class="label label-info"><?php echo($grpCount);?></span></div>
				<div class="col-md-10"><div class="form-group"><input type="text" value="<?php echo(showIn($opGroupRs['group_name'],'input'));?>" class="form-control input-sm" name="grp_val_<?php echo($opGroupRs['ID']);?>" id="grp_val_<?php echo($opGroupRs['ID']);?>"></div></div>
				<input type="hidden" name="group_datas[]" value="<?php echo($opGroupRs['ID']);?>">
				<hr class="visible-xs">
			</div>
			<?php } $opGroup->free();?>
			<div class="alert alert-danger">
				<?php echo(subscribers_be_careful_to_remove_groups_campaigns_tasks_and_reports_will_be_removed);?>
			</div>
			<div class="form-group">
				<hr>
				<button name="editGroups" class="btn btn-primary" type="submit"><?php echo(letheglobal_save);?></button>
			</div>
			<script src="Scripts/jquery.countTo.js"></script>
			<script>
				$(document).ready(function(){
					$('.total-cntr').countTo({
						from:0,
						to:<?php echo($grpCntr);?>,
						speed: 1000
					});
				});
			</script>
      </div>
    </div>
  </div>
</form>
</div>