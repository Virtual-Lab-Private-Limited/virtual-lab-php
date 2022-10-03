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

$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;

$query_tests=mysqli_query($con,"select * from culters where title='$title' limit 1") or die (mysqli_error());

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Culture is already Exist</p></font>';	
}else{

mysqli_query($con,"insert into culters(title) values ('$title')") or die (mysqli_error($con));
$pid=mysqli_insert_id($con);

$message='<font color="green"><p align="center">Your Cultures has been added successfully</p>
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
  <title>Add Cultures Test | <?php echo $basetitle;?></title>
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
<form method="post" action="<?php echo $baseurl;?>add_cultures_test.html">
        <div class="row">
              
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Specimen </label>
</strong>
                          </div>
                        </div>
<select name="specimen" class="form-control" style="width:100%">
<option selected>Select Specimen</option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=1") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['title'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Growth </label>
</strong>
                          </div>
                        </div>
<select name="growth" class="form-control" style="width:100%">
<option selected>Select Specimen</option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=2") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['title'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Microscopy </label>
</strong>
                          </div>
                        </div>
<select name="microscopy" class="form-control" style="width:100%">
<option selected>Select Microscopy</option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=3") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['title'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Bacterial Count / Growth
 </label>
</strong>
                          </div>
                        </div>
<select name="bacterial_count" class="form-control" style="width:100%">
<option selected>Select Bacterial Count / Growth
</option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=4") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['title'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Z-N Stain
 </label>
</strong>
                          </div>
                        </div>
<select name="zn_stain" class="form-control" style="width:100%">
<option selected>Select Z-N Stain
</option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=5") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['title'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Gram's Stain
 </label>
</strong>
                          </div>
                        </div>
<select name="gram_stain" class="form-control" style="width:100%">
<option selected>Select Gram's Stain
</option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=6") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['title'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>


<div class="form-group">
<div class="form-group">
<input type="submit" value=" Add Culture " class="btn btn-block btn-info">                    </div>

                    </div>
                    
                  </div>
<?php echo $message;?>

                </div>
              </div>
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="5%"> ID </th>
<th>Medicine</th>
<th>High</th>
<th>Low</th>
<th>Weak</th>
<th>Resistance</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$num=1;
$medicines=mysqli_query($con,"select * from medicines order by id") or die (mysqli_error());
while($med=mysqli_fetch_array($medicines)){
?>
                          <tr>
<td width="5%"> <?php echo $num++;?> </td>
<td><?php echo $med['title'];?>
<input type="checkbox" name="index_number[]" value="<?php echo $num++;?>" checked class="hidden">
<input type="radio" name="med[]" value="High">
</td>
<td><input type="radio" name="med[]" value="Low">
</td>
<td><input type="radio" name="med[]" value="Weak">
</td>
<td><input type="radio" name="med[]" value="Res">
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
<?php echo $message;?>

                </div>
              </div>

            </div>
</form>
            
            
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