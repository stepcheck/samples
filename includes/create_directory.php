<?php
			/* CREATE NEW DIRECTORY */
			
			$propSubmitStreetNumb	= 	$_POST[propertystreetnumber];
			$propSubmitStreetNumb	=	str_replace('#', '', $propSubmitStreetNumb);
			
			$propSubmitStreetName 	= 	$_POST[propertystreetname];
			$propSubmitStreetName	=	str_replace('#', '', $propSubmitStreetName);
			
			$table= "prop_seller_listings";
			
			$getThisID = mysqli_insert_id($con);
			
			// Create Name of New Directory
			$directoryname = "user_uploads/" . $propSubmitStreetNumb . $propSubmitStreetName . "_" . $getThisID;
			
			// Remove all whitespace (ensure 
			$directoryname = str_replace(' ','',$directoryname);
			
			if(!file_exists($directoryname) && !is_dir($directoryname)) {
			
				mkdir($directoryname);
				
				$AddDirectorySQL = "UPDATE $table SET upload_path = '$directoryname' WHERE seller_listing_id = '$getThisID' ";
				
				mysqli_query($con, $AddDirectorySQL);
			
			}
			
			
?>