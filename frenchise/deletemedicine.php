<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}$id=$_GET['id'];
mysqli_query($con,"delete from medicines where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."medicines.html");

?>