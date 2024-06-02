<?php
	include_once "../../lib/core.php";
	include_once "../../env.php";
	include_once "../../lib/webconfig.php";
	include_once "../../lib/functions.php";
	$page_title = "Voter's List";
	$breadcrumb = "List of COMELEC Voter's in the PH.";
	$myurl = "comelec-voters-manage";
	include_once "../../app/theme/default/header.php";
	include_once "../../app/theme/default/navbar.php";
?>
	<div class="container-fluid">
		<?php include_once "../../app/view/comelec-voters/index.php"; ?>
	</div>
<?php include_once "../../app/theme/default/footer.php"; ?>