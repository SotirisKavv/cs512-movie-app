<?php
    class Database {
        private $servername = "db";
        private $username = "root";
        private $password = "rootpassword";
        private $db_name = "moviedb";
        private $port = "3306";

        public $conn;

        public function getConnection() {
            $this->conn = null;

            try {
                $this->conn = new PDO("mysql:host=".$this->servername.";port=".$this->port.";dbname=".$this->db_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            } catch(PDOException $exception){
                echo "Connection Error: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>
