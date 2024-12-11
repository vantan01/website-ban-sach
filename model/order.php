<?php
include_once 'connection.php';
class Order
{
    public $conn;
    public $table_name = "orders";

    public $order_id;
    public $customer_id;
    public $total_amount;
    public $status;
    public $order_date;
    public $payment_method;
    public $payment_status;
    public $payment_date;
    public $address;
    public $phone;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function create($account_id, $order_date, $total_amount, $status, $payment_method, $address, $phone, $payment_status = null, $payment_date = null)
    {
        $query = "INSERT INTO " . $this->table_name . " (account_id, order_date, total_amount, status, payment_method, address,phone, payment_status, payment_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssss", $account_id, $order_date, $total_amount, $status, $payment_method, $address, $phone, $payment_status, $payment_date);

        if ($stmt->execute()) {
            $this->order_id = $stmt->insert_id;
            return true;
        }
        return false;
    }


    public function readAll()
    {
        $query = "
        SELECT DISTINCT 
            o.order_id, 
            a.email,
            o.phone,
            o.order_date, 
            o.total_amount, 
            o.status, 
            o.payment_method, 
            o.address, 
            o.payment_date
        FROM 
            orders o
        JOIN 
            account a ON o.account_id = a.account_id
        JOIN 
            order_items oi ON o.order_id = oi.order_id
        JOIN 
            books b ON oi.book_id = b.book_id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    // public function update($order_id, $customer_id, $total_amount, $status) {
    //     $query = "UPDATE " . $this->table_name . " SET customer_id = ?, total_amount = ?, status = ? WHERE order_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("idsi", $customer_id, $total_amount, $status, $order_id);
    //     $stmt->execute();
    // }

    // public function delete($order_id) {
    //     $query = "DELETE FROM " . $this->table_name . " WHERE order_id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("i", $order_id);
    //     $stmt->execute();
    // }

    
        public function updateStatus($order_id, $status) {
            
            $stmt = $this->conn->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
            $stmt->bind_param("si", $status, $order_id);
            $stmt->execute();
        }

        public function getOrdersByEmail($id) {
                $stmt = $this->conn->prepare("SELECT * FROM orders WHERE account_id = ?");
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $orders = $result->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                $this->conn->close();
                return $orders;
        }
        
}
