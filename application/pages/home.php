<?php
	session_start();
	if(!isset($_SESSION["user_id"])) {
		header("Location: login.php");
	}
?>
<html>
	<head>
		<meta content=text/html charset="utf-8" >
		<title>StuMaSy-Home</title>
		<link rel="stylesheet" href="../CSS/cascading_style_sheets.css" />
	</head>
	
	<body>
		<div id="header_container_div">
			<h2 id="h_title_h1">StuMaSy</h2>
		</div><!--header_container_div end-->
		<div id="h_side_navigator_div" class="pull-left">
			<ul id="h_navigator_ul">
				<img src="../../documents/images/" id="h_profile_image_container_img" />
				<li id="h_home_li" class="favorite_background"><a>HOME</a></li>
				<li id="h_class_sched_li"><a>CLASS SCHED</a></li>
				<li id="h_notes_li"><a>NOTES</a></li>
				<li id="h_stuffs_li"><a>STUFFS</a></li>
				<li id="h_profile_li"><a>PROFILE</a></li>
				<li id="h_settings_li"><a>SETTINGS</a></li>
				<li>MORE
					<ul id="h_sublinks_container_ul">
						<li><a>find friends</a></li>
						<li><a>messages</a></li>
						<li><a>calculator</a></li>
						<li><a>calendar</a></li>
						<li><a href="logout.php">log out</a></li>
					</ul>
				</li>
			</ul>
		</div><!--h_side_navigator_div end-->
		<div id="h_contents_container_div" class="">
			<?php include "updates.php"; ?>
		</div><!--h_contents_container_div end-->
		<span id="h_move_to_top_span"><a href="#header_container_div">move to top</a></span>
		<!-- JavaScript imports -->
		<script src="../JS/jquery-1.9.1.min.js"></script>
		<script src="../JS/jquery-ui-1.10.2.min.js"></script>
		<script src="../JS/bootstrap.min.js"></script>
		<script src="../JS/home.js"></script>
	</body>
</html>