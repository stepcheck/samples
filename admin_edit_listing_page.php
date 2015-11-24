<?php 	session_start(); 
		//If Session is not equal to administrator
		if($_SESSION['administrator'] != 'administrator') {
			header('Location: http://bostonpropertybuyers.com/user_dashboard_buyer.php');
			exit;
		}
?>
<?php include 'includes/header1.php'; ?>
<title>Edit Listing - Boston Property Buyers</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Welcome, <?php echo $_SESSION["email"]; ?>!</h1>
			
			<h2>Edit This Property</h2>
			<p>This property ID is: <?php echo $_GET['propertyid']; ?></p>
			
<?php

	////////////////////////// THIS UPDATES THE CHANGES INTO THE DATABASE ///////////////////////////////////
	
	if (isset($_POST['K63Gh10iOn'])) {
		if (isset($_GET['propertyid'])) {
			if ($_SESSION['administrator'] == 'administrator') {
			
				include 'includes/database_connect.php';
				$table = "prop_seller_listings";
				$propertyid = $_GET['propertyid'];
				
				$updateSQL = "UPDATE $table SET 
									seller_first_name 		=		'$_POST[firstname]',
									seller_last_name 		=		'$_POST[lastname]',
									seller_phone			=		'$_POST[phonenumber]',
									seller_email	 		=		'$_POST[emailaddress]',
									property_street_number 	=		'$_POST[streetnumber]',
									property_street_name 	=		'$_POST[streetname]',
									property_city 			=		'$_POST[city]',
									property_state 			=		'$_POST[propertystate]',
									property_zip 			=		'$_POST[zip]',
									property_type 			=		'$_POST[propertytype]',
									total_sq_ft 			=		'$_POST[totalsqft]',
									number_units 			=		'$_POST[numberunits]',
									soon_to_sell 			=		'$_POST[soonsell]',
									price_want_sell 		=		'$_POST[pricewantsell]',
									price_for_sale 			=		'$_POST[pricelistsale]',
									property_taxes 			=		'$_POST[proptaxes]', 
									condo_fee	 			=		'$_POST[condofee]', 
									reason_selling 			=		'$_POST[reasonselling]',
									property_cap_rate 		=		'$_POST[caprate]',
									property_NOI			=		'$_POST[NOI]',
									property_details 		=		'$_POST[propertydetails]' 
				
							WHERE seller_listing_id = '$propertyid'";
							
				mysqli_query($con, $updateSQL);
			
				mysqli_close($con);
				
			echo '<span class="note-green">Success, listing ID: ' . $propertyid . ' was updated!</span>';
	 
			} // End Check User = Administrator
			else {
			echo '<span class="note-red">Sorry, you must be an administrator to use this page!</span>';
			echo "<br /><br />";
			echo '<span class="note-red">If you are an administrator, you must login again.</span>';
			}
		} // End If Property ID is set
		else {
		echo '<span class="note-red">Sorry, no Property ID is set for this page!</span>';
		echo "<br /><br />";
		echo '<span class="note-red">Please go back and click the "edit" link again.</span>';
		echo "<br /><br />";
		echo '<span class="note-red">If that does not work, you may need to login again.</span>';
	 
		}
	
	} // End If Form is submitted
	
	
	////////////////////////// THIS PUTS THE DATABASE INFO ON THE PAGE //////////////////////////////////////
	
	if (isset($_GET['propertyid'])) {
	
		$listingid = $_GET['propertyid'];
	
		$table = 'prop_seller_listings';
		
		include 'includes/database_connect.php';
		
		$query = "SELECT * FROM $table WHERE seller_listing_id = '$listingid'";

		$result = mysqli_query($con, $query);
 
		while($row = mysqli_fetch_assoc($result)) {

			$this_listing_first_name = 	$row['seller_first_name'];
			$this_listing_last_name = 	$row['seller_last_name'];
			$this_listing_phone = 		$row['seller_phone'];
			$this_listing_email = 		$row['seller_email'];
			$this_listing_st_number = 	$row['property_street_number'];
			$this_listing_st_name = 	$row['property_street_name'];
			$this_listing_city = 		$row['property_city'];
			$this_listing_state = 		$row['property_state'];
			$this_listing_zip = 		$row['property_zip'];
			$this_listing_type = 		$row['property_type'];
			$this_listing_sq_ft =		$row['total_sq_ft'];
			$this_listing_num_units = 	$row['number_units'];
			$this_listing_soon_sell = 	$row['soon_to_sell'];
			$this_listing_pricewsell = 	$row['price_want_sell'];
			$this_listing_price = 		$row['price_for_sale'];
			$this_listing_taxes =		$row['property_taxes'];
			$this_listing_condo_fee =	$row['condo_fee'];
			$this_listing_reasonsell = 	$row['reason_selling'];
			$this_listing_cap_rate = 	$row['property_cap_rate'];
			$this_listing_NOI = 		$row['property_NOI'];
			$this_listing_details = 	$row['property_details'];

		}

		// If error exists, print it out bitch

		if (!$result) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}

		// Close connection
		mysqli_close($con);
	
		echo "<h2>" . $this_listing_type . " in " . ucwords(strtolower($this_listing_city)) . ", " . strtoupper($this_listing_state) . 
		" for " . $this_listing_price . "</h2>";

	}
	else {
		echo '<h2>Error 107</h2>';
		echo '<span class="note-red">Sorry, there was an error loading this page.</span>';
		echo '<span class="note-red">Please go back and click the link again. </span>';
		echo '<br /><br />';
		echo '<span class="note-red">You may need to login again. </span>';
	}
	

	?>
	
	<button type="button" onClick="location.href='admin_dashboard.php'"> &lt;&lt; Back To All Listings</button>
	
	<button type="button" onClick="location.href='listing_details_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'">View This Listing Page &gt;&gt;</button>
	
	<button type="button" onClick="location.href='marketplace_listings.php'">View The Marketplace &gt;&gt;</button>
	
	
	
	
	<h2>Property Details</h2>
	<form method="post" action="admin_edit_listing_page.php?propertyid=<?php echo $_GET['propertyid']; ?>">
		<table class="listings-table">
			<tr>
				<td>Seller First Name:</td>
				<td><input type="text" name="firstname" value="<?php echo ucwords(strtolower($this_listing_first_name)); ?>" /></td>
			</tr>
			<tr>
				<td>Seller Last Name:</td>
				<td><input type="text" name="lastname" value="<?php echo ucwords(strtolower($this_listing_last_name)); ?>" /></td>
			</tr>
			<tr>
				<td>Seller Phone:</td>
				<td><input type="text" name="phonenumber" value="<?php echo $this_listing_phone; ?>" /></td>
			</tr>
			<tr>
				<td>Seller Email:</td>
				<td><input type="text" name="emailaddress" value="<?php echo $this_listing_email; ?>" /></td>
			</tr>
			<tr>
				<td>Property Street Number:</td>
				<td>#<input type="text" name="streetnumber" size="6" value="<?php echo $this_listing_st_number; ?>" /></td>
			</tr>
			<tr>
				<td>Property Street Name:</td>
				<td><input type="text" name="streetname" value="<?php echo ucwords(strtolower($this_listing_st_name)); ?>" /></td>
			</tr>
			<tr>
				<td>Property City:</td>
				<td><input type="text" name="city" value="<?php echo ucwords(strtolower($this_listing_city)); ?>" /></td>
			</tr>
			<tr>
				<td>Property State:</td>
				<td>
					<select name="propertystate" value="<?php // Value is "Selected" on Includes Page ?>">

