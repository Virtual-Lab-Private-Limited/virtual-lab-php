<?php
include("connection.php");
$id=$_GET['id'];
mysqli_query($con,"delete from out_city_requests where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."out_city.php");

?>