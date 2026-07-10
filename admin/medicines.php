<?php 
include('../db_connect.php'); 
include('../header.php'); 
?>

<div class="container" style="margin-top: 50px;">
    <h2 class="text-center" style="color: #008080; margin-bottom: 40px;">قائمة الأدوية المتوفرة</h2>
    
    <div class="row" style="margin-bottom: 30px; text-align: center;">
        <a href="?all=1" class="btn btn-default">الكل</a>
        <?php
        $cat_query = "SELECT * FROM categories";
        $cat_result = $conn->query($cat_query);
        while ($cat = $cat_result->fetch_assoc()) {
    // التحقق هل هذا الزر هو المختار حالياً؟
    $active_class = (isset($_GET['cat_id']) && $_GET['cat_id'] == $cat['category_id']) ? 'btn-warning' : 'btn-info';
    
    echo '<a href="?cat_id=' . $cat['category_id'] . '" class="btn ' . $active_class . '" style="margin: 5px;">' 
         . $cat['category_name'] . '</a> ';
        }
        ?>
    </div>

    <div class="row" style="display: flex; flex-wrap: wrap;">
        <?php
        // 2. تعديل الاستعلام ليتناسب مع الفلترة
        $where = "";
        if (isset($_GET['cat_id']) && !empty($_GET['cat_id'])) {
            $cat_id = $conn->real_escape_string($_GET['cat_id']);
            $where = " WHERE medicines.category_id = '$cat_id' ";
        }

        $query = "SELECT medicines.*, categories.category_name 
                  FROM medicines 
                  LEFT JOIN categories ON medicines.category_id = categories.category_id 
                  $where";
        
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // (كود الصورة الخاص بك كما هو)
                $raw_image = $row['image'];
                $final_path = (strpos($raw_image, 'image_medicines/') !== false) ? $raw_image : 'image_medicines/' . $raw_image;
                $img_display = file_exists($final_path) ? $final_path : 'image_medicines/default.jpg';
                $img_src = $img_display . '?' . (file_exists($img_display) ? filemtime($img_display) : time());
        ?>
            <div class="col-md-3" style="display: flex; margin-bottom: 20px;">
                <div class="panel panel-default" style="display: flex; flex-direction: column; width: 100%; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                    <div class="panel-body" style="padding: 10px; text-align: center; display: flex; flex-direction: column; flex-grow: 1;">
                        <img src="<?php echo $img_src; ?>" style="width: 100%; height: 180px; object-fit: contain; background-color: #f9f9f9; flex-shrink: 0;">
                        <div style="flex-grow: 1; padding: 10px;">
                            <h4 style="font-weight: bold; height: 40px; overflow: hidden;"><?php echo htmlspecialchars($row['name']); ?></h4>
                            <div style="margin: 5px 0;">
                                <span class="label" style="background-color: #008080; color: white; padding: 3px 8px; border-radius: 10px; font-size: 11px;">
                                    <?php echo htmlspecialchars($row['category_name'] ?? 'بدون تصنيف'); ?>
                                </span>
                            </div>
                            <p style="color: #008080; font-size: 16px; margin: 5px 0;">السعر: <?php echo htmlspecialchars($row['price']); ?> شيكل</p>
                            <div class="desc-content" style="font-size: 13px; color: #666; height: 80px; overflow: hidden; text-align: justify; margin-bottom: 5px;">
                                <?php echo htmlspecialchars($row['description']); ?>
                            </div>
                            <button class="btn btn-link btn-xs read-more" style="color: #008080; font-weight: bold; cursor: pointer;">عرض المزيد</button>
                        </div>
                        <a href="../add_to_cart.php?medicine_id=<?php echo $row['medicine_id']; ?>" 
                           class="btn btn-primary btn-block" 
                           style="background-color: #008080; border: none; margin-top: auto; color: white; padding: 10px; text-decoration: none;">
                           <i class="fa fa-cart-plus"></i> إضافة للسلة
                        </a>
                    </div>
                </div>
            </div>
        <?php
            }
        } else {
            echo "<p class='text-center'>لا توجد أدوية بهذا التصنيف حالياً.</p>";
        }
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.read-more').click(function(){
        var desc = $(this).prev('.desc-content');
        if(desc.css('height') == '80px'){
            desc.css('height', 'auto');
            $(this).text('عرض أقل');
        } else {
            desc.css('height', '80px');
            $(this).text('عرض المزيد');
        }
    });
});
</script>

<?php include('../footer.php'); ?>