<div id="st_container_div">
	<ul>
		<li class="icon-off"></li>
		<li class="icon-signal"></li>
		<li class="icon-cog"></li>
		<li class="icon-trash"></li>
		<li class="icon-home"></li>
		<li class="icon-glass"></li>
		<li class="icon-music"></li>
		<li class="icon-search"></li>
		<li class="icon-envelope"></li>
		<li class="icon-heart"></li>
		<li class="icon-star"></li>
		<li class="icon-star-empty"></li>
		<li class="icon-user"></li>
		<li class="icon-film"></li>
		<li class="icon-th-large"></li>
		<li class="icon-th"></li>
		<li class="icon-th-list"></li>
		<li class="icon-ok"></li>
		<li class="icon-remove"></li>
		<li class="icon-zoom-in"></li>
		<li class="icon-zoom-out"></li>
		<li class="icon-file"></li>
		<li class="icon-time"></li>
		<li class="icon-road"></li>
		<li class="icon-download-alt"></li>
		<li class="icon-download"></li>
		<li class="icon-upload"></li>
		<li class="icon-inbox"></li>
		<li class="icon-play-circle"></li>
		<li class="icon-icon-repeat"></li>
		<li class="icon-refresh"></li>
		<li class="icon-list-alt"></li>
		<li class="icon-lock"></li>
		<li class="icon-flag"></li>
		<li class="icon-headphones"></li>
		<li class="icon-volume-off"></li>
		<li class="icon-volume-down"></li>
		<li class="icon-volume-up"></li>
		<li class="icon-qrcode"></li>
		<li class="icon-barcode"></li>
		<li class="icon-tag"></li>
		<li class="icon-tags"></li>
		<li class="icon-book"></li>
		<li class="icon-bookmark"></li>
		<li class="icon-print"></li>
		<li class="icon-camera"></li>
		<li class="icon-font"></li>
		<li class="icon-fullscreen"></li>
		<li class="icon-briefcase"></li>
		<li class="icon-filter"></li>
		<li class="icon-tasks"></li>
		<li class="icon-wrench"></li>
		<li class="icon-globe"></li>
		<li class="icon-circle-arrow-down"></li>
		<li class="icon-circle-arrow-up"></li>
		<li class="icon-circle-arrow-left"></li>
		<li class="icon-circle-arrow-right"></li>
		<li class="icon-hand-down"></li>
		<li class="icon-hand-up"></li>
		<li class="icon-hand-left"></li>
		<li class="icon-hand-right"></li>
		<li class="icon-thumbs-down"></li>
		<li class="icon-thumbs-up"></li>
		<li class="icon-fire"></li>
		<li class="icon-eye-open"></li>
		<li class="icon-eye-close"></li>
		<li class="icon-warning-sign"></li>
		<li class="icon-plane"></li>
		<li class="icon-calendar"></li>
		<li class="icon-random"></li>
		<li class="icon-comment"></li>
		<li class="icon-magnet"></li>
		<li class="icon-chevron-up"></li>
		<li class="icon-chevron-down"></li>
		<li class="icon-retweet"></li>
		<li class="icon-shopping-cart"></li>
		<li class="icon-folder-close"></li>
		<li class="icon-edit"></li>
	</ul>
	
	<div id="st_alarm_app_container_div">
		<div id="st_set_alarm_container_div">
			<form id="st_set_alarm_form">
				<table class="table text-center">
					<caption><span class="label label-info"><i class="icon-time"></i> SET YOUR ALARM <i class="icon-time"></i></span></caption>
					<thead>
						<tr>
							<th>Alarm Title</th>
							<th colspan="3">Time</th>
							<th>Alarm Tone</th>
						</tr>
					</thead>
					<tr>
						<td><input type="text" class="input-medium" name="st_alarm_title" placeholder="descriptive alarm title" /></td>
						<td>(hh)<br /><select class="input-mini" name="st_alarm_hour"></select></td>
						<td>(mm)<br /><select class="input-mini" name="st_alarm_minute"></select></td>
						<td>(AM/PM)<br />
							<select class="input-mini" name="st_alarm_am_pm">
								<option>AM</option>
								<option>PM</option>
							</select>
						</td>
						<td>
							<select	class="input-mini" name="st_alarm_tone">
								<option value="1">Old MacDonald had a farm</option>
								<option value="2">Let it go</option>
								<option value="3">A thousand miles</option>
								<option value="4"></option>
								<option value="5"></option>
								<option value="6"></option>
							</select>
						</td>
					</tr>
				</table>
			</form>
			<button class="btn btn-primary" id="st_save_set_alarm_button">save</button>
		</div><!-- set_alarm_container_div ends -->
	</div><!-- st_alarm_app_container_div ends -->
	
	<div id="st_alarm_active_container_div">
		<iframe id="st_active_alarm_iframe" src=""></iframe>
		<marquee class="pull-right" id="st_active_alarm_title">No active alarm</marquee>
	</div><!--st_alarm_active_container_div ends -->
	
	<div id="st_alarms_container_div">
		<div id="st_delete_note_div">
			deleting...
		</div><!-- st_delete_note_div ends -->
		<table class="table" id="st_display_alarm_table">
			<thead>
				<th></th>
				<th>alarm title</th>
				<th>time</th>
				<th>alarm tone</th>
				<th>status</th>
			</thead>
			<tbody id="st_alarm_container_tbody"></tbody>
		</table>
	</div><!-- st_alarms_container_div ends -->
	
	<script src="../JS/stuffs.js"></script>
</div>