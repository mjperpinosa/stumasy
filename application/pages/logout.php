<?php
	session_start();
	
	if(isset($_SESSION["user_id"])) {
		session_destroy();
		session_unset();
		header("Location: login.php");
	} else {
		header("Location: login.php");
	}