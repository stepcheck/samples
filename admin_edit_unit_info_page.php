<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
	<title>Edit Units - Boston Property Buyers</title>
	
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		
		<div class="section1">
			<h1>Edit Unit Details</h1>
			
			<?php
				
				/////// 	THIS IS TO GET PROPERTY ID & TITLE INFORMATION FOR THIS PROPERTY	/////////
				
				include 'includes/database_connect.php';
				
				$propertyid = $_GET['propertyid'];
				
				// Get Number Of Units Listed In Listings Table
				
				$listingTable = "prop_seller_listings";
				$getNumUnitsSQL = "SELECT * FROM $listingTable WHERE seller_listing_id = '$propertyid'";
				$runGetUnits = mysqli_query($con, $getNumUnitsSQL);
				
				$countResults = mysqli_num_rows($runGetUnits);
			
				// There will never be 0 units because any property will have at least one unit.
				
				$row = mysqli_fetch_assoc($runGetUnits);
				
				$thisPropType			=		$row["property_type"];
				$thisPropStreetNum		=		$row["property_street_number"];
				$thisPropStreetName		=		ucwords(strtolower($row["property_street_name"]));
				$thisPropCity			=		ucwords(strtolower($row["property_city"]));
				$thisPropState			=		strtoupper($row["property_state"]);
				$thisPropZip			=		$row["property_zip"];
				$thisPropNumUnits		=		intval($row["number_units"]); // Turn into number, not a string
					
					echo '<h2>' . $thisPropType . ' - ' . $thisPropStreetNum . ' ' . 
					$thisPropStreetName . ', ' . $thisPropCity . 
					', ' . $thisPropState . ' ' . $thisPropZip . '</h2>';
					
			mysqli_close($con);
			
			?>
			
			<button type="button" onClick="location.href='admin_edit_listing_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'"> &lt;&lt; Back To Edit This Listing</button>
	
	<button type="button" onClick="location.href='admin_dashboard.php'"> &lt;&lt; Back To Admin Dashboard</button>
	
	<button type="button" onClick="location.href='listing_details_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'">View This Listing Page &gt;&gt;</button>
			
			
			<?php
			//////////		THIS IS TO RUN FORM SUBMISSIONS		////////////
			
			if (isset($_POST['PdbOMmNm0o'])) {
				if ($_SESSION['administrator'] = 'administrator') {
					
						// first - delete any prior records
						include 'includes/database_connect.php';
						
						$unitsTable = "listing_unit_info";
						
						$deleteUnitSQL = "DELETE FROM $unitsTable WHERE listing_id = '$propertyid'";
						mysqli_query($con, $deleteUnitSQL);
						
						mysqli_close($con);
						
						// This concept was taken from MY question on StackOverflow:
						// http://stackoverflow.com/questions/30270412/php-insert-unknown-number-of-rows-into-mysqli-database-from-array
						
						include 'includes/database_connect.php';
						
						$unitsTable = "listing_unit_info";
						
						$beds 		= $_POST['unitbedrooms'];
						$baths 		= $_POST['unitbathrooms'];
						$details 	= $_POST['unitdetails'];
						
						
						foreach ($beds as $key => $n) {
							
							$addUnitSQL = "INSERT INTO $unitsTable (listing_id, num_of_beds, num_of_baths, unit_details) 
													VALUES ('$propertyid', '$n', '$baths[$key]', '$details[$key]')";
							mysqli_query($con, $addUnitSQL);
							
						}
						
						echo '<span class="note-green">Success, the Unit info has been updated for' . $thisPropStreetNum . ' ' . 
						$thisPropStreetName . '</span>';
						
						mysqli_close($con);
						
				}
				else {
					echo '<span class="note-red">Sorry, only admins can edit unit info. Either you are not an administrator, or you need to login again!</span>';
				}
			}
			
			
			?>
			
			
	
			<?php
			//////////		THIS IS TO ECHO NUMBER OF UNITS (ONE LINE) AT THE TOP OF PAGE	////////////////
					if($thisPropNumUnits > 1) {
						echo '<p>This Property Has ' . $thisPropNumUnits . ' Units.</p>';
					} // END IF
					else {
						echo '<p>This Property Has 1 Unit.</p>';
					} // END ELSE
			
			?>
			
			
			
			<?php
				
				include 'includes/database_connect.php';
				
				$unitsTable = "listing_unit_info";
				$retrieveUnitsSQL = "SELECT * FROM $unitsTable WHERE listing_id = '$propertyid'";
				$runRetrieve = mysqli_query($con, $retrieveUnitsSQL);
				
				$countUnitResults = mysqli_num_rows($runRetrieve);
			
				// Get Results From Units Table: listings_unit_info
				
				$increment = 1;
				
				echo '<form method="POST" action="admin_edit_unit_info_page.php?propertyid=' . $propertyid . '">';
				echo '<input type="submit" name="PdbOMmNm0o" value="Save Unit Changes >>" /><br /><br />';
				
				while($row = mysqli_fetch_assoc($runRetrieve)) {
				
				echo '<strong>Unit: ' . $increment++  . '</strong><br /><br />';
				
				echo	'<select name="unitbedrooms[]" value="' . /* This Doesn't Matter */ '">
				
									<option value="1 Bedroom">1 Bedroom</option>
									<option value="1 Bed Split"'; if($row['num_of_beds'] == '1 Bed Split') {echo 'selected';} echo '>1 Bed Split</option>
									<option value="1 Bed + Den"'; if($row['num_of_beds'] == '1 Bed + Den') {echo 'selected';} echo '>1 Bed + Den</option>
									<option value="2 Bedrooms"'; if($row['num_of_beds'] == '2 Bedrooms') {echo 'selected';} echo '>2 Bedrooms</option>
									<option value="2 Bed Split"'; if($row['num_of_beds'] == '2 Bed Split') {echo 'selected';} echo '>2 Bed Split</option>
									<option value="2 Bed + Den"'; if($row['num_of_beds'] == '2 Bed + Den') {echo 'selected';} echo '>2 Bed + Den</option>
									<option value="3 Bedrooms"'; if($row['num_of_beds'] == '3 Bedrooms') {echo 'selected';} echo '>3 Bedrooms</option>
									<option value="3 Bed Split"'; if($row['num_of_beds'] == '3 Bed Split') {echo 'selected';} echo '>3 Bed Split</option>
									<option value="3 Bed + Den"'; if($row['num_of_beds'] == '3 Bed + Den') {echo 'selected';} echo '>3 Bed + Den</option>
									<option value="4 Bedrooms"'; if($row['num_of_beds'] == '4 Bedrooms') {echo 'selected';} echo '>4 Bedrooms</option>
									<option value="4 Bed Split"'; if($row['num_of_beds'] == '4 Bed Split') {echo 'selected';} echo '>4 Bed Split</option>
									<option value="4 Bed + Den"'; if($row['num_of_beds'] == '4 Bed + Den') {echo 'selected';} echo '>4 Bed + Den</option>
									<option value="5 Bedrooms"'; if($row['num_of_beds'] == '5 Bedrooms') {echo 'selected';} echo '>5 Bedrooms</option>
									<option value="5 Bed Split"'; if($row['num_of_beds'] == '5 Bed Split') {echo 'selected';} echo '>5 Bed Split</option>
									<option value="5 Bed + Den"'; if($row['num_of_beds'] == '5 Bed + Den') {echo 'selected';} echo '>5 Bed + Den</option>
									<option value="6 Bedrooms"'; if($row['num_of_beds'] == '6 Bedrooms') {echo 'selected';} echo '>6 Bedrooms</option>
									<option value="6 Bed Split"'; if($row['num_of_beds'] == '6 Bed Split') {echo 'selected';} echo '>6 Bed Split</option>
									<option value="6 Bed + Den"'; if($row['num_of_beds'] == '6 Bed + Den') {echo 'selected';} echo '>6 Bed + Den</option>
									<option value="7 Bedrooms"'; if($row['num_of_beds'] == '7 Bedrooms') {echo 'selected';} echo '>7 Bedrooms</option>
									<option value="7 Bed Split"'; if($row['num_of_beds'] == '7 Bed Split') {echo 'selected';} echo '>7 Bed Split</option>
									<option value="7 Bed + Den"'; if($row['num_of_beds'] == '7 Bed + Den') {echo 'selected';} echo '>7 Bed + Den</option>
									<option value="8 Bedrooms"'; if($row['num_of_beds'] == '8 Bedrooms') {echo 'selected';} echo '>8 Bedrooms</option>
									<option value="8 Bed Split"'; if($row['num_of_beds'] == '8 Bed Split') {echo 'selected';} echo '>8 Bed Split</option>
									<option value="8 Bed + Den"'; if($row['num_of_beds'] == '8 Bed + Den') {echo 'selected';} echo '>8 Bed + Den</option>
									<option value="9 Bedrooms"'; if($row['num_of_beds'] == '9 Bedrooms') {echo 'selected';} echo '>9 Bedrooms</option>
									<option value="9 Bed Split"'; if($row['num_of_beds'] == '9 Bed Split') {echo 'selected';} echo '>9 Bed Split</option>
									<option value="9 Bed + Den"'; if($row['num_of_beds'] == '9 Bed + Den') {echo 'selected';} echo '>9 Bed + Den</option>
									<option value="10+ Bedrooms"'; if($row['num_of_beds'] == '10+ Bedrooms') {echo 'selected';} echo '>10+ Bedrooms</option>

						</select>';
				
				echo	'<select name="unitbathrooms[]" value="' . /* This Doesn't Matter */ '">
							<option value="1"'; if($row['num_of_baths'] == '1') {echo 'selected';} echo '>1 Bath</option>
							<option value="1.5"'; if($row['num_of_baths'] == '1.5') {echo 'selected';} echo '>1.5 Baths</option>
							<option value="2"'; if($row['num_of_baths'] == '2') {echo 'selected';} echo '>2 Baths</option>
							<option value="2.5"'; if($row['num_of_baths'] == '2.5') {echo 'selected';} echo '>2.5 Baths</option>
							<option value="3"'; if($row['num_of_baths'] == '3') {echo 'selected';} echo '>3 Baths</option>
							<option value="3.5"'; if($row['num_of_baths'] == '3.5') {echo 'selected';} echo '>3.5 Baths</option>
							<option value="4"'; if($row['num_of_baths'] == '4') {echo 'selected';} echo '>4 Baths</option>
							<option value="4.5"'; if($row['num_of_baths'] == '4.5') {echo 'selected';} echo '>4.5 Baths</option>
							<option value="5+"'; if($row['num_of_baths'] == '5+') {echo 'selected';} echo '>5+ Baths</option>
						</select>';
				
				echo '<br />';
				echo '<textarea name="unitdetails[]" rows="8" cols="60" placeholder="Unit Details Here...">' . $row['unit_details'] . '</textarea>';
				
				echo '<br /><br />';
				} // END WHILE
				
				
				// If Results in DB are Less Than Number of Units Declated
				if ($countUnitResults < $thisPropNumUnits) {
					
					// Get Number Of Results Missing
					$x = $thisPropNumUnits - $countUnitResults;
				
					// While Number of Results Missing is More Than 0, Echo New Fields To Fill In
					while ($x > 0) {
						$x--;
						
						echo '<strong>Unit: ' . $increment++  . '</strong><br /><br />';
						
						echo	'<select name="unitbedrooms[]" value="' . /* This Doesn't Matter */ '">
									<option value="1 Bedroom">1 Bedroom</option>
									<option value="1 Bed Split">1 Bed Split</option>
									<option value="1 Bed + Den">1 Bed + Den</option>
									<option value="2 Bedrooms">2 Bedrooms</option>
									<option value="2 Bed Split">2 Bed Split</option>
									<option value="2 Bed + Den">2 Bed + Den</option>
									<option value="3 Bedrooms">3 Bedrooms</option>
									<option value="3 Bed Split">3 Bed Split</option>
									<option value="3 Bed + Den">3 Bed + Den</option>
									<option value="4 Bedrooms">4 Bedrooms</option>
									<option value="4 Bed Split">4 Bed Split</option>
									<option value="4 Bed + Den">4 Bed + Den</option>
									<option value="5 Bedrooms">5 Bedrooms</option>
									<option value="5 Bed Split">5 Bed Split</option>
									<option value="5 Bed + Den">5 Bed + Den</option>
									<option value="6 Bedrooms">6 Bedrooms</option>
									<option value="6 Bed Split">6 Bed Split</option>
									<option value="6 Bed + Den">6 Bed + Den</option>
									<option value="7 Bedrooms">7 Bedrooms</option>
									<option value="7 Bed Split">7 Bed Split</option>
									<option value="7 Bed + Den">7 Bed + Den</option>
									<option value="8 Bedrooms">8 Bedrooms</option>
									<option value="8 Bed Split">8 Bed Split</option>
									<option value="8 Bed + Den">8 Bed + Den</option>
									<option value="9 Bedrooms">9 Bedrooms</option>
									<option value="9 Bed Split">9 Bed Split</option>
									<option value="9 Bed + Den">9 Bed + Den</option>
									<option value="10+ Bedrooms">10+ Bedrooms</option>
								</select>';
					
						echo	'<select name="unitbathrooms[]" value="' . /* This Doesn't Matter */ '">
									<option value="1">1 Bath</option>
									<option value="1.5">1.5 Baths</option>
									<option value="2">2 Baths</option>
									<option value="2.5">2.5 Baths</option>
									<option value="3">3 Baths</option>
									<option value="3.5">3.5 Baths</option>
									<option value="4">4 Baths</option>
									<option value="4.5">4.5 Baths</option>
									<option value="5+">5+ Baths</option>
								</select>';
						
						echo '<br />';
						echo '<textarea name="unitdetails[]" rows="8" cols="60" placeholder="Unit Details Here..."></textarea>';
						
						echo '<br /><br />';
					
					} // END WHILE
					
					
				
				} // END IF
				
				echo '<input type="submit" name="PdbOMmNm0o" value="Save Unit Changes >>" />';
				echo '</form>';
				
			
				// Get Rows are more than 4, than only show 4 units. If, if 1 row exists, show it
				
				// If no unit info exists, show information
				
				// If Unit info exists, show information
			
			// Close DB Connection
			mysqli_close($con);
			
			?>
			
			
		</div>

		<div class="section">
		<br />
		<br />
		
		<h3>Unit Notes:</h3>
		
		<p>If you don't want unit information to show, don't fill out this page.</p>
		
		<p>You can edit unit information by making changes and clicking "Save Unit Changes".</p>
		
		<p>If you fill in Unit Information for 1 Unit, all Unit Information will automatically display. In other words, if the property has 3 units and you only enter information for 1 Unit, the other two units must be filled in or they will automatically appear blank.</p>
		
		<p>There is currently no way to DELETE a unit. I can add DELETE functionality if necessary.</p>
		
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>