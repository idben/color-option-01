-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 08 月 21 日 18:20
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `tea`
--

-- --------------------------------------------------------

--
-- 資料表結構 `c_product_color`
--

CREATE TABLE `c_product_color` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `color` varchar(100) NOT NULL,
  `stock` int(10) NOT NULL DEFAULT 0,
  `vaild` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `c_product_color`
--

INSERT INTO `c_product_color` (`id`, `product_id`, `color`, `stock`, `vaild`) VALUES
(1, 1, 'A紅', 11, 1),
(2, 1, 'A黃', 15, 1),
(3, 1, 'A紫', 12, 1),
(4, 2, 'B紅', 22, 1),
(5, 2, 'B橙', 0, 1),
(6, 2, 'B黃', 25, 1),
(7, 2, 'B紫', 29, 1),
(8, 3, 'C紅', 5, 1),
(9, 3, 'C橙', 6, 1),
(10, 3, 'C黃', 7, 1),
(11, 3, 'C綠', 6, 1),
(12, 3, 'C靛', 5, 1),
(13, 3, 'C藍', 4, 1),
(14, 3, 'C紫', 100, 1),
(15, 4, '眼影A紅1', 100, 1),
(16, 4, '眼影A紅2', 102, 1),
(17, 4, '眼影A紅3', 105, 1);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `c_product_color`
--
ALTER TABLE `c_product_color`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `c_product_color`
--
ALTER TABLE `c_product_color`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
