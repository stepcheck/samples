<?php 	session_start(); 
		//If Session is not equal to administrator
		if($_SESSION['administrator'] != 'administrator') {
			header('Location: http://bostonpropertybuyers.com/user_dashboard_buyer.php');
			exit;
		}
?>
<?php include 'includes/header1.php'; ?>
<title>Admin Dashboard - Boston Property Buyers</title>
<meta name="robots" content="noindex">
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Welcome, <?php echo $_SESSION["email"]; ?>!</h1>
			
			<h2>Administrator Dashboard</h2>
			<h2><?php include 'includes/delete_object.php'; // This processes all delete buttons on the page. ?>
			<?php include 'includes/activate_deactivate_object.php'; // This processes all active/inactive buttons on the page. ?>
			<?php include 'includes/sold_listing_toggle_change.php'; // This processes all sold toggle clicks on the page. ?>
			<?php include 'includes/featured_listing_change.php'; // This processes all featured toggle clicks on the page. ?>
			
			
			
			<?php include 'includes/activate_deactivate_buyer_account.php'; // This processes all deactivate buyer buttons on the page. ?></h2>
			
			
		</div>
		
		<div class="section">
		
		<p>
		<button type="button" onClick="location.href='admin_add_new_listing_page.php'"> Add A Property >></button>
		<button type="button" onClick="location.href='marketplace_listings.php'"> View The Public Marketplace >></button>
		</p>
		
			<h2>All Listings:</h2>
			
				<?php 	// Featured Listings Area
						// Show: Address, Type, Price, Seller Name, Seller Phone, Featured
						
					// Connect to Database
					include 'includes/database_connect.php';
					
					$table = 'prop_seller_listings';
				
					$sql = "SELECT * FROM $table";
					
					$result = mysqli_query($con, $sql);
					
					$numberofrows = mysqli_num_rows($result);
					
					if ($numberofrows > 0) {
					
						echo 	'<table class="listings-table">' .  // open table
								
									'<tr>' . 
								
								'<th>' . 'Image:' . '</th>' .
								'<th>' . 'Property Address:' . '</th>' . 
								'<th>' . 'Type:' . '</th>' . 
								'<th>' . 'Listing Price:' . '</th>' . 
								'<th>' . 'Seller Price:' . '</th>' . 
								'<th>' . 'Seller Name:' . '</th>' . 
								'<th>' . 'Seller Phone:' . '</th>' . 
								'<th>' . 'Seller Email:' . '</th>' . 
								'<th>' . 'Visible?' . '</th>' . 
								'<th>' . 'Featured?' . '</th>' . 
								'<th>' . 'Sold?' . '</th>' .
								'<th>' . 'Edit:' . '</th>' . 
								'<th>' . 'Delete:' . '</th>' . 
									
									'<tr>';
						
						while ($row = mysqli_fetch_array($result)) {
							echo 	
							
								'<tr>' .
								
									'<td>' . 
										'<a href="listing_details_page.php?propertyid=' . $row["seller_listing_id"] .'">' . 
											'<img src="';
											
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
											///////// END GET IMAGES /////////
											
											echo '" border="0" class="tableimage"/>' .
										'</a>' .
									'</td>' . 
									
									'<td>' . 
										'<a href="listing_details_page.php?propertyid=' . $row["seller_listing_id"] .'">' . 
											$row["property_street_number"] . ' ' . ucwords(strtolower($row["property_street_name"])) . ', ' . 
											ucwords(strtolower($row["property_city"])) . ', ' . strtoupper($row["property_state"]) . ' ' . $row["property_zip"] . 
										'</a>' .
									'</td>' . 
									
									'<td>' . 
										$row["property_type"] . 
									'</td>' . 
									
									'<td>' . 
										'$' . number_format($row["price_for_sale"]) . 
									'</td>' . 
									
									'<td>' . 
										'$' . number_format($row["price_want_sell"]) .
									'</td>' . 
									
									'<td>' . 
										$row["seller_first_name"] . ' ' . $row["seller_last_name"] .
									'</td>' . 
									
									'<td>' . 
										$row["seller_phone"] . 
									'</td>' . 
									
									'<td>' . 
										$row["seller_email"] . 
									'</td>' . 
									
									'<td>';
									
									if($row["listing_active"] === "yes") { // show green checkmark
										echo '<a href="admin_dashboard.php?propertyid=' . $row["seller_listing_id"] . 
										'&activetoggle=' . $row["listing_active"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/active-green.png" alt="Currently Active" title="Currently Active" border="0" class="smalltableicon"/></a>';
									}
									else { // If it = no, then show grey checkmark
										echo '<a href="admin_dashboard.php?
										propertyid=' . $row["seller_listing_id"] . 
										'&activetoggle=' . $row["listing_active"] . 
										'&session_email=' . $_SESSION["email"] . 
										'"><img src="images/active-grey.png" border="0" alt="Currently Not Active" title="Currently Not Active" class="smalltableicon"/></a>';
									}
 
									echo '</td>' . 
									
									'<td>';	
										
									if($row["featured"] === "yes") {
										echo '<a href="admin_dashboard.php?propertyid=' . $row["seller_listing_id"] . 
										'&featuredtoggle=' . $row["featured"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/featured-yellow.png" border="0" alt="Currently Featured" title="Currently Featured" class="smalltableicon"/></a>';
									}
									else {
										echo '<a href="admin_dashboard.php?propertyid=' . $row["seller_listing_id"] . 
										'&featuredtoggle=' . $row["featured"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/featured-grey.png" border="0" alt="Currently Not Featured" title="Currently Not Featured" class="smalltableicon"/></a>';
									}
										
									echo '</td>' . 
									
									'<td>';	
										
									if($row["mark_as_sold"] === "yes") {
										echo '<a href="admin_dashboard.php?propertyid=' . $row["seller_listing_id"] . 
										'&soldtoggle=' . $row["mark_as_sold"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/sold-red.png" border="0" alt="Currently Marked As Sold" title="Currently Marked As Sold" class="smalltableicon"/></a>';
									}
									else {
										echo '<a href="admin_dashboard.php?propertyid=' . $row["seller_listing_id"] . 
										'&soldtoggle=' . $row["mark_as_sold"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/sold-grey.png" border="0" alt="Currently Not Marked As Sold" title="Currently Not Marked As Sold" class="smalltableicon"/></a>';
									}
										
									echo '</td>' . 
									
									'<td>' . 
										'<a href="admin_edit_listing_page.php?propertyid=' . $row['seller_listing_id'] . '"><img src="images/edit-icon.png" border="0" class="smalltableicon"/></a>' . 
									'</td>' .
									
									'<td>' . 
									"<a onClick=\"javascript: return confirm('Please Confirm Delete - Note: this will also delete seller information for this listing!');\" href='admin_dashboard.php?propertyid=" . $row['seller_listing_id'] . "&deleteprop=yes&ses_email=" . $_SESSION['email'] . "'><img src='images/delete-button.png' border='0' class='smalltableicon'/></a>" . 
									'</td>' .
									
								'</tr>';
								
								
								
						} // END WHILE
						
						echo '</table>'; // close table
						
					} // END IF
					else {
							echo "Sorry, there are no listings. Please try another search!";
					} // END ELSE
				
				mysqli_close($con);
			
				?>
				<br />
			
		</div>
		
		<!-- WE CAN ADD THIS STUFF LATER
		<div class="section">
		
		<h3>Website Data:</h3>
		<p>Total Number of Buyers:</p>
		<br />
		<p>Total Number of Properties For Sale:</p>
		<br />
		<p>Accounts Awaiting Activation:</p>
		<br />
		<p>Seller Submitted Properties Awaiting Activation: </p>
		<br />
		<p>Recent Favorites: (Past 30 days)</p>
		<p>Or view all favorites & narrow by users.</p>
		<br />
		<p>Recent Views:</p>
		<p>See who has viewed which listings.</p>
		<br />
		<p>User Login Logs:</p>
		<p>When Users last logged in.</p>
		
		
		</div>
		-->
		
		<div class="section">
		
					<h2>Seller List:</h2>
					
					<?php 	// Seller List
						
					// Connect to Database
					include 'includes/database_connect.php';
					
					$table = 'prop_seller_listings';
				
					$sql = "SELECT * FROM $table";
					
					$result = mysqli_query($con, $sql);
					
					$numberofrows = mysqli_num_rows($result);
					
					if ($numberofrows > 0) {
					
						echo 	'<table class="listings-table">' .  // open table
								
									'<tr>' . 

								'<th>' . 'Seller Name:' . '</th>' . 
								'<th>' . 'Seller Phone:' . '</th>' . 
								'<th>' . 'Seller Email:' . '</th>' . 
								 
									
									'<tr>';
						
						while ($row = mysqli_fetch_array($result)) {
							echo 	
							
								'<tr>' .
									
									'<td>' . 
										ucwords(strtolower($row["seller_first_name"])) . ' ' . ucwords(strtolower($row["seller_last_name"])) .
									'</td>' . 
									
									'<td>' . 
										$row["seller_phone"] . 
									'</td>' . 
									
									'<td>' . 
										$row["seller_email"] . 
									'</td>' . 
									
									
									
								'</tr>';
						} // END WHILE
						
						echo '</table>'; // close table
						
					} // END IF
					else {
							echo "Sorry, there are no listings. Please try another search!";
					} // END ELSE
				
				mysqli_close($con);
			
				?>
		
		</div>
		
		<div class="section">
			
			<h2>Buyer List</h2>
			
			
			<?php 	// Buyer List
						
					// Connect to Database
					include 'includes/database_connect.php';
					
					$table = 'prop_buyer_users';
				
					$sql = "SELECT * FROM $table";
					
					$result = mysqli_query($con, $sql);
					
					$numberofrows = mysqli_num_rows($result);
					
					if ($numberofrows > 0) {
					
						echo 	'<table class="listings-table">' .  // open table
								
									'<tr>' . 

								'<th>' . 'Buyer Name:' . '</th>' . 
								'<th>' . 'Phone:' . '</th>' . 
								'<th>' . 'Email:' . '</th>' . 
								'<th>' . 'Desired Property Types:' . '</th>' . 
								'<th>' . 'Budget:' . '</th>' . 
								'<th>' . 'Payment Method:' . '</th>' . 
								'<th>' . 'Ready To Purchase:' . '</th>' . 
								'<th>' . 'Account Active:' . '</th>' . 
								'<th>' . 'Edit:' . '</th>' . 
								'<th>' . 'Delete:' . '</th>' . 
									
									'<tr>';
						
						while ($row = mysqli_fetch_array($result)) {
							echo 	
							
								'<tr>' .
									
									'<td>' . 
										ucwords(strtolower($row["user_first_name"])) . ' ' . ucwords(strtolower($row["user_last_name"])) .
									'</td>' . 
									
									'<td>' . 
										$row["phone_num"] . 
									'</td>' . 
									
									'<td>' . 
										$row["email_address"] . 
									'</td>' . 
							
									'<td>' . 
										$row["buyer_property_type"] . 
									'</td>' . 
									
									'<td>' . 
										$row["buyer_budget"] . 
									'</td>' . 
									
									'<td>' . 
										$row["transaction_method"] . 
									'</td>' . 
									
									'<td>' . 
										$row["how_quickly_buy"] . 
									'</td>' . 
									
									'<td>';
									
									if($row["account_active"] === "yes") { // show green checkmark
										echo '<a href="admin_dashboard.php?buyerid=' . $row["user_id"] . 
										'&buyeractivetoggle=' . $row["account_active"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/active-green.png" alt="Currently Active" title="Currently Active" border="0" class="smalltableicon"/></a>';
									}
									else { // If it = no, then show grey checkmark
										echo '<a href="admin_dashboard.php?buyerid=' . $row["user_id"] . 
										'&buyeractivetoggle=' . $row["account_active"] . '&session_email=' . $_SESSION["email"] . 
										'"><img src="images/active-grey.png" border="0" alt="Currently Not Active" title="Currently Not Active" class="smalltableicon"/></a>';
									}
									
									echo '</td>' . 
 
									'<td>' . 
										'<a href="admin_edit_buyer_profile.php?buyerid=' . $row['user_id'] . '"><img src="images/edit-icon.png" border="0" class="smalltableicon"/></a>' .  
									'</td>' .
									
									'<td>' . 
										
										"<a onClick=\"javascript: return confirm('Are You Sure You Want To Delete this Buyer?');\" href='admin_dashboard.php?buyerid=" . $row['user_id'] . "&deletebuyer=yes&ses_email=" . 
										$_SESSION['email'] . "'><img src='images/delete-button.png' border='0' class='smalltableicon'/></a>" .
										
									'</td>' .
									
								'</tr>';
						} // END WHILE
						
						echo '</table>'; // close table
						
					} // END IF
					else {
							echo "Sorry, there are no listings. Please try another search!";
					} // END ELSE
				
				mysqli_close($con);
			
				?>
			
			
		
		
		</div>

		<div class="section">
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>