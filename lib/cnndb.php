<?php

	include_once "env.php";
	
	try {
		$cnn = new PDO("mysql:host={$host};db={$db}", $uname, $pw);
		$cnn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		$err = $e->getMessage();
		$err2 = strrchr($e,"1049");
		if($err2=1049){
			echo "Error: Unknown Database.<br><a href='#'>Fix It!</a>";
			die;
		}
	}