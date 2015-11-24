<?php
		
		// Get Property ID
		$InquiryPropertyID = $_GET['propertyid'];
		
		// Get All Post Information (Message is only information that was posted)
		$InquiryMessage = $_POST['propinquirymessage'];
		
		// If Session Email Exists or Email Field was filled out.
		if (isset($_SESSION['email']) or isset($_POST['formemailaddress'])) {
			// If Session, Get Session Info
			if (isset($_SESSION['email'])) {
				
				$thisUserEmail = $_SESSION['email'];
							
				////////////////////////////////////////////		GET BUYER INFORMATION		/////////////////////////////////////////////////////////
				include 'database_connect.php';
				
				$buyerTable = "prop_buyer_users";

				$getBuyerDetails ="SELECT * FROM $buyerTable WHERE email_address = '$_SESSION[email]'";
				$runFindBuyers = mysqli_query($con, $getBuyerDetails);
				$countBuyers = mysqli_num_rows($runFindBuyers);
				
					//If Error Echo Error, Else Get Buyer Information

						while($rowb1 = mysqli_fetch_assoc($runFindBuyers)) {
						
							$this_Buyer_First_Name	=	$rowb1['user_first_name'];
							$this_Buyer_Last_Name	=	$rowb1['user_last_name'];
							$this_Buyer_Email		=	$_SESSION['email']; // EMAIL PULLS FROM SESSION
							$this_Buyer_Phone		=	$rowb1['phone_num'];
							$this_Buyer_Message		=	$_POST['propinquirymessage'];
							
						}
					mysqli_close($con);
					
				if (!$runFindBuyers) {
					printf("Error: %s\n", mysqli_error($con));
					exit();
				}
			} // END IF LOGGED-IN USER EMAIL EXISTS, (NO ELSE)
			if (isset($_POST['formemailaddress'])) {
				
				$this_Buyer_First_Name	=	ucwords(strtolower($_POST['formfirstname']));
				$this_Buyer_Last_Name	=	ucwords(strtolower($_POST['formlastname']));
				$this_Buyer_Email 		= 	$_POST['formemailaddress'];
				$this_Buyer_Phone		=	$_POST['formphone'];
				$this_Buyer_Message		=	$_POST['propinquirymessage'];

			} // END IF NON-LOGGED-IN USER EMAIL EXISTS
		}
		else {
				echo '<span class="note-red">Sorry, an email address was not submitted! Please try again.</span>';
		} // NO EMAIL WAS PROVIDED
		
		
		////////////////////////////////////////////		GET PROPERTY INFORMATION		////////////////////////////////////////////////
			
		include 'database_connect.php';
		
		$propertyTable = "prop_seller_listings";

		$getPropertyDetails ="SELECT * FROM $propertyTable WHERE seller_listing_id = '$InquiryPropertyID'";
		$runFindThisProp = mysqli_query($con, $getPropertyDetails);
		
			//If Error Echo Error, Else Get Buyer Information
			
				while($rowp2 = mysqli_fetch_assoc($runFindThisProp)) {
				
					$this_Property_street_num	=	$rowp2['property_street_number'];
					$this_Property_street_name	=	$rowp2['property_street_name'];
					$this_Property_city			=	$rowp2['property_city'];
					$this_Property_state		=	$rowp2['property_state'];
					$this_Property_type			=	$rowp2['property_type'];
					$this_Property_price		=	'$' . number_format($rowp2['price_for_sale']);
					
				}
				
		if (!$runFindThisProp) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
			
		}
				
				
	// Email Buyer & Property Information To Jarrett	
	$emailToJarrett = 'cpolleys@knlrealty.com';
	$subjectToJarrett = 'Property Inquiry on BostonPropertyBuyers.com';
	
	$headersToJarrett = 'From: ' . $this_Buyer_First_Name . ' ' . $this_Buyer_Last_Name . "\r\n";
	$headersToJarrett .= 'MIME-Version: 1.0' . "\r\n";
	$headersToJarrett .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$headersToJarrett .= 'Reply-To: ' . $thisUserEmail . "\r\n";
	$headersToJarrett .= 'X-Priority: 1\r\n';
	
	$messageToJarrett = '<html><body style="font-family: Tahoma, Verdana, sans-serif; color: #333333;">
						<h2 style="color: #1158cd;">
						<img src="http://bostonpropertybuyers.com/images/checkmark.png" border="0" align="absmiddle"/>
						 You Have A Property Inquiry On BostonPropertyBuyers.com:</h2>
						<br />
						<br />
						<strong>Buyer Name:</strong> ' . $this_Buyer_First_Name . ' ' . $this_Buyer_Last_Name . '
						<br />
						<strong>Buyer Phone:</strong> ' . $this_Buyer_Phone . '
						<br />
						<strong>Buyer Email:</strong> ' . $this_Buyer_Email . '
						<br />
						<strong>Buyer Message:</strong> ' . $this_Buyer_Message . '
						<br />
						<br />
						<strong>Buyer Is Interested In This Property: </strong>
						<br />
						<br />
						<strong>Property ID:</strong> ' . $InquiryPropertyID . '
						<br />
						<strong>Property Address:</strong> ' . $this_Property_street_num . ' ' . $this_Property_street_name . '
						<br />
						<strong>City, State:</strong> ' . $this_Property_city . ', ' . $this_Property_state . '
						<br />
						<strong>Property Type:</strong> ' . $this_Property_type . '
						<br />
						<strong>Price:</strong> ' . $this_Property_price . '
						<br />
						<br />
						Please <a href="http://bostonpropertybuyers.com/listing_details_page.php?propertyid=' . $InquiryPropertyID . '" target="_blank">CLICK HERE</a> to view this listing. 
						<br />
						<br />
						<img src="http://kunevichandlau.com/wp-content/uploads/2015/02/KunevichAndLau.png" border="0" />
						</body></html>';
	
			mail($emailToJarrett, $subjectToJarrett, $messageToJarrett, $headersToJarrett);
		
mysqli_close($con);
?>