<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { 
    header("Location: ../login.php"); 
    exit(); 
}

include('../db_connect.php');

// إحصائيات سريعة للداشبورد (الأدوية والطلبات فقط)
$total_medicines = $conn->query("SELECT COUNT(*) as count FROM medicines")->fetch_assoc()['count'];
$total_orders = $conn->query("SELECT COUNT(*) as count FROM orders")->fetch_assoc()['count'];

include('../header.php'); 
?>

<style>
    /* تنسيق حركة السايد بار والمحتوى الرئيسي */
    #sidebar.active { right: 0px !important; }
    #main-content.active { margin-right: 220px; }
    
    .dash-card {
        padding: 35px;
        border-radius: 8px;
        color: white;
        margin-bottom: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        transition: 0.2s;
    }
    .dash-card:hover { transform: translateY(-5px); }
</style>

<?php include('admin_sidebar.php'); ?>

<div style="padding: 15px;">
    <button class="btn btn-default" onclick="toggleSidebar()">
        <span class="glyphicon glyphicon-menu-hamburger"></span> القائمة
    </button>
</div>

<div id="main-content" style="margin-right: 0px; transition: 0.3s; padding: 20px;">
    
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #008080; color: white;">
                    <h3><span class="glyphicon glyphicon-dashboard"></span> لوحة تحكم المدير العام</h3>
                </div>
                <div class="panel-body" style="padding-top: 30px;">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="dash-card" style="background-color: #008080;">
                                <h4><span class="glyphicon glyphicon-list-alt"></span> إدارة الأدوية</h4>
                                <hr style="border-color: rgba(255,255,255,0.3);">
                                <p style="font-size: 16px;">إجمالي الأدوية المسجلة: <strong><?php echo $total_medicines; ?></strong></p>
                                <a href="manage_medicines.php" class="btn btn-default btn-sm" style="color: #008080; font-weight: bold;">
                                    دخول القسم &larr;
                                </a>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="dash-card" style="background-color: #2c3e50;">
                                <h4><span class="glyphicon glyphicon-shopping-cart"></span> إدارة الطلبات</h4>
                                <hr style="border-color: rgba(255,255,255,0.3);">
                                <p style="font-size: 16px;">إجمالي طلبات النظام: <strong><?php echo $total_orders; ?></strong></p>
                                <a href="manage_order.php" class="btn btn-default btn-sm" style="color: #2c3e50; font-weight: bold;">
                                    دخول القسم &larr;
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleSidebar() {
    var sb = document.getElementById('sidebar');
    var main = document.getElementById('main-content');
    
    if (sb && main) {
        sb.classList.toggle('active');
        main.classList.toggle('active');
    }
}
</script>

<?php include('../footer.php'); ?>