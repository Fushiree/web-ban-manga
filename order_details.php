<?php
// Kết nối cơ sở dữ liệu
include("connect.php");
session_start();

// Kiểm tra người dùng đã đăng nhập chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=login_required");
    exit();
}

// Lấy thông tin tất cả đơn hàng của người dùng
$user_id = $_SESSION['user_id'];
$sql = "SELECT 
            o.order_id, 
            o.customer_name, 
            o.phone_number, 
            o.address, 
            o.total_price, 
            o.vat, 
            o.order_date, 
            od.product_id, 
            p.product_name, 
            od.quantity, 
            p.product_price AS price  -- Sử dụng cột product_price
        FROM tbl_order AS o
        INNER JOIN tbl_order_details AS od ON o.order_id = od.order_id
        INNER JOIN tbl_product AS p ON od.product_id = p.product_id
        WHERE o.user_id = $user_id
        ORDER BY o.order_date DESC";

$result = mysqli_query($link, $sql);

// Kiểm tra kết quả truy vấn
if ($result && mysqli_num_rows($result) > 0) {
    $orders = [];
    while ($row = mysqli_fetch_assoc($result)) {
        // Group the products by order
        if (!isset($orders[$row['order_id']])) {
            $orders[$row['order_id']] = [
                'info' => [
                    'order_id' => $row['order_id'],
                    'customer_name' => $row['customer_name'],
                    'phone_number' => $row['phone_number'],
                    'address' => $row['address'],
                    'total_price' => $row['total_price'],
                    'vat' => $row['vat'],
                    'order_date' => $row['order_date']
                ],
                'products' => []
            ];
        }
        $orders[$row['order_id']]['products'][] = [
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price']
        ];
    }
} else {
    echo "<p>Không tìm thấy đơn hàng nào.</p>";
    exit();
}

include("product-head.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chi tiết đơn hàng</h2>

        <?php foreach ($orders as $order): ?>
            <h3>Thông tin đơn hàng #<?= $order['info']['order_id'] ?></h3>
            <p><strong>Tên khách hàng:</strong> <?= $order['info']['customer_name'] ?></p>
            <p><strong>Số điện thoại:</strong> <?= $order['info']['phone_number'] ?></p>
            <p><strong>Địa chỉ:</strong> <?= $order['info']['address'] ?></p>
            <p><strong>Ngày đặt hàng:</strong> <?= $order['info']['order_date'] ?></p>

            <h3>Danh sách sản phẩm</h3>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $order_total = 0;
                        foreach ($order['products'] as $product): 
                            $total = $product['quantity'] * $product['price'];
                            $order_total += $total;
                    ?>
                        <tr>
                            <td><?= $product['product_name'] ?></td>
                            <td><?= $product['quantity'] ?></td>
                            <td><?= number_format($product['price'], 2) ?>₫</td>
                            <td><?= number_format($total, 2) ?>₫</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h3>Tổng cộng</h3>
            <p class="total"><strong>VAT:</strong> <?= number_format($order['info']['vat'], 2) ?>₫</p>
            <p class="total"><strong>Tổng giá trị:</strong> <?= number_format($order_total + $order['info']['vat'], 2) ?>₫</p>
        <?php endforeach; ?>
    </div>
</body>
</html>
