<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "pharmacys_db"; 
$conn = new mysqli($host, $user, $pass, $dbname,3307);
$conn->set_charset("utf8mb4");

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>