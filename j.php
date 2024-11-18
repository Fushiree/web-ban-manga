<?php
$servername = "localhost";  // Thay bằng tên máy chủ của bạn
$username = "root";         // Thay bằng tên người dùng của bạn
$password = "";             // Thay bằng mật khẩu của bạn
$dbname = "webmanga";  // Thay bằng tên cơ sở dữ liệu của bạn

// Kết nối với MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Truy vấn dữ liệu từ bảng tbl_product
$sql = "SELECT product_name, product_price, product_img FROM tbl_product";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <!-- Menu và phần còn lại của trang bạn đã cung cấp ở trên -->

    <!-- sản phẩm -->
    <section class="cartegory-right">
        <div class="cartegory-right-top">
            <div class="cartegory-right-top-item">
                <p>Hàng mới về</p>
            </div>
            <div class="cartegory-right-top-item">
                <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
            </div>
            <div class="cartegory-right-top-item">
                <select name="" id="">
                    <option value="">Sắp xếp</option>
                    <option value="">Giá cao đến thấp</option>
                    <option value="">Giá thấp đến cao</option>
                </select>
            </div>
        </div>

        <div class="category-right-content">
            <?php
            if ($result->num_rows > 0) {
                // Lặp qua từng sản phẩm và hiển thị
                while($row = $result->fetch_assoc()) {
                    echo '<div class="category-right-content-item">';
                    echo '<a href="/product.html">';
                    echo '<img src="/picture/sanpham/' . $row["product_img"] . '" alt="Product Image">';
                    echo '<h1>' . $row["product_name"] . '</h1>';
                    echo '<p>' . number_format($row["product_price"], 0, ',', '.') . '<sup>đ</sup></p>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>Không có sản phẩm nào.</p>";
            }
            $conn->close();
            ?>
        </div>

        <div class="category-right-bottom">
            <div class="category-right-bottom-items" style="flex: 2;margin-top: 10px;">
                <p>Hiển thị 2 <span>|</span> 4 sản phẩm</p>
            </div>
            <div class="category-right-bottom-items" style="margin-top: 10px;">
                <p><span>&#60;</span> 1 2 3 4 5 <span>&#62;</span>Trang cuối</p>
            </div>
        </div>
    </section>
    <!-- end sản phẩm -->

    <!-- Footer và phần còn lại của trang bạn đã cung cấp ở trên -->

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>
