<?php
	session_start();
	include "Database_connection.php";
	include "Stumasy_extra_functions.php";
	
	class Stuffs_controller extends Database_connection {
		
		function add_alarm($alarm_title, $alarm_time, $alarm_tone) {
			$this->open_connection();
			
			$insert_statement=$this->db_holder->prepare("INSERT INTO alarms VALUES (null, ?, ?, ?)");
			$insert_statement->execute(array($alarm_title, $alarm_time, $alarm_tone));
			$alarm_id = $this->db_holder->lastInsertId();
			
			$insert_statement2 = $this->db_holder->prepare("INSERT INTO users_alarms VALUES (?, ?, 1)");
			$insert_statement2->execute(array($_SESSION["user_id"], $alarm_id));
			$select_statement = $this->db_holder->prepare("SELECT tone_title FROM alarm_tones WHERE tone_id = ?;");
			$select_statement->execute(array($alarm_tone));
			$alarm_tone_title = $select_statement->fetch();
			
			echo "<tr id='st_alarm_tr_".$alarm_id."'>
						<td>
							<i class='icon-edit' title='update' onclick='update_alarm(".$alarm_id.")'>
								<ul>
									<li>title</li>
									<li>time</li>
									<li>tone</li>
								</ul>
							</i> 
							<i class='icon-trash' title='remove' onclick='delete_alarm(".$alarm_id.")'></i>
						</td>
						<td id='st_alarm_title_td_".$alarm_id."'>".$alarm_title."</td>
						<td>".Stumasy_extra_functions::convert_time_into_user_readable_form($alarm_time)."</td>
						<td id='st_alarm_tone_td_".$alarm_id."'>".$alarm_tone_title[0]."</td>
						<td>
							<input type='radio' name='st_alarm_status_".$alarm_id."' onclick='toggle_alarm_status(".$alarm_id.")' checked />on |
							off <input type='radio' name='st_alarm_status_".$alarm_id."' onclick='toggle_alarm_status(".$alarm_id.")' />
						</td>
					</tr>";
			$this->close_connection();
		}
		
		function check_alarm() {
			$this->open_connection();
			
			$select_statement1=$this->db_holder->prepare("SELECT CURTIME();");
			$select_statement1->execute();
			$current_time = $select_statement1->fetch();
			
			$select_statement2=$this->db_holder->prepare("SELECT a.alarm_time, a.alarm_title, at.tone_title FROM users AS u, alarms AS a, alarm_tones AS at, users_alarms AS ua WHERE u.user_id = ua.user_id AND a.alarm_id = ua.alarm_id AND a.tone_id = at.tone_id AND u.user_id = ? AND a.alarm_time = ? AND ua.status = 1;");
			$select_statement2->execute(array($_SESSION["user_id"], $current_time[0]));
			
			if($alarm_data = $select_statement2->fetch()) {
				$data = array("alarm_time"=>$alarm_data[0], "alarm_title"=>$alarm_data[1], "alarm_tone"=>$alarm_data[2]);
				echo json_encode($data);
			} else {
				echo "no alarm";
			}
			
			$this->close_connection();
		}
		
		function display_alarms() {
			$this->open_connection();
			
			$select_statement=$this->db_holder->prepare("SELECT a.*, at.tone_title, ua.status FROM users AS u, alarms AS a, alarm_tones AS at, users_alarms AS ua WHERE u.user_id = ua.user_id AND a.alarm_id = ua.alarm_id AND at.tone_id = a.tone_id AND u.user_id = ? ORDER BY a.alarm_time;");
			$select_statement->execute(array($_SESSION["user_id"]));
			while($alarm_data = $select_statement->fetch()) {
				$status = "<input type='radio' name='st_alarm_status_".$alarm_data[0]."' onclick='toggle_alarm_status(".$alarm_data[0].")' />on |
							off<input type='radio' name='st_alarm_status_".$alarm_data[0]."' onclick='toggle_alarm_status(".$alarm_data[0].")' checked />";
				if($alarm_data[5] == 1) {
					$status = "<input type='radio' name='st_alarm_status_".$alarm_data[0]."' onclick='toggle_alarm_status(".$alarm_data[0].")' checked />on |
							off<input type='radio' name='st_alarm_status_".$alarm_data[0]."' onclick='toggle_alarm_status(".$alarm_data[0].")' />";
				}
				
				$time = Stumasy_extra_functions::convert_time_into_user_readable_form($alarm_data[2]);
				echo "<tr id='st_alarm_tr_".$alarm_data[0]."'>
						<td>
							<i class='icon-edit' title='update' onclick='update_alarm(".$alarm_data[0].")'></i> 
							<i class='icon-trash' title='remove' onclick='delete_alarm(".$alarm_data[0].")'></i>
						</td>
						<td id='st_alarm_title_td_".$alarm_data[0]."'>".$alarm_data[1]."</td>
						<td>".$time."</td>
						<td id='st_alarm_tone_td_".$alarm_data[0]."'>".$alarm_data[4]."</td>
						<td>".$status."</td>
					</tr>";
			}
			$this->close_connection();
		}
		
		function toggle_alarm_status($alarm_id) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT status FROM users_alarms WHERE alarm_id = ?;");
			$select_statement->execute(array($alarm_id));
			$status = $select_statement->fetch();
			$new_status = 0;
			if($status[0] == 0) {
				$new_status = 1;
			}
			
			$update_statement = $this->db_holder->prepare("UPDATE users_alarms SET status = ? WHERE alarm_id = ?;");
			$update_statement->execute(array($new_status, $alarm_id));
			
			$this->close_connection();
		}
		
		function delete_alarm($alarm_id) {
			$this->open_connection();
			
			$delete_statement = $this->db_holder->prepare("DELETE FROM alarms WHERE alarm_id = ?;");
			$delete_statement->execute(array($alarm_id));
			
			$this->close_connection();
		}
		
		function update_alarm($alarm_id, $field, $value) {
			$this->open_connection();
			
			$update_statement = $this->db_holder->prepare("UPDATE alarms SET ".$field." = ? WHERE alarm_id = ?");
			$update_statement->execute(array($value, $alarm_id));
			$this->close_connection();
		}
	}
?>