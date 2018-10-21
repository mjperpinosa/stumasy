
<div id="ca_back_div">
	<span id="ca_back_span" title="back to login page">
		<img src="../CSS/images/back_icon.png" />
	</span>
	<span class="pull-right">Create your account! Enjoy!</span>
</div>
<div id="create_account_div">
	<form id="account_form" onsubmit="return false;">
		<p>
			<span>*</span> Please fill-up the form with the right information required.
		</p>
		<table>
			<tr>
				<td> Select:</td> 
				<td>
					<select name="educational_level">
						<option>College</option>
						<option>High School</option>
						<option>Elementary</option>
					</select>
				</td>
			</tr>
			<tr>
				<td> Name of School:</td> <td><input type="text" name="school_name" required /> </td>
			</tr>
			<tr>
				<td> Name:</td>
				<td><input type="text" name="lastname" placeholder="last name" required />
					<input type="text" name="firstname" placeholder="first name" required/>
					<input type="text" name="middlename" placeholder="middle name" required/>
				</td>
			</tr>
			<tr>
				<td> Birthday:</td>
				<td>
					<select name="ca_birth_month"></select>
					<select name="ca_birth_date"></select>
					<select name="ca_birth_year"></select>
				</td>
			</tr>
			<tr>
				<td> Address:</td> <td><input type="text" name="address" required /></td>
			</tr>
		</table>
		<div id="ca_other_info_div">
			<p class="">*Other Info</p>
			<table>
				<tr>
					<td>
						<table id="ca_other_info_table">
							<tr id="year_level_tr">
								<td> Year:</td> 
								<td>
									<select name="year_level">
										<option>1st Year</option>
										<option>2nd Year</option>
										<option>3rd Year</option>
										<option>4th Year</option>
										<option>5th Year</option>
										<option>6th Year</option>
									</select>
								</td>
							</tr>
							<tr id="ca_course_tr">
								<td> Course: </td> <td><input type="text" name="college_course" required /></td>
							</tr>
							<tr id="section_tr">
								<td> Section:</td> <td><input type="text" name="section" required /></td>
							</tr>
							<tr id="adviser_tr">
								<td> Adviser:</td> <td><input type="text" name="adviser" required /></td>
							</tr>
						</table>
					</td>
					<td>
						<table id="ca_account_table">
							<tr>
								<td>Choose Username:</td> <td><input type="text" name="username" placeholder="username" required /></td>
							</tr>
							<tr>
								<td>Choose Password:</td> <td><input type="password" name="password" placeholder="password" required /></td>
							</tr>
							<tr>
								<td>Confirm Password:</td> <td><input type="password" name="confirm_password" placeholder="retype password" required /></td>
							<tr>
							<tr>
								<td></td>
								<td><button class="btn btn-primary btn-block pull-right" id="ca_create_account_button">create account</button></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</div><!--ca_other_info_div end-->
	</form><!--account_form end-->
	
</div><!--create_account_div end-->
<div id="ca_overlay_div" class="hidden">
</div><!-- ca_overlay_div ends -->
<div id="ca_laoding_div" class="hidden">
	<img src="../CSS/images/loading_image.gif" />
	<p>Wait... ^^</p>
</div><!-- ca_laoding_div end-->
<div id="ca_dialog_div" class="hidden">
	<p>
		Congratulations <span id="ca_new_user_span"></span>!
		Your account has been successfully created. Enjoy with StumaSy! :)
	</p>
	<a class="pull-right" id="ca_back_to_login_a">back to login page</a>
</div><!--ca_dialog_div end-->

<!-- JavaScript imports -->
<script src="../JS/jquery-1.9.1.min.js"></script>
<script src="../JS/jquery-ui-1.10.2.min.js"></script>
<script src="../JS/bootstrap.min.js"></script>
<script src="../JS/create_account.js"></script>