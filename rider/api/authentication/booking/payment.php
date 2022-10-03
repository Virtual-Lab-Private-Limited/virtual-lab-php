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
    $rider_id = $auth->isAuth();
    $returnData = paymentCollected($rider_id, $data, $conn);
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function paymentCollected($rider_id, $data, $con)
{

    try {

        $booking_id = $data->booking_id;
        
        $created_at = date("d m Y h:i:s A");
        $rider_id = (int)$rider_id;
        
        mysqli_query($con, "update booking_rider set status='payment_collected' where bid='$booking_id'") or die(mysqli_error($con));
        
        $runtime_status = "Payment collected at " . date("d m Y h:i:s A");

        mysqli_query($con, "update booking_details set runtime_status='$runtime_status' where bid='$booking_id'") or die(mysqli_error($con));

        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Payment collected successfully',
        ];
        
    } catch (Exception $e) {
        return [
            "success" => 0,
            "status" => 401,
            "message" => $e->getMessage(),
        ];

    }

}
