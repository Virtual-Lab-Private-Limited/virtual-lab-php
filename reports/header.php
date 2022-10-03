<?php


$header= '';
$header .= '
                      <table class="table table-hover table-sm" id="header" >
                        <tr>
                          <td width="18%">Patient no</td>
                          <th class="text-left noborder" style="font-weight:bold"  width="20%">'.$this->patient_no.'</th>
                          <td class="text-left" width="20%">Case no</td>
                          <th class="text-left " style="font-weight:bold">'.$this->bookingno.'</th>
                 
                        </tr>
                        <tr>
                           <td width="18%">Patient Name</td>
                           <th class="text-left " style="font-weight:bold" width="20%">'. $this->firstname . " " . $this->lastname.'</th>
                           <td class="text-left" width="20%">Registration Date</td>
                          <th class="text-left " style="font-weight:bold">'.$this->test_date.'</th>
                        </tr>
                        <tr>
                          <td width="18%">Age/Sex</td>
                          <th class="text-left noborder" style="font-weight:bold">'.$this->age . "Y / " . $this->gender.'</th>
                          <td class="text-left" width="20%">Result Reported</td>
                          <th class="text-left " style="font-weight:bold">'.$this->result_date.'</th>
                        </tr>
                        <tr>
                            <td width="18%">Contact #</td>
                            <th class="text-left noborder" style="font-weight:bold">'.$this->contact.'</th>
                            <td class="text-left" width="20%">Sample </td>
                            <th class="text-left noborder" style="font-weight:bold">';
if ($this->sample_collect == "rider") {
    $header.= "Virtual Lab";
} else {
   $header.= $this->sample_collect;

}
                        $header.='   </th>
                        </tr>
                        <tr >
                          <td width="18%" noborder>Blood Group</td>
                          <th class="text-left noborder" style="font-weight:bold"> '.$this->blood_group.'</th>
                          <td class="text-left" width="18%" noborder>Refer By</td>
                          <th class="text-left noborder" style="font-weight:bold">'.$this->docfirstname . " " . $this->doclastname.'</th>
                        </tr>';
                      if (!empty($this->pass_no) && !empty($this->flight_no)) {
                      $header.=' <tr >
                          <td width="18%" noborder>Passport No</td>
                          <th class="text-left noborder" style="font-weight:bold">'. $this->pass_no .'</th>
                          <td class="text-left" width="18%" noborder>Flight No</td>
                          <th class="text-left noborder" style="font-weight:bold"> '. $this->flight_no .'</th>
                        </tr>';
                      }if (!empty($this->ticket_no) && !empty($this->flight_date)) {
                      $header.='<tr >
                          <td width="18%" noborder>Ticket No</td>
                          <th class="text-left noborder" style="font-weight:bold">'. $this->ticket_no .'</th>
                          <td class="text-left" width="18%" noborder>Flight Date</td>
                          <th class="text-left noborder" style="font-weight:bold"> '. $this->flight_date .'</th>
                        </tr>';
                      }

                     $header.=' </table>
                      
                      ';


?>