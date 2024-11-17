<?php
include "class/product-class.php";

$product = new product;

if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $product_id = $_GET['product_id'];
}

// Xóa sản phẩm
$delete_product = $product->delete_product($product_id);

if ($delete_product) {
    echo "<script>alert('Sản phẩm đã được xóa!'); window.location = 'productlist.php';</script>";
} else {
    echo "<script>alert('Xóa sản phẩm không thành công!'); window.location = 'productlist.php';</script>";
}
?>
