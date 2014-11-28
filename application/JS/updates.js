$(document).ready(function() {
	console.log("Scripts for updates already running...");
	
	display_posts();
	$(".icon-thumbs-up").tooltip();
	$(".icon-thumbs-down").tooltip();
	
	form_data = false;
	if(window.FormData) {
		form_data = new FormData();
	}
	file_data = "";
	$("input[name='up_file_to_post']").change(function() {
		file_data = this.files[0];
		$("#up_image_name_span").html(file_data.name.substring(0, 15) + "...")
	});
	$("#up_add_post_button").click(function() {
		var post = $("textarea[name='up_post']").val();		
		if((post != "") || (file_data != "")) {
			if(form_data) {
				if($("input[name='up_file_to_post']").val() != "") {
					form_data.append("file_included", "true");
				} else {
					form_data.append("file_included", "false") ;
				}
				form_data.append("up_file_to_post", file_data);
				form_data.append("post", post);
				$.ajax({
					type: "POST",
					url: "../PHP/objects/updates/add_post.php",
					data: form_data,
					processData: false,
					contentType: false,
					success: function(data) {
						$("#up_posts_div").prepend(data);
						$("input[name='up_file_to_post']").val("");
						$("textarea[name='up_post']").val("");
						$("#up_image_name_span").html("attach image/file");
					},
					error: function(data) {
						console.log("Error in posting your status: " + JSON.stringify(data));
					}
				});
			}
		}
	});
});

//----------- JavaScript methods --------- //

//----------- displaying posts --------------//
function display_posts() {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/updates/display_posts.php",
		data: {},
		success: function(data) {
			$("#up_posts_div").html(data);
		},
		error: function(data) {
			console.log("Error in displaying posts: " + JSON.stringify(data));
		}
	});
	setTimeout(display_posts, 1000);
}

//----------- like post process ------- //
function like_post(post_id) {
	$.ajax({
		type: "POST",
		url: "../PHP/objects/updates/toggle_like_post.php",
		data: {"post_id": post_id},
		success: function(data) {
			$("#up_like_post_" + post_id).toggleClass("icon-thumbs-up");
			$("#up_like_post_" + post_id).toggleClass("icon-thumbs-down");
			var current_user_like_it = $("#up_likers_for_post_" + post_id).find($("#up_current_user_likes_post_" + post_id));
			if(current_user_like_it.length == 1) {
				$("#up_likers_for_post_" + post_id).find($("#up_current_user_likes_post_" + post_id)).remove();
			} else {
				$("#up_likers_for_post_" + post_id).append("<li id='up_current_user_likes_post_" + post_id + "'>You</li>");
			}
		},
		error: function(data) {
			console.log("Error in liking a post: " + JSON.stringify(data));
		}
	});
}

//------------ write a comment for a post ------------//
function write_comment(post_id, element) {
	element.title = "Double click to toggle comments.";
	
	$("#up_write_comment_container_span_" + post_id + " input").val("");
	$("#up_comments_container_div_" + post_id).show();
	$("#up_write_comment_container_span_" + post_id + " input").focus();
	
	$(document).keypress(function(event) {
		if(event.keyCode == 13) {
			var comment = $("#up_write_comment_container_span_" + post_id + " input").val();
			if(comment != "") {
				write_comment_request(post_id, comment);
			}
		}
	});
}

function hide_add_comment_container(post_id, element) {
	$("#up_comments_container_div_" + post_id).hide();
	element.title = "comments";
}

function write_comment_through_button_click_event(post_id) {
	var comment = $("#up_write_comment_container_span_" + post_id + " input").val();
	console.log("Comment is: " + comment);
	console.log("Gitawag sa button");
	write_comment_request(post_id, comment);
}

function write_comment_request(post_id, comment) {
	if(comment != "") {
		$.ajax({
			type: "POST",
			url: "../PHP/objects/updates/add_comment.php",
			data: {"post_id": post_id, "comment": comment},
			success: function(data) {
				$("#up_write_comment_container_span_" + post_id + " input").val("");
				$("#up_comments_container_div_for_post_" + post_id).append(data);
			},
			error: function(data) {
				console.log("Error in writing comment: " + JSON.stringify(data));
			}
		});
	} else {
		$("#up_write_comment_container_span_" + post_id + " input").focus();
	}
}

function update_comment(comment_id) {
	var previous_comment = $("#up_comment_" + comment_id).html();
	$("#up_comment_" + comment_id).html("<form id='up_new_comment_form_" + comment_id + "'><input type='text' name='up_new_comment' value='" + previous_comment + "' required /><br /><span>Press Enter to update.</span></form>");
	$("input[name='up_new_comment']").focus();
	
	$("input[name='up_new_comment']").blur(function() {
		var new_comment = $("input[name='up_new_comment']").val();
		update_comment_request(comment_id, new_comment);
	});
	
	$("#up_update_comment_button_" + comment_id).click(function() {
		var new_comment = $("input[name='up_new_comment']").val();
		update_comment_request(comment_id, new_comment);
	});
	
	$("#up_new_comment_form_" + comment_id).submit(function() {
		var new_comment = $("input[name='up_new_comment']").val();
		update_comment_request(comment_id, new_comment);
		return false;
	})
}

function update_comment_request(comment_id, new_comment) {
	if(new_comment != "") {
		$("#up_comment_" + comment_id).html(new_comment);
		$.ajax({
			type: "POST",
			url: "../PHP/objects/updates/update_comment.php",
			data: {"comment_id": comment_id, "new_comment": new_comment},
			success: function(data) {
				$("#up_comment_info_container_span_" + comment_id).html(data);
			},
			error: function(data) {
				console.log("Error in updating comment: " + JSON.stringify(data));
			}
		});
	}
}

//------------ process on deleting a comment --------------- //
function delete_comment(comment_id) {
	$("#up_delete_comment_confirmation_span_" + comment_id).show();
	
	$("#up_delete_comment_a_" + comment_id).click(function() {
		$("#up_comment_container_" + comment_id).remove();
		$.ajax({
			type: "POST",
			url: "../PHP/objects/updates/delete_comment.php",
			data: {"comment_id": comment_id},
			success: function(data) {
				console.log("Successful in deleting! Comment id is: " + comment_id);
				$("#up_delete_comment_confirmation_span_" + comment_id).show();
			},
			error: function(data) {
				console.log("Error in deleting a comment: " + JSON.stringify(data));
			}
		});
	});
	
	$("#up_cancel_delete_comment_a_" + comment_id).click(function() {
		$("#up_delete_comment_confirmation_span_" + comment_id).hide();
	});
	
	$("#up_likers_for_post_36").show();
}

// ---------------- showing likers -----------//
function show_likers(post_id) {
	$("#up_likers_for_post_" + post_id).tooltip();
	$("#up_likers_for_post_" + post_id).addClass("up_show_element");
}

function hide_likers(post_id) {
	$("#up_likers_for_post_" + post_id).removeClass("up_show_element");
}