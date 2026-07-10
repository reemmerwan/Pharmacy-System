<?php
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medicine_id = $_POST['medicine_id'];
    $new_quantity = $_POST['quantity'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

    // تحديث الكمية في قاعدة البيانات
    $sql = "UPDATE order_details od
            JOIN orders o ON od.order_id = o.order_id
            SET od.quantity = '$new_quantity'
            WHERE od.medicine_id = '$medicine_id' 
            AND o.user_id = '$user_id' 
            AND o.status = 'pending'";

    $conn->query($sql);
}

header("Location: cart.php");
exit();
?>