<?php
	include "../../classes/User_controller.php";
	
	$execute_function = new User_controller();
	
	$decoded_user_data = json_decode($_POST["user_data"], true);
	foreach($decoded_user_data as $user_data) {
		$$user_data["name"] = $user_data["value"];
	}
	
	$birthday = $ca_birth_year."-".$ca_birth_month."-".$ca_birth_date;
	$execute_function->add_user($lastname, $firstname, $middlename, $birthday, $address, $school_name, $educational_level, $year_level, $college_course, $section, $adviser, $username, $password);
	
?>