<?php
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_employid = $cnn->prepare("SELECT * FROM employee_tbl WHERE emp_id=:empidfinale");
	$stmt_employid->bindParam(':empidfinale', $empid_finale);
	$stmt_employid->execute();
	$count_employid = $stmt_employid->rowCount();
?>