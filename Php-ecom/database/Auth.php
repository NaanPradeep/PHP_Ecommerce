<?php

class Auth {
    public $db = null;

    public function __construct(DBController $db) {
        if(!isset($db->connect)) {
            return null;
        }
        $this->db = $db;
    }

    public function post_register_data($data) {
        $user_name = $data['user_name'];
        $email = $data['email'];
        $password = $data['password'];

        $col_user_name = 'user_name';
        $col_user_email = 'user_email';
        $user_name_exist = $this->user_query_exist($col_user_name, $user_name);
        $user_email_exist = $this->user_query_exist($col_user_email, $email);
        if($user_name_exist) {
            return "User Name already exists";
        }
        elseif($user_email_exist) {
            return "Email already exists";
        }
        else {
            $sql = "INSERT INTO `user` (`user_name`, `user_email`, `password`) VALUES ('$user_name', '$email', '$password')";
            mysqli_query($this->db->connect, $sql);
            return;
        }
    }

    protected function user_query_exist($column_name, $column_value) {
        $sql = "SELECT * FROM `user` WHERE `{$column_name}` LIKE '{$column_value}'";
        $result = mysqli_query($this->db->connect, $sql);
        $query = $result->fetch_array(MYSQLI_NUM);
        if($query) {
            return true;
        } else {
            return false;
        }
    }

    public function login($data) {
        $email = $data["user_email"];
        $password = $data["password"];
        $sql = "SELECT * FROM `user` WHERE `user_email` = '{$email}' AND `password` = '{$password}' LIMIT 1";
        $result = mysqli_query($this->db->connect, $sql);
        $query = $result->fetch_array(MYSQLI_ASSOC);

        if($query) {
            return $query;
        } else {
            echo "Invalid credentials";
        }
    }

    public function logout() {
        if(isset($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
    }

    public function check_login() {
        if(isset($_SESSION["user_id"])) {
            $sql = "SELECT * FROM `user` WHERE `user_id` = {$_SESSION["user_id"]} LIMIT 1";
            $result = mysqli_query($this->db->connect, $sql);
            $user_data = $result->fetch_array(MYSQLI_ASSOC);
            return $user_data;
        } else {
            header("Location: login.php");
        }
    }
}