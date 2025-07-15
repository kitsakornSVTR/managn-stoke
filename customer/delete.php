<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM customer WHERE customer_id=$id");
header("Location: index.php");
?>
