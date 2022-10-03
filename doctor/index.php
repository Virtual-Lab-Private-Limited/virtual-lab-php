<?php
include("global.php");
include("frenchiseinfo.php");
if($logged==0){
	header("location:".$baseurl."login.html");
	exit();
}
function push_notification($pid, $con) {
    
    $patients=mysqli_query($con,"select * from patients where id='$pid' limit 1") or die (mysqli_error());
    while($info=mysqli_fetch_array($patients)){
        $fcm_id = $info['device_id'];
    }

    $ch = curl_init();

    curl_setopt_array($ch, array(
      CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "to": "'.$fcm_id.'",
        "notification": {
          "title": "Report Generated",
          "body": "Your report has been generated. Open the App to view it",
          "mutable_content": true
        },
    
       "data": {
              "via": "FlutterFire Cloud Messaging!!!",
              "count": "0",
              "click_action": "FLUTTER_NOTIFICATION_CLICK"
            }
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: key=AAAAfI2o1Jo:APA91bEksyzNyRtt5WOSGgUETzN3dCR4KR1b2AWa1nXoOoxCFJLp3OqmhC6n133TFozyD2SMxjG71EgXAvIWunnM_ON8L7-h8mQhGYI1VMXQX6TgDMPb6KZviQR0zZa5zN5bszIH9wRq'
      ),
    ));
    $response = curl_exec($ch);
    curl_close($ch);
    return;
}

$message = '';
$id=$_GET['id'];

if(isset($id)) {
    $bid=$_GET['bid'];
    $status=$_GET['status'];
    if($status == 'accept'){
        $pid=$_GET['pid'];
        $bno = $_GET['bno'];
        $name = $_GET['name'];
        $test = $_GET['test']; 
        $contact = $_GET['contact'];
        mysqli_query($con, "update bookings set test_status = 'Complete' where id ='$bid'") or die(mysqli_error($con));
        mysqli_query($con, "update booking_details set status = 'Complete', runtime_status= 'Report Approved by Pathologist', approvedby='$session_id' where id ='$id'") or die(mysqli_error($con));
        push_notification($pid, $con);
        $cut = strstr($contact, '3');
        $phone = '92'.$cut;
        $random = mt_rand(1000000,10000000);
        $transaction_id = '17e4d747-c21b-4bb0-a574-00000'.$random;
            
$message = 'Dear '.$name.',
    
Your '.$test.' report against case no '.$bno.'  is ready. 
You can download your report by clicking the following link https://virtuallab.com.pk/reports/pdf.php?id='.$id.'.

Download Virtuallab App from Playstore and keep all your medical history at one place.

Regards 
Virtual Lab';
 
    $params=['transaction_id'=>$transaction_id, 'user'=>'virtullab', 'pass'=>'SS123', 
    'number'=> $phone,'text'=>$message,'from'=>'Virtual Lab','type'=>'sms' ];
    $defaults = array(
    CURLOPT_URL => 'https://api.itelservices.net/send.php',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $params,
    CURLOPT_RETURNTRANSFER     => true,
    );
    $ch = curl_init();
    curl_setopt_array($ch,  $defaults);
    curl_exec($ch);
    curl_close($ch);
  
    } else {
        mysqli_query($con, "update booking_details set status = 'pending', runtime_status= 'Pathologist requested retest'  where id ='$id'") or die(mysqli_error($con));
    }
    header("location:".$baseurl."home.html");
} elseif(isset($_GET['contact'])) {
    $contact = $_GET['contact'];
    $name = $_GET['name'];
    $test = $_GET['test'];  
    $cut = strstr($contact, '3');
    $phone = '92'.$cut;
    $random = mt_rand(1000000,10000000);
    $transaction_id = '17e4d747-c21b-4bb0-a574-00000'.$random;
        
    $message = 'Dear '.$name.',
    
Your '.$test.' results are critical to normal. 
Please download your report from virtuallab App/Website or by visitng to your nearest Collection Center and consult to your physician immediately. 

Regards 
'.$session_username.' - Pathologist
Virtual Lab';
 
    $params=['transaction_id'=>$transaction_id, 'user'=>'virtullab', 'pass'=>'SS123', 
    'number'=> $phone,'text'=>$message,'from'=>'Virtual Lab','type'=>'sms' ];
    $defaults = array(
    CURLOPT_URL => 'https://api.itelservices.net/send.php',
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $params,
    CURLOPT_RETURNTRANSFER     => true,
    );
    $ch = curl_init();
    curl_setopt_array($ch,  $defaults);
    curl_exec($ch);
    curl_close($ch);
    $message = "Message Sent";
    header("location:".$baseurl."home.html");
}    

