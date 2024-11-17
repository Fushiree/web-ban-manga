<?php 
include("header.php");
include("connect.php");
?>
<!-- cartegory -->
<section class="cartegory">
    <div class="container">
        <div class="cartegory-top">
            <p>Trang chủ</p> <span>&#8594;</span> <P>AZ</P>
        </div>
    </div>
   <?php 
   include("menu.php");
   ?>
            <!-- danh sách sản phẩm -->
            <div class="cartegory-right">
                <div class="cartegory-right-top">
                    <div class="cartegory-right-top-item">
                        <p>AZ</p>
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
             
                <?php 
                $sl1 = "SELECT * FROM  tbl_product WHERE cartegory_id = '38'";
                $result = mysqli_query($link, $sl1);

                while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="category-right-content">
                    <div class="category-right-content-item">
                        <a href="/product.html">
                            <img src="/admin/uploads/<?php echo $row['product_img']; ?>">
                            <h1><?php echo $row['product_name']; ?></h1>
                            <p><?php echo $row['product_price']; ?><sup>đ</sup></p>
                        </a>
                    </div>
                    <!-- Thêm các sản phẩm khác tại đây -->
                </div>
                <?php 
                }
                ?>

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