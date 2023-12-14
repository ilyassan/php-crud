<?php

$servername = "localhost";
$database = "php_pdo_crud";
// your database username and password
$username = "???";
$password = "???";

try {
    // connect to the database
    $con = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection Faild" . $e->getMessage();
}
