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

    <div class="container mt-5">
        <?php
        // Lấy giá trị tìm kiếm
        $search = isset($_GET['search']) ? mysqli_real_escape_string($link, $_GET['search']) : '';

        // Truy vấn SQL
        if (!empty($search)) {
            $sl1 = "SELECT * FROM tbl_product WHERE product_name LIKE '%$search%'";
            $result = mysqli_query($link, $sl1);

            if (mysqli_num_rows($result) > 0) {
                echo '<div class="row">';
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
                echo '</div>';
            } else {
                echo "<p>Không tìm thấy sản phẩm nào phù hợp với từ khóa: <b>$search</b></p>";
            }
        } else {
            echo "<p>Hãy nhập từ khóa để tìm kiếm.</p>";
        }
        ?>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
