<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include('header.php'); 
?>

<style>
    .about-header {
        background-color: #007e80;
        color: white;
        padding: 60px 0;
        text-align: center;
        margin-bottom: 40px;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .about-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border-top: 4px solid #007e80;
        min-height: 220px;
    }
    .feature-icon {
        font-size: 35px;
        color: #007e80;
        margin-bottom: 15px;
    }
    .about-title {
        color: #007e80;
        font-weight: bold;
        margin-bottom: 20px;
    }
</style>

<div class="about-header">
    <div class="container">
        <h1>من نحن - صيدلية PharmaFast</h1>
        <p style="font-size: 18px; margin-top: 15px; opacity: 0.9;">نصل إليك أينما كنت لنوفر لك الرعاية الصحية والأدوية بأمان وسرعة.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 60px;">
    
    <div class="row">
        <div class="col-md-6">
            <h3 class="about-title"><span class="glyphicon glyphicon-info-sign"></span> رؤيتنا ورسالتنا</h3>
            <p style="font-size: 16px; line-height: 1.8; text-align: justify; color: #555;">
                تأسست <strong> صيدلية PharmaFast </strong> لتكون الحل التكنولوجي الأمثل والموثوق في قطاع الرعاية الصحية، حيث نسعى جاهدين لتسهيل وصول الأدوية والمستلزمات الطبية من الصيدلية إلى منزلك مباشرة بكبسة زر واحدة.
            </p>
            <p style="font-size: 16px; line-height: 1.8; text-align: justify; color: #555;">
                رسالتنا هي توفير تجربة شراء أمنة ودقيقة للمرضى تحت إشراف طاقم مؤهل ومحترف من المتخصصين، مع الالتزام التام بكافة معايير الجودة والحفاظ على الخصوصية والسرعة في تلبية الطلبات.
            </p>
        </div>
        
        <div class="col-md-6 text-center">
            <div style="background-color: #edf4f4; padding: 40px; border-radius: 15px; margin-top: 20px;">
                <span class="glyphicon glyphicon-plus-sign" style="font-size: 80px; color: #007e80; opacity: 0.8;"></span>
                <h4 style="color: #005f5f; font-weight: bold; margin-top: 15px;">رعاية صحية ذكية ومستدامة</h4>
                <p style="color: #666;">نوفر لك الوقت والجهد ونضمن لك دقة صرف الدواء ومراجعته برمجياً وطبياً.</p>
            </div>
        </div>
    </div>

    <hr style="margin: 40px 0; border-color: #edf4f4;">

    <h3 class="about-title text-center" style="margin-bottom: 40px;"><span class="glyphicon glyphicon-star"></span> لماذا تختار صيدلية PharmaFast؟</h3>
    
    <div class="row">
        <div class="col-md-4">
            <div class="about-card text-center">
                <div class="feature-icon">
                    <span class="glyphicon glyphicon-time"></span>
                </div>
                <h4 style="font-weight: bold; color: #2c3e50;">توفير الوقت والجهد</h4>
                <p style="color: #666; line-height: 1.6;">تصفح كافة الأدوية المتوفرة واطلبها فوراً دون الحاجة للانتظار أو مغادرة منزلك.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="about-card text-center">
                <div class="feature-icon">
                    <span class="glyphicon glyphicon-ok-sign"></span>
                </div>
                <h4 style="font-weight: bold; color: #2c3e50;">أدوية موثوقة ومضمونة</h4>
                <p style="color: #666; line-height: 1.6;">جميع الأدوية والمستلزمات مسجلة ومحفوظة ضمن بيئة تخزين طبية مطابقة لأعلى المعايير.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="about-card text-center">
                <div class="feature-icon">
                    <span class="glyphicon glyphicon-flash"></span>
                </div>
                <h4 style="font-weight: bold; color: #2c3e50;">توصيل سريع وذكي</h4>
                <p style="color: #666; line-height: 1.6;">نظام إدارة طلبات متطور يضمن معالجة طلبك وتوصيله إليك في أسرع وقت ممكن.</p>
            </div>
        </div>
    </div>

</div>

<?php include('footer.php'); ?>