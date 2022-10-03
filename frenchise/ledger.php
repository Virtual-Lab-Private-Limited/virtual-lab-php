<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $_GET['id'];
$earning = 0;
$return_amount = 0;


if(isset($_POST['money'])){
	$money = $_POST['money'];
	$due = $_POST['due'];
	$total = $_POST['total'];
	$sum = $due + $total;
	$pay = $sum - $money;
	$date = date('d m Y H:i:s A');
	
	
	mysqli_query($con,"insert into collection_center_payments (cc_id, total, amount_paid, due, date) values ('$id', '$total', '$money', '$pay', now() )") or die (mysqli_error($con));

    mysqli_query($con,"update collection_center_earnings set paid = 1 where cc_id = '$id' ") or die (mysqli_error($con));

    
}

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
									<h1>Ledger</h1>
								</div>
							</div>
						</div>
					</div>
					
					<?php echo $month;?>
          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header" style="text-align:right; padding-left:70%">
                         
                           <a href="<?php echo $baseurl;?>breakdown.php?id=<?php echo $id;?>" class="btn btn-info" style="padding:5%">Breakdown </a>
                           <a href="<?php echo $baseurl;?>overview.php?id=<?php echo $id;?>" class="btn btn-success" style="padding:5%">Overview </a>

                     
                    </div>
           
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Case #</th>
<th>Total</th>
<th>Earned</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$earnings=mysqli_query($con,"select * from  collection_center_earnings where cc_id='$id' and paid = 0  order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($earnings)){
    
    $earning += $info['earned'];
    $return_amount += $info['amount_to_pay'];

?>
                          <tr>
<td><?php echo $info['b_no'];?></td>
<td><?php echo $info['total'];?></td>
<td><?php echo $info['earned'];?></td>
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
            
                   
                  </div>
                   <div class="card">
                        <div class="card-header" style="padding-left:50%"></div>
                
                        <div class="card-body">
                            
                         <?php   
                         $earnings=mysqli_query($con,"select * from  collection_center_payments where cc_id='$id' order by id desc limit 1") or die (mysqli_error($con));
while($info=mysqli_fetch_array($earnings)){
    
    $due += $info['due'];
}
?>
                    <div style="font-weight:bold; padding-left:30px">
                        <div class="row" >Amount Earned By Collection Center: <?php echo $earning;?> </div>
                        <div  class="row">Amount To Pay: <?php echo $return_amount;?> </div>
                        <div class="row" >Any Previous Due's: <?php echo $due;?> </div>
                        
                    </div>
                    
                    <form method="POST" action="<?php echo $baseurl;?>ledger.php?id=<?php echo $id;?>">
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">Pay</span>
                        </div>
                        <input type="number" name="money" class="form-control" >
                        <input type="hidden" name="due" value="<?php echo $due;?>" >
                        <input type="hidden" name="total" value="<?php echo $return_amount;?>" >
                        <input type="submit"  class="btn btn-success">
                      </div>
                            </form>
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