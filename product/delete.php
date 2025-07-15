<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM product WHERE product_id = $id");
header("Location: index.php");
?>
