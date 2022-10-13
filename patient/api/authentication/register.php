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

// INCLUDING DATABASE AND MAKING OBJECT
require __DIR__ . '/classes/Database.php';
$db_connection = new Database();
$conn = $db_connection->dbConnection();

// GET DATA FORM REQUEST
$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT POST
if ($_SERVER["REQUEST_METHOD"] != "POST") :
    $returnData = msg(0, 404, 'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif (
    !isset($data->firstname)
    || !isset($data->lastname)
    || !isset($data->password)
    || !isset($data->gender)
    || !isset($data->contact)
    || !isset($data->city)
    || !isset($data->dob)
    || !isset($data->device_id)
    || !isset($data->address)
    || empty(trim($data->firstname))
    || empty(trim($data->lastname))
    || empty(trim($data->password))
    || empty(trim($data->gender))
    || empty(trim($data->contact))
    || empty(trim($data->city))
    || empty(trim($data->dob))
    || empty(trim($data->device_id))
    || empty(trim($data->address))
) :

    $fields = ['fields' => ['firstname', 'lastname', 'password', 'gender', 'contact', 'city', 'dob', 'device_id', 'address']];
    $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else :

    $firstname = trim($data->firstname);
    $lastname = trim($data->lastname);
    $gender = trim($data->gender);
    $contact = trim($data->contact);
    $city = trim($data->city);
    $cnic = trim($data->cnic);
    $dob = trim($data->dob);
    $address = trim($data->address);
    $device_id = trim($data->device_id);
    $password = trim($data->password);
    $today = date("Y-m-d");

    $age = date_diff(date_create($data->dob), date_create($today));
    $age = $age->format('%y');

    if (strlen($contact) < 11) :
        $returnData = msg(0, 422, 'Invalid Contact. Must be valid 11 digits!');

    elseif (strlen($password) < 8) :
        $returnData = msg(0, 422, 'Your password must be at least 8 characters long!');

    elseif (strlen($firstname) < 3) :
        $returnData = msg(0, 422, 'Your name must be at least 3 characters long!');

    else :
        try {


            $check_contact = "SELECT `contact` FROM `patients` WHERE `contact`=:contact";
            $check_contact_stmt = $conn->prepare($check_contact);
            $check_contact_stmt->bindValue(':contact', $contact, PDO::PARAM_STR);
            $check_contact_stmt->execute();

            if ($check_contact_stmt->rowCount()) {
                $returnData = msg(0, 422, 'This contact already registered with us!');
            } else {


                $insert_query = "INSERT INTO `patients`(`firstname`,`lastname`,`gender`,`contact`,`city`,`dob`,`age`,`cnic`,`password`, `device_id`, `address`, `date_entry`) 
                VALUES(:firstname,:lastname,:gender,:contact,:city,:dob,:age,:cnic,:password, :device_id, :address, :date_entry)";

                $date = date("d m Y");

                $insert_stmt = $conn->prepare($insert_query);

                // DATA BINDING
                $insert_stmt->bindValue(':firstname', htmlspecialchars(strip_tags($firstname)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':lastname', htmlspecialchars(strip_tags($lastname)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':contact', $contact, PDO::PARAM_STR);
                $insert_stmt->bindValue(':dob', $dob, PDO::PARAM_STR);
                $insert_stmt->bindValue(':age', $age, PDO::PARAM_STR);
                $insert_stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
                $insert_stmt->bindValue(':city', $city, PDO::PARAM_STR);
                $insert_stmt->bindValue(':cnic', $cnic, PDO::PARAM_STR);
                $insert_stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
                $insert_stmt->bindValue(':device_id', $device_id, PDO::PARAM_STR);
                $insert_stmt->bindValue(':address', $address, PDO::PARAM_STR);
                $insert_stmt->bindValue(':date_entry', $date, PDO::PARAM_STR);
                $insert_stmt->execute();
                $id = $conn->lastInsertId();

                $patient_no = date("Y") . '-' . date("dm") . '-' . $id;

                $sql = "UPDATE patients SET patient_no=? WHERE id=?";
                $conn->prepare($sql)->execute([$patient_no, $id]);

                $returnData = msg(1, 201, 'You have successfully registered.');
            }
        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }
    endif;

endif;

echo json_encode($returnData);
