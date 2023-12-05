<!DOCTYPE html>
<html>
<body>

<?php
// Replace these values with your actual time values
$expectedTime = new DateTime('8:00'); // Replace with the scheduled time
$currentTime = new DateTime('9:08'); // Current time

// Calculate lateness
$lateness = $currentTime->diff($expectedTime);

// Display the lateness
echo "Expected Time: " . $expectedTime->format('h:i') . "\n";
echo "Current Time: " . $currentTime->format('h:i') . "\n";
echo "Lateness: " . $lateness->format('%h:%I') . "\n";
?>

</body>
</html>