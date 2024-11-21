<?php
include_once 'connection.php';

class Payment
{
    private $conn;
    private $table_name = "payments";

    public $payment_id;
    public $order_id;
    public $payment_date;
    public $amount;
    public $payment_method;

    public function __construct()
    {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function create($order_id, $payment_date, $amount, $payment_method)
    {
        $query = "INSERT INTO " . $this->table_name . " (order_id, payment_date, amount, payment_method) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isds", $order_id, $payment_date, $amount, $payment_method);
        $stmt->execute();
    }

    public function delete($payment_id)
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE payment_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $payment_id);
        $stmt->execute();
    }

    public function update($payment_id, $order_id, $payment_date, $amount, $payment_method)
    {
        $query = "UPDATE " . $this->table_name . " SET order_id = ?, payment_date = ?, amount = ?, payment_method = ? WHERE payment_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isdsi", $order_id, $payment_date, $amount, $payment_method, $payment_id);
        $stmt->execute();
    }
}
