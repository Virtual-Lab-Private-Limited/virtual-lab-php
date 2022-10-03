<style>


#header td {
    border: none;
}
</style>
<div class="row">
                    	<div class="col-sm-3">
                    		<div class="invoice-title">
		                      <div class="login-invoice login-invoice-color">
		            			<img alt="image" src="<?php echo $baseurl?>images/logo.png" height="180" /></div>
		            			</div>
                    	</div>
                      <div class="col-sm-7">
                      <table class="table table-hover table-sm" id="header" >
                        <tr>
                          <td width="18%">Patient Name</td>
                          <th class="text-left "><?php echo $firstname . ' ' . $lastname; ?></th>
                          <td class="text-left" width="25%">Registration Date</td>
                          <th class="text-left "><?php echo $test_date; ?></th>
                        </tr>
                        <tr>
                          <td width="18%">Age/Sex</td>
                          <th class="text-left noborder"><?php echo $age . 'Y / ' . $gender; ?></th>
                          <td class="text-left" width="18%">Result Reported</td>
                          <th class="text-left noborder"><?php echo $result_date; ?></th>
                        </tr>
                        <tr>
                            <td width="18%">Contact #</td>
                            <th class="text-left noborder"><?php echo $contact; ?></th>
                            <td class="text-left" width="18%">Sample Brought to</td>
                            <th class="text-left noborder"><?php
if ($sample_collect == 'rider') {
    echo 'Virtual Lab';
} else {
    echo $sample_collect;

}?>
                            </th>
                        </tr>
                        <tr >
                          <td width="18%" noborder>Blood Group</td>
                          <th class="text-left noborder"><?php echo $blood_group; ?></th>
                          <td class="text-left" width="18%" noborder>Consutant</td>
                          <th class="text-left noborder"><?php echo $docfirstname . ' ' . $doclastname; ?></th>
                        </tr>
                     <?php if (!empty($pass_no) && !empty($flight_no)) {?>
                      <tr >
                          <td width="18%" noborder>Passport No</td>
                          <th class="text-left noborder"><?php echo $pass_no; ?></th>
                          <td class="text-left" width="18%" noborder>Flight No</td>
                          <th class="text-left noborder"><?php echo $flight_no; ?></th>
                        </tr>
                     <?php }if (!empty($ticket_no) && !empty($flight_date)) {?>
                      <tr >
                          <td width="18%" noborder>Ticket No</td>
                          <th class="text-left noborder"><?php echo $ticket_no; ?></th>
                          <td class="text-left" width="18%" noborder>Flight Date</td>
                          <th class="text-left noborder"><?php echo $flight_date; ?></th>
                        </tr>
                     <?php }?>

                      </table>
                      </div>
                      <div class="col-sm-2" >
                        <div class="row" style="padding-top:5%;padding-bottom:5%">  
                          <?php 
                          include 'barcode128.php';
                          $barcode = bar128(strval($bookingno));
                          echo $barcode;
                          ?>
                         </div>
                         <div class="row">Patient No:<span style="font-weight:bold"> <?php echo ' '.$patient_no; ?></span></div>
                         <div class="row">Case No: <span style="font-weight:bold"><?php echo ' '.$bookingno; ?></span></div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-12" style="border: 1px groove; border-right:none; border-left:none">

<h3 style="text-align:left;"><?php echo $cat_title; ?></h3>
                      </div>
                    </div>
                  </div>
