<?php

	$month2print = date('n') - 1

?>

	<script>
		$(document).ready(function(){
			$("#mdiDTRBioLoc").modal('show');
		});
	</script>

	<div class="modal fade" id="mdiDTRBioLoc">
		<div class="modal-dialog modal-dialog-scrollable">
			<div class="modal-content">
				<form id="" method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">DTR Biometric Location</h4>
						<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						
						<div class="input-group mb-3 input-group-lg">
							<span class="input-group-text">Biometric Location</span>
							<input list="biolocationlists" id="bio-location" name="bio-location" type="text" class="form-control" placeholder="* Bio Location" required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>

							<datalist id="biolocationlists">
								<option disabled selected value> -- select an option -- </option>
							<?php
								$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
								$stmt_biolocationlists = $cnn->prepare("SELECT * FROM bio_location_tbl");
								$stmt_biolocationlists->execute();
								$result_biolocationlists = $stmt_biolocationlists->setFetchMode(PDO::FETCH_ASSOC);
								foreach ($stmt_biolocationlists as $row_biolocationlists) {
									echo "<option value='".$row_biolocationlists['bio_location']."' data-timelogtype='".$row_biolocationlists['timelogs_type']."'>";
								}
							?>
							</datalist>
						</div>

						<div class="input-group mb-3 input-group-lg">
							<span class="input-group-text">Year</span>
							<input id="filter-year" type="number" min="2023" max="<?php echo $yeartoday; ?>" class="form-control" placeholder="* Year" name="filter-year" value="<?php echo $yeartoday; ?>" required>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div class="input-group mb-3 input-group-lg">
							<span class="input-group-text">Month</span>
							<select id="filter-month" class="form-select form-control" placeholder="* Month" name="filter-month" required>
								<option disabled value> -- select an option -- </option>
								<option value="1" data-value="January" <?php if ($month2print==1) echo 'selected'; ?>>January</option>
								<option value="2" data-value="February" <?php if ($month2print==2) echo 'selected'; ?>>February</option>
								<option value="3" data-value="March" <?php if ($month2print==3) echo 'selected'; ?>>March</option>
								<option value="4" data-value="April" <?php if ($month2print==4) echo 'selected'; ?>>April</option>
								<option value="5" data-value="May" <?php if ($month2print==5) echo 'selected'; ?>>May</option>
								<option value="6" data-value="June" <?php if ($month2print==6) echo 'selected'; ?>>June</option>
								<option value="7" data-value="July" <?php if ($month2print==7) echo 'selected'; ?>>July</option>
								<option value="8" data-value="August" <?php if ($month2print==8) echo 'selected'; ?>>August</option>
								<option value="9" data-value="September" <?php if ($month2print==9) echo 'selected'; ?>>September</option>
								<option value="10" data-value="October" <?php if ($month2print==10) echo 'selected'; ?>>October</option>
								<option value="11" data-value="November" <?php if ($month2print==11) echo 'selected'; ?>>November</option>
								<option value="12" data-value="December" <?php if ($month2print==12) echo 'selected'; ?>>December</option>
							</select>
							<div class="valid-feedback">Valid.</div>
							<div class="invalid-feedback">Please fill out this field.</div>
						</div>

						<div>
							<?php
								try {
									$yrno = isset($_POST['filter-year']) ? $_POST['filter-year'] : '';
									$monthno = isset($_POST['filter-month']) ? $_POST['filter-month'] : '';
									$biolocation = isset($_POST['bio-location']) ? $_POST['bio-location'] : '';

									if (isset($_POST['btnDtrSubmit'])) {
										echo '<script>window.open("../../routes/dtremp/?yrno='.$yrno.'&monthno='.$monthno.'&biolocation='.$biolocation.'","_self");</script>';
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

	<section>
		<div class="container">
			<a href="../../">Home</a>
			<a href="../../routes/dtr-emp">Refresh</a>
		</div>
	</section>