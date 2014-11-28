<?php
	include "../../classes/Notes_controller.php";
	$password = $_POST["password"];
	$execute_function = new Notes_controller();
	$execute_function->accessing_dictionary_authorization($password);