<?php
// ✅ Start session only if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Check if user is logged in
if (isset($_SESSION["loggedIn"])) {
    $auth_user = $_SESSION["loggedIn"];

    // ✅ Check token expiration
    if ($auth_user['token_exp'] < time()) {
        // Token expired → redirect to login
        header("Location: /php-bank-app/login.php");
        exit();
    }
} else {
    // ✅ Not logged in → redirect to login
    header("Location: /php-bank-app/login.php");
    exit();
}
?>

// session_start();
// if (isset($_SESSION["loggenIn"])) {
//     $isLoggedIn = $_SESSION["loggenIn"];
//     if ($isLoggedIn['token_exp'] < time()) {
//         header("Location:/php-bank-app/login.php");
//         exit();
//     }
// } else {
//     header("Location: /php-bank-app/login.php");
//     exit();
// }