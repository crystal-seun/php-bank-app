<?php
date_default_timezone_set("Africa/Lagos");
echo date("F l j g:i a");
echo __DIR__;
require __DIR__ . '/vendor/autoload.php';

use Carbon\Carbon;

$date = Carbon::now() . "=========Now======<br>";
$today = Carbon::today() . "=========Now======<br>";
$tomm = Carbon::tomorrow() ."=========Now======<br>";
$yest = Carbon::yesterday() . "=========Now======<br>";

echo $date;
echo $today;
echo $tomm;
echo $yest . "<br>"; 

echo Carbon::now() -> addMinutes(20). " add minute<br>";
echo Carbon::now() -> addHours(20). " add hour<br>";
echo Carbon::now() -> addDays(20)." add days<br>";
echo Carbon::now() -> addYear(20). " add year<br>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>