							<a class="nav-link" href="../../routes/biometric-upload">
								<div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
								Upload Timelogs
							</a>

							<a class="nav-link" href="../../routes/dtr-office-yr-month">
								<div class="sb-nav-link-icon"><i class="far fa-clock"></i></div>
								Daily TIme Record (DTR)
							</a>
							
						<?php
							if ($_SESSION["ulevel"]==1) {
						?>
							<a class="nav-link" href="../../routes/dtr-builder">
								<div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
								DTR Builder
							</a>
						<?php
							}
						?>

							<!-- a class="nav-link" href="../../routes/#">
								<div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>
								Text Here
							</a -->