	<canvas id="particle-animate" style="position: fixed; overflow: hidden; width: 100%; height: 100vh;"></canvas>

	<div id="layoutSidenav">
		<div id="layoutSidenav_nav">
			<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
				<div class="sb-sidenav-header d-flex">
					<img src="" alt="<?php echo strtoupper(substr($_SESSION["uname"],0,1)); ?>" class="img-responsive rounded-2" style="min-width: 30%; background-color: #fd7e14;">
					<div class="d-flex flex-column ms-2">
						<span class="user-name font-size-14">
							<?php echo $_SESSION["uname"]; ?><br>
							<strong><?php echo $_SESSION["uposition"]; ?></strong>
						</span>
						<span class="user-role font-size-10"><?php echo $_SESSION["officeid"].' '.$_SESSION["officeabvr"]; ?></span>
						<span class="user-status font-size-10">
							<i class="fa fa-circle text-success"></i>
							<span>Online</span>
						</span>
					</div>
				</div>

				<div class="sb-sidenav-menu">
					<div class="nav pb-4">
						<div class="sb-sidenav-menu-heading">Core</div>
							<a class="nav-link" href="../../routes/dashpanel">
								<div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
								<span class="w-100">DashPanel</span>
								<span class="badge bg-primary">Main</span>
							</a>

							<?php include_once "sidenav-core.php"; ?>

						<div class="sb-sidenav-menu-heading">Your</div>
							<a class="nav-link" href="#">
								<div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
								<span class="w-100">Profile</span>
								<span class="badge bg-info">Info</span>
							</a>

							<a class="nav-link" href="../../routes/dashpanel">
								<div class="sb-nav-link-icon"><i class="fas fa-calendar-alt"></i></div>
								Calendar
							</a>

						<div class="sb-sidenav-menu-heading">Sub-System</div>
							<?php include_once "sidenav-subsys.php"; ?>

						<div class="sb-sidenav-menu-heading">Deptartment System</div>
							<?php include_once "sidenav-depsys.php"; ?>
					</div>
				</div>
				<div class="sb-sidenav-footer">
					<a href="#" class="text-decoration-none ms-3" title="Notification">
						<i class="fas fa-bell"></i>
						<span class="badge bg-warning rounded-circle position-relative" style="top: -8px; margin-left: -8px;">3</span>
					</a>
					<a href="#" title="Message" class="text-decoration-none ms-3">
						<i class="fa fa-envelope"></i>
						<span class="badge bg-success rounded-circle position-relative" style="top: -8px; margin-left: -8px;">7</span>
					</a>
					<a href="../../" title="Settings" class="text-decoration-none ms-3">
						<i class="fa fa-cog"></i>
					</a>
					<a href="" class="text-decoration-none ms-3" title="Refresh">
						<i class="fas fa-sync"></i>
					</a>
					<a href="../../routes/logout" class="text-decoration-none ms-3" title="Logout">
						<i class="fa fa-power-off"></i>
					</a>
				</div>
			</nav>
		</div>
		<div id="layoutSidenav_content">
			<main>
				<div class="container-fluid px-4 clearfix">
				<?php
					if ($page_title=="DashPanel") {

					} else {
				?>
					<a href="javascript: history.back()" class="float-end btn btn-sm btn-danger">Back</a>
				<?php
					}
				?>
					<h1 class="mt-4"><?php echo $page_title; ?></h1>
					<ol class="breadcrumb mb-4">
						<li class="breadcrumb-item active"><?php echo $breadcrumb; ?></li>
					</ol>
