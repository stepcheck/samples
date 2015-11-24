<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
<title>Buy & Sell Investment Properties - Boston Property Buyers</title>
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/profile_main.jpg" border="0" />
		</div>

		<div class="section1">
			<?php include 'includes/login_form_nomad.php'; ?>
			<h1>Looking For Your Next Big Investment?</h1>
			
			<h2>We connect sellers DIRECTLY to qualified buyers!</h2>
			
			<p>We take the hassle, time and commission out of the typical real estate transaction. We connect you our database of only the most qualified buyers, we help handle of all of the paperwork with minimal visits to the property.You set the price, terms and when you want to close!</p>
		
		
		
		
		<?php
				///////////////////////////		THIS IS TO SHOW FEATURED PROPERTIES ON THE HOMEPAGE		////////////////////////////
					
					// CONNECT TO DB
					include 'includes/database_connect.php';
		
					// SET TABLE
					$table = "prop_seller_listings";
					
					// GET 3 FEATURED PROPERTIES
					$selectFeaturedSQL = "SELECT * FROM $table WHERE featured = 'yes' LIMIT 3";
					$featuredRun = mysqli_query($con, $selectFeaturedSQL);
			
					// Get number of Rows
					$qnumrows = mysqli_num_rows($featuredRun);

					
						if($qnumrows < 4 and $qnumrows > 0) {
							
							echo '<div class="index-property-showcase-container">';
							echo '<div class="index-property-showcase">';
						
							while ($row = mysqli_fetch_array($featuredRun)) {
							
								echo '<div class="one-property-container">';
									echo '<div class="property-photo">';
										echo '<a href="listing_details_page.php?propertyid=' . $row['seller_listing_id'] . '"><img src="'; 
										
											///////// This is to get the first image for this property (using property id) /////////
											$imageTable = "user_file_uploads";
											$propertyID = $row["seller_listing_id"];
											$getFirstImage = "SELECT file_name FROM $imageTable WHERE listing_id_key = $propertyID AND file_type ='image'";
											
											$runImageQuery = mysqli_query($con, $getFirstImage);
											$rowQ2 = mysqli_fetch_array($runImageQuery, MYSQLI_NUM);
											
											$numRowsImages = mysqli_num_rows($runImageQuery);
											
											if($numRowsImages != 0) {
												echo $row["upload_path"] . "/" . $rowQ2["0"];
											}
											else {
												echo "images/sample-table-image.jpg";
											}
										
										echo '" border="0" width="100%" height="100%" /></a>';
										echo '<div class="featured-banner">';
											echo '<a href="listing_details_page.php?propertyid=' . $row['seller_listing_id'] . '"><img src="images/featured-banner.png" border="0" width="100%" height="100%"/></a>';
										echo '</div>';
									echo '</div>';
									echo '<div class="property-details">' . $row['property_street_number'] . ' ' .  
									ucwords(strtolower($row['property_street_name'])) . ', ' . ucwords(strtolower($row['property_city'])) . ', ' . 
									strtoupper($row['property_state']) . 
									' ' . $row['property_zip'] . '</div>';
									echo '<div class="property-price">' . '$' . number_format($row['price_for_sale']) . '</div>';
								echo '</div>';
								
							
							
							}
							
							echo '</div>';
							echo '</div>';
						}
						
					mysqli_close($con);
					
		?>
			
			
		</div>

		<div class="section">
		
		<h3>Exclusive Listings</h3>
		<p>Our listings are 100% exclusive, which means you won't find these properties anywhere else. Only our qualified buyers 
		can access our database.</p>
		
		<h3>Work With An Experienced Real Estate Professional</h3>
		<p>Our expert staff will help guide you through every step of the sales process. We're there to answer any questions you may have.</p>	
		
		</div>

		<div class="section">
		
		
			<form id="form1" name="form1" method="post" action="home_contact_us.php">
				<table border="0" cellpadding="6" cellspacing="2" style="width: 100%;">
					<tbody>
						<tr>
							<th colspan="4">Please Fill Out This Form To Connect With Us:</th>
						</tr>
						
						<tr>
							<td><span class="note-red">* </span>First Name:</td>
							<td><input type="text" name="firstname" /></td>
							
							<td><span class="note-red">* </span>Last Name:</td>
							<td><input type="text" name="lastname" /></td>
						</tr>

						<tr>
							<td><span class="note-red">* </span>Email Address:</td>
							<td><input type="text" name="name" value="5Qname" class="email"/><input type="text" name="emailaddress" /><input type="text" name="email" class="email"/></td>
							
							<td>Phone:</td>
							<td><input type="text" name="phone" /></td>
						</tr>
						<tr>
							<td>Topic:</td>
							<td colspan="3">
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
							<td colspan="4"><span class="note-red">* </span>Message:</td>
						</tr>
						<tr>
							<td colspan="4"><textarea name="generalmessage" rows="6" cols="75"></textarea></td>
						</tr>
						<td colspan="4"><span class="note-red">* </span><img src="images/catdog.jpg" border="0" align="absmiddle" width="84px" height="32px" /> <input type="text" name="catdog" maxlength="4" size="4"/> What's in the image on the left? (Spam Protection)</td>
						<tr>
							<td colspan="4"><input type="submit" name="Q0f43bj8" value="Send Message >>" /></td>
						</tr>
					</tbody>
				</table>
			</form>
		
		
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>