<?php
include "global.php";
include "frenchiseinfo.php";
if ($logged == 0) {
    header("location:" . $baseurl . "login.html");
    exit();
}
include "test-to-cart.php";
$pid = $_GET['id'];
$patients = mysqli_query($con, "select * from patients where id='$pid' limit 1") or die(mysqli_error());
while ($info = mysqli_fetch_array($patients)) {
    $firstname = $info['firstname'];
    $lastname = $info['lastname'];
    $cnic = $info['cnic'];
    $contact = $info['contact'];
    $address = $info['address'];
    $city = $info['city'];
    $dob = $info['dob'];
    $age = $info['age'];
    $blood_group = $info['blood_group'];

}

if (isset($_POST['submit'])) {

    $bookings = mysqli_query($con, "select * from bookings order by id desc limit 1") or die(mysqli_error());
    
    $count = mysqli_num_rows($bookings);
    if($count>0){
        while ($data = mysqli_fetch_array($bookings)) {
            $bookingno = $data['id'];
        }
    } else {
        $bookingno = 0;
    }
    
    $bookingid = (int)$bookingno+1;
    $caseno = date("Y") .'-'. date("dm").'-'.$bookingid;
    $pid = $_POST['pid'];
    $tprice = 0;
    $tcost = $_POST['total_price'];
    $uid = $_POST['pid'];
    $doctorid = $_POST['doctor'];
    $sample = $_POST['sample_collect'];
    $cc_no = "";
    $scheduled_date = $_POST['scheduled_date'];
    $scheduled_time = $_POST['scheduled_time'];
    $pass_no = $_POST['pass_no'];
    $flight_no = $_POST['flight_no'];
    $flight_date = $_POST['flight_date'];
    $ticket_no = $_POST['ticket_no'];
    $discount = $_POST['discount'];
    $amount_paid = $_POST['paid'];
    if($discount == '')
    {
        $discount=0;
    }
    $discount_type = $_POST['discount_type'];
    if ($discount_type == "%"){
      $percent =   $tcost * ($discount/100);
      $tprice = $tcost - $percent;
    }else{
      $tprice = $tcost - $discount;
    }
    
    if ($amount_paid == $tprice){
        $paid=1;
    } else {
        $paid=0;
    }
    
    $today = date("d m Y h:i:s A");

    mysqli_query($con, "insert into bookings(bookingno,uid,total_cost, discount, total_amount, amount_paid,
    paid,profit_status,test_date,addby,bookby,address,city,lati,longi,labid,referby,receiveby,sample_collect,
    test_status, pass_no, flight_no, flight_date, ticket_no, discount_type, cc_no)value('$caseno','$uid','$tcost','$discount','$tprice','$amount_paid','$paid','pending','$today','Staff',
    '$session_id','$address','$city','','','$session_labid','$doctorid','$session_id','$sample','pending', '$pass_no',
    '$flight_no','$flight_date','$ticket_no', '$discount_type', '$cc_no' )") or die(mysqli_error($con));
    
    $bookingid = mysqli_insert_id($con);

    
    $itemCount = count($_POST["index_number"]);
    $itemValues = 0;
    $query = "INSERT INTO booking_details (pid,bid,tid,qty,cost,price,status, runtime_status, staffid,labid,approvedby,result_date) VALUES ";
    $queryValue = "";
    $runtime_status = "Appoitment at ".date("d m Y h:i:s A");
    for ($i = 0; $i < $itemCount; $i++) {
        $tid =$_POST["tid"][$i];
    
        if (!empty($_POST["index_number"][$i])) {
            $itemValues++;
            if ($queryValue != "") {
                $queryValue .= ",";
            }
            $queryValue .= "('" . $uid . "','" . $bookingid . "','" . $_POST["tid"][$i] . "','" . $_POST["qty"][$i] . "','" . $_POST["cost"][$i] . "','" . $_POST["price"][$i] . "','pending','$runtime_status','$session_id','$session_labid','0','0000-00-00')";
        }
    }
    $sql = $query . $queryValue;
    if ($itemValues != 0) {
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        
        if (!empty($result))
        {
            if ($sample == 'At Home')
            {
                  $result = mysqli_query($con, "insert into booking_rider
            (bid,rid,status,complete,date,time,created_at,completed_at,collected_at)
            value('$bookingid','0','','0','$scheduled_date', '$scheduled_time','$today', '','')") or die(mysqli_error($con));
     
            }
            sms($uid, $tprice, $amount_paid, $con );
            echo '<script language="javascript">window.location = "' . $baseurl . 'invoice/' . $bookingid . '.html"</script>';
        }
        

    }
}

function sms($uid, $tprice, $amount_paid, $con){
    
    $patients=mysqli_query($con,"select * from patients where id='$uid' limit 1") or die (mysqli_error());
    while($info=mysqli_fetch_array($patients)){
        $contact = $info['contact'];
        $name = $info['firstname'].' '.$info['lastname'];
    }
    $cut = strstr($contact, '3');
    $phone = '92'.$cut;
    $random = mt_rand(1000000,10000000);
    $transaction_id = '17e4d747-c21b-4bb0-a574-00000'.$random;
        
    $message = 'Dear '.$name.',
        
Your total bill was for Rs. '.$tprice.', you paid Rs. '.$amount_paid.'. 
Thank you for choosing Virtual Lab
Download Virtuallab App from Playstore and keep all your medical history at one place.
https://play.google.com/store/apps/details?id=com.virtuallab.patient

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
}


?>

<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Add Test | <?php echo $basetitle; ?></title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/app.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/style.css">
  <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/css/components.css">
  <!-- Custom style CSS -->

  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl; ?>images/favicon.png' />
    <link rel="stylesheet" href="<?php echo $baseurl; ?>assets/bundles/select2/dist/css/select2.min.css">
    
    <style>
        tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
    </style>

</head>

<body>

  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
<?php include "includes/header.php";?>
<?php include "includes/leftnavigation.php";?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
								<div class="section-header-breadcrumb-content">
<h1>Add Tests for <?php echo $firstname . ' ' . $lastname; ?></h1>
								</div>
							</div>
						</div>
					</div>

          <div class="section-body">
<form action="<?php echo $baseurl; ?>add_test/<?php echo $pid; ?>.html" method="post">


<div class="row">
              <div class="col-md-12 col-lg-12 col-sm-12">
              <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">

                         <div class='row'>
                         <div class="col-md-4">
                         <p class="clearfix">
                        <span class="float-left" style="width:170px">Patient Name</span>
                        <span class="float-left text-muted">
                        <input type="hidden" name="bookingno" value="<?php echo $bookingno + 1; ?>">
                        <input type="hidden" name="pid" value="<?php echo $pid; ?>">
                        <?php echo $firstname . ' ' . $lastname; ?></span>
                        </p>
                        <p class="clearfix">
                        <span class="float-left" style="width:170px">City</span>
                         <span class="float-left text-muted"><?php echo $city; ?></span>
                         </p>
                         <p class="clearfix">
                            <span class="float-left" style="width:170px">CNIC</span>
                            <span class="float-left text-muted"><?php echo $cnic; ?></span>
                          </p>
                           <p class="clearfix">
                            <span class="float-left" style="width:170px">Contact #</span>
                            <span class="float-left text-muted"><?php echo $contact; ?></span>
                          </p>
                          <p class="clearfix">
                            <span class="float-left" style="width:170px">DOB</span>
                            <span class="float-left text-muted"><?php echo $dob; ?></span>
                          </p>
                           <p class="clearfix">
                            <span class="float-left" style="width:170px">Age</span>
                            <span class="float-left text-muted"><?php echo $age; ?></span>
                            </p>
                         </div>
                         <div class="col-md-4">
                            <p class="clearfix">
                            <span class="float-left" style="width:170px">Blood Group</span>
                            <span class="float-left text-muted"><?php echo $blood_group; ?></span>
                          </p>
                        
                        <div class="input-group mb-3">
                           <div class="input-group-prepend">
                              <span class="input-group-text">Select Doctor</span>
                            </div>
                        <select  name="doctor" class="form-control">
                        <option value="1" selected> Patient Self</option>
                        <?php
$doctors = mysqli_query($con, "select * from doctors where labid='$session_labid' ") or die(mysqli_error());
while ($doc = mysqli_fetch_array($doctors)) {

    ?>
                                 <option value="<?php echo $doc['id']; ?>"><?php echo $doc['firstname'] . ' ' . $doc['lastname'] . ' - ' . $doc['city']; ?></option>
<?php
}
?>
                            </select>
                          </div>
                       <div class="input-group mb-3">
                             <div class="input-group-prepend">
                                  <span class="input-group-text">Sample</span>
                                </div>
                    
                            <select  name="sample_collect" class="form-control">
                            <option value="In Lab" selected> In Lab</option>
                            <option value="At Home" > At Home</option>
                            <option value="Brought to Lab" >Brought to Lab</option>
                            <option value="Collection Center" > Collection Center</option>
                            </select>
                          </div>
                          <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Scheduled Date (If any)</span>
    </div>
    <input type="date" class="form-control" name="scheduled_date">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Scheduled Time (If any)</span>
    </div>
    <input type="time" class="form-control" name="scheduled_time">
  </div>
                         </div>
                         <div class="col-md-4">
<div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Passport No</span>
    </div>
    <input type="text" class="form-control" name="pass_no">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Flight No</span>
    </div>
    <input type="text" class="form-control" name="flight_no">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Flight Date</span>
    </div>
    <input type="date" class="form-control" name="flight_date">
  </div>
  <div class="input-group mb-3">
    <div class="input-group-prepend">
      <span class="input-group-text">Ticket No</span>
    </div>
    <input type="text" class="form-control" name="ticket_no">
  </div>
                         </div>
                         </div>
                    </div>
                  </div>
                </div>
              </div>

              </div>
          <div class="row">
              <div class="col-md-8 col-lg-6 col-sm-12">
                <div class="card">
                  <div class="padding-20">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-md">
                        <tr>
                            <th colspan="5" >Test Full Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Remove</th>
                        </tr>
                                <?php echo cart(); ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-8 col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">

<table  id="save-stage"  class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>Id</th>
                <th> Name</th>   <th > Sample</th>
      <th > Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
  <?php
$staff_members = mysqli_query($con, "select * from tests where pid=0 order by id asc") or die(mysqli_error($con));
while ($info = mysqli_fetch_array($staff_members)) {
  
?>
<tr>
<td><?php echo $info['id']; ?></td>      
<td><?php echo $info['title']; ?></td>      
<td><?php echo $info['sample']; ?></td> 
<td><?php echo $info['price']; ?></td> 
<td >
<a href="<?php echo $baseurl; ?>test-to-cart.php?add=<?php echo $info['id']; ?>&pid=<?php echo $pid; ?>" class="btn btn-success"><i class="fas fa-plus-square"></i></a>
</td>
</tr>
<?php } ?>
            
</table>
            
            
                    </div>
                  </div>
                </div>

              </div>

            </div>
</form>
         


          </div>
        </section>

<?php

include "includes/footer.php";
?>    </div>
  </div>
  
  <!-- General JS Scripts -->
  <script src="<?php echo $baseurl; ?>assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="<?php echo $baseurl; ?>assets/bundles/datatables/datatables.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-ui/jquery-ui.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="<?php echo $baseurl; ?>assets/js/scripts.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery.sparkline.min.js"></script>
   <script src="<?php echo $baseurl; ?>assets/bundles/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo $baseurl; ?>assets/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<script>
    	
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot  #dot').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );
 
    // DataTable
    var table = $('#example').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;
 
                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
     var price = $('#total_price').val();

     $('#total').text(price);
   
    
    $("#discount").change(function(){
        var price = $('#total_price').val();
        var discount = $('#discount').val();
        var type = $("#discount_type").val();   
        if (type == "%"){
          var percent =   price * (discount/100);
          var tprice = price - percent;
        } else {
          var tprice = price - discount;
        }
        $('#total').text(tprice);
    });
    
    $("#discount_type").change(function(){
        var price = $('#total_price').val();
        var discount = $('#discount').val();
        var type = $("#discount_type").val();   
        if (type == "%"){
          var percent =   price * (discount/100);
          var tprice = price - percent;
        } else {
          var tprice = price - discount;
            
        }
        $('#total').text(tprice);
    });
    

    
 
} );
</script>



</body>


</html>