<?php
	$htitle = isset($_GET['htitle']) ? $_GET['htitle'] : "";
	$empid = isset($_GET['empid']) ? $_GET['empid'] : "";
	$bioidfinale = isset($_GET['bioidfinale']) ? $_GET['bioidfinale'] : "";
	$fullname = isset($_GET['fullname']) ? $_GET['fullname'] : "";
	$username = isset($_GET['username']) ? $_GET['username'] : "";
	$pw = isset($_GET['pw']) ? $_GET['pw'] : "";
	$office = isset($_GET['office']) ? $_GET['office'] : "";
	$biolocation = isset($_GET['biolocation']) ? $_GET['biolocation'] : "";
?>

<div class="container">
	<table class="border w-50">
		<thead class="border">
			<tr>
				<th class="px-2">
					<label>Republic of the Philippines</label>
				</th>
			</tr>
			<tr>
				<th class="px-2">
					<label>PLGU - ZSP</label>
				</th>
			</tr>
			<tr>
				<th class="px-2">
					<u><?php echo $htitle; ?></u>
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="px-2">Employee ID: <b><?php echo $empid; ?></b></td>
			</tr>
			<tr>
				<td class="px-2">Bio#: <b><?php echo $bioidfinale; ?></b></td>
			</tr>
			<tr>
				<td class="px-2">Employee: <b><?php echo $fullname; ?></b></td>
			</tr>
			<tr>
				<td class="px-2">Username: <b><?php echo $username; ?></b></td>
			</tr>
			<tr>
				<td class="px-2">Temporary Password: <b><?php echo $pw; ?>#</b></td>
			</tr>
			<tr>
				<td class="px-2" align="right">Note: <u>Reset your password immediately after your first successfull login.</u></td>
			</tr>
			<tr>
				<td class="px-2">Office: <b><?php echo $office; ?></b></td>
			</tr>
			<tr>
				<td class="px-2">Biometric Location: <b><?php echo $biolocation; ?></b></td>
			</tr>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		window.print();
	});
</script>