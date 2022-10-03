<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $_GET['id'];
if(isset($id)){
    $price = $_GET['price'];

    mysqli_query($con, "update bookings set paid = '1', amount_paid = '$price' where id ='$id'") or die(mysqli_error($con));
    header("location:".$baseurl."complete.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$bdid = $_POST['id'];	
    $dir = '../images';	
    $name = basename($_FILES['picture']['name']);
    $t_name = $_FILES['picture']['tmp_name'];
    
    if(move_uploaded_file($t_name,$dir.'/'.$name)){
        $p = "images/$name";
        $today = date("d m Y h:i:s A");
        mysqli_query($con,"update booking_details set image='$p' where id='$bdid' limit 1 ") or die (mysqli_error($con));

    }

      
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Complete Test | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
									<h1>Complete Tests</h1>
								</div>
							</div>
						</div>
					</div>
          <div class="section-body">
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Case #</th>
<th>Date</th>
<th>Patient #</th>
<th>Name</th>
<th>Contact #</th>
<th>Test Title</th>
<th>Due Amount</th>
<th>Sample Collected</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$bookings=mysqli_query($con,"select d.* from booking_details as d join bookings as b on d.bid = b.id where d.status='complete' and b.labid='$session_labid' order by b.id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){

$books=mysqli_query($con,"select *  from bookings where id='".$info['bid']."'  limit 1") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];
	$test_date=$book['test_date'];	
	$due=$book['total_amount'] - $book['amount_paid'] ;
	$bid=$book['id'];
	$sample=$book['sample_collect'];
	$total = $book['total_amount'];
}
?>
                          <tr>
<td><?php echo $bookingno;?></td>
<td><?php echo $test_date;?></td>

<td><?php
$patients=mysqli_query($con,"select *  from patients where id='".$info['pid']."'  limit 1") or die (mysqli_error());
while($patient=mysqli_fetch_array($patients)){
echo $patient['patient_no'];
$name = $patient['firstname'].' '.$patient['lastname'];
$cnic=$patient['cnic'];
$contact=$patient['contact'];
$gender=$patient['gender'];
}

?></td>
<td><?php echo $name;?></td>
<td><?php echo $contact;?></td>
<td><?php
$tests=mysqli_query($con,"select *  from tests where id='".$info['tid']."'  limit 1") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
echo	$test['title'];
	$type = $test['type'];	
}
?></td>
<td><?php 
if ($due > 0 ) { ?>
    <a href="<?php echo $baseurl;?>complete.php?id=<?php echo $bid;?>&price=<?php echo $total;?>" class="btn btn-success">Pay <?php echo $due;?></a>
<?php }else {   
echo $due; }?></td>
<td><?php echo $sample; ?></td>
<td width="25%">
<?php
  if($type == 'radiology_home' || $type == 'radiology_lab'){  ?>
    <a id="edit" class="btn btn-success"><i class="fa fa-pencil-alt"></i></a>
    <a href="http://virtuallab.com.pk/<?php echo $info['image'];?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i></a>
<?php  } else { ?>
    <a href="<?php echo $baseurl; ?>edit_report.php?id=<?php echo $info['id']; ?>" class="btn btn-success"><i class="fa fa-pencil-alt"></i></a>
    <a href="http://virtuallab.com.pk/reports/pdf.php?id=<?php echo $info['id'];?>" target="_blank" class="btn btn-info"><i class="fa fa-print"></i></a>

<?php      
  }
?>

    <form method="POST" action="<?php echo $baseurl;?>complete.php" enctype="multipart/form-data" id="form" style="display: none">
        <input type="file" class="form-control" name="picture"> 
        <input type="hidden" name="id" value=<?php echo $info['id']?> >
        <input type="submit" value=" Upload" class="btn btn-info">                  

    </form>
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
        </section>

<?php

include("includes/footer.php");
?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
    <script>

    $(document).on("click", "#edit", function () {
 
        $(this).closest("tr").find("#form").css("display","block")
   
    });
  </script>
</body>


</html>