
<form method="post" action="<?php echo $baseurl; ?>create_report/<?php echo $id; ?>">
<div class="row">

 <div class="col-12 col-md-12 col-lg-12">

                <div class="card">
                 <div class="card-body">
<input type="hidden" name="pid" value="<?php echo $pid; ?>" class="form-control">
<input type="hidden" name="bid" value="<?php echo $bid; ?>" class="form-control">
<input type="hidden" name="bdid" value="<?php echo $id; ?>" class="form-control">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
<th width="3%">#</th>
<th>Test</th>
<th class="text-center" width="15%">Reference Value</th>
<th class="text-center" width="10%">Unit</th>
<th class="text-right" width="25%">Results</th>
                        </tr>

<?php

$a = 1;
if ($count_sub > 0) {
    
    $level1 = mysqli_query($con, "select * from tests where pid='$tid' and gid=0 ") or die(mysqli_error());

    while ($ref = mysqli_fetch_array($level1)) {
        $title = $ref['title'];
        $testid = $ref['id'];
        $gid = 0;
        include "vb_table.php";
    
    }    
  
   $level2 = mysqli_query($con, "select * from groups where test_id='$tid' order by id asc") or die(mysqli_error());

   $count_group = mysqli_num_rows($level2);
   
   if ($count_group > 0) {
        while ($group = mysqli_fetch_array($level2)) {
        $groupid = $group['group_id'];
        $gid = $group['id'];
        
        $level = mysqli_query($con, "select * from tests where id='$groupid'") or die(mysqli_error());
         
            while ($test = mysqli_fetch_array($level)) {
                   $groupname = $test['title'];
     
            }
        
        ?> 
        <tr><td colspan=5 style="font-weight:bold"><?php echo $groupname; ?></td> </tr>
        <?php
        
         $level3 = mysqli_query($con, "select * from tests where gid='$gid'") or die(mysqli_error());
         
            while ($test = mysqli_fetch_array($level3)) { 
                $title = $test['title'];
                $testid = $test['id'];
            
            include "vb_table.php";
        
            }
        }
    
    }


} else {
    
   $level4 = mysqli_query($con, "select * from groups where group_id='$tid' limit 1") or die(mysqli_error());
   $count_group = mysqli_num_rows($level4);
      
   if ($count_group > 0) {
       while ($group = mysqli_fetch_array($level4)) { 
           
            $gid = $group['id'];
            
            $level5 = mysqli_query($con, "select * from tests where gid='$gid' limit 1") or die(mysqli_error());
               $count_tests = mysqli_num_rows($level5);
                  
               if ($count_tests > 0) {
                    
                   while ($test = mysqli_fetch_array($level5)) { 
                        $title = $test['title'];
                        $testid = $test['id'];
                        include "vb_table.php";
                    }
               }
 
        }
   }
   
   else {
           
    $title = $test_title;
    $testid = $tid;
    $gid = 0;
    include "vb_table.php";
    
   }
     
}

?>

                      </table>
                    </div>

                  </div>
                </div>
        <div class="row" style="padding: 5%;">

                    <div class="col-lg-12 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Remarks</label>
<textarea name="remarks" class="summernote"></textarea>
	                    </div>
	                </div>
	           </div>


<div class="form-group" style="padding: 5%; text-align:left"> <?php echo $remarks; ?>                   </div>

  
                     <div class="form-group" style="padding: 2%;">
<input type="submit" name="value_based" value="Save Report" class="btn btn-block btn-info">                  
<div style="text-align:right; margin-top:2%"><input type="submit" name="publish_value_based" value="Conducted Test" class="btn btn-warning">  </div>

                    </div>
                  </div>
              </div>
</div>
</form>