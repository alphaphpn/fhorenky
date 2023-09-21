<?php

	try {
		$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);

		if (isset($_POST['btnSubmit'])) {
			if (empty($_POST['first-name'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>First Name is Required!</p>
					</div>';
			} elseif (empty($_POST['last-name'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Last Name is Required!</p>
					</div>';
			} elseif (empty($_POST['birth-year'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Birth Year is Required!</p>
					</div>';
			} elseif (empty($_POST['birth-month'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Birth Month is Required!</p>
					</div>';
			} elseif (empty($_POST['birth-day'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Birth Day is Required!</p>
					</div>';
			} elseif (empty($_POST['gender'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Gender is Required!</p>
					</div>';
			} elseif (empty($_POST['type-employee'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Type of Employee is Required!</p>
					</div>';
			} elseif (empty($_POST['office'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Office is Required!</p>
					</div>';
			} elseif (empty($_POST['bio-location'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Biometric Location is Required!</p>
					</div>';
			} elseif (empty($_POST['yrempd'])) {
				$bs5Heading = "System information.";
				$bs5BodyContent = '<div class="alert alert-info fade show">
						<p>Employed Year is Required!</p>
					</div>';
			} else {

				$imgdata = $_POST['imgdata'];
				$fbid = $_POST['fbid'];
				$phone = $_POST['phone'];
				$phone2 = $_POST['phone2'];
				$email = $_POST['email'];
				$firstname = $_POST['first-name'];
				$middlename = $_POST['middle-name'];
				$lastname = $_POST['last-name'];
				$suffix = $_POST['suffix'];
				$nametitle = $_POST['name-title'];
				$birthyear = $_POST['birth-year'];
				$birthday = $_POST['birth-day'];
				$birthmonth = $_POST['birth-month'];
				$birthdate = $birthyear.'-'.$birthmonth.'-'.$birthday;
				$gender = $_POST['gender'];

				$typeemployeeno = $_POST['type-employee'];
				$typeemployeeabvr = $_POST['emptypeabv'];
				$typeemployee = $_POST['emptypedesc'];

				$office = $_POST['office'];
				$officecode = $_POST['officecode'];
				$officeid = $_POST['officeid'];
				$officetitle = $_POST['officetitle'];
				$officeabrv = $_POST['officeabrv'];
				$headofcr = $_POST['headofcr'];
				$headtitle = $_POST['headtitle'];
				$authhead = $_POST['authhead'];
				$authtitle = $_POST['authtitle'];
				$authdesc = $_POST['authdesc'];

				$biolocation = $_POST['bio-location'];
				$empid = $_POST['empid'];
				$bioid = $_POST['bioid'];
				$yrempd = $_POST['yrempd'];

				$lengthid = 3;

				$empid_finale = $empid;
				$bioid_finale = $bioid;

				$userpw = trim('!').trim(ucwords($firstname)).trim(ucwords($lastname)).trim('@').trim($birthyear).trim('#');

				if (empty($empid)) {
					$stmt_empid = $cnn->prepare("SELECT * FROM employee_tbl WHERE type_employee_no=:typeemployeeno AND officeid=:officeid AND year_employed=:yearemployed");
					$stmt_empid->bindParam(':typeemployeeno', $typeemployeeno);
					$stmt_empid->bindParam(':officeid', $officeid);
					$stmt_empid->bindParam(':yearemployed', $yrempd);
					$stmt_empid->execute();
					$count_empid = $stmt_empid->rowCount() + 1;
					$stringid = substr(str_repeat(0, $lengthid).$count_empid, - $lengthid);
					$empid_finale = trim($typeemployeeno) . trim(substr(str_repeat(0, 2).$officeid, - 2)) . trim($yrempd - $startedyearx) . trim($stringid);
				} else {
					$empid_finale = $empid;
				}

				if (empty($bioid)) {
					$bioid_finale = $empid_finale;
				} else {
					$bioid_finale = $bioid;
				}

				if (empty($nametitle) && empty($middlename) && empty($suffix)) {
					$fullname = ucwords($firstname).' '.ucwords($lastname);
					$username = str_replace(' ', '', strtolower(trim($firstname).'.'.trim($lastname)));
				} elseif (empty($nametitle) && empty($suffix)) {
					$fullname = ucwords($firstname).' '.substr(ucwords($middlename),0,1).'. '.ucwords($lastname);
					$username = str_replace(' ', '', strtolower(trim($firstname).'.'.trim($lastname)));
				} elseif (empty($middlename) && empty($suffix)) {
					$fullname = $nametitle.'. '.ucwords($firstname).' '.ucwords($lastname);
					$username = str_replace(' ', '', strtolower(trim($firstname).'.'.trim($lastname)));
				} elseif (empty($nametitle) && empty($middlename)) {
					$fullname = ucwords($firstname).' '.ucwords($lastname).', '.ucwords($suffix);
					$username =  $username = str_replace(' ', '', strtolower(trim($firstname).'.'.trim($lastname).'.'.trim($suffix)));;
				} else {
					$fullname = $nametitle.'. '.ucwords($firstname).' '.substr(ucwords($middlename),0,1).'. '.ucwords($lastname).', '.ucwords($suffix);
					$username =  $username = str_replace(' ', '', strtolower(trim($firstname).'.'.trim($lastname).'.'.trim($suffix)));;
				}

				include_once "../../lib/profile-autoid.php";
				include_once "../../lib/user-autoid.php";

				if (empty($phone)) {
					if (empty($email)) {
						include_once "../../lib/search-duplicate/profile.php";

						if ($count_profileinfo==0) {

							if (empty($empid)) {

								if (empty($bioid)) {
									include_once "../../lib/search-duplicate/username.php";

									if ($count_username==0) {
										// Save --> Profile Data, User Data and Employee Data...
										include_once "../../lib/sign-up-employee/index.php";

										// Final Success Message
										$bs5Heading = "Employee Successfully Registered.";
										$bs5BodyContent = '<div class="alert alert-info fade show">
												<label>Employee Information</label>
												<p>Employee ID: <b>'.$empid_finale.'</b></p>
												<p>Bio#: <b>'.$empid_finale.'</b></p>
												<p>Employee: <b>'.$fullname.'</b></p>
												<p>Username: <b>'.$username.'</b></p>
												<p>Temporary Password: <b>'.$userpw.'</b></p>
												<p>Profile ID: <b>'.$profileid_finale.'</b></p>
												<p>User ID: <b>'.$userid_finale.'</b></p>
												<p>Office: <b>'.$office.'</b></p>
												<p>Biometric Location: <b>'.$biolocation.'</b></p>
											</div>';

										$printHeading = "Employee Information";
										$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
										include_once "../../lib/bs5-modal.php";
									} else {
										$bs5Heading = "System information";
										$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

										$foczelem = 'empid';
										include_once "../../lib/bs5-modal.php";
									}
								} else {
									include_once "../../lib/search-duplicate/bio-no.php";

									if ($count_bioid==0) {
										include_once "../../lib/search-duplicate/username.php";

										if ($count_username==0) {
											// Save --> Profile Data, User Data and Employee Data...
											include_once "../../lib/sign-up-employee/index.php";

											// Final Success Message
											$bs5Heading = "Employee Successfully Registered.";
											$bs5BodyContent = '<div class="alert alert-info fade show">
													<label>Employee Information</label>
													<p>Employee ID: <b>'.$empid_finale.'</b></p>
													<p>Bio#: <b>'.$empid_finale.'</b></p>
													<p>Employee: <b>'.$fullname.'</b></p>
													<p>Username: <b>'.$username.'</b></p>
													<p>Temporary Password: <b>'.$userpw.'</b></p>
													<p>Profile ID: <b>'.$profileid_finale.'</b></p>
													<p>User ID: <b>'.$userid_finale.'</b></p>
													<p>Office: <b>'.$office.'</b></p>
													<p>Biometric Location: <b>'.$biolocation.'</b></p>
												</div>';

											$printHeading = "Employee Information";
											$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
											include_once "../../lib/bs5-modal.php";
										} else {
											$bs5Heading = "System information";
											$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

											$foczelem = 'empid';
											include_once "../../lib/bs5-modal.php";
										}
									} else {
										$bs5Heading = "System information";
										$bs5BodyContent = "Biometric Data <b class='text-danger'>#".$bioid_finale." - Location[".$biolocation."]</b> already exist!";

										$foczelem = 'empid';
										include_once "../../lib/bs5-modal.php";
									}
								}
							} else {
								include_once "../../lib/search-duplicate/employee-id.php";

								if ($count_employid==0) {

									if (empty($bioid)) {
										include_once "../../lib/search-duplicate/username.php";

										if ($count_username==0) {
											// Save --> Profile Data, User Data and Employee Data...
											include_once "../../lib/sign-up-employee/index.php";

											// Final Success Message
											$bs5Heading = "Employee Successfully Registered.";
											$bs5BodyContent = '<div class="alert alert-info fade show">
													<label>Employee Information</label>
													<p>Employee ID: <b>'.$empid_finale.'</b></p>
													<p>Bio#: <b>'.$empid_finale.'</b></p>
													<p>Employee: <b>'.$fullname.'</b></p>
													<p>Username: <b>'.$username.'</b></p>
													<p>Temporary Password: <b>'.$userpw.'</b></p>
													<p>Profile ID: <b>'.$profileid_finale.'</b></p>
													<p>User ID: <b>'.$userid_finale.'</b></p>
													<p>Office: <b>'.$office.'</b></p>
													<p>Biometric Location: <b>'.$biolocation.'</b></p>
												</div>';

											$printHeading = "Employee Information";
											$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
											include_once "../../lib/bs5-modal.php";
										} else {
											$bs5Heading = "System information";
											$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

											$foczelem = 'empid';
											include_once "../../lib/bs5-modal.php";
										}
									} else {
										include_once "../../lib/search-duplicate/bio-no.php";

										if ($count_bioid==0) {
											include_once "../../lib/search-duplicate/username.php";

											if ($count_username==0) {
												// Save --> Profile Data, User Data and Employee Data...
												include_once "../../lib/sign-up-employee/index.php";

												// Final Success Message
												$bs5Heading = "Employee Successfully Registered.";
												$bs5BodyContent = '<div class="alert alert-info fade show">
														<label>Employee Information</label>
														<p>Employee ID: <b>'.$empid_finale.'</b></p>
														<p>Bio#: <b>'.$empid_finale.'</b></p>
														<p>Employee: <b>'.$fullname.'</b></p>
														<p>Username: <b>'.$username.'</b></p>
														<p>Temporary Password: <b>'.$userpw.'</b></p>
														<p>Profile ID: <b>'.$profileid_finale.'</b></p>
														<p>User ID: <b>'.$userid_finale.'</b></p>
														<p>Office: <b>'.$office.'</b></p>
														<p>Biometric Location: <b>'.$biolocation.'</b></p>
													</div>';

												$printHeading = "Employee Information";
												$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
												include_once "../../lib/bs5-modal.php";
											} else {
												$bs5Heading = "System information";
												$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

												$foczelem = 'empid';
												include_once "../../lib/bs5-modal.php";
											}
										} else {
											$bs5Heading = "System information";
											$bs5BodyContent = "Biometric Data <b class='text-danger'>#".$bioid_finale." - Location[".$biolocation."]</b> already exist!";

											$foczelem = 'empid';
											include_once "../../lib/bs5-modal.php";
										}
									}
								} else {
									$bs5Heading = "System information";
									$bs5BodyContent = "Employee ID <b class='text-danger'>".$empid."</b> already exist!";

									$foczelem = 'empid';
									include_once "../../lib/bs5-modal.php";
								}
							}
						} else {
							$bs5Heading = "System information";
							$bs5BodyContent = "Profile Info <b class='text-danger'>".$fullname." | ".$birthdate." | ".$gender."</b> already exist!";

							$foczelem = 'first-name';
							include_once "../../lib/bs5-modal.php";
						}
					} else {
						include_once "../../lib/search-duplicate/email.php";

						if ($count_profileemail==0) {
							include_once "../../lib/search-duplicate/user-email.php";

							if ($count_useremail==0) {
								include_once "../../lib/search-duplicate/profile.php";

								if ($count_profileinfo==0) {

									if (empty($empid)) {

										if (empty($bioid)) {
											include_once "../../lib/search-duplicate/username.php";

											if ($count_username==0) {
												// Save --> Profile Data, User Data and Employee Data...
												include_once "../../lib/sign-up-employee/index.php";

												// Final Success Message
												$bs5Heading = "Employee Successfully Registered.";
												$bs5BodyContent = '<div class="alert alert-info fade show">
														<label>Employee Information</label>
														<p>Employee ID: <b>'.$empid_finale.'</b></p>
														<p>Bio#: <b>'.$empid_finale.'</b></p>
														<p>Employee: <b>'.$fullname.'</b></p>
														<p>Username: <b>'.$username.'</b></p>
														<p>Temporary Password: <b>'.$userpw.'</b></p>
														<p>Profile ID: <b>'.$profileid_finale.'</b></p>
														<p>User ID: <b>'.$userid_finale.'</b></p>
														<p>Office: <b>'.$office.'</b></p>
														<p>Biometric Location: <b>'.$biolocation.'</b></p>
													</div>';

												$printHeading = "Employee Information";
												$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
												include_once "../../lib/bs5-modal.php";
											} else {
												$bs5Heading = "System information";
												$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

												$foczelem = 'empid';
												include_once "../../lib/bs5-modal.php";
											}
										} else {
											include_once "../../lib/search-duplicate/bio-no.php";

											if ($count_bioid==0) {
												include_once "../../lib/search-duplicate/username.php";

												if ($count_username==0) {
													// Save --> Profile Data, User Data and Employee Data...
													include_once "../../lib/sign-up-employee/index.php";

													// Final Success Message
													$bs5Heading = "Employee Successfully Registered.";
													$bs5BodyContent = '<div class="alert alert-info fade show">
															<label>Employee Information</label>
															<p>Employee ID: <b>'.$empid_finale.'</b></p>
															<p>Bio#: <b>'.$empid_finale.'</b></p>
															<p>Employee: <b>'.$fullname.'</b></p>
															<p>Username: <b>'.$username.'</b></p>
															<p>Temporary Password: <b>'.$userpw.'</b></p>
															<p>Profile ID: <b>'.$profileid_finale.'</b></p>
															<p>User ID: <b>'.$userid_finale.'</b></p>
															<p>Office: <b>'.$office.'</b></p>
															<p>Biometric Location: <b>'.$biolocation.'</b></p>
														</div>';

													$printHeading = "Employee Information";
													$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
													include_once "../../lib/bs5-modal.php";
												} else {
													$bs5Heading = "System information";
													$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

													$foczelem = 'empid';
													include_once "../../lib/bs5-modal.php";
												}
											} else {
												$bs5Heading = "System information";
												$bs5BodyContent = "Biometric Data <b class='text-danger'>#".$bioid_finale." - Location[".$biolocation."]</b> already exist!";

												$foczelem = 'empid';
												include_once "../../lib/bs5-modal.php";
											}
										}
									} else {
										include_once "../../lib/search-duplicate/employee-id.php";

										if ($count_employid==0) {

											if (empty($bioid)) {
												include_once "../../lib/search-duplicate/username.php";

												if ($count_username==0) {
													// Save --> Profile Data, User Data and Employee Data...
													include_once "../../lib/sign-up-employee/index.php";

													// Final Success Message
													$bs5Heading = "Employee Successfully Registered.";
													$bs5BodyContent = '<div class="alert alert-info fade show">
															<label>Employee Information</label>
															<p>Employee ID: <b>'.$empid_finale.'</b></p>
															<p>Bio#: <b>'.$empid_finale.'</b></p>
															<p>Employee: <b>'.$fullname.'</b></p>
															<p>Username: <b>'.$username.'</b></p>
															<p>Temporary Password: <b>'.$userpw.'</b></p>
															<p>Profile ID: <b>'.$profileid_finale.'</b></p>
															<p>User ID: <b>'.$userid_finale.'</b></p>
															<p>Office: <b>'.$office.'</b></p>
															<p>Biometric Location: <b>'.$biolocation.'</b></p>
														</div>';

													$printHeading = "Employee Information";
													$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
													include_once "../../lib/bs5-modal.php";
												} else {
													$bs5Heading = "System information";
													$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

													$foczelem = 'empid';
													include_once "../../lib/bs5-modal.php";
												}
											} else {
												include_once "../../lib/search-duplicate/bio-no.php";

												if ($count_bioid==0) {
													include_once "../../lib/search-duplicate/username.php";

													if ($count_username==0) {
														// Save --> Profile Data, User Data and Employee Data...
														include_once "../../lib/sign-up-employee/index.php";

														// Final Success Message
														$bs5Heading = "Employee Successfully Registered.";
														$bs5BodyContent = '<div class="alert alert-info fade show">
																<label>Employee Information</label>
																<p>Employee ID: <b>'.$empid_finale.'</b></p>
																<p>Bio#: <b>'.$empid_finale.'</b></p>
																<p>Employee: <b>'.$fullname.'</b></p>
																<p>Username: <b>'.$username.'</b></p>
																<p>Temporary Password: <b>'.$userpw.'</b></p>
																<p>Profile ID: <b>'.$profileid_finale.'</b></p>
																<p>User ID: <b>'.$userid_finale.'</b></p>
																<p>Office: <b>'.$office.'</b></p>
																<p>Biometric Location: <b>'.$biolocation.'</b></p>
															</div>';

														$printHeading = "Employee Information";
														$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
														include_once "../../lib/bs5-modal.php";
													} else {
														$bs5Heading = "System information";
														$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

														$foczelem = 'empid';
														include_once "../../lib/bs5-modal.php";
													}
												} else {
													$bs5Heading = "System information";
													$bs5BodyContent = "Biometric Data <b class='text-danger'>#".$bioid_finale." - Location[".$biolocation."]</b> already exist!";

													$foczelem = 'empid';
													include_once "../../lib/bs5-modal.php";
												}
											}
										} else {
											$bs5Heading = "System information";
											$bs5BodyContent = "Employee ID <b class='text-danger'>".$empid."</b> already exist!";

											$foczelem = 'empid';
											include_once "../../lib/bs5-modal.php";
										}
									}
								} else {
									$bs5Heading = "System information";
									$bs5BodyContent = "Profile Info <b class='text-danger'>".$fullname." | ".$birthdate." | ".$gender."</b> already exist!";

									$foczelem = 'first-name';
									include_once "../../lib/bs5-modal.php";
								}
							} else {
								$bs5Heading = "System information";
								$bs5BodyContent = "User Email <b class='text-danger'>".$email."</b> already exist!";

								$foczelem = 'email';
								include_once "../../lib/bs5-modal.php";
							}
						} else {
							$bs5Heading = "System information";
							$bs5BodyContent = "Profile Email <b class='text-danger'>".$email."</b> already exist!";

							$foczelem = 'email';
							include_once "../../lib/bs5-modal.php";
						}
					}
				} else {
					include_once "../../lib/search-duplicate/phone.php";

					if ($count_profilephone==0) {
						include_once "../../lib/search-duplicate/user-phone.php";

						if ($count_userphone==0) {
							include_once "../../lib/search-duplicate/email.php";

							if ($count_profileemail==0) {
								include_once "../../lib/search-duplicate/user-email.php";

								if ($count_useremail==0) {
									include_once "../../lib/search-duplicate/profile.php";

									if ($count_profileinfo==0) {

										if (empty($empid)) {

											if (empty($bioid)) {
												include_once "../../lib/search-duplicate/username.php";

												if ($count_username==0) {
													// Save --> Profile Data, User Data and Employee Data...
													include_once "../../lib/sign-up-employee/index.php";

													// Final Success Message
													$bs5Heading = "Employee Successfully Registered.";
													$bs5BodyContent = '<div class="alert alert-info fade show">
															<label>Employee Information</label>
															<p>Employee ID: <b>'.$empid_finale.'</b></p>
															<p>Bio#: <b>'.$empid_finale.'</b></p>
															<p>Employee: <b>'.$fullname.'</b></p>
															<p>Username: <b>'.$username.'</b></p>
															<p>Temporary Password: <b>'.$userpw.'</b></p>
															<p>Profile ID: <b>'.$profileid_finale.'</b></p>
															<p>User ID: <b>'.$userid_finale.'</b></p>
															<p>Office: <b>'.$office.'</b></p>
															<p>Biometric Location: <b>'.$biolocation.'</b></p>
														</div>';

													$printHeading = "Employee Information";
													$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
													include_once "../../lib/bs5-modal.php";
												} else {
													$bs5Heading = "System information";
													$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

													$foczelem = 'empid';
													include_once "../../lib/bs5-modal.php";
												}
											} else {
												include_once "../../lib/search-duplicate/bio-no.php";

												if ($count_bioid==0) {
													include_once "../../lib/search-duplicate/username.php";

													if ($count_username==0) {
														// Save --> Profile Data, User Data and Employee Data...
														include_once "../../lib/sign-up-employee/index.php";

														// Final Success Message
														$bs5Heading = "Employee Successfully Registered.";
														$bs5BodyContent = '<div class="alert alert-info fade show">
																<label>Employee Information</label>
																<p>Employee ID: <b>'.$empid_finale.'</b></p>
																<p>Bio#: <b>'.$empid_finale.'</b></p>
																<p>Employee: <b>'.$fullname.'</b></p>
																<p>Username: <b>'.$username.'</b></p>
																<p>Temporary Password: <b>'.$userpw.'</b></p>
																<p>Profile ID: <b>'.$profileid_finale.'</b></p>
																<p>User ID: <b>'.$userid_finale.'</b></p>
																<p>Office: <b>'.$office.'</b></p>
																<p>Biometric Location: <b>'.$biolocation.'</b></p>
															</div>';

														$printHeading = "Employee Information";
														$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
														include_once "../../lib/bs5-modal.php";
													} else {
														$bs5Heading = "System information";
														$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

														$foczelem = 'empid';
														include_once "../../lib/bs5-modal.php";
													}
												} else {
													$bs5Heading = "System information";
													$bs5BodyContent = "Biometric Data <b class='text-danger'>#".$bioid_finale." - Location[".$biolocation."]</b> already exist!";

													$foczelem = 'empid';
													include_once "../../lib/bs5-modal.php";
												}
											}
										} else {
											include_once "../../lib/search-duplicate/employee-id.php";

											if ($count_employid==0) {

												if (empty($bioid)) {
													include_once "../../lib/search-duplicate/username.php";

													if ($count_username==0) {
														// Save --> Profile Data, User Data and Employee Data...
														include_once "../../lib/sign-up-employee/index.php";

														// Final Success Message
														$bs5Heading = "Employee Successfully Registered.";
														$bs5BodyContent = '<div class="alert alert-info fade show">
																<label>Employee Information</label>
																<p>Employee ID: <b>'.$empid_finale.'</b></p>
																<p>Bio#: <b>'.$empid_finale.'</b></p>
																<p>Employee: <b>'.$fullname.'</b></p>
																<p>Username: <b>'.$username.'</b></p>
																<p>Temporary Password: <b>'.$userpw.'</b></p>
																<p>Profile ID: <b>'.$profileid_finale.'</b></p>
																<p>User ID: <b>'.$userid_finale.'</b></p>
																<p>Office: <b>'.$office.'</b></p>
																<p>Biometric Location: <b>'.$biolocation.'</b></p>
															</div>';

														$printHeading = "Employee Information";
														$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
														include_once "../../lib/bs5-modal.php";
													} else {
														$bs5Heading = "System information";
														$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

														$foczelem = 'empid';
														include_once "../../lib/bs5-modal.php";
													}
												} else {
													include_once "../../lib/search-duplicate/bio-no.php";

													if ($count_bioid==0) {
														include_once "../../lib/search-duplicate/username.php";

														if ($count_username==0) {
															// Save --> Profile Data, User Data and Employee Data...
															include_once "../../lib/sign-up-employee/index.php";

															// Final Success Message
															$bs5Heading = "Employee Successfully Registered.";
															$bs5BodyContent = '<div class="alert alert-info fade show">
																	<label>Employee Information</label>
																	<p>Employee ID: <b>'.$empid_finale.'</b></p>
																	<p>Bio#: <b>'.$empid_finale.'</b></p>
																	<p>Employee: <b>'.$fullname.'</b></p>
																	<p>Username: <b>'.$username.'</b></p>
																	<p>Temporary Password: <b>'.$userpw.'</b></p>
																	<p>Profile ID: <b>'.$profileid_finale.'</b></p>
																	<p>User ID: <b>'.$userid_finale.'</b></p>
																	<p>Office: <b>'.$office.'</b></p>
																	<p>Biometric Location: <b>'.$biolocation.'</b></p>
																</div>';

															$printHeading = "Employee Information";
															$printBtn = '<a href="../../routes/print-content/?htitle='.$printHeading.'&empid='.$empid_finale.'&empidfinale='.$empid_finale.'&fullname='.$fullname.'&username='.$username.'&office='.$office.'&biolocation='.$biolocation.'&pw='.$userpw.'" target="_blank" class="btn btn-primary">Print</a>';
															include_once "../../lib/bs5-modal.php";
														} else {
															$bs5Heading = "System information";
															$bs5BodyContent = "Username <b class='text-danger'>#".$username."</b> already exist!";

															$foczelem = 'empid';
															include_once "../../lib/bs5-modal.php";
														}
													} else {
														$bs5Heading = "System information";
														$bs5BodyContent = "Biometric Data <b class='text-danger'>#".$bioid_finale." - Location[".$biolocation."]</b> already exist!";

														$foczelem = 'empid';
														include_once "../../lib/bs5-modal.php";
													}
												}
											} else {
												$bs5Heading = "System information";
												$bs5BodyContent = "Employee ID <b class='text-danger'>".$empid."</b> already exist!";

												$foczelem = 'empid';
												include_once "../../lib/bs5-modal.php";
											}
										}
									} else {
										$bs5Heading = "System information";
										$bs5BodyContent = "Profile Info <b class='text-danger'>".$fullname." | ".$birthdate." | ".$gender."</b> already exist!";

										$foczelem = 'first-name';
										include_once "../../lib/bs5-modal.php";
									}
								} else {
									$bs5Heading = "System information";
									$bs5BodyContent = "User Email <b class='text-danger'>".$email."</b> already exist!";

									$foczelem = 'email';
									include_once "../../lib/bs5-modal.php";
								}
							} else {
								$bs5Heading = "System information";
								$bs5BodyContent = "Profile Email <b class='text-danger'>".$email."</b> already exist!";

								$foczelem = 'email';
								include_once "../../lib/bs5-modal.php";
							}
						} else {
							$bs5Heading = "System information";
							$bs5BodyContent = "User Phone <b class='text-danger'>".$phone."</b> already exist!";

							$foczelem = 'phone';
							include_once "../../lib/bs5-modal.php";
						}
					} else {
						$bs5Heading = "System information";
						$bs5BodyContent = "Profile Phone <b class='text-danger'>".$phone."</b> already exist!";

						$foczelem = 'phone';
						include_once "../../lib/bs5-modal.php";
					}
				}
			}
		}
	} catch (PDOException $error) {
		$err_msg = $error->getMessage();
		echo "<p>Error: {$err_msg}</p>";
		die;
	}

?>

<script>
	let btnCloseXi = document.querySelector("#btnCloseX");

	btnCloseXi.addEventListener('click', function() {
		document.getElementById("fbid").value = "<?php echo isset($fbid) ? $fbid : ""; ?>";
		document.getElementById("phone").value = "<?php echo isset($phone) ? $phone : ""; ?>";
		document.getElementById("phone2").value = "<?php echo isset($phone2) ? $phone2 : ""; ?>";
		document.getElementById("email").value = "<?php echo isset($email) ? $email : ""; ?>";
		document.getElementById("first-name").value = "<?php echo isset($firstname) ? $firstname : ""; ?>";
		document.getElementById("middle-name").value = "<?php echo isset($middlename) ? $middlename : ""; ?>";
		document.getElementById("last-name").value = "<?php echo isset($lastname) ? $lastname : ""; ?>";
		document.getElementById("suffix").value = "<?php echo isset($suffix) ? $suffix : ""; ?>";
		document.getElementById("name-title").value = "<?php echo isset($nametitle) ? $nametitle : ""; ?>";
		document.getElementById("year").value = "<?php echo isset($birthyear) ? $birthyear : ""; ?>";
		document.getElementById("days").value = "<?php echo isset($birthday) ? $birthday : ""; ?>";
		document.getElementById("month").value = "<?php echo isset($birthmonth) ? $birthmonth : ""; ?>";
		document.getElementById("empid").value = "<?php echo isset($empid_finale) ? $empid_finale : ""; ?>";
		document.getElementById("bioid").value = "<?php echo isset($bioid_finale) ? $bioid_finale : ""; ?>";
		document.getElementById("yrempd").value = "<?php echo isset($yrempd) ? $yrempd : ""; ?>";

		document.getElementById("clearfields").classList.remove('d-none');
	});
</script>