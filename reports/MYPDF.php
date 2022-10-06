<?php

class MYPDF extends TCPDF
{

    //Page header
    public function Header()
    {
        $this->SetFont('times', '', 9);
        $this->Image('logo.png', 8, 6, 40, 40, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $style = array(
            'border' => false,
            'padding' => 0,
            'bgcolor' => false
        );

        if ($this->type == 'pcr_qualitative') {
            $this->Image('logo1.png', 115, 6, 20, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $this->Image('logo2.jpeg', 135, 0, 35, 35, 'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            include "header.php";

            $this->writeHTMLCell(160, 0, 20, 40, $header, 0, 0, 0, true, '', true);
            $results = mysqli_query($this->con, "select * from  pcr_qualitative_result where bdid='$this->id' ") or die(mysqli_error($con));
            while ($row = mysqli_fetch_array($results)) {
                $result = $row['result'];
            }

            $text = $this->firstname . ' ' . $this->lastname . ', P#:' . $this->patient_no . ', Case#:' . $this->bookingno . ', Result:' . $result . ' - ' . $this->result_date . ', Passport#:' . $this->pass_no;
            $this->write2DBarcode($text, 'QRCODE,H', 170, 35, 40, 25, $style, 'N');

            $img = '<img src="http://virtuallab.com.pk/' . $this->profile . '" width="80" height="80" />';

            $this->writeHTMLCell(50, 0, 170, 10, $img, 0, 0, 0, true, '', true);

            $this->SetTopMargin(65);
        } else {
            $this->Image('logo1.png', 130, 6, 13, 13, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            $this->Image('logo2.jpeg', 145, 2, 22, 22, 'JPEG', '', 'T', false, 300, '', false, false, 0, false, false, false);
            include "header.php";

            $this->writeHTMLCell(140, 0, 50, 20, $header, 0, 0, 0, true, '', true);
            $text = 'Name:' . $this->firstname . ' ' . $this->lastname . ', Patient no:' . $this->patient_no . ', Case no:' . $this->bookingno . ', Test date:' . $this->test_date . ', Passport no:' . $this->pass_no;
            $this->write2DBarcode($text, 'QRCODE,H', 165, 10, 40, 25, $style, 'N');
            $this->SetTopMargin(45);
        }

        // QRCODE,L : QR-CODE Low error correction
        //$pdf->Text(20, 25, 'QRCODE L');


        //$this->writeHTMLCell(0, 0, 163, 25, 'Patient No:'. $this->patient_no .'' , 0, 0, 0, true, '', true);
        //$this->writeHTMLCell(0, 0, 165, 29, 'Case No:'. $this->bookingno .'' , 0, 0, 0, true, '', true);



    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-50);
        // Set font
        $this->SetFont('times', 'I', 8);
        $this->Cell(0, 10, 'This is electronically verified report, No Signature(s) Required & not to be used for any legal purposes.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->ln();
        $this->writeHTML("<hr>", false, true, false, false, '');

        $limit = 5;
        $start = 20;
        global $con;
        $counsultants = mysqli_query($this->con, "select * from frenchise_doctor where labid='$this->labid' order by priority limit " . $limit) or die(mysqli_error($con));
        $counter = 0;
        while ($row = mysqli_fetch_array($counsultants)) {
            $counter++;
            $footer = "";
            // $footer .= '<table ><tr><th style="  border: 1px solid black;" align="center">' . $row["firstname"] . " " . $row["lastname"] . '</th></tr>
            //                     <tr><td></td></tr>
            //                     <tr><td align="center">        <strong>' . $row["designation"] . '</strong> </td></tr>
            //                     <tr><td align="center">        <strong>' . $row["education"] . '</strong>   </td></tr>
            //                     <tr><td align="center">        <strong>' . $row["department"] . '</strong>  </td></tr>

            //               </table>';
            $footer .= '<div
           ><h4>' . $row["firstname"] . " " . $row["lastname"] . '</h4>
                         ' . $row["designation"] . '<br>' . $row["education"] . '<br>' . $row["department"] . '<br>           
                    </div>';
            $this->writeHTMLCell(32, 30, $start, '', $footer, 0, 0, 0, true, '', true);
            $start = $start + 35;
        }

        $this->ln();
        $this->writeHTML("<hr>", false, true, false, false, '');
        $this->Cell(40, 10, '0316 465 7360', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(100, 10, '575-A Faisal Town Lahore.', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(40, 10, 'www.virtuallab.com.pk', 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
