<?php

	try {
		
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

		$qry_webconf = "SELECT * FROM conf WHERE id=:ownerid LIMIT 1";
		$stmt_webconf = $cnn->prepare($qry_webconf);
		$stmt_webconf->bindParam(':ownerid', $owner_id);
		$stmt_webconf->execute();
		$row_webconf = $stmt_webconf->fetch(PDO::FETCH_ASSOC);

		$cmpnyname = $row_webconf['cmpny_name'];
		$sysname = $row_webconf['sys_name'];
		$sysver = $row_webconf['sys_ver'];
		$syslogo = $row_webconf['sys_logo'];
		$navbarlogo = $row_webconf['navbar_logo'];
		$navbarlogoscroll = $row_webconf['navbar_logo_scroll'];
		$favicon = $row_webconf['favicon'];
		$dboardbgimg = $row_webconf['dboard_bgimg'];
		$quotetitle = $row_webconf['quote_title'];
		$ceopres = $row_webconf['ceo_pres'];
		$memail = $row_webconf['memail'];
		$facebook = $row_webconf['facebook'];
		$telno = $row_webconf['telno'];
		$mobileno = $row_webconf['mobileno'];
		$maddress = $row_webconf['maddress'];
		$themename = $row_webconf['themename'];
		$domainhome = $row_webconf['domainhome'];
		$fontglobal = $row_webconf['fontglobal'];
		$geomap = $row_webconf['geo_map'];
		$idletime = $row_webconf['idletime'] * 60;
		$build_by = $row_webconf['build_by'];
		$cwebzite = $row_webconf['cwebzite'];
		$dcurrencyx = $row_webconf['dcurrencyx'];
		$navbarorrient = $row_webconf['nav_bar_orrient'];
		$primarycolor = $row_webconf['primary_color'];
		$secondcolor = $row_webconf['second_color'];
		$thirdcolor = $row_webconf['third_color'];
		$forthcolor = $row_webconf['forth_color'];
		$fifthcolor = $row_webconf['fifth_color'];
		$sixthcolor = $row_webconf['sixth_color'];
		$seventhcolor = $row_webconf['seventh_color'];
		$eightcolor = $row_webconf['eight_color'];
		$ninghtcolor = $row_webconf['ninght_color'];
		$tenthcolor = $row_webconf['tenth_color'];
		$menugradientcolor = $row_webconf['menu_gradient_color'];
		$buttonsize = $row_webconf['button_size'];
		$contentwidth = $row_webconf['content_width'];
		$loginbgcolor = $row_webconf['login_bg_color'];
		$customlinkregister = $row_webconf['custom_link_register'];
		$sidelogdbr = $row_webconf['custom_link_register'];

		$dmaintitle = $row_webconf['d_main'];
		$dsystemtitle = $row_webconf['d_system'];
		$dapptitle = $row_webconf['d_app'];
		$dextratitle = $row_webconf['d_extra'];
		$dtrashtitle = $row_webconf['d_trash'];
		$dabouttitle = $row_webconf['d_about'];
		$profstyleimg = $row_webconf['profstyleimg'];
		$bgsidebarimg = $row_webconf['bgsidebarimg'];

		$startedyearx = 2001;
		$date2day = date("Y-m-d");
		$yeartoday = date("Y");
		$mondthtoday = date("m");
		$daytoday = date("d");
		$yearstart = date("Y") - 18;
	} catch(PDOException $e) {
		$err = $e->getMessage();
		$err2 = strrchr($e,"1049");
		if($err2=1049){
			echo "Error: Unknown Database.<br><a href='".$dir."'>Fix It!</a>";
			die;
		}
	}
	$cnn = null;

?>