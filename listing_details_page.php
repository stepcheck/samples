<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
<title>Property Details - Boston Property Buyers</title>
<meta name="robots" content="noindex">

<script src="js/1-11-2jquery.min.js" type="text/javascript"></script>
<script src="js/chriswork.js" type="text/javascript"></script>

<?php include 'includes/header2.php'; ?>

<div class="page-area">


	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages3.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Property Details</h1>
			
			
			
	<?php
	///////////////////////////////		FORM SUBMISSION CODE (FOR CLIENT INQUIRY BOX) 		///////////////////////////////
	
	// If Form was submitted
	if (isset($_POST['InfoRequestForm'])) {
		// If CAPTCHA filled out properly
		if ($_POST['unicornberries'] == '54H') {
			// If Honeypot is Empty
			if (empty($_POST['email']) || !isset($_POST['email'])) {
				
				// Include Code To Send Email To Jarrett
				include 'includes/contact_form_inquiry_property_details_page.php';
				
				// Put Success Note On Page
				echo '<span class="note-green">Message Sent! We will contact you soon!</span>';
				echo '<br /><br />';
			} // End If Honeypot is Empty
			else {
				echo '<span class="note-red">Sorry, something is wrong with submitting your email!</span>';
			}
		}
		else {
			echo '<span class="note-red">Sorry, you did not fill out the CAPTCHA properly.</span>';
		}
		
	
	} ///////////////////		END FORM SUBMISSION CODE	  /////////////////////////////
	
	
	
	/////////////////////////////////		GET ALL INFORMATION FOR THIS PROPERTY 		//////////////////////////////

	if (isset($_GET['propertyid'])) {
	
		$listingid = $_GET['propertyid'];
	
		$table = 'prop_seller_listings';
		
		include 'includes/database_connect.php';
		
		$query = "SELECT * FROM $table WHERE seller_listing_id = '$listingid'";

		$result = mysqli_query($con, $query);
 
		while($row = mysqli_fetch_assoc($result)) {

			$this_listing_street = 		ucwords(strtolower($row['property_street_name']));
			$this_listing_city = 		ucwords(strtolower($row['property_city']));
			$this_listing_state = 		strtoupper($row['property_state']);
			$this_listing_zip = 		$row['property_zip'];
			$this_listing_type = 		$row['property_type'];
			$this_listing_sq_ft = 		number_format($row['total_sq_ft']);
			$this_listing_num_units = 	$row['number_units'];
			$this_listing_price = 		number_format($row['price_for_sale']);
			$this_listing_taxes =		number_format($row['property_taxes']);
			$this_listing_condo_fee =	number_format($row['condo_fee']);
			$this_listing_cap_rate = 	$row['property_cap_rate'];
			$this_listing_NOI = 		number_format($row['property_NOI']);
			$this_listing_details = 	$row['property_details'];
			$this_listing_featured = 	$row['featured'];
			$this_listing_img_path =	$row['upload_path'];

		}

		// If error exists, print it out bitch

		if (!$result) {
			printf("Error: %s\n", mysqli_error($con));
			exit();
		}
		
		// Close connection
		mysqli_close($con);
	
		/////////////////////////////////		GENERATE PAGE DYNAMIC HEADER		///////////////////////////////////////
		
		echo "<h2>" . $this_listing_type . " in " . $this_listing_city . ", " . $this_listing_state . " for " . '$' . $this_listing_price . "</h2>";

	}
	else {
		echo '<h2>Error 107</h2>';
		echo '<span class="note-red">Sorry, there was an error loading this page.</span>';
		echo '<span class="note-red">Please go back and click the link again. </span>';
		echo '<br /><br />';
		echo '<span class="note-red">You may need to login again. </span>';
	}

	?>
	
	<?php
	
		//////////////////////////////////	THIS IS TO LOAD IMAGES FOR THIS PROPERTY	////////////////////////////////////
		// Image Hover Effect Comes From http://fiddle.jshell.net/Gkjx2/
		
		include 'includes/database_connect.php';
		$imageTable = "user_file_uploads";
		
		// THIS GETS DEFAULT IMAGE
		
		$getDefaultImage = "SELECT file_name FROM $imageTable WHERE listing_id_key = $listingid AND file_type ='image'";
											
		$getImageQuery = mysqli_query($con, $getDefaultImage);
		
			if($getImageQuery === FALSE) { 
				die(mysqli_error()); // TODO: better error handling
			}

		$rowP2 = mysqli_fetch_array($getImageQuery, MYSQLI_NUM);
		
		$myNumRowsImages = mysqli_num_rows($getImageQuery);
											
			// First, Get Default Image						
			if($myNumRowsImages != 0) {
				
				echo '<div class="entireImageHoverContainer">';
				
				//	Echo Default Image class
				echo '<div id="imgHolder">';
				echo '<img src="' . $this_listing_img_path . "/" . $rowP2["0"] . '" alt="" class="details-large-image">';
				echo '</div>';
			}
		
		// END GET DEFAULT IMAGE
		
		// THIS GETS ALL THUMBNAIL IMAGES
		
		// $listingid Pulls from Above
		$getThumbImages = "SELECT * FROM $imageTable WHERE listing_id_key = $listingid AND file_type ='image'";		
		$runImageQuery = mysqli_query($con, $getThumbImages);									
		$numRowsImages = mysqli_num_rows($runImageQuery);
								
		
		// If Any Images exist in System, Run Images System
		if($numRowsImages > 0) {
		
			
			// Second, Open holding DIV for all Thumbnail images (Including default image)
			echo '<div id="imgThumbs">';
			
			// Third, Echo All Images As Thumbnails
			while($rowQ2 = mysqli_fetch_assoc($runImageQuery)) {
				echo '<a href="#" class="showImg"><img src="' . $this_listing_img_path . "/" . $rowQ2["file_name"] . '" class="details-page-image" border ="0" /></a>';
			} // End While
			
			// Finally, Close holding DIV for all thumbnails & .entireImageHoverContainer
			echo '</div>'; // Close .imgThumbs
			echo '</div>'; // Close .entireImageHoverContainer
			
		} //	End If rows > 0
		
		mysqli_close($con);
		
		/////////////////////////////////////////	END LOAD IMAGES 	////////////////////////////////////////////////////	
	?>
	
	<h2>Property Details:</h2>
	
	<p><span class="p-leader">Property Street:</span>  <?php echo ucwords(strtolower($this_listing_street)); ?></p>
	<p><span class="p-leader">Property Type:</span> <?php echo $this_listing_type; ?></p>
	<?php /* Square Feet */ if(!empty($this_listing_sq_ft)) { echo '<p><span class="p-leader">Square Feet: </span>' . $this_listing_sq_ft . 'Sq/Ft</p>'; } ?>
	<p><span class="p-leader">Price For Sale:</span> <?php echo '$' . $this_listing_price; ?></p>
	<?php /* Property Taxes */ if(!empty($this_listing_taxes)) { echo '<p><span class="p-leader">Property Taxes: </span> $' . $this_listing_taxes . '</p>'; } ?>
	<?php /* Condo Fees */ if(!empty($this_listing_condo_fee)) { echo '<p><span class="p-leader">Condo Fees: </span> $' . $this_listing_condo_fee . '</p>'; } ?>
	<p><span class="p-leader">Capitalization Rate:</span> <?php echo $this_listing_cap_rate . " %"; ?></p>
	<p><span class="p-leader">Net Operating Income (NOI):</span> <?php echo '$' . $this_listing_NOI; ?></p>
	<p><span class="p-leader">Featured:</span>  <?php echo ucwords(strtolower($this_listing_featured)); ?></p>
	
	<p><span class="p-leader">Number of Units:</span> <?php echo $this_listing_num_units; ?></p>
	
	<?php
		/////	THIS IS TO LOAD INDIVIDUAL UNIT INFORMATION		///////
		
		// Connect to DB
		include 'includes/database_connect.php';
		
		$listingid = $_GET['propertyid'];
	
		$unitTable = "listing_unit_info";
		$getUnitInfoSQL = "SELECT * FROM $unitTable WHERE listing_id = '$listingid'";		
		$runUnitQuery = mysqli_query($con, $getUnitInfoSQL);									
		$unitCount = mysqli_num_rows($runUnitQuery);
	
		// If Unit Info Exists
		if ($unitCount > 0) {
			
			// Style The Font Size/Color of Unit Information
			echo '<div class="unit-info-smaller-grey">';
			
			// Get Unit Dtails
			$increment = 1;
			while($row = mysqli_fetch_assoc($runUnitQuery)) {
			
				echo '<strong>Unit #' . $increment . ': </strong>' . $row['num_of_beds'] . ' Beds, ' . $row['num_of_baths'] . ' Baths <br />
				<strong>Details: </strong>' . $row['unit_details'] . '<br /><br />';
			
				$increment++;
			} // End While
			
			// End Styling Unit Info
			echo '</div>';

		} // End If Unit
		
		//Close DB Connection
		mysqli_close($con);
	
	?>
	
	<p><span class="p-leader">More Details:</span> <?php echo $this_listing_details; ?></p>
	 <br />
	 <br />
	 
	 <?php
		
		/////////////////////			THIS IS TO PUT PDF, SPREADSHEET AND EMBED ON PAGE		/////////////////////////////////
		
		include 'includes/database_connect.php';
		$fileTable = "user_file_uploads";
		
		// GET PDFs IN DATABASE
		$getPDFfiles = "SELECT * FROM $fileTable WHERE listing_id_key = $listingid AND file_type ='pdf'";		
		$runPDFQuery = mysqli_query($con, $getPDFfiles);									
		$numRowsPDFs = mysqli_num_rows($runPDFQuery);
		
			if ($numRowsPDFs > 0) {
				echo '<h3>PDF Documents: (Click to view)</h3>';
				while($rowPDF = mysqli_fetch_assoc($runPDFQuery)) {
					
					echo '<div class="image-on-upload-page">
					<a href="' . $this_listing_img_path . "/" . $rowPDF["file_name"] . '" target="_blank">
					<img src="images/pdf_icon.png" border="0" class="tableimage" />
					</a>
					</div>';
					
				}
			}
		
		// GET SPREADSHEETs IN DATABASE
		$getSpreadsheets = "SELECT * FROM $fileTable WHERE listing_id_key = $listingid AND file_type ='spreadsheet'";		
		$runExcelQuery = mysqli_query($con, $getSpreadsheets);									
		$numRowsExcels = mysqli_num_rows($runExcelQuery);
		
			if ($numRowsExcels > 0) {
				echo '<h3>Excel Documents: (Downloadable)</h3>';
				while($rowEX = mysqli_fetch_assoc($runExcelQuery)) {
					
					echo '<div class="image-on-upload-page">
					<a href="' . $this_listing_img_path . "/" . $rowEX["file_name"] . '">
					<img src="images/excel_icon.png" border="0" class="tableimage" />
					</a>
					</div>';
					
				}
			}
		
		// GET EMBED FILES IN DATABASE
		$getEmbeded = "SELECT * FROM $fileTable WHERE listing_id_key = $listingid AND file_type ='embeded'";		
		$runEmbededQuery = mysqli_query($con, $getEmbeded);									
		$numRowsEmbeds = mysqli_num_rows($runEmbededQuery);
		
			if ($numRowsEmbeds > 0) {
				echo '<h3>More Documentation:</h3>';
				while($rowEM = mysqli_fetch_assoc($runEmbededQuery)) {
					
					echo '<br /><br />';
					echo $rowEM['file_embed_code'];
					echo '<br /><br />';
					
					
				}
			}
		
		mysqli_close($con);
	 
	 ?>
	 <br />
	 <br />
	 <br />
	 <br />
	<?php
	////////////////////		Google Maps		/////////////////////////////////
		$this_listing_street = str_replace(' ', '', $this_listing_street);
		$completeAddress = $this_listing_street . ',' . $this_listing_city . ',' . $this_listing_state;
		echo '<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.it/maps?q=' . $completeAddress . '&output=embed"></iframe>';
		
		/*
		$completeAddress = $dlocation; // Google HQ
        $prepAddr = str_replace(' ','+',$completeAddress);
        $geocode=file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
        $output= json_decode($geocode);
        $latitude = $output->results[0]->geometry->location->lat;
        $longitude = $output->results[0]->geometry->location->lng;
		
		echo '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=&layer=c&cbll=' . $latitude . ',' . $longitude . '&cbp=11,0,0,0,0&ll=' . $latitude . ',' . $longitude . '&z=10"></iframe>';
		
			
		*/
