<?php
include "header.php";

if(checkUserLogin(false)) {
	@header("location:profile.php");
}

	$nameerr		 = '';
	$emailerr    	 = '';
	$passworderr     = '';
	$fileToUploaderr = '';

	$name		 	 = '';
	$email	 	 	 = '';
	$password        = '';
	$fileToUpload    = '';
	
	$message 		 = '';

	if(isset($_SESSION["nameerr"])) {
		$nameerr = $_SESSION["nameerr"];
		unset($_SESSION["nameerr"]);
	}
	if(isset($_SESSION["name"])) {
		$name = $_SESSION["name"];
		unset($_SESSION["name"]);
	}

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

	if(isset($_SESSION["fileToUploaderr"])) {
		$fileToUploaderr = $_SESSION["fileToUploaderr"];
		unset($_SESSION["fileToUploaderr"]);
	}
	
	if(isset($_SESSION["message"])) {
		$message = $_SESSION["message"];
		unset($_SESSION["message"]);
	}

?>
<div class="container"><hr>
	<div class="row">
		<div class="span8">
			<h1>Registraion Form</h1>
			<form class="well" name = "form" action="user_action.php" method="post" enctype="multipart/form-data">

				<h3>First Name * :</h3> <input class="span6" type="text" name = "name" value = "<?php echo $name; ?>"><span class="error-message"> <?php echo $nameerr; ?></span><br><br>

				<h3>Email * : </h3><input class="span6" type="text" name = "email" value = "<?php echo $email; ?>"><span class="error-message"> <?php echo $emailerr;?></span><br><br>

				<h3>Password * : </h3><input class="span6" type="password" name = "password" value = "<?php echo $password; ?>"><span class="error-message"> <?php echo $passworderr;?></span><br><br>

				<h3>Profile Picture * :</h3> <input class="span6" type="file" name = "fileToUpload" id="fileToUpload"><span class="error-message"> <?php echo $fileToUploaderr;?></span><br><br>

				<input type="hidden" name = "form_action" value = "user_registration">

				<input type="submit" name="submit" value="Submit">
			</form>
		</div>
		<div class="span4">
			<h3>Sign Up <small> By <a href="#">Srawat56</a></small></h3>
			<a href="<?php echo SITE_HTTP_ROOT_PATH.'/'.FILENAME_REGISTER;?>"><img src="<?php echo HTTP_PATH_IMAGES; ?>reg.png" alt="Sign up image"></a>
		</div>
	</div>
	<div class="row">
		<div class="span6 thumb-list">
			<h1><?php echo $message; ?></h1>
		</div>
	</div>
	<hr>

<?php
include "footer.php";
?>
