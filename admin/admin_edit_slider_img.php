<?php
include "header.php";
checkAdminUserLogin();
	$image_id = $_GET['id'];
	
	if(empty($image_id))
	{
		$_SESSION['invalid_message'] = "Invalid image id";
		redirectURL("admin_slider_img.php");
	}
	
	$conditions = array("id" => $image_id);
	$admin_slider_img_data = $sliderImgObj->getSliderImgData($conditions, 1);
	
	if(empty($admin_slider_img_data)) {
		$_SESSION['invalid_message'] = "Invalid image id";
		redirectURL("admin_slider_img.php");
	}
	
	$titleerr		 = '';
	$contenterr		 = '';
	$fileToUploaderr = '';

	$title		 	 = $admin_slider_img_data[0]['title'];
	$content		 = $admin_slider_img_data[0]['content'];
	$status		 	 = $admin_slider_img_data[0]['status'];
	$fileToUpload	 = $admin_slider_img_data[0]['image_slide'];
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
                        <h1 class="page-header">Edit image</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-sliders"></i> Edit image
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
				
                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_slider_img_action.php" method="post" enctype="multipart/form-data">
                            
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
									<div><img class="edit_user_image" src="<?php echo HTTP_PATH_SLIDER_IMAGE.$fileToUpload;?>"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
              
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

                            
                            <input type="hidden" name = "image_id" value = "<?php echo $image_id; ?>">
                            
                            <input type="hidden" name = "old_image_name" value = "<?php echo $fileToUpload; ?>">
                             
                            <input type="hidden" name = "form_action" value = "edit_slider_img">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>

