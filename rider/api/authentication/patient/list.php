<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../classes/Database.php';
require __DIR__ . '/../middlewares/Auth.php';

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);

if ($auth->isAuth()) {
    $user_id = $auth->isAuth();
    $returnData = listFamily($user_id, $conn);
} else {
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}
// CHECKING EMPTY FIELDS
echo json_encode($returnData);

function listFamily($user_id, $conn)
{
    try {
        $fetch_test = "SELECT p.* FROM `rider_patient` as r join `patients` as p on r.`patient_id`= p.`id` where r.`rider_id`= '$user_id' ";

        $query_stmt = $conn->prepare($fetch_test);
        $result = $query_stmt->execute();
        if ($query_stmt->rowCount()):
            $row = $query_stmt->fetchAll(PDO::FETCH_ASSOC);
            return [
                'success' => 1,
                'status' => 200,
                'user' => $row,
            ];
        else:
             return [
                'success' => 0,
                'status' => 400,
                'user' => "No data to show",
            ];
        endif;
    } catch (PDOException $e) {

        return [
            'success' => 0,
            'status' => 500,
            'user' => $e->getMessage(),
        ];
    }
}
