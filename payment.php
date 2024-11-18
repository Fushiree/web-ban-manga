<?php
session_start();
include 'connect.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "Vui lòng đăng nhập để thực hiện thanh toán.";
    exit();
}

// Kiểm tra nếu đơn hàng tồn tại
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;

if ($order_id === 0) {
    echo "Không tìm thấy đơn hàng hợp lệ.";
    exit();
}

// Lấy thông tin đơn hàng từ cơ sở dữ liệu
$order_query = "
    SELECT o.order_id, 
           o.user_id, 
           o.customer_name, 
           o.phone_number, 
           o.city, 
           o.district, 
           o.address, 
           o.total_price, 
           o.vat, 
           o.order_date, 
           u.email, 
           od.quantity, 
           p.product_name, 
           o.payment_method 
    FROM tbl_order o 
    JOIN tbl_user u ON o.user_id = u.user_id 
    JOIN tbl_order_details od ON o.order_id = od.order_id 
    JOIN tbl_product p ON od.product_id = p.product_id 
    WHERE o.order_id = $order_id AND o.user_id = " . intval($_SESSION['user_id']);

$order_result = mysqli_query($link, $order_query);

// Kiểm tra nếu truy vấn thành công và có kết quả
if (!$order_result || mysqli_num_rows($order_result) === 0) {
    echo "Không tìm thấy thông tin đơn hàng.";
    exit();
}

$order = mysqli_fetch_assoc($order_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Menu -->
    <?php 
    include "product-head.php";
    ?>
    <!-- End Menu -->

    <!-- Payment Section -->
    <div class="container" style="margin-top: 100px;>
        <div class="payment-top-wrap">
            <div class="payment-top">
                <div class="payment-top-cart payment-top-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="payment-top-address payment-top-item">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="payment-top-payment payment-top-item">
                    <i class="fa-solid fa-money-check"></i>
                </div>
            </div>
        </div>
    </div>
    <section class="payment">
        <div class="container">
            <h1 class="mt-5">Thông tin thanh toán</h1>
            <div class="payment-content">
                <div class="payment-content-left">
                    <h4>Thông tin giao hàng</h4>
                    <p>Tên khách hàng: <?= htmlspecialchars($order['customer_name']); ?></p>
                    <p>Email: <?= htmlspecialchars($order['email']); ?></p>
                    <p>Địa chỉ: <?= htmlspecialchars($order['address']); ?></p>
                </div>
                <div class="payment-content-right">
                    <h4>Chi tiết đơn hàng</h4>
                    <p>Sản phẩm: <?= htmlspecialchars($order['product_name']); ?></p>
                    <p>Số lượng: <?= htmlspecialchars($order['quantity']); ?></p>
                    <p>Phương thức thanh toán:</p>
                    <form method="POST" action="confirmation.php?order_id=<?= $order_id; ?>">
                        <div>
                            <input type="radio" id="payment_cash" name="payment_method" value="Cash" required>
                            <label for="payment_cash">Thanh toán khi nhận hàng (COD)</label>
                        </div>
                        <div>
                            <input type="radio" id="payment_card" name="payment_method" value="Card" required>
                            <label for="payment_card">Thẻ tín dụng / Thẻ ghi nợ</label>
                        </div>
                        <div>
                            <input type="radio" id="payment_paypal" name="payment_method" value="Paypal" required>
                            <label for="payment_paypal">Paypal</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Payment Section -->

    <!-- App Container -->
    <section class="app-container">
        <p>Tải ứng dụng</p>
        <div class="app-google">
            <img src="/picture/app/appstore.png">
            <img src="/picture/app/ggplay.png">
        </div>
        <p>Nhận tin từ chúng tôi</p>
        <input type="text" placeholder="Nhập Email của bạn...">
    </section>
    <!-- End App Container -->

    <!-- Footer -->
    <div class="footer-top">
        <li><a href="">Liên hệ</a></li>
        <li><a href="">Tuyển dụng</a></li>
        <li><a href="">Giới thiệu</a></li>
        <li>
            <a href=""><i class="fa-brands fa-facebook"></i></a>
            <a href=""><i class="fa-brands fa-youtube"></i></a>
            <a href=""><i class="fa-brands fa-x-twitter"></i></a>
        </li>
    </div>
    <!-- End Footer -->

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/main.js"></script>
</body>
<script>
    const header = document.querySelector("header")
    window.addEventListener("scroll",function(){
        x = window.pageYOffset
        if(x>0){
            header.classList.add("sticky")
        }
        else{
            header.classList.remove("sticky")
        }
    })
</script>
</html>
