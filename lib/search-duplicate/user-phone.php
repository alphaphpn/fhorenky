<?php
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_userphone = $cnn->prepare("SELECT * FROM user_tbl WHERE phone=:phone");
	$stmt_userphone->bindParam(':phone', $phone);
	$stmt_userphone->execute();
	$count_userphone = $stmt_userphone->rowCount();
?>