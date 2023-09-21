<?php
	$emailx = strtolower($email);

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_useremail = $cnn->prepare("SELECT * FROM user_tbl WHERE email=:email");
	$stmt_useremail->bindParam(':email', $emailx);
	$stmt_useremail->execute();
	$count_useremail = $stmt_useremail->rowCount();
?>