<?php

	// Time Check Verifier - Start
	$time_pattern = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/';
	$word_pattern = '/^[A-Za-z]+$/';

	function checkIsTime($timeformat) {
		global $time_pattern;
		$timeformat = trim($timeformat); // Trim any leading or trailing whitespace

		if (preg_match($time_pattern, $timeformat)) {
			$time = DateTime::createFromFormat('H:i', $timeformat);
			$time_errors = DateTime::getLastErrors();

			// Check if $time_errors is an array before accessing its elements
			if (is_array($time_errors) && $time_errors['warning_count'] + $time_errors['error_count'] == 0) {
				return true;
			}
		}
		return false;
	}
	// Time Check Verifier - End

	// Password Encryptor - Start
	function pwordEnryptor($pwordata) {
		$md5_given = $pwordata;
		$pw_md5 = md5($md5_given);

		return $pw_md5;
	}
	// Password Encryptor - End

?>