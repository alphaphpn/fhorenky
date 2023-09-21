<?php
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_profilephone = $cnn->prepare("SELECT * FROM profile_tbl WHERE primary_phone=:phone");
	$stmt_profilephone->bindParam(':phone', $phone);
	$stmt_profilephone->execute();
	$count_profilephone = $stmt_profilephone->rowCount();
?>