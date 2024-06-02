<?php
	include_once "../../lib/core.php";
	include_once "../../env.php";
	include_once "../../lib/webconfig.php";
	include_once "../../lib/functions.php";
	$page_title = "Town Info";
	$breadcrumb = "Town/City/Municipalty details and information available.";
	$myurl = "town-info";
	include_once "../../app/theme/default/header.php";
	include_once "../../app/theme/default/navbar.php";
?>
	<div class="container-fluid my-5">
		<?php include_once "../../app/view/town-info/index.php"; ?>
	</div>
<?php include_once "../../app/theme/default/footer.php"; ?>