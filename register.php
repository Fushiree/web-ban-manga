<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $name = mysqli_real_escape_string($link, $_POST['name']);

    // Kiểm tra tên đăng nhập đã tồn tại chưa
    $sql = "SELECT * FROM tbl_user WHERE username = '$username'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        $error_message = "Tên đăng nhập đã tồn tại!";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO tbl_user (username, password, email, name) VALUES ('$username', '$hashed_password', '$email', '$name')";
        if (mysqli_query($link, $sql)) {
            $_SESSION['user_id'] = mysqli_insert_id($link);
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Đăng ký thất bại!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("header.php"); ?>

    <div class="register-form">
        <h2>Đăng ký tài khoản</h2>

        <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
        ?>

        <form action="register.php" method="POST">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="name">Họ và tên:</label>
            <input type="text" name="name" id="name" required>

            <button type="submit">Đăng ký</button>
        </form>

        <p>Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
    </div>

    <?php include("footer.php"); ?>
</body>
</html>
