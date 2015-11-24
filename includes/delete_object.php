<?php

// This the Delete Page - For All things that need to be deleted.
// If something was clicked "DELETE" by user, this code will run.
// This code ONLY needs to be included on pages where DELETE functionality exists.
// Examples are admin_dashboard.php and admin_add_images_listing_page.php
// Developed by Christian Polleys

		//////////////////////////////////	THIS IS TO DELETE A PROPERTY LISTING		//////////////////////////////////////////////

		if (isset($_GET['propertyid']) and isset($_GET['deleteprop']) and isset($_GET['ses_email'])) {
		
			if($_GET['deleteprop'] == 'yes') {
		
				if ($_GET['ses_email'] == 'jlau@knlrealty.com' || $_GET['ses_email'] == 'chrispmv@gmail.com' || $_GET['ses_email'] == 'cpolleys@knlrealty.com') {
				
					if ($_SESSION['administrator'] == 'administrator') { 
						
						include 'includes/database_connect.php';
						
						$listingstable = "prop_seller_listings";
						$deletesql = "DELETE FROM $listingstable WHERE seller_listing_id = '$_GET[propertyid]'";
						$rundelete = mysqli_query($con, $deletesql);
						
						if(mysqli_affected_rows($con) > 0) {
							echo '<span class="note-green">Note: A property was successfully deleted.</span>';
							
							mysqli_close($con);
						}
						else {
							echo '<span class="note-red">Warning: There was an issue deleting a property.</span>';
							
							mysqli_close($con);
						}
			
					} // Close Session = Email
					else {
						echo '<span class="note-red">Sorry, you are not listed as an authorized administrator to delete this listing. (Error Admin 103)</span>';
					}
				} // Close Get Delete = yes
				else {
					echo '<span class="note-red">Sorry, your email is not set to administrator. (Error Admin 105)</span>';
				}
			} // Close ALL abilities
			else {
				echo '<span class="note-red">Sorry, delete functionality has a bug.</span>';
			}
		}
		
	//////////////////////////////////////		THIS IS TO DELETE A FILE	//////////////////////////////////
	
	
	
	if (isset($_GET['deletefile']) and isset($_GET['fileid']) and isset($_GET['propertyid'])) {
		// If Administrator
		if ($_SESSION['administrator'] == 'administrator') {
			
			//////////		FIRST, DELETE PHYSICAL FILE		/////////////
			
			// Set Variables
			$getDeleteFile = $_GET['deletefile'];
			$getFileID = $_GET['fileid'];
			$getPropID = $_GET['propertyid'];
			
			include 'includes/database_connect.php';
			
			$listingstable = "prop_seller_listings";
			$filesTable = "user_file_uploads";
			
			// Get Path To File
			$findFileLocation ="SELECT upload_path FROM $listingstable WHERE seller_listing_id = '$getPropID'";
			$findFL = mysqli_query($con, $findFileLocation);
			$row = mysqli_fetch_assoc($findFL);
			$fileDirectory = $row['upload_path'];
			
			// Get File Name
			$findFileName ="SELECT file_name FROM $filesTable WHERE file_id = '$getFileID'";
			$findFN = mysqli_query($con, $findFileName);
			$row2 = mysqli_fetch_assoc($findFN);
			$fileName = $row2['file_name'];
			
			// Create Entire Path To File & Name
			$entireFilePath = $fileDirectory . "/" . $fileName;
			
			if (isset($_GET['filetype']) && $_GET['filetype'] == 'embed') {
				// If File is Embed, Do Nothing (Don't try to unlink because there is no file!)
			}
			else {
			
				// DELETE FILE, IF FILE EXISTS AFTER DELETE POST ERROR
				unlink($entireFilePath);
				if (file_exists($entireFilePath)) {
				echo '<span class="note-red">Physical file not deleted. </span>';
				}	
			
			}
			
			
			
			//////////		NEXT, DELETE IN DATABASE		/////////////
			
			$deleteFileSQL = "DELETE FROM $filesTable WHERE file_id = '$getFileID'";
			mysqli_query($con, $deleteFileSQL);
						
			if(mysqli_affected_rows($con) > 0) {
				echo '<span class="note-green">Note: A database file row was successfully deleted.</span>';
				mysqli_close($con);
			}
			else {
				echo '<span class="note-red">Warning: There was an issue deleting a file.</span>';
				mysqli_close($con);
			}
			
		
		} // End Session = Administrator
		else {
			echo '<span class="note-red">Sorry, only administrators can delete files.</span>';
			echo '<br /><br />';
			echo '<span class="note-red">If you are an administrator, you may need to login again.</span>';
		}
	}
	
	/////////////////////////////////////////		THIS IS TO DELETE A BUYER	////////////////////////////////////////
	
	if (isset($_GET['buyerid']) and isset($_GET['deletebuyer']) and isset($_GET['ses_email'])) {
		
			if($_GET['deletebuyer'] == 'yes') {
		
				if ($_GET['ses_email'] == 'jlau@knlrealty.com' || $_GET['ses_email'] == 'chrispmv@gmail.com' || $_GET['ses_email'] == 'cpolleys@knlrealty.com') {
				
					if ($_SESSION['administrator'] == 'administrator') { 
						
						include 'includes/database_connect.php';
						
						$buyerstable = "prop_buyer_users";
						$deletesql = "DELETE FROM $buyerstable WHERE user_id = '$_GET[buyerid]'";
						$rundelete = mysqli_query($con, $deletesql);
						
						if(mysqli_affected_rows($con) > 0) {
							echo '<span class="note-green">Note: A buyer was successfully deleted.</span>';
							
							mysqli_close($con);
						}
						else {
							echo '<span class="note-red">Warning: There was an issue deleting a buyer.</span>';
							
							mysqli_close($con);
						}
			
					} // Close Session = Email
					else {
						echo '<span class="note-red">Sorry, you are not listed as an authorized administrator to delete this buyer. (Error Admin 208)</span>';
					}
				} // Close Get Delete = yes
				else {
					echo '<span class="note-red">Sorry, your email is not set to administrator. (Error Admin 209)</span>';
				}
			} // Close ALL abilities
			else {
				echo '<span class="note-red">Sorry, delete functionality has a bug.</span>';
			}
	}
	
	
	

?>