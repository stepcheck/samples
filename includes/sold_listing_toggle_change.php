<?php

// This the Activate/Deactivate Page - For All things that need to be deleted.
// If green or grey Active? button was clicked by user, this code will run.
// Pafe that runs this code is found on admin_dashboard.php
// Developed by Christian Polleys

//	Toggle Featured Listing
	

		if (isset($_GET['propertyid']) and isset($_GET['soldtoggle']) and isset($_GET['session_email'])) {
		
			if($_GET['soldtoggle'] == 'yes' || $_GET['soldtoggle'] == 'no') {
		
				if ($_GET['session_email'] == 'jlau@knlrealty.com' || $_GET['session_email'] == 'chrispmv@gmail.com' || $_GET['session_email'] == 'cpolleys@knlrealty.com') {
				
					if ($_SESSION['administrator'] == 'administrator') { 
						
						// If All Is Good, Connect to Database
						include 'includes/database_connect.php';
						$listingstable = "prop_seller_listings";
						
						// If active toggle is yes, make it no
						if ($_GET['soldtoggle'] == 'yes') {
						
							$makeNotFeatured = "UPDATE $listingstable SET mark_as_sold='no' WHERE seller_listing_id='$_GET[propertyid]' ";
							mysqli_query($con, $makeNotFeatured);
							
							if(mysqli_affected_rows($con) > 0) {
								echo '<span class="note-green">Note: A Sold property was made NOT Sold.</span>';
							}
							else {
								echo '<span class="note-red">Note: There was a problem making a listing NOT Sold.</span>';
								echo '<span class="note-red">You may need to login again.</span>';
							}
						}	
						
						// If active toggle is no, make it yes
						if ($_GET['soldtoggle'] == 'no') {
							
							$makeFeatured = "UPDATE $listingstable SET mark_as_sold='yes' WHERE seller_listing_id='$_GET[propertyid]' ";
							mysqli_query($con, $makeFeatured);
								
							if(mysqli_affected_rows($con) > 0) {
								echo '<span class="note-green">Note: A property was made SOLD.</span>';
							}
							else {
								echo '<span class="note-red">Note: There was a problem making a listing SOLD.</span>';
								echo '<span class="note-red">You may need to login again.</span>';
							}
						}
						
						mysqli_close($con);
			
					} // Close Check Session Administrator
					else {
						echo "Sorry, you are not listed as an authorized administrator to make this listing sold. (Error Admin 103)";
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