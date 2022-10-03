<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}
require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';
// INCLUDING DATABASE AND MAKING OBJECT
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->device_id)
    || !isset($data->user_id)
    || !isset($data->password)
    || empty(trim($data->password))
    || empty(trim($data->device_id))
    || empty(trim($data->user_id))
    ):

    $fields = ['fields' => ['password','user_id', 'device_id']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    
    $user_id = trim($data->user_id);
    $device_id = trim($data->device_id);
    $password = trim($data->password);
    $today = date("Y-m-d");
    
    $age = date_diff(date_create($data->dob), date_create($today));
    $age = $age->format('%y');
  
    if(strlen($password) < 8):
        $returnData = msg(0,422,'Your password must be at least 8 characters long!');

   
    else:
        try{
            $sql = "UPDATE patients SET password=?, device_id=? WHERE id=?";
            $conn->prepare($sql)->execute([password_hash($password, PASSWORD_DEFAULT),$device_id, $user_id]);
            $jwt = new JwtHandler();
            $token = $jwt->_jwt_encode_data(
                'www.virtuallab.com.pk',
                array("user_id"=> $user_id)
            );
                    
            $returnData = [
                    'success' => 1,
                    'message' => 'You have successfully logged in.',
                    'token' => $token,
                    'device_id' => $device_id,
                    'user_id'=> $user_id
                ];


        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }
    endif;
    
endif;

echo json_encode($returnData);