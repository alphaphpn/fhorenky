<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Date</title>
</head>
<body>
	<?php
		date_default_timezone_set("Asia/Taipei");
		echo "Today is " . date("Y/m/d") . "<br>";
		echo "Today is " . date("Y.m.d") . "<br>";
		echo "Today is " . date("Y-m-d") . "<br>";
		echo "Timestamp is " . date("Y-m-d H:m:s") . "<br>";
		echo "Today is " . date("l");
	?>
</body>
</html>