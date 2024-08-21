# 增加產品時並立即增加對應的顏色

這個專案展示在增加一個產品時，立即增加對應的顏色選項。產品增加時是會寫入`product`資料表，取得新增的 id 後再把顏色選項加在`product_color`這個表中。`product_color`這個表中並帶著庫存記錄。

增加顏色的功能著重在 javaScript 的操作，然後送出欄位資料到對應的 php 中寫入。主要是在`add.html`這支檔案中。 

修改頁中則是著重在送出陣列型態的資料，讓對應的 php 去更新`product_color`這個表中的資料。

## 專案結構

- `index.php`: 主頁面，列表頁，連結到新增與修改頁。
- `index2.php`: 另一種型態的主頁，把各個產品的各個顏色當做一則產品列出，目前也是與 index.php 一樣連結到同樣修改頁。
- `add.html`: 增加資料用表單。
- `update.php`: 修改資料用表單。
- `doAdd.php`: 新增到資料庫內的主程式。
- `doUpdate.php`: 修改到資料庫的主程式。
- `data`: 操作對應的資料表與一些假資料。

## 展示頁面
- [展示頁面](https://sagedaben.com/iSpan/php/color_option_01/index.php).