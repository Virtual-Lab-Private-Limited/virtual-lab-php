<?php
include("global.php");
include("frenchiseinfo.php");
//error_reporting(0);
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}include("test-to-cart.php");
$bid=$_GET['id'];

$bookings=mysqli_query($con,"select * from bookings where id='$bid' order by bookingno desc ") or die (mysqli_error());
while($data=mysqli_fetch_array($bookings)){
	$bookingno=$data['bookingno'];
	$pid=$data['uid'];
	$total_cost = $data['total_cost'];
	$discount = $data['discount'];
	$discount_type = $data['discount_type'];
	$total_amount = $data['total_amount'];
	$referby=$data['referby'];
	$userid=$data['uid'];
	$pass_no = $data['pass_no'];
	$flight_no = $data['flight_no'];
	$ticket_no = $data['ticket_no'];
    $flight_date = $data['flight_date'];
    $cc_no = $data['cc_no'];
    $paid = $data['paid'];
    $amount_paid = $data['amount_paid'];
	
}

$patients=mysqli_query($con,"select * from patients where id='$userid' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($patients)){
$firstname=$info['firstname'];
$lastname=$info['lastname'];
$cnic=$info['cnic'];
$contact=$info['contact'];
$address=$info['address'];
$dob=$info['dob'];
$age=$info['age'];
$blood_group=$info['blood_group'];
$gender = $info['gender'];

$p_no = $info['patient_no'];

}
$doctors=mysqli_query($con,"select * from doctors where id='$referby' limit 1") or die (mysqli_error());
while($doc=mysqli_fetch_array($doctors)){
$docfirstname=$doc['firstname'];
$doclastname=$doc['lastname'];
$hospital=$doc['clinic'];
}
foreach ($_SESSION as $name=> $value){
	if($value>0){
	if($cart=substr($name,0,5)=='cart_'){
		unset($_SESSION[$name]);
	}
	}
}

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Invoice | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
  
  <style>
    table {
        border-radius: 8px;
        border: 1px solid black;
        border-collapse: separate !important;
        
    }
    
    td, th {
        border: none;
        background-color: white;
    }
    
    strong {
        font-weight: bold;
    }
    
    
      
  </style>
  
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
<h1><?php echo $firstname.' '.$lastname;?>'s Test Report</h1>
								</div>
							</div>
						</div>
					</div>

          <div class="section-body">
            <div class="invoice">
<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>

<div id="div_print">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                    	<div class="col-md-4">
                    		<div class="invoice-title">
		                      <div class="login-invoice login-invoice-color">
		            			<img alt="image" src="<?php echo $baseurl.$basepath;?>" height="130" width="130" /></div>
		            			</div>
                    	</div>
                    	<div class="col-md-8 align-right" style="padding-top:20px">
<address><?php echo $baseaddress;?></address>
<span> Ph: <?php echo $basephone;?></span>
<div> <strong style="font-weight:bold; margin-top:3%">  Download Virtual Lab App from Playstore for reports or visit website www.virtuallab.com.pk </strong></div>
                
                    	</div>
                    </div>
                 
                <div class="card" style="border: 1px solid ">
                    <div class="row">
                      <div class="col-md-4">
                    
<div class="card-body">
<li><strong>Patient # : </strong><?php echo $p_no;?></li>
<li><strong>Full Name : </strong><?php echo $firstname.' '.$lastname.'    - '.$age.'Y/'.$gender;?></li>
<li><strong>Contact # : </strong><?php echo $contact;?></li>
<li><strong>Address : </strong><?php echo $address;?></li>
		                  </div>
		                </div>
<?php if ($pass_no != ''){ ?>
                        <div class="col-md-4">
                            <div class="card-body">
<li><strong>Passport # :</strong> <?php echo $pass_no;?></li>
<li><strong>Flight # : </strong><?php echo $flight_no;?></li>
<li><strong>Flight Date : </strong><?php echo $flight_date;?></li>
<li><strong>Ticket No : </strong><?php echo $ticket_no;?></li>
		                  </div>
		                </div>
<?php } else { ?>		      
                    <div class="col-md-4"></div>
<?php } ?>
                      
                      <div class="col-md-4">
