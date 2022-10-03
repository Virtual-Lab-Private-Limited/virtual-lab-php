<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id=$_GET['id'];
$qs=mysqli_query($con,"select * from exams where id='$id' limit 1") or die (mysqli_error());
while($info=mysqli_fetch_array($qs)){
	$q=$info['question'];
	$oa=$info['optiona'];
	$ob=$info['optionb'];
	$oc=$info['optionc'];
	$od=$info['optiond'];
	$ans=$info['answer'];
	$j_id=$info['job_id'];
	
	
}


    $jobs=mysqli_query($con,"select * from jobs where id='$j_id' limit 1") or die (mysqli_error());
    while($info=mysqli_fetch_array($jobs)){
      $job_post = $info['title'];
        
    }


if(isset($_POST['submit'])){
	$question=$_POST['question'];
	$answera=$_POST['optiona'];
	$answerb=$_POST['optionb'];
	$answerc=$_POST['optionc'];
	$answerd=$_POST['optiond'];
	$answer=$_POST['answer'];
	$qid=$_POST['qid'];
	$job_id=$_POST['job'];
	
mysqli_query($con,"update exams set question='$question', optiona='$answera', optionb='$answerb',optionc='$answerc',optiond='$answerd', answer='$answer', job_id='$job_id' where id='$qid'") or die (mysqli_error($con));
	$message='<font color="green"><p align="center">Questin has been Updated successfully.</p></font>';		
}



?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Question | <?php echo $basetitle;?></title>
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
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>assets/img/favicon.ico' />
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
                <div class="card">
                  <div class="card-body">

<form class="new-added-form" action="<?php echo $baseurl;?>question/<?php echo $id;?>.html" method="post">
                            <div class="row">
                                <div class="col-12 form-group mg-t-8">
<input type="text" class="form-control" name="question" value="<?php echo $q;?>" placeholder="Enter Question" required>
<input type="hidden" class="form-control" name="qid" value="<?php echo $id;?>" placeholder="Enter Question" required>

                                </div>
                                <div class="col-6 form-group">
<input type="text" class="form-control" name="optiona" value="<?php echo $oa;?>" placeholder="Option A" autocomplete="off">
                                </div>
                                <div class="col-6 form-group">
<input type="text" class="form-control" name="optionb" value="<?php echo $ob;?>" placeholder="Option B" autocomplete="off">
                                </div>
                                <div class="col-6 form-group">
<input type="text" class="form-control" name="optionc" value="<?php echo $oc;?>" placeholder="Option C" autocomplete="off">
                                </div>
                                <div class="col-6 form-group">
<input type="text" class="form-control" name="optiond" value="<?php echo $od;?>" placeholder="Option D" autocomplete="off">
                                </div>

                                <div class="col-6 form-group">
<label>Answer</label>
<input type="text" class="form-control" name="answer" value="<?php echo $ans;?>" autocomplete="off">
                                </div>
                                           <div class="col-6 form-group">
<label>Job Post</label>
    <select name="job" class="form-control" >
            <option value="<?php echo $j_id; ?>"><?php echo $job_post; ?></option>
            <?php
            $jobs=mysqli_query($con,"select * from jobs order by id") or die (mysqli_error());
            while($info=mysqli_fetch_array($jobs)){
            
            ?>
            <option value="<?php echo $info['id']; ?>"><?php echo $info['title']; ?></option>
            <?php }?>
        </select>                                 
    </div>


                                <div class="col-12 form-group mg-t-8">
<input type="submit" class="btn btn-success" name="submit" value=" Update Question ">
                                </div>
                            </div>
                            <?php echo $message;?>
                        </form>

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