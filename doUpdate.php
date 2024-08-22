<?php
require_once("./connect.php");
require_once("./function.php");

// echo "<pre>";
// var_dump($_POST["color-add"]);
// echo "</pre>";
// echo "<pre>";
// var_dump($_POST["stock-add"]);
// echo "</pre>";
// exit;
try {
  $productId = $_POST['id'];
  $stmt = $pdo->prepare("UPDATE c_product SET name = ? WHERE id = ?");
  $stmt->execute([$_POST['name'], $productId]);
  if(isset($_POST['colorid'])){
    $colorIds = $_POST['colorid'];
    $colors = $_POST['color'];
    $stocks = $_POST['stock'];
    $valids = $_POST['valid'];
    $stmt = $pdo->prepare("UPDATE c_product_color SET color = ?, stock = ?, vaild = ? WHERE id = ?");
    foreach ($colorIds as $index => $colorId) {
      $color = $colors[$index];
      $stock = $stocks[$index];
      $valid = $valids[$index];
      $stmt->execute([$color, $stock, $valid, $colorId]);
    }
  }
  if(isset($_POST["color-add"])){
    $colorAdd = $_POST["color-add"];
    $stockAdd = $_POST["stock-add"];
    if(count($_POST["color-add"]) > 0){
      $stmt = $pdo->prepare("INSERT INTO c_product_color (product_id, color, stock) VALUES (?, ?, ?)");
      foreach ($colorAdd as $index => $colorID) {
        $stock = $stockAdd[$index];
        $stmt->execute([$productId, trim($colorID), $stock]);
      }
    }
  }

  alertAndGoTo("更新成功", "./");
} catch (PDOException $e) {
  echo "資料庫操作失敗：" . $e->getMessage();
}
?>