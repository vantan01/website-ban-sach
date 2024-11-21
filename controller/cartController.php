<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];

if (isset($_POST['del-cart-item']) && $_POST['del-cart-item']) {
    unset($_SESSION['cart'][$_GET['pos']]);
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header("Location: ../php/main.php?act=cart");
}
// Lấy dữ liệu từ form
if (isset($_POST['addcart']) && $_POST['addcart']) {
    $id = $_POST['id'];
    $image = $_POST['anhsp'];
    $name = $_POST['tensp'];
    $price = $_POST['gia'];

    $quantity = ((isset($_POST['quantity'])) && $_POST['quantity'] > 0) ? $_POST['quantity'] : 1;

    // Kiểm tra sản phẩm đã tồn tại trong giỏ hàng chưa
    $found = false;
    for ($i = 0; $i < sizeof($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][0] == $id) {
            $_SESSION['cart'][$i][4] += $quantity;
            $found = true;
            break;
        }
    }
    // Thêm mới sản phẩm nếu chưa tồn tại trong giỏ hàng
    if (!$found) {
        $sp = [$id, $image, $name, $price, $quantity];
        $_SESSION['cart'][] = $sp;
    }
    header("Location: ../php/main.php?act=cart");
}