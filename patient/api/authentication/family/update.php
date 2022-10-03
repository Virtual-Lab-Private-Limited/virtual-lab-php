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
            || !isset($data->relation)
            || !isset($data->address)
            || !isset($data->dob)
            || !isset($data->city)
            || empty(trim($data->gender))
            || empty(trim($data->relation))
            || empty(trim($data->address))
            || empty(trim($data->dob))
            || empty(trim($data->city))
            || empty(trim($data->firstname))
            || empty(trim($data->lastname))
        ) {

            $fields = ['fields' => ['firstname', 'lastname', 'gender', 'relation', 'address', 'city', 'dob']];
            $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);
        }
        // IF THERE ARE NO EMPTY FIELDS THEN-
        else {
            $firstname = trim($data->firstname);
            $lastname = trim($data->lastname);
            $gender = trim($data->gender);
            $relation_id = trim($data->relation_id);
            $address = trim($data->address);
            $dob = trim($data->dob);
            $city = trim($data->city);
            $relation = trim($data->relation);

            $update_user = "UPDATE patients SET firstname=?, lastname=?, gender=?,address=?,city=?,dob=? WHERE id=?";
            $conn->prepare($update_user)->execute([$firstname, $lastname, $gender, $address, $city, $dob, $relation_id]);

            $update_relation = "UPDATE patient_family SET relation=? WHERE user_id=? and relation_id=?";
            $conn->prepare($update_relation)->execute([$relation, $user_id, $relation_id]);

            $returnData = msg(1, 201, 'Relation has successfully been updated.');

        }

    } catch (PDOException $e) {
        $returnData = msg(0, 500, $e->getMessage());

    }
    return $returnData;
}
