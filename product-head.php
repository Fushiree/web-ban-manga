<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <!-- Menu -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="/picture/logo.jpg"></a>
        </div>
        <div class="menu">
           
        </div>
        <div class="orther">
    <!-- Form tìm kiếm -->
    <form method="GET" action="search.php" style="display: flex; align-items: center;">
        <!-- Input tìm kiếm -->
        <li>
            <input 
                placeholder="Tìm kiếm" 
                type="text" 
                name="search" 
                style="padding: 5px;" 
                value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>"
            >
        </li>
        <!-- Nút tìm kiếm -->
        <li>
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <i class="fa-solid fa-magnifying-glass fs-3"></i>
            </button>
        </li>
    </form>
    
    <!-- Biểu tượng user -->
    <li><div class="fs-3"><i class="fa-solid fa-user"></i></div></li>
    <!-- Giỏ hàng -->
    <a href="/cart.php">
        <li><div class="fs-3"><i class="fa-solid fa-bag-shopping"></i></div></li>
    </a>
</div>

    </header>
 <!-- end menu -->