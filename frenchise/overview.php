<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0 || ($session_role == 'user')){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $session_id;
$total = 0;
$earning = 0;
$return_amount = 0;


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
									<h1>Ledger Overview</h1>
								</div>
							</div>
						</div>
					</div>
					
					<?php echo $month;?>
          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header" style="padding-left:50%">
                      <form method="POST" action="<?php echo $baseurl;?>overview.php" >
                      <div class="input-group mb-3">
                        
                        <input type="date" name="from" class="form-control" value="From" >
                        <input type="date" name="to" class="form-control" value="To">
                        <input type="submit"  class="btn btn-success">
                      </div>
                      
                    </form>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Case #</th>
<th>Date</th>
<th>Patient</th>
<th>Tests</th>
<th>Total</th>
<th>Discount</th>
<th>Amount to pay</th>
<th>Paid by Patient</th>
<th>CC Earned</th>
<th>VL Earned</th>
<th>CC Status</th>

                          </tr>
                        </thead>
                        <tbody>
<?php


if(isset($_POST['from'])){
    
    $from=date('Y-m-d',strtotime($_POST['from']));
    $to=date('Y-m-d',strtotime($_POST['to']));
    $earnings=mysqli_query($con,"select * from  collection_center_earnings where cc_id='$id' and date between '$from' and '$to' order by id desc") or die (mysqli_error($con));

} else{
    $earnings=mysqli_query($con,"select * from  collection_center_earnings where cc_id='$id' order by id desc") or die (mysqli_error($con));

}
				
while($info=mysqli_fetch_array($earnings)){
    
    $total += $info['total'];
    $earning += $info['earned'];
    $return_amount += $info['amount_to_pay'];
    $bno =$info['b_no'];
    $bookings=mysqli_query($con,"select * from bookings where bookingno='$bno' limit 1") or die (mysqli_error($con));
    while($book=mysqli_fetch_array($bookings)){
    	$bid =$book['id'];
    	$uid =$book['uid'];
    	$discount =$book['discount'].' '.$b['discount_type'];
    	$total_amount = $book['total_amount'];
    	$amount_paid = $book['amount_paid'];
    }
?>
                          <tr>
<td><?php echo $info['b_no'];?></td>
<td><?php echo $info['date'];?></td>
<td><?php
$patients=mysqli_query($con,"select *  from patients where id='".$uid."'  limit 1") or die (mysqli_error());
while($patient=mysqli_fetch_array($patients)){
$name = $patient['firstname'].' '.$patient['lastname'];
echo $name;
}
?></td>
<td><?php
$bookings=mysqli_query($con,"select  *  from booking_details where bid = '".$bid."'") or die (mysqli_error());
$booking=mysqli_num_rows($bookings);
while($details=mysqli_fetch_array($bookings)){
    $testid = $details['tid'];
    $test=mysqli_query($con,"select  *  from tests where id='".$testid."' limit 1 ") or die (mysqli_error());
    while($t=mysqli_fetch_array($test)){
        echo $t['title'];
    } echo ', ';
}

?></td>
<td><?php echo $info['total'];?></td>
<td><?php echo $discount;?></td>
<td><?php echo $total_amount;?></td>
<td><?php echo $amount_paid;?></td>
<td><?php echo $info['earned'];?></td>
<td><?php echo $info['amount_to_pay'];?></td>
<td>
<?php if  ($info['status']){
 echo 'Paid';
} else {
    echo 'UnPaid';
}
 ?> </td>
</tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                   <div style="font-size:25px; padding-left:30px; color:grey">
                        <div class="row" >Total Earning: <b> <?php echo $total;?></b> </div>
                        
                        <div class="row" >Amount Earned By Collection Center: <b><?php echo $earning;?></b> </div>
                        <div  class="row">Amount To Pay To Virtual Lab: <b><?php echo $return_amount;?></b> </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

<?php

include("includes/footer.php");
?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>