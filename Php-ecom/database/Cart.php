<?php

class Cart {
    public $db = null;

    public function __construct(DBController $db) {
        if(isset($db->connect)) {
            $this->db = $db;
        }
    }

    protected function insert_into_cart($cart_data) {
        if($this->db->connect != null) {
            if(!empty($cart_data)) {
                $columns = implode(',', array_keys($cart_data));
                $values = implode(',', array_values($cart_data));

                $sql = sprintf("INSERT INTO `cart` (%s) VALUES (%s)", $columns, $values);
                $result = mysqli_query($this->db->connect, $sql);
                return $result;
            }
        }
    }

    public function add_to_cart($user_id, $item_id) {
        if(isset($user_id) && isset($item_id)) {
            $cart_data = array(
                "user_id" => $user_id,
                "product_id" => $item_id
            );

            $result = $this->insert_into_cart($cart_data);
            if($result) {
                header("Location:".$_SERVER["PHP_SELF"]);
            }
        }
    }

    public function get_cart_items($user_id) {
        if(isset($user_id)) {
            $sql = "SELECT * FROM `cart` WHERE `user_id` = '{$user_id}'";
            $result = mysqli_query($this->db->connect, $sql);
            $result_array = array();

            while($item = $result->fetch_array(MYSQLI_ASSOC)) {
                $result_array[] = $item;
            }
            return $result_array;
        }
    }

    public function delete_cart_item($cart_id) {
        if(isset($cart_id)) {
            $sql = "DELETE FROM `cart` WHERE `cart_id` = {$cart_id}";
            $result = mysqli_query($this->db->connect, $sql);
            if($result) {
                header("Location: cart.php");
            }
        }
    }

    protected function get_quantity($cart_id) {
        if(isset($cart_id)) {
            $sql = "SELECT * FROM `cart` WHERE `cart_id` = {$cart_id} LIMIT 1";
            $result = mysqli_query($this->db->connect, $sql)->fetch_array(MYSQLI_ASSOC);
            return $result["quantity"];
        }
    }

    protected function update_quantity($cart_id, $new_quantity) {
        if(isset($cart_id)) {
            $sql = "UPDATE `cart` SET `quantity` = {$new_quantity} WHERE `cart_id` = {$cart_id}";
            mysqli_query($this->db->connect, $sql);
        }
    }

    public function change_quantity($cart_id, $action) {
        if(isset($cart_id) && isset($action)) {
            if($action === "Increase") {
                $new_quantity = $this->get_quantity($cart_id) + 1;
                $this->update_quantity($cart_id, $new_quantity);
                header("Location: cart.php");
            } else {
                $new_quantity = $this->get_quantity($cart_id) - 1;
                if($new_quantity < 1) {
                    $this->delete_cart_item($cart_id);
                } else {
                    $this->update_quantity($cart_id, $new_quantity);
                    header("Location: cart.php");
                }
            }
        }
    }

    public function empty_cart($user_id) {
        if(isset($user_id)) {
            $sql = "DELETE FROM `cart` WHERE `user_id` = {$user_id}";
            mysqli_query($this->db->connect, $sql);
        }
    }
}