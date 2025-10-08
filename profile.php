<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <?php include "components/navbar.html" ?>
    <div class="card w-25 mt-4 shadow mx-auto">
        <img src="images/Sample_User_Icon.png" alt="">
        <form action="profile.php">
            <input name="profile-pix" type="file">
            <button>Change Profile Pics</button>
        </form>
        <div>
            <h1>Name: User name</h1>
            <h1>Email: User email</h1>
        </div>
    </div>
</body>

</html>