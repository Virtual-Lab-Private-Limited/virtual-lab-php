<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../classes/Database.php';
require __DIR__ . '/../middlewares/Auth.php';

$allHeaders = getallheaders();

$conn=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");
$auth = new Auth($conn, $allHeaders);

$dir = '../../../../members';
$name = basename($_FILES['image']['name']);
$t_name = $_FILES['image']['tmp_name'];


if ($auth->isAuth()) {
    $user_id = $auth->isAuth();
    
    $move = move_uploaded_file($t_name, $dir.'/'.$name); 
    if ($move) {
        $returnData = addTest($user_id, $name, $conn);
    }
    else {
    
        $returnData = [
            "success" => 0,
            "status" => 401,
            "message" => $move,
        ];
    }
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function addTest($user_id, $name, $con)
{

    try {
        
        $description = $_POST['description'];
        $datetime = $_POST['datetime'];
        $date = date("d m y");
        mysqli_query($con,
                "insert into patient_prescription (patient_id, image, date_entry, resolved, description, datetime) values ('$user_id','members/$name', '$date', 0, '$description', '$datetime' ) ")
            or die(mysqli_error($con));
        $patients = mysqli_query($con, "select * from patients where id='$user_id' limit 1") or die(mysqli_error($con));
        while ($data = mysqli_fetch_array($patients)) {
            $patient_no = $data['patient_no'];
        }
        $today = date("d m Y h:i:s A");
         
        mysqli_query($con, "insert into notifications (message, datetime, resolved, admin) values ('Patient $patient_no has uploaded a prescription','$today', 0, 1) ")
            or die(mysqli_error($con));

        return [
                'success' => 1,
                'status' => 200,
                'tests' => 'Prescription uploaded successfully'
            ];
        
    }
    catch(Exception $e){
        return [
                "success" => 0,
                "status" => 401,
                "message" => "Some error occurred"
            ];
    }
    
}
