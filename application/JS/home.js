$(function() {
	
	display_profile_image();
	var document_height = $("body").css("height");
	$("#h_side_navigator_div").css("height", document_height);
	
	//----- Redirecting users -----//
	$("#h_home_li").click(function() {
		$("#h_navigator_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
		$("#h_contents_container_div").load("updates.php");
		$("title").html("StuMaSy-Home");
	});
	$("#h_class_sched_li").click(function() {
		$("#h_navigator_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
		$("#h_contents_container_div").load("schedules.php");
		$("title").html("StuMaSy-Schedules");
	});
	$("#h_notes_li").click(function() {
		$("#h_navigator_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
		//------------ authorization -----------------//
		
		$("#h_contents_container_div").load("notes.php");
		$("title").html("StuMaSy-Notes");
	});
	$("#h_stuffs_li").click(function() {
		$("#h_navigator_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
		$("#h_contents_container_div").load("stuffs.php");
		$("title").html("StuMaSy-Stuffs");
	});
	$("#h_profile_li").click(function() {
		$("#h_navigator_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
		$("#h_contents_container_div").load("profile.php");
		$("title").html("StuMaSy-Profile");
	});
	$("#h_settings_li").click(function() {
		$("#h_navigator_ul li").removeClass("favorite_background");
		$(this).addClass("favorite_background");
		$("#h_contents_container_div").load("settings.php");
		$("title").html("StuMaSy-Settings");
	});
	
	//--------------- sub-links ends -------------//
});

function display_profile_image() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/profiles/display_profile_image.php",
		success: function(data) {
			console.log("Image data = " + data);
			$("#h_profile_image_container_img").attr("src", "../../documents/images/" + data);
		},
		error: function(data) {
			console.log("Error in displaying profile image: " + JSON.stringify(data));
		}
	});
}