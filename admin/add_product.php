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
$price=mysqli_real_escape_string($con,$_POST['price']);
$delivery_charges=mysqli_real_escape_string($con,$_POST['delivery_charges']);
$short_description=mysqli_real_escape_string($con,$_POST['short_description']);
$keywords=mysqli_real_escape_string($con,$_POST['keywords']);
$long_description=mysqli_real_escape_string($con,$_POST['long_description']);
$name=basename($_FILES['file_upload']['name']);
$t_name=$_FILES['file_upload']['tmp_name'];
$dir='../images';

$newtitle=string_limit_words($title, 6);
$urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
$newurltitle=str_replace(" ","-",$newtitle);
$url=$newurltitle;

$products=mysqli_query($con,"select * from products where title='$title' limit 1") or die (mysqli_error());

$count_product=mysqli_num_rows($products);
if($count_product>0){
$message='<font color="red"><p align="center">
Sorry Sir/Madam, Product is already Exist kindly add new product with different title name</p>';
}else{


if(move_uploaded_file($t_name,$dir.'/'.$name)){
	
mysqli_query($con,"insert into products(title,slug,keywords,short_description,long_description,price,delivery_charges,name,path) values ('$title','$url','$keywords','$short_description','$long_description','$price','$delivery_charges','$name','images/$name')") or die (mysqli_error($con));

$message='<font color="green">
<p align="center">Congratulations..! Product Has been Added Scucessfully</p>
<p align="center">You can Add New Product</p>';
}else{
$message='<font color="red">
<p align="center">Sorry Sir/Madam,</p>
<p align="center">You are not suppose to allow add product without image</p>';
	
}
}
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Product | <?php echo $basetitle;?></title>
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
<form method="post" action="<?php echo $baseurl;?>addproduct.html" enctype="multipart/form-data">
        <div class="row">
              
           <div class="col-12 col-md-4 col-lg-4">
                <div class="card">
                  <div class="card-header">
<h4>Product Information</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group">
<input type="text" class="form-control" name="title" placeholder="Product Title" value="">
                    </div>
                    <div class="form-group">
<input type="text" class="form-control" name="keywords" placeholder="Product Keywords" value="">
                    </div>
                    <div class="form-group">
<input type="text" class="form-control" name="short_description" placeholder="Short Description" value="">
                    </div>
                    <div class="form-group">
<input type="text" class="form-control" name="price" placeholder="Product Price" value="">
                    </div>

                    <div class="form-group">
<input type="text" class="form-control" name="delivery_charges" placeholder="Product Delivery Charges" value="">
                    </div>

                    <div class="form-group">
<input type="file" class="form-control-file" name="file_upload" value="">
                    </div>

                    <div class="form-group">
<input type="submit" class="btn btn-info btn-block" name="submit" value=" Add Product ">
</div>

<?php echo $message;?>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-8 col-lg-8">
                <div class="card">
                  <div class="card-body">
                    <div class="form-group">
<label>Long Description</label>
<textarea class="summernote" name="long_description"></textarea>

                    </div>
                    
                  </div>

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