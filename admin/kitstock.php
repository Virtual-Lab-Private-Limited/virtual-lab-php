<?php
include("global.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
$qty=mysqli_real_escape_string($con,$_POST['qty']);
$kitid=mysqli_real_escape_string($con,$_POST['kitid']);

$query_kits=mysqli_query($con,"select * from kit_stocks where labid='$session_id' and kitid='$kitid' and qty='$qty' and purchase_date=now() limit 1") or die (mysqli_error($con));

$count_kits=mysqli_num_rows($query_kits);
if($count_kits>0){
$message='<font color="red"><p align="center">The Following Kit is already Exist</p></font>';	
}else{

mysqli_query($con,"insert into kit_stocks(kitid,qty,purchase_date,labid) values ('$kitid','$qty',now(),'$session_labid')") or die (mysqli_error($con));

header("location:".$baseurl."add_stock/".$kitid.".html");

}
}



?>