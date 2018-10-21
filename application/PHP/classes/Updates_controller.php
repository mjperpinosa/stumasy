<?php
	session_start();
	include "Database_connection.php";
	include "Stumasy_extra_functions.php";

	class Updates_controller extends Database_connection {
		
		function current_time() {
			$select_statement=$this->db_holder->prepare("SELECT CURTIME();");
			$select_statement->execute();
			$current_time=$select_statement->fetch();
			
			return Stumasy_extra_functions::convert_time_into_user_readable_form($current_time[0]);
		}
		
		function current_date() {
			$select_statement=$this->db_holder->prepare("SELECT CURDATE();");
			$select_statement->execute();
			$current_date=$select_statement->fetch();
			
			$year = substr($current_date[0], 0, 4);
			$month = substr($current_date[0], 5, 2);
			$day = substr($current_date[0], 8);
			$month_array = array("Jan.", "Feb.", "March", "April", "May", "June", "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec.");
			if($month < 10) {
				$month = substr($month, 1);
			}
			$month = $month - 1;
			
			return $month_array[$month]." ".$day.", ".$year;
		}
		
		function add_post($post, $file) {
			
			if((trim($post) != "") || ($file != "")) {
				$this->open_connection();
				
				$current_time = $this->current_time();
				$current_date = $this->current_date();
			
				$insert_statement1=$this->db_holder->prepare("INSERT INTO posts VALUES (null, ?, ?, ?);");
				$insert_statement1->execute(array($post, $current_time, $current_date));
				$post_id = $this->db_holder->lastInsertId();
				$insert_statement2=$this->db_holder->prepare("INSERT INTO users_posts VALUES(?, ?)");
				$insert_statement2->execute(array($_SESSION["user_id"], $post_id));
				
				$file_display = "";
				if($file != "") {
					$file_array = explode(".", $file);
					$file_extension = end($file_array);
					$image_extensions = array("jpg", "jpeg", "png", "gif");
					if(in_array($file_extension, $image_extensions)) {
						$file_extension = "image";
					}
					switch($file_extension) {
						case "image":
							$file_display = "<br /><img src='../../documents/images/".$file."' />";
						break;
						default: 
							$file_display = "<br /><a href = '../../documents/files/".$file."' target='_blank'>".$file."</a>";
					}
					
					$insert_statement3=$this->db_holder->prepare("INSERT INTO files VALUES (null, ?, ?);");
					$insert_statement3->execute(array($file, $file_extension));
					$image_id = $this->db_holder->lastInsertId();
					
					$insert_statement4=$this->db_holder->prepare("INSERT INTO posts_files VALUES (?, ?)");
					$insert_statement4->execute(array($post_id, $image_id));
					
				}
				
				$select_statement=$this->db_holder->prepare("SELECT CONCAT(firstname, ' ', middlename, ' ', lastname) FROM users WHERE user_id = ?;");
				$select_statement->execute(array($_SESSION["user_id"]));
				$name=$select_statement->fetch();
				
				$likers = $this->display_likers($post_id);
				$comment_data = $this->display_comments($post_id);
				$formatted_post = nl2br(htmlentities($post));
				echo "<div class='up_individual_post_wrapper_div'>
							<ul>
								<li class='up_option_container_li'>
									<i class='icon-comment' title='comment' onclick='write_comment(".$post_id.", this)' ondblClick='hide_add_comment_container(".$post_id.", this)'></i><br />
									<i class='icon-thumbs-up' id='up_like_post_".$post_id."' onclick='like_post(".$post_id.")' data-original-title='wew' onmouseover='show_likers(".$post_id.")' onmouseout='hide_likers(".$post_id.")'></i>
									".$likers."
								</li>
								<li>
									<div class='up_post_container_div'>
										<p>".Stumasy_extra_functions::replace_selected_characters_to_emoticons($formatted_post)
											.$file_display ."</p>
											<span class='label label-info'>By:".$name[0]."</span>
											<span class='pull-right up_posted_date_time_container_span'>Posted: ".$current_time." ".$current_date."</span>
									</div>
								</li>
							</ul>
							<div class='up_comments_container_div' id='up_comments_container_div_".$post_id."'>
								<div id='up_comments_container_div_for_post_".$post_id."'>".$comment_data["comments"]."</div>
								".$comment_data["add_comment_span"]."
							</div>
							
					</div><br /><br />
					<p class='text-center up_post_separator_p'>~o0o~</p>";
				
				$this->close_connection();
			}
			
		}
		
		function display_posts() {
			$this->open_connection();
			
			$select_statement1=$this->db_holder->prepare("SELECT p.*, CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname) FROM users AS u, posts AS p, users_posts AS up WHERE u.user_id = up.user_id AND p.post_id = up.post_id ORDER BY p.post_id DESC;");
			$select_statement1->execute();
			while($data = $select_statement1->fetch()) {
				//-------- Process of knowing is the current user liked the post ---------//
				$select_statement2=$this->db_holder->prepare("SELECT * FROM posts_liked WHERE liked_by_id = ? AND post_id = ?;");
				$select_statement2->execute(array($_SESSION["user_id"], $data[0]));
				
				$select_statement3=$this->db_holder->prepare("SELECT f.file_name, f.file_type FROM posts AS p, files AS f, posts_files AS pf WHERE p.post_id = pf.post_id AND f.file_id = pf.file_id AND p.post_id = ?;");
				$select_statement3->execute(array($data[0]));
				$file_element = "";
				if($file = $select_statement3->fetch()) {
					switch($file[1]) {
						case "image":
							$file_element = "<br /><img src='../../documents/images/".$file[0]."' />";
						break;
						default:
							$file_element = "<br /><a href='../../documents/files/".$file[0]."' target='_blank'>".$file[0]."</a>";
					}
				}
				
				$class = "icon-thumbs-up";
				if($select_statement2->fetch()) {
					$class = "icon-thumbs-down";
				}
				//--------- Fetching users who liked the post ---------------//
				$likers = $this->display_likers($data[0]);
				$comment_data = $this->display_comments($data[0]);
				$formatted_post = nl2br(htmlentities($data[1]));
				echo "<div class='up_individual_post_wrapper_div'>
							<ul>
								<li class='up_option_container_li'>
									<i class='icon-comment' title='comment' onclick='write_comment(".$data[0].", this)' ondblClick='hide_add_comment_container(".$data[0].", this)'></i><br />
									<i class='".$class."' id='up_like_post_".$data[0]."' onclick='like_post(".$data[0].")' data-original-title='wew' onmouseover='show_likers(".$data[0].")' onmouseout='hide_likers(".$data[0].")'></i>
									".$likers."
								</li>
								<li>
									<div class='up_post_container_div'>
										<p>".Stumasy_extra_functions::replace_selected_characters_to_emoticons($formatted_post)
											.$file_element."</p>
											<span class='label label-info'>By:".$data[4]."</span> 
											<span class='pull-right up_posted_date_time_container_span'>Posted: ".$data[2]." ".$data[3]."</span>
									</div>
								</li>
							</ul>
							<div class='up_comments_container_div' id='up_comments_container_div_".$data[0]."'>
								<div id='up_comments_container_div_for_post_".$data[0]."'>".$comment_data["comments"]."</div>
								".$comment_data["add_comment_span"]."
							</div>
							
					</div><br /><br />
					<p class='text-center up_post_separator_p'>~o0o~</p>";
			}
			
			$this->close_connection();
		}
		
		function toggle_like_post($post_id) {
			$this->open_connection();
			
			$select_statement=$this->db_holder->prepare("SELECT * FROM posts_liked WHERE liked_by_id = ? AND post_id = ?;");
			$select_statement->execute(array($_SESSION["user_id"], $post_id));
			if($select_statement->fetch()) {
				$delete_statement=$this->db_holder->prepare("DELETE FROM posts_liked WHERE liked_by_id = ? AND post_id = ?;");
				$delete_statement->execute(array($_SESSION["user_id"], $post_id));
			} else {
				$insert_statement=$this->db_holder->prepare("INSERT INTO posts_liked VALUES (?, ?);");
				$insert_statement->execute(array($_SESSION["user_id"], $post_id));
			}
			
			$this->close_connection();
		}
		
		// ----------------- displaying likers ------------//
		function display_likers($post_id) {
			$select_statement=$this->db_holder->prepare("SELECT CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname), u.user_id FROM users AS u, posts AS p, posts_liked AS pl WHERE u.user_id = pl.liked_by_id AND p.post_id = pl.post_id AND p.post_id = ?;");
				$select_statement->execute(array($post_id));
				$likers = "<ul class='up_likers_ul' id='up_likers_for_post_".$post_id."'><li>Liker(s):</li>";
				while($liker_data = $select_statement->fetch()) {					
					if($liker_data[1] == $_SESSION["user_id"]) {
						$likers .= "<li id='up_current_user_likes_post_".$post_id."'>You</li>";  
					} else {
						$likers .= "<li>".$liker_data[0]."</li>";
					} 
				}
				$likers .= "</ul>";
			return $likers;
		}
		
		#--------- adding comment ----------------
		
		function add_comment($post_id, $comment) {
			$this->open_connection();
			
			$current_time = $this->current_time();
			$current_date = $this->current_date();
			
			$insert_statement1=$this->db_holder->prepare("INSERT INTO comments VALUES (null, ?, ?, ?, 0);");
			$insert_statement1->execute(array($comment, $current_time, $current_date));
			
			$comment_id = $this->db_holder->lastInsertId();
			$insert_statement2=$this->db_holder->prepare("INSERT INTO posts_comments VALUES (?, ?, ?);");
			$insert_statement2->execute(array($_SESSION["user_id"], $post_id, $comment_id));
			
			$select_statement = $this->db_holder->prepare("SELECT CONCAT(firstname, ' ', middlename, ' ', lastname) FROM users WHERE user_id = ?;");
			$select_statement->execute(array($_SESSION["user_id"]));
			$name = $select_statement->fetch();
			
			echo "<div class='up_individual_comment_div_wrapper' id='up_comment_container_".$comment_id."'>
					<span class='up_commentor_container_span'>".$name[0]."</span>
					<span class='pull-right'>
						<ul>
							<li>
								<span class='up_delete_comment_confirmation_span' id='up_delete_comment_confirmation_span_".$comment_id."'>
									Sure to remove this comment?
									<a id='up_delete_comment_a_".$comment_id."'>yes</a>
									<a id='up_cancel_delete_comment_a_".$comment_id."'>cancel</a>
								</span>
							</li>
							<li class='icon-edit' title='edit' onclick='update_comment(".$comment_id.")'></li>
							<li class='icon-trash' title='move to trash' onclick='delete_comment(".$comment_id.")'>
							</li>
						</ul>
					</span><br />
					<span class='up_comment_container_span' id='up_comment_".$comment_id."'>".nl2br(htmlentities($comment))."</span>
					<span class='up_comment_info_container_span'>".$current_time." ".$current_date."</span>
				</div>";
			$this->close_connection();
		}
		
		#---------------- displaying comments ---------------
		
		function display_comments($post_id) {
			$select_statement=$this->db_holder->prepare("SELECT c.*, CONCAT(u.firstname, ' ', u.middlename, ' ', u.lastname), pc.user_id FROM users AS u, posts AS p, comments AS c, posts_comments AS pc WHERE u.user_id = pc.user_id AND p.post_id = pc.post_id AND c.comment_id = pc.comment_id AND p.post_id = ? ORDER BY c.comment_id ASC;");
			$select_statement->execute(array($post_id));
			
			$comments = "";
			while($data = $select_statement->fetch()) {
				$comment_options = "";
				if($data[6] == $_SESSION["user_id"]) {
					$comment_options = "<ul>
											<li>
												<span class='up_delete_comment_confirmation_span' id='up_delete_comment_confirmation_span_".$data[0]."'>
													Sure to remove this comment?
													<a id='up_delete_comment_a_".$data[0]."'>yes</a>
													<a id='up_cancel_delete_comment_a_".$data[0]."'>cancel</a>
												</span>
											</li>
											<li class='icon-edit' title='edit' onclick='update_comment(".$data[0].")'></li>
											<li class='icon-trash' title='move to trash' onclick='delete_comment(".$data[0].")'>
											</li>
										</ul>";
				}
				$updated = "";
				if($data[4] == 1) {
					$updated = "Updated ";
				}
				
				$comments .= "<div class='up_individual_comment_div_wrapper' id='up_comment_container_".$data[0]."'>
								<span class='up_commentor_container_span'>".$data[5]."</span>
								<span class='pull-right'>".$comment_options."</span><br />
								<span class='up_comment_container_span' id='up_comment_".$data[0]."'>".htmlentities($data[1])."</span>
								<span class='up_comment_info_container_span' id='up_comment_info_container_span_".$data[0]."'>".$updated.$data[2]." ".$data[3]."</span>
							</div>";
			}
			$add_comment_span = "<span class='up_write_comment_container_span' id='up_write_comment_container_span_".$post_id."'>
									<input type='text' name='up_comment_for_post".$post_id."' placeholder='Write your comment...'></input>
									<button class='btn btn-mini btn-info pull-right' id='up_button_write_comment_for_post_".$post_id."' onclick='write_comment_through_button_click_event(".$post_id.")'>comment</button>
								</span>";
			return $comment_data = array("comments"=>$comments, "add_comment_span"=>$add_comment_span);
		}
		
		//---------------- updating/editing comment----------------//
		
		function update_comment($comment_id, $new_comment) {
			$this->open_connection();
			$current_time = $this->current_time();
			$current_date = $this->current_date();
			
			$update_statement=$this->db_holder->prepare("UPDATE comments SET comment = ?, comment_time = ?, comment_date = ?, updated = 1 WHERE comment_id = ?;");
			$update_statement->execute(array($new_comment, $current_time, $current_date, $comment_id));
			echo "Updated ".$current_time." ".$current_date;
			$this->close_connection();
		}
		
		// ---------- deleting comments -------------//
		function delete_comment($comment_id) {
			$this->open_connection();
			
			$delete_statement=$this->db_holder->prepare("DELETE FROM comments WHERE comment_id = ?;");
			$delete_statement->execute(array($comment_id));
			
			$this->close_connection();
		}
	}