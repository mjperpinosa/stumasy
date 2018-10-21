<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	
	$data = json_decode($_POST["assignment_data"], true);
	foreach($data as $assignment_data) {
		$$assignment_data["name"] = $assignment_data["value"];
	}
	
	$items = array();
	for($counter = 0; $counter < $no_assignments_number_of_items; $counter++) {
		$item = "no_assignment_item_".($counter + 1);
		array_push($items, $$item);
	}
	
	$execute_function->add_assignment($no_assignment_subject, $no_assignment_topic, $items);
	