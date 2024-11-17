<?php
include "header.php";
include "slider.php";
include "class/product-class.php";

$product = new product;

// Kiểm tra nếu không có product_id thì chuyển hướng về trang danh sách sản phẩm
if (!isset($_GET['product_id']) || $_GET['product_id'] == NULL) {
    echo "<script>window.location = 'productlist.php'</script>";
} else {
    $product_id = $_GET['product_id'];
}

// Lấy thông tin sản phẩm
$get_product = $product->get_product($product_id);
if ($get_product) {
    $result = $get_product->fetch_assoc();
}

// Cập nhật thông tin sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $cartegory_id = $_POST['cartegory_id'];
    $brand_id = $_POST['brand_id'];
    $product_price = $_POST['product_price'];
    $product_price_new = $_POST['product_price_new'];
    $product_desc = $_POST['product_desc'];
    $product_img = $_FILES['product_img']['name'];

    // Nếu có thay đổi ảnh thì upload ảnh mới
    if ($product_img != "") {
        move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/product/" . $_FILES['product_img']['name']);
    } else {
        $product_img = $result['product_img']; // Giữ ảnh cũ nếu không thay đổi
    }

    // Cập nhật sản phẩm
    $update_product = $product->update_product($product_id, $product_name, $cartegory_id, $brand_id, $product_price, $product_price_new, $product_desc, $product_img);
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-product-add">
        <h1>Sửa sản phẩm</h1>
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="">Tên sản phẩm</label>
            <input name="product_name" type="text" value="<?php echo $result['product_name']; ?>" required>
            <label for="">Danh mục</label>
            <select name="cartegory_id" required>
                <option value="">---Chọn---</option>
                <?php
                $show_cartegory = $product->show_cartegory();
                while ($cartegory = $show_cartegory->fetch_assoc()) {
                ?>
                    <option value="<?php echo $cartegory['cartegory_id']; ?>" <?php if ($cartegory['cartegory_id'] == $result['cartegory_id']) echo "selected"; ?>>
                        <?php echo $cartegory['cartegory_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="">Loại sản phẩm</label>
            <select name="brand_id" required>
                <option value="">---Chọn---</option>
                <?php
                $show_brand = $product->show_brand();
                while ($brand = $show_brand->fetch_assoc()) {
                ?>
                    <option value="<?php echo $brand['brand_id']; ?>" <?php if ($brand['brand_id'] == $result['brand_id']) echo "selected"; ?>>
                        <?php echo $brand['brand_name']; ?>
                    </option>
                <?php } ?>
            </select>

            <label for="">Giá sản phẩm</label>
            <input name="product_price" type="text" value="<?php echo $result['product_price']; ?>" required>
            <label for="">Giá khuyến mãi</label>
            <input name="product_price_new" type="text" value="<?php echo $result['product_price_new']; ?>" required>
            <label for="">Mô tả sản phẩm</label>
            <textarea name="product_desc" required><?php echo $result['product_desc']; ?></textarea>
            <label for="">Ảnh sản phẩm</label>
            <input name="product_img" type="file">
            <img src="uploads/product/<?php echo $result['product_img']; ?>" alt="Image" width="100">
            <button type="submit">Cập nhật</button>
        </form>
    </div>
</div>

</section>
</body>
</html>
