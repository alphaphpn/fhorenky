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

	} elseif ($_SESSION["ulevel"]==99) {
		// Election Admin

	} elseif ($_SESSION["ulevel"]==14) {
		// Election Coordinator
		
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
					<script>
						$(document).ready(function(){
							let url_string = window.location.href; 
							let url = new URL(url_string);
							let zeepcode = url.searchParams.get("zip-code");
							let brgyz = url.searchParams.get("barangay");

							if (typeof zeepcode !== 'undefined') {
								if (zeepcode) {
									if (typeof brgyz !== 'undefined') {
										if (brgyz) {

										} else {
											$("#mdiSelectBarangay").modal('show');
										}
									}
								} else {
									$("#mdiSelectTown").modal('show');
								}
							}
						});
					</script>

					<div class="modal fade" id="mdiSelectTown">
						<div class="modal-dialog modal-dialog-scrollable">
							<div class="modal-content">
								<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Select Municipality</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										
										<div class="input-group mb-3 input-group-lg">
											<span class="input-group-text">Municipality</span>
											<input list="municipalitylists" id="municipality" name="municipality" type="text" class="form-control" placeholder="* Municipality" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>

											<datalist id="municipalitylists">
												<option disabled selected value> -- select an option -- </option>
											<?php
												$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
												$stmt_municipalitylists = $cnn->prepare("SELECT * FROM comelec_voters GROUP BY town ORDER BY zipcode ASC");
												$stmt_municipalitylists->execute();
												$result_municipalitylists = $stmt_municipalitylists->setFetchMode(PDO::FETCH_ASSOC);
												foreach ($stmt_municipalitylists as $row_municipalitylists) {
													echo "<option value='".$row_municipalitylists['town']."' data-zipcode='".$row_municipalitylists['zipcode']."'>";
												}
											?>
											</datalist>
										</div>

										<div class="input-group mb-3 input-group-lg">
											<span class="input-group-text">Zip Code</span>
											<input id="zip-code" type="number" min="7001" max="7041" class="form-control" placeholder="* Zip Code" name="zip-code" required readonly>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>

										<div>
											<?php
												try {
													$codezip = isset($_POST['zip-code']) ? $_POST['zip-code'] : '';
													$town = isset($_POST['municipality']) ? $_POST['municipality'] : '';

													if (isset($_POST['btnDtrSubmit'])) {
														echo '<script>window.open("?zip-code='.$codezip.'&municipality='.$town.'","_self");</script>';
													}
												} catch (PDOException $error) {
													$err_msg = $error->getMessage();
													echo "<p>Error: {$err_msg}</p>";
													die;
												}
											?>
										</div>

									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button id="btnDtrSubmit" name="btnDtrSubmit" type="submit" class="btn btn-primary">Filter</button>
										<button id="btnCloseX" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="modal fade" id="mdiSelectBarangay">
						<div class="modal-dialog modal-dialog-scrollable">
							<div class="modal-content">
								<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Select Barangay</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										
										<div class="input-group mb-3 input-group-lg">
											<span class="input-group-text">Barangay</span>
											<input list="barangaylists" id="barangay" name="barangay" type="text" class="form-control" placeholder="* Barangay" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>

											<datalist id="barangaylists">
												<option disabled selected value> -- select an option -- </option>
											<?php
												$codezip = isset($_GET['zip-code']) ? $_GET['zip-code'] : '';

												$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
												$stmt_barangaylists = $cnn->prepare("SELECT * FROM comelec_voters WHERE zipcode=:zipcode GROUP BY barangay ORDER BY barangay ASC");
												$stmt_barangaylists->bindParam(':zipcode', $codezip);
												$stmt_barangaylists->execute();
												$result_barangaylists = $stmt_barangaylists->setFetchMode(PDO::FETCH_ASSOC);
												foreach ($stmt_barangaylists as $row_barangaylists) {
													echo "<option value='".utf8_encode($row_barangaylists['barangay'])."'>";
												}
											?>
											</datalist>
										</div>

										<div>
											<?php
												try {
													$codezip = isset($_GET['zip-code']) ? $_GET['zip-code'] : '';
													$town = isset($_GET['municipality']) ? $_GET['municipality'] : '';
													$barangay = isset($_POST['barangay']) ? $_POST['barangay'] : '';

													if (isset($_POST['btnBrgySubmit'])) {
														echo '<script>window.open("?zip-code='.$codezip.'&municipality='.$town.'&barangay='.$barangay.'","_self");</script>';
													}
												} catch (PDOException $error) {
													$err_msg = $error->getMessage();
													echo "<p>Error: {$err_msg}</p>";
													die;
												}
											?>
										</div>

									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button id="btnBrgySubmit" name="btnBrgySubmit" type="submit" class="btn btn-primary">Filter</button>
										<button id="btnCloseZ" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>

					<div class="m-3">
						<div class="row">
							<div class="col-lg-6 text-end">
								<a href="../../routes/<?php echo $myurl; ?>" class="btn btn-danger">Select Municipality</a>
							</div>
							<div class="col-lg-6 text-start">
								<h3><?php echo isset($_GET['municipality']) ? $_GET['municipality'] : 'Municipality'; ?></h3>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-6 text-end">
								<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#mdiSelectBarangay">Select Barangay</button>
							</div>
							<div class="col-lg-6 text-start">
								<h3><?php echo isset($_GET['barangay']) ? $_GET['barangay'] : 'barangay'; ?></h3>
							</div>
						</div>
					</div>

					<div class="mb-5">
						<div class="table-responsive-lg mt-3 overflow-auto">
							<table id="listRecView" class="table table-striped table-hover table-sm">
								<thead id="remSortH">
									<tr>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th></th>
										<th class="remove-dropdown"></th>
										<th></th>
										<th class="remove-dropdown"></th>
										<th></th>
										<th class="remove-dropdown"></th>
									</tr>
								</thead>
							
								<thead id="theadtitle" class="thead-dark">
									<tr>
										<th></th>
										<th>No.</th>
										<th>ID</th>
										<th>Legend</th>
										<th>Name</th>
										<th>Birthday</th>
										<th>Address</th>
										<th>Precinct</th>
										<th>Mobile#</th>
										<th>Deceased</th>
										<th>Voter's ID</th>
										<th>Remarks</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>

								<tbody>
								<?php
									$codezip = isset($_GET['zip-code']) ? $_GET['zip-code'] : '';
									$bgrgy = isset($_GET['barangay']) ? $_GET['barangay'] : '';

									$cnn_votelist = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$qry_votelist = "SELECT * FROM comelec_voters WHERE zipcode=:zipcode AND barangay=:barangay  ORDER BY voters ASC";
									$stmt_votelist = $cnn_votelist->prepare($qry_votelist);
									$stmt_votelist->bindParam(':zipcode', $codezip);
									$stmt_votelist->bindParam(':barangay', $bgrgy);
									$stmt_votelist->execute();
									$xno_votelist = 0;

									for($i=0; $row_votelist = $stmt_votelist->fetch(); $i++) {
										$xno_votelist++;
										$regvoteno=$row_votelist["regvoteno"];
										$vid=$row_votelist["vid"];
										$legend=$row_votelist["legend"];
										$voters=utf8_encode($row_votelist["voters"]);
										$bdate=$row_votelist["bdate"];
										$address=$row_votelist["address"];
										$barangay=$row_votelist["barangay"];
										$precinct=$row_votelist["precinct"];
										$cp_no=$row_votelist["cp_no"];
										$yeareg=$row_votelist["yeareg"];
										$deceased=$row_votelist["deceased"];
										$verified=$row_votelist["verified"];
										$selected=$row_votelist["selected"];

										if ($verified==1) {
											$xverified=1;
											$xveriflabel="Verified";
											$xverifclass="info";
										} else {
											$xverified=0;
											$xveriflabel="Verify";
											$xverifclass="secondary";
										}

										if ($selected==1) {
											$xselected=1;
											$xselectedlabel="Yes";
											$xselectedclass="primary";
											$remarks="Yes";
										} elseif ($selected==2) {
											$xselected=2;
											$xselectedlabel="No";
											$xselectedclass="danger";
											$remarks="No";
										} elseif ($selected==0) {
											$xselected=2;
											$xselectedlabel="Undecided";
											$xselectedclass="warning";
											$remarks="Undecided";
										} else {
											$xselected="";
											$xselectedlabel="Select";
											$xselectedclass="warning";
											$remarks="Undecided";
										}
								?>
									<tr>
										<td><input class="form-check-input" type="checkbox" id="" name=""></td>
										<td><?php echo trim($xno_votelist); ?></td>
										<td><?php echo trim($regvoteno); ?></td>
										<td><?php echo trim($legend); ?></td>
										<td><?php echo trim($voters); ?></td>
										<td><?php echo trim($bdate); ?></td>
										<td><?php echo trim($address); ?></td>
										<td><?php echo trim($precinct); ?></td>
										<td><?php echo trim($cp_no); ?></td>
										<td><?php echo trim($deceased); ?></td>
										<td><?php echo trim($vid); ?></td>
										<td class="text-<?php echo trim($xselectedclass); ?> font-bold"><?php echo trim($remarks); ?></td>
										<td>
											<button id="getvid-<?php echo trim($regvoteno); ?>" type="button" class="btn btn-<?php echo trim($xverifclass); ?> btn-sm" data-valueid="<?php echo trim($regvoteno); ?>" data-bs-toggle="modal" data-bs-target="#mdiVerify" onclick="fnVerifyVote(id,dataset.valueid);"><?php echo trim($xveriflabel); ?></button>
										</td>
									</tr>
								<?php
									}
								?>
								</tbody>

								<tfoot>
									<tr>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td></td>
										<td class="remove-dropdown"></td>
										<td></td>
										<td class="remove-dropdown"></td>
										<td></td>
										<td class="remove-dropdown"></td>
									</tr>
								</tfoot>
							</table>
						</div>

						<div id="trnsfrPaginate" class="dataTables_wrapper"></div>
						<div id="demo">
							<button type="button" class="btn btn-dark btn-sm">Verify All</button>
						</div>
					</div>

<!-- The Modal -->
<div class="modal" id="mdiVerify">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Verify Voter</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
					<div class="input-group mb-3 input-group-lg">
						<span class="input-group-text">ID</span>
						<input id="theidregvote" name="theidregvote" type="text" class="form-control" readonly required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
					</div>

					<div class="input-group mb-3 input-group-lg">
						<span class="input-group-text">Decide</span>
						<select id="decision" class="form-select form-control" placeholder="Decision" name="decision" required>
							<option disabled value> -- select an option -- </option>
							<option value="1" data-value="Yes">Yes</option>
							<option value="2" data-value="No">No</option>
							<option value="0" data-value="Undecided" selected>Undecided</option>
						</select>
					</div>

					<hr>

					<button id="btnDecideSubmit" name="btnDecideSubmit" type="submit" class="btn btn-primary">Submit</button>

					<?php
						try {
							if (isset($_POST['btnDecideSubmit'])) {
								if ($_SESSION["ulevel"]==1 || $_SESSION["ulevel"]==99 || $_SESSION["ulevel"]==14 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {

									$theidregvote = isset($_POST['theidregvote']) ? $_POST['theidregvote'] : '';
									$decision = isset($_POST['decision']) ? $_POST['decision'] : '';

									$cnn_desisyon = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$qry_desisyon = "UPDATE comelec_voters SET selected=:decision WHERE regvoteno=:theidregvote";
									$stmt_desisyon = $cnn_desisyon->prepare($qry_desisyon);
									$stmt_desisyon->bindValue(':theidregvote', $theidregvote);
									$stmt_desisyon->bindParam(':decision', $decision);
									$stmt_desisyon->execute();

									$current_url = $_SERVER['REQUEST_URI'];

									echo '<script>alert("Successfully Updated!")</script>';

									echo '<script>window.open("'.$current_url.'","_self");</script>';

								} else {
									echo '<script>alert("Access Denied!")</script>';
								}
							}
						} catch (PDOException $error) {
							$err_msg = $error->getMessage();
							echo "<hr>";
							echo "<p>Error: {$err_msg}</p>";
							die;
						}
					?>
				</form>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>

		</div>
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

						let municipality = document.querySelector("#municipality");
						let codezip = document.getElementById("zip-code");
						municipality.addEventListener('change', async function() {
							var town = municipality.value;

							codezip.value = document.querySelector('option[value="' + town + '"]').dataset.zipcode;
						});

						
						function fnVerifyVote(id,valueid) {
							let theidregvote = document.getElementById("theidregvote");
							let getvid = document.getElementById(id);

							console.log(getvid.dataset.valueid);
							theidregvote.value = getvid.dataset.valueid
						}
					</script>