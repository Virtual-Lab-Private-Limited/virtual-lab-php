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

if($_SERVER["REQUEST_METHOD"] == "POST"){
$tid=mysqli_real_escape_string($con,$_POST['tid']);
$examination=mysqli_real_escape_string($con,$_POST['examination']);
$complaints=mysqli_real_escape_string($con,$_POST['complaint']);
$history=mysqli_real_escape_string($con,$_POST['history']);
$protocol=mysqli_real_escape_string($con,$_POST['protocols']);
$findings=mysqli_real_escape_string($con,$_POST['findings']);
$impressions=mysqli_real_escape_string($con,$_POST['impressions']);
$comment=mysqli_real_escape_string($con,$_POST['comments']);










$query_tests=mysqli_query($con,"select * from radiology where testid='$tid' limit 1") or die (mysqli_error($con));

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Test Details is already Exist</p></font>';	
}else{

mysqli_query($con,"insert into radiology(testid,examination,complain,history,protocol,findings,impressions,clnical_comments) values ('$tid','$examination','$complaints','$history'
,'$protocol','$findings','$impressions','$comment')") or die (mysqli_error($con));


$message='<font color="green"><p align="center">Your Test has been added successfully</p>
</font>
'; 

}
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
                    <h4>Add Radiology Test Details</h4>
                    
                  </div>
                  <div class="card-body">
<form method="post" action="<?php echo $baseurl;?>radiology.html">

                  <div class="row">
              		<div class="col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
<select name="tid" class="form-control" required>
<option value="">Select Test</option>
<?php
$tests=mysqli_query($con,"select * from tests where type='Radiology'") or die (mysqli_error());
while($ts=mysqli_fetch_array($tests)){

?>
<option value="<?php echo $ts['id'];?>"><?php echo $ts['title'];?></option>
<?php
}
?>

</select>
                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="complaint" value="" class="form-control" placeholder="Patient’s Complain">                      
</div>

                    </div>

                     </div>
              		<div class="col-lg-6 col-md-12 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="examination" value="" class="form-control" placeholder=" Examination ">                      </div>

                    </div>
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="history" value="" class="form-control" placeholder="Patient’s History">                      </div>

                    </div>

                     </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="form-group">
                      <div class="input-group">
<input type="text" name="protocols" value="" class="form-control" placeholder="Protocols">                      </div>

                    </div>

                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Findings</label>
<textarea name="findings" class="summernote"></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
	                      <label>Impressions</label>
<textarea name="impressions" class="summernote"></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
<label>Clinical Comment </label>
<textarea name="comments" class="summernote"></textarea>
	                    </div>
                  
	                </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
	                    <div class="form-group">
<input type="submit" name="submit" value=" Add Test Details " class="btn btn-info btn-block">
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