<?php
include '../conn.php';
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = trim($_POST['password']);
    //Prepared Statement
    $query = 'SELECT id, username, password FROM vuln_users WHERE username=?';
    $stmt = mysqli_prepare($conn, $query);
    //Prepared Binding
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if($result && mysqli_num_rows($result) >= 1){
        $valid_user = mysqli_fetch_assoc($result);
        if ($_POST['password'] == $valid_user["password"]) {
            if ($valid_user["username"] == "admin") {
                session_regenerate_id(true);
                $_SESSION["admin"] = true;
                setcookie('admin', 'a1b2c3d4e5f6a7b8c9d0e1f2a3b4c5d6', time() + (86400 * 30), '/');
                echo '<script>alert("Logged in as admin")</script>';
                echo '<script>window.location.href="../Admin/admin.php"</script>';
            } else {
                session_regenerate_id(true);
                $_SESSION["uid"] = $valid_user["id"];
                echo '<script>alert("Successful User Login")</script>';
                echo '<script>window.location.href="../User/sec_update_profile.php"</script>';
            }
        } else {
            echo '<script>alert("Login Failed. Incorrect password.")</script>';
            echo '<script>window.location.href="login.html"</script>';
        }
    } else {
        echo '<script>alert("Login Failed. User not found.")</script>';
        echo '<script>window.location.href="login.html"</script>';
    }
}
