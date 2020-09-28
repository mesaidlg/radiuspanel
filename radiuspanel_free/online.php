<?php

	// koneksi dan functions
	require 'functions.php';

	// users
	$online = query("SELECT * FROM radacct ORDER BY acctstarttime DESC");

	// navigasi bar
	$navigasi = "";
	$navigasi = "user";

?>

<!DOCTYPE html>
<html>
<head>
	<title>RaidusPane -  Online</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="datatables/datatables.min.css">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">

</head>
<body>

	<?php include 'navigasi.html'; ?>

	<div style="position: absolute; left: 50%; transform: translate(-50%, 0%); width: 1200px; margin-top: 10px; margin-bottom: 30px">
		<table class="table table-bordered table-striped table-hover" id="datatables">
			<thead>
				<tr align="center">
					<th>ID</th>
					<th>Username</th>
					<th>Nama</th>
					<th>Kelas</th>
					<th>IP Address</th>
					<th>Mac Address</th>
					<th>Start Time</th>
					
					<th>Up Time</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach( $online as $row ) : ?>
				<?php $username = $row["username"];
					$result = mysqli_query($conn, "SELECT * FROM radcheck WHERE username = '$username'");
					$user = mysqli_fetch_assoc($result);

					$detik = $row["acctsessiontime"];
					$jam = floor($row["acctsessiontime"] / 3600);
					$sisaJam = $detik - ( $jam * 3600 );
					$menit = floor( $sisaJam / 60 ) ;
					$sisaMenit = $sisaJam - ( $menit * 60 );
					$sisaDetik = $detik - ( $jam * 3600 ) - ( $menit * 60 ) ;
					
				?>
					<tr>
						<td align="center"><?= $i; ?></td>
						<td><?= $row["username"]; ?></td>
						<td><?= $user["nama"]; ?></td>
						<td align="center"><?= $user["kelas"]; ?></td>
						<td align="center"><?= $row["framedipaddress"]; ?></td>
						<td align="center"><?= $row["callingstationid"]; ?></td>
						<td align="center"><?= $row["acctstarttime"]; ?></td>
						
						<td align="center">
							<?php 
								if( $jam == "0" ) {
									echo "";
								} else {
									echo "$jam jam";
								}
							?>
							<?php 
								if( $menit == "0" ) {
									echo "";
								} else {
									echo " $menit menit";
								}
							?>
							<?php 
								if( $sisaDetik == "0" ) {
									echo "";
								} else {
									echo "$sisaDetik detik";
								}
							?>
						</td>
						<td align="center">
							<a class="btn btn-danger btn-sm" href="delete_online.php?id=<?= $row["radacctid"]; ?>" onclick="return confirm('yakin hapus <?= $row["username"]; ?>')">Delete</a>
						</td>
					</tr>
				<?php $i++; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<?php include 'footer.html' ?>

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
