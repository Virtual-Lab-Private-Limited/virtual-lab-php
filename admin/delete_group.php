<?php
include("connection.php");
$id=$_GET['id'];
$tid=$_GET['tid'];
mysqli_query($con,"delete from groups where id='$id' limit 1") or die (mysqli_error());
header("location:".$baseurl."groups.php?id=$tid");

?>