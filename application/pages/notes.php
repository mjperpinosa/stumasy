<div id="no_main_container_div">
	
	<div id="no_container_div">
		<i class="icon-globe pull-left" id="no_use_admin_dictionary"></i>
		<ul id="no_options_container_ul">
			<li class="favorite_background"><a href="#no_lectures_container">lectures</a></li>
			<li><a href="#no_assignments_ontainer">assignments</a></li>
			<li><a href="#no_projects_container">projects</a></li>
			<li><a href="#no_events_container">events</a></li>
			<li><a href="#no_reminders_container">reminders</a></li>
			<li><a href="#no_grades_container">grades</a></li>
			<li><a href="#no_scratch_container">scratch</a></li>
		</ul>
		<div id="no_lectures_container">
			<div id="no_lectures_loading_div">
				<img src="../CSS/images/loading_image.gif" />
				Loading data...
			</div>
			<h4>Lectures<i class="icon-plus-sign" id="no_add_lecture_i"></i></h4>
			<div id="no_add_lectures_container_div">
				<button class="btn btn-mini btn-info pull-right" id="no_add_lecture_button">save</button>
				<form id="no_add_lectures_form">
					subject: <input type="text" name="no_lecture_subject" /><br />
					topic: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="no_lecture_topic" /><br />
					content:<br /><textarea name="no_lecture_content_textarea" placeholder="click here to write the content"></textarea>
				</form>
			</div><!-- no_add_lectures_container_div ends -->
			<div id="no_display_lectures_container_div"></div><!-- no_display_lectures_container_div  ends -->
		</div><!-- no_lectures_container ends -->
		<div id="no_assignments_ontainer">
			<h4>Assignments<i class="icon-plus-sign" id="no_add_assignment_i"></i></h4>
			<div id="no_add_assignments_container_div">
				<button class="btn btn-mini btn-info pull-right" id="no_add_assignment_button">save</button>
				<form id="no_add_assignments_form">
					subject: <input type="text" name="no_assignment_subject" /><br />
					topic: &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="no_assignment_topic" /><br />
					1. <input type="text" class="no_assignment_items_input" id="no_assignment_item_1" name="no_assignment_item_1" /><br />
					<input type="hidden" name="no_assignments_number_of_items" value="1" />
				</form>
				<button class="btn btn-info btn-mini" id="no_assignment_add_item">[add item]</button>
				<button class="btn btn-danger btn-mini" id="no_assignment_remove_item" disabled=true>[delete last item]</button>
			</div><!-- no_add_assignments_container_div ends -->
			
			<div id="no_display_assignment_container">
				<div id="no_view_assignment_div">
					<button class="close pull-right" id="no_close_view_assignment_button" area-hidden=true>&times;</button><br />
					<p id="no_assignment_detail_container_p"></p>
					<hr />
					<dl id="no_assignment_items_container_dl"></dl>
				</div><!-- no_view_assignment_div ends -->
			
				<table id="no_display_assignment_table" class="table table-bordered"></table>
			</div><!-- no_display_assignment_container ends -->
		</div><!-- no_assignments_container ends -->
		<div id="no_projects_container">
			<h4>Projects</h4>
		</div><!-- no_projects_container ends -->
		<div id="no_events_container">
			<h4>Events</h4>
		</div><!-- no_events_container ends-->
		<div id="no_reminders_container">
			<h4>Reminders</h4>
		</div><!-- no_reminders_container ends -->
		<div id="no_grades_container">
			<h4>Grades</h4>
		</div><!-- no_grades_container ends -->
		<div id="no_scratch_container">
			<h4>Scratch</h4>
			<div id="no_add_scratch_data_container">
				<textarea name="no_scratch_data" placeholder="Enter data here" required></textarea><br />
				<input type="hidden" name="no_scratch_data_id" />
				<span class="pull-right">
					<button class="btn btn-mini btn-info" id="no_save_scratch_data_button">save</button> 
					<button class="btn btn-mini btn-info" id="no_update_scratch_data_button" disabled=true>update</button>
				</span>
			</div><!-- no_add_scratch_data_container ends -->
			<div id="no_display_scratch_data_container">
				<div id="no_search_scratch_data_feature_container">
					filter by:
					<select class="input-mini" name="no_scratch_search_select_field_name">
						<option value="scratch_data">key word</option>
						<option value="time_added">time</option>
						<option value="date_added">date</option>
					</select>
					<input type="text"  class="input-medium" name="no_scratch_search_value" placeholder="Enter keyword" required />
					<button class="btn btn-mini btn-info" id="no_scratch_search_button"><i class="icon-search"></i> search</button>
				</div><!-- no_search_scratch_data_feature_container ends -->
				<table class="table" id="no_display_scratch_data_table"></table>
				<div id="no_scratch_pagination_container">
					<p id="no_scratch_page_tracker">
						Page 
						<span id="no_scratch_current_page">1</span>
						out of
						<span id="no_scratch_total_page"></span>
					</p><!-- no_scratch_page_tracker ends -->
					<div id="no_scratch_pager" class="pagination pagination-centered pagination-mini">
						<ul id="no_scratch_pager_ul"></ul>
					</div><!-- no_scratch_pager ends -->
					<div id="no_scratch_page_item_limiter_container">
						<form id="no_scratch_page_item_limiter_form">
							<input type="text" name="no_scratch_page_item_limit" placeholder="limit" class="input-mini" required/>
						</form><!-- no_scratch_page_limiter_form ends -->
					</div><!-- no_scratch_page_limiter_container ends -->
                    <input type="hidden" name="no_scratch_current_page" />
					<input type="hidden" name="no_scratch_total_pages" />
                    <input type="hidden" name="no_scratch_maximum_page" />
				</div><!-- no_scratch_pagination_container ends -->
				<div id="no_scratch_data_to_view_container"></div><!-- no_scratch_data_to_view_container -->
			</div><!-- no_display_scratch_data_container ends -->
		</div><!-- no_scratch_container ends-->
		
	</div>
	<div id="no_access_admin_dictionary_authorization_container">
		<button class="close" area-hidden="true" id="no_close_authorization_container">&times;</button>
		<h3>Authorization required!</h3>
		<p>
			You are trying to access a private part of this system.<br />
			Please enter the legitimate code to confirm that you the site's administrator:<br />
			<form id="no_access_dictionary_confirmation_form">
				<input type="password" name="no_access_dictionary_password" required />
			</form>
		</p>
	</div><!-- no_access_admin_dictionary_authorization_container ends -->
	<div id="no_dictionary_container_div">
		<button class="close pull-right" area-hidden="true" id="no_close_dictionary_container">&times;</button>
		<h3>miniGeek's miniDic<i class="icon-plus-sign" id="no_show_add_dictionary_container"></i></h3>
		<div id="no_add_word_definition_container_div">
			<dl>
				<dt>word:</dt>
				<dd><input type="text" name="no_word" placeholder="word to define" required /></dd>
				<dt>definition:</dt>
				<dd><textarea name="no_definition" placeholder="word definition" required></textarea></dd>
				<dt>reference:</dt>
				<dd><input type="text" name="no_reference" placeholder="reference of the definition" required /></dd>
				<span id="no_add_dictionary_loading_span" class="pull-left">
					<img src="../CSS/images/loading_image.gif" />
					saving...
				</span>
				<span id="no_successfully_added_dictionary_span" class="pull-left">Successfully added!</span>
				<button id="no_add_into_dictionary_button" class="btn btn-info btn-mini pull-right">submit</button>
			</dl>
		</div><!-- no_add_word_definition_container_div -->
		<div id="no_close_dictionary_confirmation_div">
				<h3>MiniGeek says:</h3><br />
				Are you sure you wanna leave this application?<br /><br />
				<button class="btn btn-danger pull-left" id="no_sure_close_dictionary_button">sure</button>
				<button class="btn btn-info pull-right" id="no_no_close_dictionary_button">no</button>
			</div><!-- close_dictionary_confirmation_div ends -->
		<div id="no_dictionary_app_container_div">
			<form id="no_dictionary_app_form">
				<input type="text" name="no_word_to_search" placeholder="word to search" required />
				<button id="no_search_word_button" class="btn btn-info btn-mini"><i class="icon-search"></i>search</button>
				<br />
				<span id="no_display_dictionary_loading_span">
					<img src="../CSS/images/loading_image.gif" />
					retrieving...
				</span>
			</form>
			<div id="no_display_dictionary_container_div">
			</div><!-- no_display_container_div ends -->
		</div><!-- no_dictionary_app_container_div -->
	</div><!-- no_dictionary_container_div ends -->
	
	<div id="no_overlay_div"></div>
	
	<script src="../JS/jquery-1.9.1.min.js"></script>
	<script src="../JS/jquery-ui-1.10.2.min.js"></script>
	<script src="../JS/bootstrap.min.js"></script>	
	<script src="../JS/notes.js"></script>
</div><!-- no_main_container_div ends -->