<?php
include("connect.php");

// Kiểm tra dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = intval($_POST['cart_id']);

    // Xóa sản phẩm khỏi giỏ hàng
    $sql = "DELETE FROM tbl_cart WHERE cart_id = $cart_id";
    if (mysqli_query($link, $sql)) {
        header("Location: cart.php");
        exit;
    } else {
        echo "<p>Xóa sản phẩm thất bại.</p>";
    }
}
?>
