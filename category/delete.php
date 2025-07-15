<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM category WHERE category_id=$id");
header("Location: index.php");
?>
