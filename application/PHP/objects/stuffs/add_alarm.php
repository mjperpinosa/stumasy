<?php
	include_once "../../classes/Stuffs_controller.php";
	include_once "../../classes/Stumasy_extra_functions.php";
	$execute_function = new Stuffs_controller();
	
	$data = json_decode($_POST["alarm_data"], true);
	
	foreach($data as $alarm_data) {
		$$alarm_data["name"] = $alarm_data["value"];
	}
	$alarm_time = Stumasy_extra_functions::convert_time_to_sql_format($st_alarm_hour, $st_alarm_minute, $st_alarm_am_pm);
	$execute_function->add_alarm($st_alarm_title, $alarm_time, $st_alarm_tone);

	