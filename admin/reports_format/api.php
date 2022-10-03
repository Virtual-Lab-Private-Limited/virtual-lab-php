<?php
header("Access-Control-Allow-Origin: *");


$con=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");
$culture_id = $_REQUEST['culture_id']; 

$result = mysqli_query($con,"select *  from medicines where culture_id = '$culture_id'") or die (mysqli_error($con));

//--------------------------------------------------------------------------
// 3) echo result as json 
//--------------------------------------------------------------------------

$i = 0;
while($data = mysqli_fetch_array($result))
{   
    $title = $data['title'];
    $count = ++$i;
    echo "<tr>";
    echo "<td align=center>$count</td>";
    echo "<td align=center><input type='text' value='$title' class='form-control' name='meds[]' readonly></td>";
    echo "<td align=center><select name='intensity[]' class='form-control'><option value='S'>Sensitive</option><option value='R'>Resistent</option><option value='I'>Intermediate</option></select></td>";
    echo "</tr>";
} 



?>