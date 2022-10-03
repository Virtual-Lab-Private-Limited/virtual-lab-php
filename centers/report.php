<?php
include "global.php";
include "frenchiseinfo.php";
if ($logged == 0) {
    header("location:" . $baseurl . "login.html");
    exit();
}
$id = $_GET['id'];
$report_id = $id;

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $basetitle; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/components.css">
  <!-- Custom style CSS -->

  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl; ?>images/favicon.png' />
  <style>
  td{border:1px solid lightgray;
  }
  li{
	  display:block;
  }
  @media print {
   #footer {
        height: 300px;
        position:fixed;
        margin:0px;
        bottom:0px;
    }
    @page { margin: 0; background-color: white}
    body { margin: 1.6cm; }
}

       
  </style>
</head>

<body>
 <?php
$booking_details = mysqli_query($con, "select * from booking_details where id='$id' limit 1") or die(mysqli_error());
while ($data = mysqli_fetch_array($booking_details)) {
    $bid = $data['bid'];
    $pid = $data['pid'];
    $tid = $data['tid'];
    $report_remarks = $data['remarks'];
    $result_date = $data['result_date'];
}
$tests = mysqli_query($con, "select * from tests where id='$tid' limit 1") or die(mysqli_error());
while ($data = mysqli_fetch_array($tests)) {
    $title = $data['title'];
    $type = $data['type'];
    $test_remarks = $data['remarks'];
    $catid = $data['catid'];

}
$bookings = mysqli_query($con, "select * from bookings where id='$bid' limit 1") or die(mysqli_error());
while ($data = mysqli_fetch_array($bookings)) {
    $bookingno = $data['bookingno'];
    $test_date = $data['test_date'];
    $referby = $data['referby'];
    $sample_collect = $data['sample_collect'];

    $ticket_no = $data['ticket_no'];
    $flight_date = $data['flight_date'];
    $flight_no = $data['flight_no'];
    $pass_no = $data['pass_no'];
}
$doctors = mysqli_query($con, "select * from doctors where id='$referby' limit 1") or die(mysqli_error());
while ($doc = mysqli_fetch_array($doctors)) {
    $docfirstname = $doc['firstname'];
    $doclastname = $doc['lastname'];
    $hospital = $doc['clinic'];
}
$patients = mysqli_query($con, "select * from patients where id='$pid' limit 1") or die(mysqli_error());
while ($info = mysqli_fetch_array($patients)) {
    $firstname = $info['firstname'];
    $lastname = $info['lastname'];
    $cnic = $info['cnic'];
    $contact = $info['contact'];
    $city = $info['city'];
    $dob = $info['dob'];
    $age = $info['age'];
    $blood_group = $info['blood_group'];
    $gender = $info['gender'];
    $age_group = $info['age_level'];
    $patient_no = $info['patient_no'];

}

$categories = mysqli_query($con, "select * from categories where id='$catid' limit 1") or die(mysqli_error($con));
while ($cat = mysqli_fetch_array($categories)) {
    $cat_title = $cat['category'];
}
?>
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
<h1><?php echo $firstname . ' ' . $lastname; ?>'s Test Report</h1>
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
<?php
if ($type == 'culture') {
    include "reports/culture.php";
} else if ($type == 'radiology') {
    include "reports/radiology.php";
} else if ($type == 'screening') {
    include "reports/screening.php";
}
else if ($type == 'vb') {
    include "reports/value_based.php";
} else if ($type == 'pcr_quantitative') {
    include "reports/pcr_quantitative.php";
} else if ($type == 'pcr_qualitative') {
    include "reports/pcr_qualitative.php";
} else if ($type == 'eliza') {
    include "reports/eliza.php";
} else if ($type == 'bg') {
    include "reports/bloodgroup.php";
} else if ($type == 'cog(pt)') {
    include "reports/cog(pt).php";
} else if ($type == 'cog(aptt)') {
    include "reports/cog(aptt).php";
} else if ($type == 'cross_match_eliza' ||$type == 'cross_match_screening') {
    include "reports/crossmatch.php";
} else if ($type == 'histopathology') {
    include "reports/histopathology.php";
}  else if ($type == 'smear') {
    include "reports/smear.php";
}  else if ($type == 'analysis') {
    include "reports/analysis.php";
}
?>

            </div>
<div class="row mt-4">
                	<div class="text-md-right">
		                <div class="float-lg-left">

<button class="btn btn-success btn-icon icon-left" name="b_print" onClick="printdiv('div_print');"><i class="fas fa-print"></i> Print Report </button>
<a class="btn btn-info btn-icon icon-left" href="https://virtuallab.com.pk/reports/pdf.php?id=<?php echo $report_id; ?>" target="_blank"><i class="fas fa-print"></i>Generate PDF</a>
		                </div>
		            </div>
                </div>

          </div>
        </section>
    </div>
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

</body>


</html>