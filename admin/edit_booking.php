<?php
include "global.php";
include "frenchiseinfo.php";
if ($logged == 0) {
    header("location:" . $baseurl . "login.html");
    exit();
}
include "edit-test-to-cart.php";
$bid = $_GET['id'];
$booking = mysqli_query($con, "select * from bookings where id='$bid' limit 1") or die(mysqli_error());
while($book=mysqli_fetch_array($booking)){
	$bookingno=$book['bookingno'];	
	$total_bill=$book['total_cost'];	
	$discount=$book['discount'];	
	$discount_type=$book['discount_type'];	
	$passport_no=$book['pass_no'];	
	$flight_no=$book['flight_no'];	
	$flight_date=$book['flight_date'];	
	$ticket_no=$book['ticket_no'];	
	$sample_collect=$book['sample_collect'];	

    $patients=mysqli_query($con,"select *  from patients where id='".$book['uid']."'  limit 1") or die (mysqli_error());
    
    while ($info = mysqli_fetch_array($patients)) {
        $pid = $info['id'];
        $firstname = $info['firstname'];
        $lastname = $info['lastname'];
        $cnic = $info['cnic'];
        $contact = $info['contact'];
        $address = $info['address'];
        $city = $info['city'];
        $dob = $info['dob'];
        $age = $info['age'];
        $blood_group = $info['blood_group'];
    
    }
    
     
}

if(isset($_GET['delete'])){

	$bdid=$_GET['delete'];
	$bid=$_GET['bid'];
	$price=$_GET['tprice'];
    $total_bill=$_GET['bill'];
	$tcost = $total_bill - $price;

	if ($discount_type == "%"){
      $percent =   $tcost * ($discount/100);
      $tprice = $tcost - $percent;
    }else{
      $tprice = $tcost - $discount;
    }
	mysqli_query($con,"delete from booking_details where id='".$bdid."' ") or die (mysqli_error());
 	mysqli_query($con,"update bookings set total_cost='$tcost', total_amount='$tprice' where id='".$bid."' ") or die (mysqli_error());

	header("location:edit_booking.php?id=".$bid);
}


