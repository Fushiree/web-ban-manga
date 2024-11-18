<?php
// Kết nối cơ sở dữ liệu
include("connect.php");
session_start();

// Kiểm tra xem người dùng đã đăng nhập chưa
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
if (!$user_id) {
    header("Location: login.php");
    exit();
}

// Xử lý form thanh toán
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = mysqli_real_escape_string($link, $_POST['customer_name']);
    $phone_number = mysqli_real_escape_string($link, $_POST['phone_number']);
    $city = mysqli_real_escape_string($link, $_POST['city']);
    $district = mysqli_real_escape_string($link, $_POST['district']);
    $address = mysqli_real_escape_string($link, $_POST['address']);
    $total_price = floatval($_POST['total_price']);
    $vat = floatval($_POST['vat']);

    // Lưu thông tin đơn hàng
    $order_sql = "INSERT INTO tbl_order (user_id, customer_name, phone_number, city, district, address, total_price, vat)
                  VALUES ($user_id, '$customer_name', '$phone_number', '$city', '$district', '$address', $total_price, $vat)";
    if (mysqli_query($link, $order_sql)) {
        $order_id = mysqli_insert_id($link);

        // Lấy thông tin sản phẩm từ giỏ hàng
        $cart_sql = "SELECT * FROM tbl_cart WHERE user_id = $user_id";
        $cart_result = mysqli_query($link, $cart_sql);

        while ($row = mysqli_fetch_assoc($cart_result)) {
            $product_id = $row['product_id'];
            $quantity = $row['quantity'];
            $price = $row['quantity'] * $row['product_price'];

            // Lưu chi tiết đơn hàng
            $detail_sql = "INSERT INTO tbl_order_details (order_id, product_id, quantity, price)
                           VALUES ($order_id, $product_id, $quantity, $price)";
            mysqli_query($link, $detail_sql);
        }

        // Xóa giỏ hàng
        $delete_cart_sql = "DELETE FROM tbl_cart WHERE user_id = $user_id";
        mysqli_query($link, $delete_cart_sql);

        // Điều hướng về trang xác nhận
        header("Location: payment.php?order_id=$order_id");
        exit();
    } else {
        $error_message = "Đã xảy ra lỗi khi xử lý đơn hàng. Vui lòng thử lại.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <?php 
    include("product-head.php");
    ?>
    <!-- Checkout Section -->
    <div class="container" style="margin-top: 100px;">
        <div class="delivery-top-wrap">
            <div class="delivery-top">
                <div class="delivery-top-cart delivery-top-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div class="delivery-top-address delivery-top-item">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="delivery-top-payment delivery-top-item">
                    <i class="fa-solid fa-money-check"></i>
                </div>
            </div>
        </div>
    </div>
    <section class="checkout">
        <div class="container" >
            <h2>Thông tin giao hàng</h2>
            <?php if (isset($error_message)) { ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php } ?>
            <form action="checkout.php" method="POST">
                <div class="form-group">
                    <label for="customer_name">Họ và tên</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="phone_number">Số điện thoại</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="city">Tỉnh/Thành phố</label>
                    <input type="text" name="city" id="city" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="district">Quận/Huyện</label>
                    <input type="text" name="district" id="district" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>
                <input type="hidden" name="total_price" value="77000">
                <input type="hidden" name="vat" value="2000">
                <button type="submit" class="btn btn-primary">Thanh toán và giao hàng</button>
            </form>
        </div>
    </section>
    <!-- Footer -->
    <?php 
    include("footer.php");
    ?>
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
