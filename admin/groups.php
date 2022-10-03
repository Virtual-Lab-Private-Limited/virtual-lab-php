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
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
$id = $_GET['id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
$gid=mysqli_real_escape_string($con,$_POST['gid']);

$query_tests=mysqli_query($con,"select * from groups where group_id='$gid' and test_id='$id' limit 1") or die (mysqli_error($con));

$count_test=mysqli_num_rows($query_tests);
if($count_test>0){
$message='<font color="red"><p align="center">The Following Group already Exist</p></font>';	
}else{

mysqli_query($con,"insert into groups(test_id, group_id) values ('$id','$gid')") or die (mysqli_error($con));
$pid=mysqli_insert_id($con);

$message='<font color="green"><p align="center">New Group has been added successfully</p>
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
  <title>Groups List | <?php echo $basetitle;?></title>
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
<form method="post" action="<?php echo $baseurl;?>groups.php?id=<?php echo $id;?>">
        <div class="row">
              
              <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Group Name</label>
</strong>
                          </div>
                        </div>
                        <select class="form-control" name="gid">
                            <?php
                            $tests=mysqli_query($con,"select * from tests order by id") or die (mysqli_error());
while($info=mysqli_fetch_array($tests)){
                            
                            ?>
                            <option value="<?php echo $info['id']; ?>"><?php echo $info['title']; ?></option>
                            
                            
                            <?php } ?>
                        </select>
                        
                      </div>

                    </div>
                                          <div class="form-group">
<input type="submit" class="btn btn-block btn-info">                    </div>
                    
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
<th>Group Title</th>
<th>Edit</th>
<th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$a=0;
$groups=mysqli_query($con,"select * from groups where test_id='$id' order by id") or die (mysqli_error());
while($info=mysqli_fetch_array($groups)){
    $gid = $info['group_id'];
$tests=mysqli_query($con,"select * from tests where id=$gid ") or die (mysqli_error());
while($t=mysqli_fetch_array($tests)){
    $title = $t['title'];
}

?>
 <tr>
<td><?php echo $gid;?></td>

<td><?php echo $title;?></td>
<td width="2%">
<a href="<?php echo $baseurl;?>edit_group.php?id=<?php echo $info['id'];?>&tid=<?php echo $id;?>" class="btn btn-info"><i class="far fa-edit"></i></a>
</td>
<td width="2%">
<a href="<?php echo $baseurl;?>delete_group.php?id=<?php echo $info['id'];?>&tid=<?php echo $id;?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
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