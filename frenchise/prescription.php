<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $_GET['id'];
if (isset($id)){
    $query=mysqli_query($con,"update patient_prescription set resolved=1 where id='$id' limit 1") or die (mysqli_error($con));
 header("location:".$baseurl."prescription.php");
}

$did = $_GET['did'];
if (isset($did)){
    $query=mysqli_query($con,"delete from patient_prescription where id='$did' ") or die (mysqli_error($con));
 header("location:".$baseurl."prescription.php");
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $basetitle;?></title>
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
									<h1>Patient Prescription's</h1>
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
                              <th>Date </th>
<th>Patient #</th>

<th>Patient Name</th>
<th>Contact #</th>
<th>Prescription</th>

<th width="20%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$prescription = mysqli_query($con,"select * from patient_prescription order by date_entry desc ") or die (mysqli_error($con));
while($data=mysqli_fetch_array($prescription)){
    
    $patient_id = $data['patient_id'];

    $patient=mysqli_query($con,"select * from patients where id=$patient_id ") or die (mysqli_error($con));
    while($info=mysqli_fetch_array($patient)){
        $code = $info['patient_no'];
        $name = $info['firstname'].' '.$info['lastname'];
        $contact = $info['contact'];
         
    }

?>
                          <tr>
<td><?php echo $data['date_entry'];?></td>
<td><?php echo $code;?></td>
<td><?php echo $name;?></td>
<td><?php echo $contact;?></td>
<td><a href="<?php echo 'https://virtuallab.com.pk/'. $data['image'];?>" target="_blank">Click to open</a>
</td>

<td width="20%">
    
<?php
if($data['resolved']) {
?>
<span style="color:green"> Resolved </span> 
<?php } else { ?>
<a href="<?php echo $baseurl;?>prescription.php?id=<?php echo $data['id'];?>" class="btn btn-info"><i class="fa fa-edit"></i> Resolve </a>
    
<?php    
} 
?>
<a href="<?php echo $baseurl;?>prescription.php?did=<?php echo $data['id'];?>" class="btn btn-danger"><i class="fa fa-trash"></i>  </a>

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
  
</body>


</html>