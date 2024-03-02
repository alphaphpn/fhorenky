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

		$pwordz = trim(isset($_GET['password']) ? $_GET['password'] : '');

		if (isset($pwordz) ? $pwordz : '') {
			$md5data = pwordEnryptor(trim($pwordz));
		}

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
					<form action="">
						<div class="mb-3 mt-3">
							<label for="password" class="form-label">Password:</label>
							<input type="text" class="form-control" id="password" placeholder="Enter password" name="password" value="<?php echo isset($pwordz) ? $pwordz : ''; ?>">
						</div>

						<div class="mb-3">
							<label class="form-label">Encrypted Password:</label>
							<p id="dcopy" class="user-select-all" data-etype="innerHTML" onclick="copytoclipbrd(id,dataset.etype);"><?php echo trim(isset($md5data) ? $md5data : ''); ?></p>
						</div>

						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

					<script>
						$(document).ready(function() {
							password = document.getElementById("password");

							password.addEventListener(`focus`, () => password.select());
						});
					</script>