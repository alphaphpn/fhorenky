<?php

	// Admin Logged
	if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
		echo '<script>
			alert("Please login.");
			window.open("../../routes/login","_self");
		</script>';
	} elseif ($_SESSION["ulevel"]==1) {

		$createnewx = isset($_GET['createnew']) ? $_GET['createnew'] : 0;
		$filteryear9 = isset($_GET['filteryear']) ? $_GET['filteryear'] : '';
		$filtermonth9 = isset($_GET['filtermonth']) ? $_GET['filtermonth'] : '';
		$biolocation9 = isset($_GET['biolocation']) ? $_GET['biolocation'] : '';
		$timelogtype9 = isset($_GET['timelog-type']) ? $_GET['timelog-type'] : '';

		if (isset($_GET['filteryear']) && isset($_GET['filtermonth']) && isset($_GET['biolocation']) && isset($_GET['timelogtype']) && isset($_GET['createnew'])) {
			
			if ($createnewx=1) {
				// Create DTR base on Employee's List
				$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
				$stmt_employeelist2 = $cnn->prepare("SELECT * FROM employee_tbl WHERE bio_location=:biolocation AND xdel=0 AND verified=1 ORDER BY bio_no ASC");
				$stmt_employeelist2->bindParam(':biolocation', $biolocation9);
				$stmt_employeelist2->execute();
				$nmbrempd2 = $stmt_employeelist2->rowCount();
				for($i=0; $row_employeelist2 = $stmt_employeelist2->fetch(); $i++) {
					$empid69 = trim($row_employeelist2['emp_id']);
					$profileid69 = trim($row_employeelist2['profileid']);
					$biolocation69 = trim($row_employeelist2['bio_location']);
					$biono69 = trim($row_employeelist2['bio_no']);
					$empname69 = trim($row_employeelist2['emp_name']);
					$officeid69 = trim($row_employeelist2['officeid']);
					$officecode69 = trim($row_employeelist2['officecode']);
					$officename69 = trim($row_employeelist2['officename']);
					$officetitle69 = trim($row_employeelist2['officetitle']);
					$officeabrv69 = trim($row_employeelist2['officeabrv']);
					$headofficer69 = trim($row_employeelist2['headofficer']);
					$headtitle69 = trim($row_employeelist2['headtitle']);
					$authhead69 = trim($row_employeelist2['auth_head']);
					$authtitle69 = trim($row_employeelist2['auth_title']);
					$authdescription69 = trim($row_employeelist2['auth_description']);
					$yearemployed69 = trim($row_employeelist2['year_employed']);
					$yearcalc69 = trim($row_employeelist2['year_calc']);
					$typeemployeeno69 = trim($row_employeelist2['type_employee_no']);
					$typeemployeeabrv69 = trim($row_employeelist2['type_employee_abrv']);
					$typeemployee69 = trim($row_employeelist2['type_employee']);

					$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
					$stmt_dtremployeelist2 = $cnn->prepare("SELECT * FROM employee_dtr_tbl WHERE bio_location=:biolocation AND yearno=:yearno AND monthno=:monthno AND bio_no=:biono");
					$stmt_dtremployeelist2->bindParam(':biolocation', $biolocation69);
					$stmt_dtremployeelist2->bindParam(':yearno', $filteryear9);
					$stmt_dtremployeelist2->bindParam(':monthno', $filtermonth9);
					$stmt_dtremployeelist2->bindParam(':biono', $biono69);
					$stmt_dtremployeelist2->execute();
					$existempnojj = $stmt_dtremployeelist2->rowCount();

					If ($existempnojj==0) {
						$stringno = substr(str_repeat(0, 2).$filtermonth9, - 2);
						$dtrcode = trim($filteryear9).trim($stringno).trim($biolocation69).trim("-").trim($biono69);
						$monthName = date('F', mktime(0, 0, 0, $filtermonth9));

						$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
						$qry_insert_dtr = "INSERT INTO employee_dtr_tbl SET 
							dtrcode=:dtrcode, 
							yearno=:yearno, 
							monthno=:monthno, 
							monthname=:monthname, 
							emp_id=:empid, 
							profileid=:profileid, 
							bio_location=:biolocation, 
							bio_no=:biono, 
							emp_name=:empname, 
							officeid=:officeid, 
							officecode=:officecode, 
							officename=:officename, 
							officetitle=:officetitle, 
							officeabrv=:officeabrv, 
							headofficer=:headofficer, 
							headtitle=:headtitle, 
							auth_head=:authhead, 
							auth_title=:authtitle, 
							auth_description=:authdescription
						";

						$stmt_insert_dtr = $cnn->prepare($qry_insert_dtr);

						$stmt_insert_dtr->bindParam(':dtrcode', $dtrcode);
						$stmt_insert_dtr->bindParam(':yearno', $filteryear9);
						$stmt_insert_dtr->bindParam(':monthno', $filtermonth9);
						$stmt_insert_dtr->bindParam(':monthname', $monthName);
						$stmt_insert_dtr->bindParam(':empid', $empid69);
						$stmt_insert_dtr->bindParam(':profileid', $profileid69);
						$stmt_insert_dtr->bindParam(':biolocation', $biolocation69);
						$stmt_insert_dtr->bindParam(':biono', $biono69);
						$stmt_insert_dtr->bindParam(':empname', $empname69);
						$stmt_insert_dtr->bindParam(':officeid', $officeid69);
						$stmt_insert_dtr->bindParam(':officecode', $officecode69);
						$stmt_insert_dtr->bindParam(':officename', $officename69);
						$stmt_insert_dtr->bindParam(':officetitle', $officetitle69);
						$stmt_insert_dtr->bindParam(':officeabrv', $officeabrv69);
						$stmt_insert_dtr->bindParam(':headofficer', $headofficer69);
						$stmt_insert_dtr->bindParam(':headtitle', $headtitle69);
						$stmt_insert_dtr->bindParam(':authhead', $authhead69);
						$stmt_insert_dtr->bindParam(':authtitle', $authtitle69);
						$stmt_insert_dtr->bindParam(':authdescription', $authdescription69);

						$stmt_insert_dtr->execute();

						$x = 1;
						while($x <= 31) {
							$getdateloop = trim($filteryear9)."-".trim(substr(str_repeat(0, 2).$filtermonth9, - 2))."-".trim(substr(str_repeat(0, 2).$x, - 2));
							$daynameloop = date('D', strtotime($getdateloop));
							$countstrday = strlen($daynameloop);

							$isDateValid = isValidDate($getdateloop);

							if ($isDateValid) {
								$daynamehjh = Trim($daynameloop);
							} else {
								$daynamehjh = Trim("n/a");
							}

							$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
							$qry_insert_subdtr = "INSERT INTO employee_subdtr_tbl SET 
								dtrcode=:dtrcode, 
								nameday=:nameday, 
								dayno=:dayno, 
								monthno=:monthno, 
								monthname=:monthname, 
								yearno=:yearno, 
								emp_id=:empid, 
								emp_name=:empname, 
								bio_location=:biolocation, 
								bio_no=:biono
							";
							$stmt_insert_subdtr = $cnn->prepare($qry_insert_subdtr);
							$stmt_insert_subdtr->bindParam(':dtrcode', $dtrcode);
							$stmt_insert_subdtr->bindParam(':nameday', $daynamehjh);
							$stmt_insert_subdtr->bindParam(':dayno', $x);
							$stmt_insert_subdtr->bindParam(':yearno', $filteryear9);
							$stmt_insert_subdtr->bindParam(':monthno', $filtermonth9);
							$stmt_insert_subdtr->bindParam(':monthname', $monthName);
							$stmt_insert_subdtr->bindParam(':empid', $empid69);
							$stmt_insert_subdtr->bindParam(':biolocation', $biolocation69);
							$stmt_insert_subdtr->bindParam(':biono', $biono69);
							$stmt_insert_subdtr->bindParam(':empname', $empname69);
							$stmt_insert_subdtr->execute();

							If ($timelogtype9="SINGLE") {

								// AM Time In
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
								$qry_timein = "SELECT * FROM employee_timelogs_single_tbl WHERE 
									YEAR(datelog)=:yearno AND 
									MONTH(datelog)=:monthno AND 
									DAY(datelog)=:dayno AND 
									bio_location=:biolocation AND 
									bio_no=:biono AND 
									timelog<TIME_FORMAT('11:59:00','%T') 
									ORDER BY TIME_FORMAT(timelog, '%H:%i') ASC 
									LIMIT 1
								";
								$stmt_timein = $cnn->prepare($qry_timein);
								$stmt_timein->bindParam(':yearno', $filteryear9);
								$stmt_timein->bindParam(':monthno', $filtermonth9);
								$stmt_timein->bindParam(':dayno', $x);
								$stmt_timein->bindParam(':biolocation', $biolocation69);
								$stmt_timein->bindParam(':biono', $biono69);
								$stmt_timein->execute();
								$cnt_timein = $stmt_timein->rowCount();

								If ($cnt_timein > 0) {
									foreach ($stmt_timein as $row_timein) {
										$amtimeinx = new DateTime($row_timein['timelog']);
										$rsltaminx = $amtimeinx->format('g:i');

										$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
										$qry_update_timein = "UPDATE employee_subdtr_tbl SET 
											amtimein=:amtimein 
											WHERE 
											dayno=:dayno AND 
											monthno=:monthno AND 
											yearno=:yearno AND 
											bio_location=:biolocation AND 
											bio_no=:biono
										";
										$stmt_update_timein = $cnn->prepare($qry_update_timein);
										$stmt_update_timein->bindParam(':amtimein', $rsltaminx);
										$stmt_update_timein->bindParam(':yearno', $filteryear9);
										$stmt_update_timein->bindParam(':monthno', $filtermonth9);
										$stmt_update_timein->bindParam(':dayno', $x);
										$stmt_update_timein->bindParam(':biolocation', $biolocation69);
										$stmt_update_timein->bindParam(':biono', $biono69);
										$stmt_update_timein->execute();
									}
								}

								// ----------------------------------------------------

								// AM Time Out
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
								$qry_timeout = "SELECT * FROM employee_timelogs_single_tbl WHERE 
									YEAR(datelog)=:yearno AND 
									MONTH(datelog)=:monthno AND 
									DAY(datelog)=:dayno AND 
									bio_location=:biolocation AND 
									bio_no=:biono AND 
									timelog<=TIME_FORMAT('12:30:00','%T') 
									ORDER BY TIME_FORMAT(timelog, '%H:%i') DESC 
									LIMIT 1
								";
								$stmt_timeout = $cnn->prepare($qry_timeout);
								$stmt_timeout->bindParam(':yearno', $filteryear9);
								$stmt_timeout->bindParam(':monthno', $filtermonth9);
								$stmt_timeout->bindParam(':dayno', $x);
								$stmt_timeout->bindParam(':biolocation', $biolocation69);
								$stmt_timeout->bindParam(':biono', $biono69);
								$stmt_timeout->execute();
								$cnt_timeout = $stmt_timeout->rowCount();

								If ($cnt_timeout > 0) {
									foreach ($stmt_timeout as $row_timeout) {
										$amtimeoutx = new DateTime($row_timeout['timelog']);
										$rsltamoutx = $amtimeoutx->format('g:i');

										if ($rsltamoutx==$rsltaminx) {
											$rsltamoutx=null;
										}

										$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
										$qry_update_timeout = "UPDATE employee_subdtr_tbl SET 
											amtimeout=:amtimeout 
											WHERE 
											dayno=:dayno AND 
											monthno=:monthno AND 
											yearno=:yearno AND 
											bio_location=:biolocation AND 
											bio_no=:biono
										";
										$stmt_update_timeout = $cnn->prepare($qry_update_timeout);
										$stmt_update_timeout->bindParam(':amtimeout', $rsltamoutx);
										$stmt_update_timeout->bindParam(':yearno', $filteryear9);
										$stmt_update_timeout->bindParam(':monthno', $filtermonth9);
										$stmt_update_timeout->bindParam(':dayno', $x);
										$stmt_update_timeout->bindParam(':biolocation', $biolocation69);
										$stmt_update_timeout->bindParam(':biono', $biono69);
										$stmt_update_timeout->execute();
									}
								}

								// ----------------------------------------------------

								// PM Time In
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
								$qry_timeinpm = "SELECT * FROM employee_timelogs_single_tbl WHERE 
									YEAR(datelog)=:yearno AND 
									MONTH(datelog)=:monthno AND 
									DAY(datelog)=:dayno AND 
									bio_location=:biolocation AND 
									bio_no=:biono AND 
									timelog>TIME_FORMAT('12:30:00','%T') 
									ORDER BY TIME_FORMAT(timelog, '%H:%i') ASC 
									LIMIT 1
								";
								$stmt_timeinpm = $cnn->prepare($qry_timeinpm);
								$stmt_timeinpm->bindParam(':yearno', $filteryear9);
								$stmt_timeinpm->bindParam(':monthno', $filtermonth9);
								$stmt_timeinpm->bindParam(':dayno', $x);
								$stmt_timeinpm->bindParam(':biolocation', $biolocation69);
								$stmt_timeinpm->bindParam(':biono', $biono69);
								$stmt_timeinpm->execute();
								$cnt_timeinpm = $stmt_timeinpm->rowCount();

								If ($cnt_timeinpm > 0) {
									foreach ($stmt_timeinpm as $row_timeinpm) {
										$pmtimeinx = new datetime($row_timeinpm['timelog']);
										$rsltpminx = $pmtimeinx->format('g:i');

										$validatetimeinpm = $pmtimeinx->format('Hi');
										$validatetimeinpmx = (int)$validatetimeinpm;

										if ($validatetimeinpmx <= 1659) {
											$rsltpminxx = $rsltpminx;
										} else {
											$rsltpminxx = null;
										}

										$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
										$qry_update_timeinpm = "UPDATE employee_subdtr_tbl SET 
											pmtimein=:pmtimein 
											WHERE 
											dayno=:dayno AND 
											monthno=:monthno AND 
											yearno=:yearno AND 
											bio_location=:biolocation AND 
											bio_no=:biono
										";
										$stmt_update_timeinpm = $cnn->prepare($qry_update_timeinpm);
										$stmt_update_timeinpm->bindParam(':pmtimein', $rsltpminxx);
										$stmt_update_timeinpm->bindParam(':yearno', $filteryear9);
										$stmt_update_timeinpm->bindParam(':monthno', $filtermonth9);
										$stmt_update_timeinpm->bindParam(':dayno', $x);
										$stmt_update_timeinpm->bindParam(':biolocation', $biolocation69);
										$stmt_update_timeinpm->bindParam(':biono', $biono69);
										$stmt_update_timeinpm->execute();
									}
								}

								// ----------------------------------------------------

								// PM Time Out
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
								$qry_timeoutpm = "SELECT * FROM employee_timelogs_single_tbl WHERE 
									YEAR(datelog)=:yearno AND 
									MONTH(datelog)=:monthno AND 
									DAY(datelog)=:dayno AND 
									bio_location=:biolocation AND 
									bio_no=:biono AND 
									timelog>TIME_FORMAT('12:30:00','%T') 
									ORDER BY TIME_FORMAT(timelog, '%H:%i') DESC 
									LIMIT 1
								";
								$stmt_timeoutpm = $cnn->prepare($qry_timeoutpm);
								$stmt_timeoutpm->bindParam(':yearno', $filteryear9);
								$stmt_timeoutpm->bindParam(':monthno', $filtermonth9);
								$stmt_timeoutpm->bindParam(':dayno', $x);
								$stmt_timeoutpm->bindParam(':biolocation', $biolocation69);
								$stmt_timeoutpm->bindParam(':biono', $biono69);
								$stmt_timeoutpm->execute();
								$cnt_timeoutpm = $stmt_timeoutpm->rowCount();

								If ($cnt_timeoutpm > 0) {
									foreach ($stmt_timeoutpm as $row_timeoutpm) {
										$pmtimeoutx = new DateTime($row_timeoutpm['timelog']);
										$rsltpmoutx = $pmtimeoutx->format('g:i');

										if ($rsltpmoutx==$rsltpminx) {
											$rsltpmoutx=null;
										}

										$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
										$qry_update_timeoutpm = "UPDATE employee_subdtr_tbl SET 
											pmtimeout=:pmtimeout 
											WHERE 
											dayno=:dayno AND 
											monthno=:monthno AND 
											yearno=:yearno AND 
											bio_location=:biolocation AND 
											bio_no=:biono
										";
										$stmt_update_timeoutpm = $cnn->prepare($qry_update_timeoutpm);
										$stmt_update_timeoutpm->bindParam(':pmtimeout', $rsltpmoutx);
										$stmt_update_timeoutpm->bindParam(':yearno', $filteryear9);
										$stmt_update_timeoutpm->bindParam(':monthno', $filtermonth9);
										$stmt_update_timeoutpm->bindParam(':dayno', $x);
										$stmt_update_timeoutpm->bindParam(':biolocation', $biolocation69);
										$stmt_update_timeoutpm->bindParam(':biono', $biono69);
										$stmt_update_timeoutpm->execute();
									}
								}

								// ----------------------------------------------------
							}

							$x++;
						}
					}
				}
			}
		}

	} elseif ($_SESSION["ustat"]==0) {
		// Account Disabled.
		echo '<script>alert("Your Account has been Disabled!");window.open("../../routes/login","_self");</script>';
	} elseif ($_SESSION["verified"]==0) {
		// Account not verified.
		echo '<script>alert("Your Account needs to be Verified!");window.open("../../routes/login","_self");</script>';
	} elseif ($_SESSION["xdel"]==1) {
		// Account deleted.
		echo '<script>alert("Your Account has been Deleted!");window.open("../../routes/login","_self");</script>';
	} else {
		// Access denied! Authorized person only.
		echo '<script>alert("Access denied! Only Admin Account is Authorized.");window.open("../../routes/login","_self");</script>';
	}

	$month2print = date('n') - 1