?>
	
	 <br />
	 <br />

	<div class="contact-form-property">
		<h4>Interested? Contact Us!</h4>
		<form id="form1" name="form1" method="post" action="listing_details_page.php?propertyid=<?php echo $listingid; ?>">
			<table>
				<tr>
					<td><strong>Property:</strong></td>
					<td colspan="3"><?php echo $this_listing_type . " in " . $this_listing_city . ", " . $this_listing_state . " for " . '$' . $this_listing_price; ?></td>
				</tr>
				<tr>
					<?php if (isset($_SESSION['email'])) { 
						echo '<tr>';
							echo '<td><strong>Email:</strong></td>';
							echo '<td>' . $_SESSION['email'] . '</td>';
						echo '</tr>';
					}  // END IF SESSION EXISTS
					else {
						
						echo '<tr>';
							echo '<td><strong>First Name:</strong></td>';
							echo '<td><input type="text" name="formfirstname" /></td>';
							echo '<td><strong>Last Name:</strong></td> ';
							echo '<td><input type="text" name="formlastname" /></td>';
						echo '</tr>';
							
						echo '<tr>';
							echo '<td><strong>Email:</strong></td>';
							echo '<td><input type="text" name="formemailaddress" /></td>';
							echo '<td><strong>Phone:</strong></td> ';
							echo '<td><input type="text" name="formphone" /></td>';
						echo '</tr>';
					
					}
					?>
				
				<tr>
					<td valign="top"><strong>Message:</strong></td>
					<td colspan="3"><textarea name="propinquirymessage" rows="5" cols="58">Please contact me about this property...</textarea></td>
					<input type="text" name="email" class="email"/>
				</tr>
				
				<?php 
					if (!isset($_SESSION['email'])) { 
						echo '<tr>';
							echo '<td colspan="4"><img src="images/catdog.jpg" border="0" align="absmiddle" width="84px" height="32px" />&nbsp;&nbsp;&nbsp;
							<input type="text" name="unicornberries" maxlength="4" size="4"/>&nbsp;&nbsp;CAPTCHA (For Security)</td>';
						echo '</tr>';
					} 
				?>
				
				<tr>
					<td colspan="2"><input type="submit" name="InfoRequestForm" value="Request Information >>" /></td>
				</tr>
			</table>
		</form>
	</div>
	
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>