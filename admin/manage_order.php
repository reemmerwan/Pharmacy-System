<?php 
// 1. التعامل مع الجلسة والتحقق من الصلاحية
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { 
    header("Location: ../login.php"); 
    exit(); 
}

// 2. الاتصال بقاعدة البيانات
include('../db_connect.php');

// 3. تحديث حالة الطلب إذا قام المدير بتغييرها وضغط تحديث
if (isset($_POST['update_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = $conn->real_escape_string($_POST['status']);
    $conn->query("UPDATE orders SET status = '$new_status' WHERE order_id = '$order_id'");
    $success_msg = "تم تحديث حالة الطلب رقم #$order_id بنجاح!";
}

// 4. جلب جميع الطلبات مع بيانات الزبائن وتفاصيل الأدوية في استعلام واحد متطور
$query = "SELECT o.order_id, o.delivery_address, o.phone, o.status, o.created_at, 
                 u.username, od.quantity, m.name as medicine_name
          FROM orders o
          JOIN users u ON o.user_id = u.user_id
          JOIN order_details od ON o.order_id = od.order_id
          JOIN medicines m ON od.medicine_id = m.medicine_id
          ORDER BY o.created_at DESC";
$result = $conn->query($query);

// تجميع الأدوية التابعة لنفس الطلب في مصفوفة واحدة لمنع تكرار الصفوف
$orders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $oid = $row['order_id'];
        if (!isset($orders[$oid])) {
            $orders[$oid] = [
                'order_id' => $row['order_id'],
                'username' => $row['username'],
                'delivery_address' => $row['delivery_address'],
                'phone' => $row['phone'],
                'status' => $row['status'],
                'created_at' => $row['created_at'],
                'medicines' => []
            ];
        }
        $orders[$oid]['medicines'][] = [
            'name' => $row['medicine_name'],
            'quantity' => $row['quantity']
        ];
    }
}

// استدعاء الهيدر الموحد
include('../header.php'); 
?>

<style>
    #sidebar { right: -220px; transition: 0.3s; }
    #sidebar.active { right: 0px; }
    #main-content.active { margin-right: 220px; }
    .status-badge { padding: 5px 10px; border-radius: 4px; color: white; font-weight: bold; font-size: 12px; }
    .status-pending { background-color: #f0ad4e; }
    .status-confirmed { background-color: #008080; }
    .status-delivered { background-color: #5cb85c; }
</style>

<div style="padding: 15px;">
    <button class="btn btn-default" onclick="toggleSidebar()">
        <span class="glyphicon glyphicon-menu-hamburger"></span> القائمة
    </button>
</div>

<div id="main-content" style="margin-right: 0px; transition: 0.3s; padding: 20px;">
    
    <?php include('admin_sidebar.php'); ?>

    <div class="row">
        <div class="col-md-12">
            
            <?php if (isset($success_msg)): ?>
                <div class="alert alert-success text-center"><?php echo $success_msg; ?></div>
            <?php endif; ?>

            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #2c3e50; color: white;">
                    <h3><span class="glyphicon glyphicon-shopping-cart"></span> إدارة طلبات الزبائن الحالية</h3>
                </div>
                <div class="panel-body">
                    
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr style="background-color: #f5f5f5;">
                                <th style="width: 90px;">رقم الطلب</th>
                                <th>اسم الزبون</th>
                                <th>التاريخ والوقت</th>
                                <th>العنوان والهاتف</th>
                                <th>الأدوية المطلوبة</th>
                                <th>الحالة الحالية</th>
                                <th style="width: 210px;">تحديث الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($orders) > 0) {
                                foreach ($orders as $order) { ?>
                                <tr>
                                    <td class="text-center"><strong>#<?php echo $order['order_id']; ?></strong></td>
                                    <td><?php echo htmlspecialchars($order['username']); ?></td>
                                    <td style="font-size: 12px;"><?php echo $order['created_at']; ?></td>
                                    <td>
                                        <strong>العنوان:</strong> <?php echo htmlspecialchars($order['delivery_address']); ?><br>
                                        <strong>الهاتف:</strong> <?php echo htmlspecialchars($order['phone']); ?>
                                    </td>
                                    <td>
                                        <ul style="padding-right: 20px; margin: 0;">
                                            <?php foreach ($order['medicines'] as $med) { ?>
                                                <li><?php echo htmlspecialchars($med['name']); ?> (الكمية: <?php echo $med['quantity']; ?>)</li>
                                            <?php } ?>
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <span class="status-badge status-<?php echo $order['status']; ?>">
                                            <?php 
                                                if($order['status'] == 'pending') echo 'قيد الانتظار';
                                                elseif($order['status'] == 'confirmed') echo 'مؤكد';
                                                elseif($order['status'] == 'delivered') echo 'تم التوصيل';
                                                else echo $order['status'];
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" class="form-inline text-center">
                                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                            <select name="status" class="form-control input-sm" style="width: 110px;">
                                                <option value="pending" <?php if($order['status']=='pending') echo 'selected'; ?>>انتظار</option>
                                                <option value="confirmed" <?php if($order['status']=='confirmed') echo 'selected'; ?>>تأكيد</option>
                                                <option value="delivered" <?php if($order['status']=='delivered') echo 'selected'; ?>>توصيل</option>
                                            </select>
                                            <button type="submit" name="update_status" class="btn btn-success btn-sm">تحديث</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } 
                            } else { ?>
                                <tr><td colspan="7" class="text-center">لا توجد طلبات مسجلة في النظام حالياً.</td></tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    var sb = document.getElementById('sidebar');
    var main = document.getElementById('main-content');
    
    sb.classList.toggle('active');
    main.classList.toggle('active');
}
</script>

<?php include('../footer.php'); ?>