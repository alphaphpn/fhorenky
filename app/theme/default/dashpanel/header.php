<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if (empty($page_title)) {echo trim($sysname);} else {echo trim($sysname.": ".$page_title);} ?></title>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta http-equiv="refresh" content="<?php echo $idletime ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Pragma" CONTENT="no-cache">
	<meta http-equiv="Expires" CONTENT="-1">
	<meta name="google-signin-scope" content="admin dashboard">
	<meta name="google-signin-client_id" content="<?php echo $gauthlogin; ?>">

	<link rel="icon" type="image/png" href="<?php echo $domainhome.'/public/'.$favicon; ?>">
	<link rel="stylesheet" href="<?php echo $fontglobal; ?>">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/ajax/libs/octicons/3.5.0/octicons.min.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/css/startup-bootstrap.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/css/style.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/css/dashboard-style.css">
	<link rel="stylesheet" href="<?php echo $domainhome; ?>/assets/datatables/1.13.6/css/dataTables.bootstrap5.min.css">

	<script src="<?php echo $domainhome; ?>/assets/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
	<script src="<?php echo $domainhome; ?>/assets/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?php echo $domainhome; ?>/assets/fontawesome/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
	<script src="<?php echo $domainhome; ?>/assets/ajax/libs/particle-animate/1.0.0/js/particle-animate.js"></script>
	<script src="<?php echo $domainhome; ?>/assets/datatables/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo $domainhome; ?>/assets/datatables/1.13.6/js/dataTables.bootstrap5.min.js"></script>
</head>
<body class="sb-nav-fixed">
	