<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_Controller();
	$topic = $_POST["topic"];
	$execute_function->autocomplete_topic($topic);