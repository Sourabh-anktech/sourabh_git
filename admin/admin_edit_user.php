<?php
include "header.php";
checkAdminUserLogin();
		
	$id = $_GET['id'];
	if(empty($id))
	{
		$_SESSION['invalid_message'] = "Invalid user id";
		redirectURL("admin_users.php");
	}
	
	$conditions = array("u.id" => $id);
	$fields = array('u.id', 'u.name', 'u.email','u.image_profile', 'u.role_id','u.status','u.modified');
	$admin_user_data = $adminObj->getUsersData($conditions, 1, $fields);
	
	if(empty($admin_user_data)) {
		$_SESSION['invalid_message'] = "Invalid user id";
		redirectURL("admin_users.php");
	}
	
	$admin_role_data = $roleObj->getRolesData();
	
	
	$nameerr		 = '';
	$emailerr    	 = '';
	$passworderr     = '';
	$fileToUploaderr = '';

	$name		 	 = $admin_user_data[0]['name'];
	$email	 	 	 = $admin_user_data[0]['email'];
	$password        = '';
	$fileToUpload    = $admin_user_data[0]['image_profile'];
	$role        	 = $admin_user_data[0]['role_id'];
	$status		     = $admin_user_data[0]['status'];
	$new_fileToUpload= '';
	
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

	if(isset($_SESSION["password"])) {
		$password = $_SESSION["password"];
		unset($_SESSION["password"]);
	}

	if(isset($_SESSION["fileToUploaderr"])) {
		$fileToUploaderr = $_SESSION["fileToUploaderr"];
		unset($_SESSION["fileToUploaderr"]);
	}
	if(isset($_SESSION["new_fileToUpload"])) {
		$new_fileToUpload = $_SESSION["new_fileToUpload"];
		unset($_SESSION["new_fileToUpload"]);
	}
	
	if(isset($_SESSION["role"])) {
		$role = $_SESSION["role"];
		unset($_SESSION["role"]);
	}
	
	if(isset($_SESSION["status"])) {
		$status = $_SESSION["status"];
		unset($_SESSION["status"]);
	}

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit user</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> Edit User
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
				
                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_user_action.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>"><span class="error-message"><?php echo $nameerr; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $email; ?>"><span class="error-message"><?php echo $emailerr; ?></span>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name = "password" value = "<?php echo $password; ?>">
                            </div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
                            <div class="form-group">
                                <label>Profile Picture</label>
                                <input type="file" name = "new_fileToUpload" id="fileToUpload" value = "<?php echo $new_fileToUpload; ?>"><span class="error-message"><?php echo $fileToUploaderr; ?></span>
							</div>
						</div>
						<div class="col-lg-2">
                            <div><img class="edit_user_image" src="<?php echo HTTP_PATH_PROFILE_PIC.$fileToUpload;?>"></div>
						</div>
					</div>
                <div class="row">
                    <div class="col-lg-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name = "role">
									<?php
									for($i=0; $i<count($admin_role_data); $i++)
									{
									?>
                                    <option value="<?php echo $admin_role_data[$i]['id']; ?>" <?php if($role == $admin_role_data[$i]['id']) { ?>selected="selected" <?php } ?>><?php echo $admin_role_data[$i]['role_name'];?></option>
                                    <?php
									}
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios1" value="1" <?php if($status == '1') { ?>checked="checked" <?php } ?>>Active
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios2" value="0" <?php if($status == '0') { ?>checked="checked" <?php } ?>>Inactive
                                    </label>
                                </div>
                            </div>
                            
                            <input type="hidden" name = "user_id" value = "<?php echo $id; ?>">
                            
                            <input type="hidden" name = "old_image_name" value = "<?php echo $fileToUpload; ?>">
                            
                            <input type="hidden" name = "form_action" value = "edit_user">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>

