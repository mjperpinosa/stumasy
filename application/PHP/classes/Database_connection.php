<?php
	class Database_connection {
	
		private $db_host =  "mysql:host=localhost;";
		private $db_name = "dbname=stumasy_db";
		private $db_username = "root";
		private $db_password = "";
        protected $db_holder;

        protected function open_connection() {
            $this->db_holder = new PDO($this->db_host.$this->db_name, $this->db_username, $this->db_password);
        }

        protected function close_connection() {
            $this->db_holder = null;
        }
		
	}
?>