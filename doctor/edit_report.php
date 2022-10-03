<?php
include "global.php";
include "frenchiseinfo.php";
if ($logged == 0) {
    header("location:" . $baseurl . "login.html");
    exit();
}
$today = date("d m Y h:i:s A");
if (!empty($_POST["value_based"])) {
    $result = $_POST['result'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $priority = $_POST['priority'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($result as $index => $value) {
        mysqli_query($con, "update value_based_result set value = '$value', priority = '$priority[$index]' where id ='$id[$index]'") or die(mysqli_error($con));

    }
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';

}
if (isset($_POST['analysis'])) {
    $left = $_POST['left'];
    $right = $_POST['right'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $priority = $_POST['priority'];
    
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($priority as $index => $value) {
        mysqli_query($con, "update analysis_result set left_result = '$left[$index]', right_result = '$right[$index]', priority = '$value' where id ='$id[$index]'") or die(mysqli_error($con));
    } 
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';
}
if (!empty($_POST["bloodgroup"])) {
    $group = $_POST['blood_group'];
    $factor = $_POST['rh_factor'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    mysqli_query($con, "update bloodgroup_result set result = '$group',rh_factor='$factor' where id ='$id' ") or die(mysqli_error($con));
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';

}
if (isset($_POST["culture"])) {
    $meds = $_POST['meds'];
    $intensity = $_POST['intensity'];
    $bookingdetailid = $_POST['bdid'];
    $id = $_POST['id'];
    $bookingid = $_POST['bid'];
    $patientid = $_POST['pid'];
    $specimen = $_POST['specimen'];
    $growth = $_POST['growth'];
    $microscopy = $_POST['microscopy'];
    $bacterial_count = $_POST['bacterial_count'];
    $zn_stain = $_POST['zn_stain'];
    $gram_stain = $_POST['gram_stain'];
    $mid =  $_POST['mid'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    mysqli_query($con, "update culture_report set specimen = '$specimen', growth ='$growth' , microscopy = '$microscopy',bacterial_growth='$bacterial_count',
    zn_stain = '$zn_stain',gram_stain='$gram_stain' where id = '$id' ") or die(mysqli_error($con));

    foreach ($intensity as $index => $value) {
        mysqli_query($con, "update medicine_details set med='$meds[$index]',c_result ='$value' where id ='$mid[$index]' ") or die(mysqli_error($con));

    }
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bookingdetailid'") or die(mysqli_error($con));
  
    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bookingdetailid . '.html"</script>';

}
if (!empty($_POST["smear"])) {

   
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $specimen = $_POST['specimen'];
    $clinical_details = $_POST['details'];
    $examination = $_POST['examination'];
    $conclusion = $_POST['conclusion'];
    $interpretation = $_POST['interpretation'];
    $notes = $_POST['notes'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);
  
     mysqli_query($con, "update smear_result set specimen='$specimen', clinical_details='$clinical_details', examination='$examination',
        conclusion = '$conclusion',interpretation='$interpretation', notes='$notes'   where id=$id ") or die(mysqli_error($con));
  
    
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';

}
if (isset($_POST['radiology'])) {
    $examination = mysqli_real_escape_string($con, $_POST['examination']);
    $complaints = mysqli_real_escape_string($con, $_POST['complaint']);
    $history = mysqli_real_escape_string($con, $_POST['history']);
    $protocol = mysqli_real_escape_string($con, $_POST['protocols']);
    $findings = mysqli_real_escape_string($con, $_POST['findings']);
    $impressions = mysqli_real_escape_string($con, $_POST['impressions']);
    $comment = mysqli_real_escape_string($con, $_POST['comments']);
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $tid = $_POST['tid'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    mysqli_query($con, "insert into radiology_result(testid,bid,bdid,ptid,examination,complain,history,protocol,findings,impressions,clnical_comments)values('$tid','$bid','$bdid','$pid','$examination','$complaints','$history','$protocol','$findings','$impressions','$comment')") or die(mysqli_error($con));
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    mysqli_query($con, "update booking_details set status='Complete',runtime_status='Report generated',labid='$session_labid', result_date='$today' where id='$bdid'") or die(mysqli_error());
    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';

}
if (isset($_POST['eliza'])) {
    $patient_value = $_POST['patient_value'];
    $result = $_POST['result'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $priority = $_POST['priority'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($patient_value as $index => $value) {
        mysqli_query($con, "update eliza_result set patient_value = '$value', result = '$result[$index]', priority = '$priority[$index]' where id ='$id[$index]'") or die(mysqli_error($con));

    } 
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';
}
if (isset($_POST['pcr_quantitative'])) {

    $viralload = $_POST['viralload'];
    $result = $_POST['result'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $priority = $_POST['priority'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($viralload as $index => $value) {
        mysqli_query($con, "update pcr_quantitative_result set viralload = '$value', result = '$result[$index]', priority = '$priority[$index]' where id ='$id[$index]'") or die(mysqli_error($con));
    }
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';
}
if (isset($_POST['pcr_qualitative'])) {

    $result = $_POST['result'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $priority = $_POST['priority'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($result as $index => $value) {
        mysqli_query($con, "update pcr_qualitative_result set result = '$value', priority = '$priority[$index]' where id ='$id[$index]'") or die(mysqli_error($con));
    }
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';
}
if (isset($_POST['coagulation'])) {

    $control = $_POST['control'];
    $result = $_POST['result'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($control as $index => $value) {
        mysqli_query($con, "update coagulation_result set control = '$value',value ='$result[$index]' where id ='$id[$index]'") or die(mysqli_error($con));
    }
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';
}
if (!empty($_POST["screening"])) {

    $result = $_POST['result'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    foreach ($result as $index => $value) {
        
          mysqli_query($con, "update screening_result set result ='$value' where id=$id[$index] ") or die(mysqli_error($con));
  
    }
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';

}
if (isset($_POST['histopathology'])) {

    $organ = $_POST['organ'];
    $specimen = $_POST['specimen'];
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $history_form = $_POST['history_form'];
    $gross = $_POST['gross'];
    $microscopic = $_POST['microscopic'];
    $diagnosis = $_POST['diagnosis'];
    $history = $_POST['history'];
    $doctor = $_POST['doctor'];
    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    mysqli_query($con, "update histopathology_report set organ='$organ',specimen='$specimen',history_form='$history_form',gross='$gross',
        microscopic = '$microscopic',diagnosis='$diagnosis',history='$history',doctor ='$doctor' where id='$id'  ") or die(mysqli_error($con));
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';
}
if (isset($_POST['cross_match'])) {
    $bid = $_POST['bid'];
    $bdid = $_POST['bdid'];
    $pid = $_POST['pid'];
    $id = $_POST['id'];
    $rec_name = mysqli_real_escape_string($con, $_POST['rec_name']);
    $rec_blood_group = mysqli_real_escape_string($con, $_POST['rec_blood_group']);
    $donor_name = mysqli_real_escape_string($con, $_POST['donor_name']);
    $donor_blood_group = mysqli_real_escape_string($con, $_POST['donor_blood_group']);
    $donor_hbsag = mysqli_real_escape_string($con, $_POST['donor_hbsag']);
    $donor_anti_hcv = mysqli_real_escape_string($con, $_POST['donor_anti_hcv']);
    $donor_anti_hiv = mysqli_real_escape_string($con, $_POST['donor_anti_hiv']);
    $donor_vdrl = mysqli_real_escape_string($con, $_POST['donor_vdrl']);
    $donor_malarial = mysqli_real_escape_string($con, $_POST['donor_malarial']);
    $donor_hemoglobin = mysqli_real_escape_string($con, $_POST['donor_hemoglobin']);
    $donor_platelets = mysqli_real_escape_string($con, $_POST['donor_platelets']);
    $blood_bag_no = mysqli_real_escape_string($con, $_POST['blood_bag_no']);
    $date_of_bleeding = mysqli_real_escape_string($con, $_POST['date_of_bleeding']);
    $component = mysqli_real_escape_string($con, $_POST['component']);
    $compatibility = mysqli_real_escape_string($con, $_POST['compatibility']);

    $remarks = mysqli_real_escape_string($con,$_POST['remarks']);

    mysqli_query($con, "update crossmatch_result set rec_name='$rec_name',rec_blood_group='$rec_blood_group',donor_name='$donor_name',
    donor_blood_group ='$donor_blood_group',donor_hbsag = '$donor_hbsag',donor_anti_hcv='$donor_anti_hcv',donor_anti_hiv='$donor_anti_hiv',
    donor_vdrl = '$donor_vdrl',donor_malarial='$donor_malarial',donor_hemoglobin = '$donor_hemoglobin',donor_platelets = '$donor_platelets',
    blood_bag_no = '$blood_bag_no',date_of_bleeding = '$date_of_bleeding',component = '$component',compatibility= '$compatibility' where id = '$id' ") or die(mysqli_error($con));
    mysqli_query($con, "update booking_details set remarks = '$remarks' where id ='$bdid'") or die(mysqli_error($con));

    echo '<script language="javascript">window.location = "' . $baseurl . 'report/' . $bdid . '.html"</script>';

}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $basetitle; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/jquery-selectric/selectric.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/codemirror/theme/duotone-dark.css">

  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/components.css">
  <!-- Custom style CSS -->

  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl; ?>images/favicon.png' />
</head>

<body>
 <?php
$id = $_GET['id'];
$books = mysqli_query($con, "select *  from booking_details where id='$id'") or die(mysqli_error());
while ($book = mysqli_fetch_array($books)) {
    $pid = $book['pid'];
    $bid = $book['bid'];
    $tid = $book['tid'];
    $report_remarks = $book['remarks'];
}
$tests = mysqli_query($con, "select * from tests where id='$tid' limit 1") or die(mysqli_error());
while ($ts = mysqli_fetch_array($tests)) {
    $type = $ts['type'];
    $test_title = $ts['title'];
    $remarks = $ts['remarks'];

}

$subtests = mysqli_query($con, "select * from tests where pid='$tid'") or die(mysqli_error());
$count_sub = mysqli_num_rows($subtests);
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
    $pass = $info['pass'];
    $gender = $info['gender'];
    $age_group = $info['age_level'];

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
          <div class="section-body">
                <div class="row">
                  <div class="col-lg-12">
<hr>
                    <div class="row">
                      <div class="col-md-12">
                      	<div class="card">
		                  <div class="card-header">
<strong>Patient Details:</strong>
		                  </div>
<div class="card-body">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
<thead>
<td>Full Name</td>
<td>Contact #</td>
<td>City</td>
<td>DOB</td>
<td>Age</td>


</thead>
<tbody>
<tr>

<td><?php echo $firstname . ' ' . $lastname; ?></td>
<td><?php echo $contact; ?></td>
<td><?php echo $city; ?></td>
<td><?php echo $dob; ?></td>
<td><?php echo $age; ?></td>
</tr>
</tbody>
<tfoot>

<?php if ($count_sub > 0) {?>
<tr>

<td colspan="5" align="center"><h5><?php echo $test_title; ?></h5></td>
</tr>
<?php }?>


</tfoot>
</table>
</div>
</div>
    </div>
  </div>
    </div>
  </div>
</div>
</div>
<?php
$num = 1;

if ($type == 'vb') {
    include "edit_reports_format/value_based_report.php";
} else if ($type == 'eliza') {
    include "edit_reports_format/eliza_report.php";
} else if ($type == 'pcr_qualitative') {
    include "edit_reports_format/pcr_qualitative_report.php";
}else if ($type == 'pcr_quantitative') {
    include "edit_reports_format/pcr_quantitative_report.php";
}else if ($type == 'radiology') {
    include "edit_reports_format/radiology_report.php";
} else if ($type == 'culture') {
    include "edit_reports_format/culture_report.php";
} else if ($type == 'bg') {
    include "edit_reports_format/bloodgroup_report.php";
} else if ($type == 'cog(pt)' || $type == 'cog(aptt)') {
    include "edit_reports_format/coagulation_report.php";
} else if ($type == 'cross_match_eliza' ||$type == 'cross_match_screening') {
    include "edit_reports_format/crossmatch_report.php";
} else if ($type == 'histopathology') {
    include "edit_reports_format/histopathology_report.php";
} else if ($type == 'screening') {
    include "edit_reports_format/screening_report.php";
} else if ($type == 'smear') {
    include "edit_reports_format/smear_report.php";
} else if ($type == 'analysis') {
    include "edit_reports_format/analysis_report.php";
}
?>
    </div>
  </section>
</div>
<?php include "includes/footer.php";?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl; ?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl; ?>assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo $baseurl; ?>assets/bundles/summernote/summernote-bs4.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/page/ckeditor.js"></script>


  <script src="<?php echo $baseurl; ?>assets/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/page/forms-advanced-forms.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery.sparkline.min.js"></script>

</body>


</html>