<?php
session_start();
include_once("global.php");

if(isset($_POST['username'])){
    
	$name=$_POST['username'];
	$pass=$_POST['pass'];
	$username = str_replace("VLC-","", $name);
  
if((!$username)||(!$pass)){
echo "<script>alert(' please insert both field')</script>";
}else{
	//secure the data
	$pass=md5($pass);
	$query=mysqli_query($con,"SELECT * from collection_center WHERE unique_id='$username' AND  password='$pass' LIMIT 1") or die (mysqli_error());
	$count_query1=mysqli_num_rows($query);
	$query2=mysqli_query($con,"SELECT * from members WHERE username='$username' AND  password='$pass' and status='Active' and member_type=6 LIMIT 1") or die (mysqli_error());
    $count_query2=mysqli_num_rows($query2);
  
   if ($count_query1==0 && $count_query2==0) {
        $message='<font color="red"><p align="center">Invaild Code/Password</p></font>';
        echo "<script>alert('Invaild Code/Password')</script>";
   }
	else{
		//start the session
		$_SESSION['pass']=$pass;
	
			
		if ($count_query1 > 0) {
		    
	    	while($row=mysqli_fetch_array($query)) {
        		$email=$row['email'];
    	    	$id=$row['id'];
    		    $address=$row['address'];
        		$phc_number=$row['phc_number'];
        		$contact=$row['contact'];
        		$firstname=$row['firstname'];
        		$lastname=$row['lastname'];
        		$labid=$row['labid'];
    	    }
    	    $_SESSION['unique_id']=$name;
    		$_SESSION['id']=$id;
    		$_SESSION['address']=$address;
    		$_SESSION['email']=$email;
    		$_SESSION['contact']=$contact;
    	    $_SESSION['firstname']=$firstname;							
    	    $_SESSION['labid']=$labid;
    		$_SESSION['lastname']=$lastname;
		    $_SESSION['role']= 'admin';
		} else {
		    while($row=mysqli_fetch_array($query2)){
        		$email=$row['email'];
    	    	$id=$row['id'];
    		    $address=$row['address'];
        		$phc_number=$row['phc_number'];
        		$contact=$row['contact'];
        		$firstname=$row['firstname'];
        		$lastname=$row['lastname'];
        		$labid=$row['labid'];
        		$cc_no=$row['cc_no'];
    	    }
    	    $_SESSION['unique_id']=$cc_no;
    		$_SESSION['id']=$id;
    		$_SESSION['address']=$address;
    		$_SESSION['email']=$email;
    		$_SESSION['contact']=$contact;
    	    $_SESSION['firstname']=$firstname;							
    	    $_SESSION['labid']=$labid;
    		$_SESSION['lastname']=$lastname;
		    $_SESSION['role']= 'user';
		}
	
		echo '<meta http-equiv="refresh"
   content="0; url='.$baseurl.'home.html">';
	}
	    
}
		
}
?>
<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Virtual Lab | Collection Center Dashboard </title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  
  <link rel='shortcut icon' type='image/x-icon' href='<?php echo $baseurl;?>images/favicon.png' />

</head>

<body class="background-image-body">
  
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand login-brand-color">
            	<img alt="image" src="assets/img/logo.png" />
              Virtual Lab
            </div>
            <div class="card card-auth">
              <div class="card-header card-header-auth">
                <h4>Login</h4>
              </div>
              <div class="card-body">
<form method="post" action="<?php echo $baseurl;?>login.html" class="needs-validation" novalidate>
                  <div class="form-group">
                    <label >Username</label>
                    <input type="text" class="form-control" name="username" autocomplete="off" tabindex="1" required autofocus>
                    
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="forgotpassword.php" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
<input type="password" class="form-control" name="pass" value="" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>
                  <div class="form-group">
<input type="submit" name="submit" class="btn btn-lg btn-block btn-auth-color" tabindex="4">
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  
</body>


<!-- Mirrored from radixtouch.in/templates/snkthemes/grexsan/source/light/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 10 Jul 2020 09:19:06 GMT -->
</html>