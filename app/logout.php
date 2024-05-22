<?php
include "./connection.php";

session_start();

if (isset($_SESSION['user_id']) || !empty($_SESSION['user_id'])) {
    session_destroy();
    header("Location: ./pages/home/index.php");
    exit;
}
header("Location: ./pages/home/index.php");
exit;