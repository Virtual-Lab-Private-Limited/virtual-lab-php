<?php
session_start();
session_destroy();
if(isset($_COOKIE['id_cookie'])){
setcookie("id_cookie","",time()-50000,"/");
setcookie("pass_cookie","",time()-50000,"/");	

	}
header("location:login.html");	
?>