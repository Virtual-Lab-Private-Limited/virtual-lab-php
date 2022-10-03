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
    $user_id = $auth->isAuth();
    $returnData = addTest($user_id, $data, $conn);
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function addTest($user_id, $data, $con)
{
   
    try {

        $tests = $data->test_id;
        $pass_no = $data->pass_no;
        $flight_no = $data->flight_no;
        $flight_date = $data->flight_date;
        $ticket_no = $data->ticket_no;
     
        $totalamount = 0;
        $totalcost = 0;
        $payment_status = $data->paid;
        $longitude = $data->longitude;
        $latitude = $data->latitude;
        $address = $data->address;
        $city = $data->city;
        $user_id = $data->user_id;
        $bid = (int) $data->bid;
        
        $schedule_date = $data->schedule_date;
        $schedule_time = $data->schedule_time;
        

 
        for ($i = 0; $i < count($tests); $i++) {

            $test = mysqli_query($con, "select * from tests where id = $tests[$i] limit 1") or die(mysqli_error());
            while ($data = mysqli_fetch_array($test)) {
                $cost = $data['cost'];
                $amount = $data['price'];

            }
            $totalamount = intval($totalamount) + intval($amount);
            $totalcost = intval($totalcost) + intval($cost);
        }
        
       
        mysqli_query($con, "update bookings set total_cost='$totalcost',total_amount='$totalamount',
        paid='$payment_status',address= '$address',city = '$city',lati ='$latitude' ,longi = '$longitude', pass_no='$pass_no', flight_no='$flight_no',
        flight_date = '$flight_date', ticket_no = '$ticket_no' where id = '$bid' ") or die(mysqli_error($con));

        mysqli_query($con, "delete from booking_details where bid = '$bid' ") or die(mysqli_error($con));
        $runtime_status = "Phlebotomist assigned at " . date("d m Y h:i:s A");


     
        for ($i = 0; $i < count($tests); $i++) {

            $test = mysqli_query($con, "select * from tests where id = $tests[$i] limit 1") or die(mysqli_error($con));
            while ($data = mysqli_fetch_array($test)) {
                $cost = $data['cost'];
                $amount = $data['price'];
             
            }
            $result = mysqli_query($con, "insert into booking_details
            (pid,bid,tid,qty,cost,price,status,runtime_status,staffid,labid,
            approvedby,result_date)value('$user_id','$bid','$tests[$i]','1','$cost','$amount','pending','$runtime_status', '0','0','0',
            '0000-00-00')") or die(mysqli_error($con));
            
       

        }
        
        $created_at = date("d m Y h:i:s A");
        
        $result = mysqli_query($con, "update booking_rider
            set date='$schedule_date',time='$schedule_time' where bid = '$bid' ") or die(mysqli_error($con));

        
        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Test has been updated successfully',
        ];
        
    } catch (Exception $e) {
        return [
            "success" => 0,
            "status" => 401,
            "message" => $e->getMessage(),
        ];

    }

}
