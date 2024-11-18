<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminname = mysqli_real_escape_string($link, $_POST['adminname']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $name = mysqli_real_escape_string($link, $_POST['name']);

    // Kiểm tra tên đăng nhập hoặc email đã tồn tại
    $sql_check_admin = "SELECT * FROM tbl_admin WHERE adminname = '$adminname'";
    $sql_check_email = "SELECT * FROM tbl_admin WHERE email = '$email'";

    $result_admin = mysqli_query($link, $sql_check_admin);
    $result_email = mysqli_query($link, $sql_check_email);

    if (mysqli_num_rows($result_admin) > 0) {
        $error_message = "Tên đăng nhập đã tồn tại!";
    } elseif (mysqli_num_rows($result_email) > 0) {
        $error_message = "Email đã tồn tại!";
    } else {
        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Thêm người dùng vào cơ sở dữ liệu
        $sql_insert = "INSERT INTO tbl_admin (adminname, password, email, name) 
                       VALUES ('$adminname', '$hashed_password', '$email', '$name')";
        if (mysqli_query($link, $sql_insert)) {
            $_SESSION['admin_id'] = mysqli_insert_id($link);
            $_SESSION['adminname'] = $adminname;
            header("Location: admin-register.php");
            exit();
        } else {
            $error_message = "Đăng ký thất bại. Vui lòng thử lại!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* CSS như đã cung cấp trước */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #ff512f, #f09819);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .register-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff512f;
            box-shadow: 0 0 5px rgba(255, 81, 47, 0.5);
        }

        .btn {
            display: block;
            width: 100%;
            background: #ff512f;
            color: #fff;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #d84315;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .login-link a {
            color: #ff512f;
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-container">
            <h2>Đăng ký tài khoản Admin</h2>

            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="admin-register.php" method="POST">
                <div class="form-group">
                    <label for="adminname">Tên đăng nhập:</label>
                    <input type="text" name="adminname" id="adminname" placeholder="Nhập tên đăng nhập" required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Nhập email" required>
                </div>

                <div class="form-group">
                    <label for="name">Họ và tên:</label>
                    <input type="text" name="name" id="name" placeholder="Nhập họ và tên" required>
                </div>

                <button type="submit" class="btn">Đăng ký</button>
            </form>

            <p class="login-link">Đã có tài khoản Admin? <a href="admin-login.php">Đăng nhập Admin</a></p>
        </div>
    </div>
</body>
</html>
