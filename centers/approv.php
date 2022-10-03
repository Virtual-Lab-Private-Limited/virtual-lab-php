<?php
include("connection.php");
include("frenchiseinfo.php");
$id=$_GET['id'];
$uid=$_GET['uid'];
mysqli_query($con,"update investments set status='Approved' where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."add_investment/".$uid.".html");



?>