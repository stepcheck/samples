<?php

// Get connection credentials

	

// checking the user submitted the form
	if(isset($_POST['login'])){
	
	include 'database_connect.php';
	
// Get Email (email is username) and Password
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$userpassword = mysqli_real_escape_string($con, $_POST['userpassword']);

// Query db to find both email and password
	$sel_user = "SELECT * FROM prop_buyer_users WHERE email_address='$email' AND login_password='$userpassword'";
	$run_user = mysqli_query($con, $sel_user);
	$check_user = mysqli_num_rows($run_user);

// If results are more than zero, set session to email and open page, else give error		
		if($check_user == 1){
	
			$row = mysqli_fetch_array($run_user);
		
			if($row["user_access_level"] == 'administrator') {
					session_start();
					$_SESSION['email']= $email;
					$_SESSION['administrator'] = 'administrator';
					echo "<script>window.open('../admin_dashboard.php','_self')</script>";
			}	else {
			
					if($row["account_active"] == 'yes') {
						session_start();
						$_SESSION['email']= $email;
						echo "<script>window.open('../user_dashboard_buyer.php','_self')</script>";
					}
					else {
						echo "<script>alert('Sorry, this account is currently not active.');
						window.open('../index.php','_self');</script>";
					}
			}
		}
		else {
			echo "<script>alert('Email or password is not correct, try again!');
			window.open('../index.php','_self');</script>";
		}
		
		mysqli_close($con);
	
	}
	
?>
	
