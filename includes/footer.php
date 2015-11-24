<div class="footer">
	<div class="all-footer-pieces">
		<div class="footer-sections">
			<div class="footer-section-box">
				<div class="footer-title">Get Started</div > 
				<a href="/home_create_account.php">Sign Up With Us</a> <br />
				<a href="/home_how_it_works.php">How It Works</a> <br />
				<br />
				<div  class="footer-title">Communicate</div > 
				<a href="home_contact_us.php">Request Information</a> <br />
				<a href="https://www.facebook.com/KunevichLauRealty?ref=stream">Message Us on Facebook</a> <br />
				<a href="home_contact_us.php">Contact Us</a>
				
			</div>

			<div class="footer-section-box">
				<div  class="footer-title">Our Other websites</div > 
				<a href="http://knlrealty.com/">Real Estate</a> <br />
				<a href="http://knlmanagement.com" target="_blank">Property Management</a> <br />
				<a href="http://weinsurema.com" target="_blank">Insurance</a> <br />
				<a href="http://knldevelopment.com" target="_blank">Construction</a> <br />
				<a href="http://knlmortgage.com" target="_blank">Mortgage</a> <br />
		
			</div>
		
			<div class="footer-section-box">
				<iframe src="https://www.google.com/maps/d/embed?mid=zw-JipIVOafU.k29tSVlx9ivU" width="220" height="230"></iframe>
			</div>
		</div>

		<div class="footer-bottom">
			<p>BostonPropertyBuyers.com is a third-party to both buyers and sellers of real estate. The representitives and owners of BostonPropertyBuyers.com do not represent the buyers or the sellers or other people and organizations that use this website.  BostonPropertyBuyers.com is owned by Kunevich & Lau, which is a Boston based company that offers separate services in real estate, property management, insurance and mortgages. Kunevich and Lau is a licensed real estate broker in the state of Massachusetts, although the business done on BostonPropertyBuyers.com is done separately from Kunevich & Lau.</p>
			
			<p>You are required to read and agree to our LEGAL NOTICE prior to furthering any use of this website.</p>
			
			<?php
				if(isset($_SESSION["email"])) {
				echo '<p>';
				echo 'Logged in as: ' . ($_SESSION["email"]) . ' - <a href="logout.php">Logout</a>';
				echo '</p>';
				} 
			?>
	
		</div>
	
	
	
	</div>
</div>


</div>

</div>
</body>
</html>