<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include('header.php'); 
include('db_connect.php');

// 1. استقبال رقم الطلب من الرابط
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id <= 0) {
    die("<div class='container' style='margin-top:50px;'><div class='alert alert-danger'>خطأ: لم يتم تحديد الطلب.</div></div>");
}

// 2. جلب البيانات من جدول orders بناءً على رقم الطلب
$order_query = "SELECT * FROM orders WHERE order_id = '$order_id'";
$order_result = $conn->query($order_query);
$order = $order_result->fetch_assoc();

if (!$order) {
    die("<div class='container' style='margin-top:50px;'><div class='alert alert-danger'>الطلب غير موجود.</div></div>");
}

$user_name = isset($_SESSION['username']) ? $_SESSION['username'] : "مستخدم";
$order_date = $order['created_at'];
$delivery_address = $order['delivery_address'];
$phone = $order['phone'];

$total_price = 0;
$delivery_fee = 10.00;
?>

<div class="container">
    <div class="invoice-box">
        <div class="invoice-header">
            <h3>فاتورة الطلب #<?php echo $order_id; ?></h3>
            <p>التاريخ: <?php echo $order_date; ?></p>
        </div>

        <div>
            <p><strong>الاسم:</strong> <?php echo htmlspecialchars($user_name); ?></p>
            <p><strong>العنوان:</strong> <?php echo htmlspecialchars($delivery_address); ?></p>
            <p><strong>الهاتف:</strong> <?php echo htmlspecialchars($phone); ?></p>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>اسم الدواء</th>
                    <th>الكمية</th>
                    <th>السعر</th>
                    <th>الإجمالي</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // 3. الاستعلام الصحيح لجلب الأدوية من جدول order_details
              // الاستعلام الصحيح (مطابق لأسماء الأعمدة في phpMyAdmin)
$items_query = "SELECT od.*, m.name, m.price 
                FROM order_details od 
                JOIN medicines m ON od.medicine_id = m.medicine_id 
                WHERE od.order_id = '$order_id'";

$items_result = $conn->query($items_query);

if ($items_result && $items_result->num_rows > 0) {
    while ($item = $items_result->fetch_assoc()) {
        // احسبي الإجمالي باستخدام السعر المجلوب من الجدول
        $subtotal = $item['quantity'] * $item['price'];
        $total_price += $subtotal;
        
        // عرض البيانات
        echo "<tr>
                <td>{$item['name']}</td>
                <td>{$item['quantity']}</td>
                <td>{$item['price']} شيكل</td>
                <td>" . number_format($subtotal, 2) . " شيكل</td>
              </tr>";
    }
}
                 else {
                    echo "<tr><td colspan='4'>لا توجد أدوية لهذا الطلب.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        
        <h4>المجموع النهائي: <?php echo number_format($total_price + $delivery_fee, 2); ?> شيكل</h4>
        <button onclick="window.print()" class="btn btn-primary">طباعة الفاتورة</button>
    </div>
</div>

<?php include('footer.php'); ?>
<style>
    /* تحسينات التصميم العام */
    body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    .invoice-box {
        max-width: 800px;
        margin: 50px auto;
        background: #fff;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-top: 8px solid #007e80; /* خط علوي ملون */
    }

    .invoice-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
    .invoice-title { color: #007e80; font-size: 36px; font-weight: 800; margin: 0; }
    
    /* تصميم الجدول */
    .table-invoice { width: 100%; border-collapse: collapse; margin: 20px 0; }
    .table-invoice th { background-color: #007e80; color: #fff; padding: 12px; text-align: center; }
    .table-invoice td { padding: 15px; border-bottom: 1px solid #eee; text-align: center; }
    
    /* تصميم المجموع النهائي */
    .totals { float: left; width: 300px; }
    .totals table { width: 100%; }
    .totals td { padding: 8px 0; }
    .grand-total { color: #007e80; font-size: 20px; font-weight: bold; border-top: 2px solid #007e80; }

    /* أزرار الطباعة */
    .no-print { margin-top: 30px; text-align: center; }
    @media print {
        .no-print { display: none; }
        .invoice-box { box-shadow: none; border-top: 8px solid #007e80; margin: 0; }
        body { background: #fff; }
    }
</style>