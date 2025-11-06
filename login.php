<?php
session_start();
$user = $_SESSION['userDetails'] ?? null;
if ($user){
    print_r($user);
}
function displayError($message)
{
    header("Location: login.php?error=$message");
    exit();
}
// $database = mysqli_connect("localhost", "root", "root", "bank-app");
include "database/database.php";

if ($database) {
    echo "Connected";
} else {
    echo "Not connected";
    displayError("Database not connected");
}

// A QUERY TO FERTCH ALL USERS
// $query = "SELECT * FROM users";
// $query = "SELECT email, password, first_name, last_name, role FROM users";
// $response = mysqli_query($database, $query);
// if ($response) {
//     $db_users = mysqli_fetch_all($response, MYSQLI_ASSOC);
//     print_r($db_users);
// }

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //------------ A QUERY TO GET A SINGLE USER -------------
    try {
        $query = "SELECT email, password, role FROM users WHERE email='$email'";
        $response = mysqli_query($database, $query);
        //code...
        $db_user = mysqli_fetch_assoc($response); // get just one information i your database []

        print_r($db_user);

        if ($email !==  $db_user['email']) {
            echo "Incorrect email";
            // return;
        }
        if (!password_verify($password, $db_user['password'])) {
            displayError("Password not correct");
        }
        $token = bin2hex(random_bytes(16));
        $token_exp = time() + (60 * 5); // Token expires in 5minutes
        $loggedInUser = ["email" => $db_user['email'], "token" => $token, "token_exp" => $token_exp];
        $_SESSION['loggenIn'] = $loggedInUser;
        if ($db_user['role'] !== "admin") {
            header("Location: dashboard.php");
            exit;
        }
        header("Location: admin/allUsers.php");
    } catch (\Exception $th) {
        echo "Something went wrong" . $th->getMessage();
    }
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