<?php
    $server   = "localhost";
    $user     = "root";
    $pass     = "";
    $database = "radius";

    $conn = mysqli_connect($server, $user, $pass, $database);

?>
<?php if (mysqli_connect_errno()) :?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>RadiusPanel Error</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/bootstrap.min.css">
    
</head>

<body>
    
    <div style="widht: 100%; background-color: red; color: white; padding: 20px; font-weight: bold;">
        KONEKSI DATABASE ERROR
    </div>
    <div style="width: 100%; min-height: 240px; border-bottom: 3px solid red;">
        <div style="margin: 20px; color: darkblue">
            Koneksi antara RadiusPanel ke database gagal.<br>
            Pesan kesalahan mysql: <a style="color: red; font-weight: bold"><?php echo mysqli_connect_error();?></a><br><br>
            Silahkan buka <a style="color: red; font-weight: bold;">db_koneksi.php</a><br>
            Petunjuk:<br>
            <table style="margin-left: 20px; color: red;" border>
                <tr align="center">
                    <th width="100px">Variable</th>
                    <th width="120px">Value</th>
                    <th width="250px">Keterangan</th>
                </tr>
                <tr>
                    <td>$server</td>
                    <td>"<?= $server; ?>"</td>
                    <td>---> isi "localhost"</td>
                </tr>
                <tr>
                    <td>$user</td>
                    <td>"<?= $user; ?>"</td>
                    <td>---> isikan username mysql</td>
                </tr>
                <tr>
                    <td>$pass</td>
                    <td>"<?= $pass; ?>"</td>
                    <td>---> isikan password mysql</td>
                </tr>
                <tr>
                    <td>$database</td>
                    <td>"<?= $database; ?>"</td>
                    <td>---> isikan nama database</td>
                </tr>
            </table>
        </div>
        <div align="center" style="margin: 10px;">
            <a href="/" class="btn btn-warning">Kembali</a>
        </div>
    </div>

    
</body>
</html>
<?php endif; ?>