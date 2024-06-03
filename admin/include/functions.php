<?php
session_start();
include "include/dbconfig.php";
date_default_timezone_set("Asia/Colombo");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_session']) || $_SESSION['user_session'] == "") {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit();
}

function calculateAge($dob) {
    $dob = new DateTime($dob);
    $currentDate = new DateTime();
    $age = $currentDate->diff($dob)->y;
    return $age;
}
?>
