$(function() {

	$("#ca_back_span").tooltip();
	$("#ca_back_span").click(function(){
		$("#lp_body_content_div").load("login.php #lp_body_content_div");
	});
	$("#ca_back_to_login_a").click(function() {
		$("#ca_overlay_div").hide();
		$("#lp_body_content_div").load("login.php #lp_body_content_div");
		$("input[name='username_enetered']").focus();
	});
	
	var ca_birth_month = $("select[name='ca_birth_month']");
	var birth_months = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
	for(var counter = 0; counter < birth_months.length; counter++) {
		ca_birth_month.append("<option value=" + (counter + 1) + ">" + birth_months[counter] + "</option>");
	}
	
	for(var counter = 1; counter <= 31; counter++) {
		$("select[name='ca_birth_date']").append("<option>" + counter + "</option>");
	}
	ca_birth_month.change(function() {
		if(ca_birth_month.val() == 2) {
			$("select[name='ca_birth_date']").html("");
			for(var counter = 1; counter <= 29; counter++) {
				$("select[name='ca_birth_date']").append("<option>" + counter + "</option>");
			}
		} else if(ca_birth_month.val() == 1 ||
		   ca_birth_month.val() == 3 ||
		   ca_birth_month.val() == 5 ||
		   ca_birth_month.val() == 7 ||
		   ca_birth_month.val() == 8 ||
		   ca_birth_month.val() == 10 ||
		   ca_birth_month.val() == 12) {
			$("select[name='ca_birth_date']").html("");
			for(var counter = 1; counter <= 31; counter++) {
				$("select[name='ca_birth_date']").append("<option>" + counter + "</option>");
			}
		} else {
			$("select[name='ca_birth_date']").html("");
			for(var counter = 1; counter <= 30; counter++) {
				$("select[name='ca_birth_date']").append("<option>" + counter + "</option>");
			}
		}
	});
	
	for(var birth_year_max = 2007; birth_year_max >= 1980; birth_year_max--) {
		$("select[name='ca_birth_year']").append("<option>" + birth_year_max + "</option>");
	}
	
	$("select[name='educational_level']").change(function() {
		if($("select[name='educational_level']").val() == "Elementary") {
			$("#ca_course_tr").hide();
			$("select[name='year_level']").html("<option>Grade 1</option><option>Grade 2</option><option>Grade 3</option><option>Grade 4</option><option>Grade 5</option><option>Grade 6</option>");
		} else {
			$("#ca_course_tr").show();
			$("select[name='year_level']").html("<option>1st Year</option><option>2nd Year</option><option>3rd Year</option><option>4th Year</option><option>5th Year</option><option>6th Year</option>");
		}
	});
	
	//----- adding users -----//
	$("#ca_create_account_button").click(function() {
		var user_data = $("#account_form").serializeArray();
		var empty_field = "";
		var string_pattern = /^[a-z, A-Z, -, .]*$/;
		var invalid_data = "";
		
		for(var counter = 0; counter < user_data.length; counter++) {
			if(user_data[counter].value == "") {
				empty_field = user_data[counter].name;
				break;
			}
			if(counter == 2 || counter == 3 || counter == 4 || counter == 10 || counter == 12 || counter == 13) {
				var data_valid = string_pattern.test(user_data[counter].value);
				if(data_valid == false) {
					invalid_data = user_data[counter].name;
					break;
				}
			}
		}
		if(empty_field == "" && invalid_data == "") {
			if($("input[name='password']").val() == $("input[name='confirm_password']").val()) {
				console.log("loading na sunod");
				$("#ca_overlay_div").removeClass("hidden");
				$("#ca_laoding_div").removeClass("hidden");
				$("#ca_laoding_div").addClass("show_element");
				$("#ca_overlay_div").addClass("show_element");
				$.ajax({
					type: "POST",
					url: "../PHP/objects/users/add_user.php",
					data: {"user_data": JSON.stringify($("#account_form").serializeArray())},
					success: function(data) {
						$("#ca_laoding_div").hide();
						$("#ca_new_user_span").html(data);
						$("#ca_dialog_div").show();;
						console.log("added! " + data);
					},
					error: function(data) {
						console.log("error in adding a user: " + data);
					}
				});
			} else {
				$("input[name='confirm_password']").val("");
				$("input[name='confirm_password']").focus();
			}
		} else if(empty_field != "") {
			console.log("There was an empty field!");
			$("input[name='" + empty_field + "']").focus();
		} else {
			console.log("Check your entered data.");
			$("input[name='" + invalid_data + "']").focus();
		}
	});
	
});