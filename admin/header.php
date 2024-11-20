<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="../admin/admin_style.css">
    <title>Magic Book</title>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-container">
                <!-- <div class="logo">
                    <img src= "<?php ROOT_DIR . '/images/logo.jpg' ?>" alt="Logo">
                </div> -->
                <div class="search">
                    <input type="text" placeholder="Search for books...">
                    <i class="fas fa-search"></i>
                </div>
                <div class="user-options">
                    <a href="../php/main.php?act=pagelogin" class="account"><i class="fas fa-user"></i> Đăng nhập</a>
                    <a href="../php/main.php?act=pagelogout" class="account"><i class="fas fa-user"></i> Đăng xuất</a>
                    <a  href="../php/main.php?act=cart" class="cart cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                </div>
            </div>

        </header>