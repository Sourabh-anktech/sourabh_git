<?php
include "header.php";
checkUserLogin();

$data = array("u.id" => $_SESSION['user']['ID']);
$user_data = $userObj->getUsersData($data, 1);
if($_SESSION['user']['isLoggedIn'] == TRUE) {
	if($user_data[0]["id"] == $_SESSION['user']['ID']) {
		
		$_SESSION['ID'] = $user_data[0]["id"];
		$_SESSION['NAME'] = $user_data[0]["name"];
		$_SESSION['EMAIL'] = $user_data[0]["email"];
		$_SESSION['PROFILE_PICTURE'] = $user_data[0]["image_profile"];
	}
}
else {
	header("location:login.php");
}
?>
<div class="container">
	<hr>
	<div class="well">
		<div class="row">
			<div class="span6 proimg">
				<?php
				if($_SESSION['PROFILE_PICTURE']) {
				?>
					<h1><img src='<?php echo HTTP_PATH_PROFILE_PIC.$_SESSION['PROFILE_PICTURE']; ?>' alt='image'></h1>
				<?php
				}
				else {
					echo "Image is not available";
				}
				?>
			</div>
		</div>
		<div class="row">
			<div class="span6 thumb-list">
				<h1>Id : <?php echo $_SESSION['ID']; ?></h1>
				<h1>Name : <?php echo $_SESSION['NAME']; ?></h1>
				<h1>Email : <?php echo $_SESSION['EMAIL']; ?></h1>
			</div>
		</div>
	</div>
	<hr>
<?php
include "footer.php";
?>
