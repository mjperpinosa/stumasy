<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$scratch_data_id = $_POST["scratch_data_id"];
	$execute_function->delete_scratch_data($scratch_data_id);
