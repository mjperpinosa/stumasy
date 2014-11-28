<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$item_limit = $_POST["item_limit"];
	$execute_function->trigger_scratch_data_pager($item_limit);