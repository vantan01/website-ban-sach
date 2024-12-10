<?php
include_once '../model/order.php';
include_once '../model/order_items.php';
class OrderController
{
    public $orders;
    public $order_items;

    public function __construct()
    {
        
        $this->orders = new Order();
        $this->order_items = new OrderItem();
    }


    public function showCart()
    {
        foreach ($_SESSION['cart'] as $item) {
            $thanhtien = intval($item[3]) * $item[4];
            echo '<div >
                        <div >
                        </div style="display:flex;">
                            <a href="../php/main.php?act=detail&id=' . $item[0] . '" >
                                <img src="../images/' . $item[1] . '" alt="" style="max-height:100px">
                            </a>
                            <a href="../php/main.php?act=detail&id=' . $item[0] . '" >
                                <p>' . $item[2] . '</p>
                            </a>
                            <div >
                                <span>' . $item[3] . '</span>
                            </div>
                            <div >
                            <form action="" method="post">
                                <input type="number" min="1" max="1000" name="quantity" value="' . $item[4] . '" readonly>
                            </form>
                            </div>
                            <div >
                                <span>' . number_format($thanhtien, 0, '', '.') . ' VNĐ </span>
                            </div>
                        </div>
                    </div>';
        }
    }

    
    public function getOrderItemsByOrderId($order_id){

        $stmt = $this->order_items->getOrderItemsByOrderId($order_id);
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
