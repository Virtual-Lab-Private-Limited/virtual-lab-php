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


if($auth->isAuth()){
    $returnData = fetchTests($conn);
 
}
else{
    $returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
    ];
}

echo json_encode($returnData);

function fetchTests($conn){

    try{
        $fetch_test = "SELECT t.`id`, t.`title`,t.`price`, t.`information`, t.`type`,
        t.`duration`, w.`discount` FROM `tests` as t,  `webinfo` as w
        where w.`id` = 0 and t.`type` = 'radiology_home' or t.`type` = 'radiology_lab' group by t.`id` ;
        " ;
         

        $query_stmt = $conn->prepare($fetch_test);
        $result = $query_stmt->execute();
        if($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'tests' => $row
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