<?php

include "config/config.php";
	$action = "";
	if(!isset($_REQUEST["form_action"])) {
		header("location: index.php");
	} else {
		$action = $_REQUEST["form_action"];
	}
	
	if($action == "user_registration") {
		$error	   		= FALSE;
		$name 			= $_POST['name'];
		$email	  		= $_POST['email'];
		$password 		= $_POST['password'];
		
		
		if (empty($name)) {
			$_SESSION["nameerr"] = "First Name is required";
			$error = TRUE;
		}
		else if(!preg_match("/^[a-zA-Z ]*$/",$name)) {
		 $_SESSION["nameerr"] = "Name must be in alphabets";
		 $error = TRUE;
		}
		else {
			$_SESSION["name"] = $name;
		}


		if (empty($email)) {
			$_SESSION["emailerr"] = "Email is required";
			$error = TRUE;
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION["emailerr"] = "Invalid Email Format";
			$error = TRUE;
		}
		else {
			//Email already exist!
			$conditions = array("email" => $email);
			$counts = $userObj->isAlreadyExist($conditions);
			if($counts > 0) {
				$error = TRUE;
				$_SESSION["emailerr"] = "Email already exist!";
			}
			$_SESSION["email"] = $email;
		}		

		if (empty($password)) {
			$_SESSION["passworderr"] = "Password is required";
			$error = TRUE;
		}
		else {
			$_SESSION["password"] = $password;
		}

		if(!empty($_FILES) && isset($_FILES["fileToUpload"])) {
			
			if($_FILES["fileToUpload"]["name"] == "" || $_FILES["fileToUpload"]["error"]) {
				$error = true;
				$_SESSION["fileToUploaderr"] = "Please upload a file";
			}
			else {			
				$fileToUpload   = $_FILES["fileToUpload"]["name"];
				$arr = explode(".",$fileToUpload);
				$arr[0] = $arr[0].time();
				$fileToUpload = implode(".",$arr);

				$target_dir    = DIR_PATH_PROFILE_PIC;
				$target_file   = $target_dir . $fileToUpload;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			   
				if (file_exists($target_file)) {
					$error = true;
					$_SESSION["fileToUploaderr"] = "File already Exist";
				}

				if ($_FILES["fileToUpload"]["size"] > 5000000) {
					$error = true;
					$_SESSION["fileToUploaderr"] = "File size should not be greater than 5 MB";
				}

				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
					$error = true;
					$_SESSION["fileToUploaderr"] = "File type should be jpg, png, jpeg, gif";
				}
			}
		}

		if($error) {
			header("location: register.php");		
		}
		
		else {
			
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
			$data = array(
						  "name" => $name,
						  "email" => $email,
						  "password" => $password,
						  "image_profile" => $fileToUpload,
						  "status" => 1,
						  "role_id" => 3,
						  "created" => time(),
						  "modified"  => time());

			$user_id = $userObj->add_new_user($data);
			
			if($user_id) {
				
				unset($_SESSION["name"]);
				unset($_SESSION["email"]);
				unset($_SESSION["password"]);
				unset($_SESSION["fileToUpload"]);
				
				$_SESSION["message"] = "Registration Completed Successfully";
				header("location: register.php");
			}
			else {
				$_SESSION["message"] = "Sorry Registration Failed. Please Try Again";
				header("location: register.php");
			}
				
			
			//Database
			//~ $ins = "INSERT INTO users(name, email, password, image_profile) VALUES ('$name', '$email', '$password', '$fileToUpload')";
			//~ if(!mysqli_query($conn, $ins)) {
				//~ echo "Error".mysqli_error($conn);
			//~ }
		}

		
	}
	else if($action == "user_login") {
		
		$error	   		= FALSE;
		$email	  		= $_POST['email'];
		$password 		= $_POST['password'];
		
		if (empty($email)) {
			$_SESSION["emailerr"] = "Email is required";
			$error = TRUE;
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$_SESSION["emailerr"] = "Invalid Email Format";
			$error = TRUE;
		}
		if (empty($password)) {
			$_SESSION["passworderr"] = "Password is required";
			$error = TRUE;
		}		
		else {			
			$_SESSION["password"] = $password;
		}	
		
		if($error) {
			header("location: login.php");
		}	
		else {
			$conditions = array("email" => $email,"password" => $password);
			$counts = $userObj->notExist($conditions);
			
			$cond		= array("email" => $email,"password" => $password, "status" => '1');
			$cond_counts = $userObj->notExist($cond);
			
			if($counts == 0) {
				$_SESSION["message"] = "User doesn't exist! Please try with correct email and password";
				header("location: login.php");
			}
			
			else if($cond_counts == 0) {
				$_SESSION["message"] = "User is blocked for a short time ! please contact to administrator";
				header("location: login.php");
			}
			
			else {
				$user_data = $userObj->getUsersData($conditions,1);
				//pr($user_data); die;
				$_SESSION['user']['isLoggedIn'] = TRUE;
				$_SESSION['user']['ID'] = $user_data[0]["id"];
				$_SESSION['user']['RID'] = $user_data[0]["role_id"];
				header("location:profile.php");
			}
		}
	}
	else if($action == "logout") {
		unset($_SESSION['user']);
		header("location:login.php");
	}
?>
