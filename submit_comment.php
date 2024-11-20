<?php
include("connect.php");
session_start();

// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=login_required");
    exit();
}

// Kiểm tra dữ liệu được gửi từ biểu mẫu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $comment = isset($_POST['comment']) ? mysqli_real_escape_string($link, trim($_POST['comment'])) : '';

    // Lấy thông tin người dùng từ session
    $user_id = $_SESSION['user_id'];
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest'; // Nếu không có 'name', sử dụng 'Guest'

    // Kiểm tra dữ liệu đầu vào
    if ($product_id > 0 && !empty($comment)) {
        // Truy vấn chèn bình luận vào cơ sở dữ liệu
        $sql = "INSERT INTO tbl_comments (product_id, user_id, name, comment, created_at) 
                VALUES ('$product_id', '$user_id', '$name', '$comment', NOW())";

        if (mysqli_query($link, $sql)) {
            // Chuyển hướng trở lại trang sản phẩm với thông báo thành công
            header("Location: product.php?id=$product_id&message=comment_success");
            exit();
        } else {
            // Hiển thị lỗi nếu chèn không thành công
            echo "Lỗi: " . mysqli_error($link);
        }
    } else {
        // Chuyển hướng nếu thiếu dữ liệu hoặc không hợp lệ
        header("Location: product.php?id=$product_id&message=comment_error");
        exit();
    }
} else {
    // Chuyển hướng nếu truy cập không hợp lệ
    header("Location: index.php");
    exit();
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($link);
?>
