<?php
include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Learning</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="<?php echo SITE_HTTP_ROOT_PATH; ?>/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo SITE_HTTP_ROOT_PATH; ?>/css/bootstrap-responsive.css" rel="stylesheet">
<!--[if lt IE 9]><script src="js/html5.js"></script><![endif]-->
<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <a class="brand" href="<?php echo SITE_HTTP_ROOT_PATH; ?>/index.php"><span class="color-highlight">Lear</span>ning</a>
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li><a <?php if(CURRENT_FILENAME == FILENAME_DEFAULT) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/index.php">Home</a></li>
					<li><a <?php if(CURRENT_FILENAME == FILENAME_ABOUTUS) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/page.php?page_id=1">About Us</a></li>
					<li><a <?php if(CURRENT_FILENAME == FILENAME_CONTACTUS) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/page.php?page_id=3">Contact Us</a></li>
					<li><a <?php if(CURRENT_FILENAME == FILENAME_BLOG) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/blog.php">Blog</a></li>
					<?php
					if(checkUserLogin(false)) {
					?>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_PROFILE) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/profile.php">Profile</a></li>
						<li><a href="<?php echo SITE_HTTP_ROOT_PATH; ?>/user_action.php?form_action=logout">Logout</a></li>
					<?php	
					}
					else {
					?>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_REGISTER) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/register.php">Registration</a></li>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_LOGIN) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/login.php">Log In</a></li>
					<?php  
					}
					?>
				</ul>
			</div>
		<!--/.nav-collapse -->
		</div>
	</div>
</div>
