<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/../classes/Database.php';
require __DIR__.'/../middlewares/Auth.php';


$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn,$allHeaders);
$data = json_decode(file_get_contents("php://input"));

if($auth->isAuth()){
    
    $returnData = fetchRider($data, $conn);
}
else{
    $returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
    ];
}



echo json_encode($returnData);

function fetchRider($data, $conn){
   
 
    try{
        $booking_id = $data->booking_id;
        
        $fetch_info = "SELECT * FROM `booking_rider` WHERE `bid`=:bid ";
        $query_stmt = $conn->prepare($fetch_info);
        $query_stmt->bindValue(':bid', $booking_id, PDO::PARAM_STR);
     
        $query_stmt->execute();
        $data = $query_stmt->fetch();
        $rid = $data['rid'];
        
        $fetch_rider = "SELECT * FROM `rider` WHERE `id`=:id ";
        $query_stmt = $conn->prepare($fetch_rider);
        $query_stmt->bindValue(':id', $rid, PDO::PARAM_STR);
     
        $query_stmt->execute();
        $rider = $query_stmt->fetch();
        $m_id = $rider['member_id'];
        $unique_id = $rider['unique_id'];
        
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

