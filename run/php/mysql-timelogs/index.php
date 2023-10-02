<?php

	include_once "../../../lib/core.php";
	include_once "../../../env.php";
	include_once "../../../lib/webconfig.php";

	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
	$qry_timein = "SELECT * FROM employee_timelogs_single_tbl WHERE timelog < TIME_FORMAT('11:59:00','%T')";
	$stmt_timein = $cnn->prepare($qry_timein);
	$stmt_timein->execute();

	foreach ($stmt_timein as $row_timein) {
		$amtimeinx = $row_timein['timelog'];
		echo $amtimeinx."<br>";
	}