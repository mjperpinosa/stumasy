<?php
	session_start();
	
	if(isset($_SESSION["user_id"])) {
		header("Location: home.php");
	}
?>

<!Doctype html>
<html>
	<head>
		<title>Welcome to StuMaSy User Login</title>
		<meta content=text/html charset="utf-8">
		<link rel="shortcut icon" href="../CSS/images/loading_image.gif" />
		<link rel="stylesheet" href="../CSS/cascading_style_sheets.css" />
		
	</head>
	<body>
		<div id="lp_main_container_div">
		
			<div id="lp_header_div">
				<p>Welcome To</p>
				<h2>StuMaSy</h2>
			</div><!--lp_header_div end-->
			
			<div id="lp_body_div">
				<p id="lp_description_p">
					A program application site constructed having multiple uses.
					Intend to help students organize stuffs efficiently and make their school life even better, 
					more exciting and convenient. 
					It serves as a means of communication. With this, students may interact and connect with their fellow and other
					colleagues in the vicinity of their university or institution.
				</p>
				<hr />
				<div id="lp_body_content_div">
					<table>
						<tr>
							<td>
								<div id="lp_login_div">
									<p id="account_invalid_p" class="label label-important"></p>
									<p>
										<span class="pull-left">Log in:</span>
										<span class="pull-right"><a id="create_account_a">New to StuMaSy?</a></span>
									</p>
									<form id="lp_login_form" method="POST">
										<input type="text" name="username_entered" placeholder="username" required /> <br />
										<input  type="password" name="password_entered" placeholder="password" required /> <br />
										<input type="submit" value="log in" class="btn btn-primary" id="lp_login_button"/>
									</form>
									
									<script src="../JS/jquery-1.9.1.min.js"></script>
									<script src="../JS/jquery-ui-1.10.2.min.js"></script>
									<script src="../JS/bootstrap.min.js"></script>
									<script src="../JS/login.js"></script>
								</div><!--lp_login_div end-->
							</td>
							<td>
								<div id="lp_slide_images_div">
								
									<div id="lp_carousel_div" class="carousel slide">
										<ol class="carousel-indicators">
											<li data-target="#lp_carousel_div" data-slide-to="0" class="active"></li>
											<li data-target="#lp_carousel_div" data-slide-to="1"></li>
											<li data-target="#lp_carousel_div" data-slide-to="2"></li>
											<li data-target="#lp_carousel_div" data-slide-to="3"></li>
											<li data-target="#lp_carousel_div" data-slide-to="4"></li>
											<li data-target="#lp_carousel_div" data-slide-to="5"></li>
										</ol>
										<!-- Carousel items -->
										<div id='slide_imgs' class="carousel-inner">
											<div class="active item"><img src="../CSS/images/preview_images/map_main.jpg" class ='slideimg' alt='first'/></div>
											<div class="item"><img src="../CSS/images/preview_images/tip_map.jpg" class ='slideimg' alt='first'/></div>
											<div class="item"><img src='../CSS/images/preview_images/person2.png' class ='slideimg' alt='second'/></div>
											<div class="item"><img src='../CSS/images/preview_images/books.png' class ='slideimg' alt='thrid'/></div>
											<div class="item"><img src='../CSS/images/preview_images/person1.png' class ='slideimg' alt='fourth'/></div>
											<div class="item"><img src='../CSS/images/preview_images/laptop.png' class ='slideimg' alt='fifth'/></div>
											<div class="item"><img src='../CSS/images/preview_images/graduationcap.png' class ='slideimg' alt='sixth'/></div>
										</div>
										<!-- Carousel nav -->
										<a class="carousel-control left" href="#lp_carousel_div" data-slide="prev">&lsaquo;</a>
										<a class="carousel-control right" href="#lp_carousel_div" data-slide="next">&rsaquo;</a>
									</div><!--Carousel[slide show]-->
								</div><!--lp_slide_images_div end-->
							</td>
						</tr>
					</table>
				</div><!--lp_body_content_div end-->
			</div><!--lp_body_div ends-->
			
			<div id="lp_dialog_div">
				<p>Enjoy and explore with this supah friendly application! Create an account now! <br /> Proceed?</p>
				<a id="lp_proceed_a" class="">Okay</a>
				<a id="lp_no_a" class="pull-right">I already have an account</a>
			</div><!--lp_dialog_div end-->
			
			<div id="lp_laoding_div">
				<img src="../CSS/images/loading_image.gif" />
				<p>Wait... ^^ <br /> retrieving data</p>
			</div><!-- lp_laoding_div end-->
			<div id="lp_overlay_div">
			</div><!--lp_overlay_div end-->
			
			<div id="lp_footer_div">
			</div><!--lp_footer_div ends-->
			
		</div><!--main_container_div end-->		
	</body>
</html>