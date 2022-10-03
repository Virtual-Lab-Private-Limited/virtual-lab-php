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
                    $results = mysqli_query($con, "select * from  analysis_result where bdid='$report_id'  ") or die(mysqli_error());
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
                        <th >Test</th>
                        <th class="text-center" colspan="2">Results</th>
                        </tr>
                        <tr>
                        <th></th>
                        <th class="text-center">Left</th>
                        <th class="text-center">Right</th>
                    </tr>

                      <?php
                        $initial = 0;
                        $results = mysqli_query($con, "select * from  analysis_result where bdid='$report_id' order by priority asc ") or die(mysqli_error());
           
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
                              
                          }
                          

                      ?>
                      <tr>
        <td><?php echo $test_title;?></td>
        <td class="text-center"><?php echo $row['left_result'];?></td>
        <td class="text-center"><?php echo $row['right_result'];?></td>
        
   
        
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