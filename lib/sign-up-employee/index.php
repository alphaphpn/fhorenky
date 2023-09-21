<?php

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

		date_default_timezone_set("Asia/Taipei");
		$timestamped = date("Y-m-d H:m:s");

		// Profile Data Saving
		$profileidfinale = $profileid_finale;
		$fbidx = trim(strtolower($fbid));
		$phonex = $phone;
		$phone2x = $phone2;
		$emailx = trim(strtolower($email));
		$firstnamex = trim(ucwords($firstname));
		$middlenamex = trim(ucwords($middlename));
		$lastnamex = trim(ucwords($lastname));
		$suffixx = $suffix;
		$nametitlex = $nametitle;
		$birthdatex = $birthdate;
		$genderx = trim(ucwords($gender));
		$logguser = trim($_SESSION["uname"]);
		$countryx = "Philippines";
		$countrycodex = '63';

		$qry_insert_profile = "INSERT INTO profile_tbl SET
			profileid=:profileidfinale, 
			ptitle=:nametitlex, 
			last_name=:lastnamex, 
			first_name=:firstnamex, 
			middle_name=:middlenamex, 
			suffix=:suffixx, 
			birthdate=:birthdatex, 
			gender=:genderx, 
			country=:countryx, 
			countrycode=63, 
			primary_phone=:phonex, 
			secondary_phone=:phone2x, 
			primary_email=:emailx, 
			facebookid=:fbidx, 
			createdby=:logguser, 
			createddate=:timestamped, 
			modifiedby=:logguser, 
			datemodified=:timestamped, 
			verified=1, 
			xdel=0
		";
		$stmt_insert_profile = $cnn->prepare($qry_insert_profile);

		$stmt_insert_profile->bindParam(':profileidfinale', $profileidfinale);
		$stmt_insert_profile->bindParam(':fbidx', $fbidx);
		$stmt_insert_profile->bindParam(':countryx', $countryx);
		$stmt_insert_profile->bindParam(':phonex', $phonex);
		$stmt_insert_profile->bindParam(':phone2x', $phone2x);
		$stmt_insert_profile->bindParam(':emailx', $emailx);
		$stmt_insert_profile->bindParam(':firstnamex', $firstnamex);
		$stmt_insert_profile->bindParam(':middlenamex', $middlenamex);
		$stmt_insert_profile->bindParam(':lastnamex', $lastnamex);
		$stmt_insert_profile->bindParam(':suffixx', $suffixx);
		$stmt_insert_profile->bindParam(':nametitlex', $nametitlex);
		$stmt_insert_profile->bindParam(':birthdatex', $birthdatex);
		$stmt_insert_profile->bindParam(':genderx', $genderx);
		$stmt_insert_profile->bindParam(':logguser', $logguser);
		$stmt_insert_profile->bindParam(':timestamped', $timestamped);

		$stmt_insert_profile->execute();

		if (empty($imgdata)) {

		} else {
			$base64DataString = $imgdata;

			// extract image data from base64 data string
			$pattern = '/data:image\/(.+);base64,(.*)/';
			preg_match($pattern, $base64DataString, $matches);

			// image file extension
			$imageExtension = $matches[1];

			// base64-encoded image data
			$encodedImageData = $matches[2];

			// decode base64-encoded image data
			$decodedImageData = base64_decode($encodedImageData);

			// save image data as file
			file_put_contents("../../public/profile/{$profileidfinale}.{$imageExtension}", $decodedImageData);
		}
		echo "<script>alert('New Profile Successfully Saved.')</script>";

		// User Data Saving
		$userid_finalex = $userid_finale;
		$usernamex = $username;
		$userpwx = md5($userpw);
		$ulevelx = '16';
		$upositionx = "User";

		$qry_insert_user = "INSERT INTO user_tbl SET
			uid=:userid_finalex, 
			profileid=:profileidfinale, 
			uname=:usernamex, 
			pword=:userpwx, 
			country=:countryx, 
			countrycode=63, 
			phone=:phonex, 
			email=:emailx, 
			ustat=0, 
			ulevel=:ulevelx, 
			uposition=:upositionx, 
			createddate=:timestamped, 
			datemodified=:timestamped, 
			onoffline=0, 
			verified=0, 
			xdel=0
		";
		$stmt_insert_user = $cnn->prepare($qry_insert_user);

		$stmt_insert_user->bindParam(':userid_finalex', $userid_finalex);
		$stmt_insert_user->bindParam(':profileidfinale', $profileidfinale);
		$stmt_insert_user->bindParam(':usernamex', $usernamex);
		$stmt_insert_user->bindParam(':userpwx', $userpwx);
		$stmt_insert_user->bindParam(':phonex', $phonex);
		$stmt_insert_user->bindParam(':emailx', $emailx);
		$stmt_insert_user->bindParam(':countryx', $countryx);
		// $stmt_insert_user->bindParam(':countrycodex', $countrycodex);
		$stmt_insert_user->bindParam(':upositionx', $upositionx);
		$stmt_insert_user->bindParam(':ulevelx', $ulevelx);
		$stmt_insert_user->bindParam(':timestamped', $timestamped);

		$stmt_insert_user->execute();

		echo "<script>alert('New User Successfully Saved.')</script>";

		// Employee Data Saving
		$empidfinale = $empid_finale;
		$biolocationx = $biolocation;
		$bioidfinale = $bioid_finale;
		$fullnamex = $fullname;
		$officex = $office;
		$officecodex = $officecode;
		$officeidx = $officeid;
		$officetitlex = $officetitle;
		$officeabrvx = $officeabrv;
		$headofcrx = $headofcr;
		$headtitlex = $headtitle;
		$authheadx = $authhead;
		$authtitlex = $authtitle;
		$authdescx = $authdesc;
		$yrempdx = $yrempd;
		$yrcalcx = $yeartoday - $yrempd;
		$typeemployeenox = $typeemployeeno;
		$typeemployeeabvrx = $typeemployeeabvr;
		$typeemployeex = $typeemployee;

		$qry_insert_employee = "INSERT INTO employee_tbl SET
			emp_id=:empidfinale, 
			profileid=:profileidfinale, 
			bio_location=:biolocationx, 
			bio_no=:bioidfinale, 
			emp_name=:fullnamex, 
			officeid=:officeidx, 
			officecode=:officecodex, 
			officename=:officex, 
			officetitle=:officetitlex, 
			officeabrv=:officeabrvx, 
			headofficer=:headofcrx, 
			headtitle=:headtitlex, 
			auth_head=:authtitlex, 
			auth_title=:authtitlex, 
			auth_description=:authdescx, 
			year_employed=:yrempdx, 
			year_calc=:yrcalcx, 
			type_employee_no=:typeemployeenox, 
			type_employee_abrv=:typeemployeeabvrx, 
			type_employee=:typeemployeex, 
			createdby=:logguser, 
			createddate=:timestamped, 
			modifiedby=:logguser, 
			datemodified=:timestamped, 
			verified=1, 
			xdel=0
		";
		$stmt_insert_employee = $cnn->prepare($qry_insert_employee);

		$stmt_insert_employee->bindParam(':empidfinale', $empidfinale);
		$stmt_insert_employee->bindParam(':profileidfinale', $profileidfinale);
		$stmt_insert_employee->bindParam(':biolocationx', $biolocationx);
		$stmt_insert_employee->bindParam(':bioidfinale', $bioidfinale);
		$stmt_insert_employee->bindParam(':fullnamex', $fullnamex);
		$stmt_insert_employee->bindParam(':officex', $officex);
		$stmt_insert_employee->bindParam(':officecodex', $officecodex);
		$stmt_insert_employee->bindParam(':officeidx', $officeidx);
		$stmt_insert_employee->bindParam(':officetitlex', $officetitlex);
		$stmt_insert_employee->bindParam(':officeabrvx', $officeabrvx);
		$stmt_insert_employee->bindParam(':headofcrx', $headofcrx);
		$stmt_insert_employee->bindParam(':headtitlex', $headtitlex);
		$stmt_insert_employee->bindParam(':authheadx', $authheadx);
		$stmt_insert_employee->bindParam(':authtitlex', $authtitlex);
		$stmt_insert_employee->bindParam(':authdescx', $authdescx);
		$stmt_insert_employee->bindParam(':yrempdx', $yrempdx);
		$stmt_insert_employee->bindParam(':yrcalcx', $yrcalcx);
		$stmt_insert_employee->bindParam(':typeemployeenox', $typeemployeenox);
		$stmt_insert_employee->bindParam(':typeemployeeabvrx', $typeemployeeabvrx);
		$stmt_insert_employee->bindParam(':typeemployeex', $typeemployeex);
		$stmt_insert_employee->bindParam(':logguser', $logguser);
		$stmt_insert_employee->bindParam(':timestamped', $timestamped);

		$stmt_insert_employee->execute();

		echo "<script>alert('New Employee Successfully Saved.')</script>";
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}
	
?>