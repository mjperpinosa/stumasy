<?php
	include "../../classes/Stuffs_controller.php";
	$execute_function = new Stuffs_controller();
	$alarm_id = $_POST["alarm_id"];
	$field = $_POST["field"];
	$value = $_POST["value"];
	
	$execute_function->update_alarm($alarm_id, $field, $value);