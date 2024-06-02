						<?php
							if ($_SESSION["ulevel"]==1 || $_SESSION["ulevel"]==20 || $_SESSION["ulevel"]==21) {
						?>
							<a class="nav-link" href="../../routes/biometric-upload">
								<div class="sb-nav-link-icon"><i class="fas fa-upload"></i></div>
								Upload Timelogs
							</a>

							<a class="nav-link" href="../../routes/dtr-office-yr-month">
								<div class="sb-nav-link-icon"><i class="far fa-clock"></i></div>
								Daily TIme Record (DTR)
							</a>

							<a class="nav-link" href="../../routes/dashpanel">
								<div class="sb-nav-link-icon"><i class="far fa-folder-open"></i></div>
								DocTrack
							</a>
						<?php
							}
						?>
							
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

						<?php
							if ($_SESSION["ulevel"]==99 || $_SESSION["ulevel"]==1) {
						?>
							<a class="nav-link" href="../../routes/comelec-voters">
								<div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
								Voter's List
							</a>

							<a class="nav-link" href="../../routes/comelec-voters">
								<div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
								Unverified Voter's
							</a>

							<a class="nav-link" href="../../routes/comelec-voters">
								<div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
								Verified Voter's
							</a>

							<a class="nav-link" href="../../routes/comelec-voters">
								<div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
								Selected Voter's
							</a>

							<a class="nav-link" href="../../routes/comelec-voters">
								<div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
								Assistance Program
							</a>

							<a class="nav-link" href="../../routes/comelec-voters">
								<div class="sb-nav-link-icon"><i class="fas fa-id-card"></i></div>
								Assisted Voter's
							</a>
						<?php
							}
						?>

							<!-- a class="nav-link" href="../../routes/dashpanel">
								<div class="sb-nav-link-icon"><i class="fas fa-desktop"></i></div>
								Text Here
							</a -->