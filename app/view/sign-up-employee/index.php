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
							<div class="col">
								<a href="//facebook.com/profile" target="_blank">Click here to get your facebook ID</a>
								<input type="url" class="form-control" placeholder="Enter facebook ID" name="facebook">
							</div>
						</div>

						<div class="row mb-2">
							<div class="col-lg-6">
								<input type="tel" pattern="[789][0-9]{9}" class="form-control mb-2" placeholder="* Enter Mobile# (do not include 0 at first)" name="phone" required>
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
								<input id="year" type="number" min="1900" max="<?php echo $yeartoday; ?>" class="form-control" placeholder="* Year" name="birth-year" required>
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
								<label>* Gender</label>
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
								<label>* Type of Employee</label>
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
								<label>* Office</label>
							</div>

							<div class="col">
								<label>* Biometric Location</label>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col">
								<label>Employee ID</label>
								<input id="empid" type="number" class="form-control" placeholder="Employee ID" name="empid">
							</div>

							<div class="col">
								<label>Biometric No.</label>
								<input id="bioid" type="number" class="form-control" placeholder="Biometric Number" name="bioid">
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