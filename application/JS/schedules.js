$(function() {

	console.log("schedule.js is running...");
	display_schedules();
	
	//----- putting values to select options -----//
	for(var counter=0; counter<=59; counter++) {
		if(counter >= 0 && counter <= 9) {
			counter = "0" + counter;
		}
		if(counter >= 1 && counter <=12) {
			$("select[name='cs_ts_hour']").append("<option>" + counter + "</option>");
			$("select[name='cs_te_hour']").append("<option>" + counter + "</option>");
		}
		$("select[name='cs_ts_minute']").append("<option>" + counter + "</option>");
		$("select[name='cs_te_minute']").append("<option>" + counter + "</option>");
	}
	
	//-----  Class Schedules Manipulation (CRUD) -----//
	//----- Process of adding schedule -----//
	$("#cs_add_a").click(function() {
		$("#cs_overlay_div").show();
		$("#cs_add_schedule_div").show(100);
		// ------------- add schedule button clicked.. so proceed in adding new schedule ---//
		$("#cs_add_schedule_button").click(function(){
			console.log("Add button click!");
			var cs_data = $("#class_schedule_form").serializeArray();
			console.log("Class schedule data are - " + cs_data);
			var cs_empty_data = "";
			for(var counter = 0; counter < cs_data.length; counter++) {
				console.log("Name for loop " + cs_data[counter].name);
				if(cs_data[counter].value == "") {
					cs_empty_data = cs_data[counter].name;
					console.log("Empty " + cs_data[counter].name);
					break;
				}
			}
			if(cs_empty_data == "") {
				console.log("Schedule data not empty ");
				$("#cs_overlay_div").hide();
				$("#cs_add_schedule_div").hide(100);
				$("#cs_overlay_div").show();
				$("#cs_saving_dialog_div").show();
				//----- proceed to AJAX call -----//
				$.ajax({
					type: "POST",
					url: "../PHP/objects/schedules/add_schedule.php",
					data: {"cs_data": JSON.stringify(cs_data)},
					success: function(data) {
						display_schedules();
						$("#cs_overlay_div").hide();
						$("#cs_saving_dialog_div").hide();
					},
					error: function(data) {
						console.log("Server Process Error = " + JSON.stringify(data));
					}
				})
			} else {
				//----- means there is an unfilled-up field -----//
				console.log("Naay empty wa kasod sa if nga naay AJAX");
				$("input[name='" + cs_empty_data + "']").focus();
				
			}
		});
		
		// ---------- cancel adding button clicked (so close dialog) ----------//
		$("#cs_cancel_adding_button").click(function() {
			$("#cs_overlay_div").hide();
			$("#cs_add_schedule_div").hide(100);
		});
		
	}); //----- adding class schedule process ends -----//
	
	$("#cs_update_a").click(function() {
		$("#cs_display_schedule_tbody tr:not('.cs_day_tr')").css("cursor", "pointer");
		$("#cs_display_schedule_tbody tr:not('.cs_day_tr')").attr("title", "click row to update");
		$("#cs_display_schedule_tbody tr:not(.cs_day_tr)").tooltip();
		
		//------- retrieving schedule update data t process --------//
		$("#cs_display_schedule_tbody tr:not('.cs_day_tr')").click(function() {
			var cs_id = this.id;
			$.ajax({
				type: "POST",
				url: "../PHP/objects/schedules/retrieve_schedule_to_update.php",
				data: {"cs_id": cs_id},
				success: function(data) {
					var cs_data = JSON.parse(data);
					$("input[name='cs_id']").val(cs_data.cs_id);
					$("select[name='cs_day']").val(cs_data.day);
					$("select[name='cs_ts_hour']").val(cs_data.cs_ts_hour);
					$("select[name='cs_ts_minute']").val(cs_data.cs_ts_minute);
					$("select[name='cs_ts_am_pm']").val(cs_data.cs_ts_am_pm);
					$("select[name='cs_te_hour']").val(cs_data.cs_te_hour);
					$("select[name='cs_te_minute']").val(cs_data.cs_te_minute);
					$("select[name='cs_te_am_pm']").val(cs_data.cs_te_am_pm);
					$("input[name='cs_subject']").val(cs_data.subject);
					$("input[name='cs_teacher']").val(cs_data.teacher);
					
					$("#cs_add_schedule_button").hide();
					$("#cs_save_schedule_button").show();
					$("#cs_cancel_adding_button").hide();
					$("#cs_cancel_saving_button").show();
					
					$("#cs_overlay_div").show();
					$("#cs_add_schedule_div").show();
				},
				error: function(data) {
					console.log("There's an error in retrieving schedule to update: " + JSON.stringify(data));
				}
			});
		});
		
	}); //----- retrieving schedule to update process ends -------//
	
	// ------- deleting schedule process -------//
	$("#cs_remove_a").click(function() {
		$("#cs_display_schedule_tbody tr:not('.cs_day_tr')").css("cursor", "pointer");
		$("#cs_display_schedule_tbody tr:not('.cs_day_tr')").attr("title", "click this row to delete");
		$("#cs_display_schedule_tbody tr:not(.cs_day_tr)").tooltip();
		
		$("#cs_display_schedule_tbody tr:not('.cs_day_tr')").click(function() {
			var cs_id = this.id;
			$("#cs_schedule_to_delete_tr").html("<td></td>" + $("#" + cs_id).html());
			$("#cs_overlay_div").show();
			$("#cs_delete_confirmation_dialog_div").slideDown(500);
			
			$("#cs_continue_remove_button").click(function() {
				$("#"+cs_id).remove();
				$.ajax({
					type: "POST",
					url: "../PHP/objects/schedules/delete_schedule.php",
					data: {"cs_id": cs_id},
					success: function(data) {
						display_schedules();
						$("#cs_overlay_div").hide();
						$("#cs_delete_confirmation_dialog_div").slideUp(500);
					},
					error: function(data) {
						console.log("Error in deleting schedule: " + JSON.stringify(data));
					}
				});
			});
			
			//-------- cancel deleting process ------//
			$("#cs_cancel_remove_button").click(function() {
				display_schedules();
				$("#cs_overlay_div").hide();
				$("#cs_delete_confirmation_dialog_div").slideUp(500);
			});
		});
		
	}); //-------- deleting schedule proccess ends --------//
})

