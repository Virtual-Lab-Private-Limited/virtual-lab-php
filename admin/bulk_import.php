<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
function string_limit_words($string, $word_limit) {
   $words = explode(' ', $string);
   return implode(' ', array_slice($words, 0, $word_limit));
}

$message1 = '';
$message2 = '';
if(isset($_POST["submit_test_file"]))
{
    $file = $_FILES["file"]["tmp_name"];
    $file_open = fopen($file,"r");
    $countFirstRow = true;

    while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
    {
        if ($countFirstRow) {
            // go back to the start of the loop to the next line.
            $countFirstRow = false;
            continue;
        }
        $title = $csv[0];
        
        $sample = $csv[1];
        $price = $csv[2];
        $cost = $csv[3];
        $test_type = $csv[4];
        $unit = $csv[5];
        $gender = $csv[6];
        $duration = $csv[7];
        $batch_day = $csv[8];
        $catid = $csv[9];
        $pid = $csv[10];
        $gid = $csv[11];
        $discount_type = $csv[12];
        $remarks = $csv[13];
        $newtitle=string_limit_words($title, 6);
        $urltitle=preg_replace('/[^a-z0-9]/i',' ', $newtitle);
        $newurltitle=str_replace(" ","-",$newtitle);
        $url=$newurltitle;
        
        mysqli_query($con,"insert into tests(pid,gid,catid,title,slug,sample,price,cost,remarks,type,unit,gender,batch_day,duration,discount_type) 
        values ('$pid','$gid','$catid','$title','$url','$sample','$price','$cost','$remarks','$test_type','$unit','$gender','$batch_day','$duration','$discount_type')") or die (mysqli_error($con));
        $message1 = 'Tests Uploaded Successfully...!';
    }
}

if(isset($_POST["submit_refrence_file"]))
{
    $file = $_FILES["file"]["tmp_name"];
    $file_open = fopen($file,"r");
    $countFirstRow = true;

    while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
    {
        if ($countFirstRow) {
            // go back to the start of the loop to the next line.
            $countFirstRow = false;
            continue;
        }
        $testid = $csv[0];
        $gender = $csv[1];
        $minimum_value = $csv[2];
        $maximum_value = $csv[3];
        $additional_data = $csv[4];
        
        mysqli_query($con,"insert into test_reference(testid, gender, minimum_value, maximum_value, additional_data) 
        values ('$testid','$gender','$minimum_value','$maximum_value','$additional_data')") or die (mysqli_error($con));
        $message2 = 'Tests Refrence Uploaded Successfully...!';
    }
}


?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Bulk import | <?php echo $basetitle;?></title>
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
                <div class="card">
                  <div class="card-header">
                    <h4>Tests Import </h4>
                  </div>
                  <div class="card-body">
          <div id="wrapper">
             <form method="post" action="bulk_import.php" enctype="multipart/form-data">
              <input type="file" name="file"/>
              <input type="submit" name="submit_test_file" value="Submit"/>
             </form>
             <span style="color:green"><?php echo $message1; ?></span>
            </div>
            </div></div></div>
       </section>
        <section class="section">
            <div class="section-body">
                <div class="card">
                  <div class="card-header">
                    <h4>Test Refrence Import </h4>
                  </div>
                  <div class="card-body">
          <div id="wrapper">
             <form method="post" action="bulk_import.php" enctype="multipart/form-data">
              <input type="file" name="file"/>
              <input type="submit" name="submit_refrence_file" value="Submit"/>
             </form>
             <span style="color:green"><?php echo $message2; ?></span>
            </div>
            </div></div></div>
       </section>
    </div>
    </div>
    </div>
    </script>
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