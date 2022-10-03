<?php
session_start();
include_once("connection.php");
include("frenchiseinfo.php");
//checking if the session are set
if(isset($_SESSION['username'])){
$session_username=$_SESSION['username'];
$session_pass=$_SESSION['pass'];
$session_id=$_SESSION['id'];
$session_role=$_SESSION['roleid'];
$session_email=$_SESSION['email'];
$session_contact=$_SESSION['contact'];
$session_firstname=$_SESSION['firstname'];
$session_lastname=$_SESSION['lastname'];
$session_labid=0;

	//check if the member is exist
    $query=mysqli_query($con,"SELECT * FROM members WHERE id='$session_id' AND password='$session_pass' LIMIT 1") or die (mysql_error());
    $count_count=mysqli_num_rows($query);
    
    if($count_count>0){
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