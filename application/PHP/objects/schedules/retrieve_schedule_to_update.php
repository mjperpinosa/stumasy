<?php
	include "../../classes/Schedule_controller.php";
	$execute_function = new Schedule_controller();
	
	$cs_id = substr($_POST["cs_id"], 3);
	
	$execute_function->retrieve_schedule_to_update($cs_id);
	
