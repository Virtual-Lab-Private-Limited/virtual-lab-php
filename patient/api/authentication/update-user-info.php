<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
require __DIR__.'/middlewares/Auth.php';


$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn,$allHeaders);

$dir = '../../../images';
$name = basename($_FILES['image']['name']);
$t_name = $_FILES['image']['tmp_name'];

if($_SERVER["REQUEST_METHOD"] != "POST"){
    $returnData = msg(0,404,'Page Not Found!');
}
else if ($auth->isAuth()){
    $move = move_uploaded_file($t_name, $dir.'/'.$name); 
    if ($move) {
        $user_id = $auth->isAuth();    
        $returnData = updateProfile($user_id, $conn, $name);
    }
    else {
    
        $returnData = [
            "success" => 0,
            "status" => 401,
            "message" => $move,
        ];
    }
}
else {
    $returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
    ];
}

echo json_encode($returnData);

function updateProfile($user_id, $conn, $name){
 
    try {
      
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $dob = $_POST['dob'];
        
        if(strlen($contact) < 11):
            $returnData = msg(0,422,'Invalid Contact. Must be valid 11 digits!');
        else:
            $update_user = "UPDATE patients SET gender=?,contact=?,address=?,dob=?, profile=? WHERE id=?";
            $conn->prepare($update_user)->execute([$gender, $contact, $address, $dob, 'images/'.$name, $user_id]);
            $returnData = msg(1,201,'User profile has successfully been updated.');

        endif;    
        
    }
    catch(PDOException $e){
         $returnData = msg(0,500,$e->getMessage());
        
    }
    
    return $returnData;
 
}

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}