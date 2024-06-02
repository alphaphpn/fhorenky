<style>
	.divider:after, 
	.divider:before {
		content: "";
		flex: 1;
		height: 1px;
		background: #eee;
	}

	.h-custom {
		height: calc(100% - 73px);
	}

	.tag-line {
		font-family: 'Brush Script MT';
		font-weight: bold;
		color: purple;
	}

	.h-80vh {
		height: 80vh;
	}

	@media (max-width: 820px) {
		.img-fluid {
			width: 62px;
		}
	}

	@media (max-width: 450px) {
		.h-custom {
			height: 100%;
		}
	}
</style>

<section class="vh-100">
	<div class="container h-custom">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-lg-6 text-center">
				<a href="../../">
					<img src="../../public/favicon-zsp.png" class="img-fluid" alt="The Logo">
				</a>
				<h2 class="tag-line">Lambo pa Sibugay</h2>
			</div>

			<div class="col-lg-6">
				<div class="overflow-y-auto h-80vh px-3">
					<form id="loginup" method="post" class="needs-validation" novalidate>
						<h2>Register here</h2>
						<hr>

						<div class="w-100 d-flex justify-content-end">
							<p><b class="text-danger">( * )</b> Required Fields</p>
						</div>
						<!-- User SignUp - Start -->
						<div class="row">
							<div class="col-md-6 form-outline mb-1">
								<input type="text" id="last_name" name="last_name" class="form-control form-control-md" placeholder="* Last Name" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col-md-6 form-outline mb-1">
								<input type="text" id="first_name" name="first_name" class="form-control form-control-md" placeholder="* First Name" required>
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-outline mb-1">
								<input type="text" id="middle_name" name="middle_name" class="form-control form-control-md" placeholder="Middle Name">
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col-md-6 form-outline mb-1">
								<input type="text" id="suffix_name" name="suffix_name" class="form-control form-control-md" placeholder="Suffix: Jr, Sr, I, II, III">
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 mb-1">
								<div class="rounded border bg-light px-1">
									<label class="form-label">* Gender</label>
									<div class="d-flex">
										<div class="form-check m-1">
											<input class="form-check-input" type="radio" name="gender" id="female" value="Female" checked required>
											<label class="form-check-label" for="female">Female</label>
										</div>
										<div class="form-check m-1">
											<input class="form-check-input" type="radio" name="gender" id="male" value="Male" required>
											<label class="form-check-label" for="male">Male</label>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col-md-6 form-outline mb-1">
								<input id="name_title" type="text" class="form-control" placeholder="Title (Atty, Dr, Engr, etc...)" name="name_title">
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 mb-1">
								<div class="rounded border bg-light px-1">
									<label>* Birthday</label>
									<div class="row">
										<div class="col-lg-3 mb-1">
											<input id="year" type="number" min="1900" max="<?php echo $yeartoday; ?>" class="form-control" placeholder="* Year" name="birth-year" value="<?php echo $yearstart; ?>" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<div class="col-lg-4 mb-1">
											<select id="month" class="form-select form-control" placeholder="* Month" name="birth-month" required>
												<option disabled value> -- select an option -- </option>
												<option value="01" data-value="January">January</option>
												<option value="02" data-value="February" selected>February</option>
												<option value="03" data-value="March">March</option>
												<option value="04" data-value="April">April</option>
												<option value="05" data-value="May">May</option>
												<option value="06" data-value="June">June</option>
												<option value="07" data-value="July">July</option>
												<option value="08" data-value="August">August</option>
												<option value="09" data-value="September">September</option>
												<option value="10" data-value="October">October</option>
												<option value="11" data-value="November">November</option>
												<option value="12" data-value="December">December</option>
											</select>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<div class="col-lg-5 mb-1">
											<input id="days" type="number" min="1" class="form-control" placeholder="* Day" name="birth-day" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
											<div>Days in month: <span id="output">31</span></div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col form-outline mb-1">
								<a href="//facebook.com/profile" target="_blank">Click here to get your facebook ID</a>
								<p>Sample Facebook ID: https://www.facebook.com/<b class="text-danger">profile.name</b></p>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-outline mb-1">
								<input id="fbid" type="text" class="form-control" placeholder="Enter facebook ID" name="fbid">
							</div>

							<div class="col-md-6 form-outline mb-1">
								<input id="email" type="email" class="form-control" placeholder="Enter email" name="email">
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 form-outline mb-1">
								<input id="phone" type="tel" pattern="[789][0-9]{9}" class="form-control mb-2" placeholder="Mobile# (9154826025)" name="phone">
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>

							<div class="col-md-6 form-outline mb-1">
								<input id="phone2" type="tel" pattern="[789][0-9]{9}" class="form-control mb-2" placeholder="2nd Mobile#" name="phone2">
								<div class="valid-feedback">Valid.</div>
								<div class="invalid-feedback">Please fill out this field.</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-12 mb-1">
								<div class="rounded border bg-light px-1">
									<label>If Registered Voter</label>

									<div class="row">
										<div class="col-md-6 form-outline mb-1">
											<input id="voters_id" type="text" class="form-control" placeholder="Voter's ID" name="voters_id">
										</div>
										<div class="col-md-6 form-outline mb-1">
											<input id="presinct_no" type="text" class="form-control" placeholder="Precinct No." name="presinct_no">
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-outline mb-1">
											<input id="town" type="text" class="form-control" placeholder="Municipality" name="town">
										</div>
										<div class="col-md-6 form-outline mb-1">
											<input id="barangay" type="text" class="form-control" placeholder="Barangay" name="barangay">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- User SignUp - End -->

						<div class="d-flex justify-content-between align-items-center">
							<!-- ?php include_once "../../lib/login/index.php"; ? -->
						</div>

						<div class="text-center text-lg-start mt-4 pt-2">
							<button id="btnSubmit" type="submit" name="btnSubmit" class="btn btn-primary" style="padding-left: 2.5rem; padding-right: 2.5rem;">Submit <i class='fas fa-key'></i></button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">Copyright © 2024. All rights reserved.</div>
		<!-- Copyright -->

		<!-- Right -->
		<div>
			<a href="#!" class="text-white text-decoration-none me-4">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="#!" class="text-white text-decoration-none me-4">
				<i class="fab fa-twitter"></i>
			</a>
			<a href="#!" class="text-white text-decoration-none me-4">
				<i class="fab fa-google"></i>
			</a>
			<a href="#!" class="text-white text-decoration-none">
				<i class="fab fa-linkedin-in"></i>
			</a>
		</div>
		<!-- Right -->
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