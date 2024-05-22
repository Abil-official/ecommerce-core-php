<?php
$username = 'root';
$password = null;
$db = 'ecommerce_db';
$con = mysqli_connect('localhost', $username, $password, $db);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}