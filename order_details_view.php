<?php
session_start();
include('db_connect.php');
include('header.php');

// التأكد من استلام order_id من الرابط
if (!isset($_GET['order_id'])) {
    header("Location: user_orders.php");
    exit();
}

$order_id = $_GET['order_id'];
$user_id = $_SESSION['user_id'];

// استعلام لجلب تفاصيل الأدوية للطلبية المختارة
$sql = "SELECT od.*, m.name 
        FROM order_details od
        JOIN medicines m ON od.medicine_id = m.id
        WHERE od.order_id = '$order_id'";
$result = $conn->query($sql);
?>

<div class="container" style="margin-top: 50px;">
    <h2>تفاصيل الطلب رقم: <?php echo htmlspecialchars($order_id); ?></h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>اسم الدواء</th>
                <th>الكمية</th>
                <th>السعر (وقت الطلب)</th>
                <th>الإجمالي</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0;
            while($row = $result->fetch_assoc()) { 
                $subtotal = $row['quantity'] * $row['price_at_order'];
                $grand_total += $subtotal;
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                <td><?php echo number_format($row['price_at_order'], 2); ?></td>
                <td><?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <h3>المجموع الكلي للطلب: <?php echo number_format($grand_total, 2); ?></h3>
    <br>
    <a href="user_orders.php" class="btn btn-default">العودة لقائمة طلباتي</a>
</div>

<?php include('footer.php'); ?>