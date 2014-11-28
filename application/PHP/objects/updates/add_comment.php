<?php
	include "../../classes/Updates_controller.php";
	$execute_function = new Updates_controller();
	
	$post_id = $_POST["post_id"];
	$comment = $_POST["comment"];
	
	$execute_function->add_comment($post_id, $comment);
