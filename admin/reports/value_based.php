<div id="div_print">
      <style>
        table { border-collapse:collapse; overflow: hidden }
        table td { border:none;}
    </style>
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                  <?php include("header.php"); ?>
                  </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                    <?php 
                    
                    $results = mysqli_query($con, "select * from  value_based_result where bdid='$report_id'  ") or die(mysqli_error());
                    $count_sub=mysqli_num_rows($results);
                 
                   
                    ?>
                    
                    <?php if ($count_sub > 1) { ?>
                    
                    <h4><?php echo $title; ?></h4>
                    
                    <?php } else {
                        
                        $level1 = mysqli_query($con, "select * from tests where id='$tid' ") or die(mysqli_error());
                        while($t=mysqli_fetch_array($level1)) {
                            $pid =  $t['pid'];
                            
                        }
                        if ($pid > 0){
                            $level2 = mysqli_query($con, "select * from tests where id='$pid' ") or die(mysqli_error());
                            while($t=mysqli_fetch_array($level2)) {
                                $parent =  $t['title'];
                                
                            }
                        }
    
                    }
                    
                    
                    
                    ?>
                    
                    <h4><?php echo $parent; ?></h4>
                    <table class="table table-md" style="overflow-x: hidden; overflow: hidden;">
               
                    <tr>
                    <th width="47%">Test</th>
                    <th>Reference Value</th>
                    <th>Unit</th>
                    <th > Results</th>
                    
                    
                    
                    </tr>

                      <?php
                        $initial = 0;
                        $results = mysqli_query($con, "select * from  value_based_result where bdid='$report_id' order by priority asc ") or die(mysqli_error());
           
                        while($row=mysqli_fetch_array($results)) {
                          $id = $row['id'];
                          $ptid = $row['ptid'];
                          $testid = $row['testid'];
                          $gid = $row['gid'];
                        
                          if($gid > 0 && ($initial != $gid)  ) {
                              
                                $level1 = mysqli_query($con, "select * from groups where id='$gid'   ") or die(mysqli_error());
                                while ($group = mysqli_fetch_array($level1)) {
                                       $groupid = $group['group_id'];
                                       $level2 = mysqli_query($con, "select * from tests where id='$groupid' limit 1") or die(mysqli_error());
                                        while ($test = mysqli_fetch_array($level2)) {
                                                $groupname = $test['title'];
                                        }
                                }
                               
                            ?>
                               <tr><td colspan=5 style="font-weight:bold"><?php echo $groupname; ?></td> </tr>
      
                              <?php
                              $initial = $gid;
                          }
                      
                          $tests=mysqli_query($con,"select * from  tests where id=$testid") or die (mysqli_error());
                          while($r=mysqli_fetch_array($tests)){
                              $test_title = $r['title'];
                              $unit = $r['unit'];
                          }
                          

                      ?>
                      <tr>
        <td><?php echo $test_title;?></td>
        <td><?php
        $rid = 0;
        $refrence_value = '';
        $references = mysqli_query($con, "select * from test_reference where testid='$testid' and gender='$gender' limit 1") or die(mysqli_error($con));
        $rows = mysqli_num_rows($references);
                          
       if ( $rows > 0)
        {
 
            while ($ref1 = mysqli_fetch_array($references)) {
                $refrence_value = $ref1['minimum_value'] . ' - ' . $ref1['maximum_value'] ;
                echo $refrence_value;
                $rid = $ref1['id'];
            }
    
        } else {
           
            $reference = mysqli_query($con, "select * from test_reference where testid='$testid' and additional_data != ''  limit 1") or die(mysqli_error($con));
            while ($ref2 = mysqli_fetch_array($reference)) {
                $refrence_value = $ref2['additional_data']  ;
                echo $refrence_value;
                $rid = $ref2['id'];
            }
    
        }
        ?></td>
        <td><?php echo $unit;?></td>
        <td ><?php echo $row['value'];?></td>
        
   <?php
            $records = mysqli_query($con, "select * from value_based_result where ptid='$ptid' and testid='$testid' and id <='$id' order by id DESC  limit 3 ") or die(mysqli_error());
            $row = mysqli_fetch_assoc($records);
            
            while($record=mysqli_fetch_array($records)){ ?>
                      <td ><?php echo $record['value'];?></td>
                     
    <?php   }   ?> 
        
</tr>
<?php } ?>
                      </table>
                    </div>
                  
                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:5%; margin-bottom:5%"><p><?php echo $test_remarks;?></p></div>
                  
                    <div class="col-lg-12 col-md-12 col-sm-12" style="margin-bottom:5%"><p><?php echo $report_remarks;?></p></div>
                  
              </div>
              
</div> 
   
  
  <?php include("footer.php"); ?>
                    

</div></div>