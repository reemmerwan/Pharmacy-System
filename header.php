<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>صيدلية PharmaFast</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <style>
        body { font-family: 'Tajawal', sans-serif; }
        
        .navbar-custom { 
            background-color: #007e80; 
            border-bottom: 3px solid #edf4f4;
            padding: 10px 0;
            margin-bottom: 0;
        }
        .navbar-custom .navbar-brand { 
            color: #ffffff !important; 
            font-size: 24px; 
            font-weight: bold;
        }
        .navbar-custom .nav > li > a { 
            color: #ffffff !important; 
            font-size: 16px;
            transition: 0.3s;
        }
        .navbar-custom .nav > li > a:hover { 
            background-color: #005f5f !important;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-custom navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="icon-bar" style="background-color: white;"></span>
                    <span class="icon-bar" style="background-color: white;"></span>
                    <span class="icon-bar" style="background-color: white;"></span>
                </button>
                <a class="navbar-brand" href="/Pharmacy_System/index.php">💊 صيدلية PharmaFast</a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="/Pharmacy_System/index.php">الرئيسية</a></li>
                    <li><a href="/Pharmacy_System/admin/medicines.php">المتجرالإلكتروني</a></li>
                    <li><a href="/Pharmacy_System/shop.php">من نحن</a></li>
                    <li><a href="/Pharmacy_System/articles.php">المقالات الطبية</a></li>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
                        <li><a href="user_orders.php">طلباتي السابقة</a></li>
                    <?php endif; ?>
                    
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <li><a href="/Pharmacy_System/admin/dashboard.php" style="color: #ffcc00 !important; font-weight: bold;">لوحة التحكم ⚙️</a></li>
                    <?php endif; ?>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li>
                            <a href="javascript:void(0);" style="pointer-events: none;">
                                <span class="glyphicon glyphicon-user"></span> أهلاً، <?php echo htmlspecialchars($_SESSION['username']); ?>
                            </a>
                        </li>
                        <li>
                            <a href="/Pharmacy_System/logout.php" style="color: #ff9999 !important;">
                                <span class="glyphicon glyphicon-log-out"></span> خروج
                            </a>
                        </li>
                    <?php else: ?>
                        <li><a href="/Pharmacy_System/login.php"><span class="glyphicon glyphicon-log-in"></span> دخول</a></li>
                        <li><a href="/Pharmacy_System/register.php"><span class="glyphicon glyphicon-user"></span> إنشاء حساب </a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>