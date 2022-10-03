<?php
include("global.php");
$id=$_GET['id'];
mysqli_query($con,"update booking_details set approvedby='$session_id', status='Complete', runtime_status='Report Approved by Pathologist' where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."report/".$id);


?>