function display_schedules() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/schedules/display_schedules.php",
		success: function(data) {
			if(data != "") {
				$("#cs_display_schedule_tbody").html(data);
			} else {
				$("#cs_display_schedule_tbody").html("<td colspan='4'>You still don't have any class schedule added. You must record your schedules now!</td>");
			}
		},
		error: function(data) {
			console.log("Server process error in displaying class schedules. " + JSON.stringify(data));
		}
	});
}

function update_schedule_request() {
	console.log("Click update");
	$.ajax({
		type: "POST",
		url: "../PHP/objects/schedules/update_schedule.php",
		data: {"schedule_data": JSON.stringify($("#class_schedule_form").serializeArray()), "cs_id": $("input[name='cs_id']").val()},
		success: function(data) {
			$("#cs_add_schedule_button").show();
			$("#cs_save_schedule_button").hide();
			$("#cs_cancel_adding_button").show();
			$("#cs_cancel_saving_button").hide();
			$("#cs_overlay_div").hide(100);
			$("#cs_add_schedule_div").hide(100);
			display_schedules();
		},
		error: function(data) {
			console.log("Error in updating schedule: " + JSON.stringify(data));
		}
	});
}

function update_schedule_canceled() {
	$("#cs_update_a").removeClass("active_link");
	$("#cs_add_schedule_div").hide(100);
    $("#cs_overlay_div").hide(100);
    display_schedules();
}