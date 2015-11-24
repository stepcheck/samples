	<link rel='stylesheet' href='css/buyers_style.css' type='text/css' media='all' />
	<link rel="SHORTCUT ICON" href="favicon.ico">
</head>
<div class="container">
	<header>
		<div class ="logo-and-nav">

			<div class="logo-banner">
				<a href="index.php"><img src="images/Boston-Property-Buyers-Logo2.png" border="0" height="90" width="225"/></a>
			</div> <!-- END LOGO BANNER -->
			
			<div class="right-nav-stuff">
				<?php // If logged in - show "Logged in as: email"
					if(isset($_SESSION["email"])) {
						echo '<div class="show-logged-in">';					// DIV TAGS ARE INSIDE PHP!!!!
						echo 'Logged in as: ' . ($_SESSION["email"]);
						echo '</div>';
					}
					else {
						echo '<div class="show-logged-in"><a href="account_login_page.php">Account Login</a></div>';
					}
				?>
				
				<div class="nav-bar">
			
					<ul>

						<li><a href="home_how_it_works.php">How It Works</a></li>
						<li><a href="home_sold_recent_deals.php">Recently Sold</a></li>
						<?php 	//If session is set, show My Account & Logout Button
								if(isset($_SESSION["email"])) {
								
									if($_SESSION['administrator'] == 'administrator') {
										echo '<li><a href="admin_dashboard.php">My Dashboard</a></li>';
										echo '<li><a href="logout.php">Logout</a></li>';
									} else {
										echo '<li><a href="user_dashboard_buyer.php">My Dashboard</a></li>';
										echo '<li><a href="logout.php">Logout</a></li>';
									}	
								} // End If Email Is Set
								else { // Else, print "login" so users can login
									echo '<li><a href="home_create_account.php">Sign Up (Free!)</a></li>';
									echo '<li><a href="home_contact_us.php">Contact Us</a></li>';
								}
						?>
					</ul>
				</div><!-- END NAV-BAR -->
			</div><!-- END RIGHT-NAV-STUFF -->	
		</div> <!-- END LOGO -->
	</header>