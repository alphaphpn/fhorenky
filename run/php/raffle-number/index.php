<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Raffle Number</title>
	<link href="https://fonts.cdnfonts.com/css/lcd" rel="stylesheet">
	<style>
		.raffle-section {
			text-align: center;
			height: 100vh;
			display: flex;
		}

		#output {
			margin: auto;
			font-size: 32em;
			font-family: 'Arial', sans-serif;
		}
	</style>
</head>
<body>
	<?php
		// Function to generate a random raffle number within a specified range
		function generateRaffleNumber($min = 1, $max = 50000) {
			return rand($min, $max);
		}

		// Example usage
		$raffleNumber = substr(str_repeat(0, 6).generateRaffleNumber(), - 6);

		// echo "Generated Raffle Number: $raffleNumber <br>";
	?>

	<div class="raffle-section">
		<div id="output"><?php echo $raffleNumber; ?></div>
	</div>

	<script>
		function displayCharacters(word) {
			var outputDiv = document.getElementById('output');
			outputDiv.innerHTML = ''; // Clear the previous content

			for (var i = 0; i < word.length; i++) {
				(function(index) {
					setTimeout(function() {
						outputDiv.innerHTML += word[index];
					}, i * 1000); // Adjust the delay (in milliseconds) between characters
				})(i);
			}
		}

		// Example usage
		var wordToDisplay = document.getElementById('output').innerHTML;
		displayCharacters(wordToDisplay);
	</script>
</body>
</html>