$(document).ready(function() {
	
	$("#no_container_div").tabs();
	display_lectures();
	display_assignments();
	display_scratch_data();
	trigger_scratch_data_pager();
	
	//------------- relevant to lectures ---------
	$("#no_options_container_ul li").click(function() {
		$("#no_options_container_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
	});

	$("#no_add_lecture_i").click(function() {
		$("#no_add_lectures_container_div").toggle();
	});
	
	$("input[name='no_lecture_subject']").keyup(function() {
		var subject = this.value
		autocomplete_subject(subject, "no_lecture_subject");
	});
	
	$("#no_add_lecture_button").click(function() {
		var subject = $("input[name='no_lecture_subject']").val();
		var topic = $("input[name='no_lecture_topic']").val();
		var content = $("textarea[name='no_lecture_content_textarea']").val();
		if(($.trim(subject) != "") && ($.trim(topic) != "") && ($.trim(content) != "")) {
			$.ajax({
				type: "POST",
				url: "../PHP/objects/notes/add_lecture.php",
				data: {"subject": subject, "topic": topic, "content": content},
				success: function(data) {
					console.log("Success in adding " + data);
				},
				error: function(data) {
					console.log("An error occur while adding lecture: " + JSON.stringify(data));
				}
			});
		} else {
			console.log("There is an empty field." + subject + topic + content);
		}
	});
	
	//------------ relevant to lectures ends ------------//
	//------------ assignments functions ----------------//
	$("#no_add_assignment_i").click(function() {
		$("#no_add_assignments_container_div").toggle();
	});
	
	$("#no_assignment_add_item").click(function() {
		add_assignment_input_item();
	});
	
	var current_item = $("input[name='no_assignments_number_of_items']").val();
	$("#no_assignment_item_" + current_item).keypress(function(event) {
		if(event.keyCode == 13) {
			add_assignment_input_item();
		}
	});
	
	$("#no_assignment_remove_item").click(function(){
		var last_item_number = $("input[name='no_assignments_number_of_items']").val();
		$("#no_assignment_item_number_span_" + last_item_number).remove();
		$("#no_assignment_item_" + last_item_number).remove();
		$("#no_assignment_break_line_item_" + last_item_number).remove();
		$("input[name='no_assignments_number_of_items']").val(--last_item_number);
		if(parseInt($("input[name='no_assignments_number_of_items']").val()) < 2) {
			$("#no_assignment_remove_item").attr("disabled", true);
		}
	});
	
	$("input[name='no_assignment_subject']").keyup(function() {
		autocomplete_subject(this.value, "no_assignment_subject");
	});
	
	$("input[name='no_assignment_topic']").keyup(function() {
		autocomplete_topic(this.value, "no_assignment_topic");
	});
	
	$("#no_close_view_assignment_button").click(function() {
		$("#no_view_assignment_div").hide(100);
	});
	
	$("#no_add_assignment_button").click(function() {
		if(($.trim($("input[name='no_assignment_subject']").val()) != "") && ($.trim($("input[name='no_assignment_topic']").val()) != "")) {
			$.ajax({
				type: "POST",
				url: "../PHP/objects/notes/add_assignment.php",
				data: {"assignment_data": JSON.stringify($("#no_add_assignments_form").serializeArray())},
				success: function(data) {
					console.log("Success in adding assignment: " + data);
				},
				error: function(data) {
					console.log("An error occur while adding assignment: " + JSON.stringify(data));
				}
			});
		}
	});
	//------------ assignments functions ends ------------//
	
	//------------- scratch functions ---------------//
	$("select[name='no_scratch_search_select_field_name']").change(function() {
		var placeholder_value = "";
		if(this.value == "scratch_data") {
			placeholder_value = "Enter keyword";
		} else if(this.value == "time_added"){
			placeholder_value = "Enter time";
		} else {
			placeholder_value = "YYYY-MM-DD";
		}
		var field_name = this.value;
		var value = $("input[name='no_scratch_search_value']").val();
		if($.trim(value) != "") {
			search_scratch_data(field_name, value);
		} else {
			$("input[name='no_scratch_search_value']").attr("placeholder", placeholder_value);
		}
	});
	
	$("#no_scratch_search_button").click(function() {
		var value = $("input[name='no_scratch_search_value']").val();
		var field_name = $("select[name='no_scratch_search_select_field_name']").val();
		if($.trim(value) != "") {
			search_scratch_data(field_name, value);
		} else {
			$("input[name='no_scratch_search_value']").focus();
		}
	});
	
	$("#no_scratch_page_item_limiter_form").submit(function() {
		display_scratch_data();
        trigger_scratch_data_pager();
		return false;
	});

    $("#no_scratch_pager_ul").on("click", "li a", function() {
        $("#no_scratch_pager_ul li").removeClass("active");
        var total_pages = $("input[name='maximum_page']");
        var li_element = $(this.parentNode);
        var li_index = li_element.index() + 1;
        var page_limit = 0;
        var tracked_page = 0;
        var current_page = parseInt($(this).html());
        $("input[name='no_scratch_current_page']").val(current_page - 1);

        if(total_pages > 8) {
            if((li_index == 7 || li_index == 8) && current_page < total_pages) {
                page_limit = current_page + 6;
                if(page_limit >= total_pages) {
                    tracked_page = total_pages - 6;
                } else {
                    tracked_page = current_page - 1;
                }
                show_scratch_data_pager(tracked_page);
            } else if(li_index == 1 || li_index == 2) {
                page_limit = current_page - 5;
                if(page_limit > 0) {
                    tracked_page = current_page - 6;
                } else {
                    tracked_page = 1;
                }
                show_scratch_data_pager(tracked_page);
            }
            $("#no_scratch_page_" + current_page).toogleClass("active");
        } else {
            li_element.toogleClass("class");
        }
        display_scratch_data();
    });

	$("#no_save_scratch_data_button").click(function() {
		var scratch_data = $("textarea[name='no_scratch_data']").val();
		if($.trim(scratch_data != "")) {
			$.ajax({
				type: "POST",
				url: "../PHP/objects/notes/add_scratch_data.php",
				data: {"scratch_data": scratch_data},
				success: function(data) {
					$("textarea[name='no_scratch_data']").val("");
					display_scratch_data();
				},
				error: function(data) {
					console.log("An error occur while saving scratch data. " + JSON.stringify(data));
				}
			});
		}
	});
	
	$("#no_update_scratch_data_button").click(function() {
		var new_scratch_data = $("textarea[name='no_scratch_data']").val();
		var scratch_data_id = $("input[name='no_scratch_data_id']").val();
		if($.trim(new_scratch_data != "")) {
			$.ajax({
				type: "POST",
				url: "../PHP/objects/notes/update_scratch_data.php",
				data: {"new_scratch_data": new_scratch_data, "scratch_data_id": scratch_data_id},
				success: function(data) {
					if(data != "" || data != null) {
						var parsed_data = JSON.parse(data);
						$("#no_save_scratch_data_button").attr("disabled", false);
						$("#no_update_scratch_data_button").attr("disabled", true);
						$("textarea[name='no_scratch_data']").val("");
						$("#no_view_scratch_data_container_p_" + scratch_data_id).html(parsed_data.scratch_data_to_view);
						$("#no_display_scratch_data_container_span_" + scratch_data_id).html(parsed_data.scratch_data_to_display);
						$("#no_overlay_div").show(500);
						$("#no_scratch_data_individual_container_" + scratch_data_id).show(500);
					}
				},
				error: function(data) {
					console.log("An error occur while updating scratch data. " + JSON.stringify(data));
				}
			});
		}
	});
	
	//------------- scratch data functions ends here ---------------//
	
	$("#no_use_admin_dictionary").dblclick(function() {
		$("#no_overlay_div").show();
		$("#no_access_admin_dictionary_authorization_container").slideDown(500);
		$("input[name='no_access_dictionary_password']").focus();
	});
	
	$("#no_close_authorization_container").click(function() {
		$("#no_access_admin_dictionary_authorization_container").slideUp(500);
		$("#no_overlay_div").hide();
	});
	
	$("#no_access_dictionary_confirmation_form").submit(function() {
		$.ajax({
			type: "POST",
			url: "../PHP/objects/notes/accessing_dictionary_authorization.php",
			data: {"password": $("input[name='no_access_dictionary_password']").val()},
			success: function(data) {
				if(data == "true") {
					$("input[name='no_access_dictionary_password']").val("");
					$("#no_access_admin_dictionary_authorization_container").slideUp(500);
					$("#no_dictionary_container_div").show();
				}
			},
			error: function(data) {
				console.log("Error occur while authorizing to access administrator's dictionary");
			}
		});
		return false;
	});
	
	$("#no_close_dictionary_container").click(function() {
		$("#no_close_dictionary_confirmation_div").show(500);
	});
	
	$("#no_sure_close_dictionary_button").click(function() {
		$("#no_dictionary_container_div").slideUp(1000);
		$("#no_close_dictionary_confirmation_div").hide();
		$("#no_overlay_div").hide();
	});
	
	$("#no_no_close_dictionary_button").click(function() {
		$("#no_close_dictionary_confirmation_div").slideUp(500);
	});
	
	$("#no_show_add_dictionary_container").click(function() {
		$("#no_add_word_definition_container_div").toggle();
		$("input[name='no_word']").focus();
	});
	
	//---------- autocomplete ----------------//
	$("input[name='no_word_to_search']").keyup(function() {
		$.ajax({
			type: "POST",
			url: "../PHP/objects/notes/autocomplete_request.php",
			data: {"word": this.value},
			success: function(data) {
				var parsed_data = JSON.parse(data);
				$("input[name='no_word_to_search']").autocomplete({"source": parsed_data});
			},
			error: function(data) {
				console.log("An error occur while retrieving words: " + JSON.stringify(data));
			}
		})
	});
	
	//---------- adding into dictionary ---------
	$("#no_add_into_dictionary_button").click(function() {
		var word = $("input[name='no_word']").val();
		var definition = $("textarea[name='no_definition']").val();
		var reference = $("input[name='no_reference']").val();
		if(word != "" && definition != "" && reference != "") {
			$("#no_add_dictionary_loading_span").show();
			$.ajax({
				type: "POST",
				url: "../PHP/objects/notes/add_into_dictionary.php",
				data: {"word": word, "definition": definition, "reference": reference},
				success: function(data) {
					$("input[name='no_word']").val("");
					$("textarea[name='no_definition']").val("");
					$("input[name='no_reference']").val("");
					$("#no_add_dictionary_loading_span").hide();
					$("#no_successfully_added_dictionary_span").show();
					$("#no_successfully_added_dictionary_span").fadeOut(1000);
				},
				error: function(data) {
					console.log("An error occur while adding into dictionary: " + JSON.stringify(data));
				}
			});
		}
	});
	
	//----------------- displaying dictionary ----------------//
	$("#no_dictionary_app_form").submit(function() {
		$("#no_display_dictionary_loading_span").show();
		var word = $("input[name='no_word_to_search']").val();
		console.log("Submit! word is " + word);
		display_dictionary(word);
		return false;
	});
	$("#no_search_word_button").click(function() {
		$("#no_display_dictionary_loading_span").show();
		var word = $("input[name='no_word_to_search']").val();
		console.log("click! word is " + word);
		display_dictionary(word);
		return false;
	});
});

var integer_pattern  = /^[0-9]+$/;

function display_dictionary(word) {
	console.log("AJAX request called. Word is " + word);
	if(word != "") {
		console.log("Inside if! word is " + word);
		$.ajax({
			type: "POST",
			url: "../PHP/objects/notes/display_dictionary.php",
			data: {"word": word},
			success: function(data) {
				$("#no_display_dictionary_container_div").html(data);
			},
			complete: function() {
				$("#no_display_dictionary_loading_span").hide();
			},
			error: function(data) {
				console.log("An error occur while displaying dictionary: " + JSON.stringify(data));
			}
		});
	}
}

function autocomplete_subject(subject, input_name) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/autocomplete_subject.php",
		data: {"subject": subject},
		success: function(data) {
			if(data != "") {
				var parsed_data = JSON.parse(data);
				$("input[name='" + input_name + "']").autocomplete({"source": parsed_data});
			}
			
		},
		error: function(data) {
			console.log("An error occur while fetching subject intended for auto complete feature: " + JSON.stringify(data))
		}
	});
}

