<?php
include "header.php";
checkAdminUserLogin();

	$role_nameerr	 = '';

	$role_name		 = '';

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
                        <h1 class="page-header">Add new role</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-user"></i> Add role
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_role_action.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>Role Name</label>
                                <input type="text" class="form-control" name="role_name" value="<?php echo $role_name; ?>"><span class="error-message"><?php echo $role_nameerr; ?></span>
                            </div>

                            <input type="hidden" name = "form_action" value = "role_registration">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>

