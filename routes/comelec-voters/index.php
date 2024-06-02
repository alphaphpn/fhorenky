<?php

	include_once "../../lib/core.php";
	include_once "../../env.php";
	include_once "../../lib/webconfig.php";
	include_once "../../lib/functions.php";
	$page_title = "Voter's List";
	$breadcrumb = "List of COMELEC Voter's in the PH.";
	$myurl = "comelec-voters";
	include_once "../../app/theme/default/dashpanel/header.php";
	include_once "../../app/theme/default/dashpanel/navbar.php";
	include_once "../../app/theme/default/dashpanel/sidenav.php";
	include_once "../../app/view/comelec-voters/index.php";
	include_once "../../app/theme/default/dashpanel/footer.php";