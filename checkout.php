<?php
session_start();
include('db_connect.php');
include('header.php');

// التأكد من أن المستخدم قد سجل دخوله
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<div class="container" style="margin-top: 50px; margin-bottom: 50px;">
    <h2 class="text-center" style="color: #008080;">إتمام عملية الشراء</h2>
    <hr>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card" style="padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                <form action="process_checkout.php" method="POST">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>عنوان التوصيل بالتفصيل</label>
                        <input type="text" name="address" class="form-control" required placeholder="مثال: غزة، شارع الرمال، بناية رقم...">
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label>رقم الهاتف للتواصل</label>
                        <input type="text" name="phone" class="form-control" required placeholder="059xxxxxxx">
                    </div>
                    <button type="submit" class="btn btn-success btn-block" style="width: 100%; padding: 10px; font-size: 18px;">تأكيد الطلب الآن</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>