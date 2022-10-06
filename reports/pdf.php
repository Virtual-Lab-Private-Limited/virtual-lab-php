<?php

// Include the main TCPDF library (search for installation path).

require_once('tcpdf/tcpdf.php');
date_default_timezone_set("Asia/Karachi");

$id = $_GET['id'];
// $con = mysqli_connect("localhost", "nxqxtdmy_virtual", "Allah@Muhammad@786", "nxqxtdmy_virtuallab");
$con = mysqli_connect("localhost", "root", "", "virtuallab_db");

// ---------------------------------------------------------
// Create PDF Page

set_time_limit(0);
ini_set('memory_limit', '-1');
// create new PDF document
require_once(dirname(__FILE__) . '/MYPDF.php');

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Virtual Lab');
$pdf->SetSubject('Reports');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 001', PDF_HEADER_STRING, array(0, 64, 255), array(0, 64, 128));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// set header and footer fonts
$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, 65);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}


// set default font subsetting mode
$pdf->setFontSubsetting(true);
$pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));



// ---------------------------------------------------------
// Generate Tests Reports By Booking ID

$booking_details = mysqli_query($con, "select * from booking_details where id='$id' limit 1") or die(mysqli_error($con));
while ($data = mysqli_fetch_array($booking_details)) {
    $bid = $data['bid'];
}
$booking_details = mysqli_query($con, "select * from booking_details where bid='$bid' and status='Complete'") or die(mysqli_error($con));
while ($data = mysqli_fetch_array($booking_details)) {
    $id  = $data['id'];
    $bid = $data['bid'];
    $pid = $data['pid'];
    $tid = $data['tid'];
    $report_remarks = $data['remarks'];
    $result_date = $data['result_date'];
    $title = "";
    $tests = mysqli_query($con, "select * from tests where id='$tid' limit 1") or die(mysqli_error($con));

    while ($data = mysqli_fetch_array($tests)) {
        $title = $data['title'];
        $type = $data['type'];
        $test_remarks = $data['remarks'];
        $catid = $data['catid'];
    }


    $bookings = mysqli_query($con, "select * from bookings where id='$bid' limit 1") or die(mysqli_error($con));
    //print_r(mysqli_num_rows($bookings));

    while ($data = mysqli_fetch_array($bookings)) {
        $bookingno = $data['bookingno'];
        $test_date = $data['test_date'];
        $referby = $data['referby'];
        $sample_collect = $data['sample_collect'];
        $ticket_no = $data['ticket_no'];
        $flight_date = $data['flight_date'];
        $flight_no = $data['flight_no'];
        $pass_no = $data['pass_no'];
        $labid = $data['labid'];
    }

    $doctors = mysqli_query($con, "select * from doctors where id='$referby' limit 1") or die(mysqli_error($con));
    //print_r(mysqli_num_rows($doctors));
    while ($doc = mysqli_fetch_array($doctors)) {
        $docfirstname = $doc['firstname'];
        $doclastname = $doc['lastname'];
        $hospital = $doc['clinic'];
    }


    $patients = mysqli_query($con, "select * from patients where id='$pid' limit 1") or die(mysqli_error($con));
    //print_r(mysqli_num_rows($patients));
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
        $patient_no = $info['patient_no'];
        $profile = $info['profile'];
    }

    $categories = mysqli_query($con, "select * from categories where id='$catid' limit 1") or die(mysqli_error($con));
    //print_r(mysqli_num_rows($categories));
    while ($cat = mysqli_fetch_array($categories)) {
        $cat_title = $cat['category'];
    }

    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // times or times to reduce file size.
    $pdf->SetFont('times', '', 9, '', true);
    $pdf->firstname = $firstname;
    $pdf->lastname = $lastname;
    $pdf->test_date = $test_date;
    $pdf->age = $age;
    $pdf->gender = $gender;
    $pdf->result_date = $result_date;
    $pdf->contact = $contact;
    $pdf->sample_collect = $sample_collect;
    $pdf->blood_group = $blood_group;
    $pdf->docfirstname = $docfirstname;
    $pdf->doclastname = $doclastname;
    $pdf->pass_no = $pass_no;
    $pdf->flight_no = $flight_no;
    $pdf->ticket_no = $ticket_no;
    $pdf->flight_date = $flight_date;
    $pdf->patient_no = $patient_no;
    $pdf->bookingno = $bookingno;
    $pdf->labid = $labid;
    $pdf->con = $con;
    $pdf->type = $type;
    $pdf->id = $id;
    $pdf->profile = $profile;

    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage();

    // set text shadow effect

    $heading = '<h2 style="margin:0%; width: 100%; border-top: 1px solid #000; border-bottom: 1px solid #000 ">' . $cat_title . '</h2>';

    $pdf->writeHTMLCell(0, 0, '', '', $heading, 0, 1, 0, false, '', true);

    $pdf->ln();
    $content = "";
    $header = "";
    $output = "";
    $row1 = '';
    $row2 = '';
    $row3 = '';
    // die($id);
    if ($type == 'culture') {
        include "culture.php";
    } else if ($type == 'radiology') {
        include "radiology.php";
    } else if ($type == 'screening') {
        include "screening.php";
    } else if ($type == 'vb') {
        include "value_based.php";
    } else if ($type == 'pcr_qualitative') {
        include "pcr_qualitative.php";
    } else if ($type == 'pcr_quantitative') {
        include "pcr_quantitative.php";
    } else if ($type == 'eliza') {
        include "eliza.php";
    } else if ($type == 'bg') {
        include "bloodgroup.php";
    } else if ($type == 'cog(pt)') {
        include "cog(aptt).php";
    } else if ($type == 'cog(aptt)') {
        include "cog(pt).php";
    } else if ($type == 'cross_match_eliza') {
        include "crossmatch_eliza.php";
    } else if ($type == 'cross_match_screening') {
        include "crossmatch_screening.php";
    } else if ($type == 'histopathology') {
        include "histopathology.php";
    } else if ($type == 'smear') {
        include "smear.php";
    } else if ($type == 'analysis') {
        include "analysis.php";
    }

    // die($content);
    // Print text using writeHTMLCell()

    $pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);

    $pdf->SetFont('times', '', 9);
    $pdf->writeHTMLCell(0, 0, '', '', '', 0, 1, 0, true, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $test_remarks, 0, 1, 0, true, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', '', 0, 1, 0, true, '', true);
    $pdf->writeHTMLCell(0, 0, '', '', $report_remarks, 0, 1, 0, true, '', true);
}



// ---------------------------------------------------------
// Set Name
$name = ucwords(strtolower(preg_replace('/[0-9\@\.\;\" "]+/', '', $lastname))) . "-Report-" . $bookingno;

// ---------------------------------------------------------
// Set PDF Title
$pdf->SetTitle($name);



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output($name . '.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
