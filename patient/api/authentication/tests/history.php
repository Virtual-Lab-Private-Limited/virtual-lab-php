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
    
    $user_id = $auth->isAuth();
    $returnData = fetchTests($user_id, $conn);
 
}
else {
    $returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
    ];
}

echo json_encode($returnData);

function fetchTests($user_id, $conn){

    try {
        $fetch_test = "SELECT b.`id`, b.`bookingno`,b.`total_amount`,
        b.`test_date`, d.`id` as bdid, d.`runtime_status`, d.`status`, t.`title`, t.`price` FROM `bookings` as b inner join `booking_details` as d on b.`id`= d.`bid` 
        inner join `tests` as t on t.`id`= d.`tid` 
        where b.`uid` = '$user_id' and d.`status` = 'Complete'    " ;
         
        $query_stmt = $conn->prepare($fetch_test);
        $result = $query_stmt->execute();
        if($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $data = array();
            foreach ($row as $item) {
                $key = $item['bookingno']; // or $item['info_id']
                if (!isset($data[$key])) {
                    $data[$key] = array();
                }
            
                $data[$key][] = $item;
            }
            
            return [
                'success' => 1,
                'status' => 200,
                'tests' => $data
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