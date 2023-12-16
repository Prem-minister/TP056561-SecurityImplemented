<?php
//session management for BAC
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: ../login/login.html');
    exit();
}

function getUsersData()
{
    include '../conn.php';
    $sql = 'SELECT id, name, username, description FROM vuln_users';
    $result = $conn->query($sql);
    if (!$result) {
        echo "Query error: " . $conn->error;
    }
    return $result;
}


if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../login/login.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <div class="container">
        <h1>Welcome, Admin!</h1>
        <p?><a href="?logout=true">Logout</a></p>
            <h2>User Data</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Description</th>
                </tr>
                <?php
                $users = getUsersData();
                if ($users && $users->num_rows > 0) {
                    while ($row = $users->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['name']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['description']}</td>
                    </tr>";
                    }
                } else {
                    echo "No records found.";
                }
                ?>
            </table>
    </div>
</body>

</html>