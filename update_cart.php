<?php
include("connect.php");

// Kiểm tra dữ liệu từ form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cart_id = intval($_POST['cart_id']);
    $quantity = intval($_POST['quantity']);

    // Kiểm tra số lượng hợp lệ
    if ($quantity > 0) {
        $sql = "UPDATE tbl_cart SET quantity = $quantity WHERE cart_id = $cart_id";
        if (mysqli_query($link, $sql)) {
            header("Location: cart.php");
            exit;
        } else {
            echo "<p>Cập nhật số lượng thất bại.</p>";
        }
    } else {
        echo "<p>Số lượng không hợp lệ.</p>";
    }
}
?>
