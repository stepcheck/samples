<?php

// Login Page: blank

	$server = "blank";
	$username = "blank";
	$password = "blank";
	$database = "blank";
	
	// Create database connection
	
	$con = mysqli_connect($server, $username, $password, $database);
	
	// Check connection

	if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
	}
	
?>