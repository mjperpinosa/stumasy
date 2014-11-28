<?php
	$mathematical_sentence = $_POST["mathematical_sentence"];
	$decoded_data = json_decode($mathematical_sentence, true);
	foreach($decoded_data as $data) {
		echo eval($data["value"]);
	}
?>