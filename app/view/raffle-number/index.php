	<?php
		// Function to generate a random raffle number within a specified range
		function generateRaffleNumber($min = 1, $max = 30000) {
			return rand($min, $max);
		}

		// Example usage
		$raffleNumber = substr(str_repeat(0, 5).generateRaffleNumber(), - 5);

		$digit1 = $raffleNumber[0];
		$digit2 = $raffleNumber[1];
		$digit3 = $raffleNumber[2];
		$digit4 = $raffleNumber[3];
		$digit5 = $raffleNumber[4];

		// echo "Generated Raffle Number: $raffleNumber <br>";
		// echo "Digit 1: $digit1 <br>";
		// echo "Digit 2: $digit2 <br>";
		// echo "Digit 3: $digit3 <br>";
		// echo "Digit 4: $digit4 <br>";
		// echo "Digit 5: $digit5 <br>";
	?>

	<section>
		<div class="container py-10rem">
			<div class="card vh-65">
				<div class="card-header text-end">
					<a href="" class="btn btn-primary">Reset</a>
					<button class="btn btn-danger" name="btndraw" id="btndraw" onclick="nextclick();">Draw</button>
				</div>
				<div class="card-body scrollable">
					<form>
						<div class="row">
							<div class="col">
								<input type="number" class="form-control int-raffle" value="0" min="0" max="9" name="int1" id="int1" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control int-raffle" value="0" min="0" max="9" name="int2" id="int2" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control int-raffle" value="0" min="0" max="9" name="int3" id="int3" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control int-raffle" value="0" min="0" max="9" name="int4" id="int4" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control int-raffle" value="0" min="0" max="9" name="int5" id="int5" readonly>
							</div>
						</div>

						<!-------->

						<div class="row" hidden>
							<div class="col">
								<input type="number" class="form-control text-center" value="<?php echo $digit1; ?>" min="0" max="9" name="int11" id="int11" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control text-center" value="<?php echo $digit2; ?>" min="0" max="9" name="int12" id="int12" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control text-center" value="<?php echo $digit3; ?>" min="0" max="9" name="int13" id="int13" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control text-center" value="<?php echo $digit4; ?>" min="0" max="9" name="int14" id="int14" readonly>
							</div>

							<div class="col">
								<input type="number" class="form-control text-center" value="<?php echo $digit5; ?>" min="0" max="9" name="int15" id="int15" readonly>
							</div>
						</div>

						<!-------->

						<div class="row">
							<div class="col">
								<input type="button" data-out="int1" data-result="<?php echo $digit1; ?>" class="form-control" name="btnd1" id="btnd1" value="*" onclick="startCountdown(9,dataset.out,dataset.result);" hidden>
							</div>

							<div class="col">
								<input type="button" data-out="int2" data-result="<?php echo $digit2; ?>" class="form-control" name="btnd2" id="btnd2" value="*" onclick="startCountdown(9,dataset.out,dataset.result);" hidden>
							</div>

							<div class="col">
								<input type="button" data-out="int3" data-result="<?php echo $digit3; ?>" class="form-control" name="btnd3" id="btnd3" value="*" onclick="startCountdown(9,dataset.out,dataset.result);" hidden>
							</div>

							<div class="col">
								<input type="button" data-out="int4" data-result="<?php echo $digit4; ?>" class="form-control" name="btnd4" id="btnd4" value="*" onclick="startCountdown(9,dataset.out,dataset.result);" hidden>
							</div>

							<div class="col">
								<input type="button" data-out="int5" data-result="<?php echo $digit5; ?>" class="form-control" name="btnd5" id="btnd5" value="*" onclick="startCountdown(9,dataset.out,dataset.result);" hidden>
							</div>
						</div>
					</form>
				</div>
				<div class="card-footer"></div>
			</div>
		</div>
	</section>

	<script>
		function nextclick() {
			btnd1 = document.getElementById('btnd1');
			btnd2 = document.getElementById('btnd2');
			btnd3 = document.getElementById('btnd3');
			btnd4 = document.getElementById('btnd4');
			btnd5 = document.getElementById('btnd5');
			btndraw = document.getElementById('btndraw');

			btnd1.click();
			btnd2.click();
			btnd3.click();
			btnd4.click();
			btnd5.click();

			btndraw.hidden = true;
		}

		function startCountdown(seconds,output,result) {
			let counter = seconds;

			const interval = setInterval(() => {
				console.log(counter);
				counter--;

				if (counter < result ) {
					clearInterval(interval);
					console.log(result);
					document.getElementById(output).value = result;
				} else {
					document.getElementById(output).value = counter;
				}
			}, 100);
		}
	</script>