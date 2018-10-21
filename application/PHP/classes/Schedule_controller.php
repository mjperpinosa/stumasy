<?php
	session_start();
	include "Database_connection.php";
	class Schedule_controller extends Database_connection {
		
		function add_schedule($cs_day, $cs_time_start, $cs_time_end, $cs_subject, $cs_teacher) {
			$this->open_connection();
			
			$insert_statement1 = $this->db_holder->prepare("INSERT INTO class_schedules VALUES (null, ?, ?, ?, ?, ?);");
			$insert_statement1->execute(array($cs_day, $cs_time_start, $cs_time_end, $cs_subject, $cs_teacher));
			$cs_id = $this->db_holder->lastInsertId();
			
			$insert_statement2 = $this->db_holder->prepare("INSERT INTO users_class_schedules VALUES (?, ?);");
			$insert_statement2->execute(array($_SESSION["user_id"], $cs_id));
			
			$this->close_connection();
		}
		
		function display_schedules() {
			$this->open_connection();

			$select_statement1 = $this->db_holder->prepare("SELECT * FROM days;");
			$select_statement1->execute();
			while($day = $select_statement1->fetch()) {
				$select_statement2 = $this->db_holder->prepare("SELECT cs.*, d.day FROM users AS u, class_schedules AS cs, days AS d, users_class_schedules AS ucs WHERE u.user_id = ucs.user_id && cs.cs_id = ucs.cs_id && cs.day_id = d.day_id && u.user_id = ? && d.day = ? ORDER BY d.day_id, cs.time_start, cs.time_end;");
				$select_statement2->execute(array($_SESSION["user_id"], $day[1]));
				$schedule = "";
				$row_length = 1;
				while($cs_data = $select_statement2->fetch()) {
					$schedule .= "<tr id='cs_".$cs_data[0]."'>
							<td>".$cs_data[2]."-".$cs_data[3]."</td>
							<td>".$cs_data[4]."</td>
							<td>".$cs_data[5]."</td>
						</tr>";
					$row_length++;
				}
				if($schedule != "") {
					echo "<tr class='cs_day_tr'><td rowspan=".$row_length.">".$day[1]."</td></tr>".$schedule;
				}
			}
			
			$this->close_connection();
		}
		
		function retrieve_schedule_to_update($cs_id) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT cs.*, d.day FROM users_class_schedules AS ucs, class_schedules AS cs, days AS d WHERE ucs.cs_id = cs.cs_id AND cs.day_id = d.day_id AND cs.cs_id = ?;");
			$select_statement->execute(array($cs_id));
			
			$cs_data = $select_statement->fetch();
			$cs_data_array = array("cs_id"=>$cs_data[0], 
									"day"=>$cs_data[6], 
									"cs_ts_hour"=>substr($cs_data[2], 0, 2),
									"cs_ts_minute"=>substr($cs_data[2], 3, 2),
									"cs_ts_am_pm"=>substr($cs_data[2], 6, 2),
									"cs_te_hour"=>substr($cs_data[3], 0, 2),
									"cs_te_minute"=>substr($cs_data[3], 3, 2),
									"cs_te_am_pm"=>substr($cs_data[3], 6, 2),
									"subject"=>$cs_data[4],
									"teacher"=>$cs_data[5]
									);
			echo json_encode($cs_data_array);
			
			$this->close_connection();
		}
		
		function update_schedule($cs_day, $cs_time_start, $cs_time_end, $cs_subject, $cs_teacher, $cs_id) {
			$this->open_connection();
			
			$update_statement = $this->db_holder->prepare("UPDATE class_schedules SET day_id = ?, time_start = ?, time_end = ?, subject = ?, teacher = ? WHERE cs_id = ?;");
			$update_statement->execute(array($cs_day, $cs_time_start, $cs_time_end, $cs_subject, $cs_teacher, $cs_id));
			
			$this->close_connection();
		}
		
		function delete_schedule($cs_id) {
			$this->open_connection();
			
			$delete_statement = $this->db_holder->prepare("DELETE FROM class_schedules WHERE cs_id = ?;");
			$delete_statement->execute(array($cs_id));
			
			$this->close_connection();
		}
		
	}