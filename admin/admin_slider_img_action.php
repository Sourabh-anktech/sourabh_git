<?php
include "../config/config.php";
	$action = "";
	if(!isset($_REQUEST["form_action"])) {
		header("location: login.php");
	} 
	else {
		$action = $_REQUEST["form_action"];
	}
	if($action == "slider_img_registration"){
		$error	   		= FALSE;
		$title 			= $_POST['title'];
		$content 		= $_POST['content'];
		$status			= $_POST['status'];
		
		if (empty($title)) {
			$_SESSION["titleerr"] = "Title is required";
			$error = TRUE;
		}
		else{
			$_SESSION["title"] = $title;
		}
		
		if (empty($content)) {
			$_SESSION["contenterr"] = "Content is required";
			$error = TRUE;
		}
		else{
			$_SESSION["content"] = $content;
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

				$target_dir    = DIR_PATH_SLIDER_IMAGE;
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
		
		if (!empty($status)) {
			
			$_SESSION["status"] = $status;
		}
		
		
		if($error) {
			header("location: admin_add_slider_img.php");		
		}
		else{
			
			$img = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
			$data = array(
						  "title" => $title,
						  "content" => $content,
						  "image_slide" => $fileToUpload,
						  "status" => $status,
						  "created" => time(),
						  "modified"  => time());

			$slider_img_id = $sliderImgObj->add_new_sliderimg($data);
			if($slider_img_id) {
				
				unset($_SESSION["title"]);
				unset($_SESSION["content"]);
				unset($_SESSION["fileToUpload"]);
				
				$_SESSION["message"] = "Slider Image has been registered successfully";
				header("location: admin_slider_img.php");
			}
			else {
				$_SESSION["invalid_message"] = "Sorry slider image registration failed! Please try again";
				header("location: admin_slider_img.php");
			}
		}
	}
	else if($action == "edit_slider_img"){
		$error	   		= FALSE;
		
		$data			= array();
		
		$title 			= $_POST['title'];
		$content 		= $_POST['content'];
		$fileToUpload 	= $_FILES["new_fileToUpload"]["name"]; // New uploaded file name
		$status 		= $_POST['status'];
		
		$oldFileName = '';
		$oldFileName = $_POST["old_image_name"];   //old file name
		
		$image_id = '';
		$image_id = $_POST["image_id"];		//Image ID
		
		if (empty($title)) {
			$_SESSION["titleerr"] = "Title is required";
			$error = TRUE;
		}
		else {
			$_SESSION["title"] = $title;
			$data['title']	  = $title;
		}
		
		if (empty($content)) {
			$_SESSION["contenterr"] = "Content is required";
			$error = TRUE;
		}
		else {
			$_SESSION["content"] = $content;
			$data['content']	  = $content;
		}
		
		if(!empty($_FILES) && isset($_FILES["new_fileToUpload"]) && $_FILES["new_fileToUpload"]["name"] != "") {
					
			$fileToUpload   = $_FILES["new_fileToUpload"]["name"];
			$arr = explode(".",$fileToUpload);
			$arr[0] = $arr[0].time();
			$fileToUpload = implode(".",$arr);

			$target_dir    = DIR_PATH_SLIDER_IMAGE;
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
			$data['image_slide']	  = $fileToUpload;
				
		}
		
			$_SESSION["status"] = $status;

		if($error) {			
			header("location: admin_edit_slider_img.php?id=$image_id");				
		}
		else {
		
			//Uploading Data
			
			$data['status']	  = $status;
			
			$conditions = array("id" => $image_id);

			$image_id = $sliderImgObj->update_slider_img_data($data,$conditions);
			
			if($image_id) {
				
				unset($_SESSION["title"]);
				unset($_SESSION["content"]);
				unset($_SESSION["new_fileToUpload"]);
				unset($_SESSION["status"]);
				
				$_SESSION["message"] = "Slider image has been updated successfully";
				header("location: admin_slider_img.php");
				
			}
			else {
				$_SESSION["invalid_message"] = "Sorry Updation Failed. Please Try Again";
				header("location: admin_slider_img.php");
			}
		}
	}
	
	
	if($action == "delete") {
		
		$image_id = $_GET['id'];
		
		$conditions = array("id" => $image_id);
		$counts = $sliderImgObj->sliderImgNotExist($conditions);
		
		if($counts == 0) {
			$_SESSION["invalid_message"] = "Slider Image doesn't exist!";
			header("location: admin_slider_img.php");
		}
		else {
			$slider_img_data = $sliderImgObj->sliderimg_delete($conditions);
			$_SESSION["message"] = "Slider Image has been deleted successfully";
			header("location: admin_slider_img.php");
		}
	}
		
?>
