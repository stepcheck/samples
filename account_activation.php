<?php session_start(); ?>

<?php include 'includes/header1.php'; ?>
<title>Account Activation</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Account Activation</h1>
			
			
		<?php 
		
// THIS IS FOR ACTIVATING BUYERS ACCOUNTS
		
		// Connect to Database
		include 'includes/database_connect.php';
		
		// Identify Table to be used
		$tablepbu = 'prop_buyer_users';
		
		$activateEmail = $_GET["actemail"];
		
		// Query to make sure number of rows = 1
		$sqlcheck = "SELECT * FROM $tablepbu WHERE email_address = '$activateEmail'";
		
		// Run The SQL Query
		$resultrun = mysqli_query($con, $sqlcheck);
		
		// If Error exists, print it out
		if (!$resultrun) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
		}
		
		// Count number of rows in database that have this email address
		$numrows = mysqli_num_rows($resultrun);
		
	// If number of rows with activation email = 1
			if ($numrows == 1) {

				// If Account email is set and Admin email is set
				if(isset($_GET["actemail"]) and isset($_GET["adminemail"])) {
				
					// If admin email = Jarretts Email or Christian email.
					if($_GET["adminemail"] == 'email@email.com' or $_GET["adminemail"] == 'email2@email.com' or $_GET["adminemail"] == 'email3@email.com') {

						// If Account Activated is Not = yes
						if($row['account_activated'] != 'yes'){

							// USE SQL "UPDATE" to make Account Activated = yes
							$sqlupdate = "UPDATE $tablepbu SET account_active='yes' WHERE email_address = '$activateEmail'";
							
							mysqli_query($con, $sqlupdate);
							
												// if SQL error, print it out
							if (!$sqlupdate) {
							printf("Error: %s\n", mysqli_error($con));
							exit();
							}
					 
							echo '<span class="note-green">Success! Account for ' . $_GET["actemail"] . ' is now active! (Affected rows: ' . mysqli_affected_rows($con) . ') </span>';
							echo '<br />';
							echo '<span class="note-green">An email has been sent to the user!</span>';
							
							include 'includes/account_activated_buyer_notify.php';
							
						}
						else {
							echo '<span class="note-red">Account for ' . $_GET["actemail"] . ' is already activated!</span>';
						}
					} else {
						echo '<span class="note-red">Sorry, you are not authorized to activate & deactivate accounts.</span>';
					}
					
				} else {
					echo '<span class="note-red">Invalid page - please visit the homepage or login!</span>';	
				}
				
			}
			else {
				
				if($numrows < 1) {
					echo '<span class="note-red">Sorry, this email does not exist in the system.</span>';
				}
				if($numrows > 1) {
					echo '<span class="note-red">There are duplicates of this email in the system which will create login problems!</span>';
				}
				
			}

		mysqli_close($con);




?>
			
		</div>

		<div class="section">
		
		
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>