<?php
session_start();
include('db_connect.php');

if (isset($_GET['medicine_id'])) {
    $medicine_id = $_GET['medicine_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

    // حذف الدواء من سلة المستخدم الحالية
    $sql = "DELETE od FROM order_details od
            JOIN orders o ON od.order_id = o.order_id
            WHERE od.medicine_id = '$medicine_id' 
            AND o.user_id = '$user_id' 
            AND o.status = 'pending'";

    $conn->query($sql);
}

header("Location: cart.php"); // العودة للسلة بعد الحذف
exit();
?>