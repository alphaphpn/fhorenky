<?php

	// Admin Logged
	if (empty($_SESSION["uid"]) || empty($_SESSION["uname"]) || empty($_SESSION["ulevel"]) || empty($_SESSION["uposition"]) || empty($_SESSION["ustat"]) || empty($_SESSION["verified"])) {
?>

	<a href="routes/login">Login</a>

<?php
	} elseif ($_SESSION["ulevel"]==1) {
?>

	<a href="routes/sign-up-employee">New Employee</a>
	<a href="routes/update-employee">Update Employee</a>
	<a href="routes/logout">Logout</a>

<?php
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