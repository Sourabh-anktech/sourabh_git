<?php
include "../config/config.php";
	$action = "";
	if(!isset($_REQUEST["form_action"])) {
		header("location: login.php");
	} 
	else {
		$action = $_REQUEST["form_action"];
	}
	
	if($action == "category_registration"){
		
		$error	   				= FALSE;
		$parent_category_id 	= $_POST['parent_category_id'];
		$category_name 			= $_POST['category_name'];
		
		if (empty($category_name)) {
			$_SESSION["category_nameerr"] = "Category Name is required";
			$error = TRUE;
		}
		else{
			$_SESSION["category_name"] = $category_name;
		}
		
			$_SESSION["parent_category_id"] = $parent_category_id;

		
		if($error) {
			header("location: admin_add_category.php");		
		}
		
		else{
			
			
			$data = array(
						  "parent_id" => $parent_category_id,
						  "category_name" => $category_name, 
						  "created" => time(),
						  "modified" =>time());

			$category_id = $categoryObj->add_new_category($data);
			
			if($category_id) {
				
				unset($_SESSION["category_id"]);
				
				$_SESSION["message"] = "Category has been registered successfully";
				header("location: admin_categories.php");
			}
			else {
				$_SESSION["invalid_message"] = "Sorry category registration failed! Please try again";
				header("location: admin_categories.php");
			}
		}
	}
	
	else if($action == "edit_category"){
		
		$error	   		= FALSE;
		$data			= array();
		
		$category_id	= $_POST['category_id'];
		$category_name 		= $_POST['category_name'];
		$parent_category_id	= $_POST['parent_category_id'];
		
		$category_id = '';
		$category_id = $_POST["category_id"];			// Category id
		
		if (empty($category_name)) {
			$_SESSION["category_nameerr"] = "Category Name is required";
			$error = TRUE;
		}
		else{
			$_SESSION["category_name"] = $category_name;
			$data['category_name']	   = $category_name;
		}
			$checkDeadlock = $categoryObj->categoryRemoveDeadlock($parent_category_id, $category_id);
			
			$_SESSION["parent_category_id"] = $parent_category_id;
		
		if($error) {			
			header("location: admin_edit_category.php?category_id=$category_id");				
		}
		else {
		
			//Uploading Data
			
			$data['parent_id']	  = $parent_category_id;
			$data['modified']  	  = time();
			
			$conditions = array("id" => $category_id);

			$category_id = $categoryObj->update_category_data($data,$conditions);
			
			if($category_id) {
				
				unset($_SESSION["category_name"]);
				unset($_SESSION["parent_category_id"]);
				
				$_SESSION["message"] = "Category has been updated successfully";
				header("location: admin_categories.php");
				
			}
			else {
				$_SESSION["invalid_message"] = "Sorry Updation Failed. Please Try Again";
				header("location: admin_categories.php");
			}
		}
	}
	
	
	if($action == "delete") {
		
		$category_id = $_GET['category_id'];
		$conditions = array("id" => $category_id);
		$counts = $categoryObj->categoryNotExist($conditions);
		
		if($counts == 0) {
			$_SESSION["invalid_message"] = "Category doesn't exist!";
			header("location: admin_categories.php");
		}
		else {
			$category_data = $categoryObj->category_delete($conditions);
			$_SESSION["message"] = "Category has been deleted successfully";
			header("location: admin_categories.php");
		}
	}
	
?>
