<?php
include("connect.php"); // Kết nối cơ sở dữ liệu
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php include("header.php"); ?>

    <div class="category-right-content">
        <?php
        // Lấy giá trị tìm kiếm
        $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

        // Truy vấn SQL
        if (!empty($search)) {
            $sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search%'";
            $result = mysqli_query($link, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                // Lặp qua từng sản phẩm và hiển thị
                while ($row = mysqli_fetch_assoc($result)) {
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
            mysqli_free_result($result); // Giải phóng bộ nhớ
        } else {
            echo "<p>Vui lòng nhập từ khóa tìm kiếm.</p>";
        }
        mysqli_close($link); // Đóng kết nối cơ sở dữ liệu
        ?>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
