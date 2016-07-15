<?php
include "header.php";

if(isset($_GET['blog_id'])) {
	if($_GET['blog_id'] == '0') {
		$_GET['blog_id'] = '1';
	}
	$blog_id = $_GET['blog_id'];
}
else {
	$blog_id = '1';
}

$data = array("id" => $blog_id);

$blog_data = $blogPostObj->getblogsData($data,1);

if(empty($blog_data)) {
	redirectURL("404.php");
}

if($blog_data[0]["id"] == $blog_id) {
	$_SESSION['TITLE'] = $blog_data[0]["title"];
	$_SESSION['CONTENT'] = $blog_data[0]["content"];
	$_SESSION['IMAGE_BLOG'] = $blog_data[0]["image_blog"];
	$_SESSION['CATEGORY_ID'] = $blog_data[0]["category_id"];
}
	
$condequal = array("category_id" => $_SESSION['CATEGORY_ID']);
$condnotequal = array("id" => $blog_id);
$fields = array('id', 'title');
$listingData = $blogPostObj->getblogsListData($condequal, $condnotequal, null, $fields);
?>

<div class="container">
	<hr>
	<div class="row">
		<div class="span8">
			<div class="well">
				<?php
				if(!empty($message)) {
				?>
					<h1><?php echo $message; ?></h1>
				<?php
				}
				else {
				?>
					<h1><?php echo $_SESSION['TITLE']; ?></h1>
					<hr>
					<a rel="lightbox" href="<?php echo HTTP_PATH_BLOG_IMAGE.$_SESSION['IMAGE_BLOG']; ?>"><img src="<?php echo HTTP_PATH_BLOG_IMAGE.$_SESSION['IMAGE_BLOG']; ?>" alt=""></a>
					<?php echo $_SESSION['CONTENT']; ?>
				<?php
				}
				?>
			</div>
		</div>
		<div class="span4">
			<h3>Related Category blogs list of <?php echo $_SESSION['TITLE']; ?><small> By <a href="#">Srawat56</a></small></h3>
			<?php
			foreach($listingData as $list) {
			?>
				<hr>
				<h1><a href="blog_detail.php?blog_id=<?php echo $list["id"]; ?>"><?php echo $list['title']; ?></a></h1>
			<?php
			}
			?>
		</div>
	</div>
	<hr>
<?php
include "footer.php";
?>
