$(document).ready(function() {
	console.log("stufss.js is now running!");
	$(".icon-trash").tooltip();
	$(".icon-edit").tooltip();
	check_alarm();
	display_alarms();
	
	//------------ putting values to alarm options ----------//
	for(var counter = 0; counter <= 59; counter++) {
		
		if(counter >= 1 && counter <= 12) {
			if(counter <= 9) {
				$("select[name='st_alarm_hour']").append("<option>0" + counter + "</option>");
			} else {
				$("select[name='st_alarm_hour']").append("<option>" + counter + "</option>");
			}
			
		}
		if(counter <= 9) {
			$("select[name='st_alarm_minute']").append("<option>0" + counter + "</option>");
		} else {
			$("select[name='st_alarm_minute']").append("<option>" + counter + "</option>");
		}
		
	}
	
	$("select[name='st_repeat_alarm']").change(function() {
		var repeat_alarm_value =  $("select[name='st_repeat_alarm']").val();
		if(repeat_alarm_value == "select days") {
			$("#st_alarm_days_option_span").slideDown(500);
		} else {		
			$("#st_alarm_days_option_span").slideUp(500);
		}
	});
	
	$("#st_alarm_days_option_span button").click(function() {
		var days_option_form = $("#st_alarm_days_option_form").serializeArray();
		console.log("Data: " + days_option_form);
		
	});
	
	//--------- adding new alarm set -----------//
	$("#st_save_set_alarm_button").click(function() {
		var alarm_title = $("input[name='st_alarm_title']").val();
		if(alarm_title != "") {
			$.ajax({
				type: "POST",
				url: "../PHP/objects/stuffs/add_alarm.php",
				data: {"alarm_data": JSON.stringify($("#st_set_alarm_form").serializeArray())},
				success: function(data) {
					$("#st_alarm_container_tbody").prepend(data);
				},
				error: function(data) {
					console.log("Error in saving new alarm set: " + JSON.stringify(data));
				}
			});
		}
	});
	
});

function check_alarm() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/stuffs/check_alarm.php",
		success: function(data) {
			if(data != "no alarm") {
				var alarm_data = JSON.parse(data);
				var alarm_tone_address = "../../documents/musics/" + alarm_data.alarm_tone + ".mp3";
				$("#st_active_alarm_iframe").attr("src", alarm_tone_address);
				$("#st_active_alarm_title").html(alarm_data.alarm_title);
				console.log("Check haym " + data);
			}
		},
		complete: function(data) {
			console.log("Check complete haym " + JSON.stringify(data));
		},
		error: function(data) {
			console.log("Error in checking alarm: " + JSON.stringify(data));
		}
	});
	setTimeout(check_alarm, 1);
}

function display_alarms() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/stuffs/display_alarms.php",
		success: function(data) {
			$("#st_alarm_container_tbody").html(data);
		},
		error: function(data) {
			console.log("Error in displaying alarms: " + JSON.stringify(data))
		}
	});
}

function toggle_alarm_status(alarm_id) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/stuffs/toggle_alarm_status.php",
		data: {"alarm_id": alarm_id},
		success: function(data) {
			console.log("Success in toggling alarm's status!");
		},
		error: function(data) {
			console.log("Error in toggling alarm's status: " + JSON.stringify(data));
		}
	});
}

function delete_alarm(alarm_id) {
	$("#st_delete_note_div").show();
	$.ajax({
		type: "POST",
		url: "../PHP/objects/stuffs/delete_alarm.php",
		data: {"alarm_id": alarm_id},
		success: function(data) {
			$("#st_alarm_tr_" + alarm_id).remove();
			$("#st_delete_note_div").hide(2000);
		},
		error: function(data) {
			console.log("Error in deleting alarm: " + JSON.stringify(data));
		}
	});
}

function update_alarm(alarm_id) {
	var previous_alarm_title = $("#st_alarm_title_td_" + alarm_id).html();
	var previous_alarm_tone = $("#st_alarm_tone_td_" + alarm_id).html();
	$("#st_alarm_title_td_" + alarm_id).html("<form id='st_new_alarm_title_form'><input type='text' class='input-medium' name='st_new_alarm_title' value='" + previous_alarm_title + "' required /></form>");
	$("input[name='st_new_alarm_title']").focus();
	
	var previous_alarm_tone = $("#st_alarm_tone_td_" + alarm_id).html();
	var tone_options = $("select[name='st_alarm_tone']").html();
	$("#st_alarm_tone_td_" + alarm_id).html("<select class='input-mini' name='st_new_alarm_tone'>" + tone_options + "</select>");
	var previous_tone_id = "";
	var array_length = $("select[name='st_new_alarm_tone'] option").length; //-- getting the numbers of options present in the specified element
	for(var counter = 0; counter < array_length; counter++) {
		var alarm_tone_title = $("select[name='st_new_alarm_tone'] option:eq(" + counter + ")").html();
		if(alarm_tone_title == previous_alarm_tone) {
			previous_tone_id = $("select[name='st_new_alarm_tone'] option:eq(" + counter + ")").val();
			break;
		}
	}
	$("select[name='st_new_alarm_tone']").val(previous_tone_id);
	
	$("input[name='st_new_alarm_title']").blur(function() {
		var new_alarm_title = $("input[name='st_new_alarm_title']").val();
		if(new_alarm_title != "") {
			update_alarm_request(alarm_id, "alarm_title", new_alarm_title);
			$("#st_alarm_title_td_" + alarm_id).html(new_alarm_title);
			$("select[name='st_new_alarm_tone']").focus();
		}
	});
	
	$("#st_new_alarm_title_form").submit(function() {
		var new_alarm_title = $("input[name='st_new_alarm_title']").val();
		if(new_alarm_title != "") {
			update_alarm_request(alarm_id, "alarm_title", new_alarm_title);
			$("#st_alarm_title_td_" + alarm_id).html(new_alarm_title);
			$("select[name='st_new_alarm_tone']").focus();
		}
		return false;
	});
		
	$("select[name='st_new_alarm_tone']").change(function() {
		var new_tone_id = $("select[name='st_new_alarm_tone']").val();
		update_alarm_request(alarm_id, "tone_id", new_tone_id);
		var new_alarm_tone = $("select[name='st_new_alarm_tone'] option[value='" + new_tone_id + "']").html();
		$("#st_alarm_tone_td_" + alarm_id).html(new_alarm_tone);
	});
	
	$("select[name='st_new_alarm_tone']").blur(function() {
		var new_tone_id = $("select[name='st_new_alarm_tone']").val();
		update_alarm_request(alarm_id, "tone_id", new_tone_id);
		var new_alarm_tone = $("select[name='st_new_alarm_tone'] option[value='" + new_tone_id + "']").html();
		$("#st_alarm_tone_td_" + alarm_id).html(new_alarm_tone);
	});
}

function update_alarm_request(alarm_id, field, value) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/stuffs/update_alarm.php",
		data: {"alarm_id": alarm_id, "field": field, "value": value},
		error: function(data) {
			console.log("Error in updating alarm's data: " + JSON.stringify(data));
		}
	});
}