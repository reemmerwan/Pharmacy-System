<?php 
include('db_connect.php'); 

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. استقبال البيانات
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; 
    $role = 'customer'; 

    // --- ضعي الـ Validation هنا بالضبط ---
    if (empty($username) || empty($password)) {
        $message = "<div class='alert alert-danger'>يرجى ملء جميع الحقول!</div>";
    } elseif (strlen($password) < 4) {
        $message = "<div class='alert alert-danger'>كلمة المرور يجب أن تكون 4 خانات على الأقل!</div>";
    } else {
        // --- إذا كانت البيانات صحيحة، ننتقل للتحقق من قاعدة البيانات ---
       // --- 1. التحقق من وجود المستخدم بطريقة آمنة ---
        $stmt_check = $conn->prepare("SELECT username FROM users WHERE username = ?");
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            $message = "<div class='alert alert-danger'>عذراً، اسم المستخدم هذا مسجل بالفعل!</div>";
        } else {
            // --- 2. تشفير كلمة المرور ---
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // --- 3. إضافة المستخدم بطريقة آمنة باستخدام Prepared Statements ---
            $stmt_insert = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
            $stmt_insert->bind_param("sss", $username, $hashed_password, $role);
            
            if ($stmt_insert->execute()) {
                $message = "<div class='alert alert-success'>تم إنشاء الحساب بنجاح!</div>";
            } else {
                $message = "<div class='alert alert-danger'>خطأ في التسجيل: " . $conn->error . "</div>";
            }
            $stmt_insert->close(); // إغلاق الاستعلام
        }
        $stmt_check->close(); 
        }// إغلاق الاستعلام
    // --- نهاية الـ Validation ---
}
include('header.php'); 
?>


<div class="container" style="margin-top: 50px; min-height: 400px;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary" style="border-color: #008080;">
                <div class="panel-heading" style="background-color: #008080; border-color: #008080;">
                    <h3 class="panel-title text-center">إنشاء حساب جديد في الصيدلية</h3>
                </div>
                <div class="panel-body">
                    <?php if(isset($message)) echo $message; ?>
                    
                    <form class="form-horizontal" method="POST" action="register.php">
                        <div class="form-group">
                            <label class="col-md-4 control-label">اسم المستخدم</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="username" placeholder="اسم المستخدم" required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">كلمة المرور</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password" placeholder="كلمة المرور" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-block" style="background-color: #008080; color: white;">تسجيل</button>
                            </div>
                        </div>
                        <div class="text-center">
                            <p>لديك حساب بالفعل؟ <a href="login.php" style="color: #008080;">سجل دخولك هنا</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

include('footer.php'); 
?>