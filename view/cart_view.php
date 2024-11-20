<!-- Main -->
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
                include ROOT_DIR .'/controller/cartController.php';
                showCart();
                ?>

            </div>
            <!-- total -->
            <div class="total">
                <table class="table-total">
                    <tr>
                        <td>
                            <span>Tổng số thành tiền:</span>
                            <strong>
                                <span class="totals-price">30.000</span>
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