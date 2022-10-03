<?php
include("connection.php");
$id=$_GET['id'];
mysqli_query($con,"delete from exams where id='$id' limit 1") or die (mysqli_error());
header("location:questions.html");


?>