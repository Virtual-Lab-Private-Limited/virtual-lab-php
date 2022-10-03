<?php
include("global.php");


$p_id = $_POST['parent'];
$groups = mysqli_query($con,"select * from groups where test_id=$p_id ") or die (mysqli_error()); ?>
<option value="0" selected>Select Group</option>
<?php
while($g=mysqli_fetch_array($groups)){
    
    $tests = mysqli_query($con,"select * from tests where id= $g[group_id] ") or die (mysqli_error());
    while($pt = mysqli_fetch_array($tests)){
    
?>

<option value="<?php echo $g['id'];?>"><?php echo $pt['title'];?></option>
<?php
}}
?>


