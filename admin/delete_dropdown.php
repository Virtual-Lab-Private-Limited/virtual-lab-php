<?php
include("connection.php");
$id=$_GET['id'];
$tid=$_GET['tid'];
mysqli_query($con,"delete from test_dropdowns where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."add_dropdown/".$tid.".html");

?>