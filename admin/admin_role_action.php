<?php
include "../config/config.php";
	$action = "";
	if(!isset($_REQUEST["form_action"])) {
		header("location: login.php");
	} 
	else {
		$action = $_REQUEST["form_action"];
	}
	
	if($action == "role_registration"){
		$error	   		= FALSE;
		$role_name 			= $_POST['role_name'];
		
		if (empty($role_name)) {
			$_SESSION["role_nameerr"] = "Role Name is required";
			$error = TRUE;
		}
		else if(!preg_match("/^[a-zA-Z ]*$/",$role_name))
		{
		 $_SESSION["role_nameerr"] = "Role name must be in alphabet";
		 $error = TRUE;
		}
		else{
			$_SESSION["role_name"] = $role_name;
		}

		
		if($error) {
			header("location: admin_add_role.php");		
		}
		else{
			
			
			$data = array("role_name" => $role_name);

			$role_id = $roleObj->add_new_role($data);
			if($role_id) {
				
				unset($_SESSION["role_id"]);
				
				$_SESSION["message"] = "Role has been registered successfully";
				header("location: admin_roles.php");
			}
			else {
				$_SESSION["invalid_message"] = "Sorry role registration failed! Please try again";
				header("location: admin_roles.php");
			}
		}
	}
	
	
	else if($action == "edit_role"){
		$error	   		= FALSE;
		
		$data			= array();
		
		$role_name			= '';
		$role_name 			= $_POST['role_name'];
		
		$role_id = '';
		$role_id = $_POST["role_id"];		//Role ID
		
		if (empty($role_name)) {
			$_SESSION["role_nameerr"] = "Role name is required";
			$error = TRUE;
		}
		else if(!preg_match("/^[a-zA-Z ]*$/",$role_name))
		{
		 $_SESSION["role_nameerr"] = "Role name must be in alphabet";
		 $error = TRUE;
		}
		else{
			$_SESSION["role_name"] = $role_name;
			$data['role_name']	  = $role_name;
		}

		if($error) {			
			header("location: admin_edit_role.php?role_id=$role_id");				
		}
		else {
		
			//Uploading Data
			
			$data['role_name']	  = $role_name;
			
			$conditions = array("id" => $role_id);

			$role_id = $roleObj->update_role_data($data,$conditions);
			
			if($role_id) {
				
				unset($_SESSION["role_name"]);
				
				$_SESSION["message"] = "Role has been updated successfully";
				header("location: admin_roles.php");
				
			}
			else {
				$_SESSION["invalid_message"] = "Sorry Updation Failed. Please Try Again";
				header("location: admin_roles.php");
			}
		}
	}
	
	
	if($action == "delete") {
		
		$role_id = $_GET['role_id'];
		
		$conditions = array("id" => $role_id);
		$counts = $roleObj->roleNotExist($conditions);
		
		if($counts == 0) {
			$_SESSION["invalid_message"] = "User doesn't exist!";
			header("location: admin_roles.php");
		}
		else {
			$role_data = $roleObj->role_delete($conditions);
			$_SESSION["message"] = "Role has been deleted successfully";
			header("location: admin_roles.php");
		}
	}
		
?>
