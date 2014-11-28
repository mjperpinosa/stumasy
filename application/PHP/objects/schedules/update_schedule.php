<?php
	include "../../classes/Schedule_controller.php";
	$execute_function = new Schedule_controller();
	
	$cs_id = $_POST["cs_id"];
	$decoded_cs_data = json_decode($_POST["schedule_data"], true);
	
	foreach($decoded_cs_data as $cs_data) {
		$$cs_data['name'] = $cs_data['value'];
	}
	
	$cs_time_start = $cs_ts_hour.":".$cs_ts_minute." ".$cs_ts_am_pm;
	$cs_time_end = $cs_te_hour.":".$cs_te_minute." ".$cs_te_am_pm;
	$execute_function->update_schedule($cs_day, $cs_time_start, $cs_time_end, $cs_subject, $cs_teacher, $cs_id);