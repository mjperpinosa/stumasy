<?php
	session_start();
	$user_data_array = json_encode($_SESSION);
	echo $user_data_array;