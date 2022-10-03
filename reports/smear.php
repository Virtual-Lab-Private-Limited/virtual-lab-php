<?php 

$results = mysqli_query($con, "select * from  smear_result where bdid='$id'") or die(mysqli_error());
while($booking=mysqli_fetch_array($results)){       
    $specimen = $booking['specimen'];
    $clinical_details = $booking['clinical_details'];
    $examination = $booking['examination'];
    $conclusion = $booking['conclusion'];
    $interpretation = $booking['interpretation'];
    $notes = $booking['notes'];
  
}

$content .= ' 

    
    <h3 style="margin-top:20px">Clinical Details:</h3>
    '. $clinical_details.'
    <h3>Specimen Source:</h3>
    '. $specimen .'
    <h3>Microscopic Examination:</h3>
    '. $examination .'
    <h3>Microscopic Interpretation:</h3>
    '. $interpretation .'
    <h3>Conclusion:</h3>
    '. $conclusion .'
    <h3>Clinical Notes:</h3>
    '. $notes .'
 


 ';

?>