<?php
$fn = $_POST['first_name'];
$ln = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
$c_password = $_POST['c_password'];
$role = $_POST['role'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$dob = $_POST['dob'];
$gender = $_POST['gender'];
$c_password = $_POST['c_password'];


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

// $database = mysqli_connect("host_name", "username", "password", "database_name");
$database = mysqli_connect("localhost", "root", "root", "bank-app");

if ($database) {
    echo "Connected";
} else {
    echo "Not connected";
    displayError("Database not connected");
}


$sql_query = "INSERT INTO users (first_name, last_name, email, password, phone_number, address, role, dob, gender)
                         VALUES ('$fn', '$ln', '$email', '$hashed', '$phone', '$address', '$role', '$dob', '$gender')";
$response = mysqli_query($database, $sql_query);

if ($response) {
    session_start();
    $userDetails = ["email" => $email, "password" => $hashed, "fn" => $fn, "ln" => $ln];
    $_SESSION['userDetails'] = $userDetails;
    echo "User Created successfully";
    // sleep(5);
    header("Location: ../login.php?success=User created successfully");
} else {
    echo mysqli_error($database) . "Something went wrong";
}