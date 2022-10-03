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
    $rider_id = $auth->isAuth();
    $returnData = fetchBookings($rider_id, $conn);
 
}
else{
    $returnData = [
    "success" => 0,
    "status" => 401,
    "message" => "Unauthorized"
    ];
}

echo json_encode($returnData);

function fetchBookings($rider_id, $conn){

    try{
        
        $fetch_test = "SELECT br.bid, br.status, br.date, br.time, b.bookingno, b.lati, b.longi, b.total_amount, b.discount, p.id as pid, p.firstname, p.lastname, 
        p.age, p.contact, p.address, p.city, p.device_id,d.tid as test_id, t.title, t.price, t.sample
        from booking_rider br, bookings b, patients p, booking_details d, tests t
        where br.bid = b.id and d.bid = b.id and t.id = d.tid and b.uid = p.id  and br.rid = $rider_id and br.complete=0   " ;
          
        $query_stmt = $conn->prepare($fetch_test);
        $result = $query_stmt->execute();
        if($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'bookings' => $row
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