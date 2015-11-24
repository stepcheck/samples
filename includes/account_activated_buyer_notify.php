<?php

// THIS IS TO NOTIFY BUYERS THAT THEIR ACCOUNT HAS BEEN ACTIVATED
// PROCESSED ON account_activation.php and activate_deactivate_buyer_account.php (pulls from admin_dashboard.php)

// 1. Get Variables

	// $_GET['buyerid'] is provided on admin_dashboard.php
	// 
	if (isset($activateEmail) or isset($_GET['buyerid'])) {
	
		if(isset($activateEmail)) {
			$buyerEmail = $activateEmail;
		} //END if Buyer ID is set from account_activation.php
		
		
		if (isset($_GET['buyerid'])) {
			
			$buyerID = $_GET[buyerid];
			
			$getBuyerEmailFromIDSQL = "SELECT * FROM $usersTable WHERE user_id = '$buyerID'";
			
			$fetch = mysqli_query($con, $getBuyerEmailFromIDSQL);
			
			$rowBE = mysqli_fetch_assoc($fetch);
			
			$buyerEmail = $rowBE['email_address'];
				
		} // END if Buyer ID is set from admin_dashboard.php
	

		// Email Message to Buyers

		$emailToBuyer = $buyerEmail;
		$subjectToBuyer = 'Account Activated On BostonPropertyBuyers.com';
		$headersToBuyer = 'MIME-Version: 1.0' . "\r\n";
		$headersToBuyer .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headersToBuyer .= 'From: BostonPropertyBuyers.com' . "\r\n" .
	   'Reply-To: ' . 'jlau@knlrealty.com' . "\r\n";
		$headersToBuyer .= "X-Priority: 1\r\n";
		
		$messageToBuyer = '<html><body style="font-family: Tahoma, Verdana, sans-serif; color: #333333;">
							<h2 style="color: #1158cd;"><img src="http://bostonpropertybuyers.com/images/checkmark.png" border="0" align="absmiddle"/>
							 ' . $buyerEmail . ', your account has been activated on BostonPropertyBuyers.com!</h2>
							<br />
							The default password for new accounts is: <strong>password123</strong>
							<br />
							<br />
							We recommend changing your password immediately after login on the Account Settings page.
							<br />
							<h2>If you have an troubles logging in, you can:</h2>
							- <a href="http://bostonpropertybuyers.com/password_reset_page.php">Request that your password be emailed to you</a>,
							<br />
							- <a href="http://bostonpropertybuyers.com/home_contact_us.php">Contact us using the form on our website</a>,
							<br />
							- or Email Jarrett for help at jlau@knlrealty.com
							<br />
							<br />
							Thank you,
							- BostonPropertyBuyers.com - by Kunevich & Lau
							<br />
							<img src="http://kunevichandlau.com/wp-content/uploads/2015/02/KunevichAndLau.png" border="0" />
							</body></html>';

				mail($emailToBuyer, $subjectToBuyer, $messageToBuyer, $headersToBuyer);

	} // End If User account variable is provided
?>