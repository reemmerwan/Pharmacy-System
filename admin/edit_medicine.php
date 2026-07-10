<?php

// 1. الجلسة والتحقق

if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') { header("Location: ../login.php"); exit(); }

include('../db_connect.php');



// التأكد من وجود الـ id

if (!isset($_GET['id']) || empty($_GET['id'])) {

    header("Location: dashboard.php");

    exit();

}


$id = $conn->real_escape_string($_GET['id']);

$sql = "SELECT * FROM medicines WHERE medicine_id = '$id'";

$result = $conn->query($sql);

$medicine = $result->fetch_assoc();



if (!$medicine) { echo "الدواء غير موجود."; exit(); }



// معالجة التحديث
// معالجة التحديث
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $price = $conn->real_escape_string($_POST['price']);
    $stock = $conn->real_escape_string($_POST['stock_quantity']);
    $description = $conn->real_escape_string($_POST['description']);
    $new_cat_id = $conn->real_escape_string($_POST['category_id']); 
    $image_path = $medicine['image']; // الصورة القديمة افتراضياً

    // 1. معالجة رفع الصورة (إذا تم اختيار صورة جديدة)
    if (isset($_FILES['medicine_image']) && $_FILES['medicine_image']['error'] == 0) {
        $target_dir = "image_medicines/"; 
        $file_name = time() . "_" . basename($_FILES["medicine_image"]["name"]);
        
        if (move_uploaded_file($_FILES["medicine_image"]["tmp_name"], $target_dir . $file_name)) {
            $image_path = "image_medicines/" . $file_name; 
            
            // حذف القديمة إذا كانت موجودة
            if (!empty($medicine['image']) && file_exists($medicine['image'])) {
                unlink($medicine['image']);
            }
        }
    }

    // 2. جملة التحديث الوحيدة والصحيحة (تُنفذ في النهاية)
    $update_sql = "UPDATE medicines SET 
                   name='$name', 
                   price='$price', 
                   stock_quantity='$stock', 
                   description='$description', 
                   image='$image_path', 
                   category_id='$new_cat_id' 
                   WHERE medicine_id='$id'";
    
    // 3. التنفيذ والتحويل
    if ($conn->query($update_sql) === TRUE) {
        header("Location: dashboard.php?msg=updated");
        exit();
    } else {
        $error = "خطأ في التحديث: " . $conn->error;
    }
}


include('../header.php');

?>



<div class="container-fluid" style="margin-top: 20px; min-height: 500px;">

    <div class="row">

        <?php include('admin_sidebar.php'); ?>



        <div class="col-md-10" style="padding: 20px;">

            <div class="panel panel-default" style="border-color: #f0ad4e;">

                <div class="panel-heading" style="background-color: #f0ad4e; color: white;">

                    <h3><span class="glyphicon glyphicon-edit"></span> تعديل بيانات الدواء</h3>

                </div>

                <div class="panel-body">

                    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                   

                    <form method="POST" class="form-horizontal" enctype="multipart/form-data">

                        <div class="form-group">

                            <label class="col-md-2 control-label">اسم الدواء</label>

                            <div class="col-md-8">

                                <input type="text" name="name" value="<?php echo htmlspecialchars($medicine['name']); ?>" class="form-control" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label">السعر</label>

                            <div class="col-md-8">

                                <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($medicine['price']); ?>" class="form-control" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label">الكمية</label>

                            <div class="col-md-8">

                                <input type="number" name="stock_quantity" value="<?php echo htmlspecialchars($medicine['stock_quantity']); ?>" class="form-control" required>

                            </div>

                        </div>

                        <div class="form-group">

                            <label class="col-md-2 control-label">وصف الدواء</label>

                            <div class="col-md-8">

                                <textarea name="description" class="form-control" rows="3"><?php echo htmlspecialchars($medicine['description']); ?></textarea>

                            </div>

                        </div>
                      <label>تصنيف الدواء:</label>
<select name="category_id" class="form-control" required>
    <?php
    $cat_query = "SELECT * FROM categories";
    $cat_result = $conn->query($cat_query);
    
    while ($cat_row = $cat_result->fetch_assoc()) {
        // استخدمي $medicine بدلاً من $row في المقارنة
        $selected = ($cat_row['category_id'] == $medicine['category_id']) ? 'selected' : '';
        
        echo '<option value="' . $cat_row['category_id'] . '" ' . $selected . '>' 
             . $cat_row['category_name'] . 
             '</option>';
    }
    ?>
</select>

                        <div class="form-group">

                            <label class="col-md-2 control-label">الصورة الحالية</label>

                            <div class="col-md-8">

                                <img src="../<?php echo $medicine['image']; ?>" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;">

                                <p>استبدال الصورة (اختياري):</p>

                                <input type="file" name="medicine_image" class="form-control">

                            </div>

                        </div>

                        <div class="form-group">

                            <div class="col-md-8 col-md-offset-2">

                                <button type="submit" class="btn btn-warning btn-lg">حفظ التعديلات</button>

                                <a href="dashboard.php" class="btn btn-default btn-lg">إلغاء</a>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>



<?php include('../footer.php'); ?> هي الكود الخاص بصفحة التعديل للادوية 

