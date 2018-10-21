<?php
	include "../../classes/Profiles_controller.php";
	$error_message_on_upload = "";
	$allowed_image_type = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png");
	$allowed_extension = array("gif", "jpeg", "jpg", "png");
	$image_name_array = explode(".", $_FILES["pr_profile_image"]["name"]);
	$image_extension = end($image_name_array);
	if ((in_array($_FILES["pr_profile_image"]["type"], $allowed_image_type)) || in_array($image_extension, $allowed_extension)) {
		$unique_image_name = rand(0, 9999999999).".".$image_extension;
		move_uploaded_file($_FILES["pr_profile_image"]["tmp_name"], "../../../../documents/images/" . $unique_image_name);
	} else {
		$error_message_on_upload = "Sorry, you are trying to upload an invalid file. Please select image only. Thanks. ^_^";
	}
	
	
	$execute_function = new Profiles_controller();
	$execute_function->change_profile_image($unique_image_name);