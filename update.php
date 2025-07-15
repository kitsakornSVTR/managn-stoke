<?php include 'db.php'; ?>
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM users WHERE id=$id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูล</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="header">แก้ไขข้อมูล</div>
        <form method="POST">
            <div class="form-group">
                <label>ชื่อ:</label>
                <input type="text" name="name" value="<?= $row['name'] ?>" required>
            </div>
            <div class="form-group">
                <label>อีเมล:</label>
                <input type="email" name="email" value="<?= $row['email'] ?>" required>
            </div>
            <div class="actions">
                <button type="submit" class="btn">อัปเดต</button>
                <a href="index.php" class="btn">กลับ</a>
            </div>
        </form>
    </div>
</body>
</html>
