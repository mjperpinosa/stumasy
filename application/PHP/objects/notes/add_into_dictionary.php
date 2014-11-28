<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	
	$word = $_POST["word"];
	$definition = $_POST["definition"];
	$reference = $_POST["reference"];
	$execute_function->add_into_dictionary($word,$definition, $reference);