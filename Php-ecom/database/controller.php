<?php 

class DBController 
{
    protected $host = 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $db_name = 'mobileshop';

    public $connect = null;

    public function __construct() {
        $this->connect = mysqli_connect($this->host, $this->user, $this->password, $this->db_name);
        if($this->connect->connect_error){
            echo "Failed".$this->connect->connect_error;
        }
    }

    public function __destruct() {
        $this->closeConnection();
    }

    public function closeConnection() {
        if($this->connect != null) {
            $this->connect->close();
            $this->connect = null;
        }
    }

}
