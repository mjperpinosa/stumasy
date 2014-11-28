<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$assignment_item_id = $_POST["assignment_item_id"];
	$execute_function->retrieve_assignment_answer_to_update($assignment_item_id);