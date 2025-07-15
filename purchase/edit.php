<?php include('../db.php'); ?>
<?php
$id = $_GET['id'];
$purchase = $conn->query("SELECT * FROM purchase WHERE purchase_id = $id")->fetch_assoc();
$customers = $conn->query("SELECT * FROM customer");
$products = $conn->query("SELECT * FROM product");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $product_result = $conn->query("SELECT price FROM product WHERE product_id = $product_id");
    $product = $product_result->fetch_assoc();
    $total_price = $product['price'] * $quantity;

    $stmt = $conn->prepare("UPDATE purchase SET customer_id=?, product_id=?, quantity=?, total_price=? WHERE purchase_id=?");
    $stmt->bind_param("iiidi", $_POST['customer_id'], $product_id, $quantity, $total_price, $id);
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
<title>แก้ไขรายการสั่งซื้อ - PHP CRUD</title>
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
  select.form-select, input.form-control {
    background-color: rgba(58, 80, 104, 0.75);
    border: 1px solid #3a5068;
    color: #e0e6f8;
    border-radius: 0.5rem;
    transition: border-color 0.3s ease;
  }
  select.form-select:focus, input.form-control:focus {
    background-color: rgba(58, 80, 104, 0.9);
    border-color: #ffd166;
    color: #fff;
    box-shadow: none;
  }
  #totalPrice {
    background-color: rgba(58, 80, 104, 0.5);
    border: none;
    color: #ffd166;
    font-weight: 700;
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
  <h2>แก้ไขรายการสั่งซื้อ</h2>
  <form method="POST" novalidate>
    <div class="mb-3">
      <label for="customer_id" class="form-label">ลูกค้า <span class="text-warning">*</span></label>
      <select id="customer_id" name="customer_id" class="form-select" required>
        <option value="">-- เลือกลูกค้า --</option>
        <?php while($c = $customers->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($c['customer_id']) ?>" <?= ($c['customer_id'] == $purchase['customer_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($c['firstname'] . ' ' . $c['lastname']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="product_id" class="form-label">สินค้า <span class="text-warning">*</span></label>
      <select id="product_id" name="product_id" class="form-select" required>
        <option value="">-- เลือกสินค้า --</option>
        <?php while($p = $products->fetch_assoc()): ?>
          <option value="<?= htmlspecialchars($p['product_id']) ?>" data-price="<?= htmlspecialchars($p['price']) ?>" <?= ($p['product_id'] == $purchase['product_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['product_name']) ?>
          </option>
        <?php endwhile; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="quantity" class="form-label">จำนวน <span class="text-warning">*</span></label>
      <input id="quantity" name="quantity" type="number" min="1" class="form-control" value="<?= htmlspecialchars($purchase['quantity']) ?>" required />
    </div>

    <div class="mb-3">
      <label class="form-label">ราคารวม</label>
      <input type="text" id="totalPrice" class="form-control" readonly value="0.00 บาท" />
    </div>

    <button type="submit" class="btn btn-warning w-100">บันทึกการเปลี่ยนแปลง</button>
  </form>
</div>

<script>
  const productSelect = document.getElementById('product_id');
  const quantityInput = document.getElementById('quantity');
  const totalPrice = document.getElementById('totalPrice');

  function updateTotal() {
    const selectedOption = productSelect.options[productSelect.selectedIndex];
    const price = parseFloat(selectedOption?.getAttribute('data-price')) || 0;
    const quantity = parseInt(quantityInput.value) || 0;
    const total = price * quantity;
    totalPrice.value = total.toFixed(2) + ' บาท';
  }

  productSelect.addEventListener('change', updateTotal);
  quantityInput.addEventListener('input', updateTotal);

  // คำนวณครั้งแรกตอนโหลดหน้า
  updateTotal();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
