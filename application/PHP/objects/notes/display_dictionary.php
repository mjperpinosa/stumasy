<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$word = $_POST["word"];
	$execute_function->display_dictionary($word);