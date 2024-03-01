<?php

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
				$authdescription = $row_empdtr['auth_description'];
				$authhead = $row_empdtr['auth_head'];
				$authtitle = $row_empdtr['auth_title'];
				$typeemployeeabrv = $row_empdtr['type_employee_abrv'];
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
		$typeemployeeabrv = "";
	}
?>

	<section>
		<div class="container-fluid">
			<div class="row">
				<!-- DTR- Start -->
				<div class="col-sm-3">
					<div>
						<div class="d-flex justify-content-between">
							<label class="font-size-10">BioTag: <?php echo trim($biolocationk); ?></label>
							<label class="font-size-10">Bio#: <?php echo trim($bionok); ?></label>
						</div>
						<div class="d-flex justify-content-between">
							<label class="font-size-11">Office: <?php echo trim($officeabrvk); ?></label>
							<label class="font-size-11">DTR-ID: <?php echo trim($dtrcodek); ?></label>
						</div>
						<table class="table" border="2">
							<thead>
								<tr>
									<th colspan="10" class="p-0 font-size-12">CIVIL SERVICE FORM No. 48</th>
								</tr>
								<tr align="center">
									<th colspan="10" class="p-0 font-size-14">DAILY TIME RECORD</th>
								</tr>
								<tr align="center">
									<th colspan="10" class="p-0 font-size-12"><b><?php echo trim(strtoupper(utf8_decode($empnamek))); ?></b></th>
								</tr>
								<tr align="center">
									<th colspan="10" class="p-0 font-size-10">(NAME)</th>
								</tr>
								<tr>
									<th colspan="6" class="p-0">
										<i class="font-size-10 pe-1 border-end">For the Month of</i>
										<b class="font-size-11"><?php echo trim($monthnamek)." ".trim($yearnok); ?></b>
									</th>
									<th colspan="4" class="p-0">
										<i class="font-size-8 text-right">Regular days _____</i>
									</th>
								</tr>
								<tr>
									<th colspan="6" class="p-0">
										<i class="font-size-10">Official hours for arrival and departure</i>
									</th>
									<th colspan="4" class="p-0">
										<i class="font-size-8">Saturdays ______</i>
									</th>
								</tr>
								<tr align="center">
									<th rowspan="2" colspan="2" class="p-0 font-size-10 align-middle border-end">Day</th>
									<th colspan="2" class="p-0 font-size-10 border-end">AM</th>
									<th colspan="2" class="p-0 font-size-10 border-end">PM</th>
									<th colspan="2" class="p-0 font-size-8 border-end">Tardy/UnderTime</th>
									<th colspan="2" class="p-0 font-size-8">Overtime</th>
								</tr>
								<tr align="center">
									<th class="p-0 font-size-8 border-end">Arrival</th>
									<th class="p-0 font-size-8 border-end">Departure</th>
									<th class="p-0 font-size-8 border-end">Arrival</th>
									<th class="p-0 font-size-8 border-end">Departure</th>
									<th class="p-0 font-size-8 border-end">Hour</th>
									<th class="p-0 font-size-8 border-end">Min</th>
									<th class="p-0 font-size-8 border-end">Hour</th>
									<th class="p-0 font-size-8">Min</th>
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
											$monthnohh = $row_timelogz['monthno'];
											$daynohh = $row_timelogz['dayno'];
											$yearnohh = $row_timelogz['yearno'];

											/** Check Holidays - Start **/
											$stmt_holiday = $cnn->prepare("SELECT * FROM holidays_tbl WHERE holiday_mno=:monthno AND holiday_day=:dayno AND holiday_year=:yearno");
											$stmt_holiday->bindParam(':monthno', $monthnohh);
											$stmt_holiday->bindParam(':dayno', $daynohh);
											$stmt_holiday->bindParam(':yearno', $yearnohh);
											$stmt_holiday->execute();
											$nmbr_holiday = $stmt_holiday->rowCount();
											$row_holiday = $stmt_holiday->fetch(PDO::FETCH_ASSOC);

											if ($nmbr_holiday==0) {
												// No Holiday
												$holidayname = null;
											} else {
												// With Holiday
												$holidayname = trim($row_holiday['holiday_name']);
											}
											/** Check Holidays - End **/

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

											if (preg_match($time_pattern, $pmtimeinhh)) {
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

											if (preg_match($time_pattern, $pmtimeouthh)) {
												$pmtimeouthjkd = new DateTime($pmtimeouthh);
												$pmtimeouthhxf = $pmtimeouthjkd->format('gi');
												if ($pmtimeouthhxf<459) {
													$xcolordb = "#ff0000";
												} else {
													$xcolordb = "#000000";
												}
											}

											$lateutimehour = $row_timelogz['lateutime_hour'];
											$lateutimemin = $row_timelogz['lateutime_min'];
											$overtimehour = $row_timelogz['overtime_hour'];
											$overtimemin = $row_timelogz['overtime_min'];

											?>
												<tr>
													<td class="p-0 font-size-10 ps-2"><b><?php echo trim($daynohh); ?></b></td>
													<?php
														if ($namedayhh=='n/a') {
															?>
															<td colspan="9" class="p-0 font-size-10 text-center txt-bg-f2f2f2">NOT APPLICABLE</td>
															<?php
														} elseif (empty($amtimeinhh) && empty($amtimeouthh) && empty($pmtimeinhh) && empty($pmtimeouthh)) {
															if ($namedayhh=='Sat' || $namedayhh=='Sun') {
																?>
																<td colspan="9" class="p-0 font-size-10 text-center txt-bg-f2f2f2"><?php echo trim(strtoupper($namedayhh)); ?></td>
																<?php
															} else {
																?>
																<td class="p-0 font-size-10 ps-2 border-end"><?php echo trim($namedayhh); ?></td>
																<?php
																	if (empty($holidayname) || $holidayname == null) {
																		if ($typeemployeeabrv=="REG" || $typeemployeeabrv=="TMP" || $typeemployeeabrv=="COT"  || $typeemployeeabrv=="OFFR" || $typeemployeeabrv=="LEG" || $typeemployeeabrv=="EXEC") {
																			?>
																			<td colspan="4" class="p-0 font-size-10 text-center txt-bg-f2f2f2 font-color-dark-blue">LEAVE</td>
																			<?php
																		} else {
																			?>
																			<td colspan="4" class="p-0 font-size-10 text-center txt-bg-f2f2f2 text-danger">ABSENT</td>
																			<?php
																		}
																		?>
																			<td class="p-0 font-size-10 text-center border-end"><?php echo trim($lateutimehour); ?></td>
																			<td class="p-0 font-size-10 text-center border-end"><?php echo trim($lateutimemin); ?></td>
																			<td class="p-0 font-size-10 text-center border-end"><?php echo trim($overtimehour); ?></td>
																			<td class="p-0 font-size-10 text-center"><?php echo trim($overtimemin); ?></td>
																		<?php
																	} else {
																		?>
																			<td colspan="8" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim(strtoupper($holidayname)); ?></td>
																		<?php
																	}
																?>
																<?php
															}
														} else {
															?>
															<td class="p-0 font-size-10 ps-2 border-end"><?php echo trim($namedayhh); ?></td>
															<?php
															if (trim($amtimeinhh)==trim($amtimeouthh) && trim($amtimeouthh)==trim($pmtimeinhh) && trim($pmtimeinhh)==trim($pmtimeouthh)) {
																?>
																	<!-- 4 lanes -->
																	<td colspan="4" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeinhh); ?></td>
																<?php
															} elseif (isset($amtimeinhh) && empty($amtimeouthh) && empty($pmtimeinhh) && empty($pmtimeouthh)) {
																// AM Time-In and All Empty
																if (checkIsTime($amtimeinhh)) {
																	?>
																		<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolord; ?>;"><?php echo trim($amtimeinhh); ?></td>
																		<td class="p-0 font-size-10 text-center border-end">--:--</td>
																		<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">UNDERTIME</td>
																	<?php
																} else {
																	?>
																		<td colspan="4" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeinhh); ?></td>
																	<?php
																}
															} elseif (trim($amtimeinhh)==trim($amtimeouthh) && trim($amtimeouthh)!=trim($pmtimeinhh) && trim($pmtimeinhh)!=trim($pmtimeouthh)) {
																if (empty($amtimeinhh) && empty($amtimeouthh) && isset($pmtimeinhh) && empty($pmtimeouthh)) {
																	?>
																		<!-- 2 lanes AM -->
																		<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">TARDY</td>
																		<?php
																			if (checkIsTime($pmtimeinhh)) {
																				?>
																					<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolorda; ?>;"><?php echo trim($pmtimeinhh); ?></td>
																					<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordb; ?>;">--:--</td>
																				<?php
																			} else {
																				?>
																					<td colspan="2" class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolorda; ?>;"><?php echo trim($pmtimeinhh); ?></td>
																				<?php
																			}
																		?>
																	<?php
																} else {
																	if (empty($amtimeinhh) && empty($amtimeouthh)) {
																		?>
																			<!-- 2 lanes AM -->
																			<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">TARDY</td>
																			<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolorda; ?>;"><?php echo trim($pmtimeinhh); ?></td>
																			<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordb; ?>;"><?php echo trim($pmtimeouthh); ?></td>
																		<?php
																	} else {
																		?>
																			<!-- 2 lanes AM -->
																			<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeinhh); ?></td>
																			<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolorda; ?>;"><?php echo trim($pmtimeinhh); ?></td>
																			<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordb; ?>;"><?php echo trim($pmtimeouthh); ?></td>
																		<?php
																	}
																}
															} elseif (trim($amtimeinhh)==trim($amtimeouthh) && empty($pmtimeinhh) && empty($pmtimeouthh)) {
																?>
																	<!-- 2 lanes AM and PM_In-Out Empty -->
																	<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeinhh); ?></td>
																	<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">UNDERTIME</td>
																<?php
															} elseif (trim($pmtimeouthh)==trim($pmtimeinhh) && trim($pmtimeinhh)!=trim($amtimeouthh) && trim($amtimeouthh)!=trim($amtimeinhh)) {
																if (empty($amtimeinhh) && isset($amtimeouthh) && empty($pmtimeinhh) && empty($pmtimeouthh)) {
																	if (checkIsTime($amtimeouthh)) {
																		?>
																			<!-- 2 lanes PM -->
																			<td class="p-0 font-size-10 text-center border-end">--:--</td>
																			<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordc; ?>;"><?php echo trim($amtimeouthh); ?></td>
																			<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">UNDERTIME</td>
																		<?php
																	} else {
																		?>
																			<!-- 2 lanes PM -->
																			<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeouthh); ?></td>
																			<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">UNDERTIME</td>
																		<?php
																	}
																} else {
																	?>
																		<!-- 2 lanes PM -->
																		<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolord; ?>;">
																			<?php
																				if (empty($amtimeinhh)) {
																					echo '--:--';
																				} else {
																					echo trim($amtimeinhh);
																				}
																			?>
																		</td>
																		<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordc; ?>;">
																			<?php
																				if (empty($amtimeouthh)) {
																					echo '--:--';
																				} else {
																					echo trim($amtimeouthh);
																				}
																			?>
																		</td>
																		
																	<?php
																		if (checkIsTime($pmtimeinhh)) {
																	?>
																		<td class="p-0 font-size-10 text-center border-end">--:--</td>
																		<td class="p-0 font-size-10 text-center border-end"><?php echo trim($pmtimeinhh); ?></td>
																	<?php
																		} else {
																	?>
																		<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">
																			<?php
																				if (empty($pmtimeinhh)) {
																					echo 'UNDERTIME';
																				} else {
																					echo trim($pmtimeinhh);
																				}
																			?>
																		</td>
																	<?php
																		}
																}
															} elseif (empty($amtimeinhh) && trim($amtimeouthh)==trim($pmtimeinhh) && empty($pmtimeouthh)) {
																?>
																	<!-- 2 lanes AM-Out and PM-In -->
																	<td class="p-0 font-size-10 text-center border-end">--:--</td>
																	<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeouthh); ?></td>
																	<td class="p-0 font-size-10 text-center border-end">--:--</td>
																<?php
															} elseif (trim($pmtimeouthh)==trim($pmtimeinhh) && empty($amtimeouthh) && empty($amtimeinhh)) {
																?>
																	<!-- 2 lanes PM AM_In-Out Empty-->
																	<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 text-danger">TARDY</td>
																	<?php
																		if (checkIsTime($pmtimeinhh)) {
																			echo '<td class="p-0 font-size-10 text-center border-end">--:--</td>';
																			echo '<td class="p-0 font-size-10 text-center border-end">'.trim($pmtimeinhh).'</td>';
																		} else {
																			echo '<td colspan="2" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue">'.trim($pmtimeinhh).'</td>';
																		}
																	?>
																<?php
															} elseif (trim($amtimeinhh)==trim($amtimeouthh) && trim($amtimeouthh)==trim($pmtimeinhh) && empty($pmtimeouthh)) {
																?>
																	<!-- 3 lanes AM -->
																	<td colspan="3" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($amtimeinhh); ?></td>
																	<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordb; ?>;"><?php echo trim($pmtimeouthh); ?></td>
																<?php
															} elseif (trim($pmtimeouthh)==trim($pmtimeinhh) && trim($pmtimeinhh)==trim($amtimeouthh) && empty($amtimeinhh)) {
																?>
																	<!-- 3 lanes PM -->
																	<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolord; ?>;"><?php echo trim($amtimeinhh); ?></td>
																	<td colspan="3" class="p-0 font-size-10 text-center border-end txt-bg-f2f2f2 font-color-dark-blue"><?php echo trim($pmtimeinhh); ?></td>
																<?php
															} else {
																?>
																	<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolord; ?>;">
																		<?php
																			if (empty($amtimeinhh)) {
																				echo '--:--';
																			} else {
																				echo trim($amtimeinhh); 
																			}
																		?>
																	</td>
																	<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordc; ?>;">
																		<?php
																			if (empty($amtimeouthh)) {
																				echo '--:--';
																			} else {
																				echo trim($amtimeouthh); 
																			}
																		?>
																	</td>
																	<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolorda; ?>;">
																		<?php
																			if (empty($pmtimeinhh)) {
																				echo '--:--';
																			} else {
																				echo trim($pmtimeinhh); 
																			}
																		?>
																	</td>
																	<td class="p-0 font-size-10 text-center border-end" style="color: <?php echo $xcolordb; ?>;"><?php echo trim($pmtimeouthh); ?></td>
																<?php
															}
															?>
																<td class="p-0 font-size-10 text-center border-end"><?php echo trim($lateutimehour); ?></td>
																<td class="p-0 font-size-10 text-center border-end"><?php echo trim($lateutimemin); ?></td>
																<td class="p-0 font-size-10 text-center border-end"><?php echo trim($overtimehour); ?></td>
																<td class="p-0 font-size-10 text-center"><?php echo trim($overtimemin); ?></td>
															<?php
														}
													?>
												</tr>
											<?php
										}
									} else {
										?>

											<tr>
												<td class="p-0 font-size-10 text-center border-end"><b>0</b> Xxx</td>
												<td class="p-0 font-size-10 text-center border-end">00:00</td>
												<td class="p-0 font-size-10 text-center border-end">00:00</td>
												<td class="p-0 font-size-10 text-center border-end">00:00</td>
												<td class="p-0 font-size-10 text-center border-end">00:00</td>
												<td class="p-0 font-size-10 text-center border-end"></td>
												<td class="p-0 font-size-10 text-center border-end"></td>
												<td class="p-0 font-size-10 text-center border-end"></td>
												<td class="p-0 font-size-10 text-center"></td>
											</tr>

										<?php
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="6" class="p-0 font-size-10 text-end border-end">Total:</td>
									<td  align="center" class="p-0 font-size-10 border-end"><?php echo $utlatehr; ?></td>
									<td align="center" class="p-0 font-size-10 border-end"><?php echo $utlatemin; ?></td>
									<td align="center" class="p-0 font-size-10 border-end"><?php echo $othr; ?></td>
									<td align="center" class="p-0 font-size-10"><?php echo $otmin; ?></td>
								</tr>
								<tr>
									<td colspan="10" class="p-0 font-size-10 border-0 text-indent-32">I CERTIFY on my honor that the above is true and correct report of the hours, work performed record, of which was made daily at the time of arrival and departure from the office</td>
								</tr>
								<tr class="border-0">
									<td colspan="5" class="pb-0 border-0"></td>
									<td colspan="5" class="pb-0 border-bottom"></td>
								</tr>
								<tr>
									<td colspan="5"></td>
									<td colspan="5" class="p-0 font-size-10 text-center">Employee's Signature</td>
								</tr>
						<?php
							if (empty($authdescription) || empty($authhead) || empty($authtitle)) {
								?>
								<tr>
									<td colspan="10" class="p-0 font-size-10 pb-4">Verified as to the prescribed office hours</td>
								</tr>
								<?php
							} else {
								?>
								<tr>
									<td colspan="10" class="p-0 font-size-10 border-bottom-width-0">Verified as to the prescribed office hours</td>
								</tr>
								<tr>
									<td class="p-0 font-size-10 text-center border-bottom-width-0"></td>
									<td colspan="8" class="p-0 font-size-10 pb-4 border-bottom-width-0 font-color-dark-blue">By authority of the Governor</td>
									<td class="p-0 font-size-10 text-center border-bottom-width-0"></td>
								</tr>
								<tr>
									<td class="p-0 font-size-10 text-center"></td>
									<td colspan="8" class="p-0 font-size-10 font-color-dark-blue"><b class="border-top-dotted">ATTY. CHRISTIAN JAY M. MILLENA</b><br>Provincial Administrator</td>
									<td class="p-0 font-size-10 text-center"></td>
								</tr>
								<?php
							}
						?>
								<tr align="center">
									<td colspan="10" class="p-0 font-size-12"><b><?php echo trim(strtoupper(utf8_decode($headofficerk))); ?></b></td>
								</tr>
								<tr align="center">
									<td colspan="10" class="p-0 font-size-11"><i><?php echo trim($headtitlek); ?></i></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<!-- DTR- End -->

				<!-- Attendance Log - Start -->
				<div class="col-sm-3">
					<div>
						<div class="d-flex justify-content-between">
							<label class="font-size-10">BioTag: <?php echo trim($biolocationk); ?></label>
							<label class="font-size-10">Bio#: <?php echo trim($bionok); ?></label>
						</div>
						<div class="d-flex justify-content-between">
							<label class="font-size-11">Office: <?php echo trim($officeabrvk); ?></label>
							<label class="font-size-11">DTR-ID: <?php echo trim($dtrcodek); ?></label>
						</div>
						<table class="table" border="2">
							<thead>
								<tr>
									<th colspan="2" class="p-0 font-size-12">BIOMETRIC</th>
									<th colspan="8" class="p-0 font-size-10 text-end">Employee Copy | In-Charge/HR Copy | Accounting Copy | Auditor Copy</th>
								</tr>
								<tr align="center">
									<th colspan="10" class="p-0 font-size-14">ATTENDANCE LOG</th>
								</tr>
								<tr align="center">
									<th colspan="10" class="p-0 font-size-12"><b><?php echo trim(strtoupper(utf8_decode($empnamek))); ?></b></th>
								</tr>
								<tr align="center">
									<th colspan="10" class="p-0 font-size-10">(NAME)</th>
								</tr>
								<tr>
									<th colspan="6" class="p-0">
										<i class="font-size-10 pe-1 border-end">For the Month of</i>
										<b class="font-size-11"><?php echo trim($monthnamek)." ".trim($yearnok); ?></b>
									</th>
									<th colspan="4" class="p-0">
										<i class="font-size-8 text-right"></i>
									</th>
								</tr>
								<tr>
									<th colspan="6" class="p-0">
										<i class="font-size-10">Official timelog(s)</i>
									</th>
									<th colspan="4" class="p-0">
										<i class="font-size-8"></i>
									</th>
								</tr>
								<tr align="center">
									<th colspan="2" class="p-0 font-size-10 align-middle border-end">Day</th>
									<th colspan="8" class="p-0 font-size-10 border-end">Time Log(s)</th>
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
											$monthnohh = $row_timelogz['monthno'];
											$daynohh = $row_timelogz['dayno'];
											$yearnohh = $row_timelogz['yearno'];

											$biolocationhh = $row_timelogz['bio_location'];
											$bionohh = $row_timelogz['bio_no'];

											/** Check Holidays - Start **/
											$stmt_holiday = $cnn->prepare("SELECT * FROM holidays_tbl WHERE holiday_mno=:monthno AND holiday_day=:dayno AND holiday_year=:yearno");
											$stmt_holiday->bindParam(':monthno', $monthnohh);
											$stmt_holiday->bindParam(':dayno', $daynohh);
											$stmt_holiday->bindParam(':yearno', $yearnohh);
											$stmt_holiday->execute();
											$nmbr_holiday = $stmt_holiday->rowCount();
											$row_holiday = $stmt_holiday->fetch(PDO::FETCH_ASSOC);

											if ($nmbr_holiday==0) {
												// No Holiday
												$holidayname = null;
											} else {
												// With Holiday
												$holidayname = trim($row_holiday['holiday_name']);
											}
											/** Check Holidays - End **/

											$namedayhh = $row_timelogz['nameday'];

											?>
												<tr>
													<td class="p-0 font-size-10 ps-2" style="width: 26px;"><b><?php echo trim($daynohh); ?></b></td>
													<?php
														if ($namedayhh=='n/a') {
															?>
															<td colspan="9" class="p-0 font-size-10 text-center txt-bg-f2f2f2">NOT APPLICABLE</td>
															<?php
														} else {
															?>
															<td class="p-0 font-size-10 ps-2 border-end" style="width: 34px;"><?php echo trim($namedayhh); ?></td>
															<td colspan="8" class="p-0 font-size-10 text-center">
																<?php
																	/** Check Timelogs from Att_Log - Start **/

																	$stmt_attlog = $cnn->prepare("SELECT * FROM employee_timelogs_single_tbl WHERE 
																			bio_location=:xbiolocation AND 
																			bio_no=:xbiono AND 
																			xyear=:yearnohh AND 
																			xmonth=:monthnohh AND 
																			xday=:daynohh");
																	$stmt_attlog->bindParam(':xbiolocation', $biolocationhh);
																	$stmt_attlog->bindParam(':xbiono', $bionohh);
																	$stmt_attlog->bindParam(':yearnohh', $yearnohh);
																	$stmt_attlog->bindParam(':monthnohh', $monthnohh);
																	$stmt_attlog->bindParam(':daynohh', $daynohh);
																	$stmt_attlog->execute();
																	$nmbrattlog = $stmt_attlog->rowCount();
																	/** Check Timelogs from Att_Log - End **/

																	if ($nmbrattlog>0) {
																		for($i=0; $row_attlog = $stmt_attlog->fetch(); $i++) {
																			// $attendtimelog = $row_attlog['timelog'];
																			$attendtimelog = new DateTime($row_attlog['timelog']);
																			$atendtimlog = $attendtimelog->format('g:i A');

																			echo $atendtimlog.' <b class="font-color-dark-blue">*|*</b> ';
																		}
																	} else {
																		echo '<p class="p-0 m-0 text-danger">NO TIME REGISTERED</p>';
																	}
																?>
															</td>
													<?php
														}
													?>
												</tr>
											<?php
										}
									} else {
										?>
											<tr>
												<td class="p-0 font-size-10 text-center border-end"><b>0</b> Xxx</td>
												<td class="p-0 font-size-10 text-center border-end">00:00</td>
											</tr>

										<?php
									}
								?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="10" class="p-0 font-size-10 border-0 text-indent-32"></td>
								</tr>
								<tr class="border-0">
									<td colspan="5" class="pb-0 border-0"></td>
									<td colspan="5" class="pb-0 border-bottom"></td>
								</tr>
								<tr>
									<td colspan="5"></td>
									<td colspan="5" class="p-0 font-size-10 text-center"></td>
								</tr>
								<tr>
									<td colspan="10" class="p-0 font-size-10 pb-4">Verified timelog(s) from Biometric Machine</td>
								</tr>
								<tr align="center">
									<td colspan="10" class="p-0 font-size-12"><b>_________________________</td>
								</tr>
								<tr align="center">
									<td colspan="10" class="p-0 font-size-11"><i>Attendance Log In-Charcge</td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<!-- Attendance Log - End -->
			</div>
		</div>
	</section>