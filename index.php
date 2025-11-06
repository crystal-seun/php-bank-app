<?php
include "auth/loggedInUser.php";
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
    </nav>
    <h1>Welcome to my Banking App</h1>
    <h1>Add Funds</h1>
    <form action="services/paystack.php" method="post">
        <input name="amount" type="text">
        <button name="addFund">Add Funds</button>
    </form>
    <h1>Transfer Money</h1>
    <form action="functions/transfer.php" method="post">
        <?php if (!isset($_GET['acc_info'])) {
            echo "<input name=acc_num type=text placeholder='Enter account number'>";
        } ?>


        <?php if (isset($_GET['acc_info'])) {
            echo "
            <input name=amount placeholder='Enter the amount you want to send' />
            <div class='alert alert-success'>$_GET[acc_info]</div>
                    <button name=transferFunds class='btn btn-success'>Make Transfer</button>
            ";
        } ?>
        <?php if (isset($_GET['acc_err'])) {
            echo "<div class='alert alert-danger'>$_GET[acc_err]</div>";
        } ?>
        <button name="addFund">Transfer</button>
    </form>
</body>

</html>

<!-- Create a new github repository named (portfolio) 
=> Create a portfolio for a tech team
=> Landing page
=> About page
=> Contact page
=> Services page
=> Pricing page
=> Project page

--- Using the same navbar and footer for all pages (includes)
--- Don't hardcode the services and prices

{
    name: "Dan",
    email: "dan@gmil....."
}
LAN
WAN"
HTTPS -->