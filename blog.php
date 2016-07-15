<?php
include "header.php";

$counts = $blogPostObj->blogNotExist(array());

if($counts == 0) {
	$message = "Page is under construction";
}

/*
 * Pagination
 * */
 
if(isset($_GET['page'])) {
	if($_GET['page'] == '0') {
		$_GET['page']  = '1';
	}
	$page_no = $_GET['page'];
}
else {
	$page_no	  = '1';
}

$total_record = '';
$limit		  = '';
$start		  = '';
$end  		  = '';

$total_record = $blogPostObj->countNoOfBlogs(array());

$limit = FRONT_LIST_PAGE_LIMIT;
$start = $page_no * $limit - $limit;
$end = $page_no * $limit-1; 

$cur_page_url = $_SERVER['PHP_SELF'];
$links = getPaginationLinksFront($page_no,$limit, $total_record, $start, $end, $cur_page_url);

$fields = array("id", "title", "content", "image_blog");
$blog_data = $blogPostObj->getPaginationBlogsData(array(),$limit, $fields, $page_no);

?>

<div class="container">
	<hr>
	<div class="row">
		<div class="span8 well">
			<?php
			if(!empty($blog_data)) {
			?>
				<h1>All Blog Post</h1>
				<?php
				for($i=0; $i<count($blog_data);$i++) {
				?>
					<div class="row">
						<div class="span8 thumb-list"> 
							<a rel="lightbox" href="<?php echo HTTP_PATH_BLOG_IMAGE.$blog_data[$i]["image_blog"]; ?>"><img src="<?php echo HTTP_PATH_BLOG_IMAGE.$blog_data[$i]["image_blog"]; ?>" alt=""></a>
							<h3><a href="blog_detail.php?blog_id=<?php echo $blog_data[$i]["id"]; ?>"><?php echo $blog_data[$i]["title"]; ?></a></h3>
							<?php
							$limited_data = limited_data($blog_data[$i]["content"],150);
							?>
							<p><?php echo $limited_data; ?></p>
							<p><a class="btn" href="blog_detail.php?blog_id=<?php echo $blog_data[$i]["id"]; ?>">Read More</a></p>
						</div>
					</div>
				<?php
				}
			}
			?>
			<p><?php echo $links; ?></p>
		</div>
		<?php
		if(!empty($blog_data)) {
		?>
		<div class="span3">
			<h3>Blog Post<small> By <a href="#">Srawat56</a></small></h3>
			<a href="<?php echo SITE_HTTP_ROOT_PATH.'/'.FILENAME_BLOG;?>"><img src="<?php echo HTTP_PATH_IMAGES; ?>blog.jpg" alt="blog image"></a>
		</div>
		<?php
		}
		?>
	</div>
	<hr>
<?php
include "footer.php";
?>
