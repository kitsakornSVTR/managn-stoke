<?php include('../db.php'); ?>
<?php
// คืนสต๊อกเมื่อมีการลบรายการสั่งซื้อ
$id = $_GET['id'];
$purchase = $conn->query("SELECT product_id, quantity FROM purchase WHERE purchase_id = $id");
if ($purchase && $row = $purchase->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    // อัปเดต stock สินค้า
    $conn->query("UPDATE product SET stock = stock + $quantity WHERE product_id = $product_id");
}
$conn->query("DELETE FROM purchase WHERE purchase_id = $id");
header("Location: index.php");
?>
