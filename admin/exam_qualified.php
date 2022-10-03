<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}

$id = $_GET['id'];
$email = $_GET['email'];

if (isset($id) && isset($email)) {
    mysqli_query($con,"update members set status='Test' where id='$id' limit 1") or die (mysqli_error());
    $useremail= $email ;
    $to = $useremail;
    $subject = "Allow for Examination | Virtual Lab" ;
    $message = '
    <html>
    <table cellspacing="2" cellpadding="2" border="1" width="643" bordercolor="#000">
      <tr>
      <td colspan="2">
     <div style="background-color:#2f7af8;color:#ffffff;border:1px solid; width:643px; height:30px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:16px;"><div style="margin-top:5px;"><strong>Documents Verified</strong></div>
       </div>
        <div style="background-color:#2f7af8;color:#ffffff;border:1px solid; width:643px; height:30px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:16px;"><div style="margin-top:5px;"><strong>Dear Candidate, You are allowed to take online Test</strong></div>
    </td>
      </tr>
     </div>
    
      
      <tr>
       <td width="200" style="background-color:#2f7af8;color:#ffffff;font-family:Verdana, Geneva, sans-serif;font-size:12px;font-weight:bold;padding:5px;"> Exam </td>
        <td > exams.virtuallab.com.pk </td>
      </tr>
      <tr>
       
      
      
    </table>
    </html>
    ';
    //echo $message;
    
    
    $headers = "MIME-Version: 1.0". "\r\n";
    $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
    $headers .= 'From: <no-reply@virtuallab.com.pk>' ."\r\n";
    mail($to,$subject,$message,$headers);


echo '<META HTTP-EQUIV="Refresh" Content="0; URL=exam_qualified.html">'; 


}

?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Exam Qualified Staff | <?php echo $basetitle;?></title>
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
<th>Name</th>
<th>Payment Method</th>
<th>Experience Letter</th>

<th>Apply Date</th>
<th>Info</th>
<th>Action</th>
  </tr>
                        </thead>
                        <tbody>
<?php
$staff_members=mysqli_query($con,"select * from members where status='Allow' or status='Test' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){

?>
                          <tr>
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>
<?php
$userid=$info['id'];
$payments=mysqli_query($con,"select * from exam_payments where userid='$userid' limit 1") or die (mysqli_error($con));
while($data=mysqli_fetch_array($payments)){

?>

<td><?php 
echo $data['payment_method'];
?></td>
<td><a href="<?php echo 'https://virtuallab.com.pk/'.$data['transactionid'];?>" target="_blank" >Click here to view</a></td>

<td><?php echo	$data['payment_date'];?></td>
<?php
}
?>
<td width="10%">
<a href="<?php echo $baseurl;?>change_info/<?php echo $info['id'];?>.html" class="btn btn-success"><i class="fa fa-eye"></i> </a>
</td>

<td width="10%">
<?php 
if($info['status'] == "Test") {
?>    
    Test Link has been sent
<?php } else { ?>    
<a href="<?php echo $baseurl;?>exam_qualified.php?id=<?php echo $info['id'];?>&&email=<?php echo $info['email'];?>" > Send test link </a>
<?php } ?>

</td>
<!--<td width="10%">-->
<!--<a href="<?php echo $baseurl;?>changestatus.php?id=<?php echo $info['id'];?>" class="btn btn-success"><i class="fa fa-edit"></i> <?php echo $info['status'];?> </a>-->
<!--</td>-->
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