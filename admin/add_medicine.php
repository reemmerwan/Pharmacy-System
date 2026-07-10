<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }

include('../db_connect.php');

$msg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $stock = $conn->real_escape_string($_POST['stock_quantity']);
    $description = $conn->real_escape_string($_POST['description']);

    // المجلد: داخل مجلد الـ admin مباشرة
    $target_dir = "image_medicines/"; 
    if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }

    $image_name = time() . '_' . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

       // استلام القيمة من النموذج
$cat_id = $conn->real_escape_string($_POST['category_id']); 

// تعديل الاستعلام ليشمل العمود الجديد
$sql = "INSERT INTO medicines (name, price, stock_quantity, description, image, category_id) 
        VALUES ('$name', '$price', '$stock', '$description', '$image_name', '$cat_id')";
        if ($conn->query($sql) === TRUE) {
            $msg = "<div class='alert alert-success'>تم إضافة الدواء بنجاح!</div>";
        } else {
            $msg = "<div class='alert alert-danger'>خطأ: " . $conn->error . "</div>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>فشل رفع الصورة!</div>";
    }
}

include('../header.php'); 
?>

<div class="container-fluid" style="margin-top: 20px;">
    <div class="row">
        <?php include('admin_sidebar.php'); ?>
        <div class="col-md-10">
            <h3>إضافة دواء جديد</h3>
            <?php echo $msg; ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" name="name" class="form-control" placeholder="اسم الدواء" required><br>
                <input type="number" name="price" class="form-control" placeholder="السعر" required><br>
                <input type="number" name="stock_quantity" class="form-control" placeholder="الكمية" required><br>
                <textarea name="description" class="form-control" placeholder="الوصف"></textarea><br>
                <label>تصنيف الدواء:</label>
<select name="category_id" class="form-control" required>
    <option value="">اختر التصنيف...</option>
    <?php
    $cat_query = "SELECT * FROM categories";
    $cat_result = $conn->query($cat_query);
    while ($row = $cat_result->fetch_assoc()) {
        echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
    }
    ?>
</select><br>
                <label>اختر صورة الدواء:</label>
                <input type="file" name="image" class="form-control" required><br>
                <button type="submit" class="btn btn-primary">حفظ</button>
            </form>
        </div>
    </div>
</div>
<?php include('../footer.php'); ?>