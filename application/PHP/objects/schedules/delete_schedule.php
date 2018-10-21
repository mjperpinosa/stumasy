<?php
	include "../../classes/Schedule_controller.php";
	$execute_function = new Schedule_controller();
	
	$cs_id = substr($_POST["cs_id"], 3);
	echo $cs_id;
	
	$execute_function->delete_schedule($cs_id);
	