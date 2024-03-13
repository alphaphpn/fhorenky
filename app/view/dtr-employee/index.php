<?php

	$xdeltime = 0;
	$yrno = isset($_GET['yrno']) ? $_GET['yrno'] : '';
	$monthno = isset($_GET['monthno']) ? $_GET['monthno'] : '';
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

	if (isset($_GET['yrno']) && isset($_GET['monthno']) && isset($officecode)) {

?>
					<!-- Start here -->
					<div class="card mb-4">
						<div class="card-header">
							<i class="fas fa-chart-bar me-1"></i>Employee
						</div>
						<div class="card-body">
							<div class="table-responsive-lg mt-3">
								<table id="listRecView" class="table table-striped table-hover table-sm" style="background-color: #fff;">
									<thead id="remSortH">
										<tr>
											<th class="remove-dropdown"></th>
											<th></th>
											<th class="remove-dropdown"></th>
											<th class="remove-dropdown"></th>
											<th class="remove-dropdown"></th>
											<th class="remove-dropdown"></th>
											<th></th>
											<th></th>
											<th class="remove-dropdown"></th>
											<th class="remove-dropdown"></th>
											<th class="remove-dropdown"></th>
										</tr>
									</thead>

									<thead id="theadtitle" class="thead-dark">
										<tr>
											<th>No.</th>
											<th>Bio Location</th>
											<th>Bio.#</th>
											<th>Emp. ID</th>
											<th>Employee</th>
											<th>Office#</th>
											<th>Office</th>
											<th>Type</th>
											<th>Signatory</th>
											<th>PID</th>
											<th class="text-right">Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

											if ($officecode=="*") {
												$qry = "SELECT * FROM employee_dtr_tbl WHERE yearno=:yearno AND monthno=:monthno ORDER BY bio_no ASC";
												$stmt = $cnn->prepare($qry);
												$stmt->bindParam(':yearno', $yrno);
												$stmt->bindParam(':monthno', $monthno);
											} else {
												$qry = "SELECT * FROM employee_dtr_tbl WHERE officecode=:officecode AND yearno=:yearno AND monthno=:monthno ORDER BY bio_no ASC";
												$stmt = $cnn->prepare($qry);
												$stmt->bindParam(':yearno', $yrno);
												$stmt->bindParam(':monthno', $monthno);
												$stmt->bindParam(':officecode', $officecode);
											}
											
											$stmt->execute();
											$xno = 0;

											for($i=0; $row = $stmt->fetch(); $i++) {
												$xno++;
												$empid=$row["emp_id"];
												$profileid=$row["profileid"];
												$biolocation=$row["bio_location"];
												$biono=$row["bio_no"];
												$empname=utf8_encode($row["emp_name"]);
												$officecode1=$row["officecode"];
												$officename=$row["officename"];
												$typeemployeeabrv=$row["type_employee_abrv"];
												$signatory=utf8_encode($row["headofficer"]);
												$xlinkz = "../../routes/dtr-print/?yrno=".$yrno."&monthno=".$monthno."&biolocation=".$biolocation."&biono=".$biono;
												$chklinkz = "../../routes/dtr-checker/?yrno=".$yrno."&monthno=".$monthno."&biolocation=".$biolocation."&biono=".$biono;
										?>
												<tr>
													<td><?php echo $xno; ?></td>
													<td><?php echo $biolocation; ?></td>
													<td><?php echo $biono; ?></td>
													<td><?php echo $empid; ?></td>
													<td><?php echo utf8_decode($empname); ?></td>
													<td><?php echo $officecode1; ?></td>
													<td><?php echo $officename; ?></td>
													<td><?php echo $typeemployeeabrv; ?></td>
													<td><?php echo utf8_decode($signatory); ?></td>
													<td><?php echo $profileid; ?></td>
													<td>
														<a href="<?php echo trim($xlinkz); ?>" target="_blank" class="btn btn-primary btn-sm"><i class="far fa-clock"></i></a>
														<a href="<?php echo trim($chklinkz); ?>" class="btn btn-danger btn-sm">
															<i class="fa fa-check" aria-hidden="true"></i>
														</a>
													</td>
												</tr>
										<?php
											}
										?>
									</tbody>

									<tfoot>
										<tr>
											<td class="remove-dropdown"></td>
											<td></td>
											<td class="remove-dropdown"></td>
											<td class="remove-dropdown"></td>
											<td class="remove-dropdown"></td>
											<td class="remove-dropdown"></td>
											<td></td>
											<td></td>
											<td class="remove-dropdown"></td>
											<td class="remove-dropdown"></td>
											<td class="remove-dropdown"></td>
										</tr>
									</tfoot>
								</table>
							</div>
							<div id="trnsfrPaginate" class="dataTables_wrapper"></div>
							<div id="demo"></div>
						</div>
					</div>

					<script>
						$(document).ready( function () {
							$('#listRecView').DataTable( {
								initComplete: function () {
									this.api().columns().every( function () {

										/** Filter Group for each column Start **/
										var column = this;
										var select = $('<select><option value=""></option></select>')
										.appendTo( $(column.header()).empty() )
										.on( 'change', function () {
											var val = $.fn.dataTable.util.escapeRegex(
											$(this).val()
										);

										column
											.search( val ? '^'+val+'$' : '', true, false )
											.draw();
										});

										column.data().unique().sort().each( function ( d, j ) {
											select.append( '<option value="'+d+'">'+d+'</option>' )
										});
										/** Filter Group for each column End **/

										/** Search for each column Start **/
										// var that = this;
										// var input = $('<input type="text" placeholder="Search" />')
										// .appendTo($(this.header()).empty())

										// .on('keyup change', function() {
										// 	if (that.search() !== this.value) {
										// 		that
										// 		.search(this.value)
										// 		.draw();
										// 	}
										// });
										/** Search for each column End **/
									});
								}
							});

							$("#listRecView_info, #listRecView_paginate").detach().appendTo('#trnsfrPaginate');

							$(".remove-dropdown select").remove();
							$(".remove-dropdown").removeClass('sorting');
							$(".remove-dropdown").removeClass('sorting_asc');
							$(".remove-dropdown").removeClass('sorting_desc');

							$('.table-responsive table.dataTable thead .sorting').on('click', function(event) {
								$(".remove-dropdown select").remove();
								$(".remove-dropdown").removeClass('sorting');
								$(".remove-dropdown").removeClass('sorting_asc');
								$(".remove-dropdown").removeClass('sorting_desc');
							});
						});

						function onlyOne(checkbox) {
							var checkboxes = document.getElementsByName('empnoid');
							checkboxes.forEach((item) => {
								if (item !== checkbox) {
									item.checked = false;
								} else {
									item.checked = true;
									console.log(item.dataset.pid);
									document.querySelector('input[type=search]').value = item.dataset.pid;
									document.querySelector('input[type=search]').focus();
								}
							});
						}
					</script>

<?php
	}