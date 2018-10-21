<?php
	session_start();
	if(!isset($_SESSION["user_id"])) {
		header("Location: login.php");
	}
?>
<div id="cs_container_div">
	<h4>Manage Your Class Schedules</h4>
	<div id="cs_menu_container_div">
		<a id="cs_add_a">add schedule</a>
		<a id="cs_update_a">update schedule</a>
		<a id="cs_remove_a">remove schedule</a>
		<!--<a>more</a>-->
	</div><!-- cs_menu_container_div end -->
	
	<div id="cs_add_schedule_div">
		<form id="class_schedule_form">
			<h2>Class Schedule</h2>
			<table>
				<tr>
					<td>Day:</td>
					<td>
						<select name="cs_day">
							<option value="1">Monday</option>
							<option value="2">Tuesday</option>
							<option value="3">Wednesday</option>
							<option value="4">Thursday</option>
							<option value="5">Friday</option>
							<option value="6">Saturday</option>
							<option value="7">Sunday</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Time(start):</td>
					<td id="cs_ts_td">
						<select name="cs_ts_hour"></select>:
						<select name="cs_ts_minute"></select>
						<select name="cs_ts_am_pm">
							<option>AM</option>
							<option>PM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Time(end):</td>
					<td id="cs_te_td">
						<select name="cs_te_hour"></select>:
						<select name="cs_te_minute"></select>
						<select name="cs_te_am_pm">
							<option>AM</option>
							<option>PM</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Subject:</td> <td><input type="text" name="cs_subject" /></td>
				</tr>
				<tr>
					<td>Teacher:</td> <td><input type="text" name="cs_teacher" /></td>
				</tr>
			</table>
		</form>
		<input type="hidden" name="cs_id" />
		<button class="btn btn-mini btn-info pull-left" id="cs_add_schedule_button">add</button>
		<button class="btn btn-mini btn-info pull-left" id="cs_save_schedule_button" onclick="update_schedule_request()">save</button>
		<button class="btn btn-mini btn-danger pull-right" id="cs_cancel_adding_button">cancel</button>
		<button class="btn btn-mini btn-danger pull-right" id="cs_cancel_saving_button" onclick="update_schedule_canceled()">cancel</button>
	</div><!-- cs_add_schedule_div end -->
	<div id="cs_display_schedule_div">
		<table class = "table">
			<thead>
				<tr>
					<th>Day</th>
					<th>Time</th>
					<th>Subject</th>
					<th>Teacher</th>
				</tr>
			</thead>
			<tbody id="cs_display_schedule_tbody">
				<td colspan="4">Retrieving your schedules...
					<img src="../CSS/images/loading_image.gif" />
				</td>
			</tbody>
		</table>
	</div><!-- cs_display_schedule_div end -->
	
	<div id="cs_saving_dialog_div">
		<img src="../CSS/images/loading_image.gif" /><br />
		Saving your schedule...<br />
		Please wait...
	</div><!-- cs_saving_dialog_div end -->
	<div id="cs_delete_confirmation_dialog_div">
		Really sure to delete this schedule? 
		<table class="table table-border table-hover">
			<tr>
				<th>Day</th>
				<th>Time</th>
				<th>Subject</th>
				<th>Teacher</th>
			</tr>
			<tr id="cs_schedule_to_delete_tr"></tr>
		</table>
		<button id="cs_continue_remove_button" class="btn btn-danger"><i class="icon-check"></i> YES</button>
		<button id="cs_cancel_remove_button" class="btn btn-primary pull-right"><i class="icon-remove"></i> cancel</button>
	</div><!-- cs_delete_confirmation_dialog ends -->
	<div id="cs_overlay_div"></div><!-- cs_overlay_div end -->
	<script src="../JS/schedules.js"></script>
	<!--Greg Finnegan-->
</div><!-- cs_container_div end-->