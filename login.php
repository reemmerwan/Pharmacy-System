<?php 
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') { 
        header("Location: admin/dashboard.php"); 
        exit(); 
    } elseif ($_SESSION['role'] == 'user') { 
        header("Location: admin/medicines.php"); 
        exit(); 
    }
}

include('db_connect.php');

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username_input = $conn->real_escape_string($_POST['username']); 
    $password_input = $_POST['password'];
// الجزء الجديد الآمن
    $stmt = $conn->prepare("SELECT user_id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username_input);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // التحقق من كلمة المرور المشفرة
        if (password_verify($password_input, $user['password'])) { 
            
            $_SESSION['user_id']  = $user['user_id'];
            $_SESSION['role']     = $user['role'];
            $_SESSION['username'] = $user['username']; 

            if (isset($_POST['remember'])) {
        setcookie("user_name", $username_input, time() + (86400 * 30), "/"); 
    } else {
        // إذا لم يختر التذكر، نحذف الكوكيز القديمة إن وجدت
        setcookie("user_name", "", time() - 3600, "/");
    }
            
            if ($user['role'] == 'admin') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: admin/medicines.php");
            }
            exit();
        } else { 
            $error = "كلمة المرور غير صحيحة!"; 
        }
    } else { 
        $error = "اسم المستخدم غير موجود!"; 
    }
    
    $stmt->close(); // لا تنسي إغلاق الاستعلام هنا
}


include('header.php'); 
?>

<div class="container" style="margin-top: 50px; min-height: 400px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-primary" style="border-color: #008080;">
                <div class="panel-heading" style="background-color: #008080; border-color: #008080;">
                    <h3 class="panel-title text-center"><span class="glyphicon glyphicon-lock"></span> تسجيل الدخول للصيدلية</h3>
                </div>
                <div class="panel-body">
                    <?php if($error != "") echo "<div class='alert alert-danger'>$error</div>"; ?>
                    
                    <form method="POST" action="login.php">
                        <div class="form-group">
              <label>اسم المستخدم</label>
              <input type="text" class="form-control" name="username" placeholder="أدخل اسم المستخدم" 
           value="<?php echo isset($_COOKIE['user_name']) ? htmlspecialchars($_COOKIE['user_name']) : ''; ?>" 
           required autofocus>
            </div>
                 <div class="form-group">
                  <label>
                <input type="checkbox" name="remember" <?php if(isset($_COOKIE['user_name'])) echo 'checked'; ?>> تذكرني
             </label>
                </div>
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input type="password" class="form-control" name="password" placeholder="أدخل كلمة المرور" required>
                        </div>
                        <button type="submit" class="btn btn-block" style="background-color: #008080; color: white;">دخول</button>
                        
                        <div class="text-center" style="margin-top: 15px;">
                            <p>لا تملك حساباً؟ <a href="register.php" style="color: #008080; font-weight: bold;">سجل الآن</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>