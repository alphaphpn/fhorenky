<?php
	$cnn_totalvotez = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_totalvotez = $cnn_totalvotez->prepare("SELECT COUNT(regvoteno) AS totalvotez FROM comelec_voters");
	$stmt_totalvotez->execute();
	$result_totalvotez = $stmt_totalvotez->setFetchMode(PDO::FETCH_ASSOC);
	foreach ($stmt_totalvotez as $row_totalvotez) {
		$totalvotez = number_format(trim($row_totalvotez["totalvotez"]));
	}

	$cnn_nvote1 = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_nvote1 = $cnn_nvote1->prepare("SELECT COUNT(regvoteno) AS noregvot1 FROM comelec_voters WHERE district_no=1");
	$stmt_nvote1->execute();
	$result_nvote1 = $stmt_nvote1->setFetchMode(PDO::FETCH_ASSOC);
	foreach ($stmt_nvote1 as $row_nvote1) {
		$nmbregvot1 = number_format(trim($row_nvote1["noregvot1"]));
	}

	$cnn_nvote2 = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_nvote2 = $cnn_nvote2->prepare("SELECT COUNT(regvoteno) AS noregvot2 FROM comelec_voters WHERE district_no=2");
	$stmt_nvote2->execute();
	$result_nvote2 = $stmt_nvote2->setFetchMode(PDO::FETCH_ASSOC);
	foreach ($stmt_nvote2 as $row_nvote2) {
		$nmbregvot2 = number_format(trim($row_nvote2["noregvot2"]));
	}
?>

					<!-- Start here -->
					<div class="mb-5">
						<div class="d-flex justify-content-between">
							<h2><?php echo $page_title; ?> <span class="font-size-22">as of 2023</span></h2>
							<label class="font-size-22 text-primary">Registered Voter's: <b class="text-danger"><?php echo $totalvotez; ?></b></label>
						</div>
						<p><?php echo $breadcrumb; ?></p>            
						
						<div class="row">
							<div class="col-lg-6">
								<h4>District I | <b class="text-danger"><?php echo $nmbregvot1; ?></b></h4>
								<table class="table table-dark table-striped table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Zip Code</th>
											<th>Town/Municipal</th>
											<th>Registered Voter's</th>
										</tr>
									</thead>

									<tbody>
									<?php
										$cnn_towninfo = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

										$qry_towninfo = "SELECT zipcode,town,precinct,district_no,COUNT(regvoteno) AS noregvot FROM comelec_voters WHERE district_no=1 GROUP BY town ORDER BY district_no,zipcode ASC";
										$stmt_towninfo = $cnn_towninfo->prepare($qry_towninfo);
										$stmt_towninfo->execute();
										$xno_towninfo = 0;

										for($i=0; $row_towninfo = $stmt_towninfo->fetch(); $i++) {
											$xno_towninfo++;
											$zipcode=$row_towninfo["zipcode"];
											$town=$row_towninfo["town"];
											$district_no=$row_towninfo["district_no"];
											$noregvot=$row_towninfo["noregvot"];
									?>
										<tr>
											<td><?php echo trim($xno_towninfo); ?></td>
											<td><?php echo trim($zipcode); ?></td>
											<td><?php echo trim($town); ?></td>
											<td class="font-size-22"><?php echo number_format(trim($noregvot)); ?></td>
										</tr>
									<?php
										}
									?>
									</tbody>
								</table>
							</div>

							<div class="col-lg-6">
								<h4>District II | <b class="text-danger"><?php echo $nmbregvot2; ?></b></h4>
								<table class="table table-dark table-striped table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Zip Code</th>
											<th>Town/Municipal</th>
											<th>Registered Voter's</th>
										</tr>
									</thead>

									<tbody>
									<?php
										$cnn_towninfo2 = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

										$qry_towninfo2 = "SELECT zipcode,town,precinct,district_no,COUNT(regvoteno) AS noregvot FROM comelec_voters WHERE district_no=2 GROUP BY town ORDER BY district_no,zipcode ASC";
										$stmt_towninfo2 = $cnn_towninfo2->prepare($qry_towninfo2);
										$stmt_towninfo2->execute();
										$xno_towninfo2 = 0;

										for($i2=0; $row_towninfo2 = $stmt_towninfo2->fetch(); $i2++) {
											$xno_towninfo2++;
											$zipcode2=$row_towninfo2["zipcode"];
											$town2=$row_towninfo2["town"];
											$district_no2=$row_towninfo2["district_no"];
											$noregvot2=$row_towninfo2["noregvot"];
									?>
										<tr>
											<td><?php echo trim($xno_towninfo2); ?></td>
											<td><?php echo trim($zipcode2); ?></td>
											<td><?php echo trim($town2); ?></td>
											<td class="font-size-22"><?php echo number_format(trim($noregvot2)); ?></td>
										</tr>
									<?php
										}
									?>
									</tbody>
								</table>
							</div>
						</div>
					</div>