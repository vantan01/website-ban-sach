<?php
// include_once '../models/Order.php';
// include_once '../models/OrderItem.php';

// class OrderController {
//     private $db;

//     public function __construct() {
//         $database = new Database();
//         $this->db = $database->getConnection();
//     }

//     public function create() {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             session_start();

//             $order = new Order($this->db);
//             $total_amount = array_reduce($_SESSION['cart'], function($sum, $item) {
//                 return $sum + ($item['price'] * $item['quantity']);
//             }, 0);
//             $status = 'Processing';
//             $customer_id = $_SESSION['customer_id'];

//             if ($order->create($customer_id, $total_amount, $status)) {
//                 $order_id = $order->order_id;

//                 foreach ($_SESSION['cart'] as $item) {
//                     $orderItem = new OrderItem($this->db);
//                     $orderItem->create($order_id, $item['id'], $item['quantity'], $item['price']);
//                 }

//                 unset($_SESSION['cart']);
//                 header("Location: ../views/order/success.php");
//                 exit();
//             }
//         } else {
//             include '../views/order/create.php';
//         }
//     }
// }
?>
