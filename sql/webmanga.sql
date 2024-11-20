-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 20, 2024 lúc 06:22 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `webmanga`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `adminname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creat_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `adminname`, `password`, `email`, `name`, `creat_at`) VALUES
(1, 'Quan1', '$2y$10$upHobYfBhlRQUwuGiJnISOymXe92V8/yrl6DUAZdF0fEjYKp5Ms5G', 'quannro2k004@gmail.com', 'Fushiree1', '2024-11-18 17:56:44'),
(2, 'Quan2', '$2y$10$M.H4S6LVTLOYE0.9g1W7Q.xOSjoRucISoF5VR.p0fuLrTJ7GN518i', 'quannro2k0034@gmail.com', 'Fushiree1', '2024-11-18 17:58:36'),
(3, 'quan3', '$2y$10$PfP3o15IMBXBuGE9ig/w1eTYnBFegT3yEbiZUN1jlAw9NKOiecl4y', 'quannro2k343@gmail.com', 'Fushiree2', '2024-11-19 12:09:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `cartegory_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `cartegory_id`, `brand_name`) VALUES
(15, 41, 'Giảm giá 20%'),
(16, 41, 'Giảm giá 50%'),
(17, 41, 'Giảm giá 70%'),
(18, 30, 'Sounen'),
(19, 38, 'Sounen'),
(20, 37, 'Sounen'),
(21, 29, 'Sounen'),
(22, 38, 'Slice of life'),
(23, 37, 'Slice of life'),
(24, 30, 'Slice of life'),
(25, 29, 'Slice of life');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_cartegory`
--

CREATE TABLE `tbl_cartegory` (
  `cartegory_id` int(11) NOT NULL,
  `cartegory_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_cartegory`
--

INSERT INTO `tbl_cartegory` (`cartegory_id`, `cartegory_name`) VALUES
(29, 'Kim Đồng'),
(30, 'Ipm'),
(37, 'Trẻ'),
(38, 'Az'),
(41, 'Giảm giá');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_comments`
--

CREATE TABLE `tbl_comments` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_comments`
--

INSERT INTO `tbl_comments` (`id`, `product_id`, `user_id`, `name`, `comment`, `created_at`) VALUES
(1, 33, 5, 'Guest', 'asdfgnmwfg', '2024-11-20 04:40:18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `vat` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `email` varchar(255) NOT NULL,
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `customer_name`, `phone_number`, `city`, `district`, `address`, `total_price`, `vat`, `order_date`, `email`, `payment_method`) VALUES
(10, 5, 'Trần Khắc Quân', '0857410081', 'Trành phố Hồ Chí Minh', 'Bình thạnh', '4yrtyoupl;', 77000.00, 2000.00, '2024-11-20 04:51:33', '', 'Cash'),
(11, 5, 'Trần Khắc Quân', '0857410081', 'Trành phố Hồ Chí Minh', 'Bình thạnh', '\\kl', 77000.00, 2000.00, '2024-11-20 04:53:22', '', 'Cash'),
(12, 5, 'Trần Khắc Quân', '0857410081', 'Trành phố Hồ Chí Minh', 'Bình thạnh', 'rdfjgkhlj,.', 77000.00, 2000.00, '2024-11-20 05:12:42', '', ''),
(13, 5, 'Trần Khắc Quân', '0857410081', 'Trành phố Hồ Chí Minh', 'Bình thạnh', 'rdfjgkhlj,.', 77000.00, 2000.00, '2024-11-20 05:15:59', '', 'Cash');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_details`
--

CREATE TABLE `tbl_order_details` (
  `detail_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`detail_id`, `order_id`, `product_id`, `quantity`, `product_price`) VALUES
(10, 10, 33, 1, 0.00),
(11, 11, 68, 1, 0.00),
(12, 13, 69, 5, 0.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `cartegory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `product_price_new` decimal(10,2) DEFAULT NULL,
  `product_desc` text DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `cartegory_id`, `brand_id`, `product_price`, `product_price_new`, `product_desc`, `product_img`) VALUES
