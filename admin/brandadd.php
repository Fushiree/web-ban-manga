<?php
include "header.php";
include "slider.php";
include "class/brand-class.php";
?>

<?php
$brand = new Brand;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartegory_id = isset($_POST['cartegory_id']) ? $_POST['cartegory_id'] : null;
    $brand_name = $_POST['brand_name'];
    
    if ($cartegory_id) {
        $insert_brand = $brand->insert_brand($cartegory_id, $brand_name);
    } else {
        echo "Vui lòng chọn danh mục hợp lệ.";
    }
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-cartegory-add">
        <h1>Thêm loại sản phẩm</h1>
        <form action="" method="POST">
            <select name="cartegory_id" id="">
                <option value="">Chọn danh mục</option>
                <?php
                $show_cartegory = $brand->show_cartegory();
                if ($show_cartegory) {
                    while ($result = $show_cartegory->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $result["cartegory_id"] ?>">
                            <?php echo $result["cartegory_name"] ?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select><br>
            <input required name="brand_name" type="text" placeholder="Nhập tên loại sản phẩm">
            <button type="submit">Thêm</button>
        </form>
    </div>
</div>
</section>
</body>
</html>
