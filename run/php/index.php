<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Run PHP</title>
</head>
<body>

    <div id="output">0</div>

<script>
    function startCountdown(seconds) {
  let counter = seconds;
    
  const interval = setInterval(() => {
    console.log(counter);
    counter--;
      
    if (counter < 0 ) {
      clearInterval(interval);
      console.log('Ding!');
      document.getElementById('output').innerHTML = '0';
    } else {
      document.getElementById('output').innerHTML = counter;
    }
  }, 100);
}

  startCountdown(9);
</script>


</body>
</html>