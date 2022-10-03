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

if($auth->isAuth()){
    $user_id = $auth->isAuth();
    
    $returnData = fetchUser($user_id, $conn);
}
else{
    $returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
    ];
}



echo json_encode($returnData);

function fetchUser($user_id, $conn){
 
    try{
        
        $fetch_rider = "SELECT * FROM `rider` WHERE `id`=:id ";
        $query_stmt = $conn->prepare($fetch_rider);
        $query_stmt->bindValue(':id', $user_id,PDO::PARAM_STR);
     
        $query_stmt->execute();
        $rider = $query_stmt->fetch();
        $m_id = $rider['member_id'];
        $unique_id = $rider['unique_id'];
        $longitude = $rider['longitude'];
        $latitude = $rider['latitude'];
        $fcm_id = $rider['fcm_id'];
        
        $fetch_user_by_id = "SELECT `firstname`,`lastname`,
        `cnic`,`contact`,`dob`, `city`, `vehicle_no` FROM `members` WHERE `id`=:id";
        $query_stmt = $conn->prepare($fetch_user_by_id);
        $query_stmt->bindValue(':id', $m_id);
        $query_stmt->execute();
      
        if($query_stmt->rowCount()):
      
            $row = $query_stmt->fetch(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'unique_id' => 'PLC-'.$unique_id,
                'longitude' => $longitude,
                'latitude' => $latitude,
                'fcm_id' => $fcm_id,
                'rider' => $row
            ];
        else:
            return [
                "success" => 0,
                "status" => 401,
                "message" => "No data to show"
            ];
        endif;
    }
    catch(PDOException $e){
        echo ($e);
        return null;
        
    }
}

