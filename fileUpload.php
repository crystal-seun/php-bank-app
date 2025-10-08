<?php
if (isset($_POST['upload'])) {
    // Select a directory/folder where you want to save the image
    $target_folder = "images/";
    // Select the file and create a path for reference
    $image_path = $target_folder . basename($_FILES["picture"]["name"]);

    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $image_path)) {
        echo "Uploaded";
    } else {
        echo "Something went wrong";
    }
}

if (isset($_POST['upload'])) {
    // $uploaded_img = $_FILES("image"),

}

// cloudinary => Open a cloudinary account
// composer
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main>
        <form action="fileUpload.php" method="post" enctype="multipart/form-data">
            <h1>Select a picture</h1>
            <input name="picture" type="file">
            <button name="upload">Upload Picture</button>
        </form>
    </main>
    <img src="<?php if ($image_path) {
                    echo $image_path;
                } ?>" alt="">
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLat8bZvhXD3ChSXyzGsFVh6qgplm1KhYPKA&s" alt="">
    <img src="images/images.jpg" alt="">
</body>

</html>