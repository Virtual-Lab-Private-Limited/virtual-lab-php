<?php
include("global.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
include("frenchiseinfo.php");
$id=$_GET['id'];


if($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $list = $_POST['list'];
    
    foreach ($list as $l){
        mysqli_query($con,"update rider_earnings set paid=1 where id=$l ") or die (mysqli_error($con));

    }

}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title> Work History | <?php echo $basetitle;?></title>
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
									<h1> Work History</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
          <div class="row">
            <form method="post" action="<?php echo $baseurl;?>working_history/<?php echo $id;?>.html">
              <div class="col-12">
                <div class="card">
                  <div class="card-header" >
                     <input type='submit' value='Mark Paid' class='btn btn-warning' style='margin-left:90%' /> 
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Booking #</th>
<th>Patient</th>
<th>Booking Date</th>
<th>Total</th>
<th>Earned</th>
<th>Amount To Pay</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$bookings=mysqli_query($con,"SELECT br.bid, br.status, br.date, br.time, b.bookingno, b.total_amount, b.test_date , p.firstname, p.lastname, p.patient_no
        from booking_rider br, bookings b, patients p
        where br.bid = b.id and  b.uid = p.id and br.rid = $id and br.complete=1 and br.status='completed'   ") or die (mysqli_error($con));
     
while($info=mysqli_fetch_array($bookings)){
 $bno = $info['bookingno'];
?>
 <tr>
<td width="10%"><?php echo $info['bookingno'];?></td>
<td><?php echo $info['patient_no'].' - '.$info['firstname'].' '.$info['lastname']; ?></td>
<td width="12%"><?php echo $info['test_date'];?></td>

<?php 

$earnings=mysqli_query($con,"SELECT * FROM rider_earnings WHERE  b_no= '$bno'  ") or die (mysqli_error($con));
while($data=mysqli_fetch_array($earnings)){
    $eid = $data['id'];
    $paid =  $data['paid'];
    $total =  $data['total'];
    $earned =  $data['earned'];
    $toPay =  $data['amount_to_pay'];
}
?>

<td><?php echo $total;?></td>
<td><?php echo $earned;?></td>
<td><?php echo $toPay;?></td>
<td>  
<?php if ($paid == 1) { ?>
    <strong style='color:green;font-weight:bold'>Paid</strong>
<?php } else { ?>
    <input type="checkbox" name='list[]' value='<?php echo $eid;?>' >
<?php } ?>
    
</td>

</tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </form> 
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