<?php
include "header.php";

checkAdminUserLogin();

//$fields = array('r.role_name');

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

$total_record = $blogPostObj->countNoOfBlogs(array());

$limit = ADMIN_LIST_PAGE_LIMIT;
$start = $page_no * $limit - $limit;
$end = $page_no * $limit-1; 

$cur_page_url = $_SERVER['PHP_SELF'];
$links = getPaginationLinksAdmin($page_no,$limit, $total_record, $start, $end, $cur_page_url);

$fields = array("id", "title", "category_id", "status", "featured");

$admin_blog_post_data = $blogPostObj->getPaginationBlogsData(array(),$limit, $fields, $page_no);

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
                            Blog Posts
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus-square"></i> Blog Posts
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
                <a href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_add_blog.php"><button type="button" class="btn btn-primary">Add new blog</button></a>
                </div>
                <?php
                if(!empty($admin_blog_post_data)) {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="col-lg-1">S. No</th>
                                        <th class="col-lg-6">Title</th>
                                        <th class="col-lg-1">Category</th>
                                        <th class="col-lg-1">Status</th>
                                        <th class="col-lg-1">Featured</th>
                                        <th class="col-lg-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									$count=0;
									foreach($admin_blog_post_data as $data) {
										$count=$count+1;
									?>
                                    <tr>
                                        <td><?php echo $s_no=($page_no-1)*$limit+$count; ?></td>
                                        <td><?php echo $data['title']; ?></td>
                                        <td><?php echo $data['category_id']; ?></td>
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
											<?php
											if($data['featured'] == '1') {
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
                                        <td class="col-lg-2">
											<a href="<?php echo ADMIN_FILENAME_EDIT_BLOG; ?>?blog_id=<?php echo $data['id'];?>">Edit</a>&nbsp;
											<a href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_blog_action.php?blog_id=<?php echo $data['id'];?>&form_action=delete">Delete</a>
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
