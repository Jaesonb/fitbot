<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ege";

// $servername = "localhost";
// $username = "u920736511_egedb";
// $password = "egedbESAN1";
// $dbname = "u920736511_egedb";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) {
    die("Connection failed: " . $connect->connect_error);
}
?>
