<?php
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_username = $cnn->prepare("SELECT * FROM user_tbl WHERE uname=:username");
	$stmt_username->bindParam(':username', $username);
	$stmt_username->execute();
	$count_username = $stmt_username->rowCount();
?>