
<?php


include("inc/head1.php");
include_once("includes/functions.php");
$user = new Users(); 
 $user->export();
 $user->export1();
?>

<div class="row col-sm-12">
<div class="col-sm-6">
<a href="allfacebookpageswithemail.csv" class="btn btn-primary">Download Csv File of allpages with email </a>
</div>
<div class="col-sm-6">
<a href="allfacebookpages.csv" class="btn btn-primary">Download Csv File of allpages without </a>
</div>
</div>

<div class="row col-sm-12">
<br>
<br>
<h1>Copy This Emails to Custom Audience Text Box</h1>
<textarea class="form-control" rows="10">
<?php
$user->emailszote();
?>
</textarea>
</div>
