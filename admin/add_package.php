<?php
include "global.php";
include "frenchiseinfo.php";
if ($logged == 0) {
    header("location:" . $baseurl . "login.html");
    exit();
}
$pid = $_GET['id'];
include "package-to-cart.php";

$patients = mysqli_query($con, "select * from patients where id='$pid' limit 1") or die(mysqli_error());
while ($info = mysqli_fetch_array($patients)) {
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

if (isset($_POST['submit'])) {

    $packages_id = $_POST['packages'];
    $packages = implode(",",$packages_id);
   
    $bookings = mysqli_query($con, "select * from bookings order by id desc limit 1") or die(mysqli_error());
    while ($data = mysqli_fetch_array($bookings)) {
        $bookingno = $data['id'];
    }
    $bookingid = (int)$bookingno+1;
    $caseno = date('dmY').$bookingid;
    $pid = $_POST['pid'];
    $tprice = 0;
    $tcost = $_POST['total_price'];
    $uid = $_POST['pid'];
    $doctorid = $_POST['doctor'];
    $sample = $_POST['sample_collect'];
    $cc_no = "";
    if($sample == 'Collection Center')
    {
        $cc_no = "VLC-$session_uid";
    }
    $scheduled_date = $_POST['scheduled_date'];
    $scheduled_time = $_POST['scheduled_time'];
    $pass_no = $_POST['pass_no'];
    $flight_no = $_POST['flight_no'];
    $flight_date = $_POST['flight_date'];
    $ticket_no = $_POST['ticket_no'];
    
    $today = date("d m Y h:i:s A");

    mysqli_query($con, "insert into bookings(bookingno,uid,total_cost, discount, total_amount,
    paid,profit_status,test_date,addby,bookby,address,city,lati,longi,labid,referby,receiveby,sample_collect,
    test_status, pass_no, flight_no, flight_date, ticket_no, discount_type, cc_no)value('$caseno','$uid','$tcost','0','$tcost','1','pending','$today','Staff',
    '$session_id','$address','$city','','','$session_labid','$doctorid','$session_id','$sample','pending', '$pass_no',
    '$flight_no','$flight_date','$ticket_no', '%', '$cc_no' )") or die(mysqli_error($con));
    
    $bookingid = mysqli_insert_id($con);

    
    if (!empty($_POST["submit"])) {
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
                $queryValue .= "('" . $uid . "','" . $bookingid . "','" . $_POST["tid"][$i] . "','" . $_POST["qty"][$i] . "','" . $_POST["cost"][$i] . "','" . $_POST["price"][$i] . "','pending','$runtime_status','$session_id','$session_labid','0','0000-00-00')";
            }
        }
        $sql = $query . $queryValue;
        if ($itemValues != 0) {
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            if (!empty($result))
            {
                    if ($sample == 'At Home')
                    {
                           $result = mysqli_query($con, "insert into booking_rider
                    (bid,rid,status,complete,date,time,created_at,completed_at,collected_at)
                    value('$bookingid','0','','0','$scheduled_date', '$scheduled_time','$today', '','')") or die(mysqli_error($con));
             
                    }
                echo '<script language="javascript">window.location = "' . $baseurl . 'package_invoice.php?id=' . $bookingid . '&packages=' . $packages . '"</script>';
            }

        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Assign Package Test | <?php echo $basetitle; ?></title>
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
<h1>Add Package for <?php echo $firstname . ' ' . $lastname; ?></h1>
								</div>
							</div>
						</div>
					</div>

          <div class="section-body">
<form action="<?php echo $baseurl; ?>add_package.php?id=<?php echo $pid; ?>" method="post">


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
                            <option value="In Lab" selected> In Lab</option>
                            <option value="At Home" > At Home</option>
                            <option value="Brought to Lab" >Brought to Lab</option>
                            <option value="Collection Center" > Collection Center</option>
                            </select>
                          </div>
                          <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Scheduled Date (If any)</span>
    </div>
    <input type="date" class="form-control" name="scheduled_date">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Scheduled Time (If any)</span>
    </div>
    <input type="time" class="form-control" name="scheduled_time">
  </div>
                         </div>
                         <div class="col-md-4">
<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Passport No</span>
    </div>
    <input type="text" class="form-control" name="pass_no">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Flight No</span>
    </div>
    <input type="text" class="form-control" name="flight_no">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Flight Date</span>
    </div>
    <input type="date" class="form-control" name="flight_date">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Ticket No</span>
    </div>
    <input type="text" class="form-control" name="ticket_no">
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
                            <th colspan="5" >Test Full Name</th>
                            <th class="text-center">Price</th>
                        
                            
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
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Package Name</th>
<th>Price</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$staff_members = mysqli_query($con, "select * from packages order by id asc") or die(mysqli_error($con));
while ($info = mysqli_fetch_array($staff_members)) {

    ?>
                          <tr>
<td><?php echo $info['title']; ?></td>
<td><?php echo $info['price']; ?></td>
<td width="8%">
<a href="<?php echo $baseurl; ?>package-to-cart.php?add=<?php echo $info['id']; ?>&id=<?php echo $pid; ?>" class="btn btn-success"><i class="fas fa-plus-square"></i></a>
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

            </div>
</form>
          <div class="row">
              <div class="col-12">
              </div>
            </div>


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

</body>


</html>