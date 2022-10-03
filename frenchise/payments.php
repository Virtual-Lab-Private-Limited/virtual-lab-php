<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0 || ($session_role == 'user')){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $session_id;

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
                      <form method="POST" action="<?php echo $baseurl;?>payments.php" >
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
<th> Date</th>
<th>Patient #</th>
<th> Name </th>
<th>Tests</th>
<th>Bill</th>

  </tr>
</thead>
<tbody>
<?php

$booking_total = 0;

if(isset($_POST['from'])){
    
    $from=date('d m Y',strtotime($_POST['from']));
    $to=date('d m Y',strtotime($_POST['to']));
    $bookings=mysqli_query($con,"select * from  bookings where labid='$session_labid' and sample_collect = 'In Lab' and test_date between '$from' and '$to' order by id desc") or die (mysqli_error($con));

} else{
   $bookings=mysqli_query($con,"select * from  bookings where labid='$session_labid' and sample_collect = 'In Lab'  order by id desc") or die (mysqli_error($con));

}
while($info=mysqli_fetch_array($bookings)){
    	$bid =$info['id'];
    	$booking_total += $info['total_amount'];
?> <tr>
<td><?php echo $info['bookingno'];?></td>
<td><?php echo $info['test_date'];?></td>
<td><?php
$patients=mysqli_query($con,"select * from patients where id='".$info['uid']."' order by id") or die (mysqli_error());
while($data=mysqli_fetch_array($patients)){
    echo $data['patient_no'];
$name =  $data['firstname'].' '.$data['lastname'];

}?></td>
<td><?php echo $name;?></td>
<td><?php
$bd=mysqli_query($con,"select  *  from booking_details where bid = '".$bid."'") or die (mysqli_error());

while($details=mysqli_fetch_array($bd)){
    $testid = $details['tid'];
    $test=mysqli_query($con,"select  *  from tests where id='".$testid."' limit 1 ") or die (mysqli_error());
    while($t=mysqli_fetch_array($test)){
        echo $t['title'];
    } echo ', ';

}
?></td>
<td><?php echo $info['total_amount'];?></td>
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
            </div>
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Collection Center</th>
<th>Total Earning</th>
<th>CC Earned</th>
<th>VL Earned</th>
<th>Action</th>

                          </tr>
                        </thead>
                        <tbody>
<?php

    $gross_total = 0;
    $gross_earning = 0;
    $gross_return_amount = 0;
    
$centers=mysqli_query($con,"select * from  collection_center where labid='$session_labid' order by id desc") or die (mysqli_error($con));

while($center=mysqli_fetch_array($centers)){
    $name = 'VLC - '.$center['unique_id'];
    $cid = $center['id'];
    $total = 0;
    $earning = 0;
    $return_amount = 0;
    if(isset($_POST['from'])){
        $from=date('Y-m-d',strtotime($_POST['from']));
        $to=date('Y-m-d',strtotime($_POST['to']));
        $earnings=mysqli_query($con,"select * from  collection_center_earnings where cc_id='$cid' and date between '$from' and '$to' ") or die (mysqli_error($con));
    
    } else{
        $earnings=mysqli_query($con,"select * from  collection_center_earnings where cc_id='$cid' ") or die (mysqli_error($con));
    
    }
    
    while($info=mysqli_fetch_array($earnings)){
        $total += $info['total'];
        $earning += $info['earned'];
        $return_amount += $info['amount_to_pay'];
    }        

    $gross_total += $total;
    $gross_earning += $earning;
    $gross_return_amount += $return_amount;
    
?>
<tr>
<td><?php echo $name;?></td>
<td><?php echo $total;?></td>
<td><?php echo $earning;?></td>
<td><?php echo $return_amount;?></td>
<td>    <a href="<?php echo $baseurl;?>overview.php?id=<?php echo $cid;?>" class="btn btn-success" style="padding:5%">Overview </a>
</td>
</tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                   <div style="font-size:20px; padding-left:30px; color:darkblue">
                        <div class="row" >Total Earning in Frenchise: <b> <?php echo $booking_total;?></b> </div>
                        <div class="row" >Total Earning from Collection Center's: <b> <?php echo $gross_total;?></b> </div>
                        <div class="row" >Amount Earned By Collection Center's: <b><?php echo $gross_earning;?></b> </div>
                        <div  class="row">Amount Earned By Frenchise: <b><?php echo $gross_return_amount;?></b> </div>
                        
                         <div  class="row">Expenses of Frenchise: <b>
                        <?php 
                        $total_expense = 0;
                        if(isset($_POST['from'])){
                            $from=date('Y-m-d',strtotime($_POST['from']));
                            $to=date('Y-m-d',strtotime($_POST['to']));
                            $expenses=mysqli_query($con,"select * from expense where labid=$session_labid and date between '$from' and '$to' order by id desc") or die (mysqli_error($con));
                                              
                        } else{
                            $expenses=mysqli_query($con,"select * from expense where labid=$session_labid  order by id desc") or die (mysqli_error($con));
                        }
                        while($data=mysqli_fetch_array($expenses)){
                            $total_expense += $data['price'];
                        }echo $total_expense;
                        ?>
                        </b> </div>
                        <div  class="row">Gross Total: <b><?php echo ($gross_return_amount+$booking_total-$total_expense);?></b> </div>
                        
                        
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