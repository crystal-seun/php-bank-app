<?php
require 'vendor/autoload.php';

use Cloudinary\Cloudinary;

session_start();
if (!isset($_SESSION['userDetails'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['userDetails']['email'];

$database = mysqli_connect("localhost", "root", "", "bank_app");
if ($database) {
    echo "Connected";
} else {
    echo "Not connected";
    displayError("Database not connected");
}


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$cloudinary = new Cloudinary($_ENV["CLOUDINARY_URL"]);


if (isset($_POST['upload'])) {
    $file = $_FILES['image'];
    print_r($file);
    try{
        $result = $cloudinary->uploadApi()->upload($file['tmp_name']);
        if($result){
            echo "<img src='$result[secure_url]' />";
        }
    } catch (\Exception $th) {
        echo $th->getMessage() . "something went wrong";
    }
}

?>