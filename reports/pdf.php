<?php

// Include the main TCPDF library (search for installation path).

require_once('tcpdf/tcpdf.php');
date_default_timezone_set("Asia/Karachi");

$id = $_GET['id'];
$con=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");

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

$doctors = mysqli_query($con, "select * from doctors where id='$referby' limit 1") or die(mysqli_error());
//print_r(mysqli_num_rows($doctors));
while ($doc = mysqli_fetch_array($doctors)) {
    $docfirstname = $doc['firstname'];
    $doclastname = $doc['lastname'];
    $hospital = $doc['clinic'];
}


$patients = mysqli_query($con, "select * from patients where id='$pid' limit 1") or die(mysqli_error());
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


class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        $this->SetFont('times', '', 9);        
        $this->Image('logo.png', 8, 6, 40, 40, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);         
 
        $style = array(
            'border' => false,
            'padding' => 0,
            'bgcolor' => false
        );
        
        if($this->type == 'pcr_qualitative')
        {
            $this->Image('logo1.png', 115, 6, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);         
            $this->Image('logo2.jpeg', 135, 0, 35, 35, 'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);
       
            include "header.php";
        
            $this->writeHTMLCell(160, 0, 20, 40, $header, 0, 0, 0, true, '', true);
            $results=mysqli_query($this->con,"select * from  pcr_qualitative_result where bdid='$this->id' ") or die (mysqli_error());
            while($row=mysqli_fetch_array($results)){
                $result = $row['result'];
            }
            
            $text = $this->firstname.' '.$this->lastname.', P#:'.$this->patient_no. ', Case#:' .$this->bookingno. ', Result:' .$result.' - ' .$this->result_date.', Passport#:' .$this->pass_no ;
            $this->write2DBarcode($text, 'QRCODE,H', 170, 35, 40, 25, $style, 'N');
            
            $img = '<img src="http://virtuallab.com.pk/'.$this->profile.'" width="80" height="80" />';
             
            $this->writeHTMLCell(50, 0, 170, 10, $img, 0, 0, 0, true, '', true);
          
            $this->SetTopMargin(65);
    
        } else {
            $this->Image('logo1.png', 130, 6, 13, 13, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);         
            $this->Image('logo2.jpeg', 145, 2, 22, 22, 'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);  
            include "header.php";
        
            $this->writeHTMLCell(140, 0, 50, 20, $header, 0, 0, 0, true, '', true);
            $text = 'Name:'.$this->firstname.' '.$this->lastname.', Patient no:'.$this->patient_no. ', Case no:' .$this->bookingno. ', Test date:' .$this->test_date.', Passport no:' .$this->pass_no;
            $this->write2DBarcode($text, 'QRCODE,H', 165, 10, 40, 25, $style, 'N');
            $this->SetTopMargin(45);     
        }
        
        // QRCODE,L : QR-CODE Low error correction
        //$pdf->Text(20, 25, 'QRCODE L');

        
        //$this->writeHTMLCell(0, 0, 163, 25, 'Patient No:'. $this->patient_no .'' , 0, 0, 0, true, '', true);
        //$this->writeHTMLCell(0, 0, 165, 29, 'Case No:'. $this->bookingno .'' , 0, 0, 0, true, '', true);
       

  
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-50);
        // Set font
        $this->SetFont('times', 'I', 9);
        $this->Cell(0, 10, 'This is electronically verified report, No Signature(s) Required & not to be used for any legal purposes.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->ln();
        
        $start = 25;
        $counsultants=mysqli_query($this->con,"select * from frenchise_doctor where labid='$this->labid' order by priority limit 4") or die (mysqli_error());
        while($row=mysqli_fetch_array($counsultants)){
             $footer = "";
             $footer .= '   <table ><tr><th style="  border: 1px solid black;" align="center">'. $row["firstname"]." ".$row["lastname"].'</th></tr>
                                <tr><td></td></tr>
                                <tr><td align="center">        <strong>'. $row["designation"] .'</strong> </td></tr>
                                <tr><td align="center">        <strong>'. $row["education"] .'</strong>   </td></tr>
                                <tr><td align="center">        <strong>'. $row["department"] .'</strong>  </td></tr>
                  
                          </table>';
            $this->writeHTMLCell(40, 30, $start, '', $footer, 1, 0, 0, true, '', true);
            $start = $start + 40;
    
                    
        
        }
        
        
        $this->ln();
        $this->Cell(40, 10, '0314 4239340', 0, false, 'L', 0, '', 0, false, 'T', 'M');   
        $this->Cell(100, 10, '14-E, Maulana Shaukat Ali Road, Lahore', 0, false, 'C', 0, '', 0, false, 'T', 'M'); 
        $this->Cell(40, 10, 'www.virtuallab.com.pk', 0, false, 'R', 0, '', 0, false, 'T', 'M');

    }
}

set_time_limit(0);
ini_set('memory_limit', '-1');
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Virtual Lab');
$pdf->SetTitle($title);
$pdf->SetSubject('Reports');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


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
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

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
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

$heading = ' <h2 style="margin:1%">'.$cat_title.'</h2>';

$pdf->writeHTMLCell(0, 7, '', '', $heading, 1, 1, 0, true, '', true);

$pdf->ln();



if ($type == 'culture') {
    include "culture.php";
} else if ($type == 'radiology') {
    include "radiology.php";
} else if ($type == 'screening') {
    include "screening.php";
}

else if ($type == 'vb') {
    include "value_based.php";
} else if ($type == 'pcr_qualitative') {
    include "pcr_qualitative.php";
} else if ($type == 'pcr_quantitative') {
    include "pcr_quantitative.php";
} 
else if ($type == 'eliza') {
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

 
// Print text using writeHTMLCell()

$pdf->writeHTMLCell(0, 0, '', '', $content, 0, 1, 0, true, '', true);

$pdf->SetFont('times', '', 9 );
$pdf->writeHTMLCell(0, 0, '', '', '', 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $test_remarks, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', '', 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $report_remarks, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('report.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
