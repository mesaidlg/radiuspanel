<?php 

require 'functions.php';

$log = query("SELECT * FROM radpostauth ORDER BY authdate DESC");

// clear logs
if( isset($_POST["clear"]) ) {
	mysqli_query($conn, "DELETE FROM radpostauth");
	header("Location: logs.php");
}

// navigasi
$navigasi = "";
$navigasi = "log";

?>

<!DOCTYPE html>
<html>
<head>
	<title>RadiusPanel-Logs</title>
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="datatables/datatables.min.css">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

<body>

<?php include 'navigasi.html'; ?>

<div style="position: absolute; left: 50%; transform: translate(-50%, 0%); width: 1200px; margin-top: 10px; margin-bottom: 30px">
	<table class="table table-bordered table-striped table-hover" id="datatables">
		<thead>
			<tr align="center">
				<th>No</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Kelas</th>
				<th>IP Address</th>
				<th>Mac Address</th>
				<th>Reply Status</th>
				<th>Auth Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php $i = 1; ?>
		<?php foreach( $log as $row ) : ?>
		<?php
			$username = $row["username"];
			$result = mysqli_query($conn, "SELECT * FROM radcheck WHERE username = '$username'");
			$user = mysqli_fetch_assoc($result);
			$ipMac = mysqli_query($conn, "SELECT * FROM radacct WHERE username ='$username'");
			$ip = mysqli_fetch_assoc($ipMac);
		?>
		<tr>
			<td align="center"><?= $i; ?></td>
			<td><?= $row["username"]; ?></td>
			<td><?= $user["nama"]; ?></td>
			<td align="center"><?= $user["kelas"]; ?></td>
			<td align="center"><?= $ip["framedipaddress"] ?></td>
			<td align="center"><?= $ip["callingstationid"] ?></td>
			<td align="center"><?= $row["reply"]; ?></td>
			<td align="center"><?= $row["authdate"]; ?></td>
			<td align="center">
				<a class="btn btn-danger btn-sm" href="delete_log.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin hapus <?= $row["username"]; ?>?');">Delete</a>
			</td>
		</tr>

		<?php $i++; ?>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>

<div style="position: fixed; left: 5px; top: 100px">
	<form action="" method="POST">
		<button type="submit" name="clear" class="btn btn-danger" onclick="return confirm('yakin hapus semua log?');">Clear Logs</button>
	</form>
</div>

<?php include 'footer.html'; ?>

<script src="bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
	<script src="bootstrap/bootstrap.min.js"></script>
	<script src="datatables/datatables.min.js"></script>

	<script type="text/javascript">
		$(document).ready( function () {
    	$('#datatables').DataTable();
		} );
	</script>

</body>
</html>
