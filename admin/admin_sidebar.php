<div id="sidebar" style="position: fixed; top: 0; right: -220px; width: 220px; height: 100%; background-color: #2c3e50; padding-top: 60px; z-index: 1000; transition: 0.3s; direction: rtl;">
    
    <a href="javascript:void(0)" onclick="toggleSidebar()" style="position: absolute; top: 15px; left: 15px; color: white; font-size: 20px; text-decoration: none;">&times;</a>

    <ul class="nav nav-pills nav-stacked" style="padding-right: 15px; list-style: none;">
        <li style="margin-bottom: 10px;">
            <a href="dashboard.php" style="color: white; background-color: transparent; font-size: 16px; display: block; padding: 10px 15px; text-decoration: none;">
                <span class="glyphicon glyphicon-dashboard"></span> اللوحة الرئيسية
            </a>
        </li>
        <li style="margin-bottom: 10px;">
            <a href="manage_medicines.php" style="color: white; background-color: transparent; font-size: 16px; display: block; padding: 10px 15px; text-decoration: none;">
                <span class="glyphicon glyphicon-list-alt"></span> إدارة الأدوية
            </a>
        </li>
        <li style="margin-bottom: 10px;">
            <a href="manage_order.php" style="color: white; background-color: transparent; font-size: 16px; display: block; padding: 10px 15px; text-decoration: none;">
                <span class="glyphicon glyphicon-shopping-cart"></span> إدارة الطلبات
            </a>
        </li>
        <hr style="border-color: rgba(255,255,255,0.1); margin: 10px 0;">
        <li>
            <a href="../logout.php" style="color: #d9534f; background-color: transparent; font-size: 16px; display: block; padding: 10px 15px; text-decoration: none;">
                <span class="glyphicon glyphicon-off"></span> تسجيل الخروج
            </a>
        </li>
    </ul>
</div>