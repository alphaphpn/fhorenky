<?php

	// AO Account Logged
	if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
		// echo '<script>alert("Access denied!");window.open("../../routes/login","_self");</script>';
		header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["ulevel"]==1) {

	} elseif ($_SESSION["ulevel"]==13 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {
		
	} elseif ($_SESSION["ustat"]==0) {
		// Account Disabled.
		// echo '<script>alert("Your Account has been Disabled!");window.open("../../routes/login","_self");</script>';
		header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["verified"]==0) {
		// Account not verified.
		// echo '<script>alert("Your Account needs to be Verified!");window.open("../../routes/login","_self");</script>';
		header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["xdel"]==1) {
		// Account deleted.
		// echo '<script>alert("Your Account has been Deleted!");window.open("../../routes/login","_self");</script>';
		header("Location: ../../routes/login");
		exit;
	} else {
		// Access denied! Authorized person only.
		// echo '<script>alert("Access denied! Only Authorized account is allowed.");</script>';
		header("Location: ../../routes/login");
		exit;
	}

	$time_pattern = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/';
	$word_pattern = '/^[A-Za-z]+$/';
	
	$yrno = isset($_GET['yrno']) ? $_GET['yrno'] : '';
	$monthno = isset($_GET['monthno']) ? $_GET['monthno'] : '';
	$biolocation = isset($_GET['biolocation']) ? $_GET['biolocation'] : '';
	$biono = isset($_GET['biono']) ? $_GET['biono'] : '';

	if (isset($_GET['yrno']) && isset($_GET['monthno']) && isset($_GET['biolocation']) && isset($_GET['biono'])) {

		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
		$stmt_empdtr = $cnn->prepare("SELECT * FROM employee_dtr_tbl WHERE 
			yearno=:yrno AND 
			monthno=:monthno AND 
			bio_location=:biolocation AND 
			bio_no=:biono 
			LIMIT 1");
		$stmt_empdtr->bindParam(':yrno', $yrno);
		$stmt_empdtr->bindParam(':monthno', $monthno);
		$stmt_empdtr->bindParam(':biolocation', $biolocation);
		$stmt_empdtr->bindParam(':biono', $biono);
		$stmt_empdtr->execute();
		$nmbrdtremp = $stmt_empdtr->rowCount();

		if ($nmbrdtremp>0) {
			for($i=0; $row_empdtr = $stmt_empdtr->fetch(); $i++) {
				$dtrcodek = $row_empdtr['dtrcode'];
				$yearnok = $row_empdtr['yearno'];
				$monthnamek = $row_empdtr['monthname'];
				$monthnok = $row_empdtr['monthno'];
				$biolocationk = $row_empdtr['bio_location'];
				$bionok = $row_empdtr['bio_no'];
				$empnamek = utf8_encode($row_empdtr['emp_name']);
				$officeabrvk = $row_empdtr['officeabrv'];
				$headofficerk = $row_empdtr['headofficer'];
				$headtitlek = $row_empdtr['headtitle'];
				$utlatehr = $row_empdtr['utlate_hr'];
				$utlatemin = $row_empdtr['utlate_min'];
				$othr = $row_empdtr['ot_hr'];
				$otmin = $row_empdtr['ot_min'];

				$xlinkzk = "../../routes/dtr-print/?yrno=".$yearnok."&monthno=".$monthnok."&biolocation=".$biolocationk."&biono=".$bionok;
			}
		}
	} else {
		// echo '<script>alert("Access Denied!");window.open("//sibugay.gov.ph","_self");</script>';
		$dtrcodek = "";
		$yearnok = "";
		$monthnamek = "";
		$biolocationk = "";
		$bionok = "";
		$empnamek = "";
		$officeabrvk = "";
		$headofficerk = "";
		$headtitlek = "";
	}
?>

	<section>
		<div class="container py-3">
			<form>
				<div class="card vh-92">
					<div class="card-header">
						<div class="text-end">
							<a class="btn btn-info btn-sm" href="">Refresh</a>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">BioTag:</span>
									<input type="text" class="form-control" placeholder="Biometric Location" value="<?php echo trim($biolocationk); ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group my-1">
									<div class="input-group">
										<span class="input-group-text">Bio#:</span>
										<input type="number" class="form-control" placeholder="Biometric No." value="<?php echo intval(trim($bionok)); ?>" readonly>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">Office:</span>
									<input type="text" class="form-control" placeholder="Office" value="<?php echo trim($officeabrvk); ?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">DTR ID:</span>
									<input type="text" class="form-control" placeholder="DTR ID" value="<?php echo trim($dtrcodek); ?>" readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">For the Month of:</span>
									<input type="text" class="form-control" placeholder="For the Month" value="<?php echo trim($monthnamek)." ".trim($yearnok); ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">Employee:</span>
									<input type="text" class="form-control" placeholder="Employee" value="<?php echo trim(utf8_decode($empnamek)); ?>">
								</div>
							</div>
						</div>
					</div>

					<div class="card-body scrollable">
						<table class="table table-striped table-hover" border="2">
							<thead>
								<tr align="center">
									<th rowspan="2" class="p-0 align-middle border-end">DTR No.</th>
									<th rowspan="2" class="p-0 align-middle border-end">Day</th>
									<th colspan="2" class="p-0 border-end">AM</th>
									<th colspan="2" class="p-0 border-end">PM</th>
									<th colspan="2" class="p-0 border-end">U.Time/Late</th>
									<th colspan="2" class="p-0">OT</th>
								</tr>
								<tr align="center">
									<th class="p-0 border-end">Arrival</th>
									<th class="p-0 border-end">Departure</th>
									<th class="p-0 border-end">Arrival</th>
									<th class="p-0 border-end">Departure</th>
									<th class="p-0 border-end">Hour</th>
									<th class="p-0 border-end">Min</th>
									<th class="p-0 border-end">Hour</th>
									<th class="p-0">Min</th>
								</tr>
							</thead>

							<tbody>
								<?php
									$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$stmt_timelogz = $cnn->prepare("SELECT * FROM employee_subdtr_tbl WHERE 
										dtrcode=:dtrcode 
										LIMIT 31");
									$stmt_timelogz->bindParam(':dtrcode', $dtrcodek);
									$stmt_timelogz->execute();
									$nmbrtimelogz = $stmt_timelogz->rowCount();

									if ($nmbrtimelogz>0) {
										for($i=0; $row_timelogz = $stmt_timelogz->fetch(); $i++) {
											$subdtrid = $row_timelogz['subdtrid'];
											$daynohh = $row_timelogz['dayno'];
											$namedayhh = $row_timelogz['nameday'];
											$amtimeinhh = $row_timelogz['amtimein'];

											if (preg_match($time_pattern, $amtimeinhh)) {
												$amtimeinxhjkd = new DateTime($amtimeinhh);
												$amtimeinhhxf = $amtimeinxhjkd->format('gi');
												if ($amtimeinhhxf>800) {
													$xcolord = "#ff0000";
												} else {
													$xcolord = "#000000";
												}
											}

											$amtimeouthh = $row_timelogz['amtimeout'];

											if (preg_match($time_pattern, $amtimeouthh)) {
												$amtimeouthjkd = new DateTime($amtimeouthh);
												$amtimeouthhxf = $amtimeouthjkd->format('gi');
												if ($amtimeouthhxf<1159) {
													$xcolordc = "#ff0000";
												} else {
													$xcolordc = "#000000";
												}
											}

											$pmtimeinhh = $row_timelogz['pmtimein'];

											if (preg_match($time_pattern, $amtimeouthh)) {
												$pmtimeinhjkd = new DateTime($pmtimeinhh);
												$earlyEveningEnd = new DateTime('4:59');
												$lateEveningEnd = new DateTime('1:00');
												$pmtimeinhhxf = $pmtimeinhjkd->format('gi');
												if ($pmtimeinhjkd <= $earlyEveningEnd) {
													if ($pmtimeinhjkd==$lateEveningEnd) {
														$xcolorda = "#000000";
													} else {
														$xcolorda = "#ff0000";
													}
												} else {
													$xcolorda = "#000000";
												}
											}

											$pmtimeouthh = $row_timelogz['pmtimeout'];

											if (preg_match($time_pattern, $amtimeouthh)) {
												$pmtimeouthjkd = new DateTime($pmtimeouthh);
												$pmtimeouthhxf = $pmtimeouthjkd->format('gi');
												if ($pmtimeouthhxf<459) {
													$xcolordb = "#ff0000";
												} else {
													$xcolordb = "#000000";
												}
											}

											$xdatenowxf = $namedayhh.', '.$monthnamek.' '.$daynohh.', '.$yearnok;

											$lateutimehour = $row_timelogz['lateutime_hour'];
											$lateutimemin = $row_timelogz['lateutime_min'];
											$overtimehour = $row_timelogz['overtime_hour'];
											$overtimemin = $row_timelogz['overtime_min'];

											?>
												<tr>
													<td class="p-0 ps-2 border-end"><?php echo trim($subdtrid); ?></td>
													<?php
														if ($namedayhh=='n/a') {
													?>
															<td colspan="9" class="p-0 text-center txt-bg-f2f2f2">NOT APPLICABLE</td>
													<?php
														} else {
													?>
															<td class="p-0 ps-2 border-end"><b><?php echo trim($daynohh); ?></b> <?php echo trim($namedayhh); ?></td>
													<?php
															if ($amtimeinhh=="ON LEAVE" || $amtimeinhh=="OB" || $amtimeinhh=="OB") {
															?>
																<td colspan="8" class="p-0 text-center border-end txt-bg-f2f2f2"><?php echo trim($amtimeinhh); ?></td>
															<?php
														} else {
															?>
																<td class="p-0 text-center border-end" style="color: <?php echo $xcolord; ?>;">
																	<?php 
																		if (empty($amtimeinhh)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="amtimein" data-xlabel="AM In" data-xdate="'.$xdatenowxf.'" data-type="text" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($amtimeinhh);
																		}
																	?>
																</td>
																<td class="p-0 text-center border-end" style="color: <?php echo $xcolordc; ?>;">
																	<?php 
																		if (empty($amtimeouthh)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="amtimeout" data-xlabel="AM Out" data-xdate="'.$xdatenowxf.'" data-type="text" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($amtimeouthh);
																		}
																	?>
																</td>
																<td class="p-0 text-center border-end" style="color: <?php echo $xcolorda; ?>;">
																	<?php 
																		if (empty($pmtimeinhh)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="pmtimein" data-xlabel="PM In" data-xdate="'.$xdatenowxf.'" data-type="text" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($pmtimeinhh);
																		}
																	?>
																</td>
																<td class="p-0 text-center border-end" style="color: <?php echo $xcolordb; ?>;">
																	<?php 
																		if (empty($pmtimeouthh)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="pmtimeout" data-xlabel="PM Out" data-xdate="'.$xdatenowxf.'" data-type="text" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($pmtimeouthh);
																		}
																	?>
																</td>
																<td class="p-0 text-center border-end">
																	<?php 
																		if (empty($lateutimehour)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="lateutime_hour" data-xlabel="Undertime / Late - Hour" data-xdate="'.$xdatenowxf.'" data-type="number" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($lateutimehour);
																		}
																	?>
																</td>
																<td class="p-0 text-center border-end">
																	<?php 
																		if (empty($lateutimemin)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="lateutime_min" data-xlabel="Undertime / Late - Minute" data-xdate="'.$xdatenowxf.'" data-type="number" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($lateutimemin);
																		}
																	?>
																</td>
																<td class="p-0 text-center border-end">
																	<?php 
																		if (empty($overtimehour)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="overtime_hour" data-xlabel="Overtime - Hour" data-xdate="'.$xdatenowxf.'" data-type="number" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($overtimehour);
																		}
																	?>
																</td>
																<td class="p-0 text-center">
																	<?php 
																		if (empty($overtimemin)) {
																			echo '<button type="button" class="btn btn-outline-primary btn-sm" id="'.$subdtrid.'" data-field="overtime_min" data-xlabel="Overtime - Minute" data-xdate="'.$xdatenowxf.'" data-type="number" data-bs-toggle="modal" data-bs-target="#mdiTimeLogEdit" onclick="fnTimeLog(id,dataset.field,dataset.xlabel,dataset.xdate,dataset.type);">Edit</button>';
																		} else {
																			echo trim($overtimemin);
																		}
																	?>
																</td>
														<?php
															}
														}
													?>
												</tr>
											<?php
										}
									} else {
										?>

											<tr>
												<td class="p-0 text-center border-end">0</td>
												<td class="p-0 text-center border-end"><b>0</b> Xxx</td>
												<td class="p-0 text-center border-end">00:00</td>
												<td class="p-0 text-center border-end">00:00</td>
												<td class="p-0 text-center border-end">00:00</td>
												<td class="p-0 text-center border-end">00:00</td>
												<td class="p-0 border-end"></td>
												<td class="p-0 border-end"></td>
												<td class="p-0 border-end"></td>
												<td class="p-0"></td>
											</tr>

										<?php
									}

									$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$stmt_sum_ulate_overtime = $cnn->prepare("SELECT SUM(lateutime_hour) AS totallateutimehour, SUM(lateutime_min) AS totallateutimemin, SUM(overtime_hour) AS totalovertimehour, SUM(overtime_min) AS totalovertimemin FROM employee_subdtr_tbl WHERE 
										dtrcode=:dtrcode");
									$stmt_sum_ulate_overtime->bindParam(':dtrcode', $dtrcodek);
									$stmt_sum_ulate_overtime->execute();
									$row_sumulateovertime = $stmt_sum_ulate_overtime->fetch();
									$totallateutimehour = $row_sumulateovertime['totallateutimehour'];
									$totallateutimemin = $row_sumulateovertime['totallateutimemin'];
									$totalovertimehour = $row_sumulateovertime['totalovertimehour'];
									$totalovertimemin = $row_sumulateovertime['totalovertimemin'];

									// Update Total UTime_Late and OT
									$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$qry_update_ulate_overtime = "UPDATE employee_dtr_tbl SET utlate_hr=:lateutimehour, utlate_min=:lateutimemin, ot_hr=:overtimehour, ot_min=:overtimemin WHERE dtrcode=:dtrcode";
									$stmt_update_ulate_overtime = $cnn->prepare($qry_update_ulate_overtime);
									$stmt_update_ulate_overtime->bindParam(':dtrcode', $dtrcodek);
									$stmt_update_ulate_overtime->bindParam(':lateutimehour', $totallateutimehour);
									$stmt_update_ulate_overtime->bindParam(':lateutimemin', $totallateutimemin);
									$stmt_update_ulate_overtime->bindParam(':overtimehour', $totalovertimehour);
									$stmt_update_ulate_overtime->bindParam(':overtimemin', $totalovertimemin);
									$stmt_update_ulate_overtime->execute();
								?>
							</tbody>

							<tfoot>
								<tr>
									<td colspan="6" class="p-0 text-end border-end">Total:</td>
									<td  align="center" class="p-0 border-end"><?php echo $utlatehr; ?></td>
									<td align="center" class="p-0 border-end"><?php echo $utlatemin; ?></td>
									<td align="center" class="p-0 border-end"><?php echo $othr; ?></td>
									<td align="center" class="p-0 "><?php echo $otmin; ?></td>
								</tr>
								<tr align="center">
									<th colspan="6" class="p-0 border-end"></th>
									<th class="p-0 border-end">Hour</th>
									<th class="p-0 border-end">Min</th>
									<th class="p-0 border-end">Hour</th>
									<th class="p-0">Min</th>
								</tr>
								<tr align="center">
									<th colspan="6" class="p-0 border-end"></th>
									<th colspan="2" class="p-0 border-end">U.Time/Late</th>
									<th colspan="2" class="p-0">OT</th>
								</tr>
							</tfoot>
						</table>
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">Signatory:</span>
									<input type="text" class="form-control" placeholder="Signatory" value="<?php echo trim(utf8_decode($headofficerk)); ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<div class="input-group my-1">
									<span class="input-group-text">Position:</span>
									<input type="text" class="form-control" placeholder="Position" value="<?php echo trim($headtitlek); ?>" readonly>
								</div>
							</div>
						</div>

						<div class="text-end">
							<button id="btnUpdateDTRE" type="submit" name="btnUpdateDTRE" class="btn btn-success">Update</button>
							<a href="<?php echo $xlinkzk; ?>" target="_blank" class="btn btn-primary">Print</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<div class="modal fade" id="mdiTimeLogEdit">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 id="modaltitle" class="modal-title">Update: </h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<label id="lbldate">Date:</label>
						<div class="input-group">
							<span id="labelingcap" class="input-group-text">Label</span>
							<input list="valuefldlists" id="fldvaluex" class="form-control" name="datafeld" min="1" autofocus required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>

							<datalist id="valuefldlists"></datalist>
						</div>

						<input id="feildnem" type="text" name="feildnem" class="form-control" required readonly hidden>
						<input id="fldidno" type="number" name="fldidno" class="form-control" required readonly hidden>

						<div class="row">
							<div class="col">
								<?php
									if (isset($_POST['btnTimeLogU'])) {
										$datafeldx = trim($_POST['datafeld']);
										$feildnemx = trim($_POST['feildnem']);


										function checkIsTime($timeformat) {
											$timeformat=DateTime::createFromFormat('g:i', $timeformat);
											$time_errors = DateTime::getLastErrors();

											if ($time_errors['warning_count'] + $time_errors['error_count'] == 0) {
												return TRUE;
											} else {
												return FALSE;
											}
										}

										function checkIsValStat($valstat) {
											if ($valstat=="ON LEAVE") {
												return TRUE;
											} elseif ($valstat=="OB") {
												return TRUE;
											} elseif ($valstat=="OT") {
												return TRUE;
											} else {
												return FALSE;
											}
										}

										if (empty($_POST['datafeld'])) {
											echo '<script>alert("Invalid Input!")</script>';
										} elseif (empty($_POST['feildnem'])) {
											echo '<div class="alert alert-danger alert-dismissible fade show">';
												echo '<button type="button" class="close" data-dismiss="alert"></button>';
												echo 'Fieldname Required!';
											echo '</div>';
										} elseif (empty($_POST['fldidno'])) {
											echo '<div class="alert alert-danger alert-dismissible fade show">';
												echo '<button type="button" class="close" data-dismiss="alert"></button>';
												echo 'Field Number Required!';
											echo '</div>';
										} elseif ($feildnemx=='lateutime_hour' || $feildnemx=='lateutime_min' || $feildnemx=='overtime_hour' || $feildnemx=='overtime_min') {
											if (is_numeric($datafeldx)) {
												if ($datafeldx>0) {
													$datafeld = trim($_POST['datafeld']);
													$feildnem = trim($_POST['feildnem']);
													$fldidno = trim($_POST['fldidno']);

													$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
													$qry_update_timelogx = "UPDATE employee_subdtr_tbl SET ".$feildnem."=:datafeldgg WHERE subdtrid=:fldidnogg";
													$stmt_update_timelogx = $cnn->prepare($qry_update_timelogx);
													$stmt_update_timelogx->bindValue(':fldidnogg', $fldidno);
													$stmt_update_timelogx->bindParam(':datafeldgg', $datafeld);
													$stmt_update_timelogx->execute();

													$current_url = $_SERVER['REQUEST_URI'];

													echo '<script>window.open("'.$current_url.'","_self");</script>';
												} else {
													echo '<script>alert("Must be greater than 0 Zero.")</script>';
												}
											} else {
												echo '<script>alert("Invalid Input!")</script>';
											}
										} else {
											if ($feildnemx!='amtimein') {
												if (checkIsTime($datafeldx)) {
													$datafeld = trim($_POST['datafeld']);
													$feildnem = trim($_POST['feildnem']);
													$fldidno = trim($_POST['fldidno']);

													$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
													$qry_update_timelogx = "UPDATE employee_subdtr_tbl SET ".$feildnem."=:datafeldgg WHERE subdtrid=:fldidnogg";
													$stmt_update_timelogx = $cnn->prepare($qry_update_timelogx);
													$stmt_update_timelogx->bindValue(':fldidnogg', $fldidno);
													$stmt_update_timelogx->bindParam(':datafeldgg', $datafeld);
													$stmt_update_timelogx->execute();

													$current_url = $_SERVER['REQUEST_URI'];

													echo '<script>window.open("'.$current_url.'","_self");</script>';
												} else {
													echo '<script>alert("Invalid Input!")</script>';
												}
											} else {
												If (checkIsValStat($datafeldx)) {
													$datafeld = trim($_POST['datafeld']);
													$feildnem = trim($_POST['feildnem']);
													$fldidno = trim($_POST['fldidno']);

													$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
													$qry_update_timelogx = "UPDATE employee_subdtr_tbl SET ".$feildnem."=:datafeldgg WHERE subdtrid=:fldidnogg";
													$stmt_update_timelogx = $cnn->prepare($qry_update_timelogx);
													$stmt_update_timelogx->bindValue(':fldidnogg', $fldidno);
													$stmt_update_timelogx->bindParam(':datafeldgg', $datafeld);
													$stmt_update_timelogx->execute();

													$current_url = $_SERVER['REQUEST_URI'];

													echo '<script>window.open("'.$current_url.'","_self");</script>';
												} else {
													if (checkIsTime($datafeldx)) {
														$datafeld = trim($_POST['datafeld']);
														$feildnem = trim($_POST['feildnem']);
														$fldidno = trim($_POST['fldidno']);

														$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
														$qry_update_timelogx = "UPDATE employee_subdtr_tbl SET ".$feildnem."=:datafeldgg WHERE subdtrid=:fldidnogg";
														$stmt_update_timelogx = $cnn->prepare($qry_update_timelogx);
														$stmt_update_timelogx->bindValue(':fldidnogg', $fldidno);
														$stmt_update_timelogx->bindParam(':datafeldgg', $datafeld);
														$stmt_update_timelogx->execute();

														$current_url = $_SERVER['REQUEST_URI'];

														echo '<script>window.open("'.$current_url.'","_self");</script>';
													} else {
														echo '<script>alert("Invalid Input!")</script>';
													}
												}
											}
										}
									}
								?>
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button id="btnTimeLogU" name="btnTimeLogU" type="submit" class="btn btn-primary">Update</button>
						<button id="btnCloseZ" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		function fnTimeLog(id,datafield,xlabel,xdate,xtype) {
			document.getElementById("fldvaluex").value = "";
			document.getElementById("fldvaluex").type = "text";
			document.getElementById("lbldate").innerHTML = "<b>Date:</b> " + xdate;
			document.getElementById("modaltitle").innerHTML = "Update: " + xlabel;
			document.getElementById("labelingcap").innerHTML = xlabel;
			document.getElementById("feildnem").value = datafield;
			document.getElementById("fldidno").value = id;
			document.getElementById("valuefldlists").innerHTML = "";
			document.getElementById("fldvaluex").type = xtype;

			if (datafield=='amtimein') {
				document.getElementById("valuefldlists").innerHTML = '<option value="ON LEAVE"></option><option value="OB">Official Business</option></option><option value="OT">Official Time</option>';
			}

			document.getElementById("fldvaluex").focus();
		}
	</script>