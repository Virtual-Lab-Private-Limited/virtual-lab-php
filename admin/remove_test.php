<?php
include("connection.php");
$id=$_GET['id'];
$pid=$_GET['pid'];
mysqli_query($con,"delete from package_details where id='$id' and packageid='$pid' limit 1") or die (mysqli_error($con));
header("location:".$baseurl."pack/".$pid.".html");



?>