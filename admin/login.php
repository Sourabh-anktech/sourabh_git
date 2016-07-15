<?php
include "header.php";

	if(checkAdminUserLogin(false)) {
		redirectURL("index.php");
	}
	
	$emailerr    	 = '';
	$passworderr     = '';

	$email	 	 	 = '';
	$password        = '';
	
	$message        = '';
	
	if(isset($_SESSION["emailerr"])) {
		$emailerr = $_SESSION["emailerr"];
		unset($_SESSION["emailerr"]);
	}
	if(isset($_SESSION["email"])) {
		$email = $_SESSION["email"];
		unset($_SESSION["email"]);
	}

	if(isset($_SESSION["passworderr"])) {
		$passworderr = $_SESSION["passworderr"];
		unset($_SESSION["passworderr"]);
	}
	if(isset($_SESSION["password"])) {
		$password = $_SESSION["password"];
		unset($_SESSION["password"]);
	}
	if(isset($_SESSION["message"])) {
		$message = $_SESSION["message"];
		unset($_SESSION["message"]);
	}
	
?>
<div class="container">
      <form class="form-signin" name = "form" action="admin_user_action.php" method="post" enctype="multipart/form-data">

		  <h2 class="form-signin-heading">Admin Login</h2>
		  <span class="error-message"><?php echo $message; ?></span>
			
		  <input type="text" id="inputEmail" class="form-control" placeholder="Email address*" name="email" value = "<?php echo $email; ?>" autofocus><span class="error-message"><?php echo $emailerr;?></span>
			
		  <input type="password" id="inputPassword" class="form-control" placeholder="Password*" name="password" value = "<?php echo $password; ?>"><span class="error-message"><?php echo $passworderr;?></span>
			
		  <input type="hidden" name="form_action" value="admin_login">
			
		  <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      </form>

</div> 
<!-- /container -->
<?php 
include "footer.php";
?>

