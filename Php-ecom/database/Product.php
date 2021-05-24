<?php

class Product {
    public $db = null;

    public function __construct(DBController $db) {
        if(!isset($db->connect)) {
            return null;
        }
        $this->db = $db;
    }

    public function get_data($table='product') {
        $sql = "SELECT * FROM {$table}";
        $result = mysqli_query($this->db->connect, $sql);
        $resultArray = array();

        while($items = $result->fetch_array(MYSQLI_ASSOC)) {
            $resultArray[] = $items;
        }
        return $resultArray;
    }

    public function get_data_by_id($item_id) {
        $sql = "SELECT * FROM `product` WHERE `item_id` = $item_id LIMIT 1";
        $result = mysqli_query($this->db->connect, $sql);
        return $result->fetch_array(MYSQLI_ASSOC);
    }
}