<?php
/*
 * Classes section started - Include classes
 * */
 
require_once(SITE_CLASSES_DIR_PATH."MysqliDb.php");

require_once(SITE_CLASSES_DIR_PATH."class_users.php");
$userObj = new Users();
$adminObj = new Users();

require_once(SITE_CLASSES_DIR_PATH."class_roles.php");
$roleObj = new Roles();

require_once(SITE_CLASSES_DIR_PATH."class_pages.php");
$pageObj = new Pages();

require_once(SITE_CLASSES_DIR_PATH."class_slider_img.php");
$sliderImgObj = new SliderImg();

require_once(SITE_CLASSES_DIR_PATH."class_blog.php");
$blogPostObj = new BlogPost();

require_once(SITE_CLASSES_DIR_PATH."class_categories.php");
$categoryObj = new Categories();

?>
