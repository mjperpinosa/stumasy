$(document).ready(function() {
	console.log("Profile JavaScript already running...");
	display_profile_information();
	
	$("#pr_change_profile_image_button").click(function() {
		$("input[name='pr_profile_image']").click();
	});
	
	$("input[name='pr_profile_image']").change(function() {
		var image_data = this;
        var form_data = false;
		if(window.FormData) {
			form_data = new FormData();
		}
		if(form_data) {
			form_data.append("pr_profile_image", image_data.files[0]);
		}
		if(form_data) {
			$.ajax({
				type: "POST",
				url: "../PHP/objects/profiles/change_profile_image.php",
				data: form_data,
				processData: false,
				contentType: false,
				success: function(data) {
					$("#h_profile_image_container_img").attr("src", "../../documents/images/" + data);
					console.log("Success in changing profile image: " + data);
				},
				error: function(data) {
					console.log("Error occurs while changing profile image: " + JSON.stringify(data));
				}
			});
		}
	});
	
});

function display_profile_information() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/profiles/display_profile_information.php",
		success: function(data) {
			console.log(data);
			var parsed_data = JSON.parse(data);
			$("#pr_lastname").html(parsed_data.user_lastname);
			$("#pr_firstname").html(parsed_data.user_firstname);
			$("#pr_middlename").html(parsed_data.user_middlename);
			$("#pr_birthday").html(parsed_data.user_birthday);
			$("#pr_age").html(parsed_data.user_age);
			$("#pr_address").html(parsed_data.user_address);
			$("#pr_educational_level").html(parsed_data.user_educational_level + " student.");
			$("#pr_school_name").html(parsed_data.user_school_name);
			$("#pr_college_course").html(parsed_data.user_college_course);
			$("#pr_year_level").html(parsed_data.user_year_level);
			$("#pr_section").html(parsed_data.user_section);
			$("#pr_adviser").html(parsed_data.user_adviser);
		},
		error: function(data) {
			console.log("An error occur while displaying profile information: " + JSON.stringify(data))
		}
	})
}