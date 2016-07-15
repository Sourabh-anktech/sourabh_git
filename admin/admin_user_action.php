<?php
include "../config/config.php";
	$action = "";
	if(!isset($_REQUEST["form_action"])) {
		header("location: login.php");
	} 
	else {
		$action = $_REQUEST["form_action"];
	}
	
	if($action == "admin_login") {
		
		$error	   		= FALSE;
		$email	  		= $_POST['email'];
		$password 		= $_POST['password'];
		
		if (empty($email)) {
			$_SESSION["emailerr"] = "Email is required";
			$error = TRUE;
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$_SESSION["emailerr"] = "Invalid Email Format";
			$error = TRUE;
		}
		else
		{
			$_SESSION["email"] = $email;
		}
		if (empty($password)) {
			$_SESSION["passworderr"] = "Password is required";
			$error = TRUE;
		}		
		else{			
			$_SESSION["password"] = $password;
		}	
		
		if($error) {
			header("location: login.php");
		}	
		else {
			$cond_notmatch	= array("email" => $email,"password" => $password);
			$count_notmatch = $adminObj->notExist($cond_notmatch);
			
			$conditions = array("email" => $email,"password" => $password, "role_id" =>1);
			$counts = $adminObj->notExist($conditions);
			
			$cond_status = array("email" => $email,"password" => $password, "status" => '1');
			$count_status = $adminObj->notExist($cond_status);
			
			if($count_notmatch == 0) {
				$_SESSION["message"] = "Email and password you entered don't match";
				header("location: login.php");
			}
			
			else if($counts == 0) {
				$_SESSION["message"] = "You dont have admin access";
				header("location: login.php");
			}
			
			else if($count_status == 0) {
				$_SESSION["message"] = "User is blocked for a short time ! please contact to administrator";
				header("location: login.php");
			}
			
			else{
				$admin_user_data = $adminObj->getUsersData($conditions);
				unset($_SESSION["password"]);
				unset($_SESSION["email"]);
				$_SESSION['admin']['isLoggedIn'] = TRUE;
				$_SESSION['admin']['RID'] = $admin_user_data[0]["role_id"];
				header("location:index.php");
			}
		}
	}
	else if($action == "logout")
	{
		unset($_SESSION['admin']);
		header("location:login.php");
	}
	
	else if($action == "user_registration"){
		$error	   		= FALSE;
		$name 			= $_POST['name'];
		$email	  		= $_POST['email'];
		$password 		= $_POST['password'];
		$role			= $_POST['role'];
		$status			= $_POST['status'];
		
		if (empty($name)) {
			$_SESSION["nameerr"] = "First Name is required";
			$error = TRUE;
		}
		else if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
		 $_SESSION["nameerr"] = "Name must be in alphabet";
		 $error = TRUE;
		}
		else{
			$_SESSION["name"] = $name;
		}


		if (empty($email)) {
			$_SESSION["emailerr"] = "Email is required";
			$error = TRUE;
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$_SESSION["emailerr"] = "Invalid Email Format";
			$error = TRUE;
		}
		else{
			//Email already exist!
			$conditions = array("email" => $email);
			$counts = $adminObj->isAlreadyExist($conditions);
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
		else{
			$_SESSION["password"] = $password;
		}

		if(!empty($_FILES) && isset($_FILES["fileToUpload"])) {
			
			if($_FILES["fileToUpload"]["name"] == "" || $_FILES["fileToUpload"]["error"]){
				$error = true;
				$_SESSION["fileToUploaderr"] = "Please upload a file";
			}
			else{			
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
		if (!empty($role)) {
			
			$_SESSION["role"] = $role;
		}
		if (!empty($status)) {
			
			$_SESSION["status"] = $status;
		}
		
		
		if($error) {
			header("location: admin_add_user.php");		
		}
		else{
			
			move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
			$data = array(
						  "name" => $name,
						  "email" => $email,
						  "password" => $password,
						  "image_profile" => $fileToUpload,
						  "status" => $status,
						  "role_id" => $role,
						  "created" => time(),
						  "modified"  => time());

			$user_id = $adminObj->add_new_user($data);
			if($user_id) {
				
				unset($_SESSION["name"]);
				unset($_SESSION["email"]);
				unset($_SESSION["password"]);
				unset($_SESSION["fileToUpload"]);
				
				$_SESSION["message"] = "Registration Completed Successfully";
				header("location: admin_users.php");
			}
			else {
				$_SESSION["invalid_message"] = "Sorry Registration Failed. Please Try Again";
				header("location: admin_user.php");
			}
		}
	}
	
	
	else if($action == "edit_user"){
		$error	   		= FALSE;
		$fileToUpload	='';
		$data			= array();
		
		$name 			= $_POST['name'];
		$email	  		= $_POST['email'];
		$password 		= $_POST['password'];
		$fileToUpload 	= $_FILES["new_fileToUpload"]["name"]; // New uploaded file name
		$role			= $_POST['role'];
		$status			= $_POST['status'];
		
		$oldFileName = '';
		$oldFileName = $_POST["old_image_name"];   //old file name
		
		
		$user_id = '';
		$user_id = $_POST["user_id"];			// User id
		
		if (empty($name)) {
			$_SESSION["nameerr"] = "First Name is required";
			$error = TRUE;
		}
		else if(!preg_match("/^[a-zA-Z ]*$/",$name))
		{
		 $_SESSION["nameerr"] = "Name must be in alphabet";
		 $error = TRUE;
		}
		else{
			$_SESSION["name"] = $name;
			$data['name']	  = $name;
		}

		if (empty($email)) {
			$_SESSION["emailerr"] = "Email is required";
			$error = TRUE;
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{
			$_SESSION["emailerr"] = "Invalid Email Format";
			$error = TRUE;
		}
		else{
			$_SESSION["email"] = $email;
			$data['email']	  = $email;
		}		

		if(!empty($password)){
			$_SESSION["password"] = $password;
			$data['password']	  = $password;
		}

		if(!empty($_FILES) && isset($_FILES["new_fileToUpload"]) && $_FILES["new_fileToUpload"]["name"] != "") {
			
			$fileToUpload   = $_FILES["new_fileToUpload"]["name"];
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

			if ($_FILES["new_fileToUpload"]["size"] > 5000000) {
				$error = true;
				$_SESSION["fileToUploaderr"] = "File size should not be greater than 5 MB";
			}

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$error = true;
				$_SESSION["fileToUploaderr"] = "File type should be jpg, png, jpeg, gif";
			}
			move_uploaded_file($_FILES["new_fileToUpload"]["tmp_name"], $target_file);
			$data['image_profile']	  = $fileToUpload;
				
		}
		
		if (!empty($role)) {
			
			$_SESSION["role"] = $role;
		}
		
			$_SESSION["status"] = $status;
		
		if($error) {			
			header("location: admin_edit_user.php?id=$user_id");				
		}
		else {
		
			//Uploading Data
			
			$data['status']	  = $status;
			$data['role_id']  = $role;
			$data['modified']  = time();
			
			$conditions = array("id" => $user_id);

			$user_id = $adminObj->update_user_data($data,$conditions);
			
			if($user_id) {
				
				unset($_SESSION["name"]);
				unset($_SESSION["email"]);
				unset($_SESSION["password"]);
				unset($_SESSION["new_fileToUpload"]);
				unset($_SESSION["role"]);
				unset($_SESSION["status"]);
				
				$_SESSION["message"] = "User has been updated successfully";
				header("location: admin_users.php");
				
			}
			else {
				$_SESSION["invalid_message"] = "Sorry Updation Failed. Please Try Again";
				header("location: admin_users.php");
			}
		}
	}
	
	
	if($action == "delete") {
		
		$user_id = $_GET['id'];
		$conditions = array("id" => $user_id);
		$counts = $adminObj->notExist($conditions);
		
		if($counts == 0) {
			$_SESSION["invalid_message"] = "User doesn't exist!";
			header("location: admin_users.php");
		}
		else {
			$user_data = $adminObj->user_delete($conditions);
			$_SESSION["message"] = "User has been deleted successfully";
			header("location: admin_users.php");
		}
	}
		
?>
