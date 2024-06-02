<?php
	include_once "../../lib/core.php";
	include_once "../../env.php";
	include_once "../../lib/webconfig.php";
	include_once "../../lib/functions.php";
	$page_title = "Sibugay Voter's ID";
	$breadcrumb = "This serves an Identification Information only for Zamboanga Sibugay Voter's";
	$myurl = "precinct-voter";
	include_once "../../app/theme/default/header.php";
?>
	<div class="container-fluid">
		<?php include_once "../../app/view/precinct-voter/index.php"; ?>
	</div>
<?php include_once "../../app/theme/default/footer.php"; ?>