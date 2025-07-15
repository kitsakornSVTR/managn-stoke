<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>PHP CRUD - Soft Dark Theme</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    background: linear-gradient(135deg, #3a5068, #5bc0be);
    color: #e0e6f8;
    min-height: 100vh;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }
  .navbar {
    background-color: rgba(58, 80, 104, 0.85);
    box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  }
  .navbar .nav-link {
    color: #d6e4f0;
    transition: color 0.3s ease;
  }
  .navbar .nav-link.active,
  .navbar .nav-link:hover {
    color: #ffd166;
  }
  .card {
    background-color: rgba(20, 33, 61, 0.85);
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    padding: 3rem 2rem;
    max-width: 600px;
    margin: auto;
  }
  h1 {
    color: #ffd166;
    font-weight: 700;
    margin-bottom: 1rem;
  }
  p.lead {
    color: #cbd5e1;
    font-size: 1.25rem;
  }
  img {
    margin-top: 2rem;
    filter: drop-shadow(0 0 5px #ffd166aa);
  }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand fw-bold text-warning" href="index.php">PHP CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">🏠 หน้าแรก</a></li>
        <li class="nav-item"><a class="nav-link" href="customer/index.php">👤 ลูกค้า</a></li>
        <li class="nav-item"><a class="nav-link" href="category/index.php">📂 หมวดหมู่</a></li>
        <li class="nav-item"><a class="nav-link" href="product/index.php">📦 สินค้า</a></li>
        <li class="nav-item"><a class="nav-link" href="purchase/index.php">🧾 การสั่งซื้อ</a></li>
      </ul>
    </div>
  </div>
</nav>

<main class="container my-5">
  <div class="card text-center">
    <h1>ยินดีต้อนรับสู่ระบบจัดการ</h1>
    <p class="lead">เลือกเมนูด้านบนเพื่อจัดการข้อมูลของคุณ</p>
    <img src="https://cdn-icons-png.flaticon.com/512/2282/2282104.png" alt="Dashboard Icon" width="100" />
  </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
