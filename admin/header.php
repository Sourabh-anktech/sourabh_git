<?php
include "../config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Learning Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH; ?>css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH; ?>css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <!-- Editor -->
    <script src="<?php echo SITE_ADMIN_HTTP_ROOT_PATH; ?>/js/ckeditor/ckeditor.js"></script>

</head>

<body>

    <div id="wrapper" <?php if(checkAdminUserLogin(false)) { ?> class="pd-left"<?php } ?>>
    <?php if(checkAdminUserLogin(false)) { ?>
		<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo ADMIN_FILENAME_DEFAULT; ?>">Learning Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="<?php echo SITE_ADMIN_HTTP_ROOT_PATH; ?>admin_user_action.php?form_action=logout"><i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="<?php echo ADMIN_FILENAME_DEFAULT; ?>"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#user-panel"><i class="fa fa-fw fa-users"></i> Users <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="user-panel" class="collapse">
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_USERS; ?>">List all users</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ADD_USER; ?>">Add new user</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#role-panel"><i class="fa fa-fw fa-user"></i> Roles <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="role-panel" class="collapse">
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ROLES; ?>">List all roles</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ADD_ROLE; ?>">Add new role</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#page-panel"><i class="fa fa-fw fa-file"></i> Pages <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="page-panel" class="collapse">
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_PAGES; ?>">List all pages</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ADD_PAGE; ?>">Add new page</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#slider-panel"><i class="fa fa-fw fa-sliders"></i> Slider <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="slider-panel" class="collapse">
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_SLIDER_IMAGES; ?>">List all slider image</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ADD_SLIDER_IMAGE; ?>">Add new slider image</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#blog-panel"><i class="fa fa-fw fa-plus-square"></i> Blog Post <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="blog-panel" class="collapse">
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_BLOGS; ?>">List all blog post</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ADD_BLOG; ?>">Add new blog post</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#category-panel"><i class="fa fa-fw fa-tags"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="category-panel" class="collapse">
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_CATEGORIES; ?>">List all Categories</a>
                            </li>
                            <li>
                                <a href="<?php echo ADMIN_FILENAME_ADD_CATEGORY; ?>">Add new Category</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
        <?php } ?>
