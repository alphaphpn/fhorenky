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
				<div class="w-100 d-flex justify-content-center">
					<button class="btn btn-primary btn-lg m-1" data-bs-toggle="modal" data-bs-target="#mdiDokTrakAdd">Add</button>
					<a href="../../routes/doctrack-add" class="btn btn-primary btn-lg m-1">Add</a>
				</div>
	<?php
			}
		}
	?>

				<hr>

				<h4>Search for specific Tracking Number</h4>

				<form id="doktrkfmr" method="post" name="doktrkfmr" class="needs-validation" enctype="multipart/form-data" novalidate>
					<div class="form-outline mb-3">
						<div class="input-group mb-3">
							<input id="trackno" type="number" class="form-control form-control-lg" placeholder="Tracking Number" name="trackno" required>
							<button id="btnSrchDoc" type="submit" name="btnSrchDoc" class="btn btn-primary"><i class="fas fa-search"></i></button>
							<a href="../../routes/doctrack" class="btn btn-success btn-lg m-1">Reset</a>
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
								<th class="remove-dropdown"></th>
								<th></th>
								<th></th>
								<th></th>
								<th class="min-phone-l"></th>
								<th class="remove-dropdown"></th>
								<th id="inaction" class="remove-dropdown"></th>
							</tr>
						</thead>

						<thead id="theadtitle">
							<tr>
								<th>No.</th>
								<th>Type</th>
								<th>Particular(s)</th>
								<th>Office</th>
								<th>Staff</th>
								<th colspan="2" class="text-center">Status</th>
								<th>Date</th>
								<th>Action</th>
							</tr>
						</thead>

						<tbody>
						<?php
							$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

							if (isset($_POST['btnSrchDoc'])) {
								if (isset($_POST['trackno'])) {
									$stmt_doctrackdetails = $cnn->prepare("SELECT * FROM doctrack_details_tbl WHERE trackno=:trackno ORDER BY docid DESC");
									$stmt_doctrackdetails->bindParam(':trackno', $_POST['trackno']);
								} else {
									$stmt_doctrackdetails = $cnn->prepare("SELECT * FROM doctrack_details_tbl ORDER BY docid DESC");
								}
							} else {
								$stmt_doctrackdetails = $cnn->prepare("SELECT * FROM doctrack_details_tbl ORDER BY docid DESC");
							}

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
								<td><?php echo trim(strtoupper($doctype)); ?></td>
								<td><button id="doctrak-<?php echo trim($trackno); ?>" type="button" data-bs-toggle="modal" data-bs-target="#mdiDokTrakImg" class="btn" data-image="<?php echo trim($imgfile); ?>" onclick="fnDocTrakImg(id,dataset.image);"><?php echo trim($particulars); ?></button></td>
								<td><?php echo trim(strtoupper($last_officename)); ?></td>
								<td><?php echo trim(strtoupper($lastusername)); ?></td>
								<?php 
									if ($in_out=="in") {
										echo '<td class="text-primary font-bold">';
									} else {
										echo '<td class="text-danger font-bold">';
									}

									echo trim(strtoupper($in_out));
								?>
								</td>
								<td><?php echo trim(strtoupper($status)); ?></td>
								<td><?php echo date("Y-m-d h:iA", strtotime($modified)); ?></td>
								<td class="inaction d-flex justify-content-between">
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
								<td></td>
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
		<div class="modal-dialog modal-xl modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Add Document</h4>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>

				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label class="form-label">Capture Frontpage File</label>
							
							<div class="row mb-2 justify-content-center">
								<div id="disp-vid" class="col-md-6 mb-2">
									<video id="video" title="Picture" class="border w-100 h-auto" autoplay></video>
								</div>

								<div id="disp-pix" class="col-md-6 mb-2 d-none">
									<canvas id="canvas" class="border w-100 h-auto"></canvas>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col-md-12 mb-2 d-none">
									<textarea id="imgdata" class="w-100" name="imgdata"></textarea>
								</div>
							</div>

							<div class="row mb-2">
								<div class="col mb-2 text-center">
									<button id="start-camera" type="button" class="btn btn-primary">Start Camera</button>
									<button id="retake-photo" type="button" class="btn btn-warning d-none">Re-Take Photo</button>
									<button id="click-photo" type="button" class="btn btn-success d-none">Click Photo</button>
								</div>
							</div>
						</div>

						<div class="mb-3">
							<label for="filetype" class="form-label">File Type</label>
							<input id="filetype" type="text" name="filetype" class="form-control" list="filetypeList" required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
							<datalist id="filetypeList">
							<?php
								$stmtfiletype = $cnn->prepare("SELECT * FROM doctrack_details_tbl GROUP BY doctype ORDER BY doctype ASC");
								$stmtfiletype->execute();
								$resultunit = $stmtfiletype->setFetchMode(PDO::FETCH_ASSOC);
								foreach ($stmtfiletype as $row) {
									echo "<option value='".$row['doctype']."'>";
								}
							?>
							</datalist>
						</div>

						<div class="mb-3">
							<label for="particulars" class="form-label">Particular(s)</label>
							<textarea id="particulars" name="particulars" class="form-control" required></textarea>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div class="mb-3">
							<label for="" class="form-label"></label>
							<input id="" type="" name="" class="form-control" required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div class="mb-3">
							<label for="" class="form-label"></label>
							<input id="" type="" name="" class="form-control" required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<button id="submitNewDoc" type="submit" name="submitNewDoc" class="btn btn-primary">Submit</button>
					</form>
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
				}, 

				order: [[ 0, 'desc' ]]
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

		let camera_button = document.querySelector("#start-camera");
		let dispvid = document.querySelector("#disp-vid");
		let video = document.querySelector("#video");
		let retakephoto = document.querySelector("#retake-photo");
		let click_button = document.querySelector("#click-photo");
		let disppix = document.querySelector("#disp-pix");
		let canvas = document.querySelector("#canvas");
		let imgdata = document.querySelector("#imgdata");

		let videowidth = video.offsetWidth;
		let videoheight = video.offsetHeight;

		camera_button.addEventListener('click', async function() {
			let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
			video.srcObject = stream;

			camera_button.classList.add("d-none");
			click_button.classList.remove('d-none');
		});

		click_button.addEventListener('click', async function() {
			disppix.classList.remove('d-none');

			canvas.getContext('2d').drawImage(video, 0, 0, videowidth, videoheight);
			canvas.style.width = videowidth+'px';
			canvas.style.height = videoheight+'px';
			let image_data_url = canvas.toDataURL('image/jpeg');

			// data url of the image
			console.log(image_data_url);
			imgdata.value = image_data_url;

			retakephoto.classList.remove('d-none');
			click_button.classList.add('d-none');
		});

		retakephoto.addEventListener('click', async function() {
			disppix.classList.add('d-none');

			camera_button.classList.add("d-none");
			retakephoto.classList.add('d-none');
			click_button.classList.remove('d-none');
		});
	</script>