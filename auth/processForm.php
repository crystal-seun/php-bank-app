<?php
$fn = $_POST['first_name'];
$ln = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];
$role = $_POST['role'];

function displayError($message)
{
    header("Location: ../register.php?anything=$message");
    exit();
}

if (empty($fn)) displayError("First name is required");
if (empty($ln)) displayError("Last name is required");
if (empty($email)) displayError("Email is required");
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) displayError("Your email is invalid");

if (empty($password)) displayError("Password is required");
if (!preg_match("/[a-z]/", $password)) displayError("Your password must contain lowercase");
if (!preg_match("/[A-Z]/", $password)) displayError("Your password must contain uppercase");
if (!preg_match("/[0-9]/", $password)) displayError("Your password must contain at least one number");
if (!preg_match("/[#@_$&*!+{}()]/", $password)) displayError("Your password must contain at least one special character");

if ($password != $c_password) displayError("Your password does not match");

if (empty($role)) displayError("Role is required");

$hashed = password_hash($password, PASSWORD_DEFAULT);

session_start();
$userDetails = [
    "email" => $email,
    "password" => $hashed,
    "fn" => $fn,
    "ln" => $ln,
    "role" => strtolower($role)
];
$_SESSION['userDetails'] = $userDetails;


if (strtolower($role) === "admin") {
    header("Location: ../admin.php");
    exit();
} elseif (strtolower($role) === "user") {
    header("Location: ../dashboard.php");
    exit();
} else {
    displayError("Invalid role. Please enter 'admin' or 'user'.");
}