<?php
	include_once "../../lib/core.php";
	include_once "../../env.php";
	include_once "../../lib/webconfig.php";
	include_once "../../lib/functions.php";
	$page_title = "Result: Precinct Finder";
	$breadcrumb = "Result of filtered voter's for Sibugay only.";
	$myurl = "precinct-finder-result";
	include_once "../../app/theme/default/header.php";
	include_once "../../app/theme/default/navbar.php";
?>
	<div class="container-fluid">
		<?php include_once "../../app/view/precinct-finder-result/index.php"; ?>
	</div>
<?php include_once "../../app/theme/default/footer.php"; ?>