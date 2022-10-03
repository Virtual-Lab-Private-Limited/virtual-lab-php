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

// IF REQUEST METHOD IS NOT POST
if($_SERVER["REQUEST_METHOD"] != "POST"):
    $returnData = msg(0,404,'Page Not Found!');

// CHECKING EMPTY FIELDS
elseif( !isset($data->contact)
    || !isset($data->password)
    || empty(trim($data->contact))
    || empty(trim($data->password))
    ):

    $fields = ['fields' => ['contact', 'password']];
    $returnData = msg(0,422,'Please Fill in all Required Fields!',$fields);

// IF THERE ARE NO EMPTY FIELDS THEN-
else:
   
    $contact = trim($data->contact);
    $password = trim($data->password);

    
    if(strlen($contact) < 11):
            $returnData = msg(0,422,'Invalid Contact. Must be valid 11 digits!');
    elseif(strlen($password) < 8):
        $returnData = msg(0,422,'Your password must be at least 8 characters long!');
    
    else:
        try{

                $check_contact = "SELECT `contact` FROM `patients` WHERE `contact`=:contact";
                $check_contact_stmt = $conn->prepare($check_contact);
                $check_contact_stmt->bindValue(':contact', $contact,PDO::PARAM_STR);
                $check_contact_stmt->execute();
    
                if($check_contact_stmt->rowCount()){
                    $sql = "UPDATE patients SET password=? WHERE contact=?";
                    $conn->prepare($sql)->execute([password_hash($password, PASSWORD_DEFAULT), $contact]);
    
                    $returnData = msg(1,201,'You have successfully reset your password.');
                    
                }    
                    
                else{
                
                    $returnData = msg(0,422, 'This Contact is not registered!');   
                    
                }   

            

        }
        catch(PDOException $e){
            $returnData = msg(0,500,$e->getMessage());
        }
    endif;
    
endif;

echo json_encode($returnData);