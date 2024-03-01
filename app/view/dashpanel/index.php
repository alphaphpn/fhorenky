<?php

	$xdeltime = 0;

	// AO Account Logged
	if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
		echo '<script>alert("Access denied!");window.open("../../routes/login","_self");</script>';
		// header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["ulevel"]==1) {
		// Super Admin
		$xdeltime = 1;

		
	} elseif ($_SESSION["ulevel"]==20) {
		// Head Officer
		$xdeltime = 1;

	
	} elseif ($_SESSION["ulevel"]==21) {
		// Assistant Officer



	} elseif ($_SESSION["ulevel"]==13 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {
		// Assisstant Officer
		
	} elseif ($_SESSION["ustat"]==0) {
		// Account Disabled.
		echo '<script>alert("Your Account has been Disabled!");window.open("../../routes/login","_self");</script>';
		// header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["verified"]==0) {
		// Account not verified.
		echo '<script>alert("Your Account needs to be Verified!");window.open("../../routes/login","_self");</script>';
		// header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["xdel"]==1) {
		// Account deleted.
		echo '<script>alert("Your Account has been Deleted!");window.open("../../routes/login","_self");</script>';
		// header("Location: ../../routes/login");
		exit;
	} else {
		// Access denied! Authorized person only.
		echo '<script>alert("Access denied! Only Authorized account is allowed.");</script>';
		// header("Location: ../../routes/login");
		exit;
	}

?>
					<!-- Start here -->
					<div class="row">
						<div class="col-xl-3 col-md-6">
							<div class="card bg-primary text-white mb-4">
								<div class="card-header">User(s)</div>
								<div id="accordionUser" class="card-body">
									<div id="collapsUsers" class="collapse" data-bs-parent="#accordionUser">
										<div class="d-flex flex-column">
											<div class="d-flex"><span class="w-100">Profile</span> <span class="text-end">1,399</span></div>
											<label>Employee</label>
											<label>Subscriber</label>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link text-decoration-none" data-bs-toggle="collapse" href="#collapsUsers">View Details</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6">
							<div class="card bg-warning text-white mb-4">
								<div class="card-header">Attendance Log</div>
								<div id="accordionAttendanceLog" class="card-body">
									<div id="collapsAttendanceLog" class="collapse" data-bs-parent="#accordionAttendanceLog">
										<div class="d-flex flex-column">
											<div class="d-flex"><span class="w-100">Time-in</span> <span class="text-end">1,399</span></div>
											<label>Time-out</label>
											<label>Online</label>
											<label>Off-line</label>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link text-decoration-none" data-bs-toggle="collapse" href="#collapsAttendanceLog">View Details</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6">
							<div class="card bg-success text-white mb-4">
								<div class="card-header">Document(s)</div>
								<div id="accordionDocument" class="card-body">
									<div id="collapsDocuments" class="collapse" data-bs-parent="#accordionDocument">
										<div class="d-flex flex-column">
											<div class="d-flex"><span class="w-100">Incoming</span> <span class="text-end">1,399</span></div>
											<div class="d-flex"><span class="w-100">Outgoing</span> <span class="text-end">956</span></div>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link text-decoration-none" data-bs-toggle="collapse" href="#collapsDocuments">View Details</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>

						<div class="col-xl-3 col-md-6">
							<div class="card bg-danger text-white mb-4">
								<div class="card-header">Visitor(s)</div>
								<div id="accordionVisitor" class="card-body">
									<div id="collapsVisitors" class="collapse" data-bs-parent="#accordionVisitor">
										<div class="d-flex flex-column">
											<div class="d-flex"><span class="w-100">Page</span> <span class="text-end">1,399</span></div>
											<div class="d-flex"><span class="w-100">Onsite</span> <span class="text-end">956</span></div>
										</div>
									</div>
								</div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small text-white stretched-link text-decoration-none" data-bs-toggle="collapse" href="#collapsVisitors">View Details</a>
									<div class="small text-white"><i class="fas fa-angle-right"></i></div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">
									<i class="fas fa-chart-area me-1"></i>
									Budget
								</div>
								<div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
							</div>
						</div>
						<div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">
									<i class="fas fa-chart-bar me-1"></i>
									Economic Development
								</div>
								<div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">
									<i class="fas fa-chart-pie me-1"></i>
									Healthcare
								</div>
								<div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
								<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
							</div>
						</div>

						<div class="col-xl-6">
							<div class="card mb-4">
								<div class="card-header">
									<i class="fas fa-map-marker-alt me-1"></i>
									Geo Location
								</div>
								<div class="card-body">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d506202.71227045363!2d122.33167643178949!3d7.60664575970027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x325167c995d173cf%3A0x882179440cf9e96d!2sZamboanga%20Sibugay!5e0!3m2!1sen!2sph!4v1708420113110!5m2!1sen!2sph" width="100%" height="380" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								</div>
								<div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
							</div>
						</div>
					</div>