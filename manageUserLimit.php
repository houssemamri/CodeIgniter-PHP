<?php
if(isset($_POST['set'])){
	//print_r($_POST);die();
	extract($_POST);
	$sqlUpdateMasterTable = "UPDATE Master SET total_ac = '".$limit."' WHERE subID = '".$companyId."' AND MasterID = '".$_SESSION['master_id']."' ";
}
//echo $sqlUpdateMasterTable;
	$resultUpdateTable = $conn->query($sqlUpdateMasterTable);

?>



<div class="contaainer">
	<div class="row">
		<div class="col-md-12">
			<form action="" method="post">
				<div class="form-group">
				<label for="company">Company Name</label>
					<select name="companyId" required="" id="company" class="form-control">
					<option value="">Select Company Name</option>
					<?php
					 $sqlUserCompanyName="SELECT ut.* FROM UserTable as ut left join Master as mt on mt.subID = ut.UID WHERE mt.MasterID = '".$_SESSION['master_id']."'";  
					 $resultUserCompanyName=$conn->query($sqlUserCompanyName);
					 /*$rowUserCompanyName=$resultUserCompanyName->fetch_assoc();
					 echo "<pre>";
					 print_r($rowUserCompanyName);die("here");*/
                    while( $rowUserCompanyName=$resultUserCompanyName->fetch_assoc())
                    {
						
					 ?>
						<option value="<?php echo $rowUserCompanyName['UID'];?>"><?php echo $rowUserCompanyName['Company'];?></option>
						
					<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Limit</label>
					<input type="number" class="form-control" placeholder="Enter User Limit"  value="" required="" name="limit" />
				</div>
				<input type="submit" class="btn btn-primary" name="set" value="Set" />
			</form>
		</div>
	</div>
</div>