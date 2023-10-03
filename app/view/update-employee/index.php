<?php

	// Admin Logged
	if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
		echo '<script>
			alert("Please login.");
			window.open("../../routes/login","_self");
		</script>';
	} elseif ($_SESSION["ulevel"]==1) {
		
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

?>

<section>
	<div class="container my-3">
		<div class="card vh-92">
			<div class="card-header">
				<div class="d-flex justify-content-between">
					<h2>Employee: Update</h2>
					<div>
						<a href="" class="btn btn-primary m-1">Reload</a>
						<a href="../../" class="btn btn-info m-1">Home</a>
						<a href="../../routes/logout" class="btn btn-dark m-1">Logout</a>
					</div>
				</div>
			</div>

			<div class="card-body scrollable">
				<?php // https://getbootstrap.com/docs/5.2/components/navs-tabs/ ?>
				<nav>
					<div class="nav nav-tabs" id="nav-tab" role="tablist">
						<button class="nav-link active" id="nav-employee-tab" data-bs-toggle="tab" data-bs-target="#nav-employee" type="button" role="tab" aria-controls="nav-employee" aria-selected="true">Employee</button>
						<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
						<button class="nav-link" id="nav-user-tab" data-bs-toggle="tab" data-bs-target="#nav-user" type="button" role="tab" aria-controls="nav-user" aria-selected="false">User</button>
					</div>
				</nav>

				<div class="tab-content" id="nav-tabContent">
					<div class="tab-pane fade show active" id="nav-employee" role="tabpanel" aria-labelledby="nav-employee-tab" tabindex="0">
						<div id="" class="table-responsive-lg mt-3">
							<table id="listRecView" class="table table-striped table-hover table-sm">
								<thead id="remSortH">
									<tr>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown d-none"></th>
										<th></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
										<th class="remove-dropdown"></th>
									</tr>
								</thead>

								<thead id="theadtitle" class="thead-dark">
									<tr>
										<th>Select</th>
										<th class="d-none"></th>
										<th>No.</th>
										<th>Bio Location</th>
										<th>Bio.#</th>
										<th>Emp. ID</th>
										<th>Employee</th>
										<th>Office#</th>
										<th>Office</th>
										<th>Signatory</th>
										<th>PID</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>

								<tbody>
									<?php
										$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
										$qry = "SELECT * FROM employee_tbl WHERE verified=1 AND xdel=0";
										$stmt = $cnn->prepare($qry);
										$stmt->execute();
										$xno = 0;

										for($i=0; $row = $stmt->fetch(); $i++) {
											$xno++;
											$empno=$row["emp_no"];
											$empid=$row["emp_id"];
											$profileid=$row["profileid"];
											$biolocation=$row["bio_location"];
											$biono=$row["bio_no"];
											$empname=utf8_encode($row["emp_name"]);
											$officecode=$row["officecode"];
											$officename=$row["officename"];
											$signatory=$row["headofficer"];
									?>
											<tr>
												<td><input id="empidid<?php echo trim($empno); ?>" value="<?php echo trim($empno); ?>" type="checkbox" class="checkbox" name="empnoid" onclick="onlyOne(this)" data-pid="<?php echo $profileid; ?>"></td>
												<td class="d-none"><?php echo $empno; ?></td>
												<td><?php echo $xno; ?></td>
												<td><?php echo $biolocation; ?></td>
												<td><?php echo $biono; ?></td>
												<td><?php echo $empid; ?></td>
												<td><?php echo utf8_decode($empname); ?></td>
												<td><?php echo $officecode; ?></td>
												<td><?php echo $officename; ?></td>
												<td><?php echo $signatory; ?></td>
												<td><?php echo $profileid; ?></td>
												<td></td>
											</tr>
									<?php
										}
									?>
								</tbody>

								<tfoot>
									<tr>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown d-none"></td>
										<td class="remove-dropdown"></td>
										<td></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
										<td class="remove-dropdown"></td>
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

					<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">...</div>

					<div class="tab-pane fade" id="nav-user" role="tabpanel" aria-labelledby="nav-user-tab" tabindex="0">...</div>
				</div>
			</div>

			<div class="card-footer">Footer</div>
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
</section>
