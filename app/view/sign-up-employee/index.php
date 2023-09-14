	<section id="sign-up" class="w-100 mh-100 py-5">
		<div class="container mh-100">
			<div class="card m-auto" style="max-width: 1024px;">
				<form method="post" class="needs-validation">
					<div class="card-header">
						<div class="w-100 d-flex justify-content-between">
							<label>
								Employee Sign-up <br>
								Exclusive only in PLGU-ZSP
							</label>
							<a href="" class="btn btn-primary">Reload</a>
						</div>
					</div>
					<div class="card-body">
						<div class="w-100 d-flex justify-content-end">
							<p><b class="text-danger">( * )</b> Required Fields</p>
						</div>

						<div class="row mb-2">
							<div class="col-md-4">
								<video id="video" width="100%" height="240" autoplay></video>
								<hr>
								<button id="start-camera" class="btn btn-primary">Start Camera</button>
							</div>
							<div class="col-md-4">
								<canvas id="canvas" height="240" class="w-100"></canvas>
								<hr>
								<button id="click-photo" class="btn btn-success">Click Photo</button>
							</div>
							<div class="col-md-4">
								<textarea id="imgdata" class="w-100"></textarea>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col">
								<a href="//facebook.com/profile" target="_blank">Click here to get your facebook ID</a>
								<input type="text" class="form-control" placeholder="Enter facebook ID" name="facebook">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input type="tel" pattern="[789][0-9]{9}" class="form-control mb-2" placeholder="* Enter Mobile# (9154826025)" name="phone" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-6">
								<input type="text" class="form-control" placeholder="Enter email" name="email">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input type="text" class="form-control mb-2" placeholder="* First Name" name="first-name" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-6">
								<input type="text" class="form-control" placeholder="Middle Name" name="middle-name">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input type="text" class="form-control mb-2" placeholder="* Last Name" name="last-name" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-2">
								<input type="text" class="form-control mb-2" placeholder="Suffix" name="suffix">
							</div>
							<div class="col-lg-4">
								<input type="text" class="form-control" placeholder="Title (Atty., Dr., Engr., etc...)" name="name-title">
							</div>
						</div>

						<div class="row mb-2">
							<label>* Birthday</label>
							<div class="col-lg-4">
								<input id="year" type="number" min="1900" max="<?php echo $yeartoday; ?>" class="form-control" placeholder="* Year" name="birth-year" value="<?php echo $yearstart; ?>" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-5">
								<select id="month" class="form-select form-control mb-2" placeholder="* Month" name="birth-month" required>
									<option value="1" data-value="January">January</option>
									<option value="2" data-value="February">February</option>
									<option value="3" data-value="March">March</option>
									<option value="4" data-value="April">April</option>
									<option value="5" data-value="May">May</option>
									<option value="6" data-value="June">June</option>
									<option value="7" data-value="July">July</option>
									<option value="8" data-value="August">August</option>
									<option value="9" data-value="September">September</option>
									<option value="10" data-value="October">October</option>
									<option value="11" data-value="November">November</option>
									<option value="12" data-value="December">December</option>
								</select>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-3">
								<input id="days" type="number" class="form-control" placeholder="* Day" name="birth-day" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
								<div>Days in month: <span id="output"></span></div>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col">
								<label class="form-label">* Gender</label>
								<div class="d-flex">
									<div class="form-check m-3">
										<input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
										<label class="form-check-label" for="female">Female</label>
									</div>
									<div class="form-check m-3">
										<input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
										<label class="form-check-label" for="male">Male</label>
										<div class="valid-feedback">Valid.</div>
										<div class="invalid-feedback">Please fill out this field.</div>
									</div>
								</div>
							</div>

							<div class="col">
								<label class="form-label">* Type of Employee</label>
								<select id="type-employee" class="form-select form-control mb-2" name="type-employee" required>
									<option value="1" data-value="EXEC">Executive</option>
									<option value="2" data-value="LEG">Legislative</option>
									<option value="3" data-value="OFFR">Officer</option>
									<option value="4" data-value="COT">Coterminous</option>
									<option value="5" data-value="REG">Regular</option>
									<option value="6" data-value="TMP">Temporary</option>
									<option value="7" data-value="COS">Contract of Service</option>
									<option value="8" data-value="JO">Job Order</option>
								</select>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col">
								<label class="form-label">* Office</label>
								<select id="office" class="form-select form-control mb-2" placeholder="* Office" name="office" required>
									<option value="OPAcc" data-bio-location="" data-value="Accounting">Accounting</option>
									<option value="OPAg" data-value="Agriculture">Agriculture</option>
									<option value="3" data-value="March">March</option>
									<option value="4" data-value="April">April</option>
									<option value="5" data-value="May">May</option>
									<option value="6" data-value="June">June</option>
									<option value="7" data-value="July">July</option>
									<option value="8" data-value="August">August</option>
									<option value="9" data-value="September">September</option>
									<option value="10" data-value="October">October</option>
									<option value="11" data-value="November">November</option>
									<option value="12" data-value="December">December</option>
								</select>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col">
								<label class="form-label">* Biometric Location</label>
								<select id="bio-location" class="form-select form-control mb-2" placeholder="* Office" name="office" required>
									<option value="OPAcc" data-bio-location="" data-value="Accounting">Accounting</option>
									<option value="OPAg" data-value="Agriculture">Agriculture</option>
									<option value="3" data-value="March">March</option>
									<option value="4" data-value="April">April</option>
									<option value="5" data-value="May">May</option>
									<option value="6" data-value="June">June</option>
									<option value="7" data-value="July">July</option>
									<option value="8" data-value="August">August</option>
									<option value="9" data-value="September">September</option>
									<option value="10" data-value="October">October</option>
									<option value="11" data-value="November">November</option>
									<option value="12" data-value="December">December</option>
								</select>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col">
								<label class="form-label">Employee ID</label>
								<input id="empid" type="number" class="form-control" placeholder="Employee ID" name="empid">
							</div>

							<div class="col">
								<label class="form-label">Biometric No.</label>
								<input id="bioid" type="number" class="form-control" placeholder="Biometric Number" name="bioid">
							</div>
						</div>

						<div class="border p-3">
							<label class="form-label">Voter's Information</label>
							<hr>
							<div class="row mb-2">
								<div class="col-sm-3">
									<label class="form-label">Municipality</label>
									<select id="municipality" class="form-select form-control mb-2" name="municipality">
										<option value="7001" data-value="Ipil">Ipil</option>
										<option value="7002" data-value="R.T. Lim">R.T. Lim</option>
										<option value="7003" data-value="Titay">Titay</option>
										<option value="7004" data-value="Naga">Naga</option>
										<option value="7005" data-value="Kabasalan">Kabasalan</option>
										<option value="7006" data-value="Siay">Siay</option>
										<option value="7007" data-value="Imelda">Imelda</option>
										<option value="7008" data-value="Payao">Payao</option>
									</select>
								</div>

								<div class="col-sm-2">
									<label class="form-label">Barangay</label>
									<input id="purok" type="text" class="form-control" placeholder="Barangay" name="purok">
								</div>

								<div class="col-sm-2">
									<label class="form-label">Purok</label>
									<input id="purok" type="text" class="form-control" placeholder="Purok" name="purok">
								</div>

								<div class="col-sm-2">
									<label class="form-label">Precint No.</label>
									<input id="precint-no" type="text" class="form-control" placeholder="Precint No." name="precint-no">
								</div>

								<div class="col-sm-3">
									<label class="form-label">Voter's ID</label>
									<input id="vin" type="text" class="form-control" placeholder="Voter's ID" name="vin">
								</div>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="w-100 d-flex flex-wrap justify-content-end">
							<button type="submit" class="btn btn-danger m-2">Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<script>
		let camera_button = document.querySelector("#start-camera");
		let video = document.querySelector("#video");
		let click_button = document.querySelector("#click-photo");
		let canvas = document.querySelector("#canvas");
		let imgdata = document.querySelector("#imgdata");

		camera_button.addEventListener('click', async function() {
			let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
			video.srcObject = stream;
		});

		click_button.addEventListener('click', function() {
			canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
			let image_data_url = canvas.toDataURL('image/jpeg');

			// data url of the image
			console.log(image_data_url);
			imgdata.value = image_data_url;
		});

		function daysInMonth (month, year) {
			return new Date(parseInt(year), parseInt(month), 0).getDate();
		}

		const byId = (id) => document.getElementById(id);
		const monthSelect = byId("month");
		const yearSelect = byId("year");
		const daysSelect = byId("days");

		const updateOutput = () => { 
			byId("output").innerText = daysInMonth(monthSelect.value, yearSelect.value);
			byId("days").max = daysInMonth(monthSelect.value, yearSelect.value);
		}
		updateOutput();

		[monthSelect, yearSelect].forEach((domNode) => { 
			domNode.addEventListener("change", updateOutput)
		})
	</script>