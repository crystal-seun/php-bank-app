<?php
session_start();

require "../vendor/autoload.php";
include "../database/database.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$secret_key = $_ENV["PAYSTACK_SECRET_KEY"];

if (isset($_SESSION['loggenIn'])) {
    $loggedInUser = $_SESSION['loggenIn'];
    $email = $loggedInUser['email'];
    $user_query = "SELECT * FROM users WHERE email='$email'";
    $query_resp = mysqli_query($database, $user_query);
    $user = mysqli_fetch_assoc($query_resp);
}

if (!isset($_GET["reference"])) {
    die("Something went wrong with the payment");
    header("Location: ../index.php");
}
$ref = $_GET['reference'];

echo rawurlencode("Daiwl");
$url = "https://api.paystack.co/transaction/verify/" . rawurlencode($ref);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $secret_key",
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
print_r($result);
if ($result['status'] == true) {
    $amount = $result['data']['amount'];
    $new_amount = $user['amount'] + $amount;
    try {
        $query = "UPDATE users SET amount='$new_amount' WHERE email='$email'";
        $query_amount_resp = mysqli_query($database, $query);
        if ($query_amount_resp) {
            header("Location: ../index.php");
        }
    } catch (\Exception $th) {
        //throw $th;
        echo "Something went wrong" . $th->getMessage();
    }
}

// TRANSACTION TABLE => DEBIT \\ CREDIT
// transaction_id
// sender_id (12 => 15)
// receiver_id
// description
// transaction_amount
// transaction_status
// trasaction_type (deposit, transfer, withdrawal)
// sender_message = You transferred #777 to id_25
// receiver_message = You recieved #777 from id_12
// created_at
// updated_at