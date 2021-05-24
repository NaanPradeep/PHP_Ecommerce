<?php 

class BillingAddress {
    public $db = null;

    public function __construct(DBController $db) {
        if(!isset($db)) {
            return null;
        }
        $this->db = $db;
    }

    public function post_billing_address($data) {
        if(isset($data) && isset($this->db->connect)) {

            $billing_address_exists = $this->get_billing_address($data["address_owner"]);
            if($billing_address_exists) {
                $this->delete_billing_address($data["address_owner"]);
            }

            $address_owner = $data["address_owner"];
            $street_no = $data["street_no"];
            $street_name = $data["street_name"];
            $town_name = $data["town_name"];
            $city_name = $data["city_name"];
            $pincode = $data["pincode"];
            $country = $data["country"];

            $sql = "INSERT INTO `billing_address` (`address_owner`, `street_no`, `street_name`, `town_name`, `city_name`, `pincode`, `country`)
                            VALUES ({$address_owner}, '{$street_no}', '{$street_name}', '{$town_name}', '{$city_name}', {$pincode}, '{$country}')";
            $result = mysqli_query($this->db->connect, $sql);
            if($result) {
                header("Location: ship_address.php");
            }
        }

    }

    public function get_billing_address($address_owner) {
        if(isset($address_owner) && isset($this->db->connect)) {
            $sql = "SELECT * FROM `billing_address` WHERE `address_owner` = {$address_owner} LIMIT 1";
            $query = mysqli_query($this->db->connect, $sql);
            $result = $query->fetch_array(MYSQLI_ASSOC);
            return $result;
        }
    }

    public function delete_billing_address($address_owner) {
        if(isset($address_owner) && isset($this->db->connect)) {
            $sql = "DELETE FROM `billing_address` WHERE `address_owner` = {$address_owner}";
            $result = mysqli_query($this->db->connect, $sql);
            return $result;
        }
    }

    public function get_bill_address_by_id($address_id) {
        if(isset($address_id)) {
            $sql = "SELECT * FROM `billing_address` WHERE `address_id` = {$address_id} LIMIT 1";
            $query = mysqli_query($this->db->connect, $sql);
            $result = $query->fetch_array(MYSQLI_ASSOC);
            if($result) {
                return $result;
            }
        }
    }
}