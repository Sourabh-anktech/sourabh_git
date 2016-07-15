<?php
include "header.php";
checkAdminUserLogin();
	$role_id = $_GET['role_id'];
	if(empty($role_id))
	{
		$_SESSION['invalid_message'] = "Invalid role id";
		redirectURL("admin_roles.php");
	}
	
	$conditions = array("r.id" => $role_id);
	$admin_role_data = $roleObj->getRolesData($conditions, 1);
	
	if(empty($admin_role_data)) {
		$_SESSION['invalid_message'] = "Invalid role id";
		redirectURL("admin_roles.php");
	}
	
	$role_nameerr		 = '';

	$role_name		 	 = $admin_role_data[0]['role_name'];
	
	
	if(isset($_SESSION["role_nameerr"])) {
		$role_nameerr = $_SESSION["role_nameerr"];
		unset($_SESSION["role_nameerr"]);
	}
	if(isset($_SESSION["role_name"])) {
		$role_name = $_SESSION["role_name"];
		unset($_SESSION["role_name"]);
	}
	

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit role</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> Edit role
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
				
                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_role_action.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>Role name</label>
                                <input type="text" class="form-control" name="role_name" value="<?php echo $role_name; ?>"><span class="error-message"><?php echo $role_nameerr; ?></span>
                            </div>

                            
                            <input type="hidden" name = "role_id" value = "<?php echo $role_id; ?>">
                            
                            <input type="hidden" name = "form_action" value = "edit_role">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>

