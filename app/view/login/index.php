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

	@media (max-width: 450px) {
		.h-custom {
			height: 100%;
		}
	}
</style>

<section class="vh-100">
	<div class="container-fluid h-custom">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-md-9 col-lg-6 col-xl-5 text-center">
				<img src="//sibugay.gov.ph/wp-content/uploads/2022/08/cropped-favicon-zsp.png" class="img-fluid" alt="Sample image">
			</div>

			<div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
				<form id="loginup" method="post" class="needs-validation" novalidate>
					<div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
						<p class="lead fw-normal mb-0 me-3">Sign in with</p>
						<button type="button" class="btn btn-primary btn-floating mx-1">
							<i class="fab fa-facebook-f"></i>
						</button>

						<button type="button" class="btn btn-primary btn-floating mx-1">
							<i class="fab fa-twitter"></i>
						</button>

						<button type="button" class="btn btn-primary btn-floating mx-1">
							<i class="fab fa-linkedin-in"></i>
						</button>
					</div>

					<div class="divider d-flex align-items-center my-4">
						<p class="text-center fw-bold mx-3 mb-0">Or</p>
					</div>

					<!-- User input -->
					<div class="form-outline mb-4">
						<input type="text" id="userid" name="userid" class="form-control form-control-md" placeholder="Enter a valid User" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<label class="form-label" for="userid">User</label>
					</div>

					<!-- Password input -->
					<div class="form-outline mb-3">
						<input type="password" id="password" name="password" class="form-control form-control-md" placeholder="Enter password" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<label class="form-label" for="password">Password</label>
					</div>

					<div class="d-flex justify-content-between align-items-center">
						<!-- Checkbox -->
						<div class="form-check mb-0">
							<input class="form-check-input me-2" type="checkbox" value="" id="rememberme" />
							<label class="form-check-label" for="form2Example3">Remember me</label>
						</div>
						<a href="#!" class="text-body">Forgot password?</a>
					</div>

					<div class="d-flex justify-content-between align-items-center">
						<?php include_once "../../lib/login/index.php"; ?>
					</div>

					<div class="text-center text-lg-start mt-4 pt-2">
						<button id="btnLogin" type="submit" name="btnLogin" class="btn btn-primary" style="padding-left: 2.5rem; padding-right: 2.5rem;">Login <i class='fas fa-key'></i></button>
						<p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!" class="link-danger">Register</a></p>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
		<!-- Copyright -->
		<div class="text-white mb-3 mb-md-0">Copyright © 2023. All rights reserved.</div>
		<!-- Copyright -->

		<!-- Right -->
		<div>
			<a href="#!" class="text-white me-4">
				<i class="fab fa-facebook-f"></i>
			</a>
			<a href="#!" class="text-white me-4">
				<i class="fab fa-twitter"></i>
			</a>
			<a href="#!" class="text-white me-4">
				<i class="fab fa-google"></i>
			</a>
			<a href="#!" class="text-white">
				<i class="fab fa-linkedin-in"></i>
			</a>
		</div>
		<!-- Right -->
	</div>
</section>