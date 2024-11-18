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

// Kiểm tra và lấy phương thức thanh toán từ form gửi đến
if (isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];  // Lấy giá trị phương thức thanh toán từ form

    // Cập nhật phương thức thanh toán vào cơ sở dữ liệu
    $update_query = "UPDATE tbl_order SET payment_method = ? WHERE order_id = ? AND user_id = ?";
    $stmt = mysqli_prepare($link, $update_query);
    mysqli_stmt_bind_param($stmt, 'sii', $payment_method, $order_id, $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);

    // Kiểm tra nếu cập nhật thành công
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Thanh toán đã được xác nhận. Cảm ơn bạn!";
        // Cập nhật lại thông tin đơn hàng sau khi cập nhật phương thức thanh toán
        $order_result = mysqli_query($link, $order_query);
        $order = mysqli_fetch_assoc($order_result);
    } else {
        echo "Có lỗi xảy ra trong quá trình xử lý thanh toán.";
    }
} else {
    echo "Vui lòng chọn phương thức thanh toán.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Thông tin đơn hàng</h1>
        <table class="table table-bordered mt-3">
            <tr>
                <th>Mã đơn hàng</th>
                <td><?= htmlspecialchars($order['order_id']); ?></td>
            </tr>
            <tr>
                <th>Tên khách hàng</th>
                <td><?= htmlspecialchars($order['customer_name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?= htmlspecialchars($order['email']); ?></td>
            </tr>
            <tr>
                <th>Địa chỉ</th>
                <td><?= htmlspecialchars($order['address']); ?></td>
            </tr>
            <tr>
                <th>Sản phẩm</th>
                <td><?= htmlspecialchars($order['product_name']); ?></td>
            </tr>
            <tr>
                <th>Số lượng</th>
                <td><?= htmlspecialchars($order['quantity']); ?></td>
            </tr>
            <tr>
                <th>Phương thức thanh toán</th>
                <td><?= htmlspecialchars($order['payment_method']); ?></td>
            </tr>
            <tr>
                <th>Ngày đặt hàng</th>
                <td><?= htmlspecialchars($order['order_date']); ?></td>
            </tr>
        </table>
        <a href="index.php" class="btn btn-primary">Quay về trang chủ</a>
    </div>
</body>
</html>
