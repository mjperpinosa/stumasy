
<div id="up_container_div">
	
	<div id="up_add_post_div" class="pull-right">
		<textarea name="up_post" placeholder="Write and post..."></textarea> <br />
		<form class="pull-left" id="up_upload_image_form" enctype="multipart/form-data">
			<input type="file" name="up_file_to_post" id="up_file_to_post" />
			<span id="up_image_name_span">attach image/file</span>
		</form>
		<button id="up_add_post_button" class="btn btn-mini btn-info pull-right">POST</button>
	</div><!-- up_add_post_div ends -->
	<div id="up_posts_wrapper_div">
		<h4>Recent posts: </h4>
		<div id="up_upload_progress_bar"></div>
		<div id="up_posts_div">
		</div><!-- up_posts_div ends -->
	</div>
	
	<div id="up_overlay_div"></div><!-- up_overlay_div ends -->

	<script src="../JS/jquery-1.9.1.min.js"></script>
	<script src="../JS/jquery-ui-1.10.2.min.js"></script>
	<script src="../JS/bootstrap.min.js"></script>	
	<script src="../JS/updates.js"></script>
	
</div><!-- up_container_div ends -->