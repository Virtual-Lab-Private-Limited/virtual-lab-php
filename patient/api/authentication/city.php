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

$returnData = fetchFrenchises($conn);

echo json_encode($returnData);

function fetchFrenchises($conn){

    try{
        $data = "SELECT * from cities  ";
         
        $query_stmt = $conn->prepare($data);
        $result = $query_stmt->execute();
        if($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'cities' => $row
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