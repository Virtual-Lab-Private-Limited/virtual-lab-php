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
$rid=mysqli_real_escape_string($con,$_POST['rid']);
$examination=mysqli_real_escape_string($con,$_POST['examination']);
$complaints=mysqli_real_escape_string($con,$_POST['complaint']);
$history=mysqli_real_escape_string($con,$_POST['history']);
$protocol=mysqli_real_escape_string($con,$_POST['protocols']);
$findings=mysqli_real_escape_string($con,$_POST['findings']);
$impressions=mysqli_real_escape_string($con,$_POST['impressions']);
$comment=mysqli_real_escape_string($con,$_POST['comments']);


mysqli_query($con,"update radiology set examination='$examination', complain='$complaints', history='$history', protocol='$protocol', findings='$findings', impressions='$impressions', clnical_comments='$comment' where id='$rid' limit 1") or die (mysqli_error($con));


header("location:".$baseurl."radiology.html");
}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Radiology Test List | <?php echo $basetitle;?></title>
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
<?php
$radiologies=mysqli_query($con,"select * from radiology where id='$id' limit 1") or die (mysqli_error());
while($rad=mysqli_fetch_array($radiologies)){
	$exam=$rad['examination'];
	$comp=$rad['complain'];
	$his=$rad['history'];
	$pro=$rad['protocol'];
	$find=$rad['findings'];
	$impr=$rad['impressions'];
	$comment=$rad['clnical_comments'];
	$testid=$rad['testid'];
	
	
}
$tests=mysqli_query($con,"select * from tests where id='$testid'") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){

$test_title=$ts['title'];
}

?>  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
              <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $test_title;?></h4>
                    
                  </div>
                  <div class="card-body">
<form method="post" action="<?php echo $baseurl;?>radio/<?php echo $id;?>">

                  <div class="row">
              		<div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
<label>Patient’s Complain</label>

                      <div class="input-group">
<input type="text" name="complaint" value="<?php echo $comp;?>" class="form-control" placeholder="Patient’s Complain">                      
<input type="hidden" name="rid" value="<?php echo $id;?>" class="form-control">                      

</div>

                    </div>

                      <div class="form-group">
<label>Examination</label>

                      <div class="input-group">
<input type="text" name="examination" value="<?php echo $exam;?>" class="form-control" placeholder=" Examination ">                      </div>

                    </div>
                      <div class="form-group">
<label>Patient's History</label>

                      <div class="input-group">
<input type="text" name="history" value="<?php echo $his;?>" class="form-control" placeholder="Patient’s History">                      </div>

                    </div>

                      <div class="form-group">
<label>Patient's Protocols</label>

                      <div class="input-group">
<input type="text" name="protocols" value="<?php echo $pro;?>" class="form-control" placeholder="Protocols">                      </div>

                    </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Findings</label>
<textarea name="findings" class="summernote"><?php echo $find;?></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Impressions</label>
<textarea name="impressions" class="summernote"><?php echo $impr;?></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
<label>Clinical Comment </label>
<textarea name="comments" class="summernote"><?php echo $comment;?></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
<input type="submit" name="submit" value=" Update Test Details " class="btn btn-info btn-block">
	                    </div>
                  
	                </div>

<?php echo $message;?>


	                </div>
</form>
                    
                  </div>
                </div>
              </div>
           </div>
          
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
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th>Test Title</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$radialogies=mysqli_query($con,"select * from radiology order by id") or die (mysqli_error($con));
while($info=mysqli_fetch_array($radialogies)){
?>
                          <tr>
<td><?php
$lab_tests=mysqli_query($con,"select * from tests where id='".$info['testid']."' limit 1") or die (mysqli_error());
while($lt=mysqli_fetch_array($lab_tests)){
	echo $lt['title'];
}
?></td>
<td width="20%">
<a href="<?php echo $baseurl.'radio/'.$info['id'];?>" class="btn btn-success">Edit</a>
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