<?php

// This the Activate/Deactivate Page - For All things that need to be deleted.
// If green or grey Active? button was clicked by user, this code will run.
// Pafe that runs this code is found on admin_dashboard.php
// Developed by Christian Polleys

//	Toggle Activate or Deactivate Listing Listing
	

		if (isset($_GET['propertyid']) and isset($_GET['activetoggle']) and isset($_GET['session_email'])) {
		
			if($_GET['activetoggle'] == 'yes' || $_GET['activetoggle'] == 'no') {
		
				if ($_GET['session_email'] == 'jlau@knlrealty.com' || $_GET['session_email'] == 'chrispmv@gmail.com' || $_GET['session_email'] == 'cpolleys@knlrealty.com') {
				
					if ($_SESSION['administrator'] == 'administrator') { 
						
						// If All Is Good, Connect to Database
						include 'includes/database_connect.php';
						$listingstable = "prop_seller_listings";
						
						// If active toggle is yes, make it no
						if ($_GET['activetoggle'] == 'yes') {
						
							$makeInactive = "UPDATE $listingstable SET listing_active='no' WHERE seller_listing_id='$_GET[propertyid]' ";
							mysqli_query($con, $makeInactive);
							
							if(mysqli_affected_rows($con) > 0) {
								echo '<span class="note-green">Note: A property was made INACTIVE.</span>';
							}
							else {
								echo '<span class="note-red">Note: There was a problem making a listing INACTIVE.</span>';
								echo '<span class="note-red">You may need to login again.</span>';
							}
						}	
						
						// If active toggle is no, make it yes
						if ($_GET['activetoggle'] == 'no') {
							
							$makeActive = "UPDATE $listingstable SET listing_active='yes' WHERE seller_listing_id='$_GET[propertyid]' ";
							mysqli_query($con, $makeActive);
								
							if(mysqli_affected_rows($con) > 0) {
								echo '<span class="note-green">Note: A property was made ACTIVE.</span>';
							}
							else {
								echo '<span class="note-red">Note: There was a problem making a listing ACTIVE.</span>';
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