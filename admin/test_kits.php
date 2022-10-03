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
$title=mysqli_real_escape_string($con,$_POST['title']);
$total_test=mysqli_real_escape_string($con,$_POST['total_test']);
$testid=mysqli_real_escape_string($con,$_POST['testid']);



$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;

$query_kits=mysqli_query($con,"select * from medical_kits where title='$title' limit 1") or die (mysqli_error($con));

$count_kits=mysqli_num_rows($query_kits);
if($count_kits>0){
$message='<font color="red"><p align="center">The Following Kit is already Exist</p></font>';	
}else{

mysqli_query($con,"insert into medical_kits(title,total_test,testid,labid) values ('$title','$total_test','$testid','$session_labid')") or die (mysqli_error($con));
$pid=mysqli_insert_id($con);

$message='<font color="green"><p align="center">Your Kit has been added successfully</p>
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
  <title>Medical Kit List | <?php echo $basetitle;?></title>
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
<form method="post" action="<?php echo $baseurl;?>test_kits.html">
        <div class="row">
              
              <div class="col-12 col-md-4 col-lg-4">
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
<input type="text" class="form-control" name="title" value="">
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Test Per Kit</label>
</strong>
                          </div>
                        </div>
<input type="text" class="form-control" name="total_test" value="">
                      </div>

                    </div>
                    <div class="form-group">
<select name="testid" class="form-control">
<option value="">Select Test</option>
<?php $tests=mysqli_query($con,"SELECT id,title from tests") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
?>
<option value="<?php echo $test['id'];?>"><?php echo $test['title'];?></option>

<?php
}
?>

</select>
                    </div>

                                          <div class="form-group">
<input type="submit" class="btn btn-block btn-info" value=" Add Kit ">                    </div>
                    
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
<th width="5%"> ID</th>
<th>Kit Title</th>
<th>Test Title</th>
<th>Test Qty</th>
<th>Stock Details</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$kits=mysqli_query($con,"select * from medical_kits where labid='$session_labid' order by id") or die (mysqli_error());
while($info=mysqli_fetch_array($kits)){
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['title'];?></td>
<td><?php $tests=mysqli_query($con,"SELECT id,title from tests where id='".$info['testid']."' limit 1") or die (mysqli_error($con));
while($test=mysqli_fetch_array($tests)){
echo $test['title'];	
}
?></td>
<td><?php echo $info['total_test'];?></td>
<td width="5%">
<a href="<?php echo $baseurl;?>add_stock/<?php echo $info['id'];?>.html" class="btn btn-info"><i class="fas fa-plus"></i></a>
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