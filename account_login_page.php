<?php session_start(); ?>

<?php include 'includes/header1.php'; ?>
<title>Account Login - Boston Property Buyers</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages3.jpg" border="0" />
		</div>

		<div class="section1">
		
		<?php
		
		if (isset($_GET['error'])) {
			echo '<h1>Sorry, this account already exists.</h1>';
			echo '<span class="note-red">The email address you submitted already exists in our system. </span>';
			echo '<br /><br />';
			echo '<span class="note-red">Please login or reset your password.</span>';
		}
		else {
			echo '<h1>Buyer Login & Password Reset</h1>';
		}
		
		?>
			

			
		<h2>Please Login:</h2>
		
		<?php
		
		include 'includes/login_form_nomad_large.php';
		
		?>
		
		</div>

		<div class="section">
		
	<h2>Once Logged In, You Can:</h2>
	
	- Search Our Private Database
	<br />
	- Change Your Account Settings
	<br />
	- Request Info About Our Listings
		
		
		
		</div>

		<div class="section">
		<p>Please note: our listing database is 100% private and exclusive. We do not allow non-registered users to access our private database. Additionally, per our user agreement, we do not authorize registered users and active account holders to share our listing information with third parties. Please respect our user-agreement and keep this information private. Thank you.</p>
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>