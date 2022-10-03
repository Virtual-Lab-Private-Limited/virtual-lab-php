<?php
include("connection.php");
session_start();

if(isset($_GET['add'])){
	//$add=$_GET['add'];
	$_SESSION['cart_'.$_GET['add']]=1;
    $pid=$_GET['id'];
	header("location:add_package.php?id=".$pid." ");
}


if(isset($_GET['delete'])){
	//$add=$_GET['add'];
	$_SESSION['cart_'.$_GET['delete']]=0;
	$pid=$_GET['id'];
	header("location:add_package.php?id=".$pid." ");
}


function cart(){
	$total=0;
	include("connection.php");
?>

<?php
error_reporting(0);
$num=1;
$total_price=0;

global $pid;

foreach ($_SESSION as $name=> $value){
	if($value>0){
    	if($cart=substr($name,0,5)=='cart_'){
    	    
            $id=substr($name, 5, (strlen($name)-5));
        
            $package = mysqli_query($con,"select * from packages where id='$id'") or die (mysqli_error($con));
            while($row=mysqli_fetch_array($package)){
               $packageid=$row['id'];
               $title=$row['title'];
               $package_price=$row['price'];
            }
            if (mysqli_num_rows($package) > 0 ){ ?>
                
            <tr>
                <td colspan="5" style="font-weight:bold"><strong><input type="hidden" value="<?php echo $id; ?>" name="packages[]" > <?php echo $title;?> </strong></td>
                <td class="text-center"><?php echo $package_price;?></td>
                <td><a href="<?php echo $baseurl;?>package-to-cart.php?delete=<?php echo $packageid;?>&id=<?php echo $pid;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                </td>
            </tr>
            <?php }
            ?>
   
            
            <?php
 
            $package_details = mysqli_query($con,"select * from package_details where packageid='$packageid'") or die (mysqli_error($con));
            while($get_row=mysqli_fetch_array($package_details)){
            $tid=$get_row['testid'];
            
            $test=mysqli_query($con,"select * from tests where id='$tid'") or die (mysqli_error($con));
            while($get_row=mysqli_fetch_assoc($test)){
            $price=$get_row['price'];
            $cost=$get_row['cost'];
            $total_amount= ($price * $value);
            $discount_type=$get_row['discount_type'];

?>

<tr>

<td colspan="5"><?php echo $get_row['title'];?>
<input type="checkbox" name="index_number[]" value="<?php echo $num++;?>" checked class="hidden">
<input type="hidden" name="tid[]" value="<?php echo $get_row['id'];?>">
<input type="hidden" name="qty[]" value="<?php echo $value;?>">
</td>
<td class="text-center">
<input type="hidden" name="cost[]" value="<?php echo $total_cost;?>"></td>
<td class="text-center">
<input type="hidden" name="price[]" value="<?php echo $t_amount;?>">

</td>
 </tr>

<?php }}
    	    
    	    $total_price += $package_price;
    	}}

else {
	
$message= "Your Cart is Empty";	
}
}
?>


<tr>
<td colspan="5" style="font-weight:bold">Total Amount</td>
<td class="text-center" ><?php echo number_format($total_price,2);?>
<input type="hidden" name="total_price" value="<?php echo $total_price;?>">

</td>
</tr>

<td colspan="4">
<input type="submit" name="submit" value=" Proceed to Checkout" class="btn btn-success">
</td>
</tr>
            <?php
}



?>