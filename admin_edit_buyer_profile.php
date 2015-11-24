<?php 	session_start(); 
		//If Session is not equal to administrator
		if($_SESSION['administrator'] != 'administrator') {
			header('Location: http://bostonpropertybuyers.com/user_dashboard_buyer.php');
			exit;
		}
?>
<?php include 'includes/header1.php'; ?>
<title>Edit Buyer Profile - Boston Property Buyers</title>
<meta name="robots" content="noindex">
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages3.jpg" border="0" />
		</div>
		
			<div class="section1">
			<h1>Welcome, <?php echo $_SESSION['email']; ?>!</h1>
<?php
	/////////////////////////////		FORM SUBMISSION PROCESSING		//////////////////////////////////////////////
	
	if (isset($_POST['h40sFdwONmnM'])) {
		if (empty($_POST['email']) || !isset($_POST['email'])) {
			if (isset($_GET['buyerid'])) {
			
				if ($_SESSION['administrator'] == 'administrator') {
					if (isset($_POST['1password']) == isset($_POST['2password'])) {
						
						
						include 'includes/database_connect.php';
						$table = 'prop_buyer_users';
						
						$thisUserhidden_Password = $_POST['1password'];
						
						$updateSQL = "UPDATE $table SET 
										phone_num 				=	'$_POST[buyerphone]', 
										login_password 			=	'$thisUserhidden_Password', 
										user_first_name			=	'$_POST[firstname]', 
										user_last_name	 		=	'$_POST[lastname]', 
										buyer_property_type 	=	'$_POST[propertytype]', 
										buyer_budget 			=	'$_POST[budget]', 
										transaction_method 		=	'$_POST[transaction]', 
										how_quickly_buy 		=	'$_POST[turnaroundtime]', 
										more_details 			=	'$_POST[moredetails]' 
					
								WHERE user_id = '$_GET[buyerid]'";
						
						mysqli_query($con, $updateSQL);
						
						mysqli_close($con);

		
						echo '<span class="note-green">Success! Your information has been updated!</span>';
					}
					else {
						echo '<span class="note-red">The passwords you submitted are not identical. Please resubmit them both.</span>';
					}
				}
				else {
					echo '<span class="note-red">Sorry, you either need to relogin, OR you account settings need to be reset to administrator access.</span>';
				}
			}
			else {
			echo '<span class="note-red">Sorry, no buyer account has been selected to update this page.</span>';
			}
		}
		else {
			echo '<span class="note-red">Sorry, there was a problem with your form submission.</span>';
		}
	}
			
?>	

		<?php
		
		////////////////////////////////		LOAD PAGE WITH THIS SESSION INFO		//////////////////////////////////////////
		
		// Make sure session is == administrator
		if ($_SESSION['administrator'] == 'administrator') {
			
			if (isset($_GET['buyerid'])) {
	
				$table = 'prop_buyer_users';
			
				include 'includes/database_connect.php';
			
				$query = "SELECT * FROM $table WHERE user_id = '$_GET[buyerid]'";

				$result = mysqli_query($con, $query);
	 
				while($row = mysqli_fetch_assoc($result)) {

					$this_buyer_id				=	$row['user_id'];
					$this_buyer_first_name 		= 	$row['user_first_name'];
					$this_buyer_last_name 		= 	$row['user_last_name'];
					$this_buyer_phone 			= 	$row['phone_num'];
					$this_user_password			=	$row['login_password'];
					$this_buyer_email 			= 	$row['email_address'];
					$this_buyer_prop_type 		= 	$row['buyer_property_type'];
					$this_buyer_budget 			= 	$row['buyer_budget'];
					$this_buyer_buy_method 		= 	$row['transaction_method'];
					$this_buyer_timeframe 		= 	$row['how_quickly_buy'];
					$this_buyer_more_details 	= 	$row['more_details'];
					$this_buyer_tos_timestamp	= 	$row['tos_signup_date'];
				}

				// If error exists, print it out bitch
				if (!$result) {
				printf("Error: %s\n", mysqli_error($con));
				exit();
				}
			
				// Close connection
				mysqli_close($con);
			}
			else {
				echo '<span class="note-red">Sorry, no buyer account was selected to edit. (Error Admin 207)</span>';
			}
		}
		else {
			echo '<span class="note-red">Sorry, you need to login again. Your session has expired.</span><br />';
			echo '<span class="note-red">If you are having troubles, you administrator settings might be incorrect.</span><br />';
			echo '<span class="note-red">Please contact the webmaster of this website.</span>';
		}
