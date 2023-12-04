<?php

	try {
		if (isset($_POST["btnLogin"])) {
			if (empty($_POST["userid"]) || empty($_POST["password"])) {
				echo '<div class="alert alert-danger alert-dismissible fade show">';
					echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
					echo 'Please enter User and Password.';
				echo '</div>';
			} else {
				$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
				$query_user = "SELECT * FROM user_tbl WHERE uid=:userid OR uname=:userid OR phone=:userid OR email=:userid LIMIT 1";
				$statement_user = $cnn->prepare($query_user);
				$userid = htmlspecialchars($_POST['userid']);
				$passcode = htmlspecialchars(md5($_POST["password"]));
				$statement_user->bindParam(':userid', $userid);
				$statement_user->execute();
				$count_user = $statement_user->rowCount();

				if ($count_user > 0) {
					foreach ($statement_user as $row_user) {
						$xdelg = $row_user['xdel'];
						$verifiedg = $row_user['verified'];
						$ustatg = $row_user['ustat'];
						$pwordg = $row_user['pword'];
						$usercode = $row_user['uid'];
						$uname = $row_user['uname'];
						$ulevel = $row_user['ulevel'];
						$uposition = $row_user['uposition'];
					}

					if ($xdelg==1) {
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
							echo 'Your Account has been Deleted!';
						echo '</div>';
					} elseif ($verifiedg==0) {
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
							echo 'Your Account needs to be Verified!';
						echo '</div>';
					} elseif ($ustatg==0) {
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
							echo 'Your Account has been Disabled!';
						echo '</div>';
					} elseif ($pwordg!=$passcode) {
						echo '<div class="alert alert-danger alert-dismissible fade show">';
							echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
							echo 'Invalid Password!';
						echo '</div>';
					} elseif ($uname!=$userid) {
						if ($usercode!=$userid) {
							echo '<div class="alert alert-danger alert-dismissible fade show">';
								echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
								echo 'Invalid User!';
							echo '</div>';
						} else {
							$_SESSION["uid"] = $usercode;
							$_SESSION["uname"] = $uname;
							$_SESSION["ulevel"] = $ulevel;
							$_SESSION["uposition"] = $uposition;
							$_SESSION["ustat"] = $ustatg;
							$_SESSION["verified"] = $verifiedg;
							$_SESSION["xdel"] = $xdelg;
							
							echo "<script>window.open('../../', '_self');</script>";
						}
					} else {
						$_SESSION["uid"] = $usercode;
						$_SESSION["uname"] = $uname;
						$_SESSION["ulevel"] = $ulevel;
						$_SESSION["uposition"] = $uposition;
						$_SESSION["ustat"] = $ustatg;
						$_SESSION["verified"] = $verifiedg;
						$_SESSION["xdel"] = $xdelg;
						
						echo "<script>window.open('../../', '_self');</script>";
					}
				} else {
					echo '<div class="alert alert-danger alert-dismissible fade show">';
						echo '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>';
						echo 'You are not register.';
					echo '</div>';
				}
			}
		}  else {
			echo "<p class='text-center'>Login to your account.</p>";
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}

	// Input Pattern
	// https://www.w3schools.com/tags/att_input_pattern.asp