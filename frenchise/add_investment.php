<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}function string_limit_words($string, $word_limit) {
   $words = explode(' ', $string);
   return implode(' ', array_slice($words, 0, $word_limit));
}
$id=$_GET['id'];




if($_SERVER["REQUEST_METHOD"] == "POST"){
$uid=mysqli_real_escape_string($con,$_POST['uid']);
$amount=mysqli_real_escape_string($con,$_POST['amount']);
$share=$amount/100;

mysqli_query($con,"insert into investments(investorid,shares,amount,investment_date,payment_method,transactionid,status) values ('$uid','$share','$amount',now())") or die (mysqli_error($con));

header("location:".$baseurl."investment/".$uid.".html");
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Investment | <?php echo $basetitle;?></title>
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
<form method="post" action="<?php echo $baseurl;?>add_investment/<?php echo $id;?>.html">
        <div class="row">
              
<div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
 <label>Minimum Investment Amount is Rs. 5000/-</label>                     <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Investment Amount</label>
</strong>
                          </div>
                        </div>
<input type="hidden" class="form-control" name="uid" value="<?php echo $id;?>">
<input type="text" class="form-control" name="amount" value="">
                      </div>

                    </div>
                    <div class="form-group">
<input type="submit" class="btn btn-block btn-info">                    
                    </div>
                    
                  </div>
<?php echo $message;?>

                </div>
              </div>
            </div>
</form>
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
<th width="5%"> Test ID</th>
<th>Amount</th>
<th>Shares</th>
<th>Investment Date</th>
<th>Payment Method</th>
<th>Transaction ID</th>
<th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$num=1;
$tests=mysqli_query($con,"select * from investments where investorid='$id' order by investment_date desc") or die (mysqli_error());
while($info=mysqli_fetch_array($tests)){
?>
                          <tr>
<td><?php echo $num++;?></td>
<td><?php echo $info['amount'];?></td>
<td><?php echo $info['shares'];?></td>
<td><?php echo $info['investment_date'];?></td>
<td><?php echo $info['payment_method'];?></td>
<td><?php echo $info['transactionid'];?></td>
<td><?php $status=$info['status'];
if($status=='Pending'){
	echo '<a href="'.$baseurl.'approv.php?id='.$info['id'].'&uid='.$id.'" class="btn btn btn-info">'.$status.'</a>';
}else{
echo $status;	
}
?></td>

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