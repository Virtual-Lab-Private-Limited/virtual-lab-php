<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ], $extra);
}

require __DIR__ . '/classes/Database.php';
require __DIR__ . '/classes/JwtHandler.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if ($_SERVER["REQUEST_METHOD"] != "POST") :
    $returnData = msg(0, 404, 'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif (
    !isset($data->contact)
    || !isset($data->patient_no)
    || empty(trim($data->contact))
    || empty(trim($data->patient_no))
) :

    $fields = ['fields' => ['contact', 'patient_no']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :
    $contact = trim($data->contact);
    $patient_no = trim($data->patient_no);

    try {

        $fetch_user_by_contact = "SELECT * FROM `patients` WHERE `contact`=:contact and `patient_no`=:patient_no";
        $query_stmt = $conn->prepare($fetch_user_by_contact);
        $query_stmt->bindValue(':contact', $contact, PDO::PARAM_STR);
        $query_stmt->bindValue(':patient_no', $patient_no, PDO::PARAM_STR);

        $query_stmt->execute();
        $user = $query_stmt->fetch();
        $id = $user['id'];

        // IF THE USER IS FOUNDED BY contact

        if ($query_stmt->rowCount()) :
            $returnData = [
                'success' => 1,
                'message' => 'Patient exsists.',
                'user_id' => $id
            ];

        // IF THE USER IS NOT FOUNDED BY contact THEN SHOW THE FOLLOWING ERROR
        else :
            $returnData = [
                'success' => 0,
                'message' => 'Patient do not exsists.',
            ];
        endif;
    } catch (PDOException $e) {
        $returnData = msg(0, 500, $e->getMessage());
    }



endif;

echo json_encode($returnData);
