<?php
include_once '../model/order.php';

if (isset($_SESSION['email'])) {
    echo '<h2 style="text-align: center;">Thông tin tài khoản</h2>';
    echo $_SESSION['email'];

    // Lấy danh sách đơn hàng của người dùng
    $orderModel = new Order();
    $ID = $_SESSION['account_id'];
    $userOrders = $orderModel->getOrdersByEmail($ID);

    if (!empty($userOrders)) {
        echo '<h3 style="text-align: center;">Đơn hàng của bạn</h3>';
        echo '<div class="order-list" style="text-align: center;">';
        echo '<table border="1" style="width: 100%; text-align: left; margin: 0 auto;">';
        echo '<thead>
                <tr>
                    <th>Ngày đặt hàng</th>
                    <th>Tổng cộng</th>
                    <th>Trạng thái</th>
                    <th>Chi tiết</th>
                </tr>
              </thead>';
        echo '<tbody>';
        foreach ($userOrders as $order) {
            echo '<tr>
                    <td>' . $order['order_date'] . '</td>
                    <td>' . $order['total_amount'] . ' VND</td>
                    <td>' . $order['status'] . '</td>
                    <td>
                        <form method="post" action="../view/orderDetails.php">
                            <input type="hidden" name="order_id" value="' . $order['order_id'] . '">
                            <input type="submit" value="Xem chi tiết">
                        </form>
                    </td>
                  </tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    } else {
        echo '<p style="text-align:center;">Bạn chưa có đơn hàng nào.</p>';
    }
} else {
    echo '<p style="text-align:center;">Bạn chưa đăng nhập vào tài khoản!!!</p>';
}
?>
