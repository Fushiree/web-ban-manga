<?php
session_start();
include("connect.php");

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
    exit();
}

// Lấy thông tin từ form
$product_id = $_POST['product_id']; // Lấy ID sản phẩm
$quantity = $_POST['quantity']; // Lấy số lượng sản phẩm

// Lấy thông tin người dùng từ session
$user_id = $_SESSION['user_id'];

// Kiểm tra nếu sản phẩm đã có trong giỏ hàng chưa
$sql_check = "SELECT * FROM tbl_cart WHERE user_id = $user_id AND product_id = $product_id";
$result_check = mysqli_query($link, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Nếu sản phẩm đã có trong giỏ hàng, cập nhật số lượng
    $sql_update = "UPDATE tbl_cart SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($link, $sql_update);
} else {
    // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
    $sql_insert = "INSERT INTO tbl_cart (user_id, product_id, quantity, added_date) 
                   VALUES ($user_id, $product_id, $quantity, NOW())";
    mysqli_query($link, $sql_insert);
}

// Chuyển hướng về trang giỏ hàng
header("Location: cart.php");
exit();
?>
