	<footer class="row">
		<div>
			<div class="span4">
				<div class="is-padded">
					<nav>
					<h2>Navigation</h2>
					<hr>
					<ul>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_DEFAULT) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/index.php">Home</a></li>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_ABOUTUS) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/page.php?page_id=1">About Us</a></li>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_TERMSANDCONDITION) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/page.php?page_id=2">Terms and condition</a></li>
						<li><a <?php if(CURRENT_FILENAME == FILENAME_CONTACTUS) { ?> class="active" <?php } ?> href="<?php echo SITE_HTTP_ROOT_PATH; ?>/page.php?page_id=3">Contact Us</a></li>
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
					</nav>
				</div>
			</div>
			<div class="span4">
				<div class="is-padded">
					<h2>Twitter</h2>
					<hr>
					<a href="#">@AwfulMedia</a>
					<p>This is what my tweet looks like on this website. Tweet tweet. Twitter Twatter.</p>
					<em>3 days ago</em><br>
					<br>
					<a href="#">@AwfulMedia</a>
					<p>This is what my tweet looks like on this website. Tweet tweet. Twitter Twatter.</p>
					<em>3 days ago</em> 
				</div>
			</div>
			<div class="span4">
				<div class="is-padded">
					<h2>Details</h2>
					<blockquote>Respond is a fully responsive website template utilizing Twitter's Bootstrap framework. What does that mean? First of all, the website will respond according to the size of the viewers browser window. Go on, try it out. Resize your window. On top of that, the framework offers loads of ready-to-go features. Check it out with the button below. <br>
					<br>
					<em>- AwfulMedia.com</em> </blockquote>
				</div>
			</div>
		</div>
		<p>&copy;2008 Your Company.<br>
		Design by <a href="http://www.anktech.co.in">Anktech Softwares</a> </p>
	</footer>
</div>
<!---container ends here-->
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/jquery-1.7.1.min.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-transition.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-carousel.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-alert.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-modal.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-dropdown.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-tab.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-tooltip.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-popover.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-button.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-collapse.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/bootstrap-typeahead.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/jquery-ui-1.8.18.custom.min.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/jquery.smooth-scroll.min.js"></script>
<script src="<?php echo SITE_HTTP_ROOT_PATH; ?>/js/lightbox.js"></script>
<script>
$('.carousel').carousel({
  interval: 5000
})
</script>
</body>
</html>
