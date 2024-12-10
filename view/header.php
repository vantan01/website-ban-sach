<!DOCTYPE html>
<html lang="en">
<?php
    function getTotalQuantity() { 
        if (!isset($_SESSION['cart'])) { 
            return 0; 
        } 
        $totalQuantity = 0; 
        foreach ($_SESSION['cart'] as $item) { 
        $totalQuantity += $item[4]; 
        } 
        return $totalQuantity;
    }
?>
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
                    <form action="../php/main.php?act=search" method="post"> 
                        <input type="text" placeholder="Search for books..." name="query"> 
                        <button type="submit"><i class="fas fa-search"></i></button> 
                    </form>
                </div>
                <div class="user-options">
                    <?php
                    if (isset($_SESSION['email']) && $_SESSION['email'] != '') {
                        echo '<a href="../php/main.php?act=account" class="account"> ' . explode('@',$_SESSION['email'])[0] . '</a>';
                        echo '<a href="../php/main.php?act=pagelogout" class="account"> THOÁT</a>';
                    } else {
                        echo '<a href="../php/main.php?act=pageregister" class="account"> ĐĂNG KÝ</a>';
                        echo '<a href="../php/main.php?act=pagelogin" class="account"> ĐĂNG NHẬP</a>';
                    }
                    ?>
                    <a href="../php/main.php?act=cart" class="cart cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">
                            <?php   echo getTotalQuantity(); ?>
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