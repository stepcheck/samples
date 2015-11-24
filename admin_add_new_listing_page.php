<?php 	session_start(); 
		//If Session is not equal to administrator
		if($_SESSION['administrator'] != 'administrator') {
			header('Location: http://bostonpropertybuyers.com/user_dashboard_buyer.php');
			exit;
		}
?>

<?php include 'includes/header1.php'; ?>
<title>Add New Listing - Boston Property Buyers</title>
<meta name="robots" content="noindex">
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		<div class="section1">
		<h1><img src="images/checkmark.png" border="0" align="absmiddle" />Add A New Property Listing</h1>
			
			<?php
			
			// Upload Propery Form Data On Submit
			if (isset($_POST['nMvalidX7'])) {
			
				if ($_SESSION['administrator'] == 'administrator') {
				
					// Connect to Database
					include 'includes/database_connect.php';
				
					// Identify Table
					$table= "prop_seller_listings";
				
					// Write SQL
					$AdminAddListingSql="INSERT INTO $table ( 
					seller_first_name, 
					seller_last_name, 
					seller_phone, 
					seller_email, 
					property_street_number, 
					property_street_name, 
					property_city, 
					property_state, 
					property_zip, 
					property_type, 
					number_units,
					soon_to_sell, 
					price_want_sell, 
					price_for_sale,
					reason_selling,
					property_cap_rate,
					property_NOI,
					property_details,
					listing_active,
					featured)
				VALUES (
					'$_POST[firstname]', 
					'$_POST[lastname]', 
					'$_POST[phone]', 
					'$_POST[emailaddress]',					
					'$_POST[propertystreetnumber]', 
					'$_POST[propertystreetname]',
					'$_POST[propertycity]', 
					'$_POST[propertystate]', 
					'$_POST[propertyzip]', 
					'$_POST[propertytype]', 
					'$_POST[numberofunits]', 
					'$_POST[howquicklysell]', 
					'$_POST[sellwantprice]', 
					'$_POST[listingprice]',
					'$_POST[sellingreason]',
					'$_POST[caprate]',
					'$_POST[NOI]',
					'$_POST[publicdetails]',
					'$_POST[makevisible]',
					'$_POST[makefeatured]' 
					)";
				
					// Run SQL
					mysqli_query($con, $AdminAddListingSql);
					
					// If Aff
					if(mysqli_affected_rows($con) > 0) {
						echo '<span class="note-green">Note: A property was added.</span>';
						include 'includes/create_directory.php';
					} // End Affected rows > 0
					else {
						echo '<span class="note-red">Note: An error occurred when adding a property.</span>';
					}
					
					
					mysqli_close($con);
			
				} // End Session = Administrator
				else {
					echo '<span class="note-red">Sorry, you are not listed as an authorized administrator to delete this listing. (Error Admin 107)</span>';
					echo '<br />';
					echo '<span class="note-red">You may need to login again.</span>';
				}
			
			} // End If Form is submitted
			
			

			
			?>
		
		<p>
			<button type="button" onClick="location.href='admin_dashboard.php'"> &lt;&lt; Back To Admin Dashboard</button>
			<button type="button" onClick="location.href='marketplace_listings.php'"> View The Public Marketplace >></button>
			</p>
		
		<h2>Property Information:</h2>
			
<form id="form1" name="form" method="post" action="admin_add_new_listing_page.php">

	<table border="0" cellpadding="6" cellspacing="2" style="width: 600px;">
		<tbody>
			<tr>
				<td>Seller First Name:</td>
				<td><input type="text" name="firstname" /></td>
			</tr>
			<tr>
				<td>Seller Last Name:</td>
				<td><input type="text" name="lastname" /></td>
			</tr>
			<tr>
				<td>Seller Phone:</td>
				<td><input type="text" name="phone" /></td>
			</tr>
			<tr>
				<td>Seller Email:</td>
				<td><input type="text" name="emailaddress" /></td>
			</tr>

			<tr>
				<td>Property Street Number:</td>
				<td><input type="text" name="propertystreetnumber" /></td>
			</tr>
			<tr>
				<td>Property Street Name:</td>
				<td><input type="text" name="propertystreetname" /></td>
			</tr>
			<tr>
				<td>City:</td>
				<td><input type="text" name="propertycity" /></td>
			</tr>
			<tr>
				<td>State:</td>
				<td>
					<select name="propertystate">

<?php include 'includes/states_list.php'; ?>

					</select>
				</td>
			</tr>
			<tr>
				<td>Zip:</td>
				<td><input type="text" name="propertyzip" /></td>
			</tr>
			<tr>
				<td>Property Type:</td>
				<td>
					<select name="propertytype">
						<option value="Condo">Condo</option>
						<option value="Single Family">Single Family</option>
						<option value="Multi-Family">Multi-Family</option>
						<option value="Commercial">Commercial</option>
						<option value="Other">Other</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Number Of Units:</td>
				<td>
					<select name="numberofunits">

<?php include 'includes/unit_option_numbers.php'; ?>
						
					</select>
				</td>
			</tr>
			<tr>
				<td>Desired Sell Timeframe:</td>
				<td>
					<select name="howquicklysell">
						<option value="Immediately">Immediately</option>
						<option value="1-3 Months">1-3 Months</option>
						<option value="3-6 Months">3-6 Months</option>
						<option value="6-12 Months">6-12 Months</option>
						<option value="12+ Months">12+ Months</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Price Seller Wants:</td>
				<td><input type="text" name="sellwantprice" /></td>
			</tr>
			<tr>
				<td>Listing Price:</td>
				<td><input type="text" name="listingprice" /></td>
			</tr>
			<tr>
				<td>Cap Rate:</td>
				<td><input type="text" name="caprate" /></td>
			</tr>
			<tr>
				<td>NOI:</td>
				<td><input type="text" name="NOI" /></td>
			</tr>
			<tr>
				<td>Reason For Seller Selling:</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="sellingreason" rows="8" cols="60"/></textarea></td>
			</tr>
			<tr>
				<td>Details: (Visible to Users)</td>
			</tr>
			<tr>
				<td colspan="2"><textarea name="publicdetails" rows="8" cols="60"/></textarea></td>
			</tr>
			<tr>
				<td>Make visible/active now?</td>
				<td>
					<select name="makevisible">
						<option value="yes">Yes</option>
						<option value="no">No</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>Make featured now?</td>
				<td>
					<select name="makefeatured">
						<option value="no">No</option>
						<option value="yes">Yes</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><input type="submit" name="nMvalidX7" value="ADD THIS LISTING >>" /></td>
			</tr>
				</tbody>
			</table>
</form>
		<span class="note-tiny">Images Can Be Added By Clicking The Edit Button For This Listing On The Dashboard.</span>
		
		<br />
		<br />
		<h3>Notes About This Page:</h3>
		<p>This page is visible to administrators only.</p>
		<p>Not all fields need to be submitted. (No fields are required)</p>
		<p>Any information can be changed later.</p>
		<p>Don't put $ signs or comma's in money fields. It will automatically generate these symbols.</p>
		
		</div>

		<div class="section">
		<p>Please note: This page is for administrators only. If you are not an administrator, please logout immediately.</p>
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>