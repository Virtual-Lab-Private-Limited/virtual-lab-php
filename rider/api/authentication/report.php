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

// INCLUDING DATABASE AND MAKING OBJECT
require __DIR__.'/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

if( !isset($data->caseno)
    || empty(trim($data->caseno))
    ):

    $fields = ['fields' => ['caseno']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
   
    $caseno = trim($data->caseno);
 
    try{

            $query = "SELECT d.id, t.title FROM booking_details d, bookings b, tests t WHERE b.id = d.bid and d.tid = t.id and d.status = 'Complete' and b.bookingno=:caseno";
            $query_stmt = $conn->prepare($query);
            $query_stmt->bindValue(':caseno', $caseno,PDO::PARAM_STR);
            $query_stmt->execute();
            if($query_stmt->rowCount()):
                $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
                $returnData = msg(1,200,$row);
            else:
                $returnData = msg(0,401,"No data to show");
            endif;

    }
    catch(PDOException $e){
        $returnData = msg(0,500,$e->getMessage());
    }
 
    
endif;

echo json_encode($returnData);