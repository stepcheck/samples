<?php 	session_start(); 
		//If Session is not equal to administrator
		if($_SESSION['administrator'] != 'administrator') {
			header('Location: http://bostonpropertybuyers.com/user_dashboard_buyer.php');
			exit;
		}
?>
<?php include 'includes/header1.php'; ?>
<title>Add New Images & Files - Boston Property Buyers</title>
<meta name="robots" content="noindex">
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages3.jpg" border="0" />
		</div>

		<div class="section1">
			<h1>Welcome, <?php echo $_SESSION["email"]; ?>!</h1>
			
			<h2>Add Files To This Listing</h2>
			<p>This property ID is: <?php echo $_GET['propertyid']; ?></p>
			
			
	<button type="button" onClick="location.href='admin_edit_listing_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'"> &lt;&lt; Back To Edit This Listing</button>
	
	<button type="button" onClick="location.href='admin_dashboard.php'"> &lt;&lt; Back To Admin Dashboard</button>
	
	<button type="button" onClick="location.href='listing_details_page.php?propertyid=<?php echo $_GET['propertyid']; ?>'">View This Listing Page &gt;&gt;</button>
	
	
	
		<br />
		
	
	<?php
	//////////////////////// 	THIS IS TO DELETE ANY FILES (CLICK ON DELETE BUTTON) 	///////////////////////////
	

	include 'includes/delete_object.php';
	
	
	/////////////////////////////////////////		END DELETE FILE		 	///////////////////////////////////////
	
	//////////////////////// 	THIS IS TO UPLOAD ALL NEW FILES: IMAGES, PDF & EXCEL 	///////////////////////////
	
			//////////		FIRST, GET LISTING PATH		/////////////
			
		// STARTS DB CONNECTION FOR ENTIRE PAGE	
		include 'includes/database_connect.php'; 
	
		$propertyID = $_GET['propertyid'];
		$listingsTable = "prop_seller_listings";
		
		$getListingPath = "SELECT upload_path FROM $listingsTable WHERE seller_listing_id = '$propertyID'";
		
		$queryPath = mysqli_query($con, $getListingPath);
		
		$row = mysqli_fetch_assoc($queryPath);
		
		$listingPath = $row['upload_path']; // THIS IS THE LISTING PATH
		
	//////////		FINALLY, PROCESS THE FILE		/////////////
	
	// Check if form was submitted.
	if (isset($_POST["7jMnNo0mN"])) {
		echo '<div class="file-upload-notes">'; // Start div for any notes that are echod in the script
		// Build File path and Name
		$target_file = $listingPath . "/" . basename($_FILES["fileToUpload"]["name"]);
		$temp_file = $_FILES["fileToUpload"]["tmp_name"];
		$final_file = $_FILES["fileToUpload"]["name"];
		$size = $_FILES["fileToUpload"]["size"];
		
		// Make sure file exists
		if (file_exists($temp_file)) {
			
			// Get File Extension
			$fileExtension = pathinfo($final_file,PATHINFO_EXTENSION);
			
			// Use getimagesize() to check if the file is an image
			if (getimagesize($temp_file) !== false xor $fileExtension == "pdf" xor $fileExtension == "xls" xor $fileExtension == "xlsx" xor
														$fileExtension == "PDF" xor $fileExtension == "XLS" xor $fileExtension == "XLSX" xor
														$fileExtension == "Pdf" xor $fileExtension == "Xls" xor $fileExtension == "Xlsx") { // Does not equal false
				
				// Get File Type (PNG, GIF, JPG, JPEG)
				if ($fileExtension == "jpg" xor $fileExtension == "JPG" xor $fileExtension == "Jpg" xor $fileExtension == "png" xor 
				$fileExtension == "PNG" xor $fileExtension == "Png" xor $fileExtension == "jpeg" xor $fileExtension == "JPEG" xor 
				$fileExtension == "Jpeg" xor $fileExtension == "gif" xor $fileExtension == "GIF" xor $fileExtension == "Gif" xor 
				$fileExtension == "pdf" xor $fileExtension == "PDF" xor $fileExtension == "xls" xor $fileExtension == "XLS" xor 
				$fileExtension == "Xls" xor $fileExtension == "xlsx" xor $fileExtension == "XLSX" xor $fileExtension == "Xlsx") {
				
					///////// Prepare File Type For Database //////////////
					if ($fileExtension == "jpg" xor $fileExtension == "png" xor $fileExtension == "jpeg" xor $fileExtension == "gif" xor
						$fileExtension == "JPG" xor $fileExtension == "PNG" xor $fileExtension == "JPEG" xor $fileExtension == "GIF" xor
						$fileExtension == "Jpg" xor $fileExtension == "Png" xor $fileExtension == "Jpeg" xor $fileExtension == "Gif") {
						
						$db_file_type = 'image';
					}
					if ($fileExtension == "pdf" xor $fileExtension == "PDF") {
						$db_file_type = 'pdf';
					}
					if ($fileExtension == "xls" xor $fileExtension == "xlsx" xor $fileExtension == "XLS" xor $fileExtension == "XLSX") {
						$db_file_type = 'spreadsheet';
					}
					////////// END Prepare Filetype /////////////
				
				
					// Make sure file size is less than 10MB
					if ($size < 10000000) {
					
						if(!file_exists($target_file)) {
					
							// 3. Upload the Image To Server
							if (move_uploaded_file($temp_file, $target_file)) {
								echo '<span class="note-green">Success! The file ' . basename($final_file). ' has been uploaded to the server. </span>';
							
								// 4. Put the Image in the Database
								$fileTable = "user_file_uploads";
								$addImageDB = "INSERT INTO $fileTable (
																	listing_id_key,
																	file_type,
																	file_size,
																	file_name) 
																	VALUES (
																	'$propertyID',
																	'$db_file_type',
																	'$size',
																	'$final_file')";
								mysqli_query($con, $addImageDB);
							
								echo '<span class="note-green">It has also been added to the database.</span>';
							
							} // Move Uploaded File From Temp To Desired Directory
							else {
								echo '<span class="note-red">Sorry, there was an error uploading your file to the server. Because of error, it was also not uploaded to database.<span>';
							}
						}
						else {
								echo '<span class="note-red">Sorry, this filename already exists, please choose another file or rename this file.<span>';
							}

					} // END if File is Smaller Than 10MB
					else {
					echo '<span class="note-red">Sorry, image is too large. Files must be less than 10 MegaBytes!</span>';
					}
				} // End If Filetype = jpg, png, jpeg, gif
				else {
					echo 'echo <span class="note-red">Sorry, wrong file-type. Only PDFs, Excel Files and Images are allowed.</span>';
				}
			} // End If File = Image
			else {
				echo '<span class="note-red">Sorry, wrong file-type. Only PDFs, Excel Files and Images are allowed.</span>';
			}
		} // End if File exists in directory
		else {
			echo '<span class="note-red">Sorry, nothing was uploaded! Please select a file first!</span>';
		}
	echo '</div>';
	} // End if Form Submitted
	
	///////////////////////////////////// 	UPLOAD EMBED GOOGLE CODE	 ///////////////////////////////////////////////////
	
	if (isset($_POST["9OaSfnMNsmM"])) {
		if (isset($_POST["embedcode"])) {
			if ($_SESSION['administrator'] == 'administrator') {
				
				$embed_code = $_POST["embedcode"];
				$file_type_embed = 'embeded';
				
				$fileTable = "user_file_uploads";
				$addEmbedDB = "INSERT INTO $fileTable (
													listing_id_key,
													file_type,
													file_embed_code
													) 
													VALUES (
													'$propertyID',
													'$file_type_embed',
													'$embed_code'
													)";
								mysqli_query($con, $addEmbedDB);
				echo '<span class="note-green">Note: A Google Document has been embedded into the listing!</span>';
			}
			else {
				echo '<span class="note-red">Sorry, only administrators can embed files. If you are an administrator, you must login.</span>';
			}
		}
		else {
			echo '<span class="note-red">The embed field was empty. Please try again.</span>';
		}
	}
	
	
	
	///////////////////////////////////// 	END UPLOAD ALL FILE TYPES	 ///////////////////////////////////////////////////
	
	?>
	
	<!-- Form For All Uploads-->
	<div class="upload-form">
		<form action="admin_add_images_listing_page.php?propertyid=<?php echo $propertyID; ?>" method="post" enctype="multipart/form-data">
			Select File To Upload:
			<input type="file" name="fileToUpload" id="fileToUpload">
			<input type="submit" value="Upload File" name="7jMnNo0mN">
		</form>
	<span class="note-tiny">Note: Only JPEG, JPG, PNG, GIF, PDF and XLS Files Can Be Uploaded</span>
	</div>
	<!-- End Form For All Uploads-->
	
	
	
	<h2>Images Uploads For This Property</h2>
	<div class="upload-image-container">
	
	<?php
	/////////////////////////////// 	THIS IS TO LOAD IMAGES ONTO THE PAGE 	/////////////////////////////////
	
	if (isset($_GET['propertyid'])) {
	


		//////////		SECOND, GET ALL IMAGES FOR LISTINGS & SHOW ON PAGE		/////////////
		
		$table = "user_file_uploads";
		
		$getImages = "SELECT * FROM $table WHERE listing_id_key = '$propertyID' AND file_type = 'image'";
		
		$listingImages = mysqli_query($con, $getImages);
		
		$countImageRows = mysqli_num_rows($listingImages);
		
			if ($countImageRows > 0) {
				while($row = mysqli_fetch_assoc($listingImages)) {

					echo '<div class="image-on-upload-page"><img src="http://bostonpropertybuyers.com/' . $listingPath .'/' . $row['file_name'] . '" border="0" class="tableimage"/>
					
					<div class="file-delete-icon">
					<a href="admin_add_images_listing_page.php?deletefile=yes&fileid=' . $row['file_id'] . '&propertyid=' . $_GET['propertyid'] . '">
					<img src="images/delete-button.png" height="20" width="20" /></a>
					</div>
					
					</div>';

				}
			} // End If Images Exist
			else {
				echo '<span class="note-red">No images are currently uploaded for this property.</span>';
			}
			
			
	}
	
	?>
	</div>
	
	<h2>PDF Uploads For This Property:</h2>
	<div class="upload-image-container">
	<?php
	/////////////////////////////// 	THIS IS TO LOAD PDF'S ONTO THE PAGE 	/////////////////////////////////
	$table = "user_file_uploads";
		
		$getPDFs = "SELECT * FROM $table WHERE listing_id_key = '$propertyID' AND file_type = 'pdf'";
		
		$listingPDFs = mysqli_query($con, $getPDFs);
		
		$countPDFsRows = mysqli_num_rows($listingPDFs);
		
			if ($countPDFsRows > 0) {
				while($row = mysqli_fetch_assoc($listingPDFs)) {

					echo '<div class="image-on-upload-page"><a href="http://bostonpropertybuyers.com/' . $listingPath .'/' . $row['file_name'] . '" target="_blank"><img src="images/pdf_icon.png" border="0" class="tableimage" /></a>
					
					<div class="file-delete-icon">
					<a href="admin_add_images_listing_page.php?deletefile=yes&fileid=' . $row['file_id'] . '&propertyid=' . $_GET['propertyid'] . '">
					<img src="images/delete-button.png" height="20" width="20" /></a>
					</div>
					
					</div>';

				}
			} // End If Images Exist
			else {
				echo '<span class="note-red">No PDFs are currently uploaded for this property.</span>';
			}
	
	
	?>
	</div>
	<h3>Excel File Uploads For This Property:</h3>
	<div class="upload-image-container">
	<?php
	///////////////////////////// 	THIS IS TO LOAD EXCEL FILES'S ONTO THE PAGE 	///////////////////////////////

	$table = "user_file_uploads";
		
		$getExcels = "SELECT * FROM $table WHERE listing_id_key = '$propertyID' AND file_type = 'spreadsheet'";
		
		$listingExcels = mysqli_query($con, $getExcels);
		
		$countExcelsRows = mysqli_num_rows($listingExcels);
		
			if ($countExcelsRows > 0) {
				while($row = mysqli_fetch_assoc($listingExcels)) {

					echo '<div class="image-on-upload-page"><a href="http://bostonpropertybuyers.com/' . $listingPath .'/' . $row['file_name'] . '" target="_blank"><img src="images/excel_icon.png" border="0" class="tableimage" /></a>
					
					<div class="file-delete-icon">
					<a href="admin_add_images_listing_page.php?deletefile=yes&fileid=' . $row['file_id'] . '&propertyid=' . $_GET['propertyid'] . '">
					<img src="images/delete-button.png" height="20" width="20" /></a>
					</div>
					
					</div>';

				}
			} // End If Images Exist
			else {
				echo '<span class="note-red">No Excel Files are currently uploaded for this property.</span>';
			}
	
	
	
	?>
	</div>
	<h3>Google Embedable Documents: (This Will Automatically Embed A Google Document On Listing Page)</h3>
	
	
	<!-- Form For All Uploads-->
	<div class="upload-form">
		<form action="admin_add_images_listing_page.php?propertyid=<?php echo $propertyID; ?>" method="post">
			<table>
				<tr>
					<td>
						<textarea name="embedcode" rows="4" cols="80"/></textarea>
					</td>
					<td>
						<input type="submit" value="Upload Embed Code" name="9OaSfnMNsmM">
					</td>
				<tr>
			</table>
		</form>
	<span class="note-tiny">Note: Paste Entire Embed Code Into Field & Hit Upload</span>
	</div>
	<!-- End Form For All Uploads-->
	
	
	<div class="upload-image-container">
	<?php
	
	
	$table = "user_file_uploads";
		
		$getEmbeds = "SELECT * FROM $table WHERE listing_id_key = '$propertyID' AND file_type = 'embeded'";
		
		$listingEmbeds = mysqli_query($con, $getEmbeds);
		
		$countEmbedRows = mysqli_num_rows($listingEmbeds);
		
			if ($countEmbedRows > 0) {
				while($row = mysqli_fetch_assoc($listingEmbeds)) {

					echo '<div class="image-on-upload-page"><img src="images/embed_icon.png" border="0" class="tableimage" alt="Can Only View On Property Details Page" title="Can Only View On Property Details Page" />
					
					<div class="file-delete-icon">
					<a href="admin_add_images_listing_page.php?deletefile=yes&filetype=embed&fileid=' . $row['file_id'] . '&propertyid=' . $_GET['propertyid'] . '">
					<img src="images/delete-button.png" height="20" width="20" /></a>
					</div>
					
					</div>';

				}
			} // End If Images Exist
			else {
				echo '<span class="note-red">No Embeded Files are currently uploaded for this property.</span>';
			}
	
	
	mysqli_close($con); // CLOSES DB CONNECTION FOR ENTIRE PAGE
	?>
	</div>
			
		</div>
		

		<div class="section">
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>