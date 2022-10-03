<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__.'/classes/Database.php';
require __DIR__.'/middlewares/Auth.php';


$allHeaders = getallheaders();
$db_connection = new Database();
$conn=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");
$auth = new Auth($conn,$allHeaders);
$data = json_decode(file_get_contents("php://input"));

if ($auth->isAuth()){

    $user_id = $auth->isAuth();    
    $returnData = applyPromo($user_id, $conn, $data);
  
}
else {
    $returnData = msg(0,401,'Unauthorized');
}

echo json_encode($returnData);

function applyPromo($user_id, $conn, $data){
        
    $code = $data->promo_code;

    $vouchers = mysqli_query($conn, "select * from vouchers where code='$code' ") or die(mysqli_error($conn));
    
    if (mysqli_num_rows($vouchers) > 0){
        while ($data = mysqli_fetch_array($vouchers)) {
            $id = $data['id'];
            $discount = $data['discount'];
            $uses = $data['uses'];
            $max_uses = $data['max_uses'];
            $max_uses_user = $data['max_uses_user'];
            
            if($uses == $max_uses) {
                 $returnData = msg(0,401,'This promo has already reached its maximum usage!');
            } else {
                 $check_usage = mysqli_query($conn, "select * from user_voucher where voucher_id='$id' and user_id='$user_id' ") or die(mysqli_error($conn));
                 $count = mysqli_num_rows($check_usage);
                 
                 if ( $count >= $max_uses_user){
                   
                        $returnData = msg(0,401,'You have reached your maximum usage for this promo');
                  }
                  else {
                      $date = Date('Y m d h:i:s');
                
                      mysqli_query($conn, "insert into user_voucher ( voucher_id, user_id, created_at) values ('$id','$user_id','$date' ) ") or die(mysqli_error($conn));
                      $use = $uses+1;
                      mysqli_query($conn, "update vouchers set uses='$use' where id='$id' ") or die(mysqli_error($conn));
                      
                      $returnData = msg(1,200,$discount);
                  }
   
            }
    
        }
    } else {
        $returnData = msg(0,401,'Invalid code!');
    
    }
    
    return $returnData;
 
}

function msg($success,$status,$message){
    return array_merge([
        'success' => $success,
        'message' => $message,
        'status' => $status
    ]);
}