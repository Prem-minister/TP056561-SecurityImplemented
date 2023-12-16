<?php
session_start();

include '../conn.php';
$user_id = $_SESSION['uid'];
$sql = 'SELECT id, name, username, password, description FROM vuln_users WHERE id = "'.$user_id.'"';
$result = $conn->query($sql);
$user = $result->fetch_assoc();
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../login/login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Profile Update</title>
    <link rel="stylesheet" href="update_profile.css">
</head>

<body>
    <div class="container">
        <h3 style="font:green;">Welcome, <?php echo $user['username']; ?></h3>
        <p><a href="?logout=true">Logout</a></p>
        <h2>User Profile Update</h2>
        <form action="update_profile.php" method="post">
             <input type="text" id="id" name="id" value="<?php echo $user_id; ?>" hidden>
            <div class="inputBox">
                <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required readonly>
                <label for="name">Name</label>
            </div>
            <div class="inputBox">
                <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>">
                <label for="username">Username</label>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
<!-- <script src="http://localhost/TP056561-AscVulnerable/script.js">*-->
</html>
