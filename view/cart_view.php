<?php
include '../controller/cartController.php';
?>

<main class="main">
    <section class="cart">
        <h1> Giỏ hàng của bạn</h1>
        <div class="cart-container grid-5 m0">
            <!-- header -->
            <div class="cart-head">
                <div style="width: 48%; text-align: start; padding-left: 5%;">Sản phẩm</div>
                <div style="width: 22%;">Giá</div>
                <div style="width: 100px;">Số lượng</div>
                <div style="width: 22%;">Thành tiền</div>
            </div>
            <!-- main -->
            <div class="cart-main">

                <?php
                $total_price = 0;
                if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                    $pos = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $thanhtien = intval($item[3]) * $item[4];
                        $total_price += $thanhtien;
                        echo '<div class="cart-item">
                        <div class="del-cart-item">
                        <form action="../controller/cartController.php?pos=' . $pos . '" method="post">
                            <input type="submit" name="del-cart-item" value="X">
                        </form>
                        </div>
                                        <a href="../php/main.php?act=detail&id=' . $item[0] . '" class="cart-image">
                                            <img src="../images/' . $item[1] . '" alt="">
                                        </a>
                                        <a href="../php/main.php?act=detail&id=' . $item[0] . '" class="cart-product-name">
                                            <p>' . $item[2] . '</p>
                                        </a>
                                        <div class="cart-price">
                                            <span>' . $item[3] . '</span>
                                        </div>
                                        <div class="quantity">
                                        <form action="" method="post">
                                            <i class="fa-solid fa-caret-up increment" onclick="updateQuantity(1,this)"></i>
                                            <input type="number" min="1" max="1000" name="quantity" value="' . $item[4] . '" readonly>
                                            <i class="fa-solid fa-caret-down decrement" onclick="updateQuantity(-1,this)"></i>
                                        </form>
                                        </div>
                                        <div class="cart-price">
                                            <span>' . number_format($thanhtien, 0, '', '.') . ' VNĐ </span>
                                        </div>
                                    </div>';
                        $pos++;
                    }
                }

                ?>

            </div>
            <!-- total -->
            <div class="total">
                <table class="table-total">
                    <tr>
                        <td>
                            <span>Tổng số thành tiền:</span>
                            <strong>
                                <span class="totals-price"><?= number_format($total_price, 0, '', '.') ?> VNĐ</span>
                            </strong>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="checkout">
                <a href="../php/main.php?act=allbooks">
                    <button class="btn-secondary">
                        Tiếp tục mua hàng
                    </button>
                </a>
                <a href="../view/payment.php">
                    <button class="btn-primary">
                        Tiến hành thanh toán
                    </button>
                </a>
            </div>
        </div>
    </section>
</main>