<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];

// Lấy dữ liệu từ form
if (isset($_POST['addcart']) && $_POST['addcart']) {
    $image = $_POST['anhsp'];
    $name = $_POST['tensp'];
    $price = $_POST['gia'];
    $quantity = 1; // Số lượng mặc định

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    $found = false;
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][1] == $name) {
            $_SESSION['cart'][$i][3] += $quantity; // Cập nhật số lượng
            $found = true;
            break;
        }
    }

    // Thêm mới sản phẩm nếu chưa tồn tại trong giỏ hàng
    if (!$found) {
        $sp = [$image, $name, $price, $quantity];
        $_SESSION['cart'][] = $sp;
    }

    header("Location: ".ROOT_DIR ."/php/main.php?act=cart");
}

// Xử lý cập nhật số lượng sản phẩm
if (isset($_POST['updatecart']) && $_POST['updatecart']) {
    $name = $_POST['tensp'];
    $quantity = $_POST['quantity'];

    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][1] == $name) {
            $_SESSION['cart'][$i][3] = $quantity; // Cập nhật số lượng
            break;
        }
    }

    header("Location: ".ROOT_DIR ."/php/main.php?act=cart");
}

function showCart()
{
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
            $thanhtien = $_SESSION['cart'][$i][2] * $_SESSION['cart'][$i][3];
            echo '<div class="cart-item">
                            <div class="cart-image">
                                <img src="../images/' . $_SESSION['cart'][$i][0] . '" alt="">
                            </div>
                            <div class="cart-product-name">
                                <p>' . $_SESSION['cart'][$i][1] . '</p>
                            </div>
                            <div class="cart-price">
                                <span>' . $_SESSION['cart'][$i][2] . '</span>
                            </div>
                            <div class="quantity">
                            <form action="'.ROOT_DIR .'/controller/cartController.php" method="post">
                            
                                <i class="fa-solid fa-caret-up increment" onclick="updateQuantity(this, ' . $i . ', 1)"></i> 
                                <input type="number" min="1" max="1000" name="quantity" value="' . $_SESSION['cart'][$i][3] . '" readonly>
                                <i class="fa-solid fa-caret-down decrement" onclick="updateQuantity(this, ' . $i . ', -1)"></i>
                                </form>
                            </div>
                            <div class="cart-price">
                                <span>' . $thanhtien . '</span>
                            </div>
                        </div>';
        }
    }
}
?>
