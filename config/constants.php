<?php
/*
 * Global constants
 * */
define("SITE_HTTP_ROOT_PATH", "http://".$_SERVER['HTTP_HOST']."/sourabh");

define("SITE_DOC_ROOT_PATH", dirname(dirname(__FILE__)));

define("SITE_CLASSES_DIR_PATH", SITE_DOC_ROOT_PATH.'/classes/');

define("DIR_PATH_PROFILE_PIC", SITE_DOC_ROOT_PATH."/images/profile_pic/");

define("HTTP_PATH_PROFILE_PIC", SITE_HTTP_ROOT_PATH."/images/profile_pic/");

define("DIR_PATH_IMAGES", SITE_DOC_ROOT_PATH."/images/");

define("HTTP_PATH_IMAGES", SITE_HTTP_ROOT_PATH."/images/");

/*
 * Admin constants
 * */
 
define("SITE_ADMIN_HTTP_ROOT_PATH", "http://".$_SERVER['HTTP_HOST']."/sourabh/admin/");

define("DIR_PATH_PAGE_IMAGE", SITE_DOC_ROOT_PATH."/images/page_images/");

define("HTTP_PATH_PAGE_IMAGE", SITE_HTTP_ROOT_PATH."/images/page_images/");

define("DIR_PATH_SLIDER_IMAGE", SITE_DOC_ROOT_PATH."/images/slider_img/");

define("HTTP_PATH_SLIDER_IMAGE", SITE_HTTP_ROOT_PATH."/images/slider_img/");

define("DIR_PATH_BLOG_IMAGE", SITE_DOC_ROOT_PATH."/images/blog_images/");

define("HTTP_PATH_BLOG_IMAGE", SITE_HTTP_ROOT_PATH."/images/blog_images/");

/*
 * Define Constant for pagination limit
 * */

define("ADMIN_LIST_PAGE_LIMIT", "10");

define("FRONT_LIST_PAGE_LIMIT", "10");
?>