<?php include 'includes/states_list.php'; ?>

					</select>				
				</td>
			</tr>
			<tr>
				<td>Property Zip:</td>
				<td><input type="text" name="zip" value="<?php echo $this_listing_zip; ?>" /></td>
			</tr>
			<tr>
				<td>Property Type:</td>
				<td>
					<select name="propertytype">
						<option value="Condo" <?php if($this_listing_type == 'Condo') {echo 'selected';} ?>>Condo</option>
						<option value="Single Family" <?php if($this_listing_type == 'Single Family') {echo 'selected';} ?>>Single Family</option>
						<option value="Multi-Family" <?php if($this_listing_type == 'Multi-Family') {echo 'selected';} ?>>Multi-Family</option>
						<option value="Commercial" <?php if($this_listing_type == 'Commercial') {echo 'selected';} ?>>Commercial</option>
						<option value="Other" <?php if($this_listing_type == 'Other') {echo 'selected';} ?>>Other</option>
					</select>
				</td>				
			</tr>
			<tr>
				<td>Total Square Feet:</td>
				<td><input type="text" name="totalsqft" value="<?php echo $this_listing_sq_ft; ?>" />Sq/Ft <span class="note-tiny">(No symbols - If blank, won't display)</span></td>
			</tr>
			<tr>
				<td>Number of Units:</td>
				<td>
					<select name="numberunits" value="<?php // Value Selected is on includes page ?>">

<?php include 'includes/unit_option_numbers.php'; ?>
						
					</select>
				</td>
			</tr>
			<tr>
				<td>When Seller Wants To Sell:</td>
				<td>
					<select name="soonsell" value="<?php // This doesn't matter. ?>">
						<option value="Immediately" <?php if($this_listing_soon_sell == 'Immediately') {echo 'selected';} ?>>Immediately</option>
						<option value="1-3 Months" <?php if($this_listing_soon_sell == '1-3 Months') {echo 'selected';} ?>>1-3 Months</option>
						<option value="3-6 Months" <?php if($this_listing_soon_sell == '3-6 Months') {echo 'selected';} ?>>3-6 Months</option>
						<option value="6-12 Months" <?php if($this_listing_soon_sell == '6-12 Months') {echo 'selected';} ?>>6-12 Months</option>
						<option value="12+ Months" <?php if($this_listing_soon_sell == '12+ Months') {echo 'selected';} ?>>12+ Months</option>
					</select> <span class="note-tiny">(HIDDEN FROM USERS)</span>
				</td>
			</tr>
			<tr>
				<td>Price Seller Is Selling For:</td>
				<td>$ &nbsp;<input type="text" name="pricewantsell" value="<?php echo $this_listing_pricewsell; ?>" /><span class="note-tiny">(No symbols - HIDDEN FROM USERS)</span></td>
			</tr>
			<tr>
				<td>Price For Sale:</td>
				<td>$ &nbsp;<input type="text" name="pricelistsale" value="<?php echo $this_listing_price; ?>" /> <span class="note-tiny">(No symbols)</span></td>
			</tr>
			<tr>
				<td>Property Taxes:</td>
				<td>$ &nbsp;<input type="text" name="proptaxes" value="<?php echo $this_listing_taxes; ?>" /> <span class="note-tiny">(No symbols - If blank, won't display)</span></td>
			</tr>
			<tr>
				<td>Condo Fee:</td>
				<td>$ &nbsp;<input type="text" name="condofee" value="<?php echo $this_listing_condo_fee; ?>" /> <span class="note-tiny">(No symbols - If blank, won't display)</span></td>
			</tr>
			<tr>
				<td>Capitalization Rate:</td>
				<td><input type="text" name="caprate" value="<?php echo $this_listing_cap_rate; ?>" /> <span class="note-tiny">(No symbols)</span></td>
			</tr>
			<tr>
				<td>Net Operating Income (NOI):</td>
				<td>$ &nbsp;<input type="text" name="NOI" value="<?php echo $this_listing_NOI; ?>" /> <span class="note-tiny">(No symbols)</span></td>
			</tr>
			<tr>
				<td>Reason Seller is Selling: <span class="note-tiny">(HIDDEN FROM USERS)</span></td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="reasonselling" rows="12" cols="75"/><?php echo $this_listing_reasonsell; ?></textarea></td>
			</tr>
			<tr>
				<td>Property Details:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="propertydetails" rows="12" cols="75"/><?php echo $this_listing_details; ?></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" name="K63Gh10iOn" value="Save These Changes >>" /></td>
			</tr>
		
		</table>
	</form>
		
		<br />
		
		<button type="button" onClick="location.href='admin_edit_unit_info_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'">Edit Unit Info &gt;&gt;</button>
		Note: Only Add Images After Saving Any Changes Above!
		
		<br />
		<br />
		
		<button type="button" onClick="location.href='admin_add_images_listing_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'">Add Images &gt;&gt;</button>
		Note: Only Add Images After Saving Any Changes Above!
			
			
		</div>
		

		<div class="section">
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>