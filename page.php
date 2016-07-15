<?php
include "header.php";
	
if(isset($_GET['page_id'])) {
	if($_GET['page_id'] == '0') {
		$_GET['page_id'] = '1';
	}
	$page_id = $_GET['page_id'];
}
else {
	$page_id = '1';
}

$conditions		= array("id" => $page_id,"status" => '1');
$counts = $pageObj->pageNotExist($conditions);

if($counts == 0) {
	$message = "Page is in under construction";
}

$data = array("p.id" => $page_id);
$page_data = $pageObj->getPagesData($data,1);

if(empty($page_data)) {
	redirectURL("404.php");
}

	if($page_data[0]["id"] == $page_id) {
		
		$_SESSION['TITLE'] = $page_data[0]["title"];
		$_SESSION['CONTENT'] = $page_data[0]["content"];
		$_SESSION['IMAGE_PAGES'] = $page_data[0]["image_pages"];
	
	}
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
				<?php echo $_SESSION['CONTENT']; ?>
				<?php
				}
				?>
			</div>
		</div>
		<?php
		if(empty($message)) {
		?>
		<div class="span4">
			<h3><?php echo $_SESSION['TITLE']; ?><small> By <a href="#">Srawat56</a></small></h3>
			<a href="<?php echo SITE_HTTP_ROOT_PATH.'/page.php?page_id='.$page_id;?>"><img src="<?php echo HTTP_PATH_PAGE_IMAGE.$_SESSION['IMAGE_PAGES']; ?>" alt=""></a>
		</div>
		<?php
		}
		?>
	</div>
	<hr>
<?php
include "footer.php";
?>
