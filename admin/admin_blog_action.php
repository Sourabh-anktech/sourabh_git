<?php
include "../config/config.php";
	$action = "";
	if(!isset($_REQUEST["form_action"])) {
		header("location: login.php");
	} 
	else {
		$action = $_REQUEST["form_action"];
	}
	if($action == "blog_post_registration"){
		$error	   		= FALSE;
		$title 			= $_POST['title'];
		$content 		= $_POST['content'];
		$status			= $_POST['status'];
		$category_id	= $_POST['category_id'];
	
		if(isset($_POST['featured']) && ($_POST['featured'] == '1')) {	
			$featured		= "1";
		}
		else {
			$featured		= "0";
		}
		
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

				$target_dir    = DIR_PATH_BLOG_IMAGE;
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
		
		if (!empty($featured)) {
			
			$_SESSION["featured"] = $featured;
		}
		
		if (!empty($category_id)) {
			
			$_SESSION["category_id"] = $category_id;
		}
		
		if($error) {
			header("location: admin_add_blog.php");		
		}
		else{
			
			$img = move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
			
			$data = array(
						  "title" 		=> $title,
						  "content" 	=> $content,
						  "image_blog"  => $fileToUpload,
						  "category_id" => $category_id,
						  "status" 		=> $status,
						  "featured" 	=> $featured,
						  "created" 	=> time(),
						  "modified" 	=> time());

			$blog_id = $blogPostObj->add_new_blog($data);
			if($blog_id) {
				
				unset($_SESSION["title"]);
				unset($_SESSION["content"]);
				unset($_SESSION["fileToUpload"]);
				unset($_SESSION["status"]);
				unset($_SESSION["featured"]);
				
				$_SESSION["message"] = "Blog has been registered successfully";
				header("location: admin_blogs.php");
			}
			else {
				$_SESSION["invalid_message"] = "Sorry blog registration failed! Please try again";
				header("location: admin_blogs.php");
			}
		}
	}
	
	else if($action == "edit_blog_post"){
		$error	   		= FALSE;
		
		$data			= array();
		
		$title 			= $_POST['title'];
		$content 		= $_POST['content'];
		$fileToUpload 	= $_FILES["new_fileToUpload"]["name"]; // New uploaded file name
		$category_id 	= $_POST['category_id'];
		$status 		= $_POST['status'];
		
		$oldFileName = '';
		$oldFileName = $_POST["old_image_name"];   //old file name
		
		if(isset($_POST['featured']) && ($_POST['featured'] == '1')) {	
			$featured		= "1";
		}
		else {
			$featured		= "0";
		}
		
		$blog_id = '';
		$blog_id = $_POST["blog_id"];		//Image ID
		
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

			$target_dir    = DIR_PATH_BLOG_IMAGE;
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
			$data['image_blog']	  = $fileToUpload;
				
		}
		
			$_SESSION["status"] = $status;
		
			$_SESSION["featured"] = $featured;
			
			$_SESSION['category_id'] = $category_id;

		if($error) {			
			header("location: admin_edit_blog.php?blog_id=$blog_id");				
		}
		else {
		
			//Uploading Data
			
			$data['category_id']	= $category_id;
			$data['status']	 		= $status;
			$data['featured'] 		= $featured;
			
			$conditions = array("id" => $blog_id);

			$blog_id = $blogPostObj->update_blog_data($data,$conditions);
			
			if($blog_id) {
				
				unset($_SESSION["title"]);
				unset($_SESSION["content"]);
				unset($_SESSION["category_id"]);
				unset($_SESSION["status"]);
				unset($_SESSION["featured"]);
				
				$_SESSION["message"] = "Blog has been updated successfully";
				header("location: admin_blogs.php");
				
			}
			else {
				$_SESSION["invalid_message"] = "Sorry Updation Failed. Please Try Again";
				header("location: admin_blogs.php");
			}
		}
	}
	
	
	if($action == "delete") {
		
		$blog_id = $_GET['blog_id'];
		$conditions = array("id" => $blog_id);
		$counts = $blogPostObj->blogNotExist($conditions);
		
		if($counts == 0) {
			$_SESSION["invalid_message"] = "Blog Post doesn't exist!";
			header("location: admin_blogs.php");
		}
		else {
			$blog_data = $blogPostObj->blog_delete($conditions);
			$_SESSION["message"] = "Blog Post has been successfully deleted";
			header("location: admin_blogs.php");
		}
	}
	
?>
