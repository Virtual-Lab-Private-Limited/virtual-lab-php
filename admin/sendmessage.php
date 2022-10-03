<?php
include("global.php");
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$userid=$_POST['userid'];
	$email=$_POST['email'];
	mysqli_query($con,"update members set status='Allow' where id='$userid' limit 1") or die (mysqli_error());
$useremail= $_REQUEST['email'] ;
$to = $useremail;
$subject = "Allow for Examination | Virtual Lab" ;
$message = '
<html>
<table cellspacing="2" cellpadding="2" border="1" width="643" bordercolor="#000">
  <tr>
  <td colspan="2">
 <div style="background-color:#2f7af8;color:#ffffff;border:1px solid; width:643px; height:30px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:16px;"><div style="margin-top:5px;"><strong>Documents Verified</strong></div>
   </div>
    <div style="background-color:#2f7af8;color:#ffffff;border:1px solid; width:643px; height:30px;text-align:center;font-family:Verdana, Geneva, sans-serif;font-size:16px;"><div style="margin-top:5px;"><strong>Dear Candidate, You are allowed to take online Test</strong></div>
</td>
  </tr>
 </div>

  
  <tr>
   <td width="200" style="background-color:#2f7af8;color:#ffffff;font-family:Verdana, Geneva, sans-serif;font-size:12px;font-weight:bold;padding:5px;"> Exam </td>
    <td > exams.virtuallab.com.pk </td>
  </tr>
  <tr>
   
  
  
</table>
</html>
';
//echo $message;


$headers = "MIME-Version: 1.0". "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
$headers .= 'From: <no-reply@virtuallab.com.pk>' ."\r\n";
mail($to,$subject,$message,$headers);
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=pending_staff.html">'; 

}else{
//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">'; 
}
 



?>