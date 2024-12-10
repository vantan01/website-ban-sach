<?php

include_once '../controller/orderController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $orderController = new OrderController();
    $orderitems = $orderController->getOrderItemsByOrderId($order_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <style>
        .detail-container {
            width: 80%;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .detail-header h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .detail-table {
            width: 100%;
            border-collapse: collapse;
        }

        .detail-table th,
        .detail-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .detail-table th {
            background-color: #f4f4f4;
        }

        .back-button {
            display: block;
            width: fit-content;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="detail-container">
        <div class="detail-header">
            <h2>Chi tiết đơn hàng</h2>
        </div>
        <table class="detail-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>ID Đơn hàng</th>
                    <th>Tên sách</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Tổng</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($orderitems) && is_array($orderitems)) {
                    foreach ($orderitems as $item) {
                        echo "<tr>
                        <td>{$item['order_item_id']}</td>
                        <td>{$item['order_id']}</td>
                        <td>{$item['title']}</td>
                        <td>{$item['quantity']}</td>
                        <td>{$item['book_price']}</td>
                        <td>" . $item['book_price'] * $item['quantity'] . "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Không có chi tiết đơn hàng nào</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="index.php?action=orders" class="back-button">Quay lại</a>
    </div>
</body>
</html>
