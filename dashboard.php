<?php
session_start();
if (!isset($_SESSION['loggenIn'])) {
    header("Location: login.php?error=Please login");
    return;
}
$user = $_SESSION['loggenIn'];
if (!$user['token'] || $user['token_exp'] < time()) {
    header("Location: login.php?error=Token expired, Please login");
    return;
}
print_r($user);

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
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
     <?php include "components/navbar.html" ?>
    <form action="dashboard.php" method="get">
        <button name="logout">Logout</button>
    </form>
    <div>
        <h1>Welcome to your dashboard <?php echo "$user[fn] $user[ln]" ?></h1>
    </div>
</body>

</html>