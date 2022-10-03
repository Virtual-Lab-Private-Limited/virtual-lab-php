<?php
error_reporting(0);
include("global.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
include("frenchiseinfo.php");

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
function email($email, $phone, $password){
    $to = "$email";
    $subject = "Congratulations for being selected";
    
    $message = "
    <html>
    <head>
    <title>Congratulations</title>
    </head>
    <body>
    <h4>Dear Applicant</h4>
    <p>Thank you for applying Virtual Lab for Post of the Phlebotomist. We are pleased to inform you that you are now an active phlebotomist to Virtual Lab.
    Download the Phlebotomist app from Play store and start using it. </p>
    
    <p>Please put the following credentials to login:</p>
    <div><strong>Contact: </strong> ".$phone."</div>
    <div><strong>Password: </strong> ".$password."</div>
    
    <p>We wish you all the best!</p>
    
    <div><strong>
    Best Regards,</strong></div>
    <div>Virtual Lab Team</div>
    
    </body>
    </html>
    ";
    
    // Always set content-type when sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    
    // More headers
    $headers .= 'From: <no-reply@virtuallab.com.pk>' . "\r\n";
   
    
    mail($to,$subject,$message,$headers);
}

if (isset($_GET['tid'])) {
    $id = $_GET['tid'];
    mysqli_query($con,"update members set status='Allow' where id='$id' limit 1") or die (mysqli_error());
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=pending_staff.html">'; 

}

if(isset($_GET['contact'])){
    $id = $_GET['id'];
    $contact = $_GET['contact'];
    $email = $_GET['email'];
    mysqli_query($con,"update members set status='Active' where id='$id' limit 1") or die (mysqli_error());
    $records=mysqli_query($con,"select unique_id from rider order by id desc limit 1") or die (mysqli_error($con));
    $rowcount=mysqli_num_rows($records);
    
    if($rowcount > 0) {
        while($row=mysqli_fetch_array($records)){
            $unique_id = $row['unique_id'];
        }    
        $uid = $unique_id +1;
    } else {
        $uid = 100;    
    }
   
    $password = randomPassword();
    $contact = strval($contact);
    $hash_password = md5($password);
    
    mysqli_query($con,"insert into rider (unique_id, member_id, contact, password) values ('$uid',  '$id', '$contact', '$hash_password' )") or die (mysqli_error());
    
    email($email, $contact, $password);
    
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=pending_staff.html">';
    
}



?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Pending Member Request | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
</head>

<body>
  
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include("includes/header.php");?>
<?php include("includes/leftnavigation.php");?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
									<h1>Pending Staff Members</h1>
								</div>
							</div>
						</div>
					</div>
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
<th>Post</th>
<th>Deposit Slip</th>
<th>Apply Date</th>
<th>Info</th>
<th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
<?php
$staff_members=mysqli_query($con,"select * from members where status='Pending' order by id desc") or die (mysqli_error($con));
while($info=mysqli_fetch_array($staff_members)){
	$candidate_contact=$info['contact'];
	$candidate_email=$info['email'];

?>
                          <tr>
<td><?php echo $info['firstname'].' '.$info['lastname'];?></td>
<?php
 $userid=$info['id'];
$payments=mysqli_query($con,"select * from exam_payments where userid='$userid' limit 1") or die (mysqli_error($con));
while($data=mysqli_fetch_array($payments)){
$paymentmethod=$data['payment_method'];
$transactionid=$data['transactionid'];
$payment_date=$data['payment_date'];

}
?>
<td><?php 
$id = $info['job_id'];
$jobs=mysqli_query($con,"select * from jobs where id='$id' limit 1") or die (mysqli_error());
    while($data=mysqli_fetch_array($jobs)){
      echo $data['title'];
        
    }

?>


</td>
<td><a href="<?php echo 'https://virtuallab.com.pk/'.$transactionid;?>" target="_blank"> Click to View</a></td>
<td><?php echo $payment_date;?></td>

<td width="10%">
<a href="<?php echo $baseurl;?>change_info/<?php echo $info['id'];?>.html" class="btn btn-success"><i class="fa fa-eye"></i> </a>
</td>
<td width="30%">
<a href="<?php echo $baseurl;?>pending_members.php?tid=<?php echo $info['id'];?>" class="btn btn-info"> Allow for Test</a>
<a href="<?php echo $baseurl;?>pending_members.php?id=<?php echo $userid;?>&contact=<?php echo $candidate_contact;?>&email=<?php echo $candidate_email;?>" class="btn btn-warning">Activate member</i> </a>

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
        </section>

<?php

include("includes/footer.php");
?>    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>