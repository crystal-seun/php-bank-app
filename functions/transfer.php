<?php
function insufficientBalance($sender) {}
session_start();
include "../database/database.php";
$acc_num = $_POST['acc_num'];
$currentUser = $_SESSION["loggenIn"];

$query = "SELECT first_name, last_name, email FROM users WHERE account_number='$acc_num'";
$resp = mysqli_query($database, $query);
$user = mysqli_fetch_assoc($resp);
if ($user) {
    if ($currentUser['email'] === $user['email']) {
        header("Location: ../index.php?acc_err=Do you know what you're doing?");
        return;
    }
    $receiver = $user['email'];
    $_SESSION['receiver_email'] = $receiver;
    header("Location: ../index.php?acc_info=$user[first_name] $user[last_name]");
} else {
    header("Location: ../index.php?acc_err=The account does not exit");
}


if (isset($_POST['transferFunds'])) {
    $amount = $_POST['amount'];
    $receiver = $_SESSION['receiver_email'];
    $reciever_query = "SELECT amount FROM users WHERE email='$receiver'";
    $receiver_resp = mysqli_query($database, $reciever_query);
    $receiver_prev_amount = mysqli_fetch_assoc($receiver_resp);

    $new_amount = $receiver_prev_amount['amount'] + $amount;

    $update_receiver_amount = "UPDATE users SET amount='$new_amount' WHERE email='$receiver'";
    $update_resp = mysqli_query($database, $update_receiver_amount);
    if ($update_resp) {
        header("Location: ../index.php?success=Transfer successfull");
    }
}
