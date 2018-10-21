<?php
	include "../../classes/Stuffs_controller.php";
	$execute_function = new Stuffs_controller();
	$alarm_id = $_POST["alarm_id"];
	$execute_function->delete_alarm($alarm_id);