function autocomplete_topic(topic, input_name) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/autocomplete_topic.php",
		data: {"topic": topic},
		success: function(data) {
			if((data != "") || (data != null)) {
				var parsed_data = JSON.parse(data);
				$("input[name='" + input_name + "']").autocomplete({"source": parsed_data});
			}
		},
		error: function(data) {
			console.log("An error occur while retrieving topics for auto complete: " + JSON.stringify(data));
		}
	});
}

function display_lectures() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/display_lectures.php",
		success: function(data) {
			$("#no_display_lectures_container_div").html(data);
			$("#no_lectures_loading_div").hide();
		},
		error: function(data) {
			console.log("An error occur while displaying lecture content! " + JSON.stringify(data))
		}
	});
}

function show_lecture_content(lecture_id) {
	$("#no_lecture_content_" + lecture_id).toggle();
	var status = $("#no_lecture_status_span_" + lecture_id).html();
	if(status == "[open]") {
		$("#no_lecture_status_span_" + lecture_id).html("[close]");
	} else {
		$("#no_lecture_status_span_" + lecture_id).html("[open]");
	}
}

function add_assignment_input_item() {
	var previous_item_number = parseInt($("input[name='no_assignments_number_of_items']").val());
	var new_item_number = ++previous_item_number;
	$("input[name='no_assignments_number_of_items']").val(new_item_number)
	$("#no_add_assignments_form").append("<span id='no_assignment_item_number_span_" + new_item_number + "'>" + new_item_number + ".</span> <input type='text' class='no_assignment_items_input' id='no_assignment_item_" + new_item_number + "' name='no_assignment_item_" + new_item_number + "' /><br id='no_assignment_break_line_item_" + new_item_number + "' />");
	$("#no_assignment_remove_item").attr("disabled", false);
	$("#no_assignment_item_" + new_item_number).focus();
	
	var current_item = $("input[name='no_assignments_number_of_items']").val();
	$("#no_assignment_item_" + current_item).keypress(function(event) {
		if(event.keyCode == 13) {
			add_assignment_input_item();
		}
	});
}

