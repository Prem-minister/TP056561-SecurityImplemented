<?php
include '../conn.php';

$username = $_POST["username"];
$user_id = $_POST["id"];
$username = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');

$update = "UPDATE vuln_users SET username = ? WHERE id = ?";
$stmt = mysqli_prepare($conn, $update);
mysqli_stmt_bind_param($stmt, "si", $username, $user_id);
mysqli_stmt_execute($stmt);

if (mysqli_affected_rows($conn)>0) {
    echo '<script>alert("Successfully username updated!")</script>';
    echo '<script>window.location.href="sec_update_profile.php"</script>';  
} else {
    echo '<script>alert("Nothing updated!")</script>';
    echo '<script>window.location.href="sec_update_profile.php"</script>';
}

?>
<!-- <script src="http://localhost/TP056561-SecurityImplemented/script.js"></script>*-->
