<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
<title>Password Reset - Boston Property Buyers</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages.jpg" border="0" />
		</div>

		<div class="section1">
			
			
			<?php 
				// If form was submitted from This page (password_reset_page.php), then proceed.
				// Form named pvalidX2 as a precaution to prevent bots from guessing form name
				// Also acts as a unique identifier
		if (isset($_POST['pvalidX2'])) {
				// Ensure email is actually an email
			if (empty($_POST['emailaddress']) || !isset($_POST['emailaddress'])) {
				
				if($_POST['email'] = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				
					//Connect to database
						include 'includes/database_connect.php';

					// Select table in database
						$table = "prop_buyer_users";

					// Query to see if email address already exists.
						$emailExist = "SELECT * FROM $table WHERE email_address = '$_POST[email]'";
						$emailRun = mysqli_query($con, $emailExist);
		
					// Get number of Rows
						$qnumrows = mysqli_num_rows($emailRun);

					// If number of rows = 1, then proceed with send password reset email
					if($qnumrows == 1) {
					// Include form processing script 
						$row = mysqli_fetch_array($emailRun);
						$password = $row['login_password'];
						include 'includes/send_password_recover_email_code.php';
						$con->close();
						
						echo "<h1>Your Password Email Was Sent!</h1>";
						echo "<span class="note-green">Success! Please check your email to retrieve your password - " . $_POST[email] . "</span>";
						echo "<br />";
						include 'includes/login_form_nomad_large.php';
						
					} else {
					// If number of rows is > 0, say an account already exists.
						echo "<h1>Oops, there was a small problem...</h1>";
						echo '<span class="note-red">The email you entered does not exist in our system: ' . $_POST[email] . '</span>';
						echo "<p>Please try submitting your email again:</p>";
						
						include 'includes/password_reset_form.php';
						
					}
				} // End check email = email	
				else {
					echo "<h1>There Was An Error</h1>";
					echo '<span class="note-red">Sorry, your email was not formatted properly. </span>';
					echo "<p>Please try submitting your email again:</p>";
					include 'includes/password_reset_form.php';
				}
			} // End Honeypot
			else {
			echo "<h1>There Was An Error</h1>";
			echo '<span class="note-red">Sorry, the information was not submitted correctly. </span>';
			echo "<p>Please try submitting your email again:</p>";
			include 'includes/password_reset_form.php';
			}
		} // END IF FORM WAS SUBMITTED
		else {
			echo "<h1>Lost Your Password?</h1>";
			echo "<h2>Please submit your email to retrieve your password:</h1>";
			include 'includes/password_reset_form.php';
		}
	?>
		
			

		
		
		</div>

		<div class="section">
		
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>