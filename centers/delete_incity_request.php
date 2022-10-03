<?php
include("connection.php");
$id=$_GET['id'];
mysqli_query($con,"delete from in_city_requests where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."in_city.php");

?>