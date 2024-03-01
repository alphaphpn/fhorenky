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

?>
					<!-- Start here -->
					<div class="row py-5">
						<div class="col-md-4"></div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h4>Upload Biometric - Timelogs</h4>
								</div>
								<div class="card-body">
									<form method="post" enctype="multipart/form-data">
										<label for="file">Choose a file:</label>
										<input type="file" name="file" id="file" accept=".xlsx,.xlx,.txt,.dat">
										<button type="submit" name="submit">Upload</button>
									</form>
								</div>
								<div class="card-footer">
									<?php
										if (isset($_POST['submit'])) {
											$uploadDir = '../../public/dtr/biometric/'; // Specify the directory where you want to store uploaded files

											// Check if the file was uploaded without errors
											if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
												$tmpFilePath = $_FILES['file']['tmp_name'];
												$newFilePath = $uploadDir . $_FILES['file']['name'];

												// Move the uploaded file to the specified directory
												if (move_uploaded_file($tmpFilePath, $newFilePath)) {
													// echo "File uploaded successfully. Path: $newFilePath";
													echo "<p class='text-primary'>File uploaded successfully.</p>";
												} else {
													echo "Error uploading file.";
												}
											} else {
												echo "Either NO Files is uploaded.";
												echo "<br><br>";
												echo "Error: " . $_FILES['file']['error'];
											}
										} else {
											echo "<p>Biometric</p>";
										}
									?>
								</div>
							</div>
						</div>
						<div class="col-md-4"></div>
					</div>