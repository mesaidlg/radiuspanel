<?php

	require 'functions.php';

	if (mysqli_connect_errno()){
		header("Location: db_koneksi.php");
		exit;
	}

	$user = query("SELECT * FROM radcheck");

	$navigasi = "";
    $navigasi = "home";

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>RadiusPanel</title>	
	
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="datatables/datatables.min.css">
	<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    
</head>
<body>
	
	<?php include 'navigasi.html'; ?>

	<div style="position: absolute; left: 50%; transform: translate(-50%, 0%); width: 960px; margin-top: 10px; margin-bottom: 30px">
	<table class="table table-bordered table-striped table-hover" id="datatables">
		<thead>
		<tr align="center">
			<th style="width: 30px">NO</th>
			<th>USERNAME</th>
			<th style="width: 150px">PASSWORD</th>
			<th style="width: 100px">ACTION</th>
		</tr>
		</thead>
		
		<tbody>
		<?php $i = 1; ?>
		<?php foreach( $user as $row ) : ?>

		<tr>			
			<td align="center"><?php echo $i; ?></td>
			<td align="center"><?php echo $row["username"]; ?></td>
			<td align="center"><?php echo $row["value"]; ?></td>
			<td align="center">
				<a class="btn btn-warning btn-sm" href="edit.php?id=<?php echo $row["id"]; ?>">Edit</a>&nbsp;
				<a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row["id"]; ?>" 
					onclick="return confirm('yakin hapus <?= $row["username"]; ?>?');">Delete</a>
			 </td>
		</tr>

		<?php $i++; ?>
		<?php endforeach; ?>
		
		</tbody>
	</table>
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
