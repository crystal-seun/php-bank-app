<?php
$fn = $_POST['first_name'];
$ln = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];
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
if (empty($fn)) {
    displayError("First name is required");
}
if (empty($ln)) {
    displayError("Last name is required");
}
if (empty($email)) {
    header("Location: ../register.php?anything=Email is required");
    exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../register.php?anything=Your email is invalid");
    exit();
}
if (!preg_match("/[a-z]/", $_POST['password'])) {
    header("Location: ../register.php?anything=Your password must contain lowercase");
    exit();
}
if (!preg_match("/[A-Z]/", $_POST['password'])) {
    header("Location: ../register.php?anything=Your password must contain uppercase");
    exit();
}
if (!preg_match("/[0-9]/", $_POST['password'])) {
    header("Location: ../register.php?anything=Your password must contain at least one number");
    exit();
}
if (!preg_match("/[#@_$&*!+{}()]/", $_POST['password'])) {
    header("Location: ../register.php?anything=Your password must contain at least one special character");
    exit();
}
if ($password != $c_password) {
    header("Location: ../register.php?anything=Your password does not match");
    exit();
}
// _}[-!2@]
$hashed = password_hash($password, PASSWORD_DEFAULT);
// $database = mysqli_connect("host_name", "username", "password", "database_name");
$database = mysqli_connect("localhost", "root", "", "bank_app");

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

// echo $fn;
// EMAIL_FILTER_VAR => Validate your email
// confirm your password => Can use regex
// password_hash => Hash your passsword
// Display the hashed password
// Display all user information in the processForm.php page after all input fields have been validated