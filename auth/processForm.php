<?php
$fn = $_POST['first_name'];
$ln = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];

function displayError ($message) 
{
    header("location: ../register.php?anything=$message");
    exit();
}
if (empty($fn)) {
    displayError("First name is required");
}
if (empty($ln)) {
    displayError("last name is required");
    exit();
}
if (empty($email)) {
    header("Location: ../register.php?anything=email is required");
    exit();
}
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?anything=your email is invalid");
    exit();
}
if(preg_match("/[a-z]/" , $password)){
    header("Location: ../register.php?anything=Your password must contain lowercase");
    exit();
}
if(preg_match("/[A-Z]/" , $password)){
    header("Location: ../register.php?anything=Your password must contain uppercase");
    exit();
}
if(preg_match("/[0-9]/" , $password)){
    header("Location: ../register.php?anything=Your password must contain at least one number");
    exit();
}
if(preg_match("/[~@$&%*+_-]/" , $password)){
    header("Location: ../register.php?anything=Your password must contain at least one special character");
    exit();
}
if ($password != $c_password) {
    header("Location: ../register.php?anything=Your password does not match");
    exit();
}
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$userData = [
    "first_name" => $fn,
    "last_name" => $ln,
    "email" => $email,
    "password" => $hashedPassword
];
$_SESSION['user'] = $userData;

header("Location ../login.php");