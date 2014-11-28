<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$scratch_data_id = $_POST["scratch_data_id"];
	$execute_function->retrieve_scratch_data_to_update($scratch_data_id);