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

	// Alphanumeric Special Character Verifier - Start
	function specialChars($str) {
		return !ctype_alnum($str);
	}
	// Alphanumeric Special Character Verifier - End

	// Validate Value: DTR - Start
	function checkIsValStat($valstat) {
		if ($valstat=="LEAVE") {
			return TRUE;
		} elseif ($valstat=="MEMO") {
			return TRUE;
		} elseif ($valstat=="PASS-SLIP") {
			return TRUE;
		} elseif ($valstat=="OB") {
			return TRUE;
		} elseif (strpos($valstat, 'OB') !== false) {
			return TRUE;
		} elseif ($valstat=="OT") {
			return TRUE;
		} elseif (strpos($valstat, 'OT') !== false) {
			return TRUE;
		} elseif ($valstat=="DAY OFF") {
			return TRUE;
		} elseif ($valstat=="SWAP") {
			return TRUE;
		} elseif ($valstat=="OFFSET") {
			return TRUE;
		} elseif ($valstat=="MEETING") {
			return TRUE;
		} elseif ($valstat=="BAC Meeting") {
			return TRUE;
		} elseif ($valstat=="ABSENT") {
			return TRUE;
		} elseif ($valstat=="NOT APPLICABLE") {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	// Validate Value: DTR - End

	// Password Encryptor - Start
	function pwordEnryptor($pwordata) {
		$md5_given = $pwordata;
		$pw_md5 = md5($md5_given);

		return $pw_md5;
	}
	// Password Encryptor - End

?>