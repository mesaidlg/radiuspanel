<?php

require 'functions.php';
	if( isset($_POST["submit"]) ) {
		if( tambah($_POST) > 0 ) {
			echo "
				<script>
					alert('Data Berhasil ditambahkan');
					document.location.href = 'add-user.php';
				</script>
			";
			}
			else {
				echo "
				<script>
					alert('Data gagal ditambahkan');
					document.location.href = 'add-user.php';
				</script>
				";
			}
	}

// navigasi
$navigasi = "";
$navigasi = "user";

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tambah User - RadiusPanel</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>

<body>

	<?php include 'navigasi.html'; ?>

	<form action="" method="POST">
		<div style="width: 400px; height: 400px; border-radius: 10px; position: absolute; left: 50%; transform: translate(-50%, 0); margin-top: 10px; border: 2px solid darkblue">
			<div align="center" style="width: 100%">
				<div style="width: 100%; background-color: darkblue; color: white; text-align: center; height: 50px; border-radius: 7px 7px 0 0; padding: 14px; font-weight: bold;">
					ADD USER
				</div>
			</div>
			<div style="margin: 17px; width: 90%">
				<div class="form-group">
					<label for="username">Username</label>
					<input name="username" type="text" class="form-control" id="username" aria-describedby="nisHelp" placeholder="Input username" required>
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input name="value" type="text" class="form-control" id="password" aria-describedby="PasswordHelp" placeholder="Input password" required>
				</div>
			</div>
			<div style="position: fixed; left: 20px; bottom: 20px">
				<a class="btn btn-warning" href="/" title="Kembali">Kembali</a>
			</div>
			<div align="center" style="position: fixed;right: 20px; bottom: 20px;">
				<button class="btn btn-primary" type="submit" name="submit">Tambah User</button>
			</div>
		</div>
	</form>	

	<?php include 'footer.html'; ?>

	<script src="bootstrap/jquery-3.5.1.slim.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
	<script src="bootstrap/bootstrap.min.js"></script>

</body>
</html>