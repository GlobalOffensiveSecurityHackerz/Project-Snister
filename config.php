<?php

use Hyper\Hyper;

$host = "sql302.epizy.com";
$username = "epiz_32253852";
$password = "tGgKtkO4AwBwX";
$database = "epiz_32253852_hyper";
$con_status = "active";

$connect = new mysqli($host, $username, $password, $database);
// Checking Connection
if (mysqli_connect_errno()) {
    printf("Database connection failed: %s\n", mysqli_connect_error());
    exit();
} else {
    $con_status = "active";
}

require "./hyper.php";

$hyper = new Hyper($connect, "SQL");