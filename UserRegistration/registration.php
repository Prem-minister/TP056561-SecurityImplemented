<?php
include '../conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $description = $_POST['description'];
    $role = 'user';
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $query = "INSERT INTO vuln_users (name, username, password, role, description) VALUES (?, ?, ?, ?, ?)";
  
     $stmt = mysqli_prepare($conn, $query);
     mysqli_stmt_bind_param($stmt, "sssss", $name, $username, $hashedPassword, $role, $description);
     $result = mysqli_stmt_execute($stmt);
 
     if (empty($name) || empty($username) || empty($password) || empty($description)) {
        echo '<script>alert("All fields are required!")</script>';
        echo '<script>window.location.href="registration.html"</script>';
        exit;
    }
    
    if ($result) {
        echo "User registered successfully.";
        echo '<script>alert("User Registered Successfully!");</script>';
        echo '<script>window.location.href="../login/login.html"</script>';  
    } else {
        echo '<script>alert("Failed User Registration!'.mysqli_error($conn).'")</script>';
        echo '<script>window.location.href="registration.html"</script>';
    }
}

?>


