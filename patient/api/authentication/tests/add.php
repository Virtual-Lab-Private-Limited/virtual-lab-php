<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../classes/Database.php';
require __DIR__ . '/../middlewares/Auth.php';

$allHeaders = getallheaders();
$db_connection = new Database();

$conn=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");

$auth = new Auth($conn, $allHeaders);
$data = json_decode(file_get_contents("php://input"));

if ($auth->isAuth()) {

    $returnData = addTest($data, $conn);
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function addTest($data, $con)
{
   
    try {

        $tests = $data->test_id;
        $doctorid = $data->doctor;
        $sample = $data->sample_collect;
        $pass_no = $data->pass_no;
        $flight_no = $data->flight_no;
        $flight_date = $data->flight_date;
        $ticket_no = $data->ticket_no;
        $discount = $data->discount;
        $totalamount = 0;
        $totalcost = 0;
        $payment_status = $data->paid;
        $longitude = $data->longitude;
        $latitude = $data->latitude;
        $address = $data->address;
        $city = $data->city;
        $user_id = $data->user_id;
        $frenchise_id = $data->frenchise_id;
        
        $schedule_date = $data->schedule_date;
        $schedule_time = $data->schedule_time;
        
        $type = $data->type;
        
        $today = date("d m Y h:i:s A");
        
        $bookings = mysqli_query($con, "select * from bookings order by id desc limit 1") or die(mysqli_error($con));
        
        while ($data = mysqli_fetch_array($bookings)) {
            $bookingid = $data['id'] + 1;
            $caseno = date("Y") .'-'. date("dm").'-'.$bookingid;
        }
 
        for ($i = 0; $i < count($tests); $i++) {

            $test = mysqli_query($con, "select * from tests where id = $tests[$i] limit 1") or die(mysqli_error());
            while ($data = mysqli_fetch_array($test)) {
               
                $amount = $data['price'];

            }
           
            $totalcost = intval($totalcost) + intval($amount);
        }
        
        $percent =   $totalcost * ($discount/100);
        
        $totalamount = $totalcost - intval($percent);
        
        mysqli_query($con, "insert into bookings(bookingno,uid,total_cost,discount,discount_type,total_amount,
        paid,profit_status,test_date,addby,bookby,address,city,lati,longi,labid,referby,receiveby,sample_collect,
        test_status, pass_no, flight_no, flight_date, ticket_no, type)value
        ('$caseno','$user_id','$totalcost', '$discount' , '%'  ,'$totalamount',
        '$payment_status','pending','$today','Patient',
        '$user_id','$address','$city','$latitude','$longitude','$frenchise_id','$doctorid','$user_id','$sample','pending', '$pass_no',
        '$flight_no','$flight_date','$ticket_no','$type')") or die(mysqli_error($con));

        $bookingid = mysqli_insert_id($con);

        $runtime_status = "Appoitment at " . date("d m Y h:i:s A");

     
        for ($i = 0; $i < count($tests); $i++) {

            $test = mysqli_query($con, "select * from tests where id = $tests[$i] limit 1") or die(mysqli_error($con));
            while ($data = mysqli_fetch_array($test)) {
                $cost = $data['cost'];
                $amount = $data['price'];
             
            }
            $result = mysqli_query($con, "insert into booking_details
            (pid,bid,tid,qty,cost,price,status,runtime_status,staffid,labid,
            approvedby,result_date)
            value('$user_id',
            '$bookingid','$tests[$i]','1','$cost','$amount','pending','$runtime_status', '0','0','0',
            '0000-00-00')") or die(mysqli_error($con));

        }
        
        $created_at = date("d m Y h:i:s A");
        
        $result = mysqli_query($con, "insert into booking_rider
            (bid,rid,status,complete,date,time,created_at,completed_at,collected_at)
            value('$bookingid','0','','0','$schedule_date', '$schedule_time','$created_at', '','')") or die(mysqli_error($con));
        
        
        $patients = mysqli_query($con, "select * from patients where id='$user_id' limit 1") or die(mysqli_error($con));
        while ($data = mysqli_fetch_array($patients)) {
            $patient_no = $data['patient_no'];
        }
        $today = date("d m Y h:i:s A");
         
        mysqli_query($con, "insert into notifications (message, datetime, resolved, admin) values ('A new booking $caseno has been made by patient $patient_no through App','$today', 0, 1) ")
            or die(mysqli_error($con));

        
        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Test has been booked successfully',
        ];
        
    } catch (Exception $e) {
        return [
            "success" => 0,
            "status" => 401,
            "message" => $e->getMessage(),
        ];

    }

}
