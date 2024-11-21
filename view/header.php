<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/css/all.min.css">
    <title>Magic Book</title>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-container">
                <div class="logo">
                    <img src="../images/logo.jpg" alt="Logo">
                </div>
                <div class="search">
                    <input type="text" placeholder="Search for books...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="user-options">
                    <?php
                    if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
                        echo '<a href="../php/main.php?act=account" class="account"><i class="fas fa-user"></i> ' . $_SESSION['email'] . '</a>';
                        echo '<a href="../php/main.php?act=pagelogout" class="account"><i class="fas fa-user"></i> Đăng xuất</a>';
                    } else {
                        echo '<a href="../php/main.php?act=register" class="account"><i class="fas fa-user"></i> Đăng ký</a>';
                        echo '<a href="../php/main.php?act=pagelogin" class="account"><i class="fas fa-user"></i> Đăng nhập</a>';
                    }
                    ?>
                    <a href="../php/main.php?act=cart" class="cart cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">
                            <?php
                            // $cartCount 
                            ?>22
                        </span>
                    </a>
                </div>
            </div>
            <nav class="nav">
                <ul>
                    <!-- Khi cuộn xuống sẽ hiển thị trên đầu trang  -->
                    <li><a href="main.php">HOME</a></li>
                    <li><a href="../php/main.php?act=allbooks">ALL BOOKS</a></li>
                    <!-- <li><a href="#">category</a></li> -->
                    <li><a href="../php/main.php?act=contact">CONTACT</a></li>
                    <li><a href="#">ABOUT US</a></li>
                </ul>
            </nav>
        </header>