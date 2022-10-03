<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$bookings=mysqli_query($con,"select * from bookings where id='$id' and profit_status='pending' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){
  $bookingid=$info['bookingno'];
  $riderid=$info['bookby'];
  $labid=$info['labid'];
  $total_amount=$info['total_amount'];
  
}
$riders=mysqli_query($con,"select * from members where id='$riderid' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($riders)){
 $rider_ratio=$info['salary'];
}
$labs=mysqli_query($con,"select * from webinfo where id='$labid' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($labs)){
 $lab_ratio=$info['profit_ratio'];
}
	
	$rider_profit=$total_amount*$rider_ratio/100;
	$lab_profit=$total_amount*$lab_ratio/100;
	$company_profit=$total_amount-$rider_profit-$lab_profit;

$lab_profits=mysqli_query($con,"select * from profit_distribution where labid='$labid' and bookingid='$id' limit 1") or die (mysqli_error());
$count_lab=mysqli_num_rows($lab_profits);


$rider_profits=mysqli_query($con,"select * from rider_profit where bookingid='$id' limit 1") or die (mysqli_error());
$count_rider=mysqli_num_rows($rider_profits);

if($count_lab>0){
	
}else if($count_rider>0){
	
}else{
	mysqli_query($con,"insert into profit_distribution (labid,amount,distribution_date,bookingid)values('$labid','$lab_profit',now(),'$id')") or die (mysqli_error());
	
	
	mysqli_query($con,"insert into rider_profit (staffid,amount,paid_date,bookingid)values('$riderid','$rider_profit',now(),'$id')") or die (mysqli_error());
	
	
	mysqli_query($con,"insert into company_profit (bookingid,amount,distribution_date)values('$id','$company_profit',now())") or die (mysqli_error());
	
	mysqli_query($con,"update bookings set profit_status='Distributed' where id='$id' limit 1") or die (mysqli_error());
	
	header("location:".$baseurl."byrider.html");
}

?>