(32, 'Yotsuaba tập 1', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối!', 'yot1.jpg'),
(33, 'Yotsuaba tập 2', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot2.jpg'),
(34, 'Yotsuaba tập 3', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot3.jpg'),
(35, 'Yotsuaba tập 4', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot4.jpg'),
(36, 'Yotsuaba tập 5', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot5.jpg'),
(37, 'Yotsuaba tập 6', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot6.jpg'),
(38, 'Yotsuaba tập 7', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot7.jpg'),
(39, 'Yotsuaba tập 8', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot8.jpg'),
(40, 'Yotsuaba tập 9', 30, 24, 65000.00, 60000.00, 'Tên nhà cung cấp : IPM\r\nTác giả: Azuma Kiyohiko\r\nDịch giả : Tuyết Quỳnh\r\nNhà xuất bản : NXB Hồng Đức\r\nNăm xuất bản : 2024\r\nNgôn ngữ : Tiếng Việt\r\nThể loại: truyện tranh, đời thường, hài hước\r\nKhổ: 13 x 18 cm\r\nTrọng lượng : 300g\r\nSố trang: 228 trang\r\nHình thức : Bìa mềm\r\nGiới thiệu nội dung :\r\nCô bé kì quặc Yotsuba cùng bố chuyển đến nơi ở mới. Tại đây, cô bé gặp gỡ những hàngxóm mới, và khám phá biết bao điều mới lạ, lắm lúc gây ra những tình huống dở khóc dởcười khiến người xung quanh bối rối', 'yot9.jpg'),
(41, 'Poco ở thế giới Udon tập 1', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco1.jpg'),
(42, 'Poco ở thế giới Udon tập 2', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco2.jpg'),
(43, 'Poco ở thế giới Udon tập 3', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco3.jpg'),
(44, 'Poco ở thế giới Udon tập 4', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco4.jpg'),
(45, 'Poco ở thế giới Udon tập 5', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco5.jpg'),
(46, 'Poco ở thế giới Udon tập 6', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco6.jpg'),
(47, 'Poco ở thế giới Udon tập 7', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco7.jpg'),
(48, 'Poco ở thế giới Udon tập 8', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco8.jpg'),
(49, 'Poco ở thế giới Udon tập 9', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco9.jpg'),
(50, 'Poco ở thế giới Udon tập 10', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco10.jpg'),
(51, 'Poco ở thế giới Udon tập 11', 38, 22, 48000.00, 40000.00, 'Poco Ở Thế Giới Udon (Tập 12)\r\n\r\n\r\n\r\nTác giả	Nodoka Shinomaru\r\n\r\nDịch giả	Lyn Lê\r\n\r\nThể loại	Truyện tranh (manga), đời thường, hài hước\r\n\r\nKích thước	13 x 18 cm\r\n\r\nNhà xuất bản	NXB Thế Giới\r\n\r\nThương hiệu	Skycomics\r\n\r\nGiá bìa	58.000 VNĐ\r\n\r\nQuà tặng kèm 1 Postcard 2 mặt (Chỉ tặng kèm trong bản in đầu) (Quà kẹp trong sách)\r\n\r\nMã code 8935325020735\r\n\r\nMã ISBN	978-604-77-6611-6\r\n\r\nLoại bìa	Bìa mềm, bìa gập\r\n\r\nSố trang	192 trang\r\n\r\nPhát hành: 4/06/2024\r\n\r\n\r\n\r\n* * *\r\n\r\nGiới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco11.jpg'),
(52, 'Poco ở thế giới Udon tập 12', 38, 22, 48000.00, 40000.00, 'Giới thiệu sách:\r\n\r\n\r\n\r\nPoco ở thế giới Udon 12 - Ý nghĩa của cuộc gặp gỡ\r\n\r\n\r\n\r\nTrở về quê hương Kagawa để chịu tang người cha vừa qua đời, Tawara Souta vô tình bắt gặp chú chồn lửng biến hình Poco tại tiệm mì Udon đã đóng cửa của gia đình. Sau cuộc gặp gỡ định mệnh ấy, Souta đã tìm lại được tình yêu với quê hương và bắt đầu cuộc sống mới cùng Poco ở Kagawa. Thế nhưng, những ngày tháng bình yên của họ rồi cũng sẽ phải kết thúc…\r\n\r\n\r\n\r\nỞ tập trước, Souta đã vô cùng bàng hoàng sau khi nghe Sae nói rằng  “Một khi cạn kiệt sức mạnh, Poco sẽ không bao giờ có thể biến trở lại thành người được nữa. Cậu nhóc cũng sẽ mất hết ký ức về quãng thời gian làm người…” Cùng lúc đó, anh nhận được tin từ Hiroshi và mọi người là Poco đã mất tích! Cả nhóm cùng đi tìm kiếm cậu bé, thế nhưng Poco lúc này đã không thể hoàn toàn quay trở lại hình dạng con người được nữa. Mặt khác, bức ảnh bị chụp lại của Poco ở hình dáng chồn lửng đang bị lan truyền trên mạng xã hội.\r\n\r\n\r\n\r\nLiệu Souta và Poco có thể vượt qua mối nguy này hay không? Làm thế nào Souta mới có thể giữ được lời hứa sống cùng Poco mãi mãi? Và ý nghĩa thật sự đằng sau cuộc gặp gỡ định mệnh giữa họ là gì?\r\n\r\n\r\n\r\nMời các bạn đón đọc tập cuối cùng của “Poco ở thế giới Udon” - câu chuyện kỳ ảo, ấm áp về cuộc sống của chú chồn lửng biến hình Poco tại Kagawa thư thả và dịu dàng!', 'poco12.jpg'),
(53, 'Quán rượu dị giới “Nobu” - Tập 1', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu1.jpg'),
(54, 'Quán rượu dị giới “Nobu” - Tập 2', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu2.jpg'),
(55, 'Quán rượu dị giới “Nobu” - Tập 3', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu3.jpg'),
(56, 'Quán rượu dị giới “Nobu” - Tập 4', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu4.jpg'),
(57, 'Quán rượu dị giới “Nobu” - Tập 5', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu5.jpg'),
(58, 'Quán rượu dị giới “Nobu” - Tập 6', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu6.jpg'),
(59, 'Quán rượu dị giới “Nobu” - Tập 7', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu7.jpg'),
(60, 'Quán rượu dị giới “Nobu” - Tập 8', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu8.jpg'),
(61, 'Quán rượu dị giới “Nobu” - Tập 9', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu9.jpg'),
(62, 'Quán rượu dị giới “Nobu” - Tập 10', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu10.jpg'),
(63, 'Quán rượu dị giới “Nobu” - Tập 11', 37, 23, 40000.00, 40000.00, 'Tại đất nước trung cổ Aitheria có một quán rượu mang tên Nobu. Quán rượu này vốn là quán ăn ở một góc phố Nhật Bản, nhưng chẳng hiểu sao cửa chính của quán lại kết nối với Thành cổ Aitheria. Anh vệ binh lười biếng, cô tiểu thư đỏng đảnh, người thu thuế khó ở,… những người dân bản địa nơi dị giới lần lượt bị hấp dẫn khi thưởng thức các món ăn Nhật truyền thống độc lạ. Quán rượu dị giới với món ngon vật lạ chính thức mở cửa!', 'nobu11.jpg'),
(64, 'Nina Ở Thị Trấn Cao Nguyên - Tập 1', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina1.jpg'),
(65, 'Nina Ở Thị Trấn Cao Nguyên - Tập 2', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina2.jpg'),
(66, 'Nina Ở Thị Trấn Cao Nguyên - Tập 3', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina3.jpg'),
(67, 'Nina Ở Thị Trấn Cao Nguyên - Tập 4', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina4.jpg'),
(68, 'Nina Ở Thị Trấn Cao Nguyên - Tập 5', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina5.jpg'),
(69, 'Nina Ở Thị Trấn Cao Nguyên - Tập 6', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina6.jpg'),
(70, 'Nina Ở Thị Trấn Cao Nguyên - Tập 7', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina7.jpg'),
(71, 'Nina Ở Thị Trấn Cao Nguyên - Tập 8', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina8.jpg'),
(72, 'Nina Ở Thị Trấn Cao Nguyên - Tập 9', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina9.jpg'),
(73, 'Nina Ở Thị Trấn Cao Nguyên - Tập 10', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina10.jpg'),
(77, 'Nina Ở Thị Trấn Cao Nguyên - Tập 11', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina11.jpg'),
(78, 'Nina Ở Thị Trấn Cao Nguyên - Tập 12', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina12.jpg'),
(79, 'Nina Ở Thị Trấn Cao Nguyên - Tập 13', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina13.jpg'),
(80, 'Nina Ở Thị Trấn Cao Nguyên - Tập 14', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina14.jpg'),
(81, 'Nina Ở Thị Trấn Cao Nguyên - Tập 15', 29, 25, 38000.00, 30000.00, 'Nina - cô cháu gái mắt xanh với mái tóc bạch kim xinh đẹp hiện đang sống cùng Shutaro - ông cậu vừa phải về quê sau khi mất việc ở Tokyo. Vốn “cuồng” Nhật Bản, mắt cô bé sáng rỡ trước biết bao phong tục mùa hè tại quê ngoại. Shutaro cũng đã có khoảng thời gian gắn bó với mọi người xung quanh. Ngày tháng thong thả dần trôi nơi thị trấn cao nguyên, mùa hè của họ dần khép lại…', 'nina15.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product_img_desc`
--

CREATE TABLE `tbl_product_img_desc` (
  `product_id` int(11) NOT NULL,
  `product_img_desc` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product_img_desc`
--

INSERT INTO `tbl_product_img_desc` (`product_id`, `product_img_desc`) VALUES
(7, 'Screenshot 2024-11-01 095428.png'),
(7, 'Screenshot 2024-11-03 145756.png'),
(7, 'Screenshot 2024-11-05 131018.png'),
(7, 'Screenshot 2024-11-05 212642.png'),
(7, 'Screenshot 2024-11-05 212705.png'),
(7, 'Screenshot 2024-11-05 212802.png'),
(8, 'Screenshot 2024-11-01 095428.png'),
(8, 'Screenshot 2024-11-03 145756.png'),
(8, 'Screenshot 2024-11-05 131018.png'),
(15, 'anh mo ta 1.jpg'),
(15, 'anh mo ta 2.png'),
(15, 'anh mo ta 3.png'),
(16, 'anh mo ta 1.jpg'),
(16, 'anh mo ta 2.png'),
(16, 'anh mo ta 3.png'),
(18, 'Screenshot 2024-11-05 212842.png'),
(19, 'Screenshot 2024-11-05 212842.png'),
(20, 'Screenshot 2024-11-05 212842.png'),
(22, 'Screenshot 2024-11-05 212842.png'),
(23, 'Screenshot 2024-11-05 212802.png'),
(24, 'anh dai dien.png'),
(25, 'anh dai dien.png'),
(26, 'anh mo ta 1.jpg'),
(27, 'IMG_20241117_173509.jpg'),
(27, 'IMG_20241117_173526.jpg'),
(27, 'IMG_20241117_173536.jpg'),
(28, 'IMG_20241117_173526.jpg'),
(29, 'IMG_20241117_173526.jpg'),
(30, 'IMG_20241118_100756.jpg'),
(31, 'yot1mota.jpg'),
(31, 'yot1mota1.jpg'),
(32, 'yot1.jpg'),
(32, 'yot1mota.jpg'),
(32, 'yot1mota1.jpg'),
(33, 'yot2.jpg'),
(33, 'yot2mota.jpg'),
(33, 'yot2mota1.jpg'),
(34, 'yot3.jpg'),
(34, 'yot3mota.jpg'),
(34, 'yot3mota1.jpg'),
(35, 'yot4.jpg'),
(35, 'yot4mata1.jpg'),
(35, 'yot4mota.jpg'),
(36, 'yot5.jpg'),
(37, 'yot6.jpg'),
(38, 'yot7.jpg'),
(38, 'yot7mota.jpg'),
(39, 'yot8.jpg'),
(40, 'yot9.jpg'),
(41, 'poco1.jpg'),
(41, 'poco1mota.jpg'),
(42, 'poco2.jpg'),
(43, 'poco3.jpg'),
(44, 'poco4.jpg'),
(45, 'poco5.jpg'),
(45, 'poco5mota.jpg'),
(46, 'poco6.jpg'),
(46, 'poco6mota.jpg'),
(47, 'poco7.jpg'),
(47, 'poco7mota.jpg'),
(48, 'poco8mota.jpg'),
(48, 'poco8.jpg'),
(49, 'poco9.jpg'),
(49, 'poco9mota.jpg'),
(49, 'poco9mota1.jpg'),
(50, 'poco10.jpg'),
(50, 'poco10mota.jpg'),
(51, 'poco11.jpg'),
(51, 'poco11mota.jpg'),
(52, 'poco12.jpg'),
(52, 'poco12mota.jpg'),
(53, 'nobu1.jpg'),
(54, 'nobu2.jpg'),
(55, 'nobu3.jpg'),
(56, 'nobu4.jpg'),
(57, 'nobu5.jpg'),
(58, 'nobu6.jpg'),
(59, 'nobu7.jpg'),
(60, 'nobu8.jpg'),
(60, 'nobu8mota.jpg'),
(61, 'nobu9.jpg'),
(62, 'nobu10.jpg'),
(63, 'nobu11.jpg'),
(63, 'nobu11mota.jpg'),
(64, 'nina1.jpg'),
(65, 'nina2.jpg'),
(66, 'nina3.jpg'),
(67, 'nina4.jpg'),
(68, 'nina5.jpg'),
(69, 'nina6.jpg'),
(70, 'nina7.jpg'),
(71, 'nina8.jpg'),
(72, 'nina9.jpg'),
(73, 'nina10.jpg'),
(74, 'nina11.jpg'),
(75, 'nina12.jpg'),
(76, 'nina13.jpg'),
(77, 'nina11.jpg'),
(78, 'nina12.jpg'),
(79, 'nina13.jpg'),
(80, 'nina14.jpg'),
(81, 'nina15.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `email`, `name`, `created_at`) VALUES
(5, 'Quan', '$2y$10$i5Tvk2RpvOtoH0QAZn4XVOdcfJ0MuGUGt8dOZhgSsT4appSZ/DuoG', 'quannro2k0034@gmail.com', 'Fushiree1', '2024-11-19 07:22:28'),
(6, 'Quan2', '$2y$10$S.keQpOpELl0Rjvqpn7iYu01AVk4RE5YWzmW4xQFEq4yZSMhs3pJK', 'quannro2k34@gmail.com', 'Fushiree1', '2024-11-19 08:26:45');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Chỉ mục cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  ADD PRIMARY KEY (`cartegory_id`);

--
-- Chỉ mục cho bảng `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Chỉ mục cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `tbl_cartegory`
--
ALTER TABLE `tbl_cartegory`
  MODIFY `cartegory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT cho bảng `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);

--
-- Các ràng buộc cho bảng `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `tbl_comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`),
  ADD CONSTRAINT `tbl_comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Các ràng buộc cho bảng `tbl_order_details`
--
ALTER TABLE `tbl_order_details`
  ADD CONSTRAINT `tbl_order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `tbl_order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
