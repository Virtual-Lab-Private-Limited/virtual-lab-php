<?php
session_start();
include_once("connection.php");

//checking if the session are set
if(isset($_SESSION['firstname'])){

$session_pass=$_SESSION['pass'];
$session_id=$_SESSION['id'];
$session_role=$_SESSION['role'];
$session_email=$_SESSION['email'];
$session_contact=$_SESSION['contact'];
$session_firstname=$_SESSION['firstname'];
$session_lastname=$_SESSION['lastname'];
$session_labid=$_SESSION['labid'];
$session_address=$_SESSION['address'];
$session_uid = $_SESSION['unique_id'];

//check if the member is exist
$query=mysqli_query($con,"SELECT * FROM collection_center WHERE id='$session_id' AND password='$session_pass'  LIMIT 1") or die (mysql_error());
$count_count=mysqli_num_rows($query);

$query2=mysqli_query($con,"SELECT * from members WHERE email='$session_email' and password='$session_pass' and status='Active' and member_type=6 LIMIT 1") or die (mysqli_error());
$count_query2=mysqli_num_rows($query2);

if($count_count>0 ||$count_query2>0){
	
	//logged in stuff here
	$logged=1;
}else{
header("Location:logout.php");
exit();	
}

}
else{
	//if the user is not logged in
	$logged=0;
		
		
	}
?>