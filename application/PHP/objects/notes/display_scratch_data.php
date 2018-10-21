<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$current_page = $_POST["current_page"];
	$item_limit = $_POST["item_limit"];
	$execute_function->display_scratch_data($current_page, $item_limit);