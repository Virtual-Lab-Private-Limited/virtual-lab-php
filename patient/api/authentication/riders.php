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
    $returnData = fetchRiders($conn);
}
else{
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized"
    ];
}

echo json_encode($returnData);

function fetchRiders($conn){

    try{
        $data = "SELECT r.unique_id, r.longitude, r.latitude, r.fcm_id, r.contact, m.city from rider as r , members as m where r.member_id = m.id  ";
         
        $query_stmt = $conn->prepare($data);
        $result = $query_stmt->execute();
        if($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'riders' => $row
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