function display_assignments() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/display_assignments.php",
		success: function(data) {
			$("#no_display_assignment_table").html(data);
		},
		error: function(data) {
			console.log("An error occur while trying to display assignments. " + JSON.stringify(data));
		}
	});
}

function view_assignment(assignment_detail_id) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/view_assignment.php",
		data: {"assignment_detail_id": assignment_detail_id},
		success: function(data) {
			var topic = $("#no_assignment_tr_" + assignment_detail_id + " td:first").html();
			var timestamp = $("#no_assignment_tr_" + assignment_detail_id + " td:eq(1)").html();
			$("#no_assignment_detail_container_p").html("<span>" + topic + "</span><span class='pull-right'>" + timestamp + "</span>");
			$("#no_assignment_items_container_dl").html(data);
			$("#no_view_assignment_div").show();
		},
		error: function(data) {
			console.log("An error occur while trying to view an assignment. " + JSON.stringify(data));
		}
	});
}

function update_assignment_answer(assignment_item_id) {
	var previous_answer = $("#no_assignment_answer_span_" + assignment_item_id).html();
	if(previous_answer != "no answer") {
		$.ajax({
			type: "POST",
			url: "../PHP/objects/notes/retrieve_assignment_answer_to_update.php",
			data: {"assignment_item_id": assignment_item_id},
			success: function(data) {
				$("textarea[name='no_assignment_answer_input_" + assignment_item_id + "']").val(data);
			},
			error: function(data) {
				console.log("Error in retrieving assignment answer to update. " + JSON.stringify(data));
			}
		});
	}
	$("#no_assignment_answer_input_p_" + assignment_item_id).toggle();
	$("#no_assignment_answer_span_" + assignment_item_id).toggle();
}

