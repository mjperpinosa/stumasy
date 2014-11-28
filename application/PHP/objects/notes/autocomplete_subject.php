<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$subject = $_POST["subject"];
	$execute_function->autocomplete_subject($subject);