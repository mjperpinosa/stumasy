$(document).ready(function() {
	
	$("input[name='username_entered']").focus();

	$("#create_account_a").click(function() {
		$("#lp_overlay_div").show();
		$("#lp_dialog_div").slideDown(500);
	});
	$("#lp_proceed_a").click(function() {
		$("#lp_overlay_div").hide();
		$("#lp_dialog_div").slideUp(500);
		$("#lp_body_content_div").load("create_account.php");
		$("#lp_body_div").css("height", "inherit");
	});
	$("#lp_no_a").click(function() {
		$("#lp_overlay_div").hide();
		$("#lp_dialog_div").slideUp();
		$("input[name='username_entered']").focus();
	});
	
	$("#lp_login_button").click(function() {
		login_process();
	});
	
	$("#lp_login_form").submit(function() {
		login_process();
	});
});

function login_process() {
	var username_entered = $("input[name='username_entered']").val();
	var password_entered = $("input[name='password_entered']").val();
	if(username_entered == "") {
		$("input[name='username_entered']").focus();
	} else if(password_entered == "") {
		$("input[name='password_entered']").focus();
	} else {
		$("#lp_laoding_div").show();
		$("#lp_overlay_div").show();
		$.ajax({
			type: "POST",
			url: "../PHP/objects/users/login_user.php",
			data: {"username_entered": username_entered, "password_entered": password_entered},
			success: function(data) {
				console.log("data is = " + data);
				if(data == "true") {
					window.location.assign("home.php");
					$("#lp_laoding_div").hide();
					$("#lp_overlay_div").hide();
				} else {
					$("#lp_laoding_div").hide();
					$("#lp_overlay_div").hide();
					$("#account_invalid_p").html(data);
					$("#account_invalid_p").show();
					if(data == "Ooopss. Incorrect password!") {
						$("input[name='password_entered']").val("");
						$("input[name='password_entered']").focus();
					} else {
						$("input[name='username_entered']").val("");
						$("input[name='username_entered']").focus();
					}
				}				},
			error: function(data) {
				console.log("There's an error in logging in: " + JSON.stringify(data));
			}
		});
	}
}