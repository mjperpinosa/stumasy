<?php
	include "Database_connection.php";
	include "Stumasy_extra_functions.php";
	
	class User_controller extends Database_connection {
	
		function add_user($lastname, $firstname, $middlename, $birthday, $address, $school_name, $educational_level, $year_level, $college_course, $section, $adviser, $username, $password) {
			$this->open_connection();
			
			$insert_statement1 = $this->db_holder->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
			$insert_statement1->execute(array($lastname, $firstname, $middlename, $birthday, $address, $educational_level, $school_name, $year_level, $college_course, $section, $adviser));
			
			$user_id = $this->db_holder->lastInsertId();
			
			$insert_statement2 = $this->db_holder->prepare("INSERT INTO users_accounts VALUES (?, ?, ?);");
			$insert_statement2->execute(array($user_id, $username, $password));
			
			$this->close_connection();
			echo ucfirst($firstname);
		}
		
		function login_user($username_entered, $password_entered)  {
			$this->open_connection();
			
			$select_statement1 = $this->db_holder->prepare("SELECT u.user_id FROM users AS u, users_accounts AS ua WHERE u.user_id = ua.user_id && ua.username = ?;");
			$select_statement1->execute(array($username_entered));
			if($select_statement1->fetch()) {
				$select_statement2 = $this->db_holder->prepare("SELECT u.* FROM users AS u, users_accounts AS ua WHERE u.user_id = ua.user_id && ua.username = ? && ua.password = ?;");
				$select_statement2->execute(array($username_entered, $password_entered));
				if($select_statement2->fetch()) {
					return true;
				} else {
					echo "Ooopss. Incorrect password!";
				}
			} else {
				echo "Sorry... Invalid username";
			}
			
			$this->close_connection();
		}
		
		function get_current_user_data($username_entered, $password_entered) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT u.* FROM users AS u, users_accounts AS ua WHERE u.user_id = ua.user_id && ua.username = ? && ua.password = ?;");
			$select_statement->execute(array($username_entered, $password_entered));
			$user_data = $select_statement->fetch();
			
			$select_statement2 = $this->db_holder->prepare("SELECT DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL EXTRACT(YEAR FROM '".$user_data[4]."') YEAR), '%y');");
			$select_statement2->execute();
			$age = $select_statement2->fetch();
			$select_statement3 = $this->db_holder->prepare("SELECT DATE_FORMAT('".$user_data[4]."', '%M %d, %Y');");
			$select_statement3->execute();
			$formatted_date = $select_statement3->fetch();
			$user_data_array = array("user_id"=>$user_data[0], 
									 "lastname"=>$user_data[1],
									 "firstname"=>$user_data[2],
									 "middlename"=>$user_data[3],
									 "birthday"=>$formatted_date[0],
									 "age"=>$age[0],
									 "address"=>$user_data[5],
									 "educational_level"=>$user_data[6],
									 "school_name"=>$user_data[7],
									 "year_level"=>$user_data[8],
									 "college_course"=>$user_data[9],
									 "section"=>$user_data[10],
									 "adviser"=>$user_data[11]);
			$this->close_connection();
			return $user_data_array;
		}
	}
?>