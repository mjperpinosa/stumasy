<?php
	session_start();
	include "Database_connection.php";
	
	class Profiles_controller extends Database_connection {
		
		function change_profile_image($profile_image_name) {
			$this->open_connection();
			
			$select_statement=$this->db_holder->prepare("SELECT upi.image_id FROM users AS u, files AS f, users_profile_images AS upi WHERE u.user_id = upi.user_id AND f.file_id = upi.image_id AND u.user_id = ?;");
			$select_statement->execute(array($_SESSION["user_id"]));
			if($image_id = $select_statement->fetch()) {
				$delete_statement=$this->db_holder->prepare("DELETE FROM files WHERE file_id = ?");
				$delete_statement->execute(array($image_id[0]));
			}
			
			$insert_statement1=$this->db_holder->prepare("INSERT INTO files VALUES (null, ?, 'image');");
			$insert_statement1->execute(array($profile_image_name));
			$image_id = $this->db_holder->lastInsertId();
			
			$insert_statement2=$this->db_holder->prepare("INSERT INTO users_profile_images VALUES (?, ?);");
			$insert_statement2->execute(array($_SESSION["user_id"], $image_id));
			echo $profile_image_name; 
			
			$this->close_connection();
		}
		
		function display_profile_image() {
			$this->open_connection();
			
			$select_statement=$this->db_holder->prepare("SELECT f.file_name FROM users AS u, files AS f, users_profile_images AS upi WHERE u.user_id = upi.user_id AND f.file_id = upi.image_id AND u.user_id = ?;");
			$select_statement->execute(array($_SESSION["user_id"]));
			if($profile_image = $select_statement->fetch()) {
				echo $profile_image[0];
			} else {
				echo "default_profile_image.jpg";
			}
			$this->close_connection();
		}
	}
?>