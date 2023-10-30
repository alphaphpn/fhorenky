<div class="container-fluid w-100 h-100 position-absolute logo-hero-overlay-head" style="z-index: 1; background-image: url('<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/hero-overlay-zsp.png'; ?>');">
	<div class="row h-100 layer-present-feature">
		<div class="col-lg-6 m-auto text-light">
			<div class="feat-msg position-relative clearfix">
				<h2 class="mb-3">Welcome to <br><em><b>Zamboanga Sibugay</b></em></h2>
				<h5 style="line-height: 1.5;" class="mb-3">Zamboanga Sibugay is the 79th province of the Republic of the Philippines. This was created through Republic Act 8973 was signed into law by then President Joseph E. Estrada on November 7, 2000, and was later on ratified through a plebiscite on February 22, 2001.</h5>
				<p class="mb-3">Wherein the 3rd District Representative Dr. George T. Hofer, “The Founding Father” was appointed and later on elected as its <b>first Governor in 2001.</b></p>
				<a href="<?php echo $domainhome; ?>routes/contactus">
					<button class="<?php echo 'btn '.$buttonsize; ?> btn-danger mr-3 mb-1">Meet our Governor</button>
				</a>
				<a href="<?php echo $domainhome; ?>routes/contactus">
					<button class="<?php echo 'btn '.$buttonsize; ?>" style="<?php echo 'background-color: '.$primarycolor.';'; ?>">Appointment Request</button>
				</a>
			</div>
		</div>
		<div id="feat-present-slick-slider" class="col-lg-6 m-auto">
			<div class="slider-for" style="z-index: 1;">
				<div>
					<div class="feat-present position-relative clearfix shadow">
						<video class="float-start" width="100%" height="100%" controls autoplay muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/index.mp4" type="video/mp4">
						</video>
					</div>
				</div>

				<div>
					<div class="feat-present position-relative clearfix shadow">
						<video class="float-start" width="100%" height="100%" controls muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/Sibugay-Hymn.mp4" type="video/mp4">
						</video>
					</div>
				</div>

				<div>
					<div class="feat-present position-relative clearfix shadow">
						<video class="float-start" width="100%" height="100%" controls muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/ZAMPEX-2022.mp4" type="video/mp4">
						</video>
					</div>
				</div>

				<div>
					<div class="feat-present position-relative clearfix shadow">
						<video class="float-start" width="100%" height="100%" controls muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/index.mp4" type="video/mp4">
						</video>
					</div>
				</div>

				<div>
					<div class="feat-present position-relative clearfix shadow">
						<video class="float-start" width="100%" height="100%" controls muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/Sibugay-Hymn.mp4" type="video/mp4">
						</video>
					</div>
				</div>

				<div>
					<div class="feat-present position-relative clearfix shadow">
						<video class="float-start" width="100%" height="100%" controls muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/ZAMPEX-2022.mp4" type="video/mp4">
						</video>
					</div>
				</div>
			</div>

			<div class="slider-nav" style="z-index: 1;">
				<div>
					<div class="feat-thumbimg">
						<h3 class="m-auto">1</h3>
					</div>
				</div>
				<div>
					<div class="feat-thumbimg">
						<h3 class="m-auto">2</h3>
					</div>
				</div>
				<div>
					<div class="feat-thumbimg">
						<h3 class="m-auto">3</h3>
					</div>
				</div>
				<div>
					<div class="feat-thumbimg">
						<h3 class="m-auto">1</h3>
					</div>
				</div>
				<div>
					<div class="feat-thumbimg">
						<h3 class="m-auto">2</h3>
					</div>
				</div>
				<div>
					<div class="feat-thumbimg">
						<h3 class="m-auto">3</h3>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="slick-frontbanner">
	<?php
		try {
			$cnn = new PDO("mysql:host={$host};dbname={$db}", $uname, $pw);
			$qry_banner = "SELECT * FROM tbl_headbanner WHERE enabled=1 AND theme_name=:xthemename ORDER BY hb_id ASC";
			$stmt_banner = $cnn->prepare($qry_banner);
			$stmt_banner->bindParam(':xthemename', $themename);
			$stmt_banner->execute();
			$cnt_banner = $stmt_banner->rowCount();

			if ($cnt_banner > 0) {
				foreach ($stmt_banner as $row_banner) {
					$bhbid = $row_banner['hb_id'];
					$bheadtitle = $row_banner['head_title'];
					$bheadtitle2 = $row_banner['head_title2'];
					$bsubtext = $row_banner['sub_text'];
					$bimgloc = $row_banner['img_loc'];
					$bbannerwidth = $row_banner['banner_width'];
					$bcontentalignment = $row_banner['content_alignment'];
					?>
						<div class="card">
							<div class="<?php echo $contentwidth; ?> card-img-overlay d-flex h-100 justify-content-left align-items-center">
								<div class="<?php echo $bcontentalignment.' '.$bbannerwidth; ?>">
									<h2 class="card-title"><?php echo $bheadtitle; ?></h2>
									<h4 class="card-title"><?php echo $bheadtitle2; ?></h4>
									<p class="card-text"><?php echo $bsubtext; ?></p>
									<?php
										$qry_banner_btn = "SELECT * FROM tbl_headbanner_btn WHERE hb_id=:hbid ORDER BY hbtn_id ASC";
										$stmt_banner_btn = $cnn->prepare($qry_banner_btn);
										$stmt_banner_btn->bindParam(':hbid', $bhbid);
										$stmt_banner_btn->execute();
										$cnt_banner_btn = $stmt_banner_btn->rowCount();

										if ($cnt_banner_btn > 0) {
											foreach ($stmt_banner_btn as $row_banner_btn) {
												$btncaption		= $row_banner_btn['caption'];
												$btnbtnclass	= $row_banner_btn['btn_class'];
												$btnlinkurl		= $row_banner_btn['link_url'];
												$btnalt			= $row_banner_btn['alt'];
												$btntooltip		= $row_banner_btn['tool_tip'];
												$btnopenin		= $row_banner_btn['open_in'];
												?>
													<a href="<?php echo $btnlinkurl; ?>" class="<?php echo 'btn '.$btnbtnclass.' '.$buttonsize; ?>" target="<?php echo $btnopenin; ?>"><?php echo $btncaption; ?></a>
												<?php
											}
										}
									?>
								</div>
							</div>
							<img class="card-img-top vh-100" src="<?php echo $domainhome; ?>storage/img/img-transparent-banner-1024x438.png" alt="Card image" style="background-image: url(<?php echo $domainhome.'content/theme/'.$themename.'/storage/img/'.$bimgloc; ?>);">
						</div>
					<?php
				}
			} else {
				// Center = text-center mr-auto ml-auto
				// Left = text-left mr-auto
				// Right = text-right ml-auto

				// Full-width = w-100
				// Half-width = w-100 mxw-half
				?>
					<div class="video-auto-height">
						<video autoplay muted loop>
							<source src="<?php echo $domainhome.'content/theme/'.$themename; ?>/storage/video/index.mp4" type="video/mp4">
						</video>
					</div>
				<?php
			}
		} catch (PDOException $error) {
			die('ERROR: ' . $error->getMessage());
		}
	?>
</div>