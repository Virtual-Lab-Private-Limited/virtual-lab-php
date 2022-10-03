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
$packages=mysqli_query($con,"select * from packages where id='$id' limit 1") or die (mysqli_error());
while($pack=mysqli_fetch_array($packages)){
	$title=$pack['title'];	
	$price=$pack['price'];	
	$actual_price=$pack['actual_total'];
	$picture=$pack['picture'];

}
if($_SERVER["REQUEST_METHOD"] == "POST"){

	$title=$_POST['title'];	
	$price=$_POST['price'];
	$actual_price=$_POST['actual_price'];

$dir='../images';	
$name=basename($_FILES['picture']['name']);
$t_name=$_FILES['picture']['tmp_name'];

if(!empty($name)){
    if(move_uploaded_file($t_name,$dir.'/'.$name)){
        $p = "images/$name";
    }
} else {
  $p = $picture;
}
mysqli_query($con,"update packages set title='$title', price='$price', actual_total='$actual_price', picture='$p' where id='$id' limit 1 ") or die (mysqli_error($con));

header ("location:".$baseurl."packages.html");


}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Package | <?php echo $basetitle;?></title>
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
<form method="post" action="<?php echo $baseurl;?>edit_package.php?id=<?php echo $id;?>" enctype="multipart/form-data">
        <div class="row">
              
              <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Package </label>
</strong>
                          </div>
                        </div>

<input type="text" class="form-control" name="title" value="<?php echo $title;?>">

                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Package Price </label>
</strong>
                          </div>
                        </div>

           <input type="text" class="form-control" name="price" value="<?php echo $price;?>">

                      </div>
             
                    </div>
                      <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Actual Total </label>
</strong>
                          </div>
                        </div>

           <input type="text" class="form-control" name="actual_price" value="<?php echo $actual_price;?>">

                      </div>
             
                    </div>
                         <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <div class="input-group-text">
<strong><label>Package Picture </label>
</strong>
                          </div>
                        </div>
            <img src="https://virtuallab.com.pk/<? echo $picture;?>" width="250" height="200">
            
            
           <div><input type="file" class="form-control" name="picture" ></div>

                      </div>
             
                    </div>
               
<div class="form-group">
<input type="submit" value=" Update Package " class="btn btn-block btn-info">                  

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