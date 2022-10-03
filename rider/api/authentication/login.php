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

require __DIR__.'/classes/Database.php';
require __DIR__.'/classes/JwtHandler.php';

$db_connection = new Database();
$conn = $db_connection->dbConnection();

$data = json_decode(file_get_contents("php://input"));
$returnData = [];

// IF REQUEST METHOD IS NOT EQUAL TO POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif(!isset($data->contact) 
    || !isset($data->password)
    || empty(trim($data->contact))
    || empty(trim($data->password))

    ):

    $fields = ['fields' => ['contact','password']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
    $contact = trim($data->contact);
    $password = trim($data->password);
    
    // CHECKING THE contact FORMAT (IF INVALID FORMAT)
    if(strlen($contact) < 11):
        $returnData = msg(0,422,'Invalid Contact!');
    
    // IF PASSWORD IS LESS THAN 8 THE SHOW THE ERROR
    elseif(strlen($password) < 8):
        $returnData = msg(0,422,'Your password must be at least 8 characters long!');

    // THE USER IS ABLE TO PERFORM THE LOGIN ACTION
    else:
        try{
            
            $fetch_user_by_contact = "SELECT * FROM `rider` WHERE `contact`=:contact and `password`=:password ";
            $query_stmt = $conn->prepare($fetch_user_by_contact);
            $query_stmt->bindValue(':contact', $contact,PDO::PARAM_STR);
            $query_stmt->bindValue(':password', md5($password) ,PDO::PARAM_STR);
            $query_stmt->execute();
            $user = $query_stmt->fetch();
            $id = $user['id'];
    
            // IF THE USER IS FOUNDED BY contact
   
            if($query_stmt->rowCount()):

                $jwt = new JwtHandler();
                $token = $jwt->_jwt_encode_data(
                    'www.virtuallab.com.pk',
                    array("rider_id"=> $id)
                );
                $sql = "UPDATE rider SET longitude=?, latitude=?, fcm_id=?  WHERE id=?";
                $conn->prepare($sql)->execute([$data->longitude, $data->latitude, $data->fcm_id, $id]);
    
                
                  
                
                $returnData = [
                    'success' => 1,
                    'message' => 'You have successfully logged in.',
                    'token' => $token,
                    'rider_id'=> $id
                ];

                // IF INVALID PASSWORD
               

            // IF THE USER IS NOT FOUNDED BY contact THEN SHOW THE FOLLOWING ERROR
            else:
                $returnData = msg(0,422,'Invalid Credentials!');
            endif;
        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }

    endif;

endif;

echo json_encode($returnData);