if (isset($_POST['submit'])) {
   
    $tprice = $_POST['total'];
    $uid = $_POST['pid'];
    $doctorid = $_POST['doctor'];
    $sample = $_POST['sample_collect'];
    $cc_no = "";
    $scheduled_date = $_POST['scheduled_date'];
    $scheduled_time = $_POST['scheduled_time'];
    $pass_no = $_POST['pass_no'];
    $flight_no = $_POST['flight_no'];
    $flight_date = $_POST['flight_date'];
    $ticket_no = $_POST['ticket_no'];
    $discount = $_POST['discount'];
    $tcost = $_POST['total_price'];
    $amount_paid = $_POST['paid'];
    if($discount == '')
    {
        $discount=0;
    }
    $discount_type = $_POST['discount_type'];

    if ($amount_paid == $tprice){
        $paid=1;
    } else {
        $paid=0;
    }
    
    $indicator = $sample;
    
    if ( (strpos($sample, ',') !== false) ) {
        $str_arr = explode (",", $sample); 
        $cc_no = 'VLC-'.$str_arr[0];
        $sample = 'VLC-'.$str_arr[0];
        $session_id = $str_arr[1];
        
    }
    $b_details=mysqli_query($con,"select *  from booking_details where bid='".$bid."' ") or die (mysqli_error());
 
    while($b_d=mysqli_fetch_array($b_details)){
         
        $test_id = $b_d['tid'];
        $tst=mysqli_query($con,"select  *  from tests where id='".$test_id."' limit 1 ") or die (mysqli_error());
        while($ts = mysqli_fetch_array($tst)){
            $type = $ts['discount_type'];
            $price = $ts['price'];
     
            $discounts = mysqli_query($con, "select * from collection_center_discounts where discount_id='$type' and cc_id= '$session_id' ") or die(mysqli_error($con));
            while($d = mysqli_fetch_array($discounts)) {
         
                $dis = $d['discount'];
                $amount = ($price * $dis)/100;
                $earned = $earned + $amount;
                $amount_to_pay = $amount_to_pay + ( $price - $amount);
          
            }
        }
    }
    
    $today = date("d m Y h:i:s A");

    mysqli_query($con, "update bookings set total_cost= '$tcost', discount='$discount', total_amount='$tprice', amount_paid='$amount_paid', sample_collect ='$sample',
    pass_no = '$pass_no', flight_no='$flight_no', flight_date = '$flight_date', ticket_no = '$ticket_no', discount_type='$discount_type', cc_no = '$cc_no' where id='$bid'  ") or die(mysqli_error($con));
  
    $itemCount = count($_POST["index_number"]);
    $itemValues = 0;
    $query = "INSERT INTO booking_details (pid,bid,tid,qty,cost,price,status, runtime_status, staffid,labid,approvedby,result_date) VALUES ";
    $queryValue = "";
    $runtime_status = "Appoitment at ".date("d m Y h:i:s A");
    for ($i = 0; $i < $itemCount; $i++) {
        $tid =$_POST["tid"][$i];
        if (!empty($_POST["index_number"][$i])) {
            $itemValues++;
            if ($queryValue != "") {
                $queryValue .= ",";
            }
            $queryValue .= "('" . $uid . "','" . $bid . "','" . $_POST["tid"][$i] . "','" . $_POST["qty"][$i] . "','" . $_POST["cost"][$i] . "','" . $_POST["price"][$i] . "','pending','$runtime_status','$session_id','$session_labid','0','0000-00-00')";
        }
        if ( strpos($indicator, ',') !== false) {
    
            $tests = mysqli_query($con, "select * from tests where id='$tid' ") or die(mysqli_error($con));
            
            while($t = mysqli_fetch_array($tests)){
                $type = $t['discount_type'];
                $price = $t['price'];
         
                $discounts = mysqli_query($con, "select * from collection_center_discounts where discount_id='$type' and cc_id= '$session_id' ") or die(mysqli_error($con));
                while($d = mysqli_fetch_array($discounts)) {
             
                    $dis = $d['discount'];
                    $amount = ($price * $dis)/100;
                    $earned = $earned + $amount;
                    $amount_to_pay = $amount_to_pay + ( $price - $amount);
              
                }
            }
        }
    }
    
    $sql = $query . $queryValue;
    if ($itemValues != 0) {
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
    }
    
    if ($sample == 'At Home')
    {
        $result = mysqli_query($con, "insert into booking_rider
        (bid,rid,status,complete,date,time,created_at,completed_at,collected_at)
        value('$bid','0','','0','$scheduled_date', '$scheduled_time','$today', '','')") or die(mysqli_error($con));
    }
    
    if( $tprice > $earned ) {
        $earned = $tprice - $earned;
    } else {
        $earned = 0;
    }
    
    $discount = $discount.' '.$discount_type;
    
    mysqli_query($con, "delete from collection_center_earnings where b_no='$bookingno' ") or die(mysqli_error($con));
    if ( strpos($indicator, ',') !== false ) {
        
        mysqli_query($con, "insert into collection_center_earnings ( cc_id, b_no, total, discount, price, earned, amount_to_pay, date, paid, labid) 
        values ('$session_id','$bookingno','$tcost','$discount', '$tprice', '$earned','$amount_to_pay',now(),'0','$session_labid' ) ") or die(mysqli_error($con));

    }
    
    echo '<script language="javascript">window.location = "' . $baseurl . 'invoice/' . $bid . '.html"</script>';

   
}

function sms($uid, $tprice, $amount_paid, $con){
    
    $patients=mysqli_query($con,"select * from patients where id='$uid' limit 1") or die (mysqli_error());
    while($info=mysqli_fetch_array($patients)){
        $contact = $info['contact'];
        $name = $info['firstname'].' '.$info['lastname'];
    }
    $cut = strstr($contact, '3');
    $phone = '92'.$cut;
    $random = mt_rand(1000000,10000000);
    $transaction_id = '17e4d747-c21b-4bb0-a574-00000'.$random;
        
    $message = 'Dear '.$name.',
        
Your total bill was for Rs. '.$tprice.', you paid Rs. '.$amount_paid.'. 
Thank you for choosing Virtual Lab
Download Virtuallab App from Playstore and keep all your medical history at one place.
    
Regards 
Virtual Lab';
     
    $params=['transaction_id'=>$transaction_id, 'user'=>'virtullab', 'pass'=>'SS123', 
    'number'=> $phone,'text'=>$message,'from'=>'Virtual Lab','type'=>'sms' ];
    $defaults = array(
    CURLOPT_URL => 'https://api.itelservices.net/send.php',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $params,
    CURLOPT_RETURNTRANSFER     => true,
    );
    $ch = curl_init();
    curl_setopt_array($ch,  $defaults);
    curl_exec($ch);
    curl_close($ch);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Edit Booking | <?php echo $basetitle; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/components.css">
  <!-- Custom style CSS -->

  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl; ?>images/favicon.png' />
    <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/select2/dist/css/select2.min.css">
    
    <style>
        tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    </style>

</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include "includes/header.php";?>
<?php include "includes/leftnavigation.php";?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
<h1>Edit Booking for <?php echo $firstname . ' ' . $lastname; ?></h1>
								</div>
							</div>
						</div>
					</div>

          <div class="section-body">
<form action="<?php echo $baseurl; ?>edit_booking.php?id=<?php echo $bid; ?>" method="post">


<div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">

                         <div class='row'>
                         <div class="col-md-4">
                         <p class="clearfix">
                        <span class="float-left" style="width:170px">Patient Name</span>
                        <span class="float-left text-muted">
                        <input type="hidden" name="bookingno" value="<?php echo $bookingno + 1; ?>">
                        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                        <?php echo $firstname . ' ' . $lastname; ?></span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left" style="width:170px">City</span>
                         <span class="float-left text-muted"><?php echo $city; ?></span>
                         </p>
                         <p class="clearfix">
                            <span class="float-left" style="width:170px">CNIC</span>
                            <span class="float-left text-muted"><?php echo $cnic; ?></span>
                          </p>
                           <p class="clearfix">
                            <span class="float-left" style="width:170px">Contact #</span>
                            <span class="float-left text-muted"><?php echo $contact; ?></span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left" style="width:170px">DOB</span>
                            <span class="float-left text-muted"><?php echo $dob; ?></span>
                          </p>
                           <p class="clearfix">
                            <span class="float-left" style="width:170px">Age</span>
                            <span class="float-left text-muted"><?php echo $age; ?></span>
                            </p>
                         </div>
                         <div class="col-md-4">
                            <p class="clearfix">
                            <span class="float-left" style="width:170px">Blood Group</span>
                            <span class="float-left text-muted"><?php echo $blood_group; ?></span>
                          </p>
                        
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Select Doctor</span>
                            </div>
                        <select  name="doctor" class="form-control">
                        <option value="1" selected> Patient Self</option>
                        <?php
$doctors = mysqli_query($con, "select * from doctors where labid='$session_labid' ") or die(mysqli_error());
while ($doc = mysqli_fetch_array($doctors)) {

    ?>
                                 <option value="<?php echo $doc['id']; ?>"><?php echo $doc['firstname'] . ' ' . $doc['lastname'] . ' - ' . $doc['city']; ?></option>
<?php
}
?>
                            </select>
                          </div>
                       <div class="input-group mb-3">
                             <div class="input-group-prepend">
                                  <span class="input-group-text">Sample</span>
                                </div>
                    
                            <select  name="sample_collect" class="form-control">
                            <?php
                                $str_arr = explode ("-", $sample_collect); 
                                $cc_no = $str_arr[1];
 
                                $center = mysqli_query($con, "select * from collection_center where unique_id='$cc_no' limit 1 ") or die(mysqli_error());
                                while ($c = mysqli_fetch_array($center)) { ?>
                                     <option value="<?php echo $c['unique_id'].','.$c['id']; ?>" > VLC-<?php echo $c['unique_id']; ?></option>
                         
                            <?php  }  ?>
                            <option value="In Lab" > In Lab</option>
                            <option value="At Home" > At Home</option>
                            <option value="Brought to Lab" >Brought to Lab</option>
                            <?php 
                                $centers = mysqli_query($con, "select * from collection_center ") or die(mysqli_error());
                                while ($cc = mysqli_fetch_array($centers)) { ?>
                                     <option value="<?php echo $cc['unique_id'].','.$cc['id']; ?>" > VLC-<?php echo $cc['unique_id']; ?></option>
                         
                            <?php  }  ?>
                            </select>
                          </div>
                          <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Scheduled Date (If any)</span>
    </div>
    <input type="date" class="form-control" name="scheduled_date" value="<?php echo $scheduled_date ?>">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Scheduled Time (If any)</span>
    </div>
    <input type="time" class="form-control" name="scheduled_time" value="<?php echo $scheduled_date ?>">
  </div>
                         </div>
                         <div class="col-md-4">
<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Passport No</span>
    </div>
    <input type="text" class="form-control" name="pass_no" value="<?php echo $passport_no ?>">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Flight No</span>
    </div>
    <input type="text" class="form-control" name="flight_no" value="<?php echo $flight_no ?>">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Flight Date</span>
    </div>
    <input type="date" class="form-control" name="flight_date" value="<?php echo $flight_date ?>">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Ticket No</span>
    </div>
    <input type="text" class="form-control" name="ticket_no" value="<?php echo $ticket_no ?>">
  </div>
                         </div>
                         </div>
                    </div>
                  </div>
                </div>
              </div>

              </div>
          <div class="row">
              <div class="col-md-8 col-lg-6 col-sm-12">
                <div class="card">
                  <div class="padding-20">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                            <th colspan="5">Test Full Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Remove</th>
                        </tr>
                      
                        <?php
                            $details=mysqli_query($con,"select  *  from booking_details where bid = '".$bid."'") or die (mysqli_error());
                            
                            while($detail=mysqli_fetch_array($details)){
                                $testid = $detail['tid'];
                            
                                $test=mysqli_query($con,"select  *  from tests where id='".$testid."' limit 1 ") or die (mysqli_error());
                                while($t=mysqli_fetch_array($test)){ ?>
                                    <tr> <td colspan="5"> <?php echo $t['title']; ?> </td>
                                    <td class="text-center"> <?php echo $t['price']; ?> </td>
                                    <td class="text-center"><a href="<?php echo $baseurl;?>edit_booking.php?delete=<?php echo $detail['id'];?>&bid=<?php echo $bid;?>&tprice=<?php echo $t['price'];?>&bill=<?php echo $total_bill;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
</td> </tr>   
                        <?php   }
                            
                            } ?>
                         
                      </table>
                    </div>
                  </div>
                </div>
                <input type="hidden" value="<?php echo $total_bill; ?>" id="total_bill">
                <input type="hidden" value="<?php echo $discount; ?>" id="total_discount">
                <input type="hidden" value="<?php echo $discount_type; ?>" id="total_discount_type">
                <div class="card">
                  <div class="padding-20">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                            <th  >Test Full Name</th>
                            <th>Price</th>
                            <th class="text-center">Remove</th>
                        </tr>
                                <?php echo cart(); ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">

<table  id="save-stage"  class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th> Name</th>   <th > Sample</th>
      <th > Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
  <?php
$staff_members = mysqli_query($con, "select * from tests where pid=0 order by id asc") or die(mysqli_error($con));
while ($info = mysqli_fetch_array($staff_members)) {
  
?>
<tr>
<td><?php echo $info['id']; ?></td>      
<td><?php echo $info['title']; ?></td>      
<td><?php echo $info['sample']; ?></td> 
<td><?php echo $info['price']; ?></td> 
<td >
<a href="<?php echo $baseurl; ?>edit-test-to-cart.php?add=<?php echo $info['id']; ?>&bid=<?php echo $bid; ?>" class="btn btn-success"><i class="fas fa-plus-square"></i></a>
</td>
</tr>
<?php } ?>
            
</table>
            
            
                    </div>
                  </div>
                </div>

              </div>

            </div>
</form>
         


          </div>
        </section>

<?php

include "includes/footer.php";
?>    </div>
  </div>
  
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl; ?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl; ?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery.sparkline.min.js"></script>
   <script src="<?php echo $baseurl; ?>assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<script>
    	
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot  #dot').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
    var amount = $('#total_bill').val();
    
    $('#discount').val($('#total_discount').val());
    $('#discount_type_option').text( $('#total_discount_type').val() );
    $('#discount_type_option').val( $('#total_discount_type').val() );
    
    amount = Number(amount) + Number($('#total_price').val());
    
    if ( $('#total_discount_type').val() == "%"){
        
          var percent =   amount * ($('#total_discount').val()/100);
          var discounted_amount = amount - percent;
        } else {
          var discounted_amount = amount - $('#total_discount').val();
    }
    
    $('#total_price').val(amount);
    $('#total').val(Math.round(discounted_amount));
 
    
    $("#discount").change(function(){
        var price =  Number( $('#total_price').val());
        var discount = $('#discount').val();
        var type = $("#discount_type").val();  
        if (type == "%"){
          var percent =   price * (discount/100);
          var tprice = price - percent;
        } else {
          var tprice = price - discount;
        }
        $('#total').val(Math.round(tprice));
    });
    
    $("#discount_type").change(function(){
        var price =  Number( $('#total_price').val());
        var discount = $('#discount').val();
        var type = $("#discount_type").val();  
        if (type == "%"){
          var percent =   price * (discount/100);
          var tprice = price - percent;
        } else {
          var tprice = price - discount;
        }
        $('#total').val(Math.round(tprice));
    });
    
});
</script>



</body>


</html>