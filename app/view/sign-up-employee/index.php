	<section id="sign-up" class="w-100 mh-100 py-5">
		<div class="container mh-100">
			<div class="card m-auto" style="max-width: 1024px;">
				<form method="post" class="was-validated">
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

						<div class="row justify-content-center">Please Look into the Camera when taking the Photo.</div>

						<div class="row mb-2 justify-content-center">
							<div id="disp-vid" class="col-md-4 mb-2">
								<video id="video" title="Picture" class="border w-100 h-auto" autoplay></video>
							</div>

							<div id="disp-pix" class="col-md-4 mb-2 d-none">
								<canvas id="canvas" class="border w-100"></canvas>
							</div>

							<div class="col-md-4 mb-2 d-none">
								<textarea id="imgdata" class="w-100"></textarea>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col mb-2 text-center">
								<button id="start-camera" class="btn btn-primary">Start Camera</button>
								<button id="retake-photo" class="btn btn-warning d-none">Re-Take Photo</button>
								<button id="click-photo" class="btn btn-success d-none">Click Photo</button>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col">
								<a href="//facebook.com/profile" target="_blank">Click here to get your facebook ID</a>
								<p>Sample Facebook ID: https://www.facebook.com/[profile.name]</p>
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
							<div class="col-lg-4 mb-2">
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
							<div class="col-md-3">
								<label class="form-label">* Gender</label>
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

							<div class="col-md-3">
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

							<div class="col-md-3">
								<label class="form-label">* Office</label>
								<select id="office" class="form-select form-control mb-2" placeholder="* Office" name="office" required>
									<option id="1" value="OPG" data-code="1011" data-value="Governor">Governor</option>
									<option id="2" value="OPVG" data-code="1016" data-value="Vice Governor">Vice Governor</option>
									<option id="3" value="OPAd" data-code="1031" data-value="Administrator">Administrator</option>
									<option id="4" value="OPSec" data-code="1022" data-value="Secretary">Secretary</option>
									<option id="" value="OPAcc" data-code="1081" data-bio-location="" data-value="Accounting">Accounting</option>
									<option id="" value="OPAg" data-code="8711" data-value="Agriculture">Agriculture</option>
									<option id="" value="OPB" data-code="1071" data-value="Budget">Budget</option>
									<option id="" value="OPC" data-code="8761" data-value="Cooperative">Coop</option>
									<option id="5" value="OPDRRM" data-code="9940" data-value="Disaster Risk Reduction Management">Disaster Risk Reduction Management</option>
									<option id="" value="OPGS" data-code="1061" data-value="General Services">General Services</option>
									<option id="" value="OPH" data-code="4411" data-value="Health">Health</option>
									<option id="" value="OPHRM" data-code="1032" data-value="Human Resource Management">Human Resource Management</option>
									<option id="" value="BAC" data-code="1061-969" data-value="Bids and Awards Committee">Bids and Awards Committee</option>
									<option id="" value="OPL" data-code="" data-value="Legal">Legal</option>
									<option id="" value="OPAss" data-code="1101" data-value="Assessor">Assessor</option>
									<option id="" value="OPENR" data-code="8731" data-value="Environment and Natural Resources">Environment and Natural Resources</option>
									<option id="" value="OPE" data-code="8751" data-value="Engineering">Engineering</option>
									<option id="" value="OPPDC" data-code="1041" data-value="Planning and Development Council">Planning and Development Council</option>
									<option id="" value="OPSWD" data-code="7611" data-value="Social Welfare Development">Social Welfare Development</option>
									<option id="" value="OPT" data-code="1091" data-value="Treasurer">Treasurer</option>
									<option id="" value="OPVet" data-code="" data-value="Veterenary">Veterenary</option>
									<option id="" value="OPRECY" data-code="" data-value="Rehabilitation Center for Youth">Rehabilitation Center for Youth</option>
									<option id="" value="OPN" data-code="" data-value="Nutrition">Nutrition</option>
									<option id="" value="OPTour" data-code="" data-value="Tourism">Tourism</option>
									<option id="" value="OPICT" data-code="" data-value="Information and Communications Technology">Information and Communications Technology</option>
								</select>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col-md-3">
								<label class="form-label">* Biometric Location</label>
								<select id="bio-location" class="form-select form-control mb-2" placeholder="* Office" name="office" required>
									<option value="PGO">PGO</option>
									<option value="OPAd">OPAd</option>
									<option value="OPAd2">OPAd2</option>
									<option value="Accounting">Accounting</option>
									<option value="Agri">Agri</option>
									<option value="Budget">Budget</option>
									<option value="Coop">Coop</option>
									<option value="DRR">DRR</option>
									<option value="GSO">GSO</option>
									<option value="Health">Health</option>
									<option value="HR">HR</option>
									<option value="Legal">Legal</option>
									<option value="PAssO">PAssO</option>
									<option value="PENRO">PENRO</option>
									<option value="PEO1">PEO1</option>
									<option value="PEO2">PEO2</option>
									<option value="PPDO">PPDO</option>
									<option value="PRECY">PRECY</option>
									<option value="PSWD">PSWD</option>
									<option value="PTO">PTO</option>
									<option value="PVet">PVet</option>
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
									<select id="municipality" class="form-select form-control mb-2" name="municipality" required>
										<option value="7001" data-district="II" data-value="Ipil">Ipil (Capital)</option>
										<option value="7004" data-district="II" data-value="Naga">Naga</option>
										<option value="7003" data-district="II" data-value="Titay">Titay</option>
										<option value="7005" data-district="II" data-value="Kabasalan">Kabasalan</option>
										<option value="7006" data-district="II" data-value="Siay">Siay</option>
										<option value="7002" data-district="II" data-value="R.T. Lim">R.T. Lim</option>
										<option value="7018" data-district="II" data-value="Tungawan">Tungawan</option>

										<option value="7009" data-district="I" data-value="Buug">Buug</option>
										<option value="7007" data-district="I" data-value="Imelda">Imelda</option>
										<option value="7039" data-district="I" data-value="Diplahan">Diplahan</option>
										<option value="7038" data-district="I" data-value="Malangas">Malangas</option>
										<option value="7040" data-district="I" data-value="Alicia">Alicia</option>
										<option value="7010" data-district="I" data-value="Mabuhay">Mabuhay</option>
										<option value="7012" data-district="I" data-value="Talusan">Talusan</option>
										<option value="7041" data-district="I" data-value="Olutanga">Olutanga</option>
										<option value="7008" data-district="I" data-value="Payao">Payao</option>
									</select>
									<div class="valid-feedback">Valid.</div>
									<div class="invalid-feedback">Please fill out this field.</div>
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
		let dispvid = document.querySelector("#disp-vid");
		let video = document.querySelector("#video");
		let retakephoto = document.querySelector("#retake-photo");
		let click_button = document.querySelector("#click-photo");
		let disppix = document.querySelector("#disp-pix");
		let canvas = document.querySelector("#canvas");
		let imgdata = document.querySelector("#imgdata");

		let videowidth = video.offsetWidth;
		let videoheight = video.offsetHeight;

		camera_button.addEventListener('click', async function() {
			let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
			video.srcObject = stream;

			camera_button.classList.add("d-none");
			click_button.classList.remove('d-none');
		});

		click_button.addEventListener('click', async function() {
			// dispvid.classList.add("d-none");
			disppix.classList.remove('d-none');

			canvas.getContext('2d').drawImage(video, 0, 0, videowidth, videoheight);
			canvas.style.width = videowidth+'px';
			canvas.style.height = video.offsetHeight+'px';
			let image_data_url = canvas.toDataURL('image/jpeg');

			// data url of the image
			// console.log(image_data_url);
			imgdata.value = image_data_url;

			retakephoto.classList.remove('d-none');
			click_button.classList.add('d-none');
		});

		retakephoto.addEventListener('click', function() {
			// dispvid.classList.remove("d-none");
			disppix.classList.add('d-none');

			camera_button.classList.add("d-none");
			retakephoto.classList.add('d-none');
			click_button.classList.remove('d-none');
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