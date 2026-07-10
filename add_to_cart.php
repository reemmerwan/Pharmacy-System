<?php
session_start();
include('db_connect.php'); // تأكدي أن مسار ملف الاتصال صحيح

// 1. التأكد من أن المستخدم قد ضغط على زر الإضافة ومرر رقم الدواء
if (isset($_GET['medicine_id'])) {
    $medicine_id = $_GET['medicine_id'];
    
    // ملاحظة: نفترض أنكِ تستخدمين sessions لتحديد هوية المستخدم
    // إذا كنتِ لم تنشئي نظام تسجيل دخول بعد، يمكننا استخدام رقم افتراضي
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

    // 2. البحث عن سلة مفتوحة للمستخدم (طلب حالته 'pending')
    $query = "SELECT order_id FROM orders WHERE user_id = '$user_id' AND status = 'pending' LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // إذا وجدت سلة، نأخذ رقمها
        $order = $result->fetch_assoc();
        $order_id = $order['order_id'];
   } else {
        // إذا لم توجد، ننشئ طلباً جديداً (سلة جديدة)
        // لاحظي أننا حذفنا medicine_id وحذفنا NOW()
        $conn->query("INSERT INTO orders (user_id, status) VALUES ('$user_id', 'pending')");
        $order_id = $conn->insert_id;
    }

    // 3. إضافة الدواء إلى جدول تفاصيل الطلب
    // نتحقق أولاً إذا كان الدواء مضافاً مسبقاً لنزيد الكمية بدلاً من إضافة سطر جديد
    $check_item = $conn->query("SELECT * FROM order_details WHERE order_id = '$order_id' AND medicine_id = '$medicine_id'");
    
    if ($check_item->num_rows > 0) {
        $conn->query("UPDATE order_details SET quantity = quantity + 1 WHERE order_id = '$order_id' AND medicine_id = '$medicine_id'");
    } else {
        $conn->query("INSERT INTO order_details (order_id, medicine_id, quantity) VALUES ('$order_id', '$medicine_id', 1)");
    }

    // 4. الانتقال التلقائي إلى صفحة السلة
    header("Location: cart.php");
    exit();
} else {
    // إذا دخل المستخدم للملف بدون اختيار دواء، نعيده للرئيسية
    header("Location: index.php");
    exit();
}
?>