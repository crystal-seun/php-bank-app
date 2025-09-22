<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    echo "All fields are required";
    exit();
}

if (!isset($_SESSION['user'])) {
    echo "No user registered. Please register first.";
    exit();
}

$storedUser = $_SESSION['user'];

if ($email !== $storedUser['email']) {
    echo "User credentials not correct";
    exit();
}

if (!password_verify($password, $storedUser['password'])) {
    echo "User credentials not correct";
    exit();
}


$_SESSION['logged_in'] = true;
header("Location: dashboard.php");
exit();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form action="loginProcess.php" method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>

