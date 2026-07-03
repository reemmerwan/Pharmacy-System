<?php include('header.php'); ?>

<style>
   
    .hero-section {
        background: linear-gradient(rgba(0, 128, 128, 0.8), rgba(0, 128, 128, 0.8)), 
                    url('https://images.unsplash.com/photo-1587854692152-cbe660dbde88?auto=format&fit=crop&w=1350&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 120px 0;
        text-align: center;
    }
    .hero-section h1 { font-size: 3.5em; font-weight: bold; }
    .feature-box { padding: 40px 20px; transition: 0.3s; }
    .feature-box:hover { transform: scale(1.05); }
    .icon-style { font-size: 50px; color: #008080; margin-bottom: 20px; }
    

    .section-title { margin-bottom: 50px; color: #008080; font-weight: bold; }
    .btn-custom { background-color: #008080; color: white; border: none; }
    .btn-custom:hover { background-color: #005f5f; color: white; }
</style>

<div class="hero-section">
    <h1>   صيدلية PharmaFast </h1>
    <p style="font-size: 22px;">الرعاية الصحية.. أصبحت أسهل وأسرع.</p>
    <br>
    <a href="register.php" class="btn btn-warning btn-lg" style="margin: 5px;">إنشاء حساب جديد</a>
    <a href="login.php" class="btn btn-default btn-lg" style="margin: 5px;">تسجيل الدخول</a>
</div>

<div class="container" style="margin-top: 60px; margin-bottom: 60px;">
    <div class="row text-center">
        <div class="col-md-4 feature-box">
            <span class="glyphicon glyphicon-certificate icon-style"></span>
            <h3>منتجات معتمدة</h3>
            <p>نضمن لكم جودة وأصالة جميع الأدوية والمستلزمات الطبية.</p>
        </div>
        <div class="col-md-4 feature-box">
            <span class="glyphicon glyphicon-send icon-style"></span>
            <h3>توصيل سريع وآمن</h3>
            <p>نصلكم أينما كنتم ضمن ظروف تخزين مثالية وصحية.</p>
        </div>
        <div class="col-md-4 feature-box">
            <span class="glyphicon glyphicon-user icon-style"></span>
            <h3>دعم صيدلاني</h3>
            <p>خبراء الصيدلة لدينا متاحون دائماً لتقديم الاستشارة اللازمة.</p>
        </div>
    </div>

    <hr>

    <div class="row" style="margin-top: 50px; display: flex; justify-content: center; gap: 30px; flex-wrap: wrap;">
    
    <div style="width: 100%; text-align: center; margin-bottom: 20px;">
        <h2 class="section-title">اكتشف خدماتنا</h2>
    </div>

    <div class="col-md-4" style="max-width: 350px;">
        <div class="panel panel-default" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div class="panel-body" style="padding: 30px;">
                <h3 style="color: #008080;">المتجر الإلكتروني</h3>
                <p>تسوق أحدث المنتجات والعروض الطبية.</p>
                <a href="http://localhost/Pharmacy_System/admin/medicines.php" class="btn btn-custom" style="background-color: #008080; color: white;">اذهب للمتجر</a>
            </div>
        </div>
    </div>
    
    <div class="col-md-4" style="max-width: 350px;">
        <div class="panel panel-default" style="border-radius: 15px; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
            <div class="panel-body" style="padding: 30px;">
                <h3 style="color: #008080;">المقالات الطبية</h3>
                <p>نصائح ومعلومات طبية موثوقة.</p>
                <a href="articles.php" class="btn btn-custom" style="background-color: #008080; color: white;">اقرأ المقالات</a>
            </div>
        </div>
    </div>
    
</div>

<?php include('footer.php'); ?>
