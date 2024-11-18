<?php 
include("header.php");
include("connect.php");
?>
<!-- cartegory -->
<section class="cartegory">
    <div class="container">
        <div class="cartegory-top">
            <p>Trang chủ</p> <span>&#8594;</span> <P>IPM</P>
        </div>
    </div>
   <?php 
   include("menu.php");
   ?>
            <!-- danh sách sản phẩm -->
            <div class="cartegory-right">
                <div class="cartegory-right-top">
                    <div class="cartegory-right-top-item">
                        <p>IPM</p>
                    </div>
                    <div class="cartegory-right-top-item">
                        <button><span>Bộ lọc</span><i class="fa-solid fa-sort-down"></i></button>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">Giá cao đến thấp</option>
                            <option value="">Giá thấp đến cao</option>
                        </select>
                    </div>
                </div>
             
                <div class="category-right-content">
                    <?php
                    $sql = "SELECT product_id, product_name, product_price, product_img FROM tbl_product where cartegory_id = '30'";
                    $result = mysqli_query($link, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // Lặp qua từng sản phẩm và hiển thị
                        while($row = mysqli_fetch_assoc($result)) {
                            echo '<div class="category-right-content-item">';
                            echo '<a href="product.php?id=' . $row["product_id"] . '">'; // Thêm ID sản phẩm vào URL
                            echo '<img src="/admin/uploads/' . $row["product_img"] . '" alt="Product Image">';
                            echo '<h1>' . $row["product_name"] . '</h1>';
                            echo '<p>' . number_format($row["product_price"], 0, ',', '.') . '<sup>đ</sup></p>';
                            echo '</a>';
                            echo '</div>';
                        }
                    } else {
                        echo "<p>Không có sản phẩm nào.</p>";
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
        </div>
    </div>
 </section>
 <!-- end cartegory -->
  <?php 
  include("footer.php");
  ?>