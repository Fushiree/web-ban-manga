<?php
include "header.php";
include "slider.php";
include "class/product-class.php";

 ?>
 <?php
 $product = new product;
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $product->insert_product($_POST, $_FILES);
 }
 ?>


<div class="admin-content-right">
    <div class="admin-content-right-product-add">
                <h1>Thêm sản phẩm</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <label for="">Nhập tên sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_name" required type="text" >
                    <label for="">Chọn danh mục <span style="color: red;">*</span></label>
                    <select name="cartegory_id" id="cartegory_id">
                    <option value="">---Chọn---</option>
                        <?php
                        $show_cartegory = $product ->show_cartegory();
                        if($show_cartegory){while($result = $show_cartegory -> fetch_assoc()){

                        
                         ?>
                        <option value="<?php echo $result['cartegory_id'] ?>"><?php echo $result['cartegory_name'] ?></option>
                        <?php
                        }}
                         ?>
                    </select>
                    <label for="">Chọn loại sản phẩm <span style="color: red;">*</span></label>
                    <select name="brand_id" id="brand_id">
                        <option value="">Chọn</option>
                        
                    </select>
                    <label for="">Nhập giá sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_price" required type="text">
                    <label for="">Nhập giá khuyến mãi <span style="color: red;">*</span></label>
                    <input name="product_price_new" required type="text">
                    <label>Nhập mô tả sản phẩm <span style="color: red;">*</span></label>
                    <textarea required name="product_desc" id="editor1" cols="30" rows="50"></textarea>
                    <label for="">Ảnh sản phẩm <span style="color: red;">*</span></label>
                    <input name="product_img" required type="file">
                    <label for="">Ảnh mô tả sản phẩm <span style="color: red;">*</span></label>
                    <input type="file" name="product_img_desc[]" multiple>
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>
    </section>
</body>




<script>
    $(document).ready(function() {
        $("#cartegory_id").change(function() {
            // alert($(this).val())
            var x = $(this).val(); // Lấy giá trị của cartegory_id
            $.get("productadd-ajax.php", { cartegory_id: x }, function(data) {
                $("#brand_id").html(data); // Cập nhật nội dung của phần tử có ID brand_id
            });
        });
    });
</script>

</html>