<?php
session_start();
include_once("connection.php");

//checking if the session are set
if(isset($_SESSION['role'])){
$session_username=$_SESSION['username'];
$session_pass=$_SESSION['pass'];
$session_id=$_SESSION['id'];
$session_labid=$_SESSION['id'];
$session_email=$_SESSION['email'];
$session_contact=$_SESSION['contact'];
$session_username=$_SESSION['username'];
$session_city=$_SESSION['city'];
$session_role=$_SESSION['role'];
$session_outsource=$_SESSION['outsource'];
$session_logo=$_SESSION['logo'];
$session_address=$_SESSION['address'];

//check if the member is exist
$query=mysqli_query($con,"SELECT *FROM frenchises WHERE id='$session_id' AND password='$session_pass'  LIMIT 1") or die (mysql_error($con));
$count_count=mysqli_num_rows($query);
$query2=mysqli_query($con,"SELECT * from members WHERE email='$session_email' and password='$session_pass' and status='Active' and member_type=5 LIMIT 1") or die (mysqli_error($con));
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