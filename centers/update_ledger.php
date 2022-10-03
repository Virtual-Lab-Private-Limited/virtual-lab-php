<?php
include("global.php");
    $id = $_GET['id'];
    $d_id = $_GET['d_id'];
	mysqli_query($con,"update doctor_earnings set paid=1 where id='$id' limit 1") or die (mysqli_error());
	header("location:".$baseurl."ledger.php?id=$d_id");

?>