<?php 	session_start(); 
		//If Session is not equal to administrator
		if(!isset($_SESSION['email'])) {
			header('Location: http://bostonpropertybuyers.com/index.php');
			exit;
		}
?>
<?php include 'includes/header1.php'; ?>
<title>Private Marketplace Listings - Boston Property Buyers</title>
<meta name="robots" content="noindex">
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Welcome, <?php echo $_SESSION["email"]; ?>!</h1>
			
			<h2>The Marketplace</h2>
			
		</div>
			
		<div class="section">
	
	<form id="form1" name="form1" method="get" action="marketplace_listings.php" >
		<div class="marketplace-search-form-container">
			<table>
				<tr>
					<?php 
					//////////////////////////////////////////		LOAD SEARCH FORM		/////////////////////////////////////////////////////
						
							// Create PreSelected Values For Form:
					
								// Get Property Type Values
								$PT_1 = $_GET['PT1']; // Condo
								$PT_2 = $_GET['PT2']; // Single Family
								$PT_3 = $_GET['PT3']; // Multi-Family
								$PT_4 = $_GET['PT4']; // Commercial
								$PT_5 = $_GET['PT5']; // Land
								$PT_6 = $_GET['PT6']; // Other
							
							// Get Listing Price Range Value
							
								$LP_1 = $_GET['LP1']; // $0 - $250K
								$LP_2 = $_GET['LP2']; // $250K - $500K
								$LP_3 = $_GET['LP3']; // $500K - $1 Million
								$LP_4 = $_GET['LP4']; // $1 Million - $2 Million
								$LP_5 = $_GET['LP5']; // $2 Million - $5 Million
								$LP_6 = $_GET['LP6']; // $5 Million - $10 Million
								$LP_7 = $_GET['LP7']; // $10 Million +
						
					?>
					
					<td><strong>Search:</strong></td>
					<td>
						<div class="search-input-place-holder">
							<div class="dropchex-main-box">
								<div class="dropchex-title">Property Types:</div>
								<div class="one-checkbox"><input type="checkbox" name="PT1" value="Condo" 
								<?php if($PT_1 == 'Condo') {echo 'checked';} ?>>Condo</div>
								<div class="one-checkbox"><input type="checkbox" name="PT2" value="Single Family"
								<?php if($PT_2 == 'Single Family') {echo 'checked';} ?>>Single Family</div>
								<div class="one-checkbox"><input type="checkbox" name="PT3" value="Multi-Family" 
								<?php if($PT_3 == 'Multi-Family') {echo 'checked';} ?>>Multi-Family</div>
								<div class="one-checkbox"><input type="checkbox" name="PT4" value="Commercial"
								<?php if($PT_4 == 'Commercial') {echo 'checked';} ?>>Commercial</div>
								<div class="one-checkbox"><input type="checkbox" name="PT5" value="Land"
								<?php if($PT_5 == 'Land') {echo 'checked';} ?>>Land</div>
								<div class="one-checkbox"><input type="checkbox" name="PT6" value="Other"
								<?php if($PT_6 == 'Other') {echo 'checked';} ?>>Other</div>
							</div>
						</div>
					</td>
					<?php
					
					?>
					<td>
						<div class="search-input-place-holder">
							<div class="dropchex-main-box">
								<div class="dropchex-title">Listing Price:</div>
								<div class="one-checkbox"><input type="checkbox" name="LP1" value="0-250"
								<?php if($LP_1 == '0-250') {echo 'checked';} ?>>$0 - $250K</div>
								<div class="one-checkbox"><input type="checkbox" name="LP2" value="250-500"
								<?php if($LP_2 == '250-500') {echo 'checked';} ?>>$250K - $500K</div>
								<div class="one-checkbox"><input type="checkbox" name="LP3" value="500-1M"
								<?php if($LP_3 == '500-1M') {echo 'checked';} ?>>$500K - $1 Million</div>
								<div class="one-checkbox"><input type="checkbox" name="LP4" value="1M-2M"
								<?php if($LP_4 == '1M-2M') {echo 'checked';} ?>>$1 Million - $2 Million</div>
								<div class="one-checkbox"><input type="checkbox" name="LP5" value="2M-5M"
								<?php if($LP_5 == '2M-5M') {echo 'checked';} ?>>$2 Million - $5 Million</div>
								<div class="one-checkbox"><input type="checkbox" name="LP6" value="5M-10M"
								<?php if($LP_6 == '5M-10M') {echo 'checked';} ?>>$5 Million - $10 Million</div>
								<div class="one-checkbox"><input type="checkbox" name="LP7" value="10Mplus"
								<?php if($LP_7 == '10Mplus') {echo 'checked';} ?>>$10 Million +</div>
								</div>
						</div>
					</td>
					<td>
						<input type="submit" name="64nM03Xo" value="Search >>" />
					</td>
					
				</tr>
			</table>
		</div>
	</form>
	
	<?php
