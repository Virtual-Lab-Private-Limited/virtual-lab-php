<div id="footer" style="text-align:center">
    <style>
        .card{
            border:1px solid black;
            border-bottom:none;
            border-radius: 0 !important;
  
        }
        .card-body{
            border-top:1px solid black;
            border-bottom:none;
        }
   
    </style>
 <p>This is electronically verified report, No Signature(s) Required & not to be used for any legal purposes.</p>
  
<div class="row " style="text-align:center; padding-right:15px; padding-left:15px" >
   
<?php
$counsultants=mysqli_query($con,"select * from  frenchise_doctor where labid='$session_labid' order by priority limit 4") or die (mysqli_error());
while($row=mysqli_fetch_array($counsultants)){

?> 
                     <div class="col-lg-3" style="margin: -15px; width:275px">
                      	<div class="card" >
		                  <div class="card-header" style="text-align:center;justify-content: center;" >
<span style="font-weight:bold;justify-content: center;"><?php echo $row['firstname'].' '.$row['lastname'];?></span>
		                  </div>
<div class="card-body" style="height:130px ">
<div class="invoice-detail-item">
<div class="invoice-detail-name">
<strong><?php echo $row['designation'];?></strong>
<strong><?php echo $row['education'];?></strong><br>
<strong><?php echo $row['department'];?></strong>
</div>
                        </div>

		                </div>
		                </div>
                      </div>
                      
<?php
}
?>
                    </div>

                  
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4" style="font-weight:bold;">
<p align="left"><i class="fas fa-phone-volume"></i><strong> 0314 4239340</strong></p>
</div>
                          
                      <div class="col-lg-4 col-md-4 col-sm-4" style="font-weight:bold;">
<p align="center"  ><i class="fas fa-home"></i><strong> 14-E, Maulana Shaukat Ali Road, Lahore</strong></p>
</div>
                    <div class="col-lg-4 col-md-4 col-sm-4" style="font-weight:bold;">
                    <p align="right"><i class="fas fa-globe"></i><strong> www.virtuallab.com.pk</strong></p>
                    </div>
                  
                  </div>

                </div></div>