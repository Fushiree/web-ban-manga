<?php 
include("product-head.php");
include("connect.php");

// Kiểm tra nếu có tham số 'id' trong URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Truy vấn dữ liệu của sản phẩm theo ID
    $sql = "SELECT * FROM tbl_product WHERE product_id = $product_id";
    $result = mysqli_query($link, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "<p>Không tìm thấy sản phẩm.</p>";
        exit;
    }
} else {
    echo "<p>Không có sản phẩm nào được chọn.</p>";
    exit;
}

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Truy vấn dữ liệu của các hình ảnh mô tả sản phẩm theo ID
    $sql2 = "SELECT * FROM tbl_product_img_desc WHERE product_id = $product_id";
    $result2 = mysqli_query($link, $sql2);

    if (mysqli_num_rows($result2) > 0) {
        $images = [];
        while ($img = mysqli_fetch_assoc($result2)) {
            $images[] = $img;
        }
    } else {
        echo "<p>Không tìm thấy hình ảnh mô tả sản phẩm.</p>";
        exit;
    }
} else {
    echo "<p>Không có sản phẩm nào được chọn.</p>";
    exit;
}
?>

<!-- product -->
<section class="product">
    <div class="container">
        <div class="product-top">
            <?php 
            // Truy vấn dữ liệu của sản phẩm theo ID
            $sql3 = "SELECT cartegory_id, cartegory_name FROM tbl_cartegory WHERE cartegory_id = (SELECT cartegory_id FROM tbl_product WHERE product_id = $product_id)";
            $result3 = mysqli_query($link, $sql3);

            if (mysqli_num_rows($result3) > 0) {
                $product3 = mysqli_fetch_assoc($result3);
            } else {
                echo "<p>Không tìm thấy danh mục sản phẩm.</p>";
                exit;
            }
            ?>
            <p>Trang chủ</p> <span>&#8594;</span>
            <p><?php echo $product3['cartegory_name']; ?></p> <!-- Hiển thị tên danh mục -->
            <span>&#8594;</span> <p><?php echo $product['product_name']; ?></p>

            </div>
            <div class="product-content">
                <div class="product-content-left">
                    <div class="product-content-left-big-img">
                        <!-- Hiển thị hình ảnh sản phẩm -->
                        <img src="/admin/uploads/<?php echo $product['product_img']; ?>" alt="">
                    </div>
                    <div class="product-content-left-small-img">
                        <!-- Hiển thị các hình ảnh nhỏ (nếu có) -->
                        <?php
                        // Lặp qua tất cả các hình ảnh mô tả sản phẩm và hiển thị chúng
                        foreach ($images as $image) {
                            echo '<img src="/admin/uploads/' . $image['product_img_desc'] . '" alt="">';
                        }
                        ?>
                    </div>
            </div>
            <div class="product-content-right">
                <div class="product-content-right-product-name">
                    <h1><?php echo $product['product_name']; ?></h1>
                </div>
                <div class="product-content-right-product-price">
                    <p><?php echo number_format($product['product_price'], 0, ',', '.'); ?><sup>đ</sup></p>
                </div>
                <div class="quantity">
                    <p style="font-weight: bold;">Số lượng</p>
                </div>
                <div class="product-content-right-product-buton">
                    <!-- Form thêm sản phẩm vào giỏ hàng -->
                    <form action="add_to_cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                        <input type="number" name="quantity" value="1" min="1" required>
                        <button type="submit"><i class="fa-solid fa-cart-plus"></i><p>Thêm vào giỏ hàng</p></button>
                    </form>
                    <button><p>Mua hàng</p></button>
                </div>
                <div class="product-content-right-product-icon">
                    <div class="product-content-right-product-icon-item">
                        <i class="fa-solid fa-phone"></i> <p>Hotline</p>
                    </div>
                    <div class="product-content-right-product-icon-item">
                        <i class="fa-solid fa-comment"></i> <p>Chat</p>
                    </div>
                    <div class="product-content-right-product-icon-item">
                        <i class="fa-solid fa-envelope"></i> <p>Email</p>
                    </div>
                </div>
                <div class="product-content-right-product-QR">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
                <div class="product-content-right-bottom">
                    <div class="product-content-right-bottom-top">
                        &#8744;
                    </div>
                    <div class="product-content-right-bottom-content-big">
                        <div class="product-content-right-bottom-content-title">
                            <div class="product-content-right-bottom-content-title-item chitiet">
                                <p>Chi tiết sản phẩm</p>
                            </div>
                            <div class="product-content-right-bottom-content-title-item mota">
                                <p>Mô tả sản phẩm</p>
                            </div>
                        </div>
                        <div class="product-content-right-bottom-content">
                            <div class="product-content-right-bottom-content-chitiet">
                                <?php 
                                echo $product['product_desc'];
                                ?>
                            </div>
                            <div class="product-content-right-bottom-content-mota">
                                <?php echo $product['product_description']; ?> <!-- Hiển thị mô tả sản phẩm -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- product-related -->
<section class="product-related container">
    <div class="product-related-title">
        <p style="color: green;">Sản phẩm liên quan</p>
    </div>
    <div class="product-content">
        <?php
        // Lấy cartegory_id từ sản phẩm hiện tại
        $cartegory_id = $product['cartegory_id'];

        // Truy vấn các sản phẩm liên quan
        $related_sql = "SELECT * FROM tbl_product WHERE cartegory_id = $cartegory_id AND product_id != $product_id LIMIT 5";
        $related_result = mysqli_query($link, $related_sql);

        // Kiểm tra lỗi trong truy vấn SQL
        if (!$related_result) {
            echo '<p>Truy vấn thất bại: ' . mysqli_error($link) . '</p>';
        } elseif (mysqli_num_rows($related_result) > 0) {
            while ($related_product = mysqli_fetch_assoc($related_result)) {
                echo '<div class="product-related-item">';
                echo '<a href="product.php?id=' . $related_product["product_id"] . '">';
                echo '<img src="/admin/uploads/' . $related_product['product_img'] . '" alt="">';
                echo '<h1>' . $related_product['product_name'] . '</h1>';
                echo '<p>' . number_format($related_product['product_price'], 0, ',', '.') . '<sup>đ</sup></p>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo '<p>Không có sản phẩm liên quan.</p>';
        }
        ?>
    </div>
</section>

<!-- end product-related -->

<?php 
include("footer.php");
?>
