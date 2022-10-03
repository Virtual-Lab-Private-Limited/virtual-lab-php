<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

    $id = $_GET['id'];
    $rid = $_GET['rid'];
   
    if(isset($id)){
        $bno=$_GET['bno'];
        mysqli_query($con, "update bookings set test_status = 'Cancel' where id ='$id'") or die(mysqli_error($con));
        mysqli_query($con, "update booking_details set status = 'Cancel', runtime_status= 'Cancel by Admin' where bid ='$id'") or die(mysqli_error($con));
        mysqli_query($con, "delete from collection_center_earnings where b_no ='$bno'") or die(mysqli_error($con));
     
        header("location:".$baseurl."onlinebookings.html");
    }
    
    if(isset($rid)){
        mysqli_query($con, "update booking_details set runtime_status = 'Resample Requested' where bid ='$id'") or die(mysqli_error($con));
        mysqli_query($con, "update rider_earnings set valid = 0 where r_id ='$rid'") or die(mysqli_error($con));
        header("location:".$baseurl."onlinebookings.html");
    }
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>By Online Booking | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/jquery-selectric/selectric.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
 <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css"> 
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            
            <div class="row">
              <div class="col-12">
           <div class="section-body">
          <div class="row">
          
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                        <button id="btn-show-all-children" type="button" class="btn btn-info">Expand All</button>
<button id="btn-hide-all-children" type="button" class="btn btn-info">Collapse All</button>
<hr>
<table id="example"  class="table table-striped table-hover" cellspacing="0" width="100%">
                        
                      <!--<table class="table table-striped table-hover" id="save-stage" style="width:100%;">-->
                        <thead>
                          <tr>
<th >Case #</th>
<th >Date</th>
<th>Patient #</th>
<th>Name</th>
<th>Tests</th>
<th >Rider</th>
<th >Status</th>
<th class="none">Rider Contact</th>
<th class="none">Patient Contact</th>
<th class="none">Patient Address</th>
<th class="none">Patient City</th>
<th class="none">Scheduled Date</th>
<th class="none">Scheduled Time</th>
<th class="none">Collected At</th>
<th class="none">Completed At</th>
<th class="none">Submitted To</th>
<th class="none">Proof</th>

 <th width="5%">Actions</th>                         </tr>
                        </thead>
                        <tbody>
<?php
$bookings=mysqli_query($con,"select * from bookings where sample_collect='At Home' order by test_date desc") or die (mysqli_error());
while($info=mysqli_fetch_array($bookings)){
     	$bid =$info['id'];
     	$labid =$info['labid'];
     	$address =$info['address'];
     	$city =$info['city'];
?>
<tr>
<td><?php echo $info['bookingno'];?></td>
<td><?php echo $info['test_date'];?></td>
<td><?php
$patients=mysqli_query($con,"select * from patients where id='".$info['uid']."' order by id") or die (mysqli_error());
while($data=mysqli_fetch_array($patients)){
    echo $data['patient_no'];
$name =  $data['firstname'].' '.$data['lastname'];
$contact = $data['contact'];

}?></td>
<td><?php echo $name;?></td>

<td><?php
$bd=mysqli_query($con,"select  *  from booking_details where bid = '".$bid."'") or die (mysqli_error());
while($details=mysqli_fetch_array($bd)){
    $testid = $details['tid'];
      $status = $details['runtime_status'];
    $test=mysqli_query($con,"select  *  from tests where id='".$testid."' limit 1 ") or die (mysqli_error());
    while($t=mysqli_fetch_array($test)){
        echo $t['title'];
    } echo ', ';

}
?></td>

<?php
$br=mysqli_query($con,"select * from booking_rider where bid='".$bid."' order by id") or die (mysqli_error());
while($mem=mysqli_fetch_array($br)){
    $rid = $mem['rid'];
    $sdate = $mem['date'];
    $stime = $mem['time'];
    $completed_at = $mem['completed_at'];
    $collected_at = $mem['collected_at'];
    $proof = $mem['proof'];
    $rider = '';
    if($rid > 0)
    {
        $riders=mysqli_query($con,"select * from rider where id='".$rid."' limit 1") or die (mysqli_error());
        while($r=mysqli_fetch_array($riders)){
            $mid = $r['member_id'];
            $rid = $r['id'];
            
            $members=mysqli_query($con,"select * from members where id='".$mid."' limit 1") or die (mysqli_error());
            while($m=mysqli_fetch_array($members)){
                $rider = $m['firstname'].' '.$m['lastname'];
                $rider_contact = $m['contact'];
            
            }
        }
    }
}

$frenchise = '';

if ($labid > 0) {
     $frenchises=mysqli_query($con,"select * from frenchises where id='".$labid."' limit 1") or die (mysqli_error());
            while($f=mysqli_fetch_array($frenchises)){
                $frenchise = $f['username'];
            }
}

if ($rider == '') { ?>
<td style="background-color:pink"><?php echo $rider; ?></td>
    
<?php } else { ?>
<td ><?php echo $rider; ?></td>

<?php }
?>

<td><?php echo $status; ?></td>
<td><?php echo $rider_contact;?></td>
<td><?php echo $contact;?></td>
<td><?php echo $address;?></td>
<td><?php echo $city;?></td>
<td><?php echo $sdate; ?></td>
<td><?php echo $stime; ?></td>
<td><?php echo $completed_at; ?></td>
<td><?php echo $collected_at; ?></td>
<td><?php echo $frenchise; ?></td>

<?php
if ($proof == '') { ?>
<td ></td>
    
<?php } else { ?>
<td><a href="https://www.virtuallab.com.pk/<?php echo $proof; ?>" target="_blank"> Click to open</a> </td>


<?php }
?>




<td width="5%">
     <div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a href="<?php echo $baseurl.'invoice/'.$info['id'];?>.html" class="dropdown-item" target="_blank" >Open Invoice</a>
    <a href="<?php echo $baseurl;?>onlinebookings.php?id=<?php echo $info['id'];?>&bno=<?php echo $info['bookingno'];?>" class="dropdown-item">Cancel Booking</a>
    <a href="<?php echo $baseurl;?>onlinebookings.php?id=<?php echo $info['id'];?>&rid=<?php echo $rid;?>" class="dropdown-item">Request for resample</a>
    
  </div>
</div>
                            </td>
                          </tr>
<?php
}
?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            
          </div>
              </div>
            </div>
          </div>
        </section>
      </div>
<?php include("includes/footer.php");?>    </div>
  </div>
  
  <script>
      $(document).ready(function (){
    var table = $('#example').DataTable({
        'responsive': true
    });

    // Handle click on "Expand All" button
    $('#btn-show-all-children').on('click', function(){
        // Expand row details
        table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
    });

    // Handle click on "Collapse All" button
    $('#btn-hide-all-children').on('click', function(){
        // Collapse row details
        table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
    });
});
  </script>
  
  
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/summernote/summernote-bs4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/ckeditor/ckeditor.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/ckeditor.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>

</body>


</html>