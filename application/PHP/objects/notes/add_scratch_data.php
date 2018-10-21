<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$scratch_data = $_POST["scratch_data"];
	$execute_function->add_scratch_data($scratch_data);