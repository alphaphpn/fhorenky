<?php
	$htitle = isset($_GET['htitle']) ? $_GET['htitle'] : "";
	$empid = isset($_GET['empid']) ? $_GET['empid'] : "";
	$empidfinale = isset($_GET['empidfinale']) ? $_GET['empidfinale'] : "";
	$fullname = isset($_GET['fullname']) ? $_GET['fullname'] : "";
	$username = isset($_GET['username']) ? $_GET['username'] : "";
	$pw = isset($_GET['pw']) ? $_GET['pw'] : "";
	$office = isset($_GET['office']) ? $_GET['office'] : "";
	$biolocation = isset($_GET['biolocation']) ? $_GET['biolocation'] : "";
?>

<div class="container">
	<table>
		<thead>
			<tr>
				<th><u><?php echo $htitle; ?></u></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Employee ID: <b><?php echo $empid; ?></b></td>
			</tr>
			<tr>
				<td>Bio#: <b><?php echo $empidfinale; ?></b></td>
			</tr>
			<tr>
				<td>Employee: <b><?php echo $fullname; ?></b></td>
			</tr>
			<tr>
				<td>Username: <b><?php echo $username; ?></b></td>
			</tr>
			<tr>
				<td>Temporary Password: <b><?php echo $pw; ?>#</b></td>
			</tr>
			<tr>
				<td align="right">Note: <u>Reset your password immediately after your first successfull login.</u></td>
			</tr>
			<tr>
				<td>Office: <b><?php echo $office; ?></b></td>
			</tr>
			<tr>
				<td>Biometric Location: <b><?php echo $biolocation; ?></b></td>
			</tr>
		</tbody>
	</table>
</div>

<script>
	$(document).ready(function(){
		window.print();
	});
</script>