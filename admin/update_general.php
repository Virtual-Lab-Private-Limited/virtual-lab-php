<?php
include("global.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$title=mysqli_real_escape_string($con,$_POST['title']);
	$tagline=mysqli_real_escape_string($con,$_POST['meta']);
	$keywords=mysqli_real_escape_string($con,$_POST['keywords']);
	$description=mysqli_real_escape_string($con,$_POST['description']);
	$phone=mysqli_real_escape_string($con,$_POST['contact']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$google=mysqli_real_escape_string($con,$_POST['google']);
	$discount=mysqli_real_escape_string($con,$_POST['discount']);

$name=basename($_FILES['file_upload']['name']);
$t_name=$_FILES['file_upload']['tmp_name'];
$dir='../images';	
if(move_uploaded_file($t_name,$dir.'/'.$name)){
	mysqli_query($con,"update webinfo set title='$title',meta='$tagline',keywords='$keywords',description='$description',contact='$phone',email='$email',path='images/$name',address='$address',google='$google',discount='$discount' ") or die (mysqli_error());
	header("location:".$baseurl."general.html");
}else{
	mysqli_query($con,"update webinfo set title='$title',meta='$tagline',keywords='$keywords',description='$description',contact='$phone',email='$email',address='$address',google='$google',discount='$discount' ") or die (mysqli_error());
	header("location:".$baseurl."general.html");
}
	
	
	
}

?>