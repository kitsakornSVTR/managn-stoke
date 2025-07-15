<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM customer WHERE customer_id=$id");
$customer = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE customer SET firstname=?, lastname=?, email=?, phone=?, address=? WHERE customer_id=?");
    $stmt->bind_param("sssssi", $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['phone'], $_POST['address'], $id);
    $stmt->execute();
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>แก้ไขลูกค้า - PHP CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
      body { background: linear-gradient(135deg, #3a5068, #5bc0be); color: #e0e6f8; min-height: 100vh; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
      .navbar { background-color: rgba(58, 80, 104, 0.85); box-shadow: 0 2px 8px rgba(0,0,0,0.2); }
      .navbar .nav-link { color: #d6e4f0; transition: color 0.3s ease; }
      .navbar .nav-link.active, .navbar .nav-link:hover { color: #ffd166; }
      .card { background-color: rgba(20, 33, 61, 0.85); border-radius: 1rem; box-shadow: 0 8px 24px rgba(0,0,0,0.3); padding: 2.5rem 1.5rem; max-width: 600px; margin: auto; }
      h1, h2 { color: #ffd166; font-weight: 700; margin-bottom: 1rem; }
      label { color: #ffd166; font-weight: 500; }
      .form-control, textarea { background: #22304a; color: #e0e6f8; border: 1px solid #5bc0be; }
      .form-control:focus, textarea:focus { border-color: #ffd166; background: #22304a; color: #fff; }
      .btn-success, .btn-warning, .btn-danger { color: #fff; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold text-warning" href="../index.php">PHP CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="../index.php">🏠 หน้าแรก</a></li>
        <li class="nav-item"><a class="nav-link active" href="index.php">👤 ลูกค้า</a></li>
        <li class="nav-item"><a class="nav-link" href="../category/index.php">📂 หมวดหมู่</a></li>
        <li class="nav-item"><a class="nav-link" href="../product/index.php">📦 สินค้า</a></li>
        <li class="nav-item"><a class="nav-link" href="../purchase/index.php">🧾 การสั่งซื้อ</a></li>
      </ul>
    </div>
  </div>
</nav>
<main class="container my-5">
  <div class="card">
    <h2 class="mb-4">แก้ไขลูกค้า</h2>
    <form method="POST">
      <div class="mb-3">
        <label>ชื่อ</label>
        <input name="firstname" class="form-control" value="<?= $customer['firstname'] ?>" required>
      </div>
      <div class="mb-3">
        <label>นามสกุล</label>
        <input name="lastname" class="form-control" value="<?= $customer['lastname'] ?>" required>
      </div>
      <div class="mb-3">
        <label>อีเมล</label>
        <input name="email" class="form-control" value="<?= $customer['email'] ?>">
      </div>
      <div class="mb-3">
        <label>เบอร์โทร</label>
        <input name="phone" class="form-control" value="<?= $customer['phone'] ?>">
      </div>
      <div class="mb-3">
        <label>ที่อยู่</label>
        <textarea name="address" class="form-control" rows="2"><?= $customer['address'] ?></textarea>
      </div>
      <button type="submit" class="btn btn-warning">บันทึกการเปลี่ยนแปลง</button>
      <a href="index.php" class="btn btn-secondary ms-2">ยกเลิก</a>
    </form>
  </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
