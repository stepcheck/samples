<?php

// THIS IS FOR THE BUYERS FORM ON THE BUYERS PAGE submitted from home_buyers.php

// Email Password to Buyers

	$emailToBuyer = $_POST[email];
	$subjectToBuyer = 'Password Request Recieved';
	$headersToBuyer = 'MIME-Version: 1.0' . "\r\n";
	$headersToBuyer .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headersToBuyer .= 'From: BostonPropertyBuyers.com' . "\r\n" .
   'Reply-To: ' . 'jlau@knlrealty.com' . "\r\n";
	$headersToBuyer .= "X-Priority: 1\r\n";
	
	$messageToBuyer = '<html><body style="font-family: Tahoma, Verdana, sans-serif; color: #333333;">
						<h2 style="color: #1158cd;"><img src="http://bostonpropertybuyers.com/images/checkmark.png" border="0" align="absmiddle"/>
						We recently received a password request on your account.</h2>
						<br />
						The password request was for: ' . $_POST[email] . '.' . '
						<br />
						<br />
						<h2>Please keep this information private</h2>
						<br />
						<br />
						Your password is <strong>' . $password . '</strong>
						<br />
						<br />
						For your security, you may wish to change your password. You can change your password by logging in visiting your account settings. We suggest changing your password often to prevent any security breaches. 
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