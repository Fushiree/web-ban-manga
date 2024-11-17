<?php
include "database.php";
?>

<?php
class product{
    private $db;

    public function __construct(){
        $this->db = new Database();
    }
    public function show_cartegory(){
        $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
        $result = $this ->db->select($query);
        return $result;
    } 
    public function show_brand_ajax($cartegory_id){
        $query = "SELECT * FROM tbl_brand WHERE cartegory_id = '$cartegory_id'";
        $result = $this ->db->select($query);
        return $result;
    }
    public function show_product() {
        $query = "SELECT * FROM tbl_product ORDER BY product_id DESC";  // Truy vấn danh sách sản phẩm
        $result = $this->db->select($query);  // Thực thi truy vấn
        return $result;  // Trả về kết quả
    }
    public function get_cartegory_name($cartegory_id) {
        $query = "SELECT cartegory_name FROM tbl_cartegory WHERE cartegory_id = '$cartegory_id'";
        $result = $this->db->select($query);
    
        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();  // Trả về mảng với 'cartegory_name'
        }
    
        // Nếu không có kết quả, trả về null hoặc mảng với giá trị mặc định
        return null;  // Hoặc ['cartegory_name' => 'Không có danh mục']
    }
    
    
    public function get_brand_name($brand_id) {
        $query = "SELECT brand_name FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->select($query);
        if ($result) {
            return $result->fetch_assoc();  // Trả về tên thương hiệu
        }
        return null; // Trường hợp không tìm thấy
    }
    // Lấy thông tin sản phẩm dựa trên product_id
public function get_product($product_id) {
    $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
    $result = $this->db->select($query);
    return $result;
}
public function delete_product($product_id) {
    // Chuẩn bị câu lệnh SQL
    $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
    
    // Gọi phương thức delete từ lớp Database với câu truy vấn và tham số
    $result = $this->db->delete($query);

    // Chuyển hướng sau khi xóa
    header('location: productlist.php');
    return $result;
}
public function update_product($product_id, $product_name, $product_desc, $product_img_desc) {
    // Cập nhật thông tin sản phẩm
    $query = "UPDATE tbl_product SET 
                product_name = '$product_name',
                product_desc = '$product_desc'
              WHERE product_id = '$product_id'";
    $result = $this->db->update($query);

    // Nếu có ảnh mô tả mới
    if (!empty($product_img_desc['name'][0])) {
        $uploaded_files = $this->upload_product_images($product_img_desc, $product_id);
        // Cập nhật ảnh mô tả mới vào cơ sở dữ liệu
        foreach ($uploaded_files as $file) {
            $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) 
                      VALUES ('$product_id', '$file')";
            $this->db->insert($query);
        }
    }

    return $result;
}

// Phương thức tải ảnh lên
private function upload_product_images($product_img_desc, $product_id) {
    $uploaded_files = [];
    $file_names = $product_img_desc['name'];
    $file_tmp = $product_img_desc['tmp_name'];

    foreach ($file_names as $key => $value) {
        $target_dir = "uploads/";
        $file_name = basename($value);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($file_tmp[$key], $target_file)) {
            $uploaded_files[] = $file_name;
        }
    }
    
    return $uploaded_files;
}

            
    public function insert_product() {
        $product_name = $_POST["product_name"];
        $cartegory_id = $_POST["cartegory_id"];
        $brand_id = isset($_POST["brand_id"]) ? $_POST["brand_id"] : null;  // Kiểm tra xem có tồn tại 'brand_id' hay không
        $product_price = $_POST["product_price"];
        $product_price_new = $_POST["product_price_new"];
        $product_desc = $_POST["product_desc"];
        $product_img = $_FILES['product_img']['name'];
        move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);
    
        $query = "INSERT INTO tbl_product (
            product_name,
            cartegory_id,
            brand_id,
            product_price,
            product_price_new,
            product_desc,
            product_img
        ) VALUES (
            '$product_name',
            '$cartegory_id',
            '$brand_id',
            '$product_price',
            '$product_price_new',
            '$product_desc',
            '$product_img'
        )";
        $result = $this->db->insert($query);
    
        if ($result) {
            $query = "SELECT * FROM tbl_product ORDER BY product_id DESC LIMIT 1";
            $result = $this->db->select($query)->fetch_assoc();
            $product_id = $result["product_id"];
            
            // Kiểm tra nếu có nhiều ảnh
            if (isset($_FILES['product_img_desc']['name']) && is_array($_FILES['product_img_desc']['name'])) {
                $filename = $_FILES['product_img_desc']['name'];
                $filetmp = $_FILES['product_img_desc']['tmp_name'];
                foreach ($filename as $key => $value) {
                    $destination = "uploads/" . $value;
                    if (move_uploaded_file($filetmp[$key], $destination)) {
                        $query = "INSERT INTO tbl_product_img_desc (product_id, product_img_desc) VALUES ('$product_id', '$value')";
                        $this->db->insert($query);
                    }
                }
            }
        }
        return $result;
    }
    
     
    











     
 
     
    public function show_brand(){
        // $query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
        $query = "SELECT tbl_brand.*,tbl_cartegory.cartegory_name
        FROM tbl_brand INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id
        ORDER BY tbl_brand.brand_id DESC";
        $result = $this ->db->select($query);
        return $result;
    }

    public function get_brand( $brand_id ) {
        $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this ->db->select($query);
        return $result;
    }

    public function update_brand($cartegory_id, $brand_name, $brand_id) {
        $query = "UPDATE tbl_brand SET brand_name = '$brand_name', cartegory_id = $cartegory_id WHERE brand_id = '$brand_id'";
        $result = $this->db->update($query);
        header('location:brandlist.php');
        return $result;
    }

    public function delete_brand( $brand_id ) {
        $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id'";
        $result = $this->db->delete($query);
        header('location:brandlist.php');
        return $result;
    }
}
?>