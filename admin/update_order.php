<?php
include_once '../model/order.php';

if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $order = new Order();
    $order->updateStatus($order_id, $status);

    header("Location: ../admin/index.php?action=orders");
    exit();
} else {
    echo "<script>alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.');</script>";
}
?>
