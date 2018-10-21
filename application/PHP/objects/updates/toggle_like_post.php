<?php
	include "../../classes/Updates_controller.php";
	$execute_function = new Updates_controller();
	
	$post_id = $_POST["post_id"];
	$execute_function->toggle_like_post($post_id);