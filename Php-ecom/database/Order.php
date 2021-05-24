<?php

class Order {
    public $db = null;

    public function __construct(DBController $db) {
        if(!isset($db)) {
            return null;
        }
        $this->db = $db;
    }

    public function post_order_details($data) {
        if(isset($data) && isset($this->db->connect)) {
            print_r("working");
            $user_id = $data["user_id"];
            $serialized_product_details = $data["serialized_product_details"];
            $order_total = $data["order_total"];
            $transaction_id = $data["transaction_id"];
            $ship_address = $data["ship_address"];
            $bill_address = $data["bill_address"];
            $status = $data["status"];
            $sql = "INSERT INTO `order` (`user_id`, `serialized_product_details`, `order_total`, `transaction_id`, `ship_address`, `bill_address`, `status`) 
                            VALUES ({$user_id}, '{$serialized_product_details}', {$order_total}, '{$transaction_id}', {$ship_address}, {$bill_address}, '{$status}')";
            $query = mysqli_query($this->db->connect, $sql);
            if($query) {
                return $query;
            }
        }
    }
}