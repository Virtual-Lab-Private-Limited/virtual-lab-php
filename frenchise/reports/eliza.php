
<div id="div_print">
              <div class="invoice-print">
                <div class="row">
                  <div class="col-lg-12">
                 <?php include("header.php"); ?>
                </div>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <div class="table-responsive">
                      
<style>
    @media print {
        #head { background-color: #ddd !important;
         -webkit-print-color-adjust: exact;
        }
    }
    #head { background-color: #ddd !important;
        -webkit-print-color-adjust: exact;
    }

    table { border-collapse:collapse; overflow: hidden }
    table td { border:none;}
    
</style>
                      
<?php 

$results = mysqli_query($con, "select * from  eliza_result where bdid='$report_id' order by priority asc  ") or die(mysqli_error());
$count_sub=mysqli_num_rows($results);

?>
<?php if ($count_sub > 1) { ?>
<h4 style="font-size:16px;"><?php echo $title; ?></h4>

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

<table class="table table-md">

<tr id="head">
<th width="47%">Test</th>
<th class="text-left" width="15%">Patient Value</th>

<th class="text-left" width="10%">Results</th>
<th class="text-left" width="15%">Patient Value</th>
<th class="text-left" width="15%">Patient Value</th>

                    </tr>

<?php
while($row=mysqli_fetch_array($results)){
  
    $id = $row['id'];
    $ptid = $row['ptid'];
    $testid = $row['testid'];
    
    
    $tests=mysqli_query($con,"select * from  tests where id=$testid") or die (mysqli_error());
    while($r=mysqli_fetch_array($tests)){
        $test_title = $r['title'];
        $unit = $r['unit'];
    }
    

?>
<tr>
        <td><?php echo $test_title;?></td>
        <td><?php echo $row['patient_value'];?></td>
      
        <td class="text-left"><?php echo $row['result'];?></td>
        
           <?php
            $records = mysqli_query($con, "select * from eliza_result where ptid='$ptid' and testid='$testid' and id <='$id' order by id DESC  limit 3 ") or die(mysqli_error());
            $row = mysqli_fetch_assoc($records);
            
            while($record=mysqli_fetch_array($records)){ ?>
                      <td ><?php echo $record['patient_value'];?></td>
                     
    <?php   }   ?> 
</tr>
<?php } ?>

                      </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p>
        </div>
                    <?php include("footer.php"); ?>
                <hr>
              </div>
              
</div> 