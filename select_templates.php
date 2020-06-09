<?php
session_start();
include_once "connection.php";
include_once "common_function.php";
include_once 'email/includes/db.class.php';
session_start();
$db = new Db();

?>
<style>
    .dataTables_length select{
        float: unset;
        width: unset !important;
        border: unset;
    }
</style>
<div class="col-lg-9">
	<div class="row">
	<div class="col-lg-12" style="text-align: center; margin-bottom: 4%">
		<h1>Templates</h1>
	</div>
		<div class="container">
			<div class="row">
                <div class="col-md-12">

                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Template</th>
                                <th>Qty</th>
                                <th>Created at</th>
                                <th>Programmed at</th>
                                <th>status</th>
                            </tr>
                        </thead>
<!--                         <tbody>-->
			<?php 
//			$sql_email = "SELECT * FROM templates WHERE UserId=".$_SESSION['user_id'];
//			$query_email = mysqli_query($conn,$sql_email);
//			while($result = mysqli_fetch_object($query_email)){ ?>
<!--			        <tr>-->
<!--                        <th>--><?php //echo $result->id;?><!--</th>-->
<!--                        <th>--><?php //echo $result->name;?><!--</th>-->
<!--                        <th>--><?php //echo $result->qty;?><!--</th>-->
<!--                        <th>--><?php //echo $result->created_at;?><!--</th>-->
<!--                        <th>--><?php //echo $result->programmed_at;?><!--</th>-->
<!--                        <th>--><?php //echo $result->status;?><!--</th>-->
<!--                    </tr>-->
<!--				--><?php //} ?>
<!--                         </tbody>-->
                    </table>
                    <script>
                    $(document).ready(function() {
                        var table = $('#example').DataTable( {
                            "columns": [
                                {
                                    "className":      'details-control',
                                    "orderable":      false,
                                    "data":           null,
                                    "defaultContent": ''
                                },
                                { "data": "name" },
                                { "data": "position" },
                                { "data": "office" },
                                { "data": "salary" }
                            ],
                            "order": [[1, 'asc']]
                        } );

                        // Add event listener for opening and closing details
                        $('#example tbody').on('click', 'td.details-control', function () {
                            var tr = $(this).closest('tr');
                            var row = table.row( tr );

                            if ( row.child.isShown() ) {
                                // This row is already open - close it
                                row.child.hide();
                                tr.removeClass('shown');
                            }
                            else {
                                // Open this row
                                row.child( format(row.data()) ).show();
                                tr.addClass('shown');
                            }
                        } );
                    } );
                    </script>
			</div>
		</div>
	</div>
    </div>
</div>
<?php
$sql_email = "SELECT * FROM templates WHERE UserId=".$_SESSION['user_id'];
			$query_email = mysqli_query($conn,$sql_email);
			while($result = mysqli_fetch_object($query_email)){ ?>

			<div class="modal fade" id="changeName<?php echo $result->id;?>" tabindex="-1" role="dialog" aria-labelledby="changeName<?php echo $result->id;?>" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $change_template_name;?></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                       <input type="text" hidden id="hiddenid<?php echo $result->id;?>" value="<?php echo $result->id;?>" />
                       <label for="name"><?php echo $template_name;?>: </label> <input type="text" name="temp_name" id="tempName<?php echo $result->id;?>" value="<?php echo $result->name;?>"/>
                       <br /><br />
                       <button type="button" class="btn btn-primary" onclick="updateTempName('<?php echo $result->id;?>');"><?php echo $updateBtn;?></button>
                       <br /><br />
                     </div>
                     <div class="modal-footer">
                       <button type="button"  class="btn btn-secondary" data-dismiss="modal"><?php echo $clsbtn;?></button>
                     </div>
                   </div>
                 </div>
               </div>


			<div class="modal fade" id="sendEmail<?php echo $result->id;?>" tabindex="-1" role="dialog" aria-labelledby="sendEmail<?php echo $result->id;?>" aria-hidden="true">
                 <div class="modal-dialog" role="document">
                   <div class="modal-content">
                     <div class="modal-header">
                       <h5 class="modal-title" id="exampleModalLabel"><?php echo $select_template_modal_heading;?></h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                       </button>
                     </div>
                     <div class="modal-body">
                     <form action="" method="post">
                       <input type="text" hidden id="hiddenid<?php echo $result->id;?>" value="<?php echo $result->id;?>" />				
                       	<label for="email"><?php echo $select_template_email_id;?>: </label>
                       	
                       	<select class="js-example-basic-multiple-template" id="listId" name="lists_ids[]" multiple="multiple">

<?php 

//$sql = "SELECT * FROM emaillistmain where UID=".'1';
$sqlEmails = "SELECT * FROM EmailListMain WHERE UID='".$_SESSION['user_id']."'";
//echo $sql;die("here");
$queryEmails = mysqli_query($conn,$sqlEmails);
//$result = mysqli_fetch_object($query);
//print_r($result);die("here");
while($resultEmails = mysqli_fetch_object($queryEmails)){

?>

						  <option  value="<?php echo $resultEmails->LID;?>"><?php echo $resultEmails->ListName;?></option>
<?php } ;?>						  
					</select>
                       
                       <br /><br />
                       <label for="subject"><?php echo $select_template_subject;?>: </label> <input type="text" name="subject" id="subject<?php echo $result->id;?>" value=""/>
                       <br /><br />
                       <label for="name"><?php echo $select_template_template_name;?>: </label> <input type="text" name="temp_name" id="tempName<?php echo $result->id;?>" value="<?php echo $result->name;?>"/>
                       <br /><br />
                       <button type="button" class="btn btn-primary" onclick="sendEmail('<?php echo $result->id;?>');"><?php  echo $send_sms_button;?></button>
                       <br /><br />
                       </form>
                     </div>
                     <div class="modal-footer">
                       <button type="button"  class="btn btn-secondary" data-dismiss="modal"><?php echo $clsbtn;?></button>
                     </div>
                   </div>
                 </div>
               </div>

<?php 
}
?>