/////////////////////////////////////	END LOAD SEARCH FORM	////////////////////////////////////////////////////


/////////////////////////////////////	THIS IS TO DO A CUSTOM SEARCH	////////////////////////////////////////
	// If Form Was Submitted
	include 'includes/database_connect.php';
	
	if (isset($_GET['64nM03Xo'])) {
		/////////////////////////	IF FORM WAS SUBMITTED   	/////////////////////////////////
		
		////// GET Property Type Values /////////
			
			if (	$_GET['PT1'] == "Condo" or  $_GET['PT2'] == "Single Family" or  $_GET['PT3'] == "Multi-Family" or 
					$_GET['PT4'] == "Commercial" or  $_GET['PT5'] == "Land" or  $_GET['PT6'] == "Other") { 
				
				$PropType = array();
				
				if($_GET['PT1'] == "Condo") {
					$PropType[] = "(property_type = 'Condo')";
				}
				if($_GET['PT2'] == "Single Family") {
					$PropType[] = "(property_type = 'Single Family')";
				}
				if($_GET['PT3'] == "Multi-Family") {
					$PropType[] = "(property_type = 'Multi-Family')";
				}
				if($_GET['PT4'] == "Commercial") {
					$PropType[] = "(property_type = 'Commercial')";
				}
				if($_GET['PT5'] == "Land") {
					$PropType[] = "(property_type = 'Land')";
				}
				if($_GET['PT6'] == "Other") {
					$PropType[] = "(property_type = 'Other')";
				}
				$where_PropType = '(' . implode(' OR ', $PropType) . ') AND';
			}
			else {
				$where_PropType = '';
			}
			
		////// GET Property Price Range Values /////////$PriceRange
		
			if (	$_GET['LP1'] == "0-250" or $_GET['LP2'] == "250-500" or $_GET['LP3'] == "500-1M" or $_GET['LP4'] == "1M-2M" or 
					$_GET['LP5'] == "2M-5M" or $_GET['LP6'] == "5M-10M" or $_GET['LP7'] == "10Mplus") {
				
				$PriceRange = array();
			
				if($_GET['LP1'] == "0-250") {
					$Low1 	= "0";
					$High1	= "250000";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low1' AND '$High1')";
				}
				if($_GET['LP2'] == "250-500") {
					$Low2 	= "250000";
					$High2	= "500000";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low2' AND '$High2')";
				}
				if($_GET['LP3'] == "500-1M") {
					$Low3 	= "500000";
					$High3	= "1000000";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low3' AND '$High3')";
				}
				if($_GET['LP4'] == "1M-2M") {
					$Low4 	= "1000000";
					$High4	= "2000000";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low4' AND '$High4')";
				}
				if($_GET['LP5'] == "2M-5M") {
					$Low5	= "2000000";
					$High5	= "5000000";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low5' AND '$High5')";
				}
				if($_GET['LP6'] == "5M-10M") {
					$Low6 	= "5000000";
					$High6	= "10000000";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low6' AND '$High6')";
				}
				if($_GET['LP7'] == "10Mplus") {
					$Low7 	= "10000000";
					$High7	= "99999999999";
					
					$PriceRange[] = "(price_for_sale BETWEEN '$Low7' AND '$High7')";
				}
				$where_PriceRange = '(' . implode(' OR ', $PriceRange) . ') AND';
			
			} else {
				$where_PriceRange = '';
			}
			
			
		////// END GET VALUES ///////
			$listingsTable = "prop_seller_listings";
			
			$customSelectSQL = "SELECT * FROM $listingsTable WHERE  
														$where_PropType
														$where_PriceRange
														(listing_active 	=	'yes')";
														
			$result = mysqli_query($con, $customSelectSQL);
						
			$numberofrows = mysqli_num_rows($result);
	
	} else {
	
		/////////////////////////	IF FORM WAS NOT SUBMITTED	/////////////////////////////////
		/////////////////////////	THIS IS A REGULAR/DEFAULT SEARCH ////////////////////////////
	
			$table = 'prop_seller_listings';
					
			$sql = "SELECT * FROM $table WHERE listing_active='yes' ";
						
			$result = mysqli_query($con, $sql);
						
			$numberofrows = mysqli_num_rows($result);
		
	}


