<?php
include "header.php";

checkAdminUserLogin();

//$role_join = array(array('table_name' => 'roles r', 'cond_join' => 'u.role_id = r.id', 'join_type' => 'INNER'));
$ordering = array(array('field_name' => 'u.role_id', 'direction' => 'asc'));
$fields = array('u.id', 'u.name', 'u.email', 'u.role_id', 'u.status', 'r.role_name');
//~ $admin_user_data = $adminObj->getUsersData(array(), null, $fields, array(), $ordering);

if(isset($_GET['page']))
{
	if($_GET['page'] == '0')
	{
		$_GET['page']  = '1';
	}
	$page_no = $_GET['page'];
}
else {
	$page_no	  = '1';
}

$s_no		  ='0';
$total_record = '';
$limit		  = '';
$start		  = '';
$end  		  = '';

$total_record = $userObj->countNoOfUsers(array());

$limit = ADMIN_LIST_PAGE_LIMIT;
$start = $page_no * $limit - $limit;
$end = $page_no * $limit-1; 

$cur_page_url = $_SERVER['PHP_SELF'];
$links = getPaginationLinksAdmin($page_no,$limit, $total_record, $start, $end, $cur_page_url);

$admin_user_data = $adminObj->getPaginationUsersData(array(),$limit, $fields, array(), $ordering, $page_no);

	$message	= '';
	$invalid_message = '';

	if(isset($_SESSION["message"])) {
		$message = $_SESSION["message"];
		unset($_SESSION["message"]);
	}
	
	if(isset($_SESSION["invalid_message"])) {
		$invalid_message = $_SESSION["invalid_message"];
		unset($_SESSION["invalid_message"]);
	}
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-users"></i> Users
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <?php
                if($message != '') {
                ?>
					<div class="alert alert-success">
						<?php echo $message; ?>
					</div>
                <?php
				}
                ?>
                <?php
                if($invalid_message != '') {
                ?>
					<div class="alert alert-danger">
						<?php echo $invalid_message; ?>
					</div>
                <?php
				}
                ?>
				<div class="add_new_user_button">
                <a href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_add_user.php"><button type="button" class="btn btn-primary">Add new user</button></a>
                </div>
                <?php
                if(!empty($admin_user_data))
                {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1">S. No</th>
                                        <th class="col-lg-2">Name</th>
                                        <th class="col-lg-4">Email</th>
                                        <th class="col-lg-2">Role</th>
                                        <th class="col-lg-1">Status</th>
                                        <th class="col-lg-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
						
									<?php
									$count=0;
									foreach($admin_user_data as $data)
									{
										$count=$count+1;
									?>
                                    <tr>
                                        <td><?php echo $s_no = ($page_no-1)*$limit+$count; ?></td>
                                        <td><?php echo $data['name']; ?></td>
                                        <td><?php echo $data['email']; ?></td>
                                        <td><?php echo $data['role_name']; ?></td>
                                        <td>
											<?php
											if($data['status'] == '1') {
											?>
												<img src="<?php echo HTTP_PATH_IMAGES; ?>active.png" alt="image">
											<?php
											}
											else {
											?>
												<img src="<?php echo HTTP_PATH_IMAGES; ?>inactive.png" alt="image">
											<?php
											}
											?>
											</td>
                                        <td>
											<a href="<?php echo ADMIN_FILENAME_EDIT_USER; ?>?id=<?php echo $data['id'];?>">Edit</a>&nbsp;
											<a href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_user_action.php?id=<?php echo $data['id'];?>&form_action=delete">Delete</a>
										</td>
                                    </tr>
                                    <?php
									}
									?>
                                </tbody>
                            </table>
                        </div>
                    </div>
				</div>
				<?php
				}
				?>
				<p><?php echo $links; ?></p>
            </div>
        </div>
<?php 
include "footer.php";
?>

