<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '/../classes/Database.php';
require __DIR__ . '/../middlewares/Auth.php';

$allHeaders = getallheaders();
$db_connection = new Database();

$conn=mysqli_connect("localhost","nxqxtdmy_virtual","Allah@Muhammad@786","nxqxtdmy_virtuallab");

$auth = new Auth($conn, $allHeaders);
$data = json_decode(file_get_contents("php://input"));

if ($auth->isAuth()) {
    $rider_id = $auth->isAuth();
    $returnData = completeRide($rider_id, $data, $conn);
    
} else {
    
    $returnData = [
        "success" => 0,
        "status" => 401,
        "message" => "Unauthorized",
    ];
}

echo json_encode($returnData);

function completeRide($rider_id, $data, $con)
{

    try {

        $booking_id = $data->booking_id;
        $frenchise_id = $data->frenchise_id;
        
        $completed_at = date("d m Y h:i:s A");
        mysqli_query($con, "update booking_rider set complete='1',status='completed', completed_at='$completed_at' where bid='$booking_id'") or die(mysqli_error($con));
        
        $result = mysqli_query($con, "select * from frenchises where id='$frenchise_id' ") or die(mysqli_error($con));
        
        while($info = mysqli_fetch_array($result)){
            $fid = $info['id'];
            $frenchise = $info['username'];
        }
   
        $runtime_status = "Phlebotomist drop the sample to ".$frenchise." at " . date("d m Y h:i:s A");
        mysqli_query($con, "update bookings set labid='$frenchise_id' where id='$booking_id'") or die(mysqli_error($con));
        mysqli_query($con, "update booking_details set runtime_status='$runtime_status', labid='$frenchise_id' where bid='$booking_id'") or die(mysqli_error($con));

        
        $bookings = mysqli_query($con, "select * from bookings where id='$booking_id' ") or die(mysqli_error($con));
        while($b = mysqli_fetch_array($bookings)){
            $b_no= $b['bookingno'];
        }
        $details = mysqli_query($con, "select * from booking_details where bid='$booking_id' ") or die(mysqli_error($con));
        
        $total = 0;
        $earned = 0;
        $amount_to_pay = 0;
        
        while($bk = mysqli_fetch_array($details)){
            $tid = $bk['tid'];
            $tests = mysqli_query($con, "select * from tests where id='$tid' ") or die(mysqli_error($con));
            
            while($t = mysqli_fetch_array($tests)){
                $type = $t['discount_type'];
                $price = $t['price'];
                $total = $total + $price;
                
                $discounts = mysqli_query($con, "select * from discounts where id='$type' ") or die(mysqli_error($con));
                while($d = mysqli_fetch_array($discounts)){
                    $discount = $d['discount'];
                    $amount = ($price * $discount)/100;
                    $earned = $earned + $amount;
                    $amount_to_pay = $amount_to_pay + ( $price - $earned);
                }
            }
        }
        
        $earnings=mysqli_query($con,"SELECT sum(amount_to_pay) as total FROM rider_earnings WHERE r_id = $rider_id  ") or die (mysqli_error($con));
        while($data=mysqli_fetch_array($earnings)) { 
           $sum =  $data['total'];
        }
    
        $wallet = $sum + $amount_to_pay;
        
        if ($wallet > 10000) {
            mysqli_query($con, "insert into rider_earnings ( r_id, b_no, total, earned, amount_to_pay, date, paid) 
        values ('$rider_id','$b_no','$total','$earned','$amount_to_pay','$completed_at','0' ) ") or die(mysqli_error($con));
            
        } else {
            mysqli_query($con, "insert into rider_earnings ( r_id, b_no, total, earned, amount_to_pay, date, paid) 
        values ('$rider_id','$b_no','$total','$earned','$amount_to_pay','$completed_at','1' ) ") or die(mysqli_error($con));
        
        }
        
        $today = date("d m Y h:i:s A");
                 
        mysqli_query($con, "insert into notifications (message, datetime, resolved, frenchise, labid) values ('Phlebotomist $rider_id has dropped the sample to your frenchise against
        booking no $b_no','$today', 0, 1, '$fid') ")
            or die(mysqli_error($con));
        
        return [
            'success' => 1,
            'status' => 200,
            'message' => 'Sample submitted successfully',
        ];
        
    } catch (Exception $e) {
        return [
            "success" => 0,
            "status" => 401,
            "message" => $e->getMessage(),
        ];

    }

}
