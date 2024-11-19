<?php
include "class/product-class.php";

// Khởi tạo đối tượng product
$product = new Product;

// Lấy `product_id` từ URL
if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
    $product_id = $_GET['product_id'];

    // Thử xóa sản phẩm
    try {
        $delete_product = $product->delete_product($product_id);
        if ($delete_product) {
            // Nếu xóa thành công
            echo "<script>alert('Xóa sản phẩm thành công!'); window.location='productlist.php';</script>";
        } else {
            // Nếu không thành công vì lý do khác
            echo "<script>alert('Có lỗi xảy ra! Vui lòng thử lại.'); window.location='productlist.php';</script>";
        }
    } catch (Exception $e) {
        // Nếu lỗi là do ràng buộc khóa ngoại
        if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
            echo "<script>alert('Không thể xóa sản phẩm này vì có khách đang mua hàng!'); window.location='productlist.php';</script>";
        } else {
            // Các lỗi khác
            echo "<script>alert('Đã xảy ra lỗi: " . $e->getMessage() . "'); window.location='productlist.php';</script>";
        }
    }
} else {
    // Quay về danh sách sản phẩm nếu không có `product_id`
    header('Location: productlist.php');
    exit();
}
?>