?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Dashboard | <?php echo $basetitle;?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/css/components.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/bootstrap-social/bootstrap-social.css">
  <link rel="stylesheet" href="<?php echo $baseurl;?>assets/bundles/flag-icon-css/css/flag-icon.min.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />
  
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php
include("includes/header.php");
?>
<?php
include("includes/leftnavigation.php");

?>      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
									<h1>Dashboard</h1>
								</div>
							</div>
						</div>
          </div>
          

<div class="container">
            
<div class="col-lg-12 col-md-12 col-12 col-sm-12">

              <div class="card">
                      <?php echo $message; ?>
                <div class="card-header">
                  <h4>Pending Test Reports </h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                      <th>Case #</th>
                     <th>Patient #</th>
<th>Name</th>
<th>CNIC</th>
<th>Contact #</th>
<th>Test Title</th>
<th>Sample Collected</th>
<th>Actions</th>
                      </tr>
<?php
$bookings=mysqli_query($con,"select * from booking_details where status='Doctor' and labid='$session_labid' and approvedby='0' order by id desc limit 10") or die (mysqli_error($con));
while($info=mysqli_fetch_array($bookings)){
$bid = $info['bid'];
$sample = $info['sample_collect'];

$books=mysqli_query($con,"select *  from bookings where id='".$bid."'  limit 1") or die (mysqli_error());
while($book=mysqli_fetch_array($books)){
	$bookingno=$book['bookingno'];	
}
?>
  <tr>
<td><?php echo $bookingno;?></td>
<td><?php
$patients=mysqli_query($con,"select *  from patients where id='".$info['pid']."'  limit 1") or die (mysqli_error());
while($patient=mysqli_fetch_array($patients)){
echo $patient['patient_no'];
$name = $patient['firstname'].' '.$patient['lastname'];
$cnic=$patient['cnic'];
$contact=$patient['contact'];
$gender=$patient['gender'];
$pid = $patient['id'];
}

?></td>
<td><?php echo $name;?></td>
<td><?php echo $cnic;?></td>
<td><?php echo $contact;?></td>
<td><?php
$tests=mysqli_query($con,"select *  from tests where id='".$info['tid']."'  limit 1") or die (mysqli_error());
while($test=mysqli_fetch_array($tests)){
    $t = $test['title'];
	echo $t;
}
?></td>
<td><?php echo $sample; ?></td>
<td width="25%">

<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Report Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

<a href="<?php echo $baseurl; ?>edit_report.php?id=<?php echo $info['id']; ?>" class="dropdown-item">Edit </a>
<a href="<?php echo $baseurl;?>report/<?php echo $info['id'];?>" class="dropdown-item">View </a>
<a href="<?php echo $baseurl;?>index.php?status=accept&bid=<?php echo $bid;?>&id=<?php echo $info['id'];?>&bno=<?php echo $bookingno;?>&contact=<?php echo $contact;?>&name=<?php echo $name; ?>&test=<?php echo $t; ?>&pid=<?php echo $pid;?>" class="dropdown-item">Approve</a>
<a href="<?php echo $baseurl;?>index.php?status=reject&bid=<?php echo $bid;?>&id=<?php echo $info['id'];?>" class="dropdown-item">Reject</a>
<a href="<?php echo $baseurl;?>index.php?contact=<?php echo $contact;?>&name=<?php echo $name; ?>&test=<?php echo $t; ?>" class="dropdown-item">Send SMS</a>
  </div>
</div>
                            </td>
                          </tr>
<?php
}
?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          
          
        </section>
	  </div>

<?php include("includes/footer.php");?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl;?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl;?>assets/bundles/echart/echarts.js"></script>
  
  <script src="<?php echo $baseurl;?>assets/bundles/chartjs/chart.min.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl;?>assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl;?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl;?>assets/bundles/jquery.sparkline.min.js"></script>
  
</body>


</html>