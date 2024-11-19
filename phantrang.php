<?php 
include("connect.php");

// Số sản phẩm hiển thị trên mỗi trang
$products_per_page = 12;

// Lấy trang hiện tại từ URL (mặc định là trang 1)
$current_page = isset($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;

// Tính toán OFFSET cho SQL
$offset = ($current_page - 1) * $products_per_page;

// Truy vấn tổng số sản phẩm
$total_products_query = "SELECT COUNT(*) as total FROM tbl_product";
$total_products_result = mysqli_query($link, $total_products_query);
$total_products = mysqli_fetch_assoc($total_products_result)['total'];

// Tính tổng số trang
$total_pages = ceil($total_products / $products_per_page);

// Truy vấn lấy danh sách sản phẩm cho trang hiện tại
$sql = "SELECT product_id, product_name, product_price, product_img 
        FROM tbl_product 
        ORDER BY product_price ASC 
        LIMIT $products_per_page OFFSET $offset";
$result = mysqli_query($link, $sql);
?>
<div class="category-right-bottom">
            <div class="category-right-bottom-items" style="flex: 2; margin-top: 10px;">
                <p>Hiển thị 12 sản phẩm mỗi trang</p>
            </div>
            <div class="category-right-bottom-items" style="margin-top: 10px;">
                <?php
                if ($total_pages > 1) {
                    echo '<p>';
                    if ($current_page > 1) {
                        echo '<a href="index.php?page=' . ($current_page - 1) . '">&#60; </a>';
                    }

                    for ($page = 1; $page <= $total_pages; $page++) {
                        echo '<a href="index.php?page=' . $page . '" ' . ($page == $current_page ? 'class="active"' : '') . '>' . $page . '</a> ';
                    }

                    if ($current_page < $total_pages) {
                        echo '<a href="index.php?page=' . ($current_page + 1) . '"> &#62;</a>';
                    }
                    echo '</p>';
                }
                ?>
            </div>
        </div>