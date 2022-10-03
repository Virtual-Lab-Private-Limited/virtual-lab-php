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
$medicines=mysqli_query($con,"select * from medicines where id='$id' limit 1") or die (mysqli_error());
while($med=mysqli_fetch_array($medicines)){
	$mtitle=$med['title'];	
  $culture_id = $med['culture_id'];
  $culture=mysqli_query($con,"select * from culture_info where id = $culture_id") or die (mysqli_error());
  while($growth=mysqli_fetch_array($culture)){
    $mculture = $growth['title'];
  } 
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
$title=mysqli_real_escape_string($con,$_POST['title']);
$mid=$_POST['mid'];
$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;
$culture_id = $_POST['culture_id'];


mysqli_query($con,"update medicines set title='$title', culture_id='$culture_id' where id='$mid' limit 1 ") or die (mysqli_error($con));
$pid=mysqli_insert_id($con);

header ("location:".$baseurl."medicines.html");


}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Medicines List | <?php echo $basetitle;?></title>
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
  <div class="loader"></div>
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
<form method="post" action="<?php echo $baseurl;?>editmedicine/<?php echo $id;?>.html">
        <div class="row">
              
              <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Medicine </label>
</strong>
                          </div>
                        </div>
<input type="hidden" class="form-control" name="mid" value="<?php echo $id;?>">

<input type="text" class="form-control" name="title" value="<?php echo $mtitle;?>">
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
<select name="culture_id" class="form-control" style="width:100%">
<option value="<?php echo $culture_id;?>" selected><?php echo $mculture;?></option>
<?php
$specimens=mysqli_query($con,"select * from culture_info where cid=2") or die (mysqli_error());
while($spc=mysqli_fetch_array($specimens)){
?>
<option value="<?php echo $spc['id'];?>"><?php echo $spc['title'];?></option>
<?php
}
?>
</select>
                      </div>

                    </div>
                    <div class="form-group">
<div class="form-group">
<input type="submit" value=" Update Medicine " class="btn btn-block btn-info">                    </div>

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
<th>Medicine</th>
<th>Growth</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$tests=mysqli_query($con,"select * from medicines order by id") or die (mysqli_error());
while($info=mysqli_fetch_array($tests)){
  $culture_id =$info['culture_id'];
?>
                          <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['title'];?></td>
<td>
<?php
$culture=mysqli_query($con,"select * from culture_info where id = $culture_id") or die (mysqli_error());
while($growth=mysqli_fetch_array($culture)){
   echo $growth['title'];
} 
?>
</td>
<td width="25%">
<a href="<?php echo $baseurl;?>editmedicine/<?php echo $info['id'];?>.html" class="btn btn-info">Edit</a>
<a href="<?php echo $baseurl;?>delete.php?=<?php echo $info['id'];?>" class="btn btn-danger">Delete</a>
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