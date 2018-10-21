<?php
	include "../../classes/Notes_controller.php";
	$execute_function = new Notes_controller();
	$subject = $_POST["subject"];
	$topic = $_POST["topic"];
	$content = $_POST["content"];
	$execute_function->add_lecture($subject, $topic, $content);