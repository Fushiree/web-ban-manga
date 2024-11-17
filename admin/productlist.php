<?php
include "header.php";
include "slider.php";
include "class/product-class.php";

// Khởi tạo đối tượng product
$product = new Product;

// Lấy danh sách sản phẩm từ database
$show_product = $product->show_product();
?>

<div class="admin-content-right">
    <div class="admin-content-right-product-list">
        <h1>Danh sách sản phẩm</h1>
        <table>
            <tr>
                <th>Stt</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Loại sản phẩm</th>
                <th>Giá</th>
                <th>Giá khuyến mãi</th>
                <th>Ảnh sản phẩm</th>
                <th>Tùy biến</th>
            </tr>

            <?php
            if ($show_product) {
                $i = 0; // Khởi tạo biến đếm Stt
                while ($result = $show_product->fetch_assoc()) {
                    $i++; // Tăng dần biến đếm
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $result['product_name'] ?></td>
                <td>
                    <?php
                    // Hiển thị danh mục của sản phẩm
                    $cartegory_id = $result['cartegory_id'];
                    $cartegory = $product->get_cartegory_name($cartegory_id);
                    echo $cartegory['cartegory_name'];
                    ?>
                </td>
                <td>
                    <?php
                    // Hiển thị loại sản phẩm
                    $brand_id = $result['brand_id'];
                    $brand = $product->get_brand_name($brand_id);
                    echo $brand['brand_name'];
                    ?>
                </td>
                <td><?php echo number_format($result['product_price'], 0, ',', '.') ?> VND</td>
                <td><?php echo number_format($result['product_price_new'], 0, ',', '.') ?> VND</td>
                <td>
                    <img src="uploads/product/<?php echo $result['product_img'] ?>" alt="product image" width="100">
                </td>
                <td>
                    <a href="productedit.php?product_id=<?php echo $result['product_id'] ?>">Sửa</a>
                    <a href="productdelete.php?product_id=<?php echo $result['product_id'] ?>">Xóa</a>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</div>
</section>
</body>
</html>