?>
			
<?php 	

					if ($numberofrows > 0) {
					
						echo 	'<table class="marketplace-listings-table">' .  // open table
								
									'<tr>' . 
								
								'<th>' . 'Image:' . '</th>' .
								'<th>' . 'Property Location:' . '</th>' . 
								'<th>' . 'Type:' . '</th>' . 
								'<th>' . 'Units:' . '</th>' . 
								'<th>' . 'Listing Price:' . '</th>' .
								'<th>' . 'Cap Rate:' . '</th>' .
								'<th>' . 'NOI:' . '</th>' . 
								'<th>' . 'More Details:' . '</th>' . 
									
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
											
											echo '" border="0" class="tableimage"/>' .
										'</a>' .
									'</td>' . 
									
									'<td>' . 
										'<a href="listing_details_page.php?propertyid=' . $row["seller_listing_id"] .'">' . 
											ucwords(strtolower($row["property_street_name"])) . ', ' . ucwords(strtolower($row["property_city"])) . ', ' . 
											strtoupper($row["property_state"]) . ' ' . $row["property_zip"] . 
										'</a>' .
									'</td>' . 
									
									'<td>' . 
										$row["property_type"] . 
									'</td>' . 
									
									'<td>' . 
										$row['number_units'] . 
									'</td>' . 
									
									'<td>' . 
										'$' . number_format($row["price_for_sale"]) . 
									'</td>' . 
									
									'<td>' . 
										$row['property_cap_rate']  . " %"  . 
									'</td>' . 
									
									'<td>' . 
										'$' . number_format($row['property_NOI']) . 
									'</td>' . 
									
									'<td>' . 
										'<a href="listing_details_page.php?propertyid=' . $row["seller_listing_id"] .'">View Details >></a>' . 
									'</td>' . 
									
								'</tr>';
						} // END WHILE
						
						echo '</table>'; // close table
						
					} // END IF Results > 0
					else {
							echo '<span class="note-red">Sorry, there are no listings. Please try another search!</span>';
							echo '<br /><br /><br /><br />';
					} // END ELSE Results = 0
				
				mysqli_close($con);
				
				// For Testing Purposes:
				 echo "<br /><br /><br /><br />";
				 echo $_GET['searchpropertytype'];
				 echo $_GET['searchsaleprice'];
				 
				 
				// echo $setSalePrice;
			
?>
			
		</div>

		<div class="section">
		
		<p>These are PRIVATE listings. Per our user agreement, we do not authorize the use or share of this information with 
		any third parties that have not signed up, and been approved, with BostonPropertyBuyers.com. Please do not share
		this information with any other individuals, organizations or businesses.</p>
		
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>