<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$assignment_detail_id = $_POST["assignment_detail_id"];
	$execute_function->view_assignment($assignment_detail_id);