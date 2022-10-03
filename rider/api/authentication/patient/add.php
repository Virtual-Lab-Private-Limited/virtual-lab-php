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

if ($auth->isAuth()) {
    $user_id = $auth->isAuth();
    $returnData = addFamily($user_id, $data, $conn);
} else {
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}
// CHECKING EMPTY FIELDS

echo json_encode($returnData);

function addFamily($user_id, $data, $conn)
{
    if (!isset($data->firstname)
        || !isset($data->lastname)
        || !isset($data->gender)
        || !isset($data->city)
        || !isset($data->dob)
        || !isset($data->contact)
        || !isset($data->address)
        || empty(trim($data->firstname))
        || empty(trim($data->lastname))
        || empty(trim($data->gender))
        || empty(trim($data->city))
        || empty(trim($data->dob))
        || empty(trim($data->contact))
        || empty(trim($data->address))
    ):

        $fields = ['fields' => ['firstname', 'lastname', 'gender', 'contact', 'address', 'city', 'dob']];
        $returnData = msg(0, 422, 'Please Fill in all Required Fields!', $fields);

        // IF THERE ARE NO EMPTY FIELDS THEN-
    else:

        $firstname = trim($data->firstname);
        $lastname = trim($data->lastname);
        $gender = trim($data->gender);
        $city = trim($data->city);
        $cnic = trim($data->cnic);
        $dob = trim($data->dob);
        $contact = trim($data->contact);
        $address = trim($data->address);

        
        try {

            $check_cnic = "SELECT `cnic` FROM `patients` WHERE `cnic`=:cnic";
            $check_cnic_stmt = $conn->prepare($check_cnic);
            $check_cnic_stmt->bindValue(':cnic', $cnic, PDO::PARAM_STR);
            $check_cnic_stmt->execute();
            if (empty(trim($data->cnic))){
                $count = 0;
            } else {
                $count = $check_cnic_stmt->rowCount();
            }
            
            if ($count > 0):
                $returnData = msg(0, 422, 'This Cnic already in use!');

            else:
                $insert_query = "INSERT INTO `patients`(`firstname`,`lastname`,`gender`,`city`,`dob`,`cnic`,`contact`, `address`, `date_entry`,`labid`,`addby`,`parentid`)
                VALUES(:firstname,:lastname,:gender,:city,:dob,:cnic, :contact, :address, :date_entry, :labid, :addby, :parentid)";

                $insert_stmt = $conn->prepare($insert_query);
                
                $date = date("d m Y");
          
                // DATA BINDING
                $insert_stmt->bindValue(':firstname', htmlspecialchars(strip_tags($firstname)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':lastname', htmlspecialchars(strip_tags($lastname)), PDO::PARAM_STR);
                $insert_stmt->bindValue(':dob', $dob, PDO::PARAM_STR);
                $insert_stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
                $insert_stmt->bindValue(':city', $city, PDO::PARAM_STR);
                $insert_stmt->bindValue(':cnic', $cnic, PDO::PARAM_STR);
                $insert_stmt->bindValue(':contact', $contact, PDO::PARAM_STR);
                $insert_stmt->bindValue(':address', $address, PDO::PARAM_STR);
                
                $insert_stmt->bindValue(':date_entry', $date, PDO::PARAM_STR);
                $insert_stmt->bindValue(':labid', 0, PDO::PARAM_STR);
                $insert_stmt->bindValue(':addby', $user_id, PDO::PARAM_STR);
                $insert_stmt->bindValue(':parentid', 0, PDO::PARAM_STR);

                $insert_stmt->execute();
                $id = $conn->lastInsertId();
                $patient_no = date("Y") .'-'. date("dm").'-'. $id;
                
                $sql = "UPDATE patients SET patient_no=? WHERE id=?";
                $conn->prepare($sql)->execute([$patient_no, $id]);

                $ql = "INSERT INTO `rider_patient`(`rider_id`, `patient_id`) values (:rider_id, :patient_id)";
                $insert_stmt = $conn->prepare($ql);
                $insert_stmt->bindValue(':rider_id', $user_id, PDO::PARAM_STR);
                $insert_stmt->bindValue(':patient_id', $id, PDO::PARAM_STR);
                $insert_stmt->execute();

                $returnData = msg(1, 201, 'You have successfully registered the patient.');

            endif;

        } catch (PDOException $e) {
            $returnData = msg(0, 500, $e->getMessage());
        }

        

    endif;
    
    return $returnData;
}
