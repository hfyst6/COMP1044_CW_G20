<?php
	session_start();
    // User will be sent to login page if user did not login
	if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
		header("location: auth.php");
		exit;
	}
	session_unset();
	Session_destroy();
	header ('location:auth.php');
?>