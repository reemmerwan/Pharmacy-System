<?php 
if (session_status() === PHP_SESSION_NONE) session_start();
include('header.php'); 
?>

<style>
    .articles-header {
        background-color: #007e80;
        color: white;
        padding: 50px 0;
        text-align: center;
        margin-bottom: 40px;
        border-radius: 0 0 20px 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .article-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        margin-bottom: 30px;
        overflow: hidden;
        transition: 0.3s;
        border: 1px solid #edf4f4;
    }
    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .article-body {
        padding: 25px;
    }
    .article-tag {
        background-color: #edf4f4;
        color: #007e80;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: bold;
        display: inline-block;
        margin-bottom: 10px;
    }
    .article-title {
        color: #2c3e50;
        font-weight: bold;
        margin-top: 0;
        margin-bottom: 15px;
        font-size: 20px;
        line-height: 1.4;
    }
    .article-meta {
        font-size: 13px;
        color: #999;
        margin-bottom: 15px;
    }
    /* تنسيق المحتوى داخل النافذة المنبثقة */
    .modal-header { background-color: #007e80; color: white; border-radius: 5px 5px 0 0; }
    .modal-body p { font-size: 16px; line-height: 1.8; text-align: justify; color: #333; }
</style>

<div class="articles-header">
    <div class="container">
        <h1><span class="glyphicon glyphicon-book"></span> المدونة والمقالات الطبية</h1>
        <p style="font-size: 18px; margin-top: 10px; opacity: 0.9;">دليلك الصحي الموثوق تحت إشراف نخبة من الصيادلة والأخصائيين.</p>
    </div>
</div>

<div class="container" style="margin-bottom: 60px;">
    <div class="row">
        
        <div class="col-md-4">
            <div class="article-card">
                <div class="article-body">
                    <span class="article-tag">نصائح دوائية</span>
                    <h3 class="article-title">الاستخدام الصحيح للمضادات الحيوية ومخاطر الإفراط فيها</h3>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-calendar"></span> يونيو 2026 &nbsp;|&nbsp; 
                        <span class="glyphicon glyphicon-user"></span> د. رانيا (صيدلانية)
                    </div>
                    <p style="color: #666; text-align: justify; line-height: 1.6;">
                        إن تناول المضادات الحيوية دون استشارة طبية أو عدم إكمال الجرعة المحددة يؤدي إلى نشوء بكتيريا مقاومة للعقاقير، مما يجعل العلاجات المستقبليّة أقل فعالية...
                    </p>
                    <hr style="border-color: #edf4f4;">
                    <button class="btn btn-block" style="background-color: #007e80; color: white; font-weight: bold;" data-toggle="modal" data-target="#modal1">اقرأ المقال بالكامل &larr;</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="article-card">
                <div class="article-body">
                    <span class="article-tag">الإسعافات الأولية</span>
                    <h3 class="article-title">كيف تتعامل مع الحروق المنزلية البسيطة بطريقة صحيحة؟</h3>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-calendar"></span> يونيو 2026 &nbsp;|&nbsp; 
                        <span class="glyphicon glyphicon-user"></span> طاقم التثقيف الصحي
                    </div>
                    <p style="color: #666; text-align: justify; line-height: 1.6;">
                        عند التعرض لحرق بسيط، يجب سكب الماء الفاتر الجاري فوراً لمدة 10 دقائق، وتجنب تماماً وضع معجون الأسنان أو الزيوت لأنها تحبس الحرارة وتزيد من عمق الحرق...
                    </p>
                    <hr style="border-color: #edf4f4;">
                    <button class="btn btn-block" style="background-color: #007e80; color: white; font-weight: bold;" data-toggle="modal" data-target="#modal2">اقرأ المقال بالكامل &larr;</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="article-card">
                <div class="article-body">
                    <span class="article-tag">الأمراض المزمنة</span>
                    <h3 class="article-title">إرشادات يومية هامة لمرضى السكري لتجنب الهبوط المفاجئ</h3>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-calendar"></span> مايو 2026 &nbsp;|&nbsp; 
                        <span class="glyphicon glyphicon-user"></span> د. أحمد (مستشار طبي)
                    </div>
                    <p style="color: #666; text-align: justify; line-height: 1.6;">
                        الحفاظ على مواعيد الوجبات، وقياس نسبة السكر بانتظام، مع حمل قطع من الحلوى أو التمر دائماً، هي أهم الخطوات الوقائية التي تحمي مريض السكري من خطر الهبوط...
                    </p>
                    <hr style="border-color: #edf4f4;">
                    <button class="btn btn-block" style="background-color: #007e80; color: white; font-weight: bold;" data-toggle="modal" data-target="#modal3">اقرأ المقال بالكامل &larr;</button>
                </div>
            </div>
        </div>

    </div><div class="row" style="margin-top: 20px;">
        
        <div class="col-md-4">
            <div class="article-card">
                <div class="article-body">
                    <span class="article-tag">التغذية العلاجية</span>
                    <h3 class="article-title">أهم الأطعمة والفيتامينات لتعزيز المناعة في فصل الشتاء</h3>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-calendar"></span> يونيو 2026 &nbsp;|&nbsp; 
                        <span class="glyphicon glyphicon-user"></span> أخصائي التغذية
                    </div>
                    <p style="color: #666; text-align: justify; line-height: 1.6;">
                        تلعب التغذية السليمة دوراً محورياً في مقاومة نزلات البرد. يُنصح بالتركيز على الأطعمة الغنية بفيتامين C مثل الحمضيات، والزنك المتوفر في المكسرات، بالإضافة إلى فيتامين D لدعم خلايا المناعة...
                    </p>
                    <hr style="border-color: #edf4f4;">
                    <button class="btn btn-block" style="background-color: #007e80; color: white; font-weight: bold;" data-toggle="modal" data-target="#modal4">اقرأ المقال بالكامل &larr;</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="article-card">
                <div class="article-body">
                    <span class="article-tag">صحة الطفل</span>
                    <h3 class="article-title">حماية الأطفال من الجفاف خلال موجات الحر الصيفية</h3>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-calendar"></span> مايو 2026 &nbsp;|&nbsp; 
                        <span class="glyphicon glyphicon-user"></span> عيادة الأطفال
                    </div>
                    <p style="color: #666; text-align: justify; line-height: 1.6;">
                        يفقد الأطفال السوائل بسرعة أكبر من البالغين. من الضروري تشجيع الطفل على شرب الماء بانتظام طوال اليوم وتجنب العصائر السكرية، مع مراقبة علامات الجفاف مثل الخمول الشديد أو جفاف الفم...
                    </p>
                    <hr style="border-color: #edf4f4;">
                    <button class="btn btn-block" style="background-color: #007e80; color: white; font-weight: bold;" data-toggle="modal" data-target="#modal5">اقرأ المقال بالكامل &larr;</button>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="article-card">
                <div class="article-body">
                    <span class="article-tag">ثقافة دوائية</span>
                    <h3 class="article-title">مخاطر تخزين الأدوية في خزانة الحمام وكيفية حفظها</h3>
                    <div class="article-meta">
                        <span class="glyphicon glyphicon-calendar"></span> أبريل 2026 &nbsp;|&nbsp; 
                        <span class="glyphicon glyphicon-user"></span> د. محمد (صيدلاني جودة)
                    </div>
                    <p style="color: #666; text-align: justify; line-height: 1.6;">
                        يخطئ الكثيرون بحفظ الأدوية في الحمام، حيث تؤدي الرطوبة العالية والحرارة المتغيرة إلى تفكك المواد الفعالة وتلفها قبل تاريخ الانتهاء. المكان الأمثل هو مكان جاف، بارد، وبعيد عن الضوء...
                    </p>
                    <hr style="border-color: #edf4f4;">
                    <button class="btn btn-block" style="background-color: #007e80; color: white; font-weight: bold;" data-toggle="modal" data-target="#modal6">اقرأ المقال بالكامل &larr;</button>
                </div>
            </div>
        </div>

    </div></div>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title">الاستخدام الصحيح للمضادات الحيوية</h4>
            </div>
            <div class="modal-body">
                <p>إن تناول المضادات الحيوية دون استشارة طبية أو عدم إكمال الجرعة المحددة يؤدي إلى نشوء بكتيريا مقاومة للعقاقير، مما يجعل العلاجات المستقبليّة أقل فعالية في جسم المريض.</p>
                <p><strong>توصية الصيدلية:</strong> يجب الالتزام التام بالجرعة والمواعيد المحددة من قبل الطبيب حتى لو شعرت بالتحسن قبل انتهاء العبوة، وتجنب تماماً استخدام متبقيات المضادات الحيوية القديمة دون استشارة جديدة.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal2" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title">التعامل مع الحروق المنزلية البسيطة</h4>
            </div>
            <div class="modal-body">
                <p>عند التعرض لحرق بسيط من الدرجة الأولى، يجب سكب الماء الفاتر الجاري فوراً لمدة 10 دقائق، وتجنب تماماً وضع معجون الأسنان أو الثلج أو الزيوت لأنها تحبس الحرارة وتزيد من عمق الحرق وتلوثه البكتيري.</p>
                <p><strong>توصية الصيدلية:</strong> بعد تبريد الحرق بالماء الفاتر، يفضل وضع طبقة رقيقة من الكريمات المرممة للجلد والمخصصة للحروق (مثل ميبو أو الكريمات التي تحتوي على البيتا-سيتوسترول) وتغطيتها بشاش معقم غير لاصق.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal3" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title">إرشادات يومية لمرضى السكري</h4>
            </div>
            <div class="modal-body">
                <p>الحفاظ على مواعيد الوجبات، وقياس نسبة السكر بانتظام، مع حمل قطع من الحلوى أو التمر دائماً، هي أهم الخطوات الوقائية التي تحمي مريض السكري من خطر الهبوط المفاجئ الذي قد يشكل خطورة على الوعي.</p>
                <p><strong>توصية الصيدلية:</strong> في حال الشعور بأعراض الهبوط كالدوار أو التعرق البارد، اتبع قاعدة 15/15: تناول 15 جراماً من السكريات السريعة (نصف كوب عصير أو 3 قطع حلوى)، ثم انتظر 15 دقيقة وأعد فحص السكر للتأكد من استقراره.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal4" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title">أطعمة وفيتامينات لتعزيز المناعة</h4>
            </div>
            <div class="modal-body">
                <p>تلعب التغذية السليمة دوراً محورياً في مقاومة نزلات البرد والإنفلونزا الموسمية. يُنصح بالتركيز على الأطعمة الغنية بفيتامين C مثل الحمضيات والكيوي، والزنك المتوفر في المكسرات والبقوليات، بالإضافة إلى فيتامين D لدعم خلايا المناعة الأساسية.</p>
                <p><strong>توصية الصيدلية:</strong> يفضل الحصول على هذه الفيتامينات من مصادرها الطبيعية أولاً، وفي حال حاجتك لمكملات غذائية داعمة، يمكنك استشارة الصيدلي لتحديد الجرعة اليومية المناسبة لعمرك وحالتك الصحية.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal5" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title">حماية الأطفال من الجفاف في الصيف</h4>
            </div>
            <div class="modal-body">
                <p>يفقد الأطفال السوائل بسرعة أكبر من البالغين نتيجة الحركة المستمرة ومساحة سطح الجسم. من الضروري تشجيع الطفل على شرب الماء بانتظام طوال اليوم وتجنب العصائر السكرية الصناعية، مع مراقبة علامات الجفاف مثل الخمول الشديد، قلّة التبول، أو جفاف الفم.</p>
                <p><strong>توصية الصيدلية:</strong> احرصي على تواجد عبوة ماء باردة مع طفلك دائماً أثناء اللعب، وفي حالات النزلات المعوية أو التعرق المفرط، ينصح بالاحتفاظ بمحلول الجفاف الفموي (ORS) المعوض للأملاح في المنزل دائماً لاستخدامه فوراً.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal6" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">&times;</button>
                <h4 class="modal-title">مخاطر تخزين الأدوية في الحمام</h4>
            </div>
            <div class="modal-body">
                <p>يخطئ الكثيرون بحفظ الأدوية في الحمام، حيث تؤدي الرطوبة العالية الناجمة عن الاستحمام والحرارة المتغيرة داخل الغرفة إلى تفكك الكبسولات وتلف المواد الفعالة في الحبوب، مما قد يسبب فسادها وتغير مفعولها الطبي تماماً قبل تاريخ الانتهاء المطبوع.</p>
                <p><strong>توصية الصيدلية:</strong> المكان الأمثل لحفظ الأدوية هو في صندوق مغلق خاص، يوضع في مكان جاف، بارد (درجة حرارة أقل من 25 مئوية)، وبعيد تماماً عن الضوء المباشر ومتناول أيدي الأطفال (مثل خزانة غرف النوم).</p>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>