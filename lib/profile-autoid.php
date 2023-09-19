<?php

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

		$length_profileid = 6;

		$stmt_profileid = $cnn->prepare("SELECT * FROM employee_tbl WHERE DATE_FORMAT(createddate, '%Y-%m-%d')=:date2day");
		$stmt_profileid->bindParam(':date2day', $date2day);
		$stmt_profileid->execute();
		$count_profileid = $stmt_profileid->rowCount() + 1;
		$str_profileid = substr(str_repeat(0, $length_profileid).$count_profileid, - $length_profileid);
		$profileid_finale = trim(date("Ymd")) . trim($str_profileid);
	} catch(PDOException $e) {
		$err = $e->getMessage();
		$err2 = strrchr($e,"1049");
		if($err2=1049){
			echo "Error: Unknown Database.<br><a href='".$dir."#'>Fix It!</a>";
			die;
		}
	}
	$cnn = null;