?>
			
			<h2>Edit Buyer Settings & Preferences:</h2>
			
			
		</div>
		
		<div class="section">
		
			<p>
			<button type="button" onClick="location.href='user_dashboard_buyer.php'">&lt;&lt; Back To My Dashboard</button>
			<button type="button" onClick="location.href='marketplace_listings.php'">View The Public Marketplace >></button>
			</p>	
			
			
		<form method="post" action="admin_edit_buyer_profile.php?buyerid=<?php echo $this_buyer_id; ?>">		
			<h4>Personal Settings:</h4>
			<table>
				<tr>
					<td><span class="p-leader">First Name: </span></td>
					<td><input type="text" name="firstname" value="<?php echo $this_buyer_first_name; ?>" /></td>
				</tr>
				<tr>
					<td><span class="p-leader">Last Name: </span></td>
					<td><input type="text" name="lastname" value="<?php echo $this_buyer_last_name; ?>" /></td>
				</tr>
				<tr>
					<td><span class="p-leader">Email: </span></td>
					<td><?php echo $this_buyer_email; ?> <input type="text" name="email" class="email"/><br /> 
					<span class="note-tiny">Sorry, Email Addresses Cannot Be Changed.</span></td>
				</tr>
				<tr>
					<td><span class="p-leader">Phone: </span></td>
					<td><input type="text" name="buyerphone" value="<?php echo $this_buyer_phone; ?>" /></td>
				</tr>
			</table>
			
			<br />
			<h4>Password Update:</h4>
			<table>
				<tr>
					<td><span class="p-leader">New Password: </span></td>
					<td><input type="password" name="1password" value="<?php echo $this_user_password; ?>" /></td>
				</tr>
				<tr>
					<td><span class="p-leader">New Password: (again for security)</span></td>
					<td><input type="password" name="2password" value="<?php echo $this_user_password; ?>" /></td>
				</tr>
			</table>
			
			<br />
			<h4>Property Preferences:</h4>
			<table>
				<tr>

						<td><span class="p-leader">My Property Type: </span></td>	
						<td>
							<select name="propertytype">
								<option value="Condo" <?php if($this_buyer_prop_type == 'Condo') {echo 'selected';} ?>>Condo</option>
								<option value="Single Family" <?php if($this_buyer_prop_type == 'Single Family') {echo 'selected';} ?>>Single Family</option>
								<option value="Multi-Family" <?php if($this_buyer_prop_type == 'Multi-Family') {echo 'selected';} ?>>Multi-Family</option>
								<option value="Commercial" <?php if($this_buyer_prop_type == 'Commercial') {echo 'selected';} ?>>Commercial</option>
								<option value="Other" <?php if($this_buyer_prop_type == 'Other') {echo 'selected';} ?>>Other</option>
							</select>
						</td>
				</tr>
				<tr>
						<td><span class="p-leader">Purchasing Budget: </span></td>
						<td>
							<select name="budget">
								<option value="$0-250K" <?php if($this_buyer_budget == '$0-250K') {echo 'selected';} ?>>$0-250K</option>
								<option value="$250-500K" <?php if($this_buyer_budget == '$250-500K') {echo 'selected';} ?>>$250-500K</option>
								<option value="$500K - $1M" <?php if($this_buyer_budget == '$500K - $1M') {echo 'selected';} ?>>$500K - $1M</option>
								<option value="$1M +" <?php if($this_buyer_budget == '$1M +') {echo 'selected';} ?>>$1M+</option>
							</select>
						</td>
				</tr>
				<tr>
						<td><span class="p-leader">Transaction Method: </span></td>
						<td>
							<select name="transaction">
								<option value="Cash" <?php if($this_buyer_buy_method == 'Cash') {echo 'selected';} ?>>Cash</option>
								<option value="Financing" <?php if($this_buyer_buy_method == 'Financing') {echo 'selected';} ?>>Financing</option>
							</select>
						</td>
				</tr>
				<tr>
						<td><span class="p-leader">Available To Purchase: </span></td>
						<td>
							<select name="turnaroundtime">
								<option value="Immediately" <?php if($this_buyer_timeframe == 'Immediately') {echo 'selected';} ?>>Immediately</option>
								<option value="1-3 Months" <?php if($this_buyer_timeframe == '1-3 Months') {echo 'selected';} ?>>1-3 Months</option>
								<option value="3-6 Months" <?php if($this_buyer_timeframe == '3-6 Months') {echo 'selected';} ?>>3-6 Months</option>
								<option value="6-12 Months" <?php if($this_buyer_timeframe == '6-12 Months') {echo 'selected';} ?>>6-12 Months</option>
								<option value="12+ Months" <?php if($this_buyer_timeframe == '12+ Months') {echo 'selected';} ?>>12+ Months</option>
							</select>
						</td>
				</tr>
				<tr>
						<td colspan="2"><span class="p-leader">More Details (if any): </span></td>
				</tr>
				<tr>
						<td colspan="2"><textarea name="moredetails" rows="6" cols="40"><?php echo $this_buyer_more_details; ?></textarea></td>
				</tr>
				<tr>
						<td colspan="2"><span class="p-leader">Date Account Was Setup: <?php echo $this_buyer_tos_timestamp; ?></span></td>
				</tr>
			</table>
			<br />
			<input type="submit" name="h40sFdwONmnM" value="Save These Changes >>" />
		</form>		
	
		</div> <!-- END SECTION -->
		

		<div class="section">
		
		</div>

	</div> <!-- END CLASS BODY -->


	



	
	
<?php include 'includes/footer.php'; ?>