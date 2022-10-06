<?php
$results = mysqli_query($con, "select * from  screening_result where bdid='$id' ") or die(mysqli_error($con));
$count_sub = mysqli_num_rows($results);


while ($row = mysqli_fetch_array($results)) {
    $id = $row['id'];
    $testid = $row['testid'];
    $pt = $row['ptid'];
    $tests = mysqli_query($con, "select * from  tests where id=$testid") or die(mysqli_error());
    while ($r = mysqli_fetch_array($tests)) {
        $test_title = $r['title'];
    }
    if (!empty($row['result'])) {

        $output .= '<tr><td style="border-top: 1px solid #ddd;">' . $test_title . '</td><td style="border-top: 1px solid #ddd;text-align:center;">' . $row['result'] . '</td>';
        $records = mysqli_query($con, "select * from screening_result where ptid='$pt' and testid='$testid' and id <='$id' order by id DESC  limit 3 ") or die(mysqli_error());
        $row = mysqli_fetch_assoc($records);

        $bookings = [];
        $dates = [];
        $i = 0;
        while ($record = mysqli_fetch_array($records)) {

            $output .= '<td style="border-top: 1px solid #ddd;text-align:center">' .  $record['result'] . ' </td>';
            $b_id = $record['bid'];
            $boogs = mysqli_query($con, "select * from bookings where id='$b_id' limit 1") or die(mysqli_error());
            while ($data = mysqli_fetch_array($boogs)) {
                $bno = $data['bookingno'];
                $tdate = $data['test_date'];
            }
            $bookings[$i] = $bno;
            $dates[$i] = $tdate;
            $i++;
        }

        $output .= '</tr>';
    }
}

$style = array(
    'position' => '',
    'align' => 'C',
    'stretch' => false,
    'fitwidth' => true,
    'cellfitalign' => '',
    'border' => true,
    'hpadding' => 'auto',
    'vpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255),
    'text' => true,
    'font' => 'helvetica',
    'fontsize' => 8,
    'stretchtext' => 4
);

if ($count_sub > 1) {
    $header .= '<h2 align="left" style="font-weight:bold; text-decoration: underline;">' . $title . '</h2><br />  ';
} else {

    $level1 = mysqli_query($con, "select * from tests where id='$testid' ") or die(mysqli_error());
    while ($t = mysqli_fetch_array($level1)) {
        $pid =  $t['pid'];
    }
    if ($pid > 0) {
        $level2 = mysqli_query($con, "select * from tests where id='$pid' ") or die(mysqli_error());
        while ($t = mysqli_fetch_array($level2)) {
            $header .= '<h2 align="left" style="font-weight:bold; text-decoration: underline;">' . $t['title'] . '</h2><br />  ';
        }
    }
}
$split = explode(' ', $test_date); // Split up the whole string
$chunks = array_chunk($split, 3);
$result = array_map(function ($chunk) {
    return implode('-', $chunk);
}, $chunks);
$date = '<h6 style="font-height:10px">' . $result[0] . '</h6> ';
$pdf->writeHTMLCell(0, 0, '', '', $header, 0, 1, 0, true, '', true);
// $pdf->write1DBarcode($bookingno, 'C39', 120, 70, 20, 10, 0.4, $style, 'N');
// $pdf->SetXY(123, 80);
// $pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);


$row1 = '';
$row2 = '';
$row3 = '';

$content = '';

$content .= '  
   
      <table class="table table-md">  
        <tr style="line-height: 25px">  
        <th width="60%" style="font-weight:normal;border: 1px solid #ddd;">Test</th>';

$time = date("H:i", strtotime(explode("-", $result[1])[0] . " " . explode("-", $result[1])[1]));

$content .= '<th class="text-left" width="15%" style="border: 1px solid #ddd;font-size: 10px;"> 
        <span style="font-weight:normal">' . $bookingno . '</span><br><span>' . date("d-M-Y", strtotime($result[0])) . " " . $time . ' 
        </span> 
        </th>';

$row1 .= '<tr>';
$row2 .= '<tr>';
$row3 .= '<tr>';

if (count($bookings) == 1) {

    // $pdf->write1DBarcode($bookingno, 'C39', 145, 70, 20, 10, 0.4, $style, 'N');
    // $pdf->SetXY(148, 80);

    $split = explode(' ', $dates[0]); // Split up the whole string
    $chunks = array_chunk($split, 3);
    $result = array_map(function ($chunk) {
        return implode(' ', $chunk);
    }, $chunks);
    $date = '<h6 style="font-height:10px">' . $result[0] . '</h6> ';

    //$pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);
    $content .= '<th width="15%" style="font-weight:bold">Result</th>';
    $row1 .= '<th class="text-left" width="15%" > ' . $result[0] . '</th>';
    $row2 .= '<th class="text-left" width="15%" > ' . $result[1] . '</th>';
    $row3 .= '<th class="text-left" width="15%" > ' . $bookings[0] . '</th>';
} else if (count($bookings) >= 2) {

    // $pdf->write1DBarcode($bookingno, 'C39', 145, 70, 20, 10, 0.4, $style, 'N');
    // $pdf->SetXY(148, 80);

    $split = explode(' ', $dates[0]); // Split up the whole string
    $chunks = array_chunk($split, 3);
    $result = array_map(function ($chunk) {
        return implode(' ', $chunk);
    }, $chunks);
    $date = '<h6 style="font-height:10px">' . $result[0] . '</h6> ';

    //$pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);
    $content .= '<th width="15%" style="font-weight:bold">Result</th>';
    $row1 .= '<th class="text-left" width="15%" > ' . $result[0] . '</th>';
    $row2 .= '<th class="text-left" width="15%" > ' . $result[1] . '</th>';
    $row3 .= '<th class="text-left" width="15%" > ' . $bookings[0] . '</th>';

    // $pdf->write1DBarcode($bookingno, 'C39', 170, 70, 20, 10, 0.4, $style, 'N');
    // $pdf->SetXY(173, 80);
    $split = explode(' ', $dates[1]); // Split up the whole string
    $chunks = array_chunk($split, 3);
    $result = array_map(function ($chunk) {
        return implode(' ', $chunk);
    }, $chunks);
    $date = '<h6 style="font-height:10px">' . $result[0] . '</h6> ';

    //$pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);
    $content .= '<th width="15%" style="font-weight:bold"> Result</th>';
    $row1 .= '<th class="text-left" width="15%" > ' . $result[0] . '</th>';
    $row2 .= '<th class="text-left" width="15%" > ' . $result[1] . '</th>';
    $row3 .= '<th class="text-left" width="15%" > ' . $bookings[1] . '</th>';
}
$content .=  '</tr>  ';
$row1 .= '</tr>';
$row2 .= '</tr>';
$row3 .= '</tr>';

$content .= $row1;
$content .= $row2;
$content .= $row3;

$content .= $output;
$content .= '</table>';
