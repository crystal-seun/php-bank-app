<?php
session_start();
$loggedInUser = $_SESSION['loggenIn'];
if (!$loggedInUser['token'] || time() > $loggedInUser['token_exp']) {
    header("Location: ../login.php?error=Your token has expired");
    exit;
}
$email = $loggedInUser['email'];
$database = mysqli_connect("localhost", "root", "root", "bank-app");
if (!$database) {
    echo "Database not connecting";
}
// File upload
// $query = "SELECT user FROM users WHERE email='$email'";
$query = "SELECT first_name, last_name, role FROM users WHERE email='$email'";
// $db_user = mysqli_fetch_assoc($database, $query);
$response = mysqli_query($database, $query);
$db_user = mysqli_fetch_assoc($response);
print_r($db_user);
if ($db_user['role'] !== "admin") {
    header("Location: ../dashboard.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <h1>Welcome, <?php echo "$db_user[first_name] $db_user[last_name]" ?></h1>
        <h1>All users</h1>
    </main>
</body>

</html>
