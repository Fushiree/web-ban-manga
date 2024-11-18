<?php
// Kết nối cơ sở dữ liệu
include("connect.php");

// Khởi động session để lấy user_id
session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

// Kiểm tra nếu chưa đăng nhập
if (!$user_id) {
    echo "<p>Bạn cần <a href='login.php'>đăng nhập</a> để xem giỏ hàng.</p>";
    exit;
}

// Lấy dữ liệu từ giỏ hàng
$sql = "
    SELECT 
        tbl_cart.cart_id, 
        tbl_cart.quantity, 
        tbl_cart.added_date, 
        tbl_product.product_id, 
        tbl_product.product_name, 
        tbl_product.product_img, 
        tbl_product.product_price 
    FROM tbl_cart
    JOIN tbl_product ON tbl_cart.product_id = tbl_product.product_id
    WHERE tbl_cart.user_id = $user_id
";
$result = mysqli_query($link, $sql);

// Tính tổng sản phẩm và tổng tiền
$total_products = 0;
$total_price = 0;

$cart_items = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cart_items[] = $row;
        $total_products += $row['quantity'];
        $total_price += $row['quantity'] * $row['product_price'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include("header.php"); ?>

    <!-- Cart -->
    <section class="cart">
        <div class="container">
            <div class="cart-top-wrap">
                <div class="cart-top">
                    <div class="cart-top-cart cart-top-item">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="cart-top-address cart-top-item">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="cart-top-payment cart-top-item">
                        <i class="fa-solid fa-money-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="cart-content">
                <div class="cart-content-left">
                    <table>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>SL</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                        <?php if (!empty($cart_items)): ?>
                            <?php foreach ($cart_items as $item): ?>
                                <tr>
                                    <td><img src="/admin/uploads/<?php echo $item['product_img']; ?>" alt="Product Image"></td>
                                    <td><?php echo $item['product_name']; ?></td>
                                    <td>
                                        <form action="update_cart.php" method="POST">
                                            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                            <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                            <button type="submit">Cập nhật</button>
                                        </form>
                                    </td>
                                    <td><?php echo number_format($item['quantity'] * $item['product_price'], 0, ',', '.'); ?><sup>đ</sup></td>
                                    <td>
                                        <form action="delete_cart.php" method="POST">
                                            <input type="hidden" name="cart_id" value="<?php echo $item['cart_id']; ?>">
                                            <button type="submit">X</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5"><p>Giỏ hàng của bạn trống.</p></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="cart-content-right">
                    <table>
                        <tr>
                            <th colspan="2">Tổng tiền giỏ hàng</th>
                        </tr>
                        <tr>
                            <td>Tổng sản phẩm</td>
                            <td><?php echo $total_products; ?></td>
                        </tr>
                        <tr>
                            <td>Tổng tiền hàng</td>
                            <td><?php echo number_format($total_price, 0, ',', '.'); ?><sup>đ</sup></td>
                        </tr>
                        <tr>
                            <td>Tạm tính</td>
                            <td><p style="color: black; font-weight: bold;"><?php echo number_format($total_price, 0, ',', '.'); ?><sup>đ</sup></p></td>
                        </tr>
                    </table>
                    <div class="cart-content-right-text">
                        <p>Bạn sẽ được miễn phí ship khi đơn hàng của bạn có giá trị trên 500.000<sup>đ</sup></p>
                        <?php if ($total_price < 500000): ?>
                            <p style="color: red; font-weight: bold;">Hãy mua thêm <span style="font-size: 18px;"><?php echo number_format(500000 - $total_price, 0, ',', '.'); ?><sup>đ</sup></span> để được miễn phí ship</p>
                        <?php else: ?>
                            <p style="color: green; font-weight: bold;">Bạn đã đủ điều kiện miễn phí ship!</p>
                        <?php endif; ?>
                    </div>
                    <div class="cart-content-right-button">
                        <a href="index.php"><button>Tiếp tục mua sắm</button></a>
                        <a href="checkout.php"><button>Thanh toán</button></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include("footer.php"); ?>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/main.js"></script>
</body>
</html>
