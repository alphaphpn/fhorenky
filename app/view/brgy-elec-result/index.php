<?php

	// Coordinator Account
	if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
		// echo '<script>alert("Access denied!");window.open("../../routes/login","_self");</script>';
		header("Location: ../../routes/login");
		exit;
	} elseif ($_SESSION["ulevel"]==1) {

	} elseif ($_SESSION["ulevel"]==14 && $_SESSION["ustat"]==1 && $_SESSION["verified"]==1 && $_SESSION["xdel"]==0) {
		
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
		// echo '<script>alert("Access denied! Only Authorized account is allowed.");window.open("../../routes/login","_self");</script>';
		header("Location: ../../routes/login");
		exit;
	}

	$halalan = trim('10/30/2023');
	$probinsyal = trim('Zamboanga Sibugay');

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

		if (isset($_GET['barangay']) && isset($_GET['municipal'])) {
			$brgy = trim($_GET['barangay']);
			$town = trim($_GET['municipal']);
			$zpcod = trim($_GET['zipcode']);
			$distrct = trim($_GET['district']);
			$rgvote = trim($_GET['regvote']);
			$calcregvote = $rgvote / 2;
			$fifperct = 50;

			/** Check if Barangay Exist, auto Add to list of Barangay - Start **/
			$stmt_existbrgy = $cnn->prepare("SELECT * FROM barangay_tbl WHERE barangay=:barangay AND zipcode=:zipcode");
			$stmt_existbrgy->bindParam(':barangay', $brgy);
			$stmt_existbrgy->bindValue(':zipcode', $zpcod);
			$stmt_existbrgy->execute();
			$nmbr_existbrgy = $stmt_existbrgy->rowCount();

			if ($nmbr_existbrgy==0) {
				$qry_insert_barangay = "INSERT INTO barangay_tbl SET 
					barangay=:barangay, 
					zipcode=:zipcode, 
					municipal=:municipal, 
					province=:province, 
					district=:district
				";
				$stmt_barangays = $cnn->prepare($qry_insert_barangay);
				$stmt_barangays->bindParam(':barangay', $brgy);
				$stmt_barangays->bindValue(':zipcode', $zpcod);
				$stmt_barangays->bindParam(':municipal', $town);
				$stmt_barangays->bindParam(':province', $probinsyal);
				$stmt_barangays->bindParam(':district', $distrct);
				$stmt_barangays->execute();

				echo '<script>alert("New Barangay Added to the List.")</script>';
			}
			/** Check if Barangay Exist, auto Add to list of Barangay - End **/

			$stmt_brgyelection = $cnn->prepare("SELECT * FROM brgy_elec_tbl WHERE barangay=:barangay AND municipality=:municipality");
			$stmt_brgyelection->bindParam(':barangay', $brgy);
			$stmt_brgyelection->bindParam(':municipality', $town);
			$stmt_brgyelection->execute();

			$cnt_brgyelection = $stmt_brgyelection->rowCount();

			if ($cnt_brgyelection==0) {
				$berid = null;
				$elecdate = $halalan;
				$barangay = $brgy;
				$municipal = $town;
				$zipcode = $zpcod;
				$province = $probinsyal;
				$district = $distrct;
				$registeredvoters = $rgvote;

				$kapitancounts = null;
				$kapitanvotesquota = null;
				$kapitanpercentagequota = null;
				$kapitalactualvoters = null;
				$kapitandidnotvote = null;
				$kagawadvotesquota = null;
				$kagawadpercentagequota = null;
				$kagawadactualvoters = null;
				$kagawaddidnotvote = null;
				$skchaircounts = null;
				$skchairvotesquota = null;
				$skchairpercentagequota = null;
				$skchairactualvoters = null;
				$skchairdidnotvote = null;

				echo '<script>alert("No Record Found!")</script>';

				$qry_insert_brgyelection = "INSERT INTO brgy_elec_tbl SET 
					barangay=:barangay, 
					municipality=:municipality, 
					elec_date=:elecdate, 
					zipcode=:zipcode, 
					district=:district, 
					province=:province, 
					registered_voters=:registeredvoters, 
					kapitan_votes_quota=:kapitanvotesquota, 
					kapitan_percentage_quota=:kapitanpercentagequota, 
					kagawad_votes_quota=:kagawadvotesquota, 
					kagawad_percentage_quota=:kagawadpercentagequota, 
					sk_chair_votes_quota=:skchairvotesquota, 
					sk_chair_percentage_quota=:skchairpercentagequota
				";
				$stmt_insert_brgyelection = $cnn->prepare($qry_insert_brgyelection);
				$stmt_insert_brgyelection->bindParam(':barangay', $barangay);
				$stmt_insert_brgyelection->bindParam(':municipality', $municipal);
				$stmt_insert_brgyelection->bindParam(':elecdate', $halalan);
				$stmt_insert_brgyelection->bindValue(':zipcode', $zipcode);
				$stmt_insert_brgyelection->bindParam(':district', $district);
				$stmt_insert_brgyelection->bindParam(':province', $province);
				$stmt_insert_brgyelection->bindValue(':registeredvoters', $registeredvoters);

				$stmt_insert_brgyelection->bindValue(':kapitanvotesquota', $calcregvote);
				$stmt_insert_brgyelection->bindValue(':kapitanpercentagequota', $fifperct);
				$stmt_insert_brgyelection->bindValue(':kagawadvotesquota', $calcregvote);
				$stmt_insert_brgyelection->bindValue(':kagawadpercentagequota', $fifperct);
				$stmt_insert_brgyelection->bindValue(':skchairvotesquota', $calcregvote);
				$stmt_insert_brgyelection->bindValue(':skchairpercentagequota', $fifperct);

				$stmt_insert_brgyelection->execute();

				echo '<script>alert("New Record Saved!")</script>';

			} else {
				$row_brgyelection = $stmt_brgyelection->fetch(PDO::FETCH_ASSOC);

				$berid = $row_brgyelection['berno'];
				$elecdate = $row_brgyelection['elec_date'];
				$barangay = $row_brgyelection['barangay'];
				$municipal = $row_brgyelection['municipality'];
				$zipcode = $row_brgyelection['zipcode'];
				$province = $row_brgyelection['province'];
				$district = $row_brgyelection['district'];
				$registeredvoters = $row_brgyelection['registered_voters'];

				$kapitancounts = $row_brgyelection['kapitan_counts'];
				$kapitanvotesquota = $row_brgyelection['kapitan_votes_quota'];
				$kapitanpercentagequota = $row_brgyelection['kapitan_percentage_quota'];
				$kapitalactualvoters = $row_brgyelection['kapital_actual_voters'];
				$kapitandidnotvote = $row_brgyelection['kapitan_didnot_vote'];
				$kagawadvotesquota = $row_brgyelection['kagawad_votes_quota'];
				$kagawadpercentagequota = $row_brgyelection['kagawad_percentage_quota'];
				$kagawadactualvoters = $row_brgyelection['kagawad_actual_voters'];
				$kagawaddidnotvote = $row_brgyelection['kagawad_didnot_vote'];
				$skchaircounts = $row_brgyelection['sk_chair_counts'];
				$skchairvotesquota = $row_brgyelection['sk_chair_votes_quota'];
				$skchairpercentagequota = $row_brgyelection['sk_chair_percentage_quota'];
				$skchairactualvoters = $row_brgyelection['sk_chair_actual_voters'];
				$skchairdidnotvote = $row_brgyelection['sk_chair_didnot_vote'];

				// if ($row_brgyelection['registered_voters']!=$rgvote) {
				// 	$brgy = trim($_GET['barangay']);
				// 	$town = trim($_GET['municipal']);
				// 	$zpcod = trim($_GET['zipcode']);
				// 	$distrct = trim($_GET['district']);
				// 	$rgvote = trim($_GET['regvote']);

				// 	echo '<script>alert("Not Equal Registered Votes.")</script>';

				// 	$qry_update_brgyelection = "UPDATE brgy_elec_tbl SET 
				// 		registered_voters=:registeredvoters 
				// 		WHERE 
				// 		barangay=:barangay AND 
				// 		zipcode=:zipcode
				// 	";
				// 	$stmt_update_brgyelection = $cnn->prepare($qry_update_brgyelection);
				// 	$stmt_update_brgyelection->bindParam(':barangay', $brgy);
				// 	$stmt_update_brgyelection->bindValue(':zipcode', $zpcod);
				// 	$stmt_update_brgyelection->bindValue(':registeredvoters', $rgvote);
				// 	$stmt_update_brgyelection->execute();

				// 	$registeredvoters = $rgvote;
				// }
			}
		} elseif (isset($_GET['delme']) && isset($_GET['idid'])) {
			$truedel = $_GET['delme'];
			$ididme = $_GET['idid'];

			if ($truedel==1) {
				$qry_delete_aspirant = "DELETE FROM brgy_elec_aspirants_tbl WHERE sub_berno=:subberno";
				$stmt_delete_aspirant = $cnn->prepare($qry_delete_aspirant);
				$stmt_delete_aspirant->bindParam(':subberno', $ididme);
				$stmt_delete_aspirant->execute();

				echo '<script>alert("Aspirant Successfully Deleted.")</script>';
				header("Location: ../../routes/brgy-elec-result");
			}
		} else {
			$stmt_brgyelection = $cnn->prepare("SELECT * FROM brgy_elec_tbl ORDER BY berno DESC");
			$stmt_brgyelection->execute();
			$nmbr_brgyelection = $stmt_brgyelection->rowCount();
			$row_brgyelection = $stmt_brgyelection->fetch(PDO::FETCH_ASSOC);

			if ($nmbr_brgyelection==0) {
				$berid = null;
				$elecdate = $halalan;
				$barangay = null;
				$municipal = null;
				$zipcode = null;
				$province = $probinsyal;
				$district = null;
				$registeredvoters = null;

				$kapitancounts = null;
				$kapitanvotesquota = null;
				$kapitanpercentagequota = null;
				$kapitalactualvoters = null;
				$kapitandidnotvote = null;
				$kagawadvotesquota = null;
				$kagawadpercentagequota = null;
				$kagawadactualvoters = null;
				$kagawaddidnotvote = null;
				$skchaircounts = null;
				$skchairvotesquota = null;
				$skchairpercentagequota = null;
				$skchairactualvoters = null;
				$skchairdidnotvote = null;
			} else {
				$berid = $row_brgyelection['berno'];
				$elecdate = $row_brgyelection['elec_date'];
				$barangay = $row_brgyelection['barangay'];
				$municipal = $row_brgyelection['municipality'];
				$zipcode = $row_brgyelection['zipcode'];
				$province = $row_brgyelection['province'];
				$district = $row_brgyelection['district'];
				$registeredvoters = $row_brgyelection['registered_voters'];

				$kapitancounts = $row_brgyelection['kapitan_counts'];
				$kapitanvotesquota = $row_brgyelection['kapitan_votes_quota'];
				$kapitanpercentagequota = $row_brgyelection['kapitan_percentage_quota'];
				$kapitalactualvoters = $row_brgyelection['kapital_actual_voters'];
				$kapitandidnotvote = $row_brgyelection['kapitan_didnot_vote'];
				$kagawadvotesquota = $row_brgyelection['kagawad_votes_quota'];
				$kagawadpercentagequota = $row_brgyelection['kagawad_percentage_quota'];
				$kagawadactualvoters = $row_brgyelection['kagawad_actual_voters'];
				$kagawaddidnotvote = $row_brgyelection['kagawad_didnot_vote'];
				$skchaircounts = $row_brgyelection['sk_chair_counts'];
				$skchairvotesquota = $row_brgyelection['sk_chair_votes_quota'];
				$skchairpercentagequota = $row_brgyelection['sk_chair_percentage_quota'];
				$skchairactualvoters = $row_brgyelection['sk_chair_actual_voters'];
				$skchairdidnotvote = $row_brgyelection['sk_chair_didnot_vote'];
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}
?>

	<section id="bry-elec-result">
		<div class="container py-3">
			<form id="brgy-elect-frm" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
				<div class="card vh-92">
					<div class="card-header">
						<div class="row">
							<div class="col"><h2>Barangay Election Result - <?php echo trim($halalan); ?></h2></div>
						</div>
						
						<div class="row">
							<div class="col-md-4">
								<div class="input-group my-1">
									<span class="input-group-text">Barangay:</span>
									<input list="brgylists" id="barangay" name="barangay" type="text" class="form-control" placeholder="Barangay" value="<?php echo $barangay; ?>" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>

									<datalist id="brgylists">
										<?php
											$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
											$stmt_barangaylist = $cnn->prepare("SELECT * FROM barangay_tbl GROUP BY barangay ORDER BY barangay ASC");
											$stmt_barangaylist->execute();
											$result_barangaylist = $stmt_barangaylist->setFetchMode(PDO::FETCH_ASSOC);
											foreach ($stmt_barangaylist as $row_barangaylist) {
												$brgyname = $row_barangaylist['barangay'];
												echo "<option id='brgy".$row_barangaylist['brgyid']."' value='".utf8_decode($brgyname)."' data-zipcode='".$row_barangaylist['zipcode']." data-municipal='".$row_barangaylist['municipal']." data-district='".$row_barangaylist['district']."'></option>";
											}
										?>
									</datalist>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group my-1">
									<span class="input-group-text">Municipal:</span>
									<input list="municipallists" id="municipal" name="municipal" type="text" class="form-control" placeholder="Municipal" value="<?php echo $municipal; ?>" required>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>

									<datalist id="municipallists">
										<?php
											$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
											$stmt_municipallist = $cnn->prepare("SELECT * FROM municipal_tbl");
											$stmt_municipallist->execute();
											$result_municipallist = $stmt_municipallist->setFetchMode(PDO::FETCH_ASSOC);
											foreach ($stmt_municipallist as $row_municipallist) {
												echo "<option id='".$row_municipallist['zipcode']."' value='".htmlspecialchars($row_municipallist['municipal'])."' data-province='".htmlspecialchars($row_municipallist['province'])."' data-district='".htmlspecialchars($row_municipallist['district'])."'></option>";
											}
										?>
									</datalist>
								</div>
							</div>
							<div class="col-md-4">
								<div class="input-group my-1">
									<span class="input-group-text">Registered Voter's:</span>
									<input id="reg-vote" name="reg-vote" type="number" min="1" class="form-control" value="<?php echo $registeredvoters; ?>" placeholder="Registered Voter's">
								</div>
							</div>
						</div>

						<div class="row" hidden>
							<div class="col-6">
								<div class="input-group my-1">
									<span class="input-group-text">ZIP Code:</span>
									<input type="number" id="zipcode" name="zipcode" min="1000" class="form-control" value="<?php echo $zipcode; ?>" placeholder="ZIP CODE" required readonly>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
							</div>

							<div class="col-6">
								<div class="input-group my-1">
									<span class="input-group-text">Province:</span>
									<input type="text" id="province" name="province" class="form-control" placeholder="Province" value="<?php echo $province; ?>" required readonly>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
							</div>

							<div class="col-6">
								<div class="input-group my-1">
									<span class="input-group-text">District:</span>
									<input type="text" id="district" name="district" class="form-control" placeholder="District" value="<?php echo $district; ?>" required readonly>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
								</div>
							</div>

							<div class="col-6">
								<div class="input-group my-1">
									<span class="input-group-text">BER No.:</span>
									<input type="number" id="berno" name="berno" min="1" class="form-control" placeholder="BER No." value="<?php echo $berid; ?>" readonly>
								</div>
							</div>
						</div>
					</div>

					<div class="card-body scrollable">
						<!-- Kapitan -->
						<div id="brgy-capitan" class="card py-3 my-3">
							<div class="card-body scrollable">
								<div class="d-flex justify-content-between">
									<h5>Kapitan</h5>
									<button type="button" class="btn btn-outline-primary" data-position="Kapitan" data-zip="<?php echo trim($zipcode); ?>" data-brgy="<?php echo trim($barangay); ?>" data-distrito="<?php echo trim($district); ?>" data-probinsya="<?php echo trim($province); ?>" data-town="<?php echo trim($municipal); ?>" data-bs-toggle="modal" data-bs-target="#mdiAddEditAspirant" onclick="fnAddAspirant(dataset.position,dataset.brgy,dataset.town,dataset.probinsya,dataset.distrito,dataset.zip)">Add Kapitan</button>
								</div>
								
								<div class="row">
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Min. Votes:</span>
											<input type="number" class="form-control" value="<?php echo $kapitanvotesquota; ?>" placeholder="Votes Quota" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Min.%:</span>
											<input type="number" class="form-control" value="<?php echo $kapitanpercentagequota; ?>" placeholder="% Quota" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Actual Voter's:</span>
											<input type="number" class="form-control" value="<?php echo $kapitalactualvoters; ?>" placeholder="Actual Voter's" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Did Not Vote:</span>
											<input type="number" class="form-control" value="<?php echo $kapitandidnotvote; ?>" placeholder="Did Not Vote" readonly>
										</div>
									</div>
								</div>
								<hr>
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Aspirant</th>
											<th>#Votes</th>
											<th>%</th>
											<th align="right" class="text-end">Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$brgy_aspire = $barangay;
											$zpcod_aspire = $zipcode;
											$aspire_position = trim('Kapitan');

											$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

											$stmt_kapitan = $cnn->prepare("SELECT * FROM brgy_elec_aspirants_tbl WHERE 
												barangay=:barangay AND zipcode=:zipcode AND position=:position ORDER BY no_votes DESC");
											$stmt_kapitan->bindParam(':barangay', $brgy_aspire);
											$stmt_kapitan->bindValue(':zipcode', $zpcod_aspire);
											$stmt_kapitan->bindParam(':position', $aspire_position);
											$stmt_kapitan->execute();
											$nmbr_kapitan = $stmt_kapitan->rowCount();

											if ($nmbr_kapitan==0) {
												$devidergvote_kapitan = $registeredvoters / 2;
												$perctvote_kapitan = 100 / 2;
											} else {
												$devidergvote_kapitan = $registeredvoters / $nmbr_kapitan;
												$perctvote_kapitan = 100 / $nmbr_kapitan;
											}

											if ($nmbr_kapitan>0) {
												$kaprank = 0;
												for($i=0; $row_kapitan = $stmt_kapitan->fetch(); $i++) {
													$kaprank++;
													$subberno = $row_kapitan['sub_berno'];
													$aspirant = $row_kapitan['aspirant'];
													$novotes = $row_kapitan['no_votes'];
													$percentvote = $row_kapitan['percent_vote'];
													$partycode = $row_kapitan['party_code'];

													if ($partycode=='Hofer Team') {
														?>
														<tr class="tr-hover-bg-purple" data-regvote="<?php echo trim($registeredvoters); ?>" data-id="<?php echo trim($subberno); ?>" data-party="<?php echo trim($partycode); ?>" data-votes="<?php echo trim($novotes); ?>" data-bs-toggle="modal" data-bs-target="#mdiEditScore" onclick="fnUpdateScore(dataset.id,dataset.votes,dataset.party,dataset.regvote)">
															<td><?php echo trim($kaprank); ?></td>
															<td><?php echo trim($aspirant); ?></td>
															<td><?php echo trim($novotes); ?></td>
															<td><?php echo trim($percentvote); ?>%</td>
															<td align="right"><a href="../../routes/brgy-elec-result?delme=1&idid=<?php echo trim($subberno) ?>" target="_self" class="btn btn-danger">Delete</a></td>
														</tr>
														<?php
													} else {
														?>
														<tr data-regvote="<?php echo trim($registeredvoters); ?>" data-id="<?php echo trim($subberno); ?>" data-party="<?php echo trim($partycode); ?>" data-votes="<?php echo trim($novotes); ?>" data-bs-toggle="modal" data-bs-target="#mdiEditScore" onclick="fnUpdateScore(dataset.id,dataset.votes,dataset.party,dataset.regvote)">
															<td><?php echo trim($kaprank); ?></td>
															<td><?php echo trim($aspirant); ?></td>
															<td><?php echo trim($novotes); ?></td>
															<td><?php echo trim($percentvote); ?>%</td>
															<td align="right"><a href="../../routes/brgy-elec-result?delme=1&idid=<?php echo trim($subberno) ?>" target="_self" class="btn btn-danger">Delete</a></td>
														</tr>
														<?php
													}
												}
											} else {
												?>
												<tr>
													<td colspan="5">No Aspirant</td>
												</tr>
												<?php
											}

											/** Total kapitan votes - Start **/
											$stmt_countvote_kap = $cnn->prepare("SELECT SUM(no_votes) AS totalvotes FROM brgy_elec_aspirants_tbl WHERE 
												barangay=:barangay AND zipcode=:zipcode AND position=:position");
											$stmt_countvote_kap->bindParam(':barangay', $brgy_aspire);
											$stmt_countvote_kap->bindValue(':zipcode', $zpcod_aspire);
											$stmt_countvote_kap->bindParam(':position', $aspire_position);
											$stmt_countvote_kap->execute();
											$row_countvote_kap = $stmt_countvote_kap->fetch(PDO::FETCH_ASSOC);
											$kaptotalvotes = $row_countvote_kap['totalvotes'];
											$kapnonvotes = $registeredvoters - $kaptotalvotes;
											/** Total kapitan votes - End **/

											$qry_update_votequota_kap = "UPDATE brgy_elec_tbl SET 
												kapitan_counts=:kapitancounts, 
												kapitan_votes_quota=:kapitanvotesquota, 
												kapitan_percentage_quota=:kapitanpercentagequota, 
												kapital_actual_voters=:kapitalactualvoters, 
												kapitan_didnot_vote=:kapitandidnotvote
												WHERE 
												barangay=:barangay AND 
												zipcode=:zipcode
											";
											$stmt_update_votequota_kap = $cnn->prepare($qry_update_votequota_kap);
											$stmt_update_votequota_kap->bindParam(':barangay', $brgy_aspire);
											$stmt_update_votequota_kap->bindValue(':zipcode', $zpcod_aspire);
											$stmt_update_votequota_kap->bindValue(':kapitancounts', $nmbr_kapitan);
											$stmt_update_votequota_kap->bindValue(':kapitanvotesquota', $devidergvote_kapitan);
											$stmt_update_votequota_kap->bindValue(':kapitanpercentagequota', $perctvote_kapitan);

											$stmt_update_votequota_kap->bindValue(':kapitalactualvoters', $kaptotalvotes);
											$stmt_update_votequota_kap->bindValue(':kapitandidnotvote', $kapnonvotes);

											$stmt_update_votequota_kap->execute();
										?>
									</tbody>
								</table>
							</div>
						</div>

						<!-- Kagawad -->
						<div id="brgy-capitan" class="card py-3 my-3 bg-color-ffff99">
							<div class="card-body scrollable">
								<div class="d-flex justify-content-between">
									<h5>Kagawad</h5>
									<button type="button" class="btn btn-outline-primary" data-position="Kagawad" data-zip="<?php echo trim($zipcode); ?>" data-brgy="<?php echo trim($barangay); ?>" data-distrito="<?php echo trim($district); ?>" data-probinsya="<?php echo trim($province); ?>" data-town="<?php echo trim($municipal); ?>" data-bs-toggle="modal" data-bs-target="#mdiAddEditAspirant" onclick="fnAddAspirant(dataset.position,dataset.brgy,dataset.town,dataset.probinsya,dataset.distrito,dataset.zip)">Add Kagawad</button>
								</div>
								
								<div class="row">
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Min. Votes:</span>
											<input type="number" class="form-control" value="<?php echo $kagawadvotesquota; ?>" placeholder="Votes Quota" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Min.%:</span>
											<input type="number" class="form-control" value="<?php echo $kagawadpercentagequota; ?>" placeholder="% Quota" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Actual Voter's:</span>
											<input type="number" class="form-control" value="<?php echo $kagawadactualvoters; ?>" placeholder="Actual Voter's" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Did Not Vote:</span>
											<input type="number" class="form-control" value="<?php echo $kagawaddidnotvote; ?>" placeholder="Did Not Vote" readonly>
										</div>
									</div>
								</div>
								<hr>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Aspirant</th>
											<th>#Votes</th>
											<th>%</th>
											<th align="right" class="text-end">Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$brgy_aspire = $barangay;
											$zpcod_aspire = $zipcode;
											$aspire_position = trim('Kagawad');

											$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

											$stmt_kagawad = $cnn->prepare("SELECT * FROM brgy_elec_aspirants_tbl WHERE 
												barangay=:barangay AND zipcode=:zipcode AND position=:position ORDER BY no_votes DESC");
											$stmt_kagawad->bindParam(':barangay', $brgy_aspire);
											$stmt_kagawad->bindValue(':zipcode', $zpcod_aspire);
											$stmt_kagawad->bindParam(':position', $aspire_position);
											$stmt_kagawad->execute();
											$nmbr_kagawad = $stmt_kagawad->rowCount();
											$devidergvote_kagawad = $registeredvoters / 2;
											$perctvote_kagawad = 100 / 2;

											if ($nmbr_kagawad>0) {
												$kagrank = 0;
												for($i=0; $row_kagawad = $stmt_kagawad->fetch(); $i++) {
													$kagrank++;
													$subberno = $row_kagawad['sub_berno'];
													$aspirant = $row_kagawad['aspirant'];
													$novotes = $row_kagawad['no_votes'];
													$percentvote = $row_kagawad['percent_vote'];
													$partycode = $row_kagawad['party_code'];

													if ($partycode=='Hofer Team') {
														?>
														<tr class="tr-hover-bg-purple" data-regvote="<?php echo trim($registeredvoters); ?>" data-id="<?php echo trim($subberno); ?>" data-party="<?php echo trim($partycode); ?>" data-votes="<?php echo trim($novotes); ?>" data-bs-toggle="modal" data-bs-target="#mdiEditScore" onclick="fnUpdateScore(dataset.id,dataset.votes,dataset.party,dataset.regvote)">
															<td><?php echo trim($kagrank); ?></td>
															<td><?php echo trim($aspirant); ?></td>
															<td><?php echo trim($novotes); ?></td>
															<td><?php echo trim($percentvote); ?>%</td>
															<td align="right"><a href="../../routes/brgy-elec-result?delme=1&idid=<?php echo trim($subberno) ?>" target="_self" class="btn btn-danger">Delete</a></td>
														</tr>
														<?php
													} else {
														?>
														<tr data-regvote="<?php echo trim($registeredvoters); ?>" data-id="<?php echo trim($subberno); ?>" data-party="<?php echo trim($partycode); ?>" data-votes="<?php echo trim($novotes); ?>" data-bs-toggle="modal" data-bs-target="#mdiEditScore" onclick="fnUpdateScore(dataset.id,dataset.votes,dataset.party,dataset.regvote)">
															<td><?php echo trim($kagrank); ?></td>
															<td><?php echo trim($aspirant); ?></td>
															<td><?php echo trim($novotes); ?></td>
															<td><?php echo trim($percentvote); ?>%</td>
															<td align="right"><a href="../../routes/brgy-elec-result?delme=1&idid=<?php echo trim($subberno) ?>" target="_self" class="btn btn-danger">Delete</a></td>
														</tr>
														<?php
													}
												}
											} else {
												?>
												<tr>
													<td colspan="5">No Aspirant</td>
												</tr>
												<?php
											}

											/** Total Kagawad votes - Start **/
											$stmt_countvote_kag = $cnn->prepare("SELECT SUM(no_votes) AS totalvotes FROM brgy_elec_aspirants_tbl WHERE 
												barangay=:barangay AND zipcode=:zipcode AND position=:position");
											$stmt_countvote_kag->bindParam(':barangay', $brgy_aspire);
											$stmt_countvote_kag->bindValue(':zipcode', $zpcod_aspire);
											$stmt_countvote_kag->bindParam(':position', $aspire_position);
											$stmt_countvote_kag->execute();
											$row_countvote_kag = $stmt_countvote_kag->fetch(PDO::FETCH_ASSOC);
											$kagtotalvotes = $row_countvote_kag['totalvotes'];
											$kagnonvotes = $registeredvoters - $kagtotalvotes;
											/** Total Kagawad votes - End **/

											$qry_update_votequota_kag = "UPDATE brgy_elec_tbl SET 
												kagawad_votes_quota=:kagawadvotesquota, 
												kagawad_percentage_quota=:kagawadpercentagequota, 
												kagawad_actual_voters=:kagawadactualvoters, 
												kagawad_didnot_vote=:kagawaddidnotvote
												WHERE 
												barangay=:barangay AND 
												zipcode=:zipcode
											";
											$stmt_update_votequota_kag = $cnn->prepare($qry_update_votequota_kag);
											$stmt_update_votequota_kag->bindParam(':barangay', $brgy_aspire);
											$stmt_update_votequota_kag->bindValue(':zipcode', $zpcod_aspire);
											$stmt_update_votequota_kag->bindValue(':kagawadvotesquota', $devidergvote_kagawad);
											$stmt_update_votequota_kag->bindValue(':kagawadpercentagequota', $perctvote_kagawad);

											$stmt_update_votequota_kag->bindValue(':kagawadactualvoters', $kagtotalvotes);
											$stmt_update_votequota_kag->bindValue(':kagawaddidnotvote', $kagnonvotes);

											$stmt_update_votequota_kag->execute();
										?>
									</tbody>
								</table>
							</div>
						</div>

						<!-- SK Chairman -->
						<div id="brgy-sk-chairman" class="card py-3 my-3 bg-color-66ff99">
							<div class="card-body scrollable">
								<div class="d-flex justify-content-between">
									<h5>SK Chairman</h5>
									<button type="button" class="btn btn-outline-primary" data-position="SK Chairman" data-zip="<?php echo trim($zipcode); ?>" data-brgy="<?php echo trim($barangay); ?>" data-distrito="<?php echo trim($district); ?>" data-probinsya="<?php echo trim($province); ?>" data-town="<?php echo trim($municipal); ?>" data-bs-toggle="modal" data-bs-target="#mdiAddEditAspirant" onclick="fnAddAspirant(dataset.position,dataset.brgy,dataset.town,dataset.probinsya,dataset.distrito,dataset.zip)">Add SK Chairman</button>
								</div>
								
								<div class="row">
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Min. Votes:</span>
											<input type="number" class="form-control" value="<?php echo $skchairvotesquota; ?>" placeholder="Votes Quota" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Min.%:</span>
											<input type="number" class="form-control" value="<?php echo $skchairpercentagequota; ?>" placeholder="% Quota" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Actual Voter's:</span>
											<input type="number" class="form-control" value="<?php echo $skchairactualvoters; ?>" placeholder="Actual Voter's" readonly>
										</div>
									</div>
									<div class="col-md-3">
										<div class="input-group my-1">
											<span class="input-group-text">Did Not Vote:</span>
											<input type="number" class="form-control" value="<?php echo $skchairdidnotvote; ?>" placeholder="Did Not Vote" readonly>
										</div>
									</div>
								</div>
								<hr>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>No.</th>
											<th>Aspirant</th>
											<th>#Votes</th>
											<th>%</th>
											<th align="right" class="text-end">Action</th>
										</tr>
									</thead>

									<tbody>
										<?php
											$brgy_aspire = $barangay;
											$zpcod_aspire = $zipcode;
											$aspire_position = trim('SK Chairman');

											$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

											$stmt_skchair = $cnn->prepare("SELECT * FROM brgy_elec_aspirants_tbl WHERE 
												barangay=:barangay AND zipcode=:zipcode AND position=:position ORDER BY no_votes DESC");
											$stmt_skchair->bindParam(':barangay', $brgy_aspire);
											$stmt_skchair->bindValue(':zipcode', $zpcod_aspire);
											$stmt_skchair->bindParam(':position', $aspire_position);
											$stmt_skchair->execute();
											$nmbr_skchair = $stmt_skchair->rowCount();

											if ($nmbr_skchair==0) {
												$devidergvote_skchair = $registeredvoters / 2;
												$perctvote_skchair = 100 / 2;
											} else {
												$devidergvote_skchair = $registeredvoters / $nmbr_skchair;
												$perctvote_skchair = 100 / $nmbr_skchair;
											}

											if ($nmbr_skchair>0) {
												$skchairrank = 0;
												for($i=0; $row_skchair = $stmt_skchair->fetch(); $i++) {
													$skchairrank++;
													$subberno = $row_skchair['sub_berno'];
													$aspirant = $row_skchair['aspirant'];
													$novotes = $row_skchair['no_votes'];
													$percentvote = $row_skchair['percent_vote'];
													$partycode = $row_skchair['party_code'];

													if ($partycode=='Hofer Team') {
														?>
														<tr class="tr-hover-bg-purple" data-regvote="<?php echo trim($registeredvoters); ?>" data-id="<?php echo trim($subberno); ?>" data-party="<?php echo trim($partycode); ?>" data-votes="<?php echo trim($novotes); ?>" data-bs-toggle="modal" data-bs-target="#mdiEditScore" onclick="fnUpdateScore(dataset.id,dataset.votes,dataset.party,dataset.regvote)">
															<td><?php echo trim($skchairrank); ?></td>
															<td><?php echo trim($aspirant); ?></td>
															<td><?php echo trim($novotes); ?></td>
															<td><?php echo trim($percentvote); ?>%</td>
															<td align="right"><a href="../../routes/brgy-elec-result?delme=1&idid=<?php echo trim($subberno) ?>" target="_self" class="btn btn-danger">Delete</a></td>
														</tr>
														<?php
													} else {
														?>
														<tr data-regvote="<?php echo trim($registeredvoters); ?>" data-id="<?php echo trim($subberno); ?>" data-party="<?php echo trim($partycode); ?>" data-votes="<?php echo trim($novotes); ?>" data-bs-toggle="modal" data-bs-target="#mdiEditScore" onclick="fnUpdateScore(dataset.id,dataset.votes,dataset.party,dataset.regvote)">
															<td><?php echo trim($skchairrank); ?></td>
															<td><?php echo trim($aspirant); ?></td>
															<td><?php echo trim($novotes); ?></td>
															<td><?php echo trim($percentvote); ?>%</td>
															<td align="right"><a href="../../routes/brgy-elec-result?delme=1&idid=<?php echo trim($subberno) ?>" target="_self" class="btn btn-danger">Delete</a></td>
														</tr>
														<?php
													}
												}
											} else {
												?>
												<tr>
													<td colspan="5">No Aspirant</td>
												</tr>
												<?php
											}

											/** Total SK Chairman votes - Start **/
											$stmt_countvote_skchair = $cnn->prepare("SELECT SUM(no_votes) AS totalvotes FROM brgy_elec_aspirants_tbl WHERE 
												barangay=:barangay AND zipcode=:zipcode AND position=:position");
											$stmt_countvote_skchair->bindParam(':barangay', $brgy_aspire);
											$stmt_countvote_skchair->bindValue(':zipcode', $zpcod_aspire);
											$stmt_countvote_skchair->bindParam(':position', $aspire_position);
											$stmt_countvote_skchair->execute();
											$row_countvote_skchair = $stmt_countvote_skchair->fetch(PDO::FETCH_ASSOC);
											$skchairtotalvotes = $row_countvote_skchair['totalvotes'];
											$skchairnonvotes = $registeredvoters - $skchairtotalvotes;
											/** Total SK Chairman votes - End **/

											$qry_update_votequota_skchair = "UPDATE brgy_elec_tbl SET 
												sk_chair_counts=:skchaircounts, 
												sk_chair_votes_quota=:skchairvotesquota, 
												sk_chair_percentage_quota=:skchairpercentagequota, 
												sk_chair_actual_voters=:skchairactualvoters, 
												sk_chair_didnot_vote=:skchairdidnotvote 
												WHERE 
												barangay=:barangay AND 
												zipcode=:zipcode
											";
											$stmt_update_votequota_skchair = $cnn->prepare($qry_update_votequota_skchair);
											$stmt_update_votequota_skchair->bindParam(':barangay', $brgy_aspire);
											$stmt_update_votequota_skchair->bindValue(':zipcode', $zpcod_aspire);
											$stmt_update_votequota_skchair->bindValue(':skchaircounts', $nmbr_skchair);
											$stmt_update_votequota_skchair->bindValue(':skchairvotesquota', $devidergvote_skchair);
											$stmt_update_votequota_skchair->bindValue(':skchairpercentagequota', $perctvote_skchair);

											$stmt_update_votequota_skchair->bindValue(':skchairactualvoters', $skchairtotalvotes);
											$stmt_update_votequota_skchair->bindValue(':skchairdidnotvote', $skchairnonvotes);

											$stmt_update_votequota_skchair->execute();
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<div class="row">
							<div class="col">
								<?php
									try {
										if (isset($_POST['btnSubmit'])) {
											if (empty($_POST['barangay'])) {
												echo '<div class="alert alert-danger alert-dismissible fade show">';
													echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
													echo 'Barangay is Required!';
												echo '</div>';
											} elseif (empty($_POST['municipal'])) {
												echo '<div class="alert alert-danger alert-dismissible fade show">';
													echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
													echo 'Municipal is Required!';
												echo '</div>';
											} elseif (empty($_POST['zipcode']) || $_POST['zipcode']==0) {
												echo '<div class ="alert alert-danger alert-dismissible fade show">';
													echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
													echo 'Zip Code is Required!';
												echo '</div>';
											} else {
												$brgy = trim($_POST['barangay']);
												$town = trim($_POST['municipal']);
												$zpcod = trim($_POST['zipcode']);
												$distrct = trim($_POST['district']);
												$rgvote = trim($_POST['reg-vote']);

												echo '<script>
														let text = "Confirm Submit?\nEither OK or Cancel.";
														if (confirm(text) == true) {
															window.open("../../routes/brgy-elec-result/?regvote='.$rgvote.'&district='.$distrct.'&zipcode='.$zpcod.'&municipal='.$town.'&barangay='.$brgy.'","_self");
														}
													</script>';
											}
										}
									} catch (PDOException $error) {
										$err_msg = $error->getMessage();
										echo "<p>Error: {$err_msg}</p>";
										die;
									}
								?>
							</div>
						</div>

						<div class="text-end">
							<a href="../../" class="btn btn-outline-primary">Home</a>
							<a href="" class="btn btn-info">Refresh</a>
							<a href="../../routes/brgy-elec-result" target="_self" class="btn btn-secondary">Reset</a>
							<a href="#" target="_blank" class="btn btn-primary">Print</a>
							<button id="btnSubmit" type="submit" class="btn btn-danger m-2" name="btnSubmit">Submit</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</section>

	<div class="modal fade" id="mdiEditScore">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 id="modaltitle" class="modal-title">Update Score</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div class="input-group my-1">
							<span class="input-group-text">AspirantID</span>
							<input id="subberno" type="number" class="form-control" name="subberno" readonly>
						</div>

						<div class="input-group my-1">
							<span class="input-group-text">Votes</span>
							<input id="votez" type="number" class="form-control" name="votez" min="0">
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Invalid field.</div>
						</div>

						<div class="input-group my-1">
							<span class="input-group-text">Team</span>
							<input list="teamlistsz" id="parties" type="text" class="form-control" name="parties">

							<datalist id="teamlistsz">
								<option value="Hofer Team"></option>
							</datalist>
						</div>

						<div class="input-group my-1" hidden>
							<span class="input-group-text">Reg. Voters</span>
							<input id="regvotez" type="number" class="form-control" name="regvotez" min="0">
						</div>

						<div class="row">
							<div class="col">
								<?php
									try {
										if (isset($_POST['btnScoreAspirent'])) {
											if (empty($_POST['subberno']) || $_POST['subberno']==0) {
												echo '<div class="alert alert-danger alert-dismissible fade show">';
													echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
													echo 'Aspirant ID is Required!';
												echo '</div>';
											} else {
												$subbernox = trim($_POST['subberno']);
												$votezx = trim($_POST['votez']);
												$partiesz = trim($_POST['parties']);
												$regvotez = trim($_POST['regvotez']);

												$prctgevote = ($votezx / $regvotez) * 100;

												$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
												$qry_update_aspirantscore = "UPDATE brgy_elec_aspirants_tbl SET 
													party_code=:partycode, 
													no_votes=:novotes, 
													percent_vote=:percentvote 
													WHERE 
													sub_berno=:subberno
												";
												$stmt_update_aspirantscore = $cnn->prepare($qry_update_aspirantscore);
												$stmt_update_aspirantscore->bindValue(':subberno', $subbernox);
												$stmt_update_aspirantscore->bindParam(':partycode', $partiesz);
												$stmt_update_aspirantscore->bindValue(':novotes', $votezx);
												$stmt_update_aspirantscore->bindValue(':percentvote', $prctgevote);
												$stmt_update_aspirantscore->execute();

												echo '<script>alert("Aspirant Score updated Successfully!");</script>';
											}
										}
									} catch (PDOException $error) {
										$err_msg = $error->getMessage();
										echo "<p>Error: {$err_msg}</p>";
										die;
									}
								?>
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button id="btnScoreAspirent" name="btnScoreAspirent" type="submit" class="btn btn-primary">Submit</button>
						<button id="btnCloseX" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="mdiAddEditAspirant">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 id="modaltitle" class="modal-title">Add Aspirant</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<div id="rem-positionbrgy" class="input-group my-1">
							<span class="input-group-text">Position</span>
							<input id="positionbrgy" type="text" class="form-control" name="positionbrgy" required readonly>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div id="rem-aspirantid" class="input-group my-1">
							<span class="input-group-text">AspirantID</span>
							<input id="aspirantid" type="number" class="form-control" name="aspirantid" readonly>
						</div>

						<div id="rem-aspirantname" class="input-group my-1">
							<span class="input-group-text">Aspirant Name</span>
							<input id="aspirantname" type="text" class="form-control" name="aspirantname" required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div id="rem-teamparty" class="input-group my-1">
							<span class="input-group-text">Team</span>
							<input list="teamlists" id="teamparty" type="text" class="form-control" name="teamparty">

							<datalist id="teamlists">
								<option value="Hofer Team"></option>
							</datalist>
						</div>

						<div id="rem-numbvotes" class="input-group my-1">
							<span class="input-group-text">Number of Votes</span>
							<input id="numbvotes" type="number" min="0" class="form-control" name="numbvotes">
						</div>

						<div id="rem-brgyz" class="input-group my-1">
							<span class="input-group-text">Barangay</span>
							<input id="brgyz" type="text" class="form-control" name="brgyz" readonly required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div class="input-group my-1">
							<span class="input-group-text">Reg. Voters</span>
							<input id="regvotey" type="number" class="form-control" name="regvotey" min="0" value="<?php echo trim($registeredvoters); ?>" readonly>
						</div>

						<div id="rem-towncity" class="input-group my-1">
							<span class="input-group-text">Town</span>
							<input id="towncity" type="text" class="form-control" name="towncity" readonly required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div id="rem-provincial" class="input-group my-1">
							<span class="input-group-text">Province</span>
							<input id="provincial" type="text" class="form-control" name="provincial" readonly required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div id="rem-distrito" class="input-group my-1">
							<span class="input-group-text">District</span>
							<input id="distritox" type="text" class="form-control" name="distritox" readonly required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div id="rem-zipcodemn" class="input-group my-1">
							<span class="input-group-text">ZIP Code</span>
							<input id="zipcodemn" type="number" class="form-control" name="zipcodemn" readonly required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div class="row">
							<div class="col">
								<?php
									try {
										if (isset($_POST['btnAspirant'])) {
											if (empty($_POST['aspirantname'])) {
												echo '<div class="alert alert-danger alert-dismissible fade show">';
													echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
													echo 'Aspirant Name is Required!';
												echo '</div>';
											} elseif (empty($_POST['positionbrgy'])) {
												echo '<div class="alert alert-danger alert-dismissible fade show">';
													echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
													echo 'Aspirant Position is Required!';
												echo '</div>';
											} else {
												$brgy_aspire = $barangay;
												$zpcod_aspire = $zipcode;
												$aspire_position = trim($_POST['positionbrgy']);
												$aspirantdagan = trim(strtoupper($_POST['aspirantname']));
												$teamparty = trim($_POST['teamparty']);
												$numbvotes = trim($_POST['numbvotes']);

												$brgyzhh = trim($_POST['brgyz']);
												$towncityhh = trim($_POST['towncity']);
												$provincialhh = trim($_POST['provincial']);
												$distritoxhh = trim($_POST['distritox']);
												$zipncodex = trim($_POST['zipcodemn']);

												$regvoteyfgh = trim($_POST['regvotey']);

												$halalan = trim('10/30/2023');

												$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
												$stmt_existaspirant = $cnn->prepare("SELECT * FROM brgy_elec_aspirants_tbl WHERE aspirant=:aspirant AND elec_date=:halalan");
												$stmt_existaspirant->bindParam(':aspirant', $aspirantdagan);
												$stmt_existaspirant->bindParam(':halalan', $halalan);
												$stmt_existaspirant->execute();
												$nmbr_existaspirant = $stmt_existaspirant->rowCount();

												if ($nmbr_existaspirant==0) {
													$qry_insert_aspirant = "INSERT INTO brgy_elec_aspirants_tbl SET 
														elec_date=:elecdate, 
														aspirant=:aspirant, 
														position=:position, 
														barangay=:barangay, 
														zipcode=:zipcode, 
														municipality=:municipality, 
														district=:district, 
														province=:province, 
														party_code=:partycode, 
														no_votes=:novotes
													";
													$stmt_insert_aspirant = $cnn->prepare($qry_insert_aspirant);
													$stmt_insert_aspirant->bindParam(':elecdate', $halalan);
													$stmt_insert_aspirant->bindParam(':aspirant', $aspirantdagan);
													$stmt_insert_aspirant->bindParam(':position', $aspire_position);
													$stmt_insert_aspirant->bindParam(':barangay', $brgyzhh);
													$stmt_insert_aspirant->bindValue(':zipcode', $zipncodex);
													$stmt_insert_aspirant->bindParam(':municipality', $towncityhh);
													$stmt_insert_aspirant->bindParam(':district', $distritoxhh);
													$stmt_insert_aspirant->bindParam(':province', $provincialhh);
													$stmt_insert_aspirant->bindParam(':partycode', $teamparty);
													$stmt_insert_aspirant->bindValue(':novotes', $numbvotes);
													$stmt_insert_aspirant->execute();

													echo '<script>alert("New Aspirant Saved!");location.reload();</script>';
												} else {
													echo '<div class="alert alert-danger alert-dismissible fade show">';
														echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
														echo 'Aspirant Already Exist!';
													echo '</div>';
													echo '<script>alert("Aspirant Already Exist!");</script>';
												}
											}
										}
									} catch (PDOException $error) {
										$err_msg = $error->getMessage();
										echo "<p>Error: {$err_msg}</p>";
										die;
									}
								?>
							</div>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button id="btnAspirant" name="btnAspirant" type="submit" class="btn btn-primary">Submit</button>
						<button id="btnCloseZ" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script>
		let municipal = document.querySelector("#municipal");
		let barangay = document.querySelector("#barangay");
		let zipcode = document.querySelector("#zipcode");
		let province = document.querySelector("#province");
		let district = document.querySelector("#district");
		let positionbrgy = document.querySelector("#positionbrgy");
		let remaspirantid = document.querySelector("#rem-aspirantid");

		let brgyz = document.querySelector("#brgyz");
		let towncity = document.querySelector("#towncity");
		let provincial = document.querySelector("#provincial");
		let distritox = document.querySelector("#distritox");
		let zipcodemn = document.querySelector("#zipcodemn");

		let subberno = document.querySelector("#subberno");
		let votez = document.querySelector("#votez");
		let parties = document.querySelector("#parties");

		let regvotez = document.querySelector("#regvotez");

		municipal.addEventListener('change', async function() {
			zipcode.value = "";
			district.value = "";
			var	town = municipal.value;

			zipcode.value = document.querySelector('option[value="' + town + '"]').id;
			district.value = document.querySelector('option[value="' + town + '"]').dataset.district;
		});

		function fnAddAspirant(position,brgy,town,probinsya,distrito,zip) {
			positionbrgy.value = "";
			aspirantid.value = "";
			brgyz.value = "";
			towncity.value = "";
			provincial.value = "";
			distritox.value = "";
			zipcodemn.value = "";

			remaspirantid.classList = "d-none";

			positionbrgy.value = position;
			brgyz.value = brgy;
			towncity.value = town;
			provincial.value = probinsya;
			distritox.value = distrito;
			zipcodemn.value = zip;
		}

		function fnUpdateScore(id,votes,party,regvoter) {
			subberno.value = "";
			votez.value = "";
			parties.value = "";
			regvotez.value = "";
			votez.max = 0;

			subberno.value = id;
			votez.value = votes;
			parties.value = party;
			regvotez.value = regvoter;
			votez.max = regvoter;
		}
	</script>