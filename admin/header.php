<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="admin_style.css">
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
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                        echo '<a href="" class="account"><i class="fas fa-user"></i> ADMIN </a>';
                        echo '<a href="../php/main.php?act=pagelogout" class="account"><i class="fas fa-user"></i> Đăng xuất</a>';
                    } else {
                        echo '<a href="../php/main.php?act=register" class="account"><i class="fas fa-user"></i> Đăng ký</a>';
                        echo '<a href="../php/main.php?act=pagelogin" class="account"><i class="fas fa-user"></i> Đăng nhập</a>';
                    }
                    ?>
                </div>
            </div>

        </header>