<?php
	include "header.php";
	checkAdminUserLogin();
	$blog_id = $_GET['blog_id'];
	if(empty($blog_id))
	{
		$_SESSION['invalid_message'] = "Invalid blog id";
		redirectURL("admin_blogs.php");
	}
	
	$conditions = array("id" => $blog_id);
	$admin_blog_post_data = $blogPostObj->getblogsData($conditions, 1);
	
	if(empty($admin_blog_post_data)) {
		$_SESSION['invalid_message'] = "Invalid blog id";
		redirectURL("admin_blogs.php");
	}
	
	$titleerr		 = '';
	$contenterr		 = '';
	$fileToUploaderr = '';

	$title		 	 = $admin_blog_post_data[0]['title'];
	$content		 = $admin_blog_post_data[0]['content'];
	$fileToUpload	 = $admin_blog_post_data[0]['image_blog'];
	$category_id	 = $admin_blog_post_data[0]['category_id'];
	$status		 	 = $admin_blog_post_data[0]['status'];
	$featured		 = $admin_blog_post_data[0]['featured'];
	$new_fileToUpload= '';

	if(isset($_SESSION["titleerr"])) {
		$titleerr = $_SESSION["titleerr"];
		unset($_SESSION["titleerr"]);
	}
	if(isset($_SESSION["title"])) {
		$title = $_SESSION["title"];
		unset($_SESSION["title"]);
	}

	if(isset($_SESSION["contenterr"])) {
		$contenterr = $_SESSION["contenterr"];
		unset($_SESSION["contenterr"]);
	}
	if(isset($_SESSION["content"])) {
		$content = $_SESSION["content"];
		unset($_SESSION["content"]);
	}

	if(isset($_SESSION["fileToUploaderr"])) {
		$fileToUploaderr = $_SESSION["fileToUploaderr"];
		unset($_SESSION["fileToUploaderr"]);
	}
	if(isset($_SESSION["new_fileToUpload"])) {
		$new_fileToUpload = $_SESSION["new_fileToUpload"];
		unset($_SESSION["new_fileToUpload"]);
	}

	if(isset($_SESSION["category_id"])) {
		$category_id = $_SESSION["category_id"];
		unset($_SESSION["category_id"]);
	}

	if(isset($_SESSION["status"])) {
		$status = $_SESSION["status"];
		unset($_SESSION["status"]);
	}

	if(isset($_SESSION["featured"])) {
		$featured = $_SESSION["featured"];
		unset($_SESSION["featured"]);
	}
	
	$select_box_name = "category_id";
	$getCategoryDropDown = $categoryObj->getBlogsCategoryDropDown(array(), $category_id, $select_box_name);
	
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit blog post</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-plus-square"></i> Edit blog post
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
				
                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_blog_action.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" value="<?php echo $title; ?>"><span class="error-message"><?php echo $titleerr; ?></span>
                            </div>
                            
                            <div class="form-group">
                                <label>Content</label>
								<textarea class="form-control" name="content" id="editor1" rows="10" cols="80">
									<?php echo $content; ?>
								</textarea>
								<span class="error-message"><?php echo $contenterr; ?></span>
								<script>
									// Replace the <textarea id="editor1"> with a CKEditor
									// instance, using default configuration.
									CKEDITOR.replace( 'editor1' );
								</script>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-4">
								<div class="form-group">
									<label>Slider Image</label>
									<input type="file" name = "new_fileToUpload" id="fileToUpload" value = "<?php echo $new_fileToUpload; ?>"><span class="error-message"><?php echo $fileToUploaderr; ?></span>
								</div>
							</div>
						<div class="col-lg-2">
							<div class="form-group">
								<div><img class="edit_user_image" src="<?php echo HTTP_PATH_BLOG_IMAGE.$fileToUpload;?>"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							
                            <div class="form-group">
                                <label> Featured</label>
                                <?php echo $getCategoryDropDown; ?>
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios1" value="1" <?php if($status == 1) { ?>checked="checked"<?php } ?>>Active
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status" id="optionsRadios2" value="0" <?php if($status == 0) { ?>checked="checked"<?php } ?>>Inactive
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name = "featured" id="featured" value = "1" <?php if($featured == 1) { ?>checked="checked"<?php } ?>>
                                <label> Featured</label>
                            </div>


                            <input type="hidden" name = "blog_id" value = "<?php echo $blog_id; ?>">
                            
                            <input type="hidden" name = "old_image_name" value = "<?php echo $fileToUpload; ?>">
                            
                            <input type="hidden" name = "form_action" value = "edit_blog_post">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>
