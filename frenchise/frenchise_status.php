<?php
include("connection.php");
$id=$_GET['id'];
$status=$_GET['status'];

if($status=='Active'){
	mysqli_query($con,"update webinfo set status='Disable' where id='$id' limit 1") or die (mysqli_error());
	
	mysqli_query($con,"update members set status='Disable' where labid='$id'") or die (mysqli_error());	
	header("location:frenchiselist.html");
}if($status=='Disable'){
		mysqli_query($con,"update webinfo set status='Active' where id='$id' limit 1") or die (mysqli_error());
	
	mysqli_query($con,"update members set status='Active' where labid='$id'") or die (mysqli_error());	
		header("location:frenchiselist.html");
	
	
}



?>