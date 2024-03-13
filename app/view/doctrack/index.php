	<canvas id="particle-animate" style="position: fixed; overflow: hidden; width: 100%; height: 100vh;"></canvas>

<?php
	include_once "../../app/theme/default/navbar.php";
	// include_once "../../app/theme/default/hero-banner.php";
?>

	<section class="position-relative w-100">
		<div class="container-fluid">
			<div class="bg-white p-3 my-3">
				<h2 class="w-100 text-center">Document Tracking Module</h2>

	<?php
		if (isset($_SESSION["ulevel"])) {
			if ($_SESSION["ulevel"]==1 || $_SESSION["ulevel"]==2 || $_SESSION["ulevel"]==3 || $_SESSION["ulevel"]==4 || $_SESSION["ulevel"]==5 || $_SESSION["ulevel"]==6 || $_SESSION["ulevel"]==7 || $_SESSION["ulevel"]==16 || $_SESSION["ulevel"]==20 || $_SESSION["ulevel"]==21) {
	?>
				<hr>
				<div class="w-100 d-flex">
					<button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#mdiDokTrakAdd">Add</button>
				</div>
	<?php
			}
		}
	?>

				<hr>

				<h4>Search for specific Tracking Number</h4>

				<form id="doktrkfmr" method="post" class="needs-validation" novalidate>
					<div class="form-outline mb-3">
						<div class="input-group mb-3">
							<input id="trackno" type="number" class="form-control form-control-lg" placeholder="Tracking Number" name="trackno" required>
							<button id="btnSrchDoc" type="submit" name="btnSrchDoc" class="btn btn-primary"><i class="fas fa-search"></i></button>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>
					</div>
				</form>

				<hr>

				<h4>List of Document(s)</h4>
				<div class="table-responsive-lg scrollable">
					<table id="listRecView" class="table table-striped table-hover">
						<thead id="remSortH">
							<tr>
								<th class="remove-dropdown"></th>
								<th></th>
								<th></th>
								<th></th>
								<th class="remove-dropdown"></th>
								<th class="remove-dropdown"></th>
								<th class="remove-dropdown"></th>
								<th></th>
								<th></th>
								<th></th>
								<th class="remove-dropdown"></th>
								<th class="remove-dropdown"></th>
							</tr>
						</thead>

						<thead id="theadtitle">
							<tr>
								<th>DocTrack#</th>
								<th colspan="2">Status</th>
								<th>Type</th>
								<th>Particular(s)</th>
								<th>Name</th>
								<th>Amount</th>
								<th>Office</th>
								<th>In/Out Office</th>
								<th>Staff</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
							$stmt_doctrackdetails = $cnn->prepare("SELECT * FROM doctrack_details_tbl ORDER BY docid DESC");
							$stmt_doctrackdetails->execute();
							$nmbrdoctrackdetails = $stmt_doctrackdetails->rowCount();
				
							if ( $nmbrdoctrackdetails > 0 ) {
								$xnodoctrackdetails = 0;

								for($i=0; $row = $stmt_doctrackdetails->fetch(); $i++) {
									$xnodoctrackdetails++;
									$trackno=$row["trackno"];
									$status=$row["status"];
									$in_out=$row["in_out"];
									$doctype=$row["doctype"];

									if (isset($_SESSION["ulevel"])) {
										if ($_SESSION["ulevel"]==1 || $_SESSION["ulevel"]==2 || $_SESSION["ulevel"]==3 || $_SESSION["ulevel"]==4 || $_SESSION["ulevel"]==5 || $_SESSION["ulevel"]==6 || $_SESSION["ulevel"]==7 || $_SESSION["ulevel"]==16 || $_SESSION["ulevel"]==20 || $_SESSION["ulevel"]==21) {
											if (empty($row["imgfile"])) {
												$imgfile="../../assets/img/no-image.jpg";
											} else {
												$imgfile=$row["imgfile"];
											}
										} else {
											$imgfile="../../assets/img/no-image.jpg";
										}
									} else {
										$imgfile="../../assets/img/no-image.jpg";
									}
									
									$particulars=$row["particulars"];
									$remarks=$row["remarks"];
									$docamt=$row["docamt"];
									$docfile=$row["docfile"];
									$pname=$row["pname"];
									$doc_office=$row["doc_office"];

									$officecode=$row["officecode"];
									$officename=$row["officename"];
									$officetitle=$row["officetitle"];
									$officeabrv=$row["officeabrv"];

									$last_officecode=$row["last_officecode"];
									$last_officename=$row["last_officename"];
									$last_officetitle=$row["last_officetitle"];
									$last_officeabrv=$row["last_officeabrv"];

									$lastuserid=$row["lastuserid"];
									$lastusername=$row["lastusername"];

									$entrybyid=$row["entrybyid"];
									$entryby=$row["entryby"];
									$entrydate=$row["entrydate"];
									$modified=$row["modified"];
						?>
							<tr>
								<td><?php echo trim($trackno); ?></td>
								<td><?php echo trim($in_out); ?></td>
								<td><?php echo trim($status); ?></td>
								<td><?php echo trim($doctype); ?></td>
								<td><button id="doctrak-<?php echo trim($trackno); ?>" type="button" data-bs-toggle="modal" data-bs-target="#mdiDokTrakImg" class="btn" data-image="<?php echo trim($imgfile); ?>" onclick="fnDocTrakImg(id,dataset.image);"><?php echo trim($particulars); ?></button></td>
								<td><?php echo trim($pname); ?></td>
								<td><?php echo trim($docamt); ?></td>
								<td><?php echo trim($officename); ?></td>
								<td><?php echo trim($last_officename); ?></td>
								<td><?php echo trim($lastusername); ?></td>
								<td><?php echo trim($modified); ?></td>
								<td>
					<?php
						if (isset($_SESSION["ulevel"])) {
							if ($_SESSION["ulevel"]==1 || $_SESSION["ulevel"]==2 || $_SESSION["ulevel"]==3 || $_SESSION["ulevel"]==4 || $_SESSION["ulevel"]==5 || $_SESSION["ulevel"]==6 || $_SESSION["ulevel"]==7 || $_SESSION["ulevel"]==16 || $_SESSION["ulevel"]==20 || $_SESSION["ulevel"]==21) {
								if ($in_out=="in") {
					?>
									<button type="button" data-bs-toggle="modal" data-bs-target="#mdiDokTrakOut" class="btn btn-warning btn-sm m-1">Out</button>
					<?php
								} else {
					?>
									<button type="button" data-bs-toggle="modal" data-bs-target="#mdiDokTrakIn" class="btn btn-primary btn-sm m-1">In</button>
					<?php
								}
							}
						}
					?>
									<a href="../../routes/doctrack-info" class="btn btn-info btn-sm m-1">Info</a>
									<a href="../../routes/doctrack-log" class="btn btn-danger btn-sm m-1">Logs</a>
								</td>
							</tr>
						<?php
								}
							} else {
						?>
							<tr>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
								<td>Xxxx</td>
							</tr>
						<?php
							}
						?>
						</tbody>

						<tfoot>
							<tr>
								<td class="remove-dropdown"></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="remove-dropdown"></td>
								<td class="remove-dropdown"></td>
								<td class="remove-dropdown"></td>
								<td></td>
								<td></td>
								<td></td>
								<td class="remove-dropdown"></td>
								<td class="remove-dropdown"></td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>

	<!-- File Image Captured -->
	<div class="modal fade" id="mdiDokTrakImg">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 id="modaltitle" class="modal-title">File Captured: </h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body"><img id="vwimgfrmfile" class="w-100 h-100"></div>

				<div class="modal-footer">
					<button id="btnCloseZ" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Add Document -->
	<div class="modal fade" id="mdiDokTrakAdd">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Document</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<input id="" type="text" name="" placeholder="" class="" required>
				</div>

				<div class="modal-footer">
					<button id="btnCloseDokTrakAdd" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Incoming Document -->
	<div class="modal fade" id="mdiDokTrakIn">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Incoming Document</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<input id="" type="text" name="" placeholder="" class="" required>
				</div>

				<div class="modal-footer">
					<button id="btnCloseDokTrakIn" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Outgoing Document -->
	<div class="modal fade" id="mdiDokTrakOut">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Outgoing Document</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<input id="" type="text" name="" placeholder="" class="" required>
				</div>

				<div class="modal-footer">
					<button id="btnCloseDokTrakOut" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

		function fnDocTrakImg(id,ximage) {
			document.getElementById("vwimgfrmfile").src = ximage;
		}
	</script>