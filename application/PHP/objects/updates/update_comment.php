<?php
	include "../../classes/Updates_controller.php";
	$execute_function = new Updates_controller();
	
	$comment_id = $_POST["comment_id"];
	$new_comment = $_POST["new_comment"];
	
	$execute_function->update_comment($comment_id, $new_comment);