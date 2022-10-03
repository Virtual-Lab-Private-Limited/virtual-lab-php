<?php
$websites=mysqli_query($con,"select * from webinfo where id='$session_labid' limit 1") or die (mysqli_error($con));
while($web=mysqli_fetch_array($websites)){
	$basetitle=$web['title'];
	$basetagline=$web['meta'];
	$basekeywords=$web['keywords'];
	$basedescription=$web['description'];
	$basephone=$web['contact'];
	$baseemail=$web['email'];
	$basepath=$web['path'];
	$baseaddress=$web['address'];
	$google=$web['google'];
	$city=$web['cityid'];
	$phc=$web['phc'];
	$discount=$web['discount'];
}
