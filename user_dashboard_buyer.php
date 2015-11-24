<?php 	session_start(); 
		//If Session is not equal to administrator
		if(!isset($_SESSION['email'])) {
			header('Location: http://');
			exit;
		}
?>
<?php include 'includes/header1.php'; ?>
<title>My Dashboard</title>
<meta name="robots" content="noindex">
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>
		
		<?php
		
		if (isset($_SESSION['email'])) {
	
			$table = 'prop_buyer_users';
		
			include 'includes/database_connect.php';
		
			$query = "SELECT * FROM $table WHERE email_address = '$_SESSION[email]'";

			$result = mysqli_query($con, $query);
 
			while($row = mysqli_fetch_assoc($result)) {

				$this_buyer_first_name 		= 	$row['user_first_name'];
				$this_buyer_last_name 		= 	$row['user_last_name'];
				$this_buyer_phone 			= 	$row['phone_num'];
				$this_buyer_email 			= 	$row['email_address'];
				$this_buyer_prop_type 		= 	$row['buyer_property_type'];
				$this_buyer_budget 			= 	$row['buyer_budget'];
				$this_buyer_buy_method 		= 	$row['transaction_method'];
				$this_buyer_timeframe 		= 	$row['how_quickly_buy'];
				$this_buyer_more_details 	= 	$row['more_details'];
			}

			// If error exists, print it out bitch
			if (!$result) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
			}
		
			// Close connection
			mysqli_close($con);
		}
?>

		<div class="section1">
			<h1>Welcome, <?php echo $this_buyer_first_name; ?>!</h1>
			<br />
			<h2>Buyer Dashboard</h2>
			
		</div>
		
		<div class="section">
		
			<p> <button type="button" onClick="location.href='marketplace_listings.php'"> View The Public Marketplace >></button></p>	
		
			<h4>Personal Settings:</h4>
		<table>
			<tr>
					<td><span class="p-leader">Name: </span></td>	
					<td><?php echo $this_buyer_first_name . ' ' . $this_buyer_last_name; ?></td>
			</tr>
			<tr>
					<td><span class="p-leader">Email: </span></td>
					<td><?php echo $this_buyer_email; ?></td>
			</tr>
			<tr>		
					<td><span class="p-leader">Phone: </span></td>
					<td><?php echo $this_buyer_phone; ?></td>
			</tr>
			<tr>
					<td><span class="p-leader">Password: </span></td>
					<td>(HIDDEN)</td>
			</tr>
		</table>
			
			<h4>Property Preferences:</h4>
		<table>
			<tr>
					<td><span class="p-leader">My Property Type: </span></td>	
					<td><?php echo $this_buyer_prop_type; ?></td>
			</tr>
			<tr>
					<td><span class="p-leader">Purchasing Budget: </span></td>
					<td><?php echo $this_buyer_budget; ?></td>
			</tr>
			<tr>
					<td><span class="p-leader">Transaction Method: </span></td>
					<td><?php echo $this_buyer_buy_method; ?></td>
			</tr>
			<tr>
					<td><span class="p-leader">Available To Purchase: </span></td>
					<td><?php echo $this_buyer_timeframe; ?></td>
			</tr>
			<tr>
					<td><span class="p-leader">More Details (if any): </span></td>
					<td><?php echo $this_buyer_more_details; ?></td>
			</tr>
		</table>
			<p><button type="button" onClick="location.href='http://bostonpropertybuyers.com/user_buyer_edit_profile.php'">
			Update My Account Settings >>
			</button>
			</p>
		
		</div>

		<div class="section">
		</div>

	</div>

	
	
<?php include 'includes/footer.php'; ?>