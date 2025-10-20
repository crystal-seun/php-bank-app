<?php
require __DIR__ . '/vendor/autoload.php';
use Cloudinary\Cloudinary;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// $cloudinary = new Cloudinary([
//     'cloud' => [
//         "cloud_name" => 'dtnc3zhwf',
//         "api_key" => '421259134835321',
//         "api_secret" => 'vlKwfr1eXqMLxUHz6hnSwL4bfrc'
//     ],
//     "url" => ["secure" => true],
// ]);

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="cloudinary.php" enctype="multipart/form-data" method="post">
        <input name="image" type="file" accept="jpg">
        <button name="upload">upload image</button>
    </form>
</body>
</html>