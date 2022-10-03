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

$patient_id = $_REQUEST['patient_id'];

if ($auth->isAuth()) {
    $user_id = $auth->isAuth();
    $returnData = deletePatient($user_id, $patient_id, $conn);

} else {
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}
// CHECKING EMPTY FIELDS

echo json_encode($returnData);

function deletePatient($user_id, $patient_id, $conn)
{
    try {
        $fetch_test = "Delete FROM `rider_patient` where `rider_id`=$user_id and `patient_id`=$patient_id";

        $query_stmt = $conn->prepare($fetch_test);
        $result = $query_stmt->execute();
        if ($result):
            return [
                'success' => 1,
                'status' => 200,
                'user' => "Successfully deleted!",
            ];
        else:
            return [
                'success' => 0,
                'status' => 400,
                'user' => "No such patient found",
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
