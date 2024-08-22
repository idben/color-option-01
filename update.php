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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    .flex1{
      flex: 1;
    }
    .pointer-events-none{
      pointer-events: none;
    }
  </style>
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
      <div class="border rounded-2 px-1 pt-1 mb-1 d-flex align-items-center">
        <div class="color-group flex1">
          <?php if(count($productColors) == 0): ?>
            <div class="no-color-tip">
              沒有顏色清單
            </div>
          <?php endif; ?>
          <?php foreach($productColors as $color): ?>
          <div class="input-group mb-1 color-container">
            <span class="input-group-text">顏色</span>
            <input type="hidden" name="colorid[]" value="<?=$color["id"]?>">
            <input name="color[]" type="text" class="form-control" value="<?=$color["color"]?>">
            <span class="input-group-text">庫存</span>
            <input name="stock[]" type="text" class="form-control" value="<?=$color["stock"]?>">
            <input type="hidden" class="valid" name="valid[]" value="<?=$color["vaild"]?>">
            <div class="btn <?=$color["vaild"]==1?"btn-success":"btn-danger"?> btn-valid" value="<?=$color["vaild"]?>">
              <?=$color["vaild"]==1?"<i class=\"fa-solid fa-toggle-on pointer-events-none\"></i>":"<i class=\"fa-solid fa-toggle-off pointer-events-none\"></i>"?>
            </div>
          </div>
          <?php endforeach;?>
        </div>
        <div class="btn btn-primary btn-add-color mb-1 ms-1 align-self-end">
          <i class="fa-solid fa-plus"></i>
        </div>
      </div>
      <input type="hidden" name="colors">
      <div class="d-flex mb-1">
        <button class="btn btn-primary ms-auto me-1 btn-send">送出修改</button>
        <a href="./" class="btn btn-warning btn-send">取消</a>
      </div>
    </form>
  </div>
  <template id="color1">
    <div class="input-group mb-1 color-container">
      <span class="input-group-text">顏色</span>
      <input type="hidden" name="id-add[]" value="null">
      <input name="color-add[]" type="text" class="form-control">
      <span class="input-group-text">庫存</span>
      <input name="stock-add[]" type="text" class="form-control" value="0">
      <div class="btn btn-danger btn-remove-color">
        <i class="fa-solid fa-minus pointer-events-none"></i>
      </div>
    </div>
  </template>
  <script>
    const btnAddColor = document.querySelector(".btn-add-color");
    const divColorGroup = document.querySelector(".color-group");
    const templateColor = document.querySelector("#color1");

    btnAddColor.addEventListener("click", function(){
      const noColorTip = document.querySelector(".no-color-tip");
      if(noColorTip) noColorTip.remove();
      const clone = templateColor.content.cloneNode(true);
      divColorGroup.append(clone);
    });

    divColorGroup.addEventListener("click", function(e){
      if(e.target.classList.contains("btn-remove-color")){
        e.target.closest(".color-container").remove();
      }else if(e.target.classList.contains("btn-valid")){
        let value = parseInt(e.target.closest(".color-container").querySelector(".valid").value);
        value = value === 0 ? 1 : 0;
        e.target.closest(".color-container").querySelector(".valid").value = value;
        e.target.classList.remove("btn-danger");
        e.target.classList.remove("btn-success");
        if(value === 1){
          e.target.classList.add("btn-success");
          e.target.innerHTML = "<i class=\"fa-solid fa-toggle-on pointer-events-none\"></i>";
        }else{
          e.target.classList.add("btn-danger");
          e.target.innerHTML = "<i class=\"fa-solid fa-toggle-off pointer-events-none\"></i>";
        }
      }
    });
  </script>
</body>
</html>