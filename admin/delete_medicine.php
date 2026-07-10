<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }

include('../db_connect.php');

$error_msg = "";
$success = false;

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $sql = "DELETE FROM medicines WHERE medicine_id = '$id'";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        $error_msg = "خطأ في قاعدة البيانات: " . $conn->error;
    }
} else {
    $error_msg = "لم يتم تحديد دواء للحذف.";
}

// استدعاء الهيدر
include('../header.php'); 
?>

<div class="container-fluid" style="margin-top: 20px; min-height: 500px;">
    <div class="row">
        <?php include('admin_sidebar.php'); ?>

        <div class="col-md-10" style="padding: 20px;">
            <div class="alert alert-danger text-center">
                <h3><span class="glyphicon glyphicon-alert"></span> خطأ أثناء الحذف</h3>
                <p><?php echo $error_msg; ?></p>
                <br>
                <a href="dashboard.php" class="btn btn-default">العودة للوحة التحكم</a>
            </div>
        </div>
    </div>
</div>

<?php include('../footer.php'); ?>