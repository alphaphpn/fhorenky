<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Date</title>
</head>
<body>
	<?php
		// Example start and end times
		$startTime = '11:30:00';
		$endTime = '12:00:00';

		// Create DateTime objects from the time strings
		$startDateTime = new DateTime($startTime);
		$endDateTime = new DateTime($endTime);

		// Calculate the difference between the two times
		$timeDifference = $startDateTime->diff($endDateTime);

		// Get the difference in hours, minutes, and seconds
		$hours = $timeDifference->h;
		$minutes = $timeDifference->i;
		$seconds = $timeDifference->s;

		// Display the result
		echo "Time Difference: $hours hours, $minutes minutes, $seconds seconds\n";
	?>
</body>
</html>