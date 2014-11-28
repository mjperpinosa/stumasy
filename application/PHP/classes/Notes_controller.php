<?php
	session_start();
	include "Database_connection.php";
	include "Stumasy_extra_functions.php";
	
	class Notes_controller extends Database_connection {
		function accessing_dictionary_authorization($password) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT * FROM passwords WHERE intended_to = 'accessing dictionary' AND password = password('".$password."')");
			$select_statement->execute();
			$password_confirmed = "false";
			if($data = $select_statement->fetch()) {
				$password_confirmed = "true";
			}
			$this->close_connection();
			echo $password_confirmed;
		}
		
		function add_into_dictionary($word,$definition, $reference) {
			$this->open_connection();
			$select_statement = $this->db_holder->prepare("SELECT word_id FROM words WHERE word = ?;");
			$select_statement->execute(array($word));
			$word_id = "";
			if($word_data = $select_statement->fetch()) { 
				$word_id = $word_data[0];
			} else {
				$word_id = $this->add_word($word);
			}
			$definition_id = $this->add_definition($definition, $reference);
			$insert_dictionary_statement = $this->db_holder->prepare("INSERT INTO dictionary VALUES (null, ?, ?);");
			$insert_dictionary_statement->execute(array($word_id, $definition_id));
			$dictionary_id = $this->db_holder->lastInsertId();
			$insert_users_dictionary_statement = $this->db_holder->prepare("INSERT INTO users_dictionary VALUES (?, ?);");
			$insert_users_dictionary_statement->execute(array($_SESSION["user_id"], $dictionary_id));
			$this->close_connection();
		}
		
		function add_word($word) {
			$insert_word_statement = $this->db_holder->prepare("INSERT INTO words VALUES (null, ?);");
			$insert_word_statement->execute(array($word));
			$word_id = $this->db_holder->lastInsertId();
			return $word_id;
		}
		
		function add_definition($definition, $reference) {
			$insert_definition_statement = $this->db_holder->prepare("INSERT INTO definitions VALUES (null, ?, ?);");
			$insert_definition_statement->execute(array($definition, $reference));
			$definition_id = $this->db_holder->lastInsertId();
			return $definition_id;
		}
		
		function autocomplete_request($word) {
			$this->open_connection();
			
			$select_words_statement = $this->db_holder->prepare("SELECT word FROM words WHERE word LIKE ?;");
			$select_words_statement->execute(array($word."%"));
			$words_array = array();
			$counter = 0;
			while($words = $select_words_statement->fetch()) {
				$words_array[$counter] = $words[0];
				$counter++;
			}
			print_r(json_encode($words_array));
			$this->close_connection();
		}
		
		function display_dictionary($word) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT d.definition, d.reference, CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname) FROM users AS u, words AS w, definitions AS d, dictionary AS dic, users_dictionary AS ud WHERE w.word_id = dic.word_id AND d.definition_id = dic.definition_id AND dic.dictionary_id = ud.dictionary_id AND u.user_id = ud.user_id AND w.word = ?;");
			$select_statement->execute(array($word));
			$dictionary = "<div><h4>".$word."</h4>";
			while($data = $select_statement->fetch()) {
				$dictionary = $dictionary."<p>".nl2br(htmlentities($data[0]))."<br />
					<span id='no_dictionary_added_by'>Added by: ".$data[2]."</span><br />
					<span>Reference: ".$data[1]."</span>
				</p>";
			}
			if($dictionary == "<div><h4>".$word."</h4>") {
				$dictionary = $dictionary."<p>still undefined... :'(</p>";
			}
			$dictionary = $dictionary."</div>";
			echo $dictionary;
			$this->close_connection();
		}
		
		function autocomplete_subject($subject) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT subject FROM subjects WHERE subject LIKE ? OR subject LIKE ? OR subject LIKE ?;");
			$select_statement->execute(array("%".$subject, "%".$subject."%", $subject."%"));
			
			$subjects = array();
			$counter = 0;
			while($data = $select_statement->fetch()) {
				$subjets[$counter] = $data[0];
				$counter++;
			}
			print_r(json_encode($subjets));
			
			$this->close_connection();
		}
		
		function add_lecture($subject, $topic, $content) {
			$this->open_connection();
			$subject = ucfirst($subject);
			$current_time = Stumasy_extra_functions::current_time();
			$current_date = Stumasy_extra_functions::current_date();
			$select_subject_statement = $this->db_holder->prepare("SELECT subject_id FROM subjects WHERE subject = ?;");
			$select_subject_statement->execute(array($subject));
			$subject_id = "";
			if($data = $select_subject_statement->fetch()) {
				$subject_id = $data[0];
			} else {
				$subject_id = $this->add_subject($subject);
			}
			$insert_lecture_statement = $this->db_holder->prepare("INSERT INTO lectures VALUES (null, ?, ?, ?);");
			$insert_lecture_statement->execute(array($subject_id, $topic, $content));
			$lecture_id = $this->db_holder->lastInsertId();
			
			$insert_user_lecture_statement = $this->db_holder->prepare("INSERT INTO users_lectures VALUES (?, ?, ?, ?);");
			$insert_user_lecture_statement->execute(array($_SESSION["user_id"], $lecture_id, $current_time, $current_date));
			
			$this->close_connection();
		}
		
		function add_subject($subject) {
			$insert_subject_statement = $this->db_holder->prepare("INSERT INTO subjects VALUES (null, ?);");
			$insert_subject_statement->execute(array($subject));
			return $this->db_holder->lastInsertId();
		}
		
		function display_lectures() {
			$this->open_connection();
			
			$select_subjects_statement = $this->db_holder->prepare("SELECT DISTINCT s.subject FROM users AS u, subjects AS s, lectures AS l, users_lectures AS ul WHERE s.subject_id = l.subject_id AND l.lecture_id = ul.lecture_id AND u.user_id = ul.user_id AND u.user_id = ?;");
			$select_subjects_statement->execute(array($_SESSION["user_id"]));
			while($subject = $select_subjects_statement->fetch()) {
				echo "<h5>".$subject[0]."</h5>";
				$select_lecture_statement = $this->db_holder->prepare("SELECT l.*, ul.added_time, ul.added_date FROM users AS u, lectures AS l, subjects AS s, users_lectures AS ul WHERE l.lecture_id = ul.lecture_id AND s.subject_id = l.subject_id AND u.user_id = ul.user_id AND s.subject = ? AND u.user_id = ? ORDER BY ul.added_date, ul.added_time DESC;");
				$select_lecture_statement->execute(array($subject[0], $_SESSION["user_id"]));
				while($lecture_data = $select_lecture_statement->fetch()) {
					echo "<a onclick='show_lecture_content(".$lecture_data[0].")'><span id='no_lecture_status_span_".$lecture_data[0]."'>[open]</span>
							<i>".htmlentities($lecture_data[2]).": ".htmlentities(substr($lecture_data[3], 0, 22))."... </i><b>".Stumasy_extra_functions::convert_date_into_user_readable_form($lecture_data[5])." ".Stumasy_extra_functions::convert_time_into_user_readable_form($lecture_data[4])."</b>
						</a><br/>
						<div class='no_individual_lecture_content_container' id='no_lecture_content_".$lecture_data[0]."'>
							<h6>".htmlentities($lecture_data[2])."</h6>
							<p>".nl2br(htmlentities($lecture_data[3]))."</p>
						</div>";
				}
			}
			$this->close_connection();
		}
		
		//--------------- assignment functions ----------------//
		
		function add_topic($topic) {
			$insert_topic_statement = $this->db_holder->prepare("INSERT INTO note_topics VALUES (null, ?);");
			$insert_topic_statement->execute(array(ucfirst($topic)));
			$topic_id = $this->db_holder->lastInsertId();
			return $topic_id;
		}
		
		function autocomplete_topic($topic) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT topic FROM note_topics WHERE topic LIKE ? OR topic LIKE ? OR topic LIKE ?;");
			$select_statement->execute(array("%".$topic, "%".$topic."%", $topic."%"));
			$topics_array = array();
			while($topics = $select_statement->fetch()) {
				array_push($topics_array, $topics[0]);
			}
			print_r(json_encode($topics_array));
			$this->close_connection();
		}
		
		function add_assignment($subject, $topic, $items) {
			$this->open_connection();
			$subject = ucfirst($subject);
			$topic = ucfirst($topic);
			$current_time = Stumasy_extra_functions::current_time();
			$current_date = Stumasy_extra_functions::current_date();
			
			$select_subject_statement = $this->db_holder->prepare("SELECT subject_id FROM subjects WHERE subject = ?;");
			$select_subject_statement->execute(array($subject));
			$subject_id = "";
			if($subject_data = $select_subject_statement->fetch()) {
				$subject_id = $subject_data[0];
			} else {
				$subject_id = $this->add_subject($subject);
			}
			
			$select_topic_statement = $this->db_holder->prepare("SELECT topic_id FROM note_topics WHERE topic = ?;");
			$select_topic_statement->execute(array($topic));
			$topic_id = "";
			if($topic_data = $select_topic_statement->fetch()) {
				$topic_id = $topic_data[0];
			} else {
				$topic_id = $this->add_topic($topic);
			}
			
			$insert_assignment_details_statement = $this->db_holder->prepare("INSERT INTO assignment_details VALUES (null, ?, ?, ?, ?);");
			$insert_assignment_details_statement->execute(array($subject_id, $topic_id, $current_time, $current_date));
			$assignment_detail_id = $this->db_holder->lastInsertId();
			
			$insert_users_assignments_statement = $this->db_holder->prepare("INSERT INTO users_assignments VALUES (?, ?);");
			$insert_users_assignments_statement->execute(array($_SESSION["user_id"], $assignment_detail_id));
			
			for($counter = 0; $counter < count($items); $counter++) {
				$insert_assignment_items_statement = $this->db_holder->prepare("INSERT INTO assignment_items VALUES (null, ?, default);");
				$insert_assignment_items_statement->execute(array($items[$counter]));
				$item_id = $this->db_holder->lastInsertId();
				
				$insert_assignment_statement = $this->db_holder->prepare("INSERT INTO assignments VALUES (?, ?);");
				$insert_assignment_statement->execute(array($assignment_detail_id, $item_id));
			}
			
			$this->close_connection();
		}
		
		function display_assignments() {
			$this->open_connection();
			
			$select_subject_statement = $this->db_holder->prepare("SELECT DISTINCT subject FROM subjects AS s, assignment_details AS ad, assignments AS a, users_assignments AS ua, users AS u WHERE s.subject_id = ad.subject_id AND ad.assignment_detail_id = ua.assignment_detail_id AND ua.user_id = u.user_id AND u.user_id = ?;");
			$select_subject_statement->execute(array($_SESSION["user_id"]));
			$assignment_elements = "";
			$counter = 1;
			$background_class = "odd_background";
			while($subject_data = $select_subject_statement->fetch()) {
				$assignment_elements = $assignment_elements."<thead class='".$background_class."'><tr><th colspan='3'>".$subject_data[0]."</h5></th></tr>
					  <tr><th>Assignment Topic</h6></th><th>Time Stamp</th><th>Status</th></tr></thead>";
				$assignment_status = "";
				$select_assignment_statement = $this->db_holder->prepare("SELECT DISTINCT ad.assignment_detail_id, nt.topic, ad.time_added, ad.date_added FROM subjects AS s, note_topics AS nt, assignment_details AS ad, assignments AS a, users_assignments AS ua, users AS u WHERE s.subject_id = ad.subject_id AND nt.topic_id = ad.topic_id AND ad.assignment_detail_id = a.assignment_detail_id AND ad.assignment_detail_id = ua.assignment_detail_id AND u.user_id = ua.user_id AND u.user_id = ? AND s.subject = ?;");
				$select_assignment_statement->execute(array($_SESSION["user_id"], $subject_data[0]));
				while($assignment_data = $select_assignment_statement->fetch()) {
					$assignment_elements = $assignment_elements."<tr onclick='view_assignment(".$assignment_data[0].")' title = 'view assignment' class='".$background_class."' id='no_assignment_tr_".$assignment_data[0]."'><td>".$assignment_data[1]."</td><td>".Stumasy_extra_functions::convert_time_into_user_readable_form($assignment_data[2])." ".Stumasy_extra_functions::convert_date_into_user_readable_form($assignment_data[3])."</td><td>".$assignment_status."</td></tr>";
				}
				$counter++;
				if($counter % 2 == 0) {
					$background_class = "even_background";
				} else {
					$background_class = "odd_background";
				}
			}
			echo $assignment_elements;
			$this->close_connection();
		}
		
		function view_assignment($assignment_detail_id) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT ai.item_id, ai.content, ai.answer FROM assignment_details AS ad, assignment_items AS ai, assignments AS a, users_assignments AS ua, users AS u WHERE ad.assignment_detail_id = a.assignment_detail_id AND ai.item_id = a.item_id AND ad.assignment_detail_id = ua.assignment_detail_id AND u.user_id = ua.user_id AND u.user_id = ? AND ad.assignment_detail_id = ?;");
			$select_statement->execute(array($_SESSION["user_id"], $assignment_detail_id));
			$counter = 1;
			$answer_element = "";
			while($assignment_data = $select_statement->fetch()) {
				if($assignment_data[2] == "no answer") {
					$answer_element = "<sup title='answer' class='no_update_assignment_answer_sup' id='no_update_assignment_answer_sup_".$assignment_data[0]."' onclick='update_assignment_answer(".$assignment_data[0].")'>[answer]</sup>";
				} else {
					$answer_element = "<sup title='update answer' class='no_update_assignment_answer_sup' id='no_update_assignment_answer_sup_".$assignment_data[0]."' onclick='update_assignment_answer(".$assignment_data[0].")'>[update answer]</sup>";
				}
				echo "<dt><span>".$counter.". ".nl2br(htmlentities($assignment_data[1]))." ".$answer_element."</span></dt>
					  <dd>
						  <table>
							<tr><td>answer:</td> <td><span id='no_assignment_answer_span_".$assignment_data[0]."'>".nl2br(htmlentities($assignment_data[2]))."</span></td><td><p class='no_assignment_answer_input_p' id='no_assignment_answer_input_p_".$assignment_data[0]."'><textarea placeholder='Enter answer here' name='no_assignment_answer_input_".$assignment_data[0]."'></textarea><br /><button class='btn btn-mini btn-info' onclick='update_assignment_answer_request(".$assignment_data[0].")'>submit</button></p></td></tr>
						  </table>
					  </dd>";
				$counter++;
			}
			$this->close_connection();
		}
		
		
		function retrieve_assignment_answer_to_update($assignment_item_id) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT answer FROM assignment_items WHERE item_id = ?;");
			$select_statement->execute(array($assignment_item_id));
			if($answer = $select_statement->fetch()) {
				echo $answer[0];
			}
			
			$this->close_connection();
		}
		
		function update_assignment_answer($answer, $assignment_item_id) {
			$this->open_connection();
			
			$insert_answer_statement = $this->db_holder->prepare("UPDATE assignment_items SET answer = ? WHERE item_id = ?");
			$insert_answer_statement->execute(array($answer, $assignment_item_id));
			
			echo nl2br(htmlentities($answer));
			
			$this->close_connection();
		}
		
		//----------------- assignment functions ends here ----------------//
		//----------------- scratch data functions follows --------------//
		function add_scratch_data($scratch_data) {
			if(trim($scratch_data) != "") {
				$this->open_connection();
				
				$current_time = Stumasy_extra_functions::current_time();
				$current_date = Stumasy_extra_functions::current_date();
				$insert_scratch_data_statement = $this->db_holder->prepare("INSERT INTO scratch_data VALUES (null, ?, ?, ?);");
				$insert_scratch_data_statement->execute(array($scratch_data, $current_time, $current_date));
				$scratch_data_id = $this->db_holder->lastInsertId();
				
				$insert_users_scratch_data_statement = $this->db_holder->prepare("INSERT INTO users_scratch_data VALUES (?, ?);");
				$insert_users_scratch_data_statement->execute(array($_SESSION["user_id"], $scratch_data_id));
				
				$this->close_connection();
			}
		}
		
		function display_scratch_data($current_page, $item_limit) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT sd.* FROM scratch_data AS sd, users_scratch_data AS usd, users AS u WHERE sd.scratch_data_id = usd.scratch_data_id AND u.user_id = usd.user_id AND u.user_id = ? ORDER BY sd.scratch_data_id DESC LIMIT $current_page, $item_limit;");
			$select_statement->execute(array($_SESSION["user_id"]));
			$scratch_data_in_table_rows = "";
			$complete_scratch_data_in_div_element = "";
			$class = "odd_background";
			$counter = 1;
			while($scratch_data = $select_statement->fetch()) {
				if($counter % 2 == 0) {
					$class = "even_background";
				} else {
					$class = "odd_background";
				}
				$counter++;
				$time = Stumasy_extra_functions::convert_time_into_user_readable_form($scratch_data[2]);
				$date = Stumasy_extra_functions::convert_date_into_user_readable_form($scratch_data[3]);
				$scratch_data_in_table_rows = $scratch_data_in_table_rows."<tr id='no_scratch_data_tr_".$scratch_data[0]."' class='".$class."' onclick='view_scratch_data(".$scratch_data[0].")'><td><span id='no_display_scratch_data_container_span_".$scratch_data[0]."'>".substr($scratch_data[1], 0, 20)."... <span class='pull-right'>".$time." ".$date."</span></td></tr>";
				$complete_scratch_data_in_div_element = $complete_scratch_data_in_div_element."<div class='no_scratch_data_individual_container' id='no_scratch_data_individual_container_".$scratch_data[0]."'><i title='edit this' onclick='update_scratch_data(".$scratch_data[0].")' class='icon-edit pull-left'></i><i title='delete' onclick='delete_scratch_data(".$scratch_data[0].")' class='icon-trash pull-left'></i><button class='close pull-right' area-hidden=true onclick='close_viewed_scratch_data(".$scratch_data[0].")'>&times;</button><br /> <span class='pull-right no_scratch_data_timestamp_container'>".$time." ".$date."</span><br /><p id='no_view_scratch_data_container_p_".$scratch_data[0]."'>".nl2br(htmlentities($scratch_data[1]))."</p></div>";
			}
			echo json_encode(array("scratch_data_to_display"=>$scratch_data_in_table_rows, "scratch_data_to_view"=>$complete_scratch_data_in_div_element));
			
			$this->close_connection();
		}
		
		function retrieve_scratch_data_to_update($scratch_data_id) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT * FROM scratch_data WHERE scratch_data_id = ?;");
			$select_statement->execute(array($scratch_data_id));
			if($scratch_data = $select_statement->fetch()) {
				echo json_encode(array("scratch_data_id"=>$scratch_data[0], "scratch_data"=>$scratch_data[1]));
			}
			
			$this->close_connection();
		}
		
		function update_scratch_data($new_scratch_data, $scratch_data_id) {
			if(trim($scratch_data_id) != "") {
				$this->open_connection();
			
				$update_statement = $this->db_holder->prepare("UPDATE scratch_data SET scratch_data = ? WHERE scratch_data_id = ?;");
				$update_statement->execute(array($new_scratch_data, $scratch_data_id));
				echo json_encode(array("scratch_data_to_view"=>nl2br(htmlentities($new_scratch_data)), "scratch_data_to_display"=>htmlentities(substr($new_scratch_data, 0, 20))));
				
				$this->close_connection();
			}
		}
		
		function delete_scratch_data($scratch_data_id) {
			$this->open_connection();
			
			$delete_statement = $this->db_holder->prepare("DELETE FROM scratch_data WHERE scratch_data_id = ?;");
			$delete_statement->execute(array($scratch_data_id));
			
			$this->close_connection();
		}
		
		function search_scratch_data($field_name, $value) {
			$this->open_connection();
			//if($field_name == "time_added") {
				//$value = Stumasy_extra_functions::convert_time_to_sql_format($value);
				//echo "Value converted: ".$value;
			//}
			
			$select_statement = $this->db_holder->prepare("SELECT sd.* FROM scratch_data AS sd, users_scratch_data AS usd, users AS u WHERE sd.scratch_data_id = usd.scratch_data_id AND u.user_id = usd.user_id AND u.user_id = ? AND (".$field_name." LIKE ? OR ".$field_name." LIKE ? OR ".$field_name." LIKE ?) ORDER BY date_added, time_added ASC;");
			$select_statement->execute(array($_SESSION["user_id"], "%".$value, "%".$value."%", $value."%"));
			$scratch_data_in_table_rows = "";
			$complete_scratch_data_in_div_element = "";
			$class = "odd_background";
			$counter = 1;
			while($scratch_data = $select_statement->fetch()) {
				if($counter % 2 == 0) {
					$class = "even_background";
				} else {
					$class = "odd_background";
				}
				$counter++;
				$time = Stumasy_extra_functions::convert_time_into_user_readable_form($scratch_data[2]);
				$date = Stumasy_extra_functions::convert_date_into_user_readable_form($scratch_data[3]);
				$scratch_data_in_table_rows = $scratch_data_in_table_rows."<tr id='no_scratch_data_tr_".$scratch_data[0]."' class='".$class."' onclick='view_scratch_data(".$scratch_data[0].")'><td><span id='no_display_scratch_data_container_span_".$scratch_data[0]."'>".substr($scratch_data[1], 0, 20)."... <span class='pull-right'>".$time." ".$date."</span></td></tr>";
				$complete_scratch_data_in_div_element = $complete_scratch_data_in_div_element."<div class='no_scratch_data_individual_container' id='no_scratch_data_individual_container_".$scratch_data[0]."'><i title='edit this' onclick='update_scratch_data(".$scratch_data[0].")' class='icon-edit pull-left'></i><i title='delete' onclick='delete_scratch_data(".$scratch_data[0].")' class='icon-trash pull-left'></i><button class='close pull-right' area-hidden=true onclick='close_viewed_scratch_data(".$scratch_data[0].")'>&times;</button><br /> <span class='pull-right no_scratch_data_timestamp_container'>".$time." ".$date."</span><br /><p id='no_view_scratch_data_container_p_".$scratch_data[0]."'>".nl2br(htmlentities($scratch_data[1]))."</p></div>";
			}
			echo json_encode(array("scratch_data_to_display"=>$scratch_data_in_table_rows, "scratch_data_to_view"=>$complete_scratch_data_in_div_element));
			
			
			$this->close_connection();
		}
		
		function trigger_scratch_data_pager($item_limit) {
			$this->open_connection();
			
			$select_statement = $this->db_holder->prepare("SELECT COUNT(*) FROM scratch_data;");
			$select_statement->execute();
			if($number_of_items = $select_statement->fetch()) {
				$number_of_pages = $number_of_items[0] / intval($item_limit);
				$number_of_pages = ceil($number_of_pages);
				$pages_to_view = $number_of_pages;
				$li_elements = "";
				if($number_of_pages > 1) {
					if($number_of_pages > 8) {
						$pages_to_view = 8;
					}
					$class = "";
                    $li_elements .= "<li onclick='previous_page_scratch_data()'><a href='Javascript:void(0'>prev</a></li>";
					for($counter = 1; $counter <= $pages_to_view; $counter++) {
						if($counter == 1) {
							$class = "active";
						}
						$li_elements .= "<li class='".$class."' id='no_scratch_page_".$counter."'><a href='Javascript:void(0)'>".$counter."</a></li>";
					}
                    $li_elements .= "<li onclick='next_page_scratch_data()'><a href='Javascript:void(0)'>next</a></li>";
				}
				
				echo json_encode(array("li_elements"=>$li_elements, "number_of_pages"=>$number_of_pages));
			}
			
			$this->close_connection();
		}
	}
?>