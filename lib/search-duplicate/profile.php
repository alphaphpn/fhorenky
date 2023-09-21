<?php
	$firstnamex = strtolower($firstname);
	$middlenamex = strtolower(isset($middlename) ? $middlename : "");
	$lastnamex = strtolower($lastname);
	$suffixx = strtolower(isset($suffix) ? $suffix : "");
	$genderx = strtolower($gender);

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

	if (empty($suffixx)) {
		$stmt_profileinfo = $cnn->prepare("SELECT * FROM profile_tbl WHERE lower(first_name)=:firstname AND lower(middle_name)=:middlename AND lower(last_name)=:lastname AND lower(gender)=:gender AND birthdate=:birthdate");
		$stmt_profileinfo->bindParam(':firstname', $firstnamex);
		$stmt_profileinfo->bindParam(':middlename', $middlenamex);
		$stmt_profileinfo->bindParam(':lastname', $lastnamex);
		$stmt_profileinfo->bindParam(':birthdate', $birthdate);
		$stmt_profileinfo->bindParam(':gender', $genderx);
	} elseif (empty($middlenamex)) {
		$stmt_profileinfo = $cnn->prepare("SELECT * FROM profile_tbl WHERE lower(first_name)=:firstname AND lower(last_name)=:lastname AND lower(gender)=:gender AND birthdate=:birthdate AND suffix=:suffix");
		$stmt_profileinfo->bindParam(':firstname', $firstnamex);
		$stmt_profileinfo->bindParam(':lastname', $lastnamex);
		$stmt_profileinfo->bindParam(':birthdate', $birthdate);
		$stmt_profileinfo->bindParam(':gender', $genderx);
		$stmt_profileinfo->bindParam(':suffix', $suffixx);
	} elseif (empty($middlenamex) && empty($suffixx)) {
		$stmt_profileinfo = $cnn->prepare("SELECT * FROM profile_tbl WHERE lower(first_name)=:firstname AND lower(last_name)=:lastname AND lower(gender)=:gender AND birthdate=:birthdate");
		$stmt_profileinfo->bindParam(':firstname', $firstnamex);
		$stmt_profileinfo->bindParam(':lastname', $lastnamex);
		$stmt_profileinfo->bindParam(':birthdate', $birthdate);
		$stmt_profileinfo->bindParam(':gender', $genderx);
	} else {
		$stmt_profileinfo = $cnn->prepare("SELECT * FROM profile_tbl WHERE lower(first_name)=:firstname AND lower(middle_name)=:middlename AND lower(last_name)=:lastname AND lower(gender)=:gender AND birthdate=:birthdate AND suffix=:suffix");
		$stmt_profileinfo->bindParam(':firstname', $firstnamex);
		$stmt_profileinfo->bindParam(':middlename', $middlenamex);
		$stmt_profileinfo->bindParam(':lastname', $lastnamex);
		$stmt_profileinfo->bindParam(':birthdate', $birthdate);
		$stmt_profileinfo->bindParam(':suffix', $suffixx);
		$stmt_profileinfo->bindParam(':gender', $genderx);
	}
	
	$stmt_profileinfo->execute();
	$count_profileinfo = $stmt_profileinfo->rowCount();
?>