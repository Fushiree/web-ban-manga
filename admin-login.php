<?php
session_start();
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminname = mysqli_real_escape_string($link, $_POST['adminname']);
    $password = mysqli_real_escape_string($link, $_POST['password']);

    $sql = "SELECT * FROM tbl_admin WHERE adminname = '$adminname'";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['admin_id'];
            $_SESSION['adminname'] = $admin['adminname'];
            header("Location: /admin/cartegoryadd.php");
            exit();
        } else {
            $error_message = "Mật khẩu không đúng!";
        }
    } else {
        $error_message = "Tên đăng nhập không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(to right, #6a11cb, #2575fc);
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

.login-container h2 {
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
    border-color: #2575fc;
    box-shadow: 0 0 5px rgba(37, 117, 252, 0.5);
}

.btn {
    display: block;
    width: 100%;
    background: #2575fc;
    color: #fff;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

.btn:hover {
    background: #1d5ebc;
}

.error-message {
    color: red;
    font-size: 14px;
    margin-bottom: 15px;
    text-align: center;
}

.register-link {
    text-align: center;
    margin-top: 15px;
    font-size: 14px;
}

.register-link a {
    color: #2575fc;
    text-decoration: none;
    font-weight: bold;
}

.register-link a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <h2>Đăng nhập Admin</h2>

            <?php if (isset($error_message)): ?>
                <p class="error-message"><?php echo $error_message; ?></p>
            <?php endif; ?>

            <form action="admin-login.php" method="POST">
                <div class="form-group">
                    <label for="adminname">Tên đăng nhập:</label>
                    <input type="text" name="adminname" id="adminname" placeholder="Nhập tên đăng nhập" required>
                </div>

                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required>
                </div>

                <button type="submit" class="btn">Đăng nhập</button>
            </form>
        </div>
    </div>
</body>
</html>
