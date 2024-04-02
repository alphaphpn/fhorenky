	<canvas id="particle-animate" style="position: fixed; overflow: hidden; width: 100%; height: 100vh;"></canvas>

<?php
	include_once "../../app/theme/default/navbar.php";
	// include_once "../../app/theme/default/hero-banner.php";
	$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
?>

	<section class="position-relative w-100">
		<div class="container-fluid">
			<div class="bg-white p-3 my-3">
				<h2>Add Document</h2>
				<a href="../../routes/doctrack" class="float-end btn btn-sm btn-danger">Back</a>

				<hr>

				<form>
					<div class="mb-3">
						<label class="form-label">Capture Frontpage File</label>
						
						<div class="row text-center">
							<div id="disp-vid" class="col-md-12 mb-2">
								<video id="video" title="Picture" class="border" autoplay></video>
							</div>
						</div>

						<div class="row text-center">
							<div id="disp-pix" class="col-md-12 mb-2 d-none">
								<canvas id="canvas" class="border"></canvas>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 mb-2">
								<textarea id="imgdata" class="w-100" name="imgdata"></textarea>
							</div>
						</div>

						<div class="row mb-2">
							<div class="col mb-2 text-center">
								<button id="start-camera" type="button" class="btn btn-primary">Start Camera</button>
								<button id="retake-photo" type="button" class="btn btn-warning d-none">Re-Take Photo</button>
								<button id="click-photo" type="button" class="btn btn-success d-none">Click Photo</button>
							</div>
						</div>
					</div>

					<div class="mb-3">
						<label for="filetype" class="form-label">File Type</label>
						<input id="filetype" type="text" name="filetype" class="form-control" list="filetypeList" required>
						<div class="valid-feedback">Valid.</div>
						<div class="invalid-feedback">Please fill out this field.</div>
						<datalist id="filetypeList">
						<?php
							$stmtfiletype = $cnn->prepare("SELECT * FROM doctrack_details_tbl GROUP BY doctype ORDER BY doctype ASC");
							$stmtfiletype->execute();
							$resultunit = $stmtfiletype->setFetchMode(PDO::FETCH_ASSOC);
							foreach ($stmtfiletype as $row) {
								echo "<option value='".$row['doctype']."'>";
							}
						?>
						</datalist>
					</div>

					<button id="submitNewDoc" type="submit" name="submitNewDoc" class="btn btn-primary">Submit</button>
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
			disppix.classList.remove('d-none');

			canvas.getContext('2d').drawImage(video, 0, 0, videowidth, videoheight);
			canvas.style.width = video.offsetWidth+'px';
			canvas.style.height = video.offsetHeight+'px';
			let image_data_url = canvas.toDataURL('image/jpeg');

			// data url of the image
			console.log(image_data_url);
			imgdata.value = image_data_url;

			video.classList.add('d-none');
			retakephoto.classList.remove('d-none');
			click_button.classList.add('d-none');
		});

		retakephoto.addEventListener('click', async function() {
			disppix.classList.add('d-none');

			camera_button.classList.add("d-none");
			retakephoto.classList.add('d-none');
			click_button.classList.remove('d-none');
			video.classList.remove('d-none');
		});
	</script>