<div class="card-body">
<li>Case # : <?php echo $bookingno;?></li>
<?php 
if ($cc_no != ""){
?>
<li>Collection Center # : <?php echo $cc_no;?></li>
<?php } ?>
<li>Dated : <?php echo date("d m Y h:i:s A");?></li>
<li>Total Amount : <?php echo $total_amount;?></li>
		                  </div>
		                </div>
		               </div>
                    </div>
                       
                  </div>
                </div>
                <div class="row mt-4">
         
                    
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md" border="1px">
                        <tr>
                          <th data-width="40">Sr.#</th>
<th>Test</th>

<th class="text-right" width="10%">Charges</th>
                        </tr>

<?php
$a=1;
$total = 0;
$total_discount = 0;
$bookings=mysqli_query($con,"select * from bookings where id='$bid' order by bookingno desc") or die (mysqli_error());
while($data=mysqli_fetch_array($bookings)){
	$id=$data['id'];
  $test_details=mysqli_query($con,"select * from booking_details where bid='$id' ") or die (mysqli_error());
  
  while($tdata=mysqli_fetch_array($test_details)){
    
    
?>
<tr>
<td><?php echo $a++;?></td>

<td><?php $tid=$tdata['tid'];
$tests=mysqli_query($con,"select * from tests where id='$tid' limit 1") or die (mysqli_error());
while($row=mysqli_fetch_array($tests)){
    $amount = $row['price'];
echo $row['title'];	
}

?></td>


<td class="text-right">Rs. <?php echo $amount;?>/-</td>
                        </tr>
<?php
}}
?>

                      </table>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Total Amount</div>
                          <div class="invoice-detail-value">Rs. <?php echo number_format($total_cost,2);?></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Discount</div>
                          <div class="invoice-detail-value"> <?php echo number_format($discount,2);?> <?php echo $discount_type;?></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Amount To Pay</div>
                          <div class="invoice-detail-value">Rs. <?php echo number_format($total_amount,2);?></div>
                        </div>
                      </div>
                    </div>
                    <?php if ($paid == 0) { ?>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Amount Paid</div>
                          <div class="invoice-detail-value">Rs. <?php echo number_format($amount_paid,2);?></div>
                        </div>
                      </div>
                    </div>
                    <div class="row mt-4">
                      <div class="col-lg-8">
                      </div>
                      <div class="col-lg-4 text-right">
                        <div class="invoice-detail-item">
                          <div class="invoice-detail-name">Due</div>
                          <div class="invoice-detail-value">Rs. <?php echo ($total_amount-$amount_paid);?></div>
                        </div>
                      </div>
                    </div>
                    <?php }  ?>
                    
                  </div>
                </div><hr>
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4" style="font-weight:bold;">
<p align="left"><i class="fas fa-phone-volume"></i><strong> 0314 4239340</strong></p>
</div>
                          
                      <div class="col-lg-4 col-md-4 col-sm-4" style="font-weight:bold;">
<p align="center"  ><i class="fas fa-home"></i><strong> 14-E, Maulana Shaukat Ali Road, Lahore</strong></p>
</div>
                    <div class="col-lg-4 col-md-4 col-sm-4" style="font-weight:bold;">
                    <p align="right"><i class="fas fa-globe"></i><strong> www.virtuallab.com.pk</strong></p>
                    </div>
                  
                  </div>
                    <span>Invoice generated by <?php echo $session_username ?> </span>
          
</div>                <div class="row mt-4">
                	<div class="text-md-right">
		                <div class="float-lg-left">

<button class="btn btn-success btn-icon icon-left" name="b_print" onClick="printdiv('div_print');"><i class="fas fa-print"></i>Print invoice</button>
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