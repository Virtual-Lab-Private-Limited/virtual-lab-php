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
    $returnData = cancelBooking($user_id, $data, $conn);
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function cancelBooking($user_id, $data, $con)
{
   
    try {
        $today = date("d m Y h:i:s A");
        $status = "Cancel by Phlebotomist at $today ";
        $bid = (int) $data->bid;
        mysqli_query($con, "update bookings set test_status = 'Cancel' where id ='$bid'") or die(mysqli_error($con));
        mysqli_query($con, "update booking_details set status = 'Cancel', runtime_status= '$status' where bid ='$bid' ") or die(mysqli_error($con));
        
        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Booking has been cancelled successfully',
        ];
        
    } catch (Exception $e) {
        return [
            "success" => 0,
            "status" => 401,
            "message" => $e->getMessage(),
        ];

    }

}
