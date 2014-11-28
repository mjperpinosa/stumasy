<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$assignment_item_id = $_POST["assignment_item_id"];
	$answer = $_POST["answer"];
	$execute_function->update_assignment_answer($answer, $assignment_item_id);