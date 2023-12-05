	<section id="section-navbar" class="sticky-top">
		<nav id="navbar" class="navbar navbar-expand-sm navbar-dark bg-dark">
			<div class="container-fluid">
				<a class="navbar-brand" href="javascript:void(0)">
					<img id="main-logo" src="<?php echo $domainhome.'/public/'.$navbarlogo; ?>">
				</a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="mynavbar">
					<ul class="navbar-nav w-100">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo $domainhome; ?>">Home</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)">Executive</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)">Legislative</a>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0)">Transparency</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/dtr-emp">DTR</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)">About</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)">Contact</a>
						</li>

						<li class="nav-item ms-auto">
							<form class="d-flex">
								<input class="form-control me-2" type="text" placeholder="Search">
								<button class="btn btn-primary" type="button">Search</button>
							</form>
						</li>

					<?php
						// Admin Logged
						if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
					?>
						<li class="nav-item">
							<a class="nav-link" href="javascript:void(0)">Sign Up</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="routes/login">Login</a>
						</li>
					<?php
						} elseif ($_SESSION["ulevel"]==1) {
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Menu</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/dtr-biolocation/">DTR Generator</a></li>
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/sign-up-employee/">Add Employee</a></li>
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/update-employee/">Update Employee</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="<?php echo $domainhome; ?>/routes/logout">Logout</a>
						</li>
					<?php
						} elseif ($_SESSION["ulevel"]==13 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Menu</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/dtr-emp">DTR</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="<?php echo $domainhome; ?>/routes/logout">Logout</a>
						</li>
					<?php
						} elseif ($_SESSION["ulevel"]==15 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Menu</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/dtr-emp">DTR</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="<?php echo $domainhome; ?>/routes/logout">Logout</a>
						</li>
					<?php
						} elseif ($_SESSION["ulevel"]==14 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Menu</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="<?php echo $domainhome; ?>/routes/brgy-elec-result">BRGY ELEC</a></li>
							</ul>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="<?php echo $domainhome; ?>/routes/logout">Logout</a>
						</li>
					<?php
						} elseif ($_SESSION["ustat"]==0) {
							// Account Disabled.
							echo '<script>alert("Your Account has been Disabled!");window.open("routes/login","_self");</script>';
						} elseif ($_SESSION["verified"]==0) {
							// Account not verified.
							echo '<script>alert("Your Account needs to be Verified!");window.open("routes/login","_self");</script>';
						} elseif ($_SESSION["xdel"]==1) {
							// Account deleted.
							echo '<script>alert("Your Account has been Deleted!");window.open("routes/login","_self");</script>';
						} else {
							// Access denied! Authorized person only.
							echo '<script>alert("Access denied! Only Admin Account is Authorized.");window.open("routes/login","_self");</script>';
						}
					?>
					</ul>
				</div>
			</div>
		</nav>
	</section>