function update_assignment_answer_request(assignment_item_id) {
	var answer = $("textarea[name='no_assignment_answer_input_" + assignment_item_id + "']").val();
	if($.trim(answer) != "") {
		$.ajax({
			type: "POST",
			url: "../PHP/objects/notes/update_assignment_answer.php",
			data :{"assignment_item_id": assignment_item_id, "answer": answer},
			success: function(data) {
				$("#no_update_assignment_answer_sup_" + assignment_item_id).html("[update answer]");
				$("#no_assignment_answer_span_" + assignment_item_id).html(data);
				$("#no_assignment_answer_input_p_" + assignment_item_id).toggle();
				$("#no_assignment_answer_span_" + assignment_item_id).toggle();
				console.log("Success in updating assignment answer" + data);
			},
			error: function(data) {
				console.log("An error occur while updating assignment's answer. " + JSON.stringify(data));
			}
		});
	}
}

// -------------------- scratch data functions ----------------------//
function display_scratch_data() {
	var current_page = $("input[name='no_scratch_current_data']").val();
	var item_limit = $("input[name='no_scratch_page_item_limit']").val();
	if(current_page == "") {
        current_page = 0;
    }
    if(!integer_pattern.test(item_limit)) {
		item_limit = 5;
	}
	
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/display_scratch_data.php",
		data: {"current_page": current_page, "item_limit": item_limit},
		success: function(data) {
            console.log("Data returned: ");
			if(data != "" || data != null) {
				var parsed_data = JSON.parse(data);
				$("#no_display_scratch_data_table").html(parsed_data.scratch_data_to_display);
				$("#no_scratch_data_to_view_container").html(parsed_data.scratch_data_to_view);
			}
		},
		error: function(data) {
			console.log("An error occur while displaying scratch' data. "+ JSON.stringify(data));
		}
	});
}

