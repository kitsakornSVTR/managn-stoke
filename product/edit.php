<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$product = $conn->query("SELECT * FROM product WHERE product_id = $id")->fetch_assoc();
$categories = $conn->query("SELECT * FROM category");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $conn->prepare("UPDATE product SET product_name=?, price=?, stock=?, category_id=? WHERE product_id=?");
    $stmt->bind_param("sdiii", $_POST['product_name'], $_POST['price'], $_POST['stock'], $_POST['category_id'], $id);
    $stmt->execute();
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>แก้ไขสินค้า - PHP CRUD</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body {
    background: linear-gradient(135deg, #3a5068, #5bc0be);
    color: #e0e6f8;
    min-height: 100vh;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
  }
  .card {
    background-color: rgba(20, 33, 61, 0.85);
    border-radius: 1rem;
    box-shadow: 0 8px 24px rgba(0,0,0,0.3);
    padding: 2.5rem 2rem;
    max-width: 600px;
    margin: 3rem auto;
  }
  h2 {
    color: #ffd166;
    font-weight: 700;
    margin-bottom: 1.5rem;
    text-align: center;
  }
  label {
    color: #cbd5e1;
    font-weight: 600;
  }
  .form-control, select.form-select {
    background-color: rgba(58, 80, 104, 0.75);
    border: 1px solid #3a5068;
    color: #e0e6f8;
    border-radius: 0.5rem;
    transition: border-color 0.3s ease;
  }
  .form-control:focus, select.form-select:focus {
    background-color: rgba(58, 80, 104, 0.9);
    border-color: #ffd166;
    color: #fff;
    box-shadow: none;
  }
  button.btn-warning {
    background-color: #ffd166;
    color: #2b2d42;
    font-weight: 700;
    border-radius: 0.75rem;
    transition: background-color 0.3s ease;
  }
  button.btn-warning:hover {
    background-color: #e6b800;
  }
</style>
</head>
<body>

<div class="card">
  <h2>แก้ไขสินค้า</h2>
  <form method="POST" novalidate>
    <div class="mb-3">
      <label for="product_name" class="form-label">ชื่อสินค้า <span class="text-warning">*</span></label>
      <input id="product_name" name="product_name" type="text" class="form-control" value="<?= htmlspecialchars($product['product_name']) ?>" required />
    </div>
    <div class="mb-3">
      <label for="price" class="form-label">ราคา <span class="text-warning">*</span></label>
      <input id="price" name="price" type="number" step="0.01" class="form-control" value="<?= htmlspecialchars($product['price']) ?>" required />
    </div>
    <div class="mb-3">
      <label for="stock" class="form-label">จำนวนในสต๊อก <span class="text-warning">*</span></label>
      <input id="stock" name="stock" type="number" class="form-control" value="<?= htmlspecialchars($product['stock']) ?>" required />
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">หมวดหมู่ <span class="text-warning">*</span></label>
      <select id="category_id" name="category_id" class="form-select" required>
        <option value="">-- เลือกหมวดหมู่ --</option>
        <?php while($cat = $categories->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($cat['category_id']) ?>" <?= ($product['category_id'] == $cat['category_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat['category_name']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>
    <button type="submit" class="btn btn-warning w-100">บันทึกการเปลี่ยนแปลง</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
