<?php
include "header.php";

$data = array('status' => '1');
$image_data = $sliderImgObj->getSliderImgData($data);

$conditions		= array("status" => '1', "featured" => '1');
$fields = array("id", "title", "content", "image_blog");

$blog_data = $blogPostObj->getblogsData($conditions, null, $fields);

?>
<div class="container">
<!--Start Carousel-->
	<?php
	if(!empty($image_data)) {
	?>
		<div id="myCarousel" class="carousel slide">
			<div class="carousel-inner">
				<?php
				for($i=0; $i<count($image_data);$i++) {
				?>
					<div class="item <?php if($i==0) echo 'active';?>">
						<img src="<?php echo HTTP_PATH_SLIDER_IMAGE.$image_data[$i]["image_slide"]; ?>" alt="image">
						<div class="carousel-caption">
							<h4><?php echo $image_data[$i]["title"]; ?></h4>
							<p><?php echo $image_data[$i]["content"]; ?></p>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		<?php
		if(count($image_data) > 1) {
		?>
			<a class="left carousel-control" href="#myCarousel" data-slide="prev"><img src="<?php echo HTTP_PATH_IMAGES.'arrow.png'; ?>" alt=""></a> 
			<a class="right carousel-control" href="#myCarousel" data-slide="next"><img src="<?php echo HTTP_PATH_IMAGES.'arrow2.png'; ?>" alt=""></a> 
		<?php
		}
		?>
		</div>
	<?php
	}
	?>
<!--End Carousel-->
	<hr>
	<div class="row">
		<div class="span12">
			<p class="text_middle">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.<br><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.<br><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>
		</div>
	</div>
<!--Start second row of columns-->
	<hr>
	<?php
	if(!empty($blog_data)) {
	?>
		<div class="row">
			<?php
			foreach($blog_data as $data) {
			?>
				<div class="span6 thumb-list"> 
					<a rel="lightbox" href="<?php echo HTTP_PATH_BLOG_IMAGE.$data["image_blog"]; ?>"><img src="<?php echo HTTP_PATH_BLOG_IMAGE.$data["image_blog"]; ?>" alt="image"></a>
					<h3><a href="blog_detail.php?blog_id=<?php echo $data["id"]; ?>"><?php echo $data["title"]; ?></a></h3>
					<?php
					$limited_data = limited_data($data["content"],100);
					?>
					<p><?php echo $limited_data; ?></p>
					<p><a class="btn" href="blog_detail.php?blog_id=<?php echo $data["id"]; ?>">Read More</a></p>
				</div>
			<?php
			}
			?>
		</div>
	<hr>
	<?php
	}
	?>
<?php
include "footer.php";
?>
