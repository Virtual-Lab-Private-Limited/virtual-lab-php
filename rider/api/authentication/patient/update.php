<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../classes/Database.php';
require __DIR__ . '/../middlewares/Auth.php';

function msg($success, $status, $message, $extra = [])
{
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message,
    ], $extra);
}

$allHeaders = getallheaders();
$db_connection = new Database();
$conn = $db_connection->dbConnection();
$auth = new Auth($conn, $allHeaders);
$data = json_decode(file_get_contents("php://input"));

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $returnData = msg(0, 404, 'Page Not Found!');
} else if ($auth->isAuth()) {
    $user_id = $auth->isAuth();
    $returnData = updateProfile($user_id, $conn, $data);
} else {
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function updateProfile($user_id, $conn, $data)
{

    try {
        if (
            !isset($data->gender)
            || !isset($data->firstname)
            || !isset($data->lastname)
            || !isset($data->address)
            || !isset($data->dob)
            || !isset($data->city)
            || empty(trim($data->gender))
            || empty(trim($data->address))
            || empty(trim($data->dob))
            || empty(trim($data->city))
            || empty(trim($data->firstname))
            || empty(trim($data->lastname))
        ) {

            $fields = ['fields' => ['firstname', 'lastname', 'gender', 'address', 'city', 'dob']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        }
        // IF THERE ARE NO EMPTY FIELDS THEN-
        else {
            $firstname = trim($data->firstname);
            $lastname = trim($data->lastname);
            $gender = trim($data->gender);
            $patient_id = trim($data->patient_id);
            $address = trim($data->address);
            $dob = trim($data->dob);
            $contact = trim($data->contact);
            $city = trim($data->city);
         
            $update_user = "UPDATE patients SET firstname=?, lastname=?, gender=?,address=?,city=?,dob=?,contact=? WHERE id=?";
            $conn->prepare($update_user)->execute([$firstname, $lastname, $gender, $address, $city, $dob, $contact, $patient_id]);
     
            $returnData = msg(1, 201, 'Patient information has successfully been updated.');

        }

    } catch (PDOException $e) {
        $returnData = msg(0, 500, $e->getMessage());

    }
    return $returnData;
}
