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
    <form class="w-50 m-auto mt-4 p-3 rounded shadow" action="auth/processForm.php" method="post">
        <?php
        if (isset($_GET['anything'])) {
            echo "<div class='alert alert-danger'>$_GET[anything]</div>";
        }
        ?>
        <h2>Register User</h2>
        <div class="form-group">
            <label class="text-dark" for="">First Name</label>
            <input name="first_name" class="form-control" type="text">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Last Name</label>
            <input name="last_name" class="form-control" type="text">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Email</label>
            <input name="email" class="form-control" type="email">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Password</label>
            <input name="password" class="form-control" type="text">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Confirm Password</label>
            <input name="c_password" class="form-control" type="text">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">DOB</label>
            <input class="form-control" type="date">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Phone</label>
            <input class="form-control" type="number">
        </div>
        <div class="form-group">
            <label class="text-dark" for="">Address</label>
            <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
        </div>
        <div class="my-3">
            <button class="btn btn-dark w-100">Register</button>
        </div>
    </form>
</body>

</html>