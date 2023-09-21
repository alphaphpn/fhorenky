<?php
	$biolocationx = strtolower($biolocation);

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_bioid = $cnn->prepare("SELECT * FROM employee_tbl WHERE bio_no=:bioidfinale AND lower(bio_location)=:biolocation");
	$stmt_bioid->bindParam(':bioidfinale', $bioid_finale);
	$stmt_bioid->bindParam(':biolocation', $biolocationx);
	$stmt_bioid->execute();
	$count_bioid = $stmt_bioid->rowCount();
?>