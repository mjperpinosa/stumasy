<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$field_name = $_POST["field_name"];
	$value = $_POST["value"];
	$execute_function->search_scratch_data($field_name, $value);