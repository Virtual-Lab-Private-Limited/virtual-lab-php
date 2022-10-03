<?php
include("connection.php");
session_start();
$page='cart.php';
if(isset($_GET['add'])){
	//$add=$_GET['add'];
	$_SESSION['cart_'.$_GET['add']]=1;
	$pid=$_GET['pid'];
	header("location:add_test/".$pid.".html");
}

if(isset($_GET['remove'])){
	//$add=$_GET['add'];
	$_SESSION['cart_'.$_GET['remove']]-=1;	
	header("location:cart.html");
}
if(isset($_GET['delete'])){
	//$add=$_GET['add'];
	$_SESSION['cart_'.$_GET['delete']]=0;
		$pid=$_GET['pid'];
	header("location:patient_list.html");
}


function cart(){
	$total=0;
	include("connection.php");
?>

<?php
error_reporting(0);
$num=1;
$totalamount=0;

foreach ($_SESSION as $name=> $value){
	if($value>0){
    	if($cart=substr($name,0,5)=='cart_'){
            $id=substr($name, 5, (strlen($name)-5));
            $products=mysqli_query($con,"select * from tests where id='$id'") or die (mysqli_error($con));
            while($get_row=mysqli_fetch_assoc($products)){
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
<td class="text-center"><?php echo $total_amount;?>
<input type="hidden" name="cost[]" value="<?php echo $total_cost;?>"></td>
<td class="text-center">
<input type="hidden" name="price[]" value="<?php echo $t_amount;?>">

<a href="<?php echo $baseurl;?>test-to-cart.php?delete=<?php echo $get_row['id'];?>&pid=<?php echo $pid;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
</td>
                        </tr>

<?php

                
            }
$totalamount += $total_amount;

    	}}

else {
	
$message= "Your Cart is Empty";	
}
}
?>


<tr>
<td colspan="5"><strong>Total Amount</strong></td>
<td class="text-center" ><?php echo number_format($totalamount,2);?>
<input type="hidden" name="total_price" value="<?php echo $totalamount;?>">

</td>
</tr>
<tr><td colspan="5"><label>Discount:</label></td>
<td style="width:30px" ><input type="text" name="discount" class="form-control"></td>
<td  ><select name="discount_type" class="form-control">
    <option value="%">%</option>
    <option value="Rs">Rs</option>
</select></td></tr>
<tr>
<td colspan="4">
<input type="submit" name="submit" value=" Proceed to Checkout" class="btn btn-success">
</td>
</tr>
            <?php
}



?>