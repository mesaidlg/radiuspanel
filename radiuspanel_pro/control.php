<?php 

$navigasi = "";
$navigasi = "control";

$radver = exec("sudo freeradius -v | grep 'Version' | awk 'FNR == 2 {print $3}'")

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
    <?php include 'navigasi.html'; ?>

	<?= $navigasi; ?>

    <div class="container" style="margin-top: 80px; min-height: 510px;">
        <div class="footer">
			&copy; 2020 | <a href="http://radiuspanel.net" target="blank">RadiusPanel.net</a>
		</div>
    </div>

    <script src="js/jquery-3.5.1.slim.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>