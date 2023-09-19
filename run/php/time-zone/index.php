<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Time Zone</title>
</head>
<body>
	<?php
		date_default_timezone_set("America/New_York");
		echo "The time is " . date("h:i:sa");
	?>
</body>
</html>