function view_scratch_data(scratch_data_id) {
	$("#no_overlay_div").show();
	$("#no_scratch_data_individual_container_" + scratch_data_id).show();
}

function close_viewed_scratch_data(scratch_data_id) {
	$("#no_overlay_div").slideUp(500);
	$("#no_scratch_data_individual_container_" + scratch_data_id).slideUp(500);
}

function delete_scratch_data(scratch_data_id) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/delete_scratch_data.php",
		data: {"scratch_data_id": scratch_data_id},
		success: function() {
			$("#no_scratch_data_tr_" + scratch_data_id).remove();
			$("#no_scratch_data_individual_container_" + scratch_data_id).remove();
			$("#no_overlay_div").slideUp(500);
			$("#no_scratch_data_individual_container_" + scratch_data_id).slideUp(500);
		},
		error: function(data){
			console.log("Error while deleting scratch data. "+ JSON.stringify(data));
		}
	});
}

function update_scratch_data(scratch_data_id) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/retrieve_scratch_data_to_update.php",
		data: {"scratch_data_id": scratch_data_id},
		success: function(data) {
			if(data != "" || data != null) {
				var parsed_data = JSON.parse(data);
				$("input[name='no_scratch_data_id']").val(parsed_data.scratch_data_id);
				$("textarea[name='no_scratch_data']").val(parsed_data.scratch_data);
				$("textarea[name='no_scratch_data']").focus();
				$("#no_save_scratch_data_button").attr("disabled", true);
				$("#no_update_scratch_data_button").attr("disabled", false);
				$("#no_overlay_div").hide();
				$("#no_scratch_data_individual_container_" + scratch_data_id).hide();
			}
		},
		error: function(data) {
			console.log("An error occur while retrieving scratch data to update. " + JSON.stringify(data));
		}
	});
}

function search_scratch_data(field_name, value) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/search_scratch_data.php",
		data: {"field_name": field_name, "value": value},
		success: function(data) {
			console.log("DATA IS " + data);
			if((data != "") || (data != null)) {
				var parsed_data = JSON.parse(data);
				$("#no_display_scratch_data_table").html(parsed_data.scratch_data_to_display);
				$("#no_scratch_data_to_view_container").html(parsed_data.scratch_data_to_view);
			}
		},
		error: function(data) {
			console.log("Error in search scratch_data");
		}
	});
}

function trigger_scratch_data_pager() {
	var item_limit = $("input[name='no_scratch_page_item_limit']").val();
	if(!integer_pattern.test(item_limit)) {
		item_limit = 5;
	}
	item_limit = parseInt(item_limit);
	
	$.ajax({
		type: "POST",
		url: "../PHP/objects/notes/trigger_scratch_data_pager.php",
		data: {"item_limit": item_limit},
		success: function(data) {
			console.log("Data is " + data);
			if((data != "") || (data != null)) {
				var parsed_data = JSON.parse(data);
				$("#no_scratch_pager_ul").html(parsed_data.li_elements);
			    $("#no_scratch_total_page").html(parsed_data.number_of_pages);
                $("input[name='no_scratch_total_pages']").val(parsed_data.number_of_pages);
			}
		},
		error: function(data) {
			console.log("Error in triggering scratch data's pager. " + JSON.stringify(data));
		}
	});
}

function show_scratch_data_pager(tracked_page) {
    var new_li_elements_pager = "";
    for(var counter = 1; counter <= 8; counter++) {
        new_li_elements_pager += "<li id = 'no_scratch_page_" + tracked_page + "'><a href='Javascript:void(0)'>" + tracked_page + "</a>a></li>";
        tracked_page++;
    }
}
// -------------------- scratch data functions end ----------------------//
