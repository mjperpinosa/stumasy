<?php
	session_start();
	include "../../classes/User_controller.php";
	
	$execute_function = new User_controller();
	
	$username_entered = $_POST["username_entered"];
	$password_entered = $_POST["password_entered"];
	
	$account_valid = $execute_function->login_user($username_entered, $password_entered);
	if($account_valid) {
		$user_data = $execute_function->get_current_user_data($username_entered, $password_entered);
		$_SESSION["user_id"] = $user_data["user_id"];
		$_SESSION["user_lastname"] = ucfirst($user_data["lastname"]);
		$_SESSION["user_firstname"] = ucfirst($user_data["firstname"]);
		$_SESSION["user_middlename"] = ucfirst($user_data["middlename"]);
		$_SESSION["user_birthday"] = $user_data["birthday"];
		$_SESSION["user_age"] = $user_data["age"];
		$_SESSION["user_address"] = $user_data["address"];
		$_SESSION["user_educational_level"] = $user_data["educational_level"];
		$_SESSION["user_school_name"] = $user_data["school_name"];
		$_SESSION["user_year_level"] = $user_data["year_level"];
		$_SESSION["user_college_course"] = $user_data["college_course"];
		$_SESSION["user_section"] = $user_data["section"];
		$_SESSION["user_adviser"] = $user_data["adviser"];
		
		echo "true";
	}