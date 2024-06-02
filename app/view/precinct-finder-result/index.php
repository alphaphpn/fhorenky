<?php
	$vulevel = isset($vulevel) ? $vulevel : 0;
?>

					<!-- Start here -->
					<div class="m-3 text-center">
						<a href="../../routes/precinct-finder" class="btn btn-danger">Search again</a>
					</div>

					<div class="mb-5">
						<div class="table-responsive-lg mt-3 overflow-auto">
							<table id="listRecView" class="table table-striped table-hover table-sm">
								<thead id="remSortH">
									<tr>
										<th data-number="1" data-type="Number" class="remove-dropdown"></th>
										<th data-number="2" data-type="ID" class="remove-dropdown"></th>
										<th data-number="3" data-type="Legend"></th>
										<th data-number="4" data-type="Name" class="remove-dropdown"></th>
										<th data-number="5" data-type="Town"></th>
										<th data-number="7" data-type="Barangay" class="remove-dropdown"></th>
										<th data-number="8" data-type="Precinct"></th>
										<th data-number="6" data-type="Address" class="remove-dropdown"></th>
										<th data-number="11" data-type="Deceased" class="remove-dropdown"></th>
										<th data-number="12" data-type="VID" class="remove-dropdown"></th>
										<th data-number="13" data-type="Action" class="remove-dropdown"></th>
									</tr>
								</thead>
							
								<thead id="theadtitle" class="thead-dark">
									<tr>
										<th data-number="1" data-type="Number">No.</th>
										<th data-number="2" data-type="ID">ID</th>
										<th data-number="3" data-type="Legend">Legend</th>
										<th data-number="4" data-type="Name">Name</th>
										<th data-number="5" data-type="Town">Municipality</th>
										<th data-number="7" data-type="Barangay">Barangay</th>
										<th data-number="8" data-type="Precinct">Precinct</th>
										<th data-number="6" data-type="Address">Address</th>
										<th data-number="11" data-type="Deceased">Deceased</th>
										<th data-number="12" data-type="VID">Voter's ID</th>
										<th data-number="13" data-type="Action" class="text-right">Action</th>
									</tr>
								</thead>

								<tbody>
								<?php
									$votersname = isset($_GET['votersname']) ? $_GET['votersname'] : '';

									$cnn_votelist = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$qry_votelist = "SELECT * FROM comelec_voters WHERE voters LIKE CONCAT('%',:votersname,'%') ORDER BY district_no,zipcode,town,barangay,precinct DESC";
									$stmt_votelist = $cnn_votelist->prepare($qry_votelist);
									$stmt_votelist->bindParam(':votersname', $votersname);
									$stmt_votelist->execute();
									$xno_votelist = 0;

									for($i=0; $row_votelist = $stmt_votelist->fetch(); $i++) {
										$xno_votelist++;
										$regvoteno=$row_votelist["regvoteno"];
										$vid=$row_votelist["vid"];
										$legend=$row_votelist["legend"];
										$voters=utf8_encode($row_votelist["voters"]);
										$town=$row_votelist["town"];
										$address=$row_votelist["address"];
										$barangay=$row_votelist["barangay"];
										$precinct=$row_votelist["precinct"];
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
											$xverifclass="danger";
										}

										if ($selected==1) {
											$xselected=1;
											$xselectedlabel="Selected";
											$xselectedclass="success";
										} else {
											$xselected=0;
											$xselectedlabel="Select";
											$xselectedclass="warning";
										}
								?>
									<tr>
										<td data-number="1"><?php echo trim($xno_votelist); ?></td>
										<td data-number="2"><?php echo trim($regvoteno); ?></td>
										<td data-number="3"><?php echo trim($legend); ?></td>
										<td data-number="4"><?php echo trim($voters); ?></td>
										<td data-number="5"><?php echo trim($town); ?></td>
										<td data-number="7"><?php echo trim($barangay); ?></td>
										<td data-number="8"><?php echo trim($precinct); ?></td>
										<td data-number="6"><?php echo trim($address); ?></td>
										<td data-number="11"><?php echo trim($deceased); ?></td>
										<td data-number="12"><?php echo trim($vid); ?></td>
										<td data-number="13">
										<?php
											if ($vulevel==1 || $vulevel==99 || $vulevel==14) {
										?>
											<a href="#" class="btn btn-<?php echo trim($xverifclass); ?> btn-sm"><?php echo trim($xveriflabel); ?></a>
											<a href="#" class="btn btn-<?php echo trim($xselectedclass); ?> btn-sm"><?php echo trim($xselectedlabel); ?></a>
										<?php
											} else {
										?>
											<a href="../../routes/precinct-voter/?rgvid=<?php echo $regvoteno; ?>" class="btn btn-primary btn-sm" target="_blank">Print ID</a>
											<button class="btn btn-secondary btn-sm">Report</button>
										<?php
											}
										?>
										</td>
									</tr>
								<?php
									}
								?>
								</tbody>

								<tfoot>
									<tr>
										<td data-number="1" data-type="Number" class="remove-dropdown"></td>
										<td data-number="2" data-type="ID" class="remove-dropdown"></td>
										<td data-number="3" data-type="Legend"></td>
										<td data-number="4" data-type="Name" class="remove-dropdown"></td>
										<td data-number="5" data-type="Town"></td>
										<td data-number="7" data-type="Barangay" class="remove-dropdown"></td>
										<td data-number="8" data-type="Precinct"></td>
										<td data-number="6" data-type="Address" class="remove-dropdown"></td>
										<td data-number="11" data-type="Deceased" class="remove-dropdown"></td>
										<td data-number="12" data-type="VID" class="remove-dropdown"></td>
										<td data-number="13" data-type="Action" class="remove-dropdown"></td>
									</tr>
								</tfoot>
							</table>
						</div>

						<div id="trnsfrPaginate" class="dataTables_wrapper"></div>
						<div id="demo"></div>
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