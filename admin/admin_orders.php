<?php

include_once '../controller/orderController.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>
    <style>
        .admin-container {
            width: 90%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .admin-header h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .admin-table-container {
            margin-bottom: 20px;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th,
        .admin-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .admin-table th {
            background-color: #f4f4f4;
        }

        .admin-actions form {
            display: inline;
            margin: 0 5px;
        }

        .admin-actions input[type="submit"] {
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .admin-actions input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .detail_container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s ease;
        }

        .detail_container.show {
            display: flex;
            opacity: 1;
        }

        #order-details {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 800px;
            padding: 20px;
            transition: all 0.3s ease;
            transform: scale(0.7);
        }

        .show #order-details {
            transform: scale(1);
        }

        #order-details h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1>Quản lý đơn hàng</h1>
        </div>

        <div class="admin-table-container">
            <table class="admin-table" border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Số điện thoại</th>
                        <th>Ngày đặt hàng</th>
                        <th>Tổng cộng</th>
                        <th>Trạng thái</th>
                        <th>Phương thức thanh toán</th>
                        <th>Địa chỉ</th>
                        <th>Ngày thanh toán</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $order_id;
                    $orderModel = new Order();
                    $orders = $orderModel->readAll();
                    if (isset($orders) && is_array($orders)) {
                        foreach ($orders as $order) {
                            $order_id = $order['order_id'];
                            echo '<tr id="row_detail_order">
                                <td>' . $order['order_id'] . '</td>
                                <td>' . $order['email'] . '</td>
                                <td>' . $order['phone'] . '</td>
                                <td>' . $order['order_date'] . '</td>
                                <td>' . $order['total_amount'] . '</td>
                                <td> 
                                <form method="post" action="update_order.php"> 
                                <input type="hidden" name="order_id" value="' . $order['order_id'] . '"> 
                                    <select name="status" onchange="this.form.submit()"> 
                                        <option value="' . $order['status'] . '">' . $order['status'] . '</option> 
                                        <option value="Đã duyệt">Đã duyệt</option> 
                                        <option value="Đã giao hàng">Đã giao hàng</option> 
                                        <option value="Đã hủy">Đã hủy</option> 
                                    </select> 
                                </form> 
                                </td>
                                <td>' . $order['payment_method'] . '</td>
                                <td>' . $order['address'] . '</td>
                                <td>' . $order['payment_date'] . '</td>
                                <td class="admin-actions">
                                    <form method="post" action="../view/orderDetails.php">
                                        <input type="hidden" name="order_id" value="' . $order_id . '">
                                        <input type="submit" value="Xem chi tiết">
                                    </form>
                                </td>
                            </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="9">Không có đơn hàng nào.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>