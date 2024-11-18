<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect user to login page if not logged in
    exit();
}

include("header.php");
include("connect.php");
?>

<!-- category -->
<section class="cartegory">
    <div class="container">
        <div class="cartegory-top">
            <p>Trang chủ</p> <span>&#8594;</span> <P>Kim Đồng</P>
        </div>
    </div>
    <?php 
    include("menu.php");
    ?>
    <!-- product list -->
    <div class="cartegory-right">
        <div class="cartegory-right-top">
            <div class="cartegory-right-top-item">
                <p>Trang chủ</p>
            </div>
            <div class="cartegory-right-top-item">
                <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
            </div>
            <!-- Sorting form -->
            <div class="cartegory-right-top-item">
                <form method="GET" action="index.php">
                    <select name="sort" onchange="this.form.submit()">
                        <option value="">Sắp xếp</option>
                        <option value="desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : ''; ?>>Giá cao đến thấp</option>
                        <option value="asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : ''; ?>>Giá thấp đến cao</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="category-right-content">
            <?php
            // Ensure $link is initialized and check for sort order
            if ($link) {
                $sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'asc'; // Default to 'asc' if not set
                $sql = "SELECT product_id, product_name, product_price, product_img FROM tbl_product ORDER BY product_price " . ($sort_order == 'desc' ? 'DESC' : 'ASC');
                $result = mysqli_query($link, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    // Loop through and display products
                    while($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="category-right-content-item">';
                        echo '<a href="product.php?id=' . $row["product_id"] . '">';
                        echo '<img src="/admin/uploads/' . $row["product_img"] . '" alt="Product Image">';
                        echo '<h1>' . $row["product_name"] . '</h1>';
                        echo '<p>' . number_format($row["product_price"], 0, ',', '.') . '<sup>đ</sup></p>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Không có sản phẩm nào.</p>";
                }
            } else {
                echo "Database connection error.";
            }
            mysqli_close($link);
            ?>
        </div>

        <div class="category-right-bottom">
            <div class="category-right-bottom-items" style="flex: 2;margin-top: 10px;">
                <p>Hiển thị 2 <span>|</span> 4 sản phẩm</p>
            </div>
            <div class="category-right-bottom-items" style="margin-top: 10px;">
                <p><span>&#60;</span> 1 2 3 4 5 <span>&#62;</span>Trang cuối</p>
            </div>
        </div>
    </div>
</section>
<!-- end category -->

<?php 
include("footer.php");
?>
