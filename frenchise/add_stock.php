<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id=$_GET['id'];
$kits=mysqli_query($con,"select * from medical_kits where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($kits)){
	$kit_title=$info['title'];
	$testid=$info['testid'];
	$totaltest=$info['total_test'];
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?php echo $kit_title;?> Kit's Stock | <?php echo $basetitle;?></title>
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
              <div class="col-12 col-md-6 col-lg-6">
           <div class="section-body">
<form method="post" action="<?php echo $baseurl;?>kitstock.php?id=<?php echo $id;?>">
        <div class="row">
              
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Kit Title</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="title" value="<?php echo $kit_title;?>" readonly>
<input type="hidden" name="kitid" value="<?php echo $id;?>">
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Kit Qty</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="qty" value="" >
                      </div>

                    </div>

                                          <div class="form-group">
<input type="submit" class="btn btn-block btn-info" value=" Add Kit Stock ">                    </div>
                    
                  </div>
<?php echo $message;?>

                </div>
              </div>
            </div>
</form>
            
            
          </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
           <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Stock Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
<span class="float-left">Total Qty Available for Test</span>
<span class="float-right text-muted">
<?php
$stocks=mysqli_query($con,"select sum(qty) from kit_stocks where kitid='$id' and labid='$session_labid'") or die (mysqli_error());
while($row=mysqli_fetch_array($stocks)){
		echo $total_kits= $row['sum(qty)']*$totaltest;
}
?></span>
                      </p>
                      <p class="clearfix">
<span class="float-left">Total Used Kits</span>
                        <span class="float-right text-muted"><?php
$tests=mysqli_query($con,"select * from booking_details where tid='$id' and labid='$session_labid'") or die (mysqli_error($con));
echo $total_test=mysqli_num_rows($tests);
?></span>
                      </p>
                      <p class="clearfix">
<span class="float-left">Remaining Kits</span>
<span class="float-right text-muted"><?php echo $total_kits-$total_test;?></span>
                      </p>

                    </div>
                  </div>
                </div>
            
            
          </div>
              </div>

            </div>
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
<th width="5%"> ID</th>
<th>Qty</th>
<th>Purchase Date</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$kits=mysqli_query($con,"select * from kit_stocks where kitid='$id' order by purchase_date desc") or die (mysqli_error());
while($info=mysqli_fetch_array($kits)){
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['qty'];?></td>
<td width="15%"><?php echo $info['purchase_date'];?></td>
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
      </div>
<?php include("includes/footer.php");?>    </div>
  </div>
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