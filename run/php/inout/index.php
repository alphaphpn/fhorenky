<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Date</title>
</head>
<body>
	<?php
		// Sample time logs
		$timeLogs = [
		    "07:22", 
		];

		// Initialize variables to track state
		$state = "Out"; // Start with the employee out
		$amIn = $amOut = $pmIn = $pmOut = "";

		foreach ($timeLogs as $time) {
		    $hour = intval(explode(":", $time)[0]);
		    
		    // Check if the time is in the morning (AM) or afternoon (PM)
		    if ($hour < 12) {
		        $period = "AM";
		    } else {
		        $period = "PM";
		    }
		    
		    // Determine whether it's In or Out based on the state
		    if ($state == "Out") {
		        $state = "In";
		        if ($period == "AM") {
		            $amIn = $time;
		        } else {
		            $pmIn = $time;
		        }
		    } else {
		        $state = "Out";
		        if ($period == "AM") {
		            $amOut = $time;
		        } else {
		            $pmOut = $time;
		        }
		    }
		}

		// Output the results
		echo "AM In: $amIn\n" . "<br>";
		echo "AM Out: $amOut\n" . "<br>";
		echo "PM In: $pmIn\n" . "<br>";
		echo "PM Out: $pmOut\n" . "<br>";
	?>
</body>
</html>