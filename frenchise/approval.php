<?php
include("connection.php");
include("frenchiseinfo.php");
if(isset($_POST['submit'])){
	$tid=$_POST['tid'];
	$transactionid=$_POST['transactionid'];
mysqli_query($con,"update withdrawl_request set status='Approved', transactionid='$transactionid', payment_date=now() where id='$tid' limit 1") or die (mysqli_error());
header("location:".$baseurl."request/".$tid.".html");	
	
}

?>