<?php
require_once("./connect.php");
require_once("./function.php");
try {
  $stmt = $pdo->prepare("UPDATE c_product SET name = ? WHERE id = ?");
  $stmt->execute([$_POST['name'], $_POST['id']]);
  $colorIds = $_POST['colorid'];
  $colors = $_POST['color'];
  $stocks = $_POST['stock'];
  $stmt = $pdo->prepare("UPDATE c_product_color SET color = ?, stock = ? WHERE id = ?");
  foreach ($colorIds as $index => $colorId) {
    $color = $colors[$index];
    $stock = $stocks[$index];
    $stmt->execute([$color, $stock, $colorId]);
  }
  alertAndGoTo("更新成功", "./");
} catch (PDOException $e) {
  echo "資料庫操作失敗：" . $e->getMessage();
}
?>