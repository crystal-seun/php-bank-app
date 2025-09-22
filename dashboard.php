<?php
session_start();


if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$fullName = $user['first_name'] . " " . $user['last_name'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>WELCOME TO YOUR DASHBOARD ---- <?php echo strtoupper($fullName); ?></h1>
</body>
</html>