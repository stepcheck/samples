<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
<title>Create An Account - Sign Up - Boston Property Buyers</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages.jpg" border="0" />
		</div>

		<div class="section1">

		
							<?php 
				// If Form was submitted from Submit_Buyers_Form_Code on home_buyers.php , then proceed.
				// Form on home_buyers named fvalidX3 as a precaution to prevent bots from guessing form name
				// Also acts as a unique identifier
	
		if (isset($_POST['fvalidX3'])) {	
			if ($_POST['catdog3'] ==='FRB') {
				// If Legal Checkbox was checked!
				if (isset($_POST['legalcheckbox'])) {
					// If Honeypot was NOT filled in
					if (empty($_POST['email']) || !isset($_POST['email'])) {
						// If email is an email address
						if ($_POST['emailaddress'] = filter_var($_POST['emailaddress'], FILTER_VALIDATE_EMAIL)) {
							// If hidden field with prefilled value stayed the same.
							if ($_POST['name'] === 'Po380lq') {
								
							///////////////////////// START BUYER SUBMIT FUNCTIONALITY ///////////////////////////////
					
							// 1. Find out if email exists in system.
							//Connect to database
								include 'includes/database_connect.php';
							// Select table in database
								$table = "prop_buyer_users";
							// Query to see if email address already exists.
								$questionExist = "SELECT * FROM $table WHERE email_address = '$_POST[emailaddress]'";
								$questionRun = mysqli_query($con, $questionExist);
			
							// Get number of Rows
								$qnumrows = mysqli_num_rows($questionRun);

							// 2. If Email Does Not Exist, put infomation in database & send emails
								if($qnumrows == 0) {
							// Include form processing script 
								include 'includes/submit_buyers_form_code.php'; //
							
								echo "<h1>Success!</h1>";
								echo '<span class="note-green">Thank you for submitting your information. We will review your account and send an email to <strong>' . $_POST[emailaddress] . ' </strong> shortly with a confirmation.</span>';
								echo "<p>As you know, our listings are private, so we qualify all buyers before granting them access.</p>";
							
								
								
							// 3. Else redirect to login page with error.
								} else {
							// If number of rows is > 0, it means an account already exists.
							
							// Redirect to login page.
							header("Location: http://bostonpropertybuyers.com/account_login_page.php?error=emailexists");
							die();

								
								}
								/////////////////////////////// END BUYER SUBMIT FUNCTIONALITY //////////////////////////////////////

							} // End hidden field with value
							else {
								echo '<span class="note-red">Are you a bot? Something fishy is going on. Please try again.</span>';
								echo '<br /><br />';
								echo '<span class="note-red">Sorry for the inconvenience.</span>';
							}
						} // End validate user input email
						else {
							echo '<span class="note-red">Sorry, your email address was not submitted properly.</span>';
						}
					} // End honeypot empty
					else {
						echo '<span class="note-red">Sorry, there was an error when you submitted the form!</span>';
					}
				}
				else {
					echo '<span class="note-red">Sorry, you need to accept the Terms Of Service to create an account!</span>';
				}
			} // End Captcha filled in correctly
			else {
				echo '<span class="note-red">Sorry, you did not fill out the form CAPTCHA correctly. </span>';
				echo '<br /><br />';
				echo '<span class="note-red">Please use ALL CAPITAL LETTERS.</span>';
			}
					
					
		} // End Form Submitted
		else {
		
		echo '<h1>Buyers - We Have Awesome Deals.</h1>';
		echo '<p>Are you looking for a property to buy and are tired of looking and competing for properties on mls or perhaps your agent hasn’t found you the right property. We specialize in helping connect qualified buyers directly to sellers, saving both the time and aggravation of trying to buy “on market” properties, we will send you properties only our buyers will know about. We work with a select group of buyers. </p>';
		
		}
			?>
		
			
		</div>

		<div class="section">
		<h2>Please Submit The Following Form:</h2>
		<span class="note-red">* </span> indicates required field.
		<br />
		<br />
			<form id="form1" name="form1" method="post" action="home_create_account.php">

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
				<td><span class="note-red">* </span>Email Address:</td>
				<td><input type="text" name="name" value="Po380lq" class="email"/><input type="text" name="emailaddress" /><input type="text" name="email" class="email"/></td>
			</tr>
			<tr>
				<td><span class="note-red">* </span>Phone Number:</td>
				<td><input type="text" name="buyerphone" /></td>
			</tr>
			<tr>
				<td>Property To Purchase:</td>
				<td>
					<select name="propertytype">
						<option value="Condo">Condo</option>
						<option value="Single Family">Single Family</option>
						<option value="Multi-Family">Multi-Family</option>
						<option value="Commercial">Commercial</option>
						<option value="Land">Land</option>
						<option value="Other">Other</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Budget:</td>
				<td>
					<select name="budget">
						<option value="$0-250K">$0-250K</option>
						<option value="$250-500K">$250-500K</option>
						<option value="$500K - $1M">$500K - $1M</option>
						<option value="$1M +">$1M+</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Transaction Method:</td>
				<td>
					<select name="transaction">
						<option value="Cash">Cash</option>
						<option value="Financing">Financing</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>How Soon Are You Ready To Purchase Property?</td>
				<td>
					<select name="turnaroundtime">
						<option value="Immediately">Immediately</option>
						<option value="1-3 Months">1-3 Months</option>
						<option value="3-6 Months">3-6 Months</option>
						<option value="6-12 Months">6-12 Months</option>
						<option value="12+ Months">12+ Months</option>
					</select>
				</td>
			</tr>
			<tr>
				<td colspan="2">More Details:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="moredetails" rows="10" cols="75"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><span class="note-red">* </span><input type="checkbox" name="legalcheckbox" value="<?php echo date("F j, Y, g:i a") ?>" /> 
				I agree to the <a href="home_legal_stuff.php" target="_blank">Terms of Service</a>.</td>
			</tr>
			<tr>
				<td colspan="2"><span class="note-red">* </span><img src="images/catdog3.jpg" border="0" align="absmiddle" /> <input type="text" name="catdog3" maxlength="4" size="4"/> What's in the image on the left? (Spam Protection)</td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="fvalidX3" value="Submit My Info >>" /></td>
			</tr>
				</tbody>
			</table>
</form> <!-- END BUYERS FORM-->
			
			<p>After submitting your information, we will review your information and send you an email.
			It's important that you don't lose the emails you recieve or share them with a third party.</p>
			
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>