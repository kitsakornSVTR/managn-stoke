<?php
include('../db.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase_id'])) {
    $id = intval($_POST['purchase_id']);
    // ลบ purchase record โดยไม่คืน stock
    $conn->query("DELETE FROM purchase WHERE purchase_id = $id");
}
header('Location: index.php');
exit;
?>
