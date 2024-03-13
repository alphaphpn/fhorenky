<?php

	include_once "../../lib/core.php";
	include_once "../../env.php";
	include_once "../../lib/webconfig.php";
	include_once "../../lib/functions.php";
	$page_title = "DocTrack - Log";
	$breadcrumb = "Tracks different attributes and locations of documents. Through document tracking you can control who can view a document, check to see who has accessed the document, who has made changes to it, and who the document has been sent to.";
	include_once "../../app/theme/default/header.php";
	include_once "../../app/view/doctrack-log/index.php";
	include_once "../../app/theme/default/footer.php";