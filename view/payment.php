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
    <form action="../test.html" class="container">
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
                                <input type="email" id="email" name="email" placeholder="" required>
                                <label class="label" for="email">Email</label>
                            </div>
                            <div class="field">
                                <input type="text" id="name" name="name" placeholder="" required>
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
                                    <input type="radio" name="payment" id="">
                                    <p>Thanh toán khi giao hàng (Cash on Delivery)</p>
                                    <img src="" alt="">
                                </div>
                                <div class="content-box-row">
                                    <input type="radio" name="payment" id="">
                                    <p>Thanh toán khi giao hàng (Cash on Delivery)</p>
                                    <img src="" alt="">
                                </div>
                                <div class="content-box-row">
                                    <input type="radio" name="payment" id="">
                                    <p>Thanh toán khi giao hàng (Cash on Delivery)</p>
                                    <img src="" alt="">
                                </div>
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
                <div class="sidebar-content">
                    <div class="order-summary"></div>
                </div>
                <div class="discount-code ">
                    <div class="field flex">
                        <input type="text" name="discount-code" id="" placeholder="">
                        <label class="label" for="discount-code">Nhập mã giảm giá</label>
                        <button> Áp dụng </button>
                    </div>
                </div>
                <div class="total-list">
                    <table>
                        <tbody>
                            <tr>
                                <td><span>Tạm tính</span></td>
                                <td class="total-line-price">20.000</td>
                            </tr>
                            <tr>
                                <td><span>Phí vận chuyển</span></td>
                                <td class="total-line-price">20.000</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <td><span> Tổng cộng</span></td>
                            <td class="total-line-price">50.000</td>
                        </tfoot>
                    </table>
                </div>
                <div class="sidebar-nav flex">
                    <a href="../php/main.php?act=cart">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Quay về giỏ hàng</span>
                    </a>

                    <button><input type="submit" value="ĐẶT HÀNG"></button>
                </div>
            </div>
        </div>

    </form>
</body>

</html>