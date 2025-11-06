<?php
$database = mysqli_connect("localhost", "root", "", "bank_app");

if ($database) {
    echo "connected";
} else {
    echo "Not Connected";
}