<?php

// This the Activate/Deactivate Page - For All things that need to be deleted.
// If green or grey Active? button was clicked by user, this code will run.
// Pafe that runs this code is found on admin_dashboard.php
// Developed by Christian Polleys

//	Toggle Activate or Deactivate Listing Listing
	

		if (isset($_GET['buyerid']) and isset($_GET['buyeractivetoggle']) and isset($_GET['session_email'])) {
		
			if($_GET['buyeractivetoggle'] == 'yes' || $_GET['buyeractivetoggle'] == 'no') {
		
				if ($_GET['session_email'] == 'jlau@knlrealty.com' || $_GET['session_email'] == 'chrispmv@gmail.com' || $_GET['session_email'] == 'cpolleys@knlrealty.com') {
				
					if ($_SESSION['administrator'] == 'administrator') { 
						
						// If All Is Good, Connect to Database
						include 'includes/database_connect.php';
						$usersTable = "prop_buyer_users";
						
						// If active toggle is yes, make it no
						if ($_GET['buyeractivetoggle'] == 'yes') {
						
							$makeInactive = "UPDATE $usersTable SET account_active='no' WHERE user_id='$_GET[buyerid]' ";
							mysqli_query($con, $makeInactive);
							
							if(mysqli_affected_rows($con) > 0) {
								echo '<span class="note-green">Note: A Buyer was made INACTIVE.</span>';
							}
							else {
								echo '<span class="note-red">Note: There was a problem making a Buyer INACTIVE.</span>';
								echo '<span class="note-red">You may need to login again.</span>';
							}
						}	
						
						// If active toggle is no, make it yes
						if ($_GET['buyeractivetoggle'] == 'no') {
							
							$makeActive = "UPDATE $usersTable SET account_active='yes' WHERE user_id='$_GET[buyerid]' ";
							mysqli_query($con, $makeActive);
								
							if(mysqli_affected_rows($con) > 0) {
								echo '<span class="note-green">Note: A Buyer was made ACTIVE. </span>';
								echo '<span class="note-green">An email notification was sent to them!</span>';
								
								include 'includes/account_activated_buyer_notify.php';
							}
							else {
								echo '<span class="note-red">Note: There was a problem making a Buyer ACTIVE.</span>';
								echo '<span class="note-red">You may need to login again.</span>';
							}
						}
						
						mysqli_close($con);
			
					} // Close Check Session Administrator
					else {
						echo "Sorry, you are not listed as an authorized administrator to delete this listing. (Error Admin 103)";
					}
				} // Close Email is Administrator Email
				else {
					echo "Sorry, your email is not set to administrator. (Error Admin 105)";
				}
			} // Close ALL abilities
			else {
				echo "Sorry, Activate Toggle has a bug - could be null.";
			}
		}
?>