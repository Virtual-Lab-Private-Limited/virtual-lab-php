<?php
include("connection.php");
session_start();

if(isset($_GET['add'])){

	$_SESSION['cart_'.$_GET['add']]=1;
	$bid=$_GET['bid'];
	header("location:edit_booking.php?id=".$bid);
}

if(isset($_GET['delete'])){

	$_SESSION['cart_'.$_GET['delete']]=0;
	$bid=$_GET['bid'];
	header("location:edit_booking.php?id=".$bid);
}


function cart(){
	$total=0;
	include("connection.php");
?>

<?php
error_reporting(0);
$num=1;
$totalamount=0;

global $bid;

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

<td ><?php echo $get_row['title'];?>
<input type="checkbox" name="index_number[]" value="<?php echo $num++;?>" checked class="hidden">
<input type="hidden" name="tid[]" value="<?php echo $get_row['id'];?>">
<input type="hidden" name="qty[]" value="<?php echo $value;?>">
</td>
<td ><?php echo $total_amount;?>
<input type="hidden" name="cost[]" value="<?php echo $total_cost;?>"></td>
<td >
<input type="hidden" name="price[]" value="<?php echo $t_amount;?>">

<a href="<?php echo $baseurl;?>edit-test-to-cart.php?delete=<?php echo $get_row['id'];?>&bid=<?php echo $bid;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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
<td ><strong>Net Total</strong></td>
<td >
<input type="text" name="total_price" id="total_price" class="form-control"  value="<?php echo $totalamount; ?>" readonly>
</td>
</tr>
<tr><td ><label>Discount:</label></td>
<td  ><input type="text" name="discount" id="discount" class="form-control" ></td>
<td  ><select name="discount_type" id="discount_type" class="form-control">
    <option value="<?php echo $discount_type; ?>" id="discount_type_option" ><?php echo $discount_type; ?></option>
    <option value="%">%</option>
    <option value="Rs">Rs</option>
</select></td></tr>
<tr><td ><label>Discounted Price:</label></td>
<td style="width:30px" ><input type="text" name="total" id="total" class="form-control" readonly>
</td>
</tr>
<tr><td ><label>Paid:</label></td>
<td  ><input type="text" style="width:80px" name="paid" id="paid" class="form-control" required></td>
</tr>
<tr>
<td colspan="4">
<input type="submit" name="submit" value=" Proceed to Checkout" class="btn btn-success">
</td>
</tr>
            <?php
}

?>