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
        $fetch_test = "SELECT p.*, t.title as test, t.id as test_id FROM `packages` p, `package_details` d, `tests` t where p.id = d.packageid and d.testid = t.id  " ;

        $query_stmt = $conn->prepare($fetch_test);
        $result = $query_stmt->execute();
        if($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'packages' => $row
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