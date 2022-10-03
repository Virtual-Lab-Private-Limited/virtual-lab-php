<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $_GET['id'];
$earning = 0;
$paid = 0;
$to_pay = 0;


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
                  <div class="card-header" style="padding-left:50%">
                      <form method="POST" action="<?php echo $baseurl;?>ledger.php?id=<?php echo $id;?>" >
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
<th>Earned</th>
<th>Status</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
if(isset($_POST['from'])){
    $from=date('Y-m-d',strtotime($_POST['from']));
    $to=date('Y-m-d',strtotime($_POST['to']));
    $earnings=mysqli_query($con,"select * from  doctor_earnings where cc_id='$session_id' and labid='$session_labid' and doctor_id='$id' and date between '$from' and '$to' order by id desc") or die (mysqli_error($con));

    
} else{
    $earnings=mysqli_query($con,"select * from  doctor_earnings where cc_id='$session_id' and labid='$session_labid' and doctor_id='$id'  order by id desc") or die (mysqli_error($con));

}

while($info=mysqli_fetch_array($earnings)){
    
    $earning += $info['earning'];
    
?>
                          <tr>
<td><?php echo $info['booking_no'];?></td>
<td><?php echo $info['date'];?></td>
<td><?php echo $info['earning'];?></td>
<td>
<?php if  ($info['paid'] == 1){
    $paid += $info['earning'];
 echo 'Paid';
} else {
    echo 'UnPaid';
    $to_pay += $info['earning'];
}
 ?> </td>
<td width="14%">
<?php if  ($info['paid'] == 0){ ?>
<a href="<?php echo $baseurl;?>update_ledger.php?id=<?php echo $info['id'];?>&d_id=<?php echo $id;?>" class="btn btn-success">Resolve </a>

<?php } 
 ?>    
    
</td>
                          </tr>
<?php
}
?>
                        </tbody>
                      </table>
                      
                      
                    </div>
                   <div style="font-weight:bold; font-size:20px; padding-left:30px">
                        <div class="row" >Amount Earned By Doctor Till Date: <?php echo $earning;?> </div>
                        <div  class="row">Amount Paid: <?php echo $paid;?> </div>
                        <div  class="row">Amount Remaining to Pay to Doctor: <?php echo $to_pay;?> </div>
                        
                        
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