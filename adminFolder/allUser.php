<?php
session_start();
$loggedInUser = $_SESSION['loggenIn'];
if (!$loggedInUser['token'] || time() > $loggedInUser['token_exp']) {
    header("Location: ../login.php?error=Your token has expired");
    exit;
}
$email = $loggedInUser['email'];
$database = mysqli_connect("localhost", "root", "root", "bank-app");
if (!$database) {
    echo "Database not connecting";
}
// File upload
// $query = "SELECT user FROM users WHERE email='$email'";
$query = "SELECT first_name, last_name, role FROM users WHERE email='$email'";
// $db_user = mysqli_fetch_assoc($database, $query);
$response = mysqli_query($database, $query);
$db_user = mysqli_fetch_assoc($response);
print_r($db_user);
if ($db_user['role'] !== "admin") {
    header("Location: ../dashboard.php");
    exit;
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
    <main>
        <h1>Welcome, <?php echo "$db_user[first_name] $db_user[last_name]" ?></h1>
        <h1>All users</h1>
    </main>
</body>

</html>


<!-- 
Create a new folder names myProducts
It is going to have a form for creating a product 
FORM FIELDS
    Product name
    Product price
    Product category
    Product image => Image url (https://images.pexels.com/photos/90946/pexels-photo-90946.jpeg?cs=srgb&dl=pexels-madebymath-90946.jpg&fm=jpg)
    Product description
    Product Quantity

Create a new database with a name => my_store
It will have table of products

From the form page, go to all product page where it will display all of the product in your database
Include 
    See more button
    Add to cart button 
        => On each of the product

create another table in your (myProducts) database called carts
When you click on the add to cart button
It takes the products to the cart table

Create a navbar that will have
    Add product => Take you to the form where you can add new product
    All Product => Take you to the page where you can view all products added
    Cart => cart.php A page that displays products added to the cart table

Create a new github repopsitory
Submit the assigment with the repository link
 -->