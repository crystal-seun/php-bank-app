<?php
session_start();
$user = $_SESSION['userDetails'];
// print_r($user);

$database = mysqli_connect("localhost", "root", "root", "bank-app");

if ($database) {
    echo "Connected";
} else {
    echo "Not connected";
    displayError("Database not connected");
}


$query = "SELECT email, password, first_name, last_name FROM users";
$response = mysqli_query($database, $query);

if ($response) {
    $db_users = mysqli_fetch_all($response, MYSQLI_ASSOC);
    print_r($db_users);
}

function displayError($message)
{
    header("Location: login.php?error=$message");
    exit();
}
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email !== $user['email']) {
        displayError("User email not correct");
    }
    if (!password_verify($password, $user['password'])) {
        displayError("User password not correct");
    }

    $token = bin2hex(random_bytes(16));
    $token_exp = time() + 30;
    $loggedInUser = ["fn" => $user['fn'], "ln" => $user['ln'], "token" => $token, "token_exp" => $token_exp];
    $_SESSION['loggenIn'] = $loggedInUser;
    header("Location: dashboard.php");
}

$text = "This is php class";
$text2 = "My users token";
echo bin2hex($text) . "<br/>";
echo hex2bin("546869732069732070687020636c617373") . "<br/>";
echo random_bytes(16) . "<br/>";

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

    <form class="w-50 m-auto mt-4 p-3 rounded shadow" action="login.php" method="post">
        <?php
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>$_GET[error]</div>";
        }
        ?>
        <h2>Login</h2>
        <div class="form-group">
            <label class="text-dark" for="">Email</label>
            <input name="email" class="form-control" type="email">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Password</label>
            <input name="password" class="form-control" type="text">
        </div>
        <div class="my-3">
            <button name="login" class="btn btn-dark w-100">Login</button>
        </div>
        <div>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </form>
</body>

</html>