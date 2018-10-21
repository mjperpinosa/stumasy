<?php
	include "../../classes/Updates_controller.php";
	$execute_function = new Updates_controller();
	
	$comment_id = $_POST["comment_id"];
	
	$execute_function->delete_comment($comment_id);