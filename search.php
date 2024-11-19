<?php
session_start();

// Kiểm tra người dùng đã đăng nhập hay chưa
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?message=login_required");
    exit();
}

include("header.php");
include("connect.php");

// Số sản phẩm hiển thị trên mỗi trang
$products_per_page = 12;

// Lấy trang hiện tại từ URL (mặc định là trang 1)
$current_page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

// Tính toán OFFSET cho SQL
$offset = ($current_page - 1) * $products_per_page;

// Lấy thông tin sắp xếp từ URL
$sort_order = isset($_GET['sort']) ? $_GET['sort'] : 'asc';
$order_clause = $sort_order === 'desc' ? 'DESC' : 'ASC';

// Lấy giá trị tìm kiếm từ URL
$search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

// Truy vấn tổng số sản phẩm theo tìm kiếm
if (!empty($search)) {
    $total_products_query = "SELECT COUNT(*) as total FROM tbl_product WHERE product_name LIKE '%$search%'";
} else {
    $total_products_query = "SELECT COUNT(*) as total FROM tbl_product";
}

$total_products_result = mysqli_query($link, $total_products_query);
$total_products = mysqli_fetch_assoc($total_products_result)['total'];

// Tính tổng số trang
$total_pages = ceil($total_products / $products_per_page);

// Truy vấn lấy danh sách sản phẩm theo tìm kiếm
if (!empty($search)) {
    $sql = "SELECT product_id, product_name, product_price, product_img 
            FROM tbl_product 
            WHERE product_name LIKE '%$search%' 
            ORDER BY product_price $order_clause 
            LIMIT $products_per_page OFFSET $offset";
} else {
    $sql = "SELECT product_id, product_name, product_price, product_img 
            FROM tbl_product 
            ORDER BY product_price $order_clause 
            LIMIT $products_per_page OFFSET $offset";
}

$result = mysqli_query($link, $sql);
?>

<section class="cartegory">
    <div class="container">
        <div class="cartegory-top">
            <p>Kết quả tìm kiếm cho: <strong><?= htmlspecialchars($search); ?></strong></p>
        </div>
    </div>

    <?php include("menu.php"); ?>

    <div class="cartegory-right">
        <div class="cartegory-right-top">
            <div class="cartegory-right-top-item">
                <p>Trang chủ</p>
            </div>
            <div class="cartegory-right-top-item">
                <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
            </div>
            <div class="cartegory-right-top-item">
                <!-- Form sắp xếp -->
                <form method="GET" action="search.php">
                    <input type="hidden" name="search" value="<?= htmlspecialchars($search); ?>" />
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
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="category-right-content-item">';
                    echo '<a href="product.php?id=' . $row["product_id"] . '">';
                    echo '<img src="/admin/uploads/' . $row["product_img"] . '" alt="Product Image">';
                    echo '<h1>' . $row["product_name"] . '</h1>';
                    echo '<p>' . number_format($row["product_price"], 0, ',', '.') . '<sup>đ</sup></p>';
                    echo '</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Không có sản phẩm nào phù hợp với từ khóa tìm kiếm.</p>';
            }
            ?>
        </div>

        <!-- Phân trang -->
        <div class="category-right-bottom">
            <div class="category-right-bottom-items" style="flex: 2; margin-top: 10px;">
                <p>Hiển thị 12 sản phẩm mỗi trang</p>
            </div>
            <div class="category-right-bottom-items" style="margin-top: 10px;">
                <?php
                if ($total_pages > 1) {
                    echo '<p>';
                    if ($current_page > 1) {
                        echo '<a href="search.php?page=' . ($current_page - 1) . '&sort=' . $sort_order . '&search=' . urlencode($search) . '">&#60;</a> ';
                    }

                    for ($page = 1; $page <= $total_pages; $page++) {
                        echo '<a href="search.php?page=' . $page . '&sort=' . $sort_order . '&search=' . urlencode($search) . '" ' . ($page == $current_page ? 'class="active"' : '') . '>' . $page . '</a> ';
                    }

                    if ($current_page < $total_pages) {
                        echo '<a href="search.php?page=' . ($current_page + 1) . '&sort=' . $sort_order . '&search=' . urlencode($search) . '"> &#62;</a>';
                    }
                    echo '</p>';
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php include("footer.php"); ?>
