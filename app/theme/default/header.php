<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if (empty($page_title)) {echo trim($sysname);} else {echo trim($sysname.": ".$page_title);} ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta http-equiv="refresh" content="">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<meta name="google-signin-scope" content="profile email">
	<meta name="google-signin-client_id" content="<?php echo $gauthlogin; ?>">
	<link rel="icon" type="image/png" href="<?php echo $domainhome.'/public/'.$favicon; ?>">
	<link rel="stylesheet" href="<?php echo $fontglobal; ?>">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/fontawesome/releases/v5.7.0/css/all.css">
	<link href="<?php echo $domainhome; ?>/assets/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/npm/slick-carousel@1.8.1/slick/slick.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/css/style.css">
	<script src="<?php echo $domainhome; ?>/assets/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $domainhome; ?>/assets/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="<?php echo $domainhome; ?>/assets/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="//apis.google.com/js/platform.js" async defer></script>
	<script src="<?php echo $domainhome; ?>/assets/ajax/libs/particle-animate/1.0.0/js/particle-animate.js"></script>
</head>
<body id="home">