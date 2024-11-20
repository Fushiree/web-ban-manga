<?php
// Bắt đầu phiên làm việc
session_start();

// Hủy tất cả các biến phiên
session_unset();

// Hủy phiên
session_destroy();

// Điều hướng về trang chủ hoặc trang đăng nhập
header("Location: login.php");
exit();
?>
