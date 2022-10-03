<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/../classes/Database.php';
require __DIR__.'/../middlewares/Auth.php';

$allHeaders = getallheaders();

$db_connection = new Database();
$conn=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");
$auth = new Auth($conn,$allHeaders);
$data = json_decode(file_get_contents("php://input"));

if($auth->isAuth()){
    $returnData = updateTest($conn, $data);
 
}
else{
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized"
    ];
}

echo json_encode($returnData);

function updateTest($con){
    
    $booking_id = $data->booking_id;

    try{
   
        mysqli_query($con, "Update  bookings set paid=1 where id='$booking_id'") or die(mysqli_error($con));

        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Payment status updated successfully',
        ];
    
     
    }
    catch(Exception $e){
        return [
                "success" => 0,
                "status" => 401,
                "message" => "No data to show"
            ];
    }
}