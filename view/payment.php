<?php
include '../controller/orderController.php';
include '../model/user.php';
$orderController = new OrderController();
session_start();
if (isset($_POST['addorders']) && $_POST['addorders'] && isset($_SESSION['cart'])) {
    $payment_method = $_POST['payment_method'];
    $status = 'pending';
    $address = $_POST['address'];
    $phone = $_POST['tel'];
    $order = new Order();
    $total_amount = array_reduce($_SESSION['cart'], function ($sum, $item) {
        return $sum + ($item[3] * $item[4]);
    }, 0);
    $account_id = $_SESSION['account_id'];
    $order_date = date('Y-m-d H:i:s');

    if ($order->create($account_id, $order_date, $total_amount, $status,$payment_method,$address,$phone, $payment_status = null, $payment_date = null)) {
        $order_id = $order->order_id;

        foreach ($_SESSION['cart'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->create($order_id, $item[0], $item[4], $item[3]);
        }

        unset($_SESSION['cart']);
        echo '<script>alert("Đơn hàng đang chờ được duyệt")</script>';
    } else {

        echo "Đã xảy ra lỗi khi tạo đơn hàng.";
    }
}           

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.6.0-web/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <title>Thanh toán</title>
</head>

<body>
    <form action="" class="container" method="post">
        <div class="grid-5 m0 flex max-width">
            <!-- ben trai -->
            <div style="width: 70%;">
                <div class="main-header">
                    <div class="logo">
                        <img src="../images/logo.jpg" alt="Logo">
                    </div>
                </div>
                <div class="flex">
                    <div class="form">
                        <div class="form-header flex">
                            <h3 class="margin0 w85"> Thông tin nhận hàng</h3>
                            <div class="signout">
                                <a href="../php/main.php?act=pagelogout">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Đăng xuất</span></a>
                            </div>
                        </div>

                        <div class="form-content">
                            <div class="field">
                                <input type="hidden" name="id" value="<?php echo $_SESSION['account_id'] ?>">
                                <input type="email" id="email" name="email" placeholder="" value="<?php echo $_SESSION['email'] ?>" required>
                                <label class="label" for="email">Email</label>
                            </div>
                            <div class="field">
                                <input type="text" id="name" name="name" placeholder="" value="<?php echo explode('@', $_SESSION['email'])[0] ?>" required>
                                <label class="label" for="name">Họ và tên</label>
                            </div>
                            <div class="field">
                                <input type="tel" id="tel" name="tel" placeholder="" required>
                                <label class="label" for="tel">Số điện thoại</label>
                            </div>
                            <div class="field">
                                <input type="text" id="address" name="address" placeholder="" required>
                                <label class="label" for="address">Địa chỉ</label>
                            </div>
                        </div>
                    </div>
                    <div class="shipping">
                        <section class="section-shipping">
                            <div class="title">
                                <h3 class="margin0 w85">Vận chuyển</h3>
                            </div>
                            <div class="shipping-info">
                                <p class="m0">Vui lòng nhập thông tin giao hàng</p>
                            </div>
                        </section>
                        <section class="section-shipping">
                            <div class="title">
                                <h3 class="margin0 w85">Thanh toán </h3>
                            </div>
                            <div class="content-box">
                                <div class="content-box-row"> 
                                    <input type="radio" name="payment_method" value="COD" id="cod" checked> 
                                    <label for="cod">Thanh toán khi giao hàng (Cash on Delivery)</label> <img src="" alt=""> 
                                </div>
                                <!-- <div class="content-box-row"> 
                                    <input type="radio" name="payment_method" value="Online" id="online"> 
                                    <label for="online">Thanh toán trực tuyến (Online Payment)</label> <img src="" alt=""> 
                                </div>
                                <div class="content-box-row"> 
                                    <input type="radio" name="payment_method" value="Bank" id="bank"> 
                                    <label for="bank">Chuyển khoản ngân hàng (Bank Transfer)</label> <img src="" alt=""> 
                                </div> -->
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- ben phai -->
            <div class="sidebar" style="width: 35%;">
                <div class="sidebar-header">
                    <h2>Đơn hàng</h2>
                </div>
                <?php

                $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
                $totalAmount = 0;
                ?>

                <div class="sidebar-content">
                    <div class="order-summary">
                        <?php if (count($cartItems) > 0): ?>
                            <ul class="product-list">
                                <?php foreach ($cartItems as $item): ?>
                                    <li class="product-item flex" style="font-size: 10px;">
                                        <img src="../images/<?php echo $item[1]; ?>" class="product-image">
                                        <div class="product-info">
                                            <h2 class="product-name"><?php echo $item[2]; ?></h2>
                                            <p class="product-quantity">Số lượng: <?php echo $item[4]; ?></p>
                                            <p class="product-price">Giá: <?php echo number_format($item[3], 0, ',', '.'); ?> VND</p>
                                        </div>
                                    </li>
                                    <?php $totalAmount += $item[3] * $item[4]; ?>
                                <?php endforeach; ?>
                            </ul>

                        <?php else: ?>
                            <p>Giỏ hàng của bạn đang trống.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="discount-code ">
                    <div class="field flex">
                        <input type="text" name="discount-code" id="" placeholder="">
                        <label class="label" for="discount-code">Nhập mã giảm giá</label>
                        <!-- <button> Áp dụng </button> -->
                    </div>
                </div>
                <div class="total-list">
                    <table>
                        <tbody>
                            <tr>
                                <td><span>Tạm tính</span></td>
                                <td class="total-line-price"><?php echo number_format($totalAmount, 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <td><span>Phí vận chuyển</span></td>
                                <td class="total-line-price">0</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <td><span> Tổng cộng</span></td>
                            <td class="total-line-price"><?php echo number_format($totalAmount, 0, ',', '.'); ?></td>
                        </tfoot>
                    </table>
                </div>
                <div class="sidebar-nav flex">
                    <a href="../php/main.php?act=cart">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Quay về giỏ hàng</span>
                    </a>

                    <input type="submit" name="addorders" value="ĐẶT HÀNG">
                </div>
            </div>
        </div>

    </form>
</body>

</html>