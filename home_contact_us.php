<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
<title>Contact Us - Boston Property Buyers</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Contact Boston Property Buyers</h1>
			
			
			
<?php

// THIS IS A SUPER SECURE CONTACT FORM WITH 5 VALIDATIONS.

	// form submitted
	if (isset($_POST['Q0f43bj8'])) {
		// If user filled out captcha correctly
		if ($_POST['catdog'] ==='54H') {
			// If Honeypot was not filled in
			if (empty($_POST['email']) || !isset($_POST['email'])) {
				// If email is an email address
				if ($_POST['emailaddress'] = filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)) {
					if ($_POST['name'] === '5Qname') {
					
	$emailToJarrett = 'jlau@knlrealty.com';
	$subjectToJarrett = 'New Message From BostonPropertyBuyers.com';
	
	$headersToJarrett = 'From: ' . $_POST[firstname] . ' ' . $_POST[lastname] . "\r\n";
	$headersToJarrett .= 'MIME-Version: 1.0' . "\r\n";
	$headersToJarrett .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	$headersToJarrett .= 'Reply-To: ' . $_POST[emailaddress] . "\r\n";
	$headersToJarrett .= 'X-Priority: 1\r\n';
	
	$messageToJarrett = '<html><body style="font-family: Tahoma, Verdana, sans-serif; color: #333333;">
						<h2 style="color: #1158cd;">
						<img src="http://bostonpropertybuyers.com/images/checkmark.png" border="0" align="absmiddle"/>
						 You Received A New Message From BostonPropertyBuyers.com:</h2>
						<br />
						<br />
						<strong>Name:</strong> ' . $_POST[firstname] . ' ' . $_POST[lastname] . ' <br />
						<strong>Email:</strong> ' . $_POST[emailaddress] . '<br />
						<strong>Phone:</strong> ' . $_POST[phone] . '<br />
						<strong>Property Type:</strong> ' . $_POST[purpose] . '<br />
						<strong>Message:</strong> ' . $_POST[generalmessage] . '
						<br />
						<br />
						Visit <a href="http://bostonpropertybuyers.com" target="_blank">BostonPropertyBuyers.com</a> if you need to.
						<br />
						<br />
						<img src="http://kunevichandlau.com/wp-content/uploads/2015/02/KunevichAndLau.png" border="0" />
						</body></html>';
	
					mail($emailToJarrett, $subjectToJarrett, $messageToJarrett, $headersToJarrett);
					
					mail();
					
					echo '<span class="note-green">Thank you for your email!</span>';
					
					} // End Hidden Field Contains Number
					else {
						echo '<span class="note-red">Are you a bot? Something fishy is going on. Please try again.</span>';
						echo '<br /><br />';
						echo '<span class="note-red">Sorry for the inconvenience.</span>';
					}
				} // End Validate User Email
				else {
					echo '<span class="note-red">Sorry, your email address was not submitted properly.</span>';
				}
			} // End Honeypot
			else {
				echo '<span class="note-red">Sorry, there was an error when you submitted the form!</span>';
			}
		} // End User Image Captcha
		else {
			echo '<span class="note-red">Sorry, you did not fill out the form CAPTCHA correctly.</span>';
			echo '<br /><br />';
			echo '<span class="note-red">Please type the numbers and letters.</span>';
		}
	} // End if Form was submitted



?>

			<p>Have a question? We'll contact you within 24 hours! </p>
			<h2>Please Fill Out The Form Below:</h2>
			<span class="note-red">* </span> indicates required field.
		</div>

		<div class="section">
		
		
		<!-- GOOGLE MAP - DON'T NEED YET
		<div class="toolbar-on-right">
			<div class="mapiframe">
				<iframe src="https://www.google.com/maps/d/embed?mid=zw-JipIVOafU.k29tSVlx9ivU" frameborder="0"></iframe>
			</div>
			
		</div>
		-->
		
<form id="form1" name="form1" method="post" action="home_contact_us.php">

	<table border="0" cellpadding="6" cellspacing="2" style="width: 600px;">
		<tbody>
			<tr>
				<td><span class="note-red">* </span>First Name:</td>
				<td><input type="text" name="firstname" /></td>
			</tr>
			<tr>
				<td><span class="note-red">* </span>Last Name:</td>
				<td><input type="text" name="lastname" /></td>
			</tr>
			<tr>
				<td>Phone:</td>
				<td><input type="text" name="phone" /></td>
			</tr>
			<tr>
				<td><span class="note-red">* </span>Email Address:</td>
				<td><input type="text" name="name" value="5Qname" class="email"/><input type="text" name="emailaddress" /><input type="text" name="email" class="email"/></td>
			</tr>

			<tr>
				<td>Topic:</td>
				<td>
					<select name="purpose">
						<option value="Seller Questions">Seller Questions</option>
						<option value="Buyer Questions">Buyer Questions</option>
						<option value="Career Inquiry">Career Inquiry</option>
						<option value="Other Divisions">Other Divisions</option>
						<option value="General Inquiry">General Inquiry</option>
					</select>
				</td>
			</tr>
			

			<tr>
				<td colspan="2"><span class="note-red">* </span>Message:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="generalmessage" rows="12" cols="75"></textarea></td>
			</tr>
			<td colspan="2"><span class="note-red">* </span><img src="images/catdog.jpg" border="0" align="absmiddle" /> <input type="text" name="catdog" maxlength="4" size="4"/> What's in the image on the left? (Spam Protection)</td>
			<tr>
				<td colspan="2"><input type="submit" name="Q0f43bj8" value="Send Message >>" /></td>
			</tr>
				</tbody>
			</table>
</form>


	
			
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>