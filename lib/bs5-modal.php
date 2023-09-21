<?php
	If (empty($bs5Heading)) {
		$bs5Heading = "";
	}

	If (empty($bs5BodyContent)) {
		$bs5BodyContent = "";
	}

	If (empty($printContent)) {
		$printContent = "";
	}

	If (empty($printHeading)) {
		$printHeading = "";
	}
?>

<script>
	$(document).ready(function(){
		$("#b5Modal").modal('show');
	});
</script>

<div class="modal fade" id="b5Modal">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $bs5Heading; ?></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php echo $bs5BodyContent; ?>
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<?php
					if (empty($printBtn)) {

					} else {
						echo $printBtn;
					}
				?>
				<button id="btnCloseX" type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
			</div>

		</div>
	</div>
</div>

<script>
	let btnCloseX = document.querySelector("#btnCloseX");

	btnCloseX.addEventListener('click', async function() {
		document.getElementById("<?php echo $foczelem; ?>").focus();
	});
</script>