<?php
require_once("./connect.php");
try {
  // $sql = "SELECT * FROM c_product";
  $sql = "
    SELECT 
      p.*, 
      pc.color, 
      pc.stock
    FROM 
      c_product p
    JOIN 
      c_product_color pc 
    ON 
      p.id = pc.product_id;
  ";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "資料庫連接失敗: " . $e->getMessage();
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    .unit{
      .num{
        width: 80px;
      }
      .ctrl{
        width: 120px;
      }
      .color{
        width: 100px;
      }
      .stock{
        width: 50px;
      }
    }
    .flex1{
      flex: 1;
    }
  </style>
  <title>產品列表</title>
</head>
<body>
  <div class="container mt-3">
    <h1>產品列表</h1>
    <div class="d-flex">
      <a href="./" class="btn btn-primary btn-sm ms-auto">另一種列表</a>
      <a href="./add.html" class="btn btn-primary btn-sm ms-1">增加</a>
    </div>
    <div class="unit d-flex text-bg-dark p-1 my-1">
      <div class="num">#</div>
      <div class="title flex1">產品名稱</div>
      <div class="color">顏色</div>
      <div class="stock text-center">庫存</div>
      <div class="ctrl text-end">管理</div>
    </div>
    <?php foreach ($products as $index => $product): ?>
    <div class="unit d-flex mb-1">
      <div class="num"><?=$index+1?></div>
      <div class="title flex1"><?=$product["name"]?></div>
      <div class="color"><?=$product['color']?></div>
      <div class="stock text-center"><?=$product['stock']?></div>
      <div class="ctrl text-end">
        <a href="doDelete.php?id=<?=$product["id"]?>" class="btn btn-danger btn-sm me-1">刪除</a>
        <a href="update.php?id=<?=$product["id"]?>" class="btn btn-primary btn-sm">修改</a>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</body>
</html>