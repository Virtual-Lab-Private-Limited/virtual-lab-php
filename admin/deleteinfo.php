<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];
$sid=$_GET['cid'];
mysqli_query($con,"delete from culture_info where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."add_culture/". $sid.".html");

?>