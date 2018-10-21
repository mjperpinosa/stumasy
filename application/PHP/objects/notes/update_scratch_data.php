<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$new_scratch_data = $_POST["new_scratch_data"];
	$scratch_data_id = $_POST["scratch_data_id"];
	$execute_function->update_scratch_data($new_scratch_data, $scratch_data_id);