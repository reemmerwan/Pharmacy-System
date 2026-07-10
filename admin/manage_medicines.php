<?php 
// 1. التعامل مع الجلسة والتحقق من الصلاحية
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { 
    header("Location: ../login.php"); 
    exit(); 
}

// 2. الاتصال بقاعدة البيانات
include('../db_connect.php');

// 3. منطق البحث
$sql = "SELECT * FROM medicines"; 
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM medicines WHERE name LIKE '%$search%'";
}
$result = $conn->query($sql);

// استدعاء الهيدر الموحد
include('../header.php'); 
?>

<style>
    /* السايد بار يبدأ خارج الشاشة */
    #sidebar {
        right: -220px;
        transition: 0.3s;
    }
    /* عند إضافة الكلاس 'active' يظهر السايد بار */
    #sidebar.active {
        right: 0px;
    }
    /* إزاحة المحتوى لليمين عند فتح القائمة */
    #main-content.active {
        margin-right: 220px;
    }
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
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #008080; color: white;">
                    <h3><span class="glyphicon glyphicon-list-alt"></span> إدارة مخزون الأدوية</h3>
                </div>
                <div class="panel-body">
                    
                    <a href="add_medicine.php" class="btn btn-success" style="margin-bottom: 20px;">
                        <span class="glyphicon glyphicon-plus"></span> إضافة دواء جديد
                    </a>

                    <form method="GET" class="form-inline" style="margin-bottom: 20px; float: left;">
                        <input type="text" name="search" class="form-control" placeholder="ابحث عن دواء...">
                        <button type="submit" class="btn btn-primary">بحث</button>
                        <a href="manage_medicines.php" class="btn btn-default">الكل</a>
                    </form>

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr style="background-color: #f5f5f5;">
                                <th>اسم الدواء</th>
                                <th>السعر</th>
                                <th>الكمية</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['price']); ?> $</td>
                                    <td><?php echo htmlspecialchars($row['stock_quantity']); ?></td>
                                    <td>
                                        <a href="edit_medicine.php?id=<?php echo $row['medicine_id']; ?>" class="btn btn-warning btn-xs">
                                            <span class="glyphicon glyphicon-edit"></span> تعديل
                                        </a>
                                        <a href="delete_medicine.php?id=<?php echo $row['medicine_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('هل أنت متأكد من الحذف؟');">
                                            <span class="glyphicon glyphicon-trash"></span> حذف
                                        </a>
                                    </td>
                                </tr>
                            <?php } 
                            } else { ?>
                                <tr><td colspan="4" class="text-center">لا توجد أدوية لعرضها حالياً.</td></tr>
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