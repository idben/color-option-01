<?php
require_once("./connect.php");
require_once("./function.php");
try {
  $stmt = $pdo->prepare("INSERT INTO c_product (name) VALUES (?)");
  $stmt->execute([$_POST['name']]);
  $productId = $pdo->lastInsertId();

  if($_POST['colors'] != ""){
    $colors = explode(',', $_POST['colors']);
    $stmt = $pdo->prepare("INSERT INTO c_product_color (product_id, color) VALUES (?, ?)");
    foreach ($colors as $color) {
      $stmt->execute([$productId, trim($color)]);
    }
  }

  alertAndGoTo("新增成功", "./");
} catch (PDOException $e) {
  echo "資料庫操作失敗：" . $e->getMessage();
}