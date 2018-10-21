<?php
	class Stumasy_extra_functions extends Database_connection {
	
		function current_time() {
			$select_current_time_statement=$this->db_holder->prepare("SELECT CURTIME();");
			$select_current_time_statement->execute();
			$current_time=$select_current_time_statement->fetch();
			return $current_time[0];
		}
		
		function current_date() {
			$select_current_date_statement=$this->db_holder->prepare("SELECT CURDATE();");
			$select_current_date_statement->execute();
			$current_date=$select_current_date_statement->fetch();
			return $current_date[0];
		}
		
		function convert_date_into_user_readable_form($date_in_sql_format) {
			
			$select_dayname_statement = $this->db_holder->prepare("SELECT DAYNAME(?);");
			$select_dayname_statement->execute(array($date_in_sql_format));
			$dayname = $select_dayname_statement->fetch();
			
			$year = substr($date_in_sql_format, 0, 4);
			$month = substr($date_in_sql_format, 5, 2);
			$day = substr($date_in_sql_format, 8);
			$month_array = array("Jan.", "Feb.", "March", "April", "May", "June", "July", "Aug.", "Sept.", "Oct.", "Nov.", "Dec.");
			if($month < 10) {
				$month = substr($month, 1);
			}
			$month = $month - 1;
			
			return $dayname[0]." ".$month_array[$month]." ".$day.", ".$year;
		}
	
		function convert_time_into_user_readable_form($time_in_sql_format) {
			$AM_PM = "AM";
			$hour = substr($time_in_sql_format, 0, 2);
			$second = substr($time_in_sql_format, 2, 3);
			if($hour >= 12) {
				$AM_PM = "PM";
				
				if($hour > 12) {
					$hour = $hour - 12;
					
					if($hour <= 9 && $hour != 00) {
						$hour = "0".$hour;
					}
				}
			}
			
			if($hour == 00) {
				$hour = 12;
			}
			return $hour.$second." ".$AM_PM;
		}
		
		function convert_time_to_sql_format($time) {
			$hour = substr($time, 0, 2);
			$minute = substr($time, 3, 2);
			$am_pm = substr($time, 6, 2);
			if($am_pm == "PM" && $hour != 12) {
				$hour = $hour + 12;
			}
			if($am_pm == "AM" && $hour == 12) {
				$hour = "00";
			}
			return $hour.":".$minute.":00";
		}
		
		function convert_date_to_sql_format($date) {
			
		}
		
		function replace_selected_characters_to_emoticons($strings) {
			$characters_to_be_replaced = array(":)", ":(", ":|", ":/", ":\\", ":D");
			$emoticons = array("<span><img src='../CSS/images/emoticon_happy.jpg' /></span>", "<span><img src='../CSS/images/emoticon_sad.jpg' /></span>", "<span><img src='../CSS/images/emoticon_neutral.jpg' /></span>", "<span><img src='../CSS/images/emoticon_hmpt.jpg' /></span>", "<span><img src='../CSS/images/emoticon_laugh.jpg' /></span>", "<span><img src='../CSS/images/emoticon_laugh.jpg' /></span>");
			for($counter = 0; $counter < count($characters_to_be_replaced); $counter++) {
				$strings = str_ireplace($characters_to_be_replaced[$counter], $emoticons[$counter], $strings);
			}
			return $strings;
		}
	}
	