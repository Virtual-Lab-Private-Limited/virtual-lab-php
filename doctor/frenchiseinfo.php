<?php
$websites=mysqli_query($con,"select * from frenchise_doctor where id='$session_labid' limit 1") or die (mysqli_error($con));
while($web=mysqli_fetch_array($websites)){
	$basetitle=$web['firstname'];
	$basephone=$web['contact'];
	$baseemail=$web['email'];
	$basepath=$web['path'];

}

?>