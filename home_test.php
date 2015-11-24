<?php session_start(); ?>
<?php include 'includes/header1.php'; ?>
	<title>How It Works - Boston Property Buyers</title>
	
<?php include 'includes/header2.php'; ?>

<div class="page-area">

	<div class="body">

		<div class="main-homepage-image">
			<img class="main-image" src="images/inside-pages2.jpg" border="0" />
		</div>

		
		<div class="section1">
			<h1>Looking for your next investment property?</h1>
			<h2>How It Works:</h2>
		
			<p>Bostonpropertybuyers.com gives qualified buyers access to an exclusive database of high quality off market (Non-MLS) properties to purchase.</p>

			<p>We work directly with sellers to connect them with buyers to sell their properties. In order to gain access to the database, proof of funds or a pre-approval are required. As a pre-approved buyer, you would have the opportunity to submit an offer through one of our experienced property consultants who will guide you through the buying process and negotiate terms acceptable to both the buyer and seller.</p>
			
			<h2>The Benefits:</h2>
			
			<ul>
				<li>No competing in the open market against multiple bids,</li>
				<li>Lower asking prices due to seller’s not having to pay a sales commission,</li>
				<li>Proformas and income/expense numbers provided to help you determine if a property fits your preferences,</li>
				<li>The ability to speak to a property consultant to review the deal,numbers and to submit a confidential offer with.</li>
			</ul>
			
			<p>We look forward to helping you acquire your next property,</p>

			<p> - The Bostonpropertybuyers.com Team</p>
			
		</div>

		<div class="section">
		
		<br />
		<br />
		<br />
		<br />
		
		<?php
			// TEST ARRAYS
		
		$beds[] = "3";
		$baths[] = "2.5";
		$details[] = "First Unit Details";
		
		$beds[] = "4";
		$baths[] = "4";
		$details[] = "Second Unit Details";
		
		$beds[] = "6";
		$baths[] = "5.5";
		$details[] = "Third Unit Details";
		
		$beds[] = "10";
		$baths[] = "8";
		$details[] = "Fourth Unit Details";
		
		/*
		$beds 		= $_POST['beds'];
		$baths 		= $_POST['baths'];
		$details 	= $_POST['details'];
		*/
		
		$i = 0;
		foreach ($beds as $key => $n) {
		
			echo "Unit " . $i . " - Beds:" . $n . ", Baths " . $baths[$key] . ", Details " . $details[$key] . '<br /><br />';
			
			$i++;
		}
		
		/*
		$bed_inputs = count($beds);
		
		echo $bed_inputs;
		
		$i = 0;
		$unitsTable = "listing_unit_info";
			
			while ($i < $bed_inputs) {
				
				
				sql = "INSERT INTO $unitsTable "
				
				$insertUnitsSQL = "INSERT INTO $unitsTable (listing_id, num_of_beds, num_of_baths, unit_details) VALUES ($propertyid, $num_of_beds, $num_of_baths, $unit_details)";
				
				$i++
			}
			*/
		?>
		
		<br />
		<br />
		<br />
		<br />
		
		<form method="post" action="home_test.php" >
		
			<select name="unitbedrooms[]" value="">
				<option value="1">1 Bedroom</option>
				<option value="2">2 Bedrooms</option>
				<option value="3">3 Bedrooms</option>
				<option value="4">4 Bedrooms</option>
				<option value="5">5 Bedrooms</option>
				<option value="6">6 Bedrooms</option>
				<option value="7">7 Bedrooms</option>
				<option value="8">8 Bedrooms</option>
				<option value="9">9 Bedrooms</option>
				<option value="10+">10 Bedrooms</option>
			</select>
					
			<select name="unitbathrooms[]" value="">
				<option value="1">1 Bath</option>
				<option value="1.5">1.5 Baths</option>
				<option value="2">2 Baths</option>
				<option value="2.5">2.5 Baths</option>
				<option value="3">3 Baths</option>
				<option value="3.5">3.5 Baths</option>
				<option value="4">4 Baths</option>
				<option value="4.5">4.5 Baths</option>
				<option value="5+">5+ Baths</option>
			</select>
						
				<br />
				<textarea name="unitdetails[]" rows="8" cols="60" placeholder="Unit Details Here..."></textarea>
				
				<br />
				<input type="submit" name="PdbOMmNm0o" value="Save Unit Changes >>" />
				
		
		
		</form>
		
		
		
		
		
		
		
		
		</div>

		<div class="section">
		</div>

	</div>
	
<?php include 'includes/footer.php'; ?>