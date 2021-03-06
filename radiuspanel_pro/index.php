<?php 

	// mysql connect
	include 'functions.php';

	// navigasi
	$navigasi = "";
	$navigasi = "home";

	// jumlah
	$jmlUser = count(query("SELECT * FROM radcheck"));
	$jmlOnline = count(query("SELECT * FROM radacct WHERE acctstoptime = NULL"));
	$jmlLog = count(query("SELECT * FROM radpostauth"));

	// run
	$radver = exec("sudo freeradius -v | grep 'Version' | awk 'FNR == 2 {print $3}'");
	$radstat = exec("/etc/init.d/freeradius status | grep 'Active:' | awk '{print $2}'");
	$os = exec("lsb_release -d | awk '{print $2,$3,$4,$5}'");
	$processor = exec("cat /proc/cpuinfo | grep 'model name' | cut -d: -f2");
	$hdd = exec("df -h | grep sda | awk '{print $2}'");
	$ram = exec("free -h | grep Mem | awk '{print $2}'");
	$ramused = exec("free -h | grep Mem | awk '{print $3}'");

	if(isset($_POST["rad_restart"])) {
		exec("sudo /etc/init.d/freeradius restart");
		header("location: /");

	}

	if(isset($_POST["rad_stop"])) {
		exec("sudo /etc/init.d/freeradius stop");
		header("location: /");
	}

	if(isset($_POST["rad_start"])) {
		exec("sudo /etc/init.d/freeradius start");
		header("location: /");
	}

	if(isset($_POST["sys_reboot"])) {
		header("location: /");
		exit(0);
		exec("sudo reboot");
	}

	if(isset($_POST["sys_off"])) {
		header("location: /");
		exec("sudo shutdown -h now");
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>RadiusPanel</title>
	<link rel="stylesheet" href="css/fontawesome.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/default.css">
	
</head>
<body>
	<!-- Navigasi -->
	<?php include 'navigasi.html'; ?>
	<!-- end Navigasi -->
	
	<div class="container" style="margin-top: 80px; min-height: 510px;">
		<div class="card-deck">
			<div class="card text-white bg-primary">
				<div class="card-header">
					<i class="fas fa-users" aria-hidden="true"></i>
					User
				</div>
				<div class="card-body">
					<p class="card-text" style="font-size: 40px;"><?= $jmlUser; ?><span style="font-size: 20px;"> user</span></p>
				</div>
				<div class="card-footer bg-transparent">Selengkapnya <i class="fas fa-angle-right" aria-hidden="true"></i></div>
			</div>
			<div class="card text-white bg-secondary">
				<div class="card-header">
					<i class="fas fa-circle" aria-hidden="true" style="color: lime;"></i>
					Online User
				</div>
				<div class="card-body">
					<p class="card-text" style="font-size: 40px;"><?= $jmlOnline; ?><span style="font-size: 20px;"> user</span></p>
				</div>
				<div class="card-footer bg-transparent">Selengkapnya <i class="fas fa-angle-right" aria-hidden="true"></i></div>
			</div>
			<div class="card text-white bg-warning">
				<div class="card-header">
					<i class="fas fa-clipboard-check"></i>
					Akses Log
				</div>
				<div class="card-body">
					<p class="card-text" style="font-size: 40px;"><?= $jmlLog; ?><span style="font-size: 20px;"> list</span></p>
				</div>
				<div class="card-footer bg-transparent">Selengkapnya <i class="fas fa-angle-right" aria-hidden="true"></i></div>
			</div>
		</div>

		<form action="" method="POST">
		<div class="card-deck" style="margin-top: 30px;">
			<div class="card">
				<div class="card-header">
					<i class="fa fa-info-circle" aria-hidden="true"></i>
					Informasi FreeRadius
				</div>
				<div class="card-body">
					<p class="card-text" style="margin: 0;">
						<table style="width: 70%;">
							<tr>
								<td style="width: 150px;">FreeRadius Versi</td>
								<td style="width: 15px;">:</td>
								<td><?= $radver; ?></td>
							</tr>
							<tr>
								<td>FreeRadius Status</td>
								<td>:</td>
								<td>
									<?php if($radstat == "active") : ?>
									<div class="spinner-grow spinner-grow-sm text-success" role="status">
										<span class="sr-only">Loading... </span>
									</div>
									Aktif
									<?php elseif($radstat == "inactive") : ?>
										<div class="spinner-grow spinner-grow-sm text-danger" role="status">
										<span class="sr-only">Loading... </span>
									</div>
									Inactive
									<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td>RadiusPanel Versi</td>
								<td>:</td>
								<td>v.1.0.0</td>
							</tr>
							<?php if (!$conn) : ?>
							
							<tr>
								<td style="color: red; font-weight: bold" colspan="3">Koneksi Database ERROR.<br>Cek db_koneksi.php</td>
							</tr>
							  
							<?php endif; ?>
						</table>
					</p>
				</div>
				<div class="card-footer bg-transparent border-success">
					<button class="btn btn-sm btn-success" type="submit" name="rad_start">
					<i class="fas fa-play"></i>
						Start
					</button>
					<button class="btn btn-sm btn-danger" type="submit" name="rad_stop">
						<i class="fas fa-stop"></i>
						Stop
					</button>
					<button class="btn btn-sm btn-warning" type="submit" name="rad_restart">
						<i class="fas fa-redo-alt"></i>
						Restart
					</button>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<i class="fas fa-server" aria-hidden="true"></i>
					Informasi System
				</div>
				<div class="card-body">
					<p class="card-text" style="margin: 0;">
					<table style="width: 100%;">
							<tr>
								<td style="width: 150px;">Sistem Operasi</td>
								<td style="width: 15px;">:</td>
								<td><?= $os; ?></td>
							</tr>
							<tr>
								<td>Prosessor</td>
								<td>:</td>
								<td><?= $processor; ?></td>
							</tr>
							<tr>
								<td>Hardisk</td>
								<td>:</td>
								<td><?= $hdd; ?></td>
							</tr>
							<tr>
								<td>RAM</td>
								<td>:</td>
								<td><?= $ramused; ?> of <?= $ram; ?></td>
							</tr>
						</table>
					</p>
				</div>
				<div class="card-footer bg-transparent border-success">
					<button class="btn btn-sm btn-warning" type="submit" name="sys_reboot">
						<i class="fas fa-sync-alt"></i>
						Reboot
					</button>
					<button class="btn btn-sm btn-danger" type="submit" name="sys_off">
						<i class="fas fa-power-off"></i>
						Shutdown
					</button>
				</div>
			</div>
		</div>
		</form>

	</div>

	<div class="footer">
			&copy; 2020 | <a href="http://radiuspanel.net" target="blank">RadiusPanel.net</a> - v.1.0.0
	</div>

	<script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>