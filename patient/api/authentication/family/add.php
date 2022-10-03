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
        || !isset($data->relation)
        || !isset($data->gender)
        || !isset($data->city)
        || !isset($data->dob)
        || empty(trim($data->firstname))
        || empty(trim($data->lastname))
        || empty(trim($data->relation))
        || empty(trim($data->gender))
        || empty(trim($data->city))
        || empty(trim($data->dob))

    ):

        $fields = ['fields' => ['firstname', 'lastname', 'relation', 'gender', 'city', 'dob']];
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
        $relation = trim($data->relation);
     

       
        if (strlen($firstname) < 3):
            $returnData = msg(0, 422, 'Your name must be at least 3 characters long!');

        else:
            try {

                // $check_cnic = "SELECT `cnic` FROM `patients` WHERE `cnic`=:cnic";
                // $check_cnic_stmt = $conn->prepare($check_cnic);
                // $check_cnic_stmt->bindValue(':cnic', $cnic, PDO::PARAM_STR);
                // $check_cnic_stmt->execute();

                // if ($check_cnic_stmt->rowCount()):
                //     $returnData = msg(0, 422, 'This Cnic already in use!');

                // else:
                    $insert_query = "INSERT INTO `patients`(`firstname`,`lastname`,`gender`,`city`,`dob`,`cnic`,`contact`, `address`, `date_entry`,`labid`,`addby`,`parentid`)
                    VALUES(:firstname,:lastname,:gender,:city,:dob,:cnic, :contact, :address, :date_entry, :labid, :addby, :parentid)";

                    $insert_stmt = $conn->prepare($insert_query);
                    
                    $date = date("d m Y");
              
                    $stmt = $conn->prepare("SELECT address FROM patients WHERE id=? LIMIT 1"); 
                    $stmt->execute([$user_id]); 
                    $result = $stmt->fetch();
                    $address = $result['address'];
                 
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
                    $insert_stmt->bindValue(':parentid', $user_id, PDO::PARAM_STR);

                    $insert_stmt->execute();
                    $id = $conn->lastInsertId();
                    $patient_no = date("dmY") . $id;

                    $sql = "UPDATE patients SET patient_no=? WHERE id=?";
                    $conn->prepare($sql)->execute([$patient_no, $id]);

                    $ql = "INSERT INTO `patient_family`(`user_id`, `relation`, `relation_id`)Values(:user_id, :relation, :relation_id)";
                    $insert_stmt = $conn->prepare($ql);
                    $insert_stmt->bindValue(':user_id', $user_id, PDO::PARAM_STR);
                    $insert_stmt->bindValue(':relation', $relation, PDO::PARAM_STR);
                    $insert_stmt->bindValue(':relation_id', $id, PDO::PARAM_STR);
                    $insert_stmt->execute();

                    $returnData = msg(1, 201, 'You have successfully registered your family member.');

                //endif;

            } catch (PDOException $e) {
                $returnData = msg(0, 500, $e->getMessage());
            }

        endif;

    endif;
    
    return $returnData;
}
