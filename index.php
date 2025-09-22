<?php
$greetings = "Welcome to Crystal Banking App";
$services = [
    "front end" => ["price" => 20000, "language" => "js"],
    "back end" => ["price" => 5000, "language" => "php"]
    ]

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include "components/navbar.html" ?>
    </nav>
    <h1><?php echo $greetings ?></h1>
    <!-- <h1><?php echo array_keys($services)[0] . $services['front end'] ?></h1>
    <h1><?php echo array_keys($services)[1] . $services['back end'] ?></h1> -->

    <?php
    foreach ($services as $key => $value) {
        echo "<h1> $key</h1>";
        foreach ($value as $el => $element) {
            echo "
            <ul>
                <li>$el => $element</li>
            </ul>
            ";
        }
    }
    ?>
</body>
</html>