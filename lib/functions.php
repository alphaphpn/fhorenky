<?php

	// Time Check Verifier - Start
	$time_pattern = '/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/';
	$word_pattern = '/^[A-Za-z]+$/';

	function checkIsTime($timeformat) {
		$timeformat=DateTime::createFromFormat('g:i', $timeformat);
		$time_errors = DateTime::getLastErrors();

		if ($time_errors + $time_errors == 0) {
			return TRUE;
		} else {
			return FALSE;
		}
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