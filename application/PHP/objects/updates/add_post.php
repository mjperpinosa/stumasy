<?php
	include "../../classes/Updates_controller.php";
	
	$file_name = "";
	if($_POST["file_included"] == "true") {
		$error_message_on_upload = "";
		$allowed_image_type = array("image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png");
		$allowed_file_type = array("application/pdf", "text/plain", "application/octet-stream");
		$allowed_extension = array("gif", "jpeg", "jpg", "png", "pdf", "txt", "docx");
		$file_name_array = explode(".", $_FILES["up_file_to_post"]["name"]);
		$file_extension = end($file_name_array);
		if ((in_array($_FILES["up_file_to_post"]["type"], $allowed_file_type)) || in_array($_FILES["up_file_to_post"]["type"], $allowed_image_type) || in_array($file_extension, $allowed_extension)) {
			if ($_FILES["up_file_to_post"]["error"] > 0) {
				$error_message_on_upload =  "An error occur while uploading your image.";
			} else {
				$file_name = $_FILES["up_file_to_post"]["name"];
				$file_type_to_store = "";
				if(in_array($_FILES["up_file_to_post"]["type"], $allowed_image_type)) {
					$file_type_to_store = "image";
				} else {
					$file_type_to_store = "document";
				}
				
				switch($file_type_to_store) {
					case "document":
						move_uploaded_file($_FILES["up_file_to_post"]["tmp_name"], "../../../../documents/files/" . $file_name);
					break;
					default:
						$file_name = rand(0, 9999999999).".".$file_extension;
						move_uploaded_file($_FILES["up_file_to_post"]["tmp_name"], "../../../../documents/images/" . $file_name);
				}
			}
		} else {
			$error_message_on_upload = "Sorry, you are trying to upload an invalid file. Please select image only. Thanks. ^_^";
		}
	}
	
	$execute_function = new Updates_controller();
	$post = $_POST["post"];
	$execute_function->add_post($post, $file_name);