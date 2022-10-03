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

$dir = '../../../../images';
$name = basename($_FILES['image']['name']);
$t_name = $_FILES['image']['tmp_name'];

$booking_id = $_POST['booking_id'];
      

if ($auth->isAuth()) {
    $rider_id = $auth->isAuth();
    
    $move = move_uploaded_file($t_name, $dir.'/'.$name); 
    
    if ($move) {
        $returnData = acceptRide($rider_id, $booking_id, $conn, $name);
    }
    else {
    
        $returnData = [
            "success" => 0,
            "status" => 401,
            "message" => $move,
        ];
    }
   
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function acceptRide($rider_id, $booking_id, $con, $name)
{
    try {

        $booking_id = $booking_id;
        
        $recieved_at = date("d m Y h:i:s A");
        $rider_id = (int)$rider_id;
        
        $proof = "images/$name";
        
        mysqli_query($con, "update booking_rider set status='collected', collected_at='$recieved_at', proof='$proof' where bid='$booking_id'") or die(mysqli_error($con));
        
        $runtime_status = "Phlebotomist took sample and recieved payments at " . date("d m Y h:i:s A");

        mysqli_query($con, "update booking_details set runtime_status='$runtime_status' where bid='$booking_id'") or die(mysqli_error($con));

        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Sample collected successfully',
        ];
        
    } catch (Exception $e) {
        return [
            "success" => 0,
            "status" => 401,
            "message" => $e->getMessage(),
        ];

    }

}
