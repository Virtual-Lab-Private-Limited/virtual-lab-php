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
if(isset($_POST['submit'])){

	$job_id=$_POST['job'];
	echo "Job ";
	echo  $job_id;
	
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Questions | <?php echo $basetitle;?></title>
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
          
          <div class="row">
          
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                      
                       <form class="new-added-form" action="<?php echo $baseurl;?>questions.html" method="post" enctype="multipart/form-data">
                             <div class="row">
                                <div class="col-md-9">
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
                                <div class="col-md-3"> 
                                    <input type="submit" value="Go" class="btn btn-success" name="submit">
                                </div>
                             </div>
                        </form>
                    </div>    
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">
                        <thead>
                          <tr>
<th width="5%">ID</th>
<th width="90%">Question</th>
<th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
if($job_id == null){

  $tests=mysqli_query($con,"select * from exams order by id") or die (mysqli_error($con));
  
} else{ 
  $tests=mysqli_query($con,"select * from exams where job_id = $job_id order by id") or die (mysqli_error($con));
    
}

while($info=mysqli_fetch_array($tests)){
?>
                         <tr>
<td><?php echo $info['id'];?></td>
<td><?php echo $info['question'];?></td>
<td>
<a href="<?php echo $baseurl;?>question/<?php echo $info['id'];?>.html" class="btn btn-info"><i class=" fa fa-eye"></i></a>
</td>
<td>
<a href="<?php echo $baseurl;?>remove_question.php?id=<?php echo $info['id'];?>" class="btn btn-danger">X</a>
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