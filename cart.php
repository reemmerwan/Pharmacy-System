<?php
session_start();
include('db_connect.php');
include('header.php');

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; 

// استعلام لجلب محتويات السلة
$query = "SELECT o.order_id, m.name, m.price, od.quantity, m.medicine_id 
          FROM orders o
          JOIN order_details od ON o.order_id = od.order_id
          JOIN medicines m ON od.medicine_id = m.medicine_id
          WHERE o.user_id = '$user_id' AND o.status = 'pending'";

$result = $conn->query($query);
?>

<div class="container" style="margin-top: 40px; margin-bottom: 50px;">
    <h2 class="text-center" style="color: #008080; font-weight: bold; margin-bottom: 30px;">حقيبة مشترياتك</h2>
    
    <div class="row">
        <?php 
        $total_sum = 0;
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()): 
                $subtotal = $row['price'] * $row['quantity'];
                $total_sum += $subtotal;
        ?>
        <div class="col-md-12">
            <div class="card" style="background: #fff; padding: 20px; margin-bottom: 15px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); display: flex; flex-direction: row; justify-content: space-between; align-items: center;">
                
                <div style="flex: 2; text-align: right;">
                    <small style="color: #999; display: block; font-size: 11px;">اسم الدواء</small>
                    <h4 style="margin: 5px 0 0 0; color: #333; font-weight: bold;"><?php echo htmlspecialchars($row['name']); ?></h4>
                </div>

                <div style="flex: 1; text-align: center;">
                    <small style="color: #999; display: block; font-size: 11px;">السعر</small>
                    <div style="font-weight: bold; margin-top: 5px;"><?php echo number_format($row['price'], 2); ?> شيكل</div>
                </div>

                <form action="update_cart.php" method="POST" style="flex: 1.5; text-align: center;">
                    <small style="color: #999; display: block; font-size: 11px;">الكمية</small>
                    <div style="display: flex; justify-content: center; gap: 5px; margin-top: 5px;">
                        <input type="hidden" name="medicine_id" value="<?php echo $row['medicine_id']; ?>">
                        <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" class="form-control" style="width: 60px;">
                        <button type="submit" class="btn btn-primary">تحديث</button>
                    </div>
                </form>

                <div style="flex: 1; text-align: center; color: #008080; font-weight: bold;">
                    <small style="color: #999; display: block; font-size: 11px;">الإجمالي</small>
                    <div style="margin-top: 5px;"><?php echo number_format($subtotal, 2); ?> شيكل</div>
                </div>

                <div style="flex: 0.5; text-align: center;">
                    <small style="color: #999; display: block; font-size: 11px;">إجراء</small>
                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?php echo $row['medicine_id']; ?>" 
                       style="margin-top: 5px;">
                        حذف
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="deleteModal<?php echo $row['medicine_id']; ?>" tabindex="-1" role="dialog">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header"><h4 class="modal-title">تأكيد الحذف</h4></div>
              <div class="modal-body"><p>هل أنتِ متأكدة من حذف هذا الدواء من السلة؟</p></div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">إلغاء</button>
                <a href="remove_from_cart.php?medicine_id=<?php echo $row['medicine_id']; ?>" class="btn btn-danger">نعم، احذف</a>
              </div>
            </div>
          </div>
        </div>
        <?php endwhile; 
        } else {
            echo "<div class='text-center' style='padding: 50px;'><h4>سلة المشتريات فارغة حالياً</h4></div>";
        }
        ?>
    </div>

    <div class="text-center" style="margin-top: 30px; padding: 25px; background: #f9f9f9; border-radius: 15px;">
        <h3 style="margin-top: 0;">الإجمالي النهائي للسلة: <span style="color: #d9534f; font-weight: bold;"><?php echo number_format($total_sum, 2); ?> شيكل</span></h3>
        <a href="checkout.php" class="btn btn-success btn-lg" style="margin-top: 15px; padding: 10px 40px;">إتمام عملية الشراء</a>
    </div>
</div>

<?php include('footer.php'); ?>