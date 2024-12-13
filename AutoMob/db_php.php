<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "automob_mechanic";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
