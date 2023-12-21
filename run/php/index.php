<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Run PHP</title>
</head>
<body>

<?php
    // Function to generate a random raffle number within a specified range
    function generateRaffleNumber($min = 1, $max = 50000) {
        return rand($min, $max);
    }

    // Example usage
    $raffleNumber = substr(str_repeat(0, 6).generateRaffleNumber(), - 6);

    echo "Generated Raffle Number: $raffleNumber <br>";
?>

<div id="output"><?php echo $raffleNumber; ?></div>

<script>
    function shuffleArray(array) {
        for (var i = array.length - 1; i > 0; i--) {
            var j = Math.floor(Math.random() * (i + 1));
            // Swap array[i] and array[j]
            [array[i], array[j]] = [array[j], array[i]];
        }
    }

    function displayCharacters(word) {
        var outputDiv = document.getElementById('output');
        outputDiv.innerHTML = ''; // Clear the previous content

        var shuffledWord = word.split('');
        shuffleArray(shuffledWord);

        for (var i = 0; i < word.length; i++) {
            (function(index) {
                setTimeout(function() {
                    outputDiv.innerHTML += shuffledWord[index];
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