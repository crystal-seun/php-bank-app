<?php
session_start();
include "database/database.php";
include "auth/loggedInUser.php";
$auth_user = $_SESSION["loggenIn"];
$email = $auth_user['email'];

$query = "SELECT * FROM users WHERE email='$email'";
$resp = mysqli_query($database, $query);
$user = mysqli_fetch_assoc($resp);
print_r($user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php include "components/navbar.html" ?>
    <div class="card w-50 mt-4 shadow mx-auto">
        <img width="180" src="images/Sample_User_Icon.png" alt="">
        <form action="profile.php">
            <input name="profile-pix" type="file">
            <button>Change Profile Pix</button>
        </form>
        <div>
            <h1>Name:<?php echo "$user[first_name] $user[last_name]" ?></h1>
            <h1>Email: <?php echo $user['email'] ?></h1>
            <h1>Account No: <?php echo $user['account_number'] ?></h1>
            <!-- toLocaleString() -->
            <h1>Wallet Balance: ₦<?php echo $user['amount'] ?></h1>

        </div>
    </div>
</body>

</html>