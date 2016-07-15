<?php
include "header.php";
checkAdminUserLogin();

	$titleerr		 = '';
	$contenterr		 = '';
	$fileToUploaderr = '';

	$title			 = '';
	$content		 = '';
	$fileToUpload    = '';
	$status			 = '';

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
                        <h1 class="page-header">Add new page</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Add page
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_page_action.php" method="post" enctype="multipart/form-data">
                            
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
							
                            <div class="form-group">
                                <label>Slider Image</label>
                                <input type="file" name = "fileToUpload" id="fileToUpload" value = "<?php echo $fileToUpload; ?>"><span class="error-message"><?php echo $fileToUploaderr; ?></span>
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
                            

                            <input type="hidden" name = "form_action" value = "page_registration">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>