?>

	<section id="dtrbiolocation">
		<div class="container-fluid my-3">
			<div class="card vh-92">
				<div class="card-header">
					<div class="d-flex justify-content-between">
						<label>
							Daily Time Record: Employee <br>
							per Biometric Location
						</label>
						<div>
							<a href="../../routes/dtr-biolocation" class="btn btn-primary m-1">Reload</a>
							<a href="../../" class="btn btn-info m-1">Home</a>
							<a href="../../routes/logout" class="btn btn-dark m-1">Logout</a>
						</div>
					</div>
				</div>
				<div class="card-body scrollable">
					<div>
						<form id="filter-employee" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
							<div class="row mb-2 rounded border bg-light">
								<div class="col my-2">
									<label class="form-label">* Year</label>
									<input id="filter-year" type="number" min="2023" max="<?php echo $yeartoday; ?>" class="form-control" placeholder="* Year" name="filter-year" value="<?php echo $yeartoday; ?>" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
								<div class="col my-2">
									<label class="form-label">* Month</label>
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
								<div class="col my-2">
									<label class="form-label">* Biometric Location</label>
									<input list="biolocationlists" id="bio-location" name="bio-location" class="form-control" placeholder="* Bio Location" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>

									<datalist id="biolocationlists">
										<option disabled selected value> -- select an option -- </option>
									<?php
										$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
										$stmt_biolocationlists = $cnn->prepare("SELECT * FROM bio_location_tbl");
										$stmt_biolocationlists->execute();
										$result_biolocationlists = $stmt_biolocationlists->setFetchMode(PDO::FETCH_ASSOC);
										foreach ($stmt_biolocationlists as $row_biolocationlists) {
											echo "<option value='".$row_biolocationlists['bio_location']."' data-timelogtype='".$row_biolocationlists['timelogs_type']."'>";
										}
									?>
									</datalist>
								</div>
								<div class="col my-2">
									<label class="form-label">* Timelog Type</label>
									<input id="timelog-type" name="timelog-type" type="text" class="form-control" placeholder="Timelog Type" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
								<div class="col my-2">
									<label>View Employee(s)</label>
									<button id="btnFilter" type="submit" class="btn btn-danger w-100" name="btnFilter">Filter</button>
								</div>
							</div>
						</form>
					</div>

					<div class="row">
						<div class="col">
							<label>Employee(s)</label>
							<div style="height: 20vw; overflow: scroll;">
								<table class="table table-striped table-hover">
									<thead class="table-info">
										<tr>
											<th>No.</th>
											<th>Bio#</th>
											<th>Employee</th>
											<th>BioL</th>
											<th>EmpID</th>
											<th>Office</th>
											<th>Signatory</th>
											<th>Authorize</th>
											<th>Emp-Type</th>
											<th>Emp#</th>
										</tr>
									</thead>
									<tbody>
										<?php
											try {
												if (isset($_POST['btnFilter'])) {
													if (empty($_POST['bio-location'])) {
														echo '<div class="alert alert-danger alert-dismissible fade show">';
															echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
															echo 'Invalid Bio Location!';
														echo '</div>';
													} elseif (empty($_POST['timelog-type'])) {
														echo '<div class="alert alert-danger alert-dismissible fade show">';
															echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
															echo 'Invalid Timelog Type!';
														echo '</div>';
													} else {
														$biolocation = trim($_POST['bio-location']);
														$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
														$stmt_employeelist = $cnn->prepare("SELECT * FROM employee_tbl WHERE bio_location=:biolocation AND xdel=0 AND verified=1 ORDER BY bio_no ASC");
														$stmt_employeelist->bindParam(':biolocation', $biolocation);
														$stmt_employeelist->execute();
														$nmbremp = $stmt_employeelist->rowCount();

														if ($nmbremp > 0) {
															$xno_employeelist = 0;

															for($i=0; $row_employeelist = $stmt_employeelist->fetch(); $i++) {
																$xno_employeelist++;
																$xbiono = trim($row_employeelist['bio_no']);
																$xemploy = trim($row_employeelist['emp_name']);
																$xbioloc = trim($row_employeelist['bio_location']);
																$xempid = trim($row_employeelist['emp_id']);
																$xoffce = trim($row_employeelist['officename']);
																$xsignat = trim($row_employeelist['headofficer']);
																$xautho = trim($row_employeelist['auth_head']);
																$xemptyp = trim($row_employeelist['type_employee_abrv']);
																$xempnom = trim($row_employeelist['emp_no']);

																?>
																	<tr>
																		<td><?php echo trim($xno_employeelist); ?></td>
																		<td><?php echo trim($xbiono); ?></td>
																		<td><?php echo utf8_encode(trim($xemploy)); ?></td>
																		<td><?php echo trim($xbioloc); ?></td>
																		<td><?php echo trim($xempid); ?></td>
																		<td><?php echo trim($xoffce); ?></td>
																		<td><?php echo utf8_encode(trim($xsignat)); ?></td>
																		<td><?php echo utf8_encode(trim($xautho)); ?></td>
																		<td><?php echo trim($xemptyp); ?></td>
																		<td><?php echo trim($xempnom); ?></td>
																	</tr>
																<?php
															}
														} else {
															echo '<tr>';
																echo '<td colspan="9">No Record of Employee.</td>';
															echo '</tr>';
														}
													}
												}
											} catch (PDOException $error) {
												$err_msg = $error->getMessage();
												echo "<p>Error: {$err_msg}</p>";
												die;
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<hr>

					<div class="row">
						<div class="col">
							<label>DTR for Employee</label>
							<div style="height: 20vw; overflow: scroll;">
								<table class="table table-dark table-striped table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Bio#</th>
											<th>Employee</th>
											<th>Office</th>
											<th>Signatory</th>
											<th>Authorize</th>
											<th>BioL</th>
											<th>MNo</th>
											<th>Month</th>
											<th>Year</th>
											<th>EmpID</th>
											<th>DTR-Code</th>
											<th>DTR-ID</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
											try {
												if (isset($_POST['btnFilter'])) {
													$yearnox = trim($_POST['filter-year']);
													$monthnox = trim($_POST['filter-month']);

													if (empty($_POST['filter-year']) || $_POST['filter-year']=0) {
														echo '<div class="alert alert-danger alert-dismissible fade show">';
															echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
															echo 'Invalid Year!';
														echo '</div>';
													} elseif (empty($_POST['filter-month']) || $_POST['filter-month']=0) {
														echo '<div class="alert alert-danger alert-dismissible fade show">';
															echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
															echo 'Invalid Month!';
														echo '</div>';
													} elseif (empty($_POST['bio-location'])) {
														echo '<div class="alert alert-danger alert-dismissible fade show">';
															echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
															echo 'Invalid Bio Location!';
														echo '</div>';
													} elseif (empty($_POST['timelog-type'])) {
														echo '<div class="alert alert-danger alert-dismissible fade show">';
															echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
															echo 'Invalid Timelog Type!';
														echo '</div>';
													} else {
														$biolocation2 = trim($_POST['bio-location']);
														$timelogtypex = trim($_POST['timelog-type']);
														
														$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
														$stmt_dtremployeelist = $cnn->prepare("SELECT * FROM employee_dtr_tbl WHERE bio_location=:biolocation AND yearno=:yearno AND monthno=:monthno ORDER BY bio_no ASC");
														$stmt_dtremployeelist->bindParam(':yearno', $yearnox);
														$stmt_dtremployeelist->bindParam(':monthno', $monthnox);
														$stmt_dtremployeelist->bindParam(':biolocation', $biolocation2);
														$stmt_dtremployeelist->execute();
														$nmbrempdtr = $stmt_dtremployeelist->rowCount();

														if ($nmbrempdtr > 0) {
															$xno_dtremployeelist = 0;

															for($i=0; $row_dtremployeelist = $stmt_dtremployeelist->fetch(); $i++) {
																$xno_dtremployeelist++;
																$xbiono2 = trim($row_dtremployeelist['bio_no']);
																$xemploy2 = trim($row_dtremployeelist['emp_name']);
																$xoffce2 = trim($row_dtremployeelist['officename']);
																$xsignat2 = trim($row_dtremployeelist['headofficer']);
																$xautho2 = trim($row_dtremployeelist['auth_head']);
																$xbioloc2 = trim($row_dtremployeelist['bio_location']);
																$xmonthno2 = trim($row_dtremployeelist['monthno']);
																$xmonthname2 = trim($row_dtremployeelist['monthname']);
																$xyrno2 = trim($row_dtremployeelist['yearno']);
																$xempid2 = trim($row_dtremployeelist['emp_id']);
																$xdtrcode2 = trim($row_dtremployeelist['dtrcode']);
																$xdtrid2 = trim($row_dtremployeelist['dtrid']);

																?>
																	<tr>
																		<td><?php echo trim($xno_dtremployeelist); ?></td>
																		<td><?php echo trim($xbiono2); ?></td>
																		<td><?php echo trim(utf8_encode($xemploy2)); ?></td>
																		<td><?php echo trim($xoffce2); ?></td>
																		<td><?php echo trim(utf8_encode($xsignat2)); ?></td>
																		<td><?php echo trim(utf8_encode($xautho2)); ?></td>
																		<td><?php echo trim($xbioloc2); ?></td>
																		<td><?php echo trim($xmonthno2); ?></td>
																		<td><?php echo trim($xmonthname2); ?></td>
																		<td><?php echo trim($xyrno2); ?></td>
																		<td><?php echo trim($xempid2); ?></td>
																		<td><?php echo trim($xdtrcode2); ?></td>
																		<td><?php echo trim($xdtrid2); ?></td>
																		<td>Button</td>
																	</tr>
																<?php
															}
														} else {
															echo '<tr>';
																echo '<td colspan="14">';
																	echo '<div class="alert alert-danger alert-dismissible fade show">';
																		echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
																		echo 'No DTR Record of Employee for the Selected Year/Month. <br>';
																		echo 'Would you like to Generate their DTR? <a href="../../routes/dtr-biolocation/?createnew=1&filteryear='.$yearnox.'&filtermonth='.$monthnox.'&biolocation='.$biolocation2.'&timelogtype='.$timelogtypex.'" target="_blank">Yes</a>';
																	echo '</div>';
																echo '</td>';
															echo '</tr>';
														}
													}
												}
											} catch (PDOException $error) {
												$err_msg = $error->getMessage();
												echo "<p>Error: {$err_msg}</p>";
												die;
											}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer">
					<div class="w-100 d-flex flex-wrap justify-content-end">
						<a href="#" class="btn btn-success m-2">Button</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script>
		let biolocation = document.querySelector("#bio-location");
		let timelogtype = document.querySelector("#timelog-type");
		biolocation.addEventListener('change', async function() {
			var	biolocval = biolocation.value;

			timelogtype.value = document.querySelector('option[value="' + biolocval + '"]').dataset.timelogtype;
		});
	</script>