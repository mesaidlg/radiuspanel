<?php 
    include 'db_koneksi.php';

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data) {
        global $conn;
            $username = htmlspecialchars($data["username"]);
            $value = htmlspecialchars($data["value"]);
        
            $result = mysqli_query($conn, "SELECT username FROM radcheck WHERE username = '$username'");
        
        if( mysqli_fetch_assoc($result) ) {
            echo "<script>alert('username sudah ada')</script>";
            return false;
        }
        
            $query = "INSERT INTO radcheck VALUE (NULL, '$username', 'Cleartext-Password', ':=', '$value')";
        mysqli_query($conn, $query);
        
        return mysqli_affected_rows($conn);
        
    }

    function delete($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM radcheck WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function edit($data) {
		global $conn;
		$id = $data["id"];
		$username = htmlspecialchars($data["username"]);
		$value = htmlspecialchars($data["value"]);
	
		$query = "UPDATE radcheck SET username = '$username', value = '$value', attribute = 'Cleartext-Password', op = ':=' WHERE id = $id
		";
	
	mysqli_query($conn, $query);
	
	return mysqli_affected_rows($conn);
    }
    
?>