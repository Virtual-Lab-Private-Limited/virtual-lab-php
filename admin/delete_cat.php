<?php
include("connection.php");
$id=$_GET['id'];
mysqli_query($con,"delete from categories where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."test_categories.html");

?>