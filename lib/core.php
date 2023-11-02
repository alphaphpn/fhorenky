<?php

	session_start();
	$page = isset($_GET['page']) ? $_GET['page'] : 1;
	$records_per_page = 15;
	$from_record_num = ($records_per_page * $page) - $records_per_page;
	$action = isset($_GET['action']) ? $_GET['action'] : "";

	set_time_limit(0);
	
	ini_set('default_charset', 'utf-8');

	function isValidDate($date, $format = 'Y-m-d') {
		$dateTime = DateTime::createFromFormat($format, $date);
		return $dateTime && $dateTime->format($format) === $date;
	}
?>