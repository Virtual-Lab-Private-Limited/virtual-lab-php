<?php
$websites=mysqli_query($con,"select * from frenchises where id='$session_id' limit 1") or die (mysqli_error($con));
while($web=mysqli_fetch_array($websites)){
	$basetitle=$web['username'];
	$basephone=$web['contact'];
	$baseemail=$web['email'];
	$basepath=$web['path'];

}




?>