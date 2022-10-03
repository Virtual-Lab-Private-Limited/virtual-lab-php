<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

if(isset($_POST['submit'])){
	$question=$_POST['question'];
	$answera=$_POST['answera'];
	$answerb=$_POST['answerb'];
	$answerc=$_POST['answerc'];
	$answerd=$_POST['answerd'];
	$answer=$_POST['answer'];
	$job_id=$_POST['job'];
	
$questions=mysqli_query($con,"select * from exams where question='$question' order by id desc limit 1") or die (mysqli_error($con));

$count_question=mysqli_num_rows($questions);
if($count_question>0){

	$message='<font color="red"><p align="center">Sorry Sir/ Madam, <br>The Following Question already exists in our system against this subject</p></font>';

}else{
mysqli_query($con,"insert into exams(question,optiona,optionb,optionc,optiond,answer,job_id) values('$question','$answera','$answerb','$answerc','$answerd','$answer','$job_id')") or die (mysqli_error($con));
	$message='<font color="green"><p align="center">Questin has been added successfully.<br> Add another question.</p></font>';		
}
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
                <div class="card">
                  <div class="card-body">

<form class="new-added-form" action="<?php echo $baseurl;?>addquestion.html" method="post">
                            <div class="row">

                                <div class="col-12 form-group mg-t-8">
<input type="text" class="form-control" name="question" value="" placeholder="Enter Question" required>

                                </div>
                                <div class="col-6 form-group">
<div class="form-group">
<div class="input-group">

<div class="input-group-prepend">
<div class="input-group-text">
<input type="radio" name="answer" value="a" required>
</div>
</div>
<input type="text" class="form-control" name="answera" value="" placeholder="Option A" autocomplete="off">
                      </div>
                    </div>

                                </div>
                                <div class="col-6 form-group">
<div class="form-group">
<div class="input-group">

<div class="input-group-prepend">
<div class="input-group-text">
<input type="radio" name="answer" value="b" required>
</div>
</div>
<input type="text" class="form-control" name="answerb" value="" placeholder="Option B" autocomplete="off">
                      </div>
                    </div>

                                </div>
                                <div class="col-6 form-group">
<div class="form-group">
<div class="input-group">

<div class="input-group-prepend">
<div class="input-group-text">
<input type="radio" name="answer" value="c" required>
</div>
</div>
<input type="text" class="form-control" name="answerc" value="" placeholder="Option C" autocomplete="off">
                      </div>
                    </div>

                                </div>
                                <div class="col-6 form-group">
<div class="form-group">
<div class="input-group">

<div class="input-group-prepend">
<div class="input-group-text">
<input type="radio" name="answer" value="d" required>
</div>
</div>
<input type="text" class="form-control" name="answerd" value="" placeholder="Option D" autocomplete="off">
                      </div>
                    </div>

                                </div>

  <div class="col-6 form-group">
        <select name="job" class="form-control" >
            <option value="">---select post---</option>
            <?php
            $jobs=mysqli_query($con,"select * from jobs order by id") or die (mysqli_error());
            while($info=mysqli_fetch_array($jobs)){
            
            ?>
            <option value="<?php echo $info['id']; ?>"><?php echo $info['title']; ?></option>
            <?php }?>
        </select>                                
    </div>

                                <div class="col-12 form-group mg-t-8">
<input type="submit" class="btn btn-success" name="submit" value=" Enter Questions ">
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