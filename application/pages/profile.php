<div id="pr_container_div" class="pull-right">
	<div id="pr_profile_picture_container_div">
		<button class="btn btn-mini" id="pr_change_profile_image_button">change profile image</button>
		<form id="pr_change_profile_image_form" method="POST" enctype="multipart/form-data">
			<input type="file" name="pr_profile_image" id="pr_profile_image" />
		</form>
	</div><!-- pr_profile_picture_container_div ends -->
	
	<div id="pr_profile_information_continer_div">
		<table id="pr_profile_information_table" class="table">
			<caption>Personal Information</caption>
			<tr>
				<td>Name </td> <td><span class="pr_info" id="pr_lastname"></span>, <span class="pr_info" id="pr_firstname"></span> <span class="pr_info" id="pr_middlename"></span></td>
			</tr>
			<tr>
				<td>Was born on </td> <td class="pr_info" id="pr_birthday"></td>
			</tr>
			<tr>
				<td>Age is </td> <td class="pr_info" id="pr_age"></td>
			</tr>
			<tr>
				<td>Live in </td> <td class="pr_info" id="pr_address"></td>
			</tr>
			<tr>
				<td>A</td> <td class="pr_info" id="pr_educational_level"></td>
			</tr>
			<tr>
				<td>Studying at  </td> <td class="pr_info" id="pr_school_name"></td>
			</tr>
			<tr>
				<td>In the field of </td> <td class="pr_info" id="pr_college_course"></td>
			</tr>
			<tr>
				<td>Currently </td> <td class="pr_info" id="pr_year_level"></td>
			</tr>
			<tr>
				<td>Belonged to </td> <td class="pr_info" id="pr_section"></td>
			</tr>
			<tr>
				<td>Whose professor is </td> <td class="pr_info" id="pr_adviser"></td>
			</tr>
		</table><!--pr_profile_information_table ends -->
	</div><!-- pr_profile_information_continer -->
	
	<script src="../JS/profiles.js"></script>
</div><!-- pr_container_div -->