<?php
$pdo = new PDO("mysql:host=localhost;dbname=your_db;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>