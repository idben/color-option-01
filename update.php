<?php
require_once("./connect.php");

try {
  if(!isset($_GET['id'])){
    die("無產品ID");
  }
  $productId = (int)$_GET['id'];

  $stmt = $pdo->prepare("SELECT * FROM c_product WHERE id = ?");
  $stmt->execute([$productId]);
  $product = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($product) {
    $stmt = $pdo->prepare("SELECT * FROM c_product_color WHERE product_id = ?");
    $stmt->execute([$productId]);
    $productColors = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
} catch (PDOException $e) {
  echo "資料庫操作失敗：" . $e->getMessage();
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <title>產品修改表單</title>
</head>
<body>
  <div class="container mt-3">
    <form action="./doUpdate.php" method="post">
      <div class="input-group mb-1">
        <span class="input-group-text">品名</span>
        <input type="text" name="name" class="form-control" value="<?=$product["name"]?>">
        <input type="hidden" name="id" value="<?=$product["id"]?>">
      </div>
      <?php foreach($productColors as $color): ?>
      <div class="input-group mb-1">
        <span class="input-group-text">顏色</span>
        <input type="hidden" name="colorid[]" value="<?=$color["id"]?>">
        <input name="color[]" type="text" class="form-control" value="<?=$color["color"]?>">
        <span class="input-group-text">庫存</span>
        <input name="stock[]" type="text" class="form-control" value="<?=$color["stock"]?>">
      </div>
      <?php endforeach;?>
      <input type="hidden" name="colors">
      <div class="d-flex mb-1">
        <button class="btn btn-primary ms-auto me-1 btn-send">送出修改</button>
        <a href="./" class="btn btn-warning btn-send">取消</a>
      </div>
    </form>
  </div>
  <script>

  </script>
</body>
</html>