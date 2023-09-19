<?php

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

		$length_userid = 6;

		$stmt_userid = $cnn->prepare("SELECT * FROM user_tbl WHERE DATE_FORMAT(createddate, '%Y-%m-%d')=:date2day");
		$stmt_userid->bindParam(':date2day', $date2day);
		$stmt_userid->execute();
		$count_userid = $stmt_userid->rowCount() + 1;
		$stmt_userid = substr(str_repeat(0, $length_userid).$count_userid, - $length_userid);
		$userid_finale = trim(date("Ymd")) . trim($stmt_userid);
	} catch(PDOException $e) {
		$err = $e->getMessage();
		$err2 = strrchr($e,"1049");
		if($err2=1049){
			echo "Error: Unknown Database.<br><a href='".$dir."#'>Fix It!</a>";
			die;
		}
	}
	$cnn = null;