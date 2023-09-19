	<section id="sign-up" class="w-100 mh-100 py-5">
		<div class="container mh-100">
			<div class="card m-auto" style="max-width: 1024px;">
				<form id="empreg" method="post" class="was-validated" enctype="multipart/form-data">
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
							<div class="col">
								<a href="//facebook.com/profile" target="_blank">Click here to get your facebook ID</a>
								<p>Sample Facebook ID: https://www.facebook.com/[profile.name]</p>
								<input id="fbid" type="text" class="form-control" placeholder="Enter facebook ID" name="fbid">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input id="phone" type="tel" pattern="[789][0-9]{9}" class="form-control mb-2" placeholder="Enter Mobile# (9154826025)" name="phone">
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-6">
								<input type="text" class="form-control" placeholder="Enter email" name="email">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input id="first-name" type="text" class="form-control mb-2" placeholder="* First Name" name="first-name" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-6">
								<input id="middle-name" type="text" class="form-control" placeholder="Middle Name" name="middle-name">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input id="last-name" type="text" class="form-control mb-2" placeholder="* Last Name" name="last-name" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
							<div class="col-lg-2">
								<input id="suffix" type="text" class="form-control mb-2" placeholder="Suffix" name="suffix">
							</div>
							<div class="col-lg-4">
								<input id="name-title" type="text" class="form-control" placeholder="Title (Atty, Dr, Engr, etc...)" name="name-title">
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
								<input id="days" type="number" min="1" class="form-control" placeholder="* Day" name="birth-day" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
								<div>Days in month: <span id="output">31</span></div>
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
									<option disabled selected value> -- select an option -- </option>
									<option id="emptypex-1" value="1" data-value="EXEC" label="Executive">
									<option id="emptypex-2" value="2" data-value="LEG" label="Legislative">
									<option id="emptypex-3" value="3" data-value="OFFR" label="Officer">
									<option id="emptypex-4" value="4" data-value="COT" label="Coterminous">
									<option id="emptypex-5" value="5" data-value="REG" label="Regular">
									<option id="emptypex-6" value="6" data-value="TMP" label="Temporary">
									<option id="emptypex-7" value="7" data-value="COS" label="Contract of Service">
									<option id="emptypex-8" value="8" data-value="JO" label="Job Order">
								</select>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col-md-3">
								<label class="form-label">* Office</label>
								<input list="officelists" id="office" name="office" class="form-control" placeholder="Office" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>

								<datalist id="officelists">
								<?php
									$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
									$stmt_officelist = $cnn->prepare("SELECT * FROM office_tbl");
									$stmt_officelist->execute();
									$result_officelist = $stmt_officelist->setFetchMode(PDO::FETCH_ASSOC);
									foreach ($stmt_officelist as $row_officelist) {
										echo "<option id='".$row_officelist['officeid']."' value='".htmlspecialchars($row_officelist['officename'])."' data-value='".htmlspecialchars($row_officelist['officecode'])."' data-title='".htmlspecialchars($row_officelist['officetitle'])."' data-abvr='".htmlspecialchars($row_officelist['officeabrv'])."' data-head='".htmlspecialchars($row_officelist['headofficer'])."' data-htitle='".htmlspecialchars($row_officelist['headtitle'])."' data-authead='".htmlspecialchars($row_officelist['auth_head'])."' data-autheadtitle='".htmlspecialchars($row_officelist['auth_title'])."' data-authdesc='".htmlspecialchars($row_officelist['auth_description'])."'></option>";
									}
								?>
								</datalist>
							</div>

							<div class="col-md-3">
								<label class="form-label">* Biometric Location</label>
								<select id="bio-location" class="form-select form-control mb-2" placeholder="* Office" name="bio-location" required>
									<option disabled selected value> -- select an option -- </option>
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

							<div class="col">
								<label class="form-label">Employed Year</label>
								<input id="yrempd" type="number" min="2001" max="<?php echo $yeartoday; ?>" value="<?php echo $yeartoday; ?>" class="form-control" placeholder="Employed Year" name="yrempd" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
						</div>

						<div class="row" hidden>
							<div class="col">
								<input id="emptypeabv" type="text" name="emptypeabv" class="form-control mb-2" readonly>
								<input id="emptypedesc" type="text" name="emptypedesc" class="form-control mb-2" readonly>

								<input id="officeid" type="text" name="officeid" class="form-control mb-2" readonly>
								<input id="officecode" type="text" name="officecode" class="form-control mb-2" readonly>
								<input id="officetitle" type="text" name="officetitle" class="form-control mb-2" readonly>
								<input id="officeabrv" type="text" name="officeabrv" class="form-control mb-2" readonly>
								<input id="headofcr" type="text" name="headofcr" class="form-control mb-2" readonly>
								<input id="headtitle" type="text" name="headtitle" class="form-control mb-2" readonly>
								<input id="authhead" type="text" name="authhead" class="form-control mb-2" readonly>
								<input id="authtitle" type="text" name="authtitle" class="form-control mb-2" readonly>
								<input id="authdesc" type="text" name="authdesc" class="form-control mb-2" readonly>
							</div>
						</div>

						<hr>

						<div class="row">
							<div class="col">
								<p class="text-center">Please Look into the Camera when taking the Photo.</p>
							</div>
						</div>

						<div class="row mb-2 justify-content-center">
							<div id="disp-vid" class="col-md-4 mb-2">
								<video id="video" title="Picture" class="border w-100 h-auto" autoplay></video>
							</div>

							<div id="disp-pix" class="col-md-4 mb-2 d-none">
								<canvas id="canvas" class="border w-100"></canvas>
							</div>

							<div class="col-md-4 mb-2 d-none">
								<textarea id="imgdata" class="w-100" name="imgdata"></textarea>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col mb-2 text-center">
								<button id="start-camera" class="btn btn-primary">Start Camera</button>
								<button id="retake-photo" class="btn btn-warning d-none">Re-Take Photo</button>
								<button id="click-photo" class="btn btn-success d-none">Click Photo</button>
							</div>
						</div>
					</div>
					<div class="card-footer">
						<div class="w-100 d-flex flex-wrap justify-content-center">
							<?php include_once "add-record.php"; ?>
						</div>
						<div class="w-100 d-flex flex-wrap justify-content-end">
							<button type="submit" class="btn btn-danger m-2" name="btnSubmit" >Submit</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>

	<script>
		function daysInMonth (month, year) {
			return new Date(parseInt(year), parseInt(month), 0).getDate();
		};

		const byId = (id) => document.getElementById(id);
		const monthSelect = byId("month");
		const yearSelect = byId("year");
		const daysSelect = byId("days");

		const updateOutput = () => { 
			byId("output").innerText = daysInMonth(monthSelect.value, yearSelect.value);
			byId("days").max = daysInMonth(monthSelect.value, yearSelect.value);
			byId("days").value = daysInMonth(monthSelect.value, yearSelect.value);
		};
		updateOutput();

		[monthSelect, yearSelect].forEach((domNode) => { 
			domNode.addEventListener("change", updateOutput);
		});

		let camera_button = document.querySelector("#start-camera");
		let dispvid = document.querySelector("#disp-vid");
		let video = document.querySelector("#video");
		let retakephoto = document.querySelector("#retake-photo");
		let click_button = document.querySelector("#click-photo");
		let disppix = document.querySelector("#disp-pix");
		let canvas = document.querySelector("#canvas");
		let imgdata = document.querySelector("#imgdata");

		let typeemployee = document.querySelector("#type-employee");
		let emptypeabv = document.querySelector("#emptypeabv");
		let emptypedesc = document.querySelector("#emptypedesc");

		let office = document.querySelector("#office");
		let officeid = document.querySelector("#officeid");
		let officecode = document.querySelector("#officecode");
		let officetitle = document.querySelector("#officetitle");
		let officeabrv = document.querySelector("#officeabrv");
		let headofcr = document.querySelector("#headofcr");
		let headtitle = document.querySelector("#headtitle");
		let authhead = document.querySelector("#authhead");
		let authtitle = document.querySelector("#authtitle");
		let authdesc = document.querySelector("#authdesc");

		let videowidth = video.offsetWidth;
		let videoheight = video.offsetHeight;

		camera_button.addEventListener('click', async function() {
			let stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
			video.srcObject = stream;

			camera_button.classList.add("d-none");
			click_button.classList.remove('d-none');
		});

		click_button.addEventListener('click', async function() {
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

		retakephoto.addEventListener('click', async function() {
			disppix.classList.add('d-none');

			camera_button.classList.add("d-none");
			retakephoto.classList.add('d-none');
			click_button.classList.remove('d-none');
		});

		typeemployee.addEventListener('change', async function() {
			var empvalx = typeemployee.value;

			console.log(empvalx);

			emptypeabv.value = document.querySelector('option[id="emptypex-' + empvalx + '"]').dataset.value;
			emptypedesc.value = document.querySelector('option[id="emptypex-' + empvalx+ '"]').label;
		});

		office.addEventListener('change', async function() {
			var officeval = office.value;

			officeid.value = document.querySelector('option[value="' + officeval + '"]').id;
			officecode.value = document.querySelector('option[value="' + officeval + '"]').dataset.value;
			officetitle.value = document.querySelector('option[value="' + officeval + '"]').dataset.title;
			officeabrv.value = document.querySelector('option[value="' + officeval + '"]').dataset.abvr;
			headofcr.value = document.querySelector('option[value="' + officeval + '"]').dataset.head;
			headtitle.value = document.querySelector('option[value="' + officeval + '"]').dataset.htitle;
			authhead.value = document.querySelector('option[value="' + officeval + '"]').dataset.authead;
			authtitle.value = document.querySelector('option[value="' + officeval + '"]').dataset.autheadtitle;
			authdesc.value = document.querySelector('option[value="' + officeval + '"]').dataset.authdesc;
		});
	</script>