<?php

	// This script is intended to logout the user.
	
	session_start();
    session_unset();
    session_destroy();
    session_write_close();
    setcookie(session_name(),'',0,'/');
    session_regenerate_id(true);
	
	header("location:index.php");
	
?>
	
