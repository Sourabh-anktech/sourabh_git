<?php
	include "header.php";
	checkAdminUserLogin();
	$category_id = $_GET['category_id'];
	if(empty($category_id))
	{
		$_SESSION['invalid_message'] = "Invalid Category id";
		redirectURL("admin_categories.php");
	}
	
	$conditions = array("c.id" => $category_id);
	$fields = array("c.id", "c.parent_id", "c.category_name", "ctg.category_name as parent_category_name");
	
	$admin_category_data = $categoryObj->getCategoriesData($conditions, 1,$fields);
	
	
	if(empty($admin_category_data)) {
		$_SESSION['invalid_message'] = "Invalid category id";
		redirectURL("admin_categories.php");
	}
	
	$category_nameerr	 = '';
	
	$category_id		  = $admin_category_data[0]['id'];
	$category_name		  = $admin_category_data[0]['category_name'];
	$parent_category_id   = $admin_category_data[0]['parent_id'];
	$select_box_name	  = '';

	if(isset($_SESSION["category_nameerr"])) {
		$category_nameerr = $_SESSION["category_nameerr"];
		unset($_SESSION["category_nameerr"]);
	}
	if(isset($_SESSION["category_name"])) {
		$category_name = $_SESSION["category_name"];
		unset($_SESSION["category_name"]);
	}
	
	if(isset($_SESSION["parent_category_id"])) {
		$parent_category_id = $_SESSION["parent_category_id"];
		unset($_SESSION["parent_category_id"]);
	}
	
	$select_box_name = "parent_category_id";
	$getCategoryDropDown = $categoryObj->getBlogsCategoryDropDown(array(), $parent_category_id,$select_box_name);

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Edit Category</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i><a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"> Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-tags"></i> Edit Category
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
				
                        <form role="form" action="<?php echo SITE_ADMIN_HTTP_ROOT_PATH;?>admin_category_action.php" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label>Category name</label>
                                <input type="text" class="form-control" name="category_name" value="<?php echo $category_name; ?>"><span class="error-message"><?php echo $category_nameerr; ?></span>
                            </div>
							
							<div class="form-group">
                                <label>Parent Class</label>
                                <?php echo $getCategoryDropDown; ?>
                            </div>

                            <input type="hidden" name = "category_id" value = "<?php echo $category_id; ?>">
                             
                            <input type="hidden" name = "form_action" value = "edit_category">

                            <button type="submit" value="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
				</div>
            </div>
        </div>
<?php 
include "footer.php";
?>
