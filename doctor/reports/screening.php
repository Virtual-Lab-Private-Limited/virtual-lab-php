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
$results = mysqli_query($con, "select * from  screening_result where bdid='$report_id'") or die(mysqli_error());
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

<tr>
<th width="47%">Test</th>
<th class="text-left" width="10%">Results</th>
</tr>

<?php
while($row=mysqli_fetch_array($results)){
    $id = $row['testid'];
    $tests=mysqli_query($con,"select * from  tests where id=$id") or die (mysqli_error());
    while($r=mysqli_fetch_array($tests)){
        $test_title = $r['title'];
    }
    

?>
<tr>
        <td><?php echo $test_title;?></td>
        <td class="text-left"><?php echo $row['result'];?></td>
</tr>
<?php } ?>

                      </table>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12"><p><?php echo $test_remarks;?></p></div>
                    <?php include("footer.php"); ?>
                <hr>
              </div>
              
</div> 