<?php

	$xdeltime = 0;
	$month2print = date('n') - 1;
	$officecode = $_SESSION["officeid"];

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
					<div class="row py-5">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="card">
								<form id="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
									<div class="card-header">
										<h5>Office ID: <?php echo $_SESSION["officeid"]; ?></h5>
										<h6>Office: <?php echo $_SESSION["officeabvr"]; ?></h6>
									</div>
									<div class="card-body">
										<div class="input-group mb-3 input-group-lg">
											<span class="input-group-text">Year</span>
											<input id="filter-year" type="number" min="2023" max="<?php echo $yeartoday; ?>" class="form-control" placeholder="* Year" name="filter-year" value="<?php echo $yeartoday; ?>" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>

										<div class="input-group mb-3 input-group-lg">
											<span class="input-group-text">Month</span>
											<select id="filter-month" class="form-select form-control" placeholder="* Month" name="filter-month" required>
												<option disabled value> -- select an option -- </option>
												<option value="1" data-value="January" <?php if ($month2print==1) echo 'selected'; ?>>January</option>
												<option value="2" data-value="February" <?php if ($month2print==2) echo 'selected'; ?>>February</option>
												<option value="3" data-value="March" <?php if ($month2print==3) echo 'selected'; ?>>March</option>
												<option value="4" data-value="April" <?php if ($month2print==4) echo 'selected'; ?>>April</option>
												<option value="5" data-value="May" <?php if ($month2print==5) echo 'selected'; ?>>May</option>
												<option value="6" data-value="June" <?php if ($month2print==6) echo 'selected'; ?>>June</option>
												<option value="7" data-value="July" <?php if ($month2print==7) echo 'selected'; ?>>July</option>
												<option value="8" data-value="August" <?php if ($month2print==8) echo 'selected'; ?>>August</option>
												<option value="9" data-value="September" <?php if ($month2print==9) echo 'selected'; ?>>September</option>
												<option value="10" data-value="October" <?php if ($month2print==10) echo 'selected'; ?>>October</option>
												<option value="11" data-value="November" <?php if ($month2print==11) echo 'selected'; ?>>November</option>
												<option value="12" data-value="December" <?php if ($month2print==12) echo 'selected'; ?>>December</option>
											</select>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>

										<div>
										<?php
											try {
												$yrno = isset($_POST['filter-year']) ? $_POST['filter-year'] : '';
												$monthno = isset($_POST['filter-month']) ? $_POST['filter-month'] : '';

												if (isset($_POST['btnDtrSubmit'])) {
													echo '<script>window.open("../../routes/dtr-employee/?yrno='.$yrno.'&monthno='.$monthno.'","_self");</script>';
												}
											} catch (PDOException $error) {
												$err_msg = $error->getMessage();
												echo "<p>Error: {$err_msg}</p>";
												die;
											}
										?>
										</div>
									</div>
									<div class="card-footer text-end">
										<button id="btnDtrSubmit" name="btnDtrSubmit" type="submit" class="btn btn-danger">Filter</button>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-4"></div>
					</div>
