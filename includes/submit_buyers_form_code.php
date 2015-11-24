<?php

// THIS IS FOR THE BUYERS FORM ON THE BUYERS PAGE submitted from home_buyers.php
// PROCESSED ON account_login_page.php

$sql="INSERT INTO $table (
					user_first_name,
					user_last_name, 
					email_address, 
					phone_num, 
					buyer_property_type, 
					buyer_budget,
					transaction_method,
					how_quickly_buy,
					more_details,
					tos_signup_date)
				VALUES (
					'$_POST[firstname]', 
					'$_POST[lastname]', 
					'$_POST[emailaddress]', 
					'$_POST[buyerphone]', 
					'$_POST[propertytype]', 
					'$_POST[budget]', 
					'$_POST[transaction]', 
					'$_POST[turnaroundtime]', 
					'$_POST[moredetails]',  
					'$_POST[legalcheckbox]'
					)";

// Submit information into database

	mysqli_query($con, $sql);
	
// Close database connection

	$con->close();
	
// Email Buyers data to Jarrett

	$emailToJarrett = 'jlau@knlrealty.com';
	$subjectToJarrett = 'New Buyer Signup on BostonPropertyBuyers.com';
	
	$headersToJarrett = 'From: ' . $_POST[firstname] . ' ' . $_POST[lastname] . "\r\n";
	$headersToJarrett .= 'MIME-Version: 1.0' . "\r\n";
	$headersToJarrett .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$headersToJarrett .= 'Reply-To: ' . $_POST[emailaddress] . "\r\n";
	$headersToJarrett .= 'X-Priority: 1\r\n';
	
	$messageToJarrett = '<html><body style="font-family: Tahoma, Verdana, sans-serif; color: #333333;">
						<h2 style="color: #1158cd;">
						<img src="http://bostonpropertybuyers.com/images/checkmark.png" border="0" align="absmiddle"/>
						 You Have A New Signup on BostonPropertyBuyers.com:</h2>
						<br />
						<br />
						<strong>Name:</strong> ' . $_POST[firstname] . ' ' . $_POST[lastname] . '
						<br />
						<strong>Email:</strong> ' . $_POST[emailaddress] . '
						<br />
						<strong>Phone:</strong> ' . $_POST[buyerphone] . '
						<br />
						<strong>Property Type:</strong> ' . $_POST[propertytype] . '
						<br />
						<strong>Budget:</strong> ' . $_POST[budget] . '
						<br />
						<strong>Transaction:</strong> ' . $_POST[transaction] . '
						<br />
						<strong>Desired Buying Time:</strong> ' . $_POST[turnaroundtime] . '
						<br />
						<strong>Buyer Notes:</strong> ' . $_POST[moredetails] . '
						<br />
						<br />
						<a href="http://bostonpropertybuyers.com/account_activation.php?actemail=' . $_POST[emailaddress] . '&adminemail=jlau@knlrealty.com" target="_blank" >
						CLICK HERE TO ACTIVATE THIS BUYER ACCOUNT NOW
						</a>
						<br />
						<br />
						OR you can <a href="http://bostonpropertybuyers.com" target="_blank">LOGIN</a> to view/activate this account. 
						<br />
						<br />
						<img src="http://kunevichandlau.com/wp-content/uploads/2015/02/KunevichAndLau.png" border="0" />
						</body></html>';
	
			mail($emailToJarrett, $subjectToJarrett, $messageToJarrett, $headersToJarrett);

// Email Message to Buyers

	$emailToBuyer = $_POST[emailaddress];
	$subjectToBuyer = 'Thanks For Joining BostonPropertyBuyers.com';
	$headersToBuyer = 'MIME-Version: 1.0' . "\r\n";
	$headersToBuyer .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headersToBuyer .= 'From: BostonPropertyBuyers.com' . "\r\n" .
   'Reply-To: ' . 'jlau@knlrealty.com' . "\r\n";
	$headersToBuyer .= "X-Priority: 1\r\n";
	
	$messageToBuyer = '<html><body style="font-family: Tahoma, Verdana, sans-serif; color: #333333;">
						<h2 style="color: #1158cd;"><img src="http://bostonpropertybuyers.com/images/checkmark.png" border="0" align="absmiddle"/>
						 ' . $_POST[firstname] . ', thank you for signing up with BostonPropertyBuyers.com!</h2>
						<br />
						We will grant you further login access to our website once we review your account
						information. We will send an email to: ' . $_POST[emailaddress] . '.' . '
						<br />
						<h2>What Makes Us Great:</h2>
						<br />
						<img src="http://bostonpropertybuyers.com/images/small-checkmark.png" border="0" align="absmiddle"/>
						 Off Market Property Listings
						<br />
						<img src="http://bostonpropertybuyers.com/images/small-checkmark.png" border="0" align="absmiddle"/>
						 Exclusive Listings Only Found Through Us
						<br />
						<img src="http://bostonpropertybuyers.com/images/small-checkmark.png" border="0" align="absmiddle"/>
						 Industry Knowledge & Experience
						<br />
						<img src="http://bostonpropertybuyers.com//images/small-checkmark.png" border="0" align="absmiddle"/>
						 Real Estate, Management & Insurance Services
						<br />
						<img src="http://bostonpropertybuyers.com/images/small-checkmark.png" border="0" align="absmiddle"/>
						 Consulting From Our Seasoned Team
						<br />
						<br />
						Thank you,
						<br />
						<br />
						BostonPropertyBuyers.com - by Kunevich & Lau
						<br />
						<img src="http://kunevichandlau.com/wp-content/uploads/2015/02/KunevichAndLau.png" border="0" />
						</body></html>';

			mail($emailToBuyer, $subjectToBuyer, $messageToBuyer, $headersToBuyer);

?>