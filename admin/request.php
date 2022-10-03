<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$withdrawals=mysqli_query($con,"select * from withdrawl_request where id='$id' limit 1") or die (mysqli_error($con));
while($info=mysqli_fetch_array($withdrawals)){
	$investorid=$info['riderid'];
	$amount=$info['amount'];
	$request_date=$info['request_date'];
	$status=$info['status'];
	$payment_date=$info['payment_date'];
	
}

$investors=mysqli_query($con,"select * from members where id='$investorid' limit 1") or die (mysqli_error());
while($inv=mysqli_fetch_array($investors)){
	$firstname=$inv['firstname'];	
	$lastname=$inv['lastname'];	
	$payment_method=$inv['payment_method'];
	$details=$inv['details'];	
}




?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> Requests | <?php echo $basetitle;?></title>
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
<h1>Request Details</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
          <div class="row">
              <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-left">
                          Investor
                        </span>
                        <span class="float-right text-muted">
<?php echo $firstname.' '.$lastname;?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Amount</span>
                        <span class="float-right text-muted">
<?php echo $amount;?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
Payment Mehtod
                        </span>
                        <span class="float-right text-muted">
<?php echo $payment_method;?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
Details
                        </span>
                        <span class="float-right text-muted">
<?php echo $details;?>
                        </span>
                      </p>
                                          </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <h4>Transaction</h4>
                  </div>
                  <div class="card-body">
<?php
if($status=='Pending'){
?>
<form action="<?php echo $baseurl;?>approval.php?id=<?php echo $id;?>" method="post">  
                   <div class="py-4">

                      <p class="clearfix">
<input type="text" name="transactionid" value="" placeholder="Transaction ID" class="form-control">
<input type="hidden" name="tid" value="<?php echo $id;?>" placeholder="Transaction ID" class="form-control">
                      </p>
                      <p class="clearfix">
<input type="submit" name="submit" value=" Update Transaction " class="btn btn-success">                      </p>
                    </div>
</form>
 <?php
}else{
	echo '<p class="clearfix">                        <span class="float-left">
Payment is already Paid on:</span>                        
<span class="float-right btn btn-success">'. $payment_date."</span></p>";
}
?>
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