<?php
	$emailx = strtolower($email);
	
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$stmt_profileemail = $cnn->prepare("SELECT * FROM profile_tbl WHERE primary_email=:email");
	$stmt_profileemail->bindParam(':email', $emailx);
	$stmt_profileemail->execute();
	$count_profileemail = $stmt_profileemail->rowCount();
?>