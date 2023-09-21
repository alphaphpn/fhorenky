<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Date</title>
</head>
<body>
	<?php

		$timezone_identifiers = DateTimeZone::listIdentifiers();

		foreach($timezone_identifiers as $key => $list) {
			echo $list . "<br/>";
		}
	?>
</body>
</html>