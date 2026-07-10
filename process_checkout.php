
<?php
session_start();
include('db_connect.php');

// التأكد من أن الطلب تم إرساله عبر النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // التأكد من تسجيل الدخول
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];
    
    // تنظيف البيانات المدخلة
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    // تحديث الطلب في قاعدة البيانات ليصبح مؤكداً
    $sql = "UPDATE orders SET status = 'confirmed', delivery_address = '$address', phone = '$phone' 
            WHERE user_id = '$user_id' AND status = 'pending'";
    
    if ($conn->query($sql)) {
        
        // 1. جلب رقم الطلب الذي تم تأكيده للتو
        $order_query = "SELECT order_id FROM orders 
                        WHERE user_id = '$user_id' AND status = 'confirmed' 
                        ORDER BY order_id DESC LIMIT 1";
        
        $result = $conn->query($order_query);
        $row = $result->fetch_assoc();
        
        // التأكد من وجود الطلب
        if ($row) {
            $order_id = $row['order_id'];
            
            // 2. التوجيه لصفحة الفاتورة مع رقم الطلب
            header("Location: invoice.php?order_id=" . $order_id);
            exit();
        } else {
            echo "خطأ: لم يتم العثور على الطلب بعد التحديث.";
        }

    } else {
        echo "خطأ في قاعدة البيانات: " . $conn->error;
    }
} else {
    // إذا حاول المستخدم الوصول للملف مباشرة
    header("Location: cart.php");
    exit();
}
?>