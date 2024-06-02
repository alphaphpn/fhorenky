					<!-- Start here -->
					<style>
						@media only screen and (max-width: 991px) {
							#mdiFindePrecint .modal-body .input-group {
								display: inline-block;
							}

							#mdiFindePrecint .modal-body .input-group input {
								width: 100%;
							}
						}
					</style>

					<script>
						$(document).ready(function(){
							$("#mdiFindePrecint").modal('show');
						});
					</script>

					<div class="modal fade" id="mdiFindePrecint">
						<div class="modal-dialog modal-lg modal-dialog-scrollable">
							<div class="modal-content">
								<form method="post" class="needs-validation" enctype="multipart/form-data" novalidate>
									<!-- Modal Header -->
									<div class="modal-header">
										<h4 class="modal-title">Find your precinct</h4>
										<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
									</div>

									<!-- Modal body -->
									<div class="modal-body">
										
										<label>Format: Lastname, Firstname Middlename</label>
										<div class="input-group mb-3 input-group-lg">
											<span class="input-group-text">Enter Voter's Name</span>
											<input id="votersname" type="text" class="form-control" placeholder="* Voter's Name" name="votersname" required>
											<div class="valid-feedback">Valid.</div>
											<div class="invalid-feedback">Please fill out this field.</div>
										</div>
										<label>Example: Dela Cruz, Juan Santos</label>

										<div>
											<?php
												try {
													$votersname = isset($_POST['votersname']) ? $_POST['votersname'] : '';

													if (isset($_POST['btnDtrSubmit'])) {
														echo '<script>window.open("../../routes/precinct-finder-result/?votersname='.$votersname.'","_self");</script>';
													}
												} catch (PDOException $error) {
													$err_msg = $error->getMessage();
													echo "<p>Error: {$err_msg}</p>";
													die;
												}
											?>
										</div>

									</div>

									<!-- Modal footer -->
									<div class="modal-footer">
										<button id="btnDtrSubmit" name="btnDtrSubmit" type="submit" class="btn btn-primary">Submit</button>
										<button id="btnCloseX" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div>