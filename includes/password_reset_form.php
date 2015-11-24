
<div class="password-reset-form">
	<form id="form1" name="form1" method="post" action="password_reset_page.php">
  
		<label for="textfield">Email Address:</label>
		<input type="text" name="email" id="textfield" required="required" />
		<?php echo '<input type="text" name="emailaddress" class="email"/>'; // Honeypot, don't change?>
		<input type="submit" name="pvalidX2" id="login" value="Email Me My Password >>" />

	</form>
</div>