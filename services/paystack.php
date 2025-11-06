<?php
session_start();

include "../auth/loggedinUser.php";
include "../database/database.php";

require '../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');

$dotenv->load();

$authuser = $_SESSION['loggenIn'];
$amount = $_POST['amount'];
$email = $authUser['email'];

$secret_key = $_ENV['PAYSTACK_SECRET_KEY'];

try {
    $url = "https://api.paystack.co/transaction/initialize";
    $fields = [
        'email' => $email,
        'amount' => $amount,
        'callback_url' => 'http://localhost/php-bank-app/services/callback.php'
    ];
    $fields_string = http_build_query($fields);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $secret_key",
        "Cache-Control: no-cache",
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);

    $response = json_decode($result, true);
    $pay_url =  $response['data']['authorization_url'];
    echo $pay_url;
    header("Location: $pay_url");
} catch (\Exception $th) {
    echo $th->getMessage() . "From catch";
}