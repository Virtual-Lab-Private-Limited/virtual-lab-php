<form method="post" action="<?php echo $baseurl; ?>create_report/<?php echo $id; ?>"> 
    <div class="row">
    <input type="hidden" name="pid" value="<?php echo $pid;?>" class="form-control">
    <input type="hidden" name="bid" value="<?php echo $bid;?>" class="form-control">
    <input type="hidden" name="bdid" value="<?php echo $id;?>" class="form-control">
    <input type="hidden" name="tid" value="<?php echo $tid;?>" class="form-control">

<?php
             
$db_results = mysqli_query($con, "select * from crossmatch_result where bdid='$id' and tid='$tid' ") or die(mysqli_error());
        $count_results = mysqli_num_rows($db_results);
        
        $rec_bg = '';
        $donor_bg = '';
        $donor_name = '';
        $donor_hbsag = '';
        $donor_hcv = '';
        $donor_hiv = '';
        $donor_vdrl = '';
        $donor_malarial = '';
        $donor_hemoglobin = '';
        $donor_platelets = '';
        $blood_bag_no = '';
        $date_of_bleeding = '';
        $component = '';
        $compatibility = '';
      
        
        if($count_results > 0) {
            while ($booking = mysqli_fetch_array($db_results)) {
              
                $rec_bg = $booking['rec_blood_group'];
                
                
                $donor_bg = $booking['donor_blood_group'];
                $donor_name = $booking['donor_name'];
                $donor_hbsag = $booking['donor_hbsag'];
                $donor_hcv = $booking['donor_anti_hcv'];
                $donor_hiv = $booking['donor_anti_hiv'];
                $donor_vdrl = $booking['donor_vdrl'];
                $donor_malarial = $booking['donor_malarial'];
                $donor_hemoglobin = $booking['donor_hemoglobin'];
                $donor_platelets = $booking['donor_platelets'];
                $blood_bag_no = $booking['blood_bag_no'];
                $date_of_bleeding = $booking['date_of_bleeding'];
                $component = $booking['component'];
                $compatibility = $booking['compatibility'];
            }
            
        }
    
?>
 <div class="col-12 col-md-12 col-lg-12">            
                <div class="card">
                 <div class="card-body">
                  <div class="col-md-12">
                  <label><h4>Recipient information: </h4></label>
                  <div class="row">

              		<div class="col-lg-6 col-md-6 col-sm-12">
                        
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="rec_name" value="<?php echo $firstname.' '.$lastname;?>" class="form-control" >               
                       </div>
                    </div>

                   </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
                    <input type="text" name="rec_blood_group" value="<?php echo $rec_bg;?>" class="form-control" placeholder="Blood Group">                      </div>

                    </div>
                    
                    </div>   
</div>
                    <label><h4>Donor information: </h4></label> 
                    <div class="row">
                
              		<div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="form-group">
                        <div class="input-group">
                        <input type="text" name="donor_name" value="<?php echo $donor_name; ?>" class="form-control" placeholder=" Donor Name " >                      </div>

                    </div>
                    
                     <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_hbsag" list="hbsag"  autocomplete="off" value="<?php echo $donor_hbsag;?>" class="form-control" placeholder=" Donor HBsAG " >                      </div>
                      <datalist id="hbsag" >
                          <option value="Reactive">
                          <option value="Non Reactive">                     
                      </datalist>
                    </div>
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_anti_hcv" list="hcv" autocomplete="off" value="<?php echo $donor_hcv;?>" class="form-control" placeholder=" Anti HCV " >                      </div>
                      <datalist id="hcv" >
                          <option value="Reactive">
                          <option value="Non Reactive">                     
                      </datalist>
                    </div>
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_anti_hiv" list="hiv"  autocomplete="off" value="<?php echo $donor_hiv;?>" class="form-control" placeholder=" Anti HIV " >                      </div>
                      <datalist id="hiv" >
                          <option value="Reactive">
                          <option value="Non Reactive">                     
                      </datalist>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                    <input type="text" name="donor_vdrl"  class="form-control" list="vdrl" autocomplete="off" value="<?php echo $donor_vdrl; ?>" placeholder=" Donor VDRL " >                      
                    <datalist id="vdrl" >
                          <option value="Positive">
                          <option value="Negative">                     
                      </datalist></div>
                    </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group">
                      <div class="input-group">
<input type="text" name="donor_blood_group" value="<?php echo $donor_bg; ?>" class="form-control" placeholder=" Donor Blood Group " >                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="donor_malarial" list="malarial" value="<?php echo $donor_malarial;?>" autocomplete="off" class="form-control" placeholder=" Malarial Parasite " >                      </div>
                      <datalist id="malarial" >
                          <option value="Positive">
                          <option value="Negative">                      
                      </datalist>
                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="donor_hemoglobin" value="<?php echo $donor_hemoglobin;?>" class="form-control" placeholder=" Hemoglobin "  >                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="donor_platelets" value="<?php echo $donor_platelets; ?>" class="form-control" placeholder=" Platelets " >                      </div>

                    </div>
                    </div>

<?php echo $message;?>


	                </div>

                  </div>
                </div>
</div>
              </div>
<div class="col-12 col-md-12 col-lg-12">
            
                <div class="card">
                 <div class="card-body">
                  <div class="col-md-12">
                  <div class="row">

              		<div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                        </div>
<input type="number" name="blood_bag_no" value="<?php echo $blood_bag_no; ?>" class="form-control"  placeholder=" Blood Bag No. ">                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="date_of_bleeding" value="<?php echo $date_of_bleeding; ?>" class="form-control" placeholder=" Date of Bleeding " >                      </div>

                    </div>

                    </div>
              		<div class="col-lg-6 col-md-6 col-sm-12">
                      <div class="form-group">
             
                      <input type="text" name="component" list="com-dropdown" value="<?php echo  $component; ?>" class="form-control" autocomplete="off"  placeholder=" Component " >
                     <datalist id="com-dropdown" >
                          <option value="Plasma">
                          <option value="Blood">
                          <option value="Platelets">
                          <option value="Serum">
                      </datalist>
                      </div>
                    
                      <div class="form-group">
                      <div class="input-group">
                      <input type="text" name="compatibility" list="cmp-dropdown" value="<?php echo $compatibility; ?>" autocomplete="off" class="form-control" placeholder=" Compatibility " >                      </div>
                      <datalist id="cmp-dropdown" >
                          <option value="Components are compatible">
                          <option value="Components are not compatible">
                          <option value="Blood group is compatible but antibodies are not compatible">
                      </datalist>
                    </div>
                      
                    </div>
                   <div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>
  
                   </div>
                 </div>
                </div>
                
                <div class="form-group"  style="padding: 2%;">
                    <input type="submit" name="cross_match" class="btn btn-block btn-info" value="Save">                   
                    <div style="text-align:right; margin-top:2%"><input type="submit" name="publish_cross_match" value="Conducted Test" class="btn btn-warning">  </div>
                </div>                
                
                
</div>
</div